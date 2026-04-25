<?php
/**
 * The excel library of zdoo, can be used to export excel file.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @author      yaozeyuan <yaozeyuan@cnezsoft.com>
 * @package     Excel
 * @version     $Id$
 * @link        http://www.zdoo.com
 *
 * excel - a library to export excel file, depends on phpexcel.
 *
 * Here are some tips of excelData(named $data) structure maybe uesful. you can use these to create xls/xlsx file . The API is interchangeable.
 *
 * Base property:
 * data->fileName set the fileName
 * data->kind set the kind of excel module
 * data->fields is array like ($field => $fieldTitle). The order of data->fields is also the column's order
 * data->row is array like ($rowNumber => array($field => $value)).This is the data of Excel file. System will fill $value as data into every cell according to $rowNumber and $field
 *
 * Merge cell
 * if there is set data->dataRowspan[$row][$field] or data->dataColspan[$row][$field], the cells will be merge
 *      data->dataRowspan[$row][$field] => merge excelColumns[$field]:$rowNumber to excelColumns[$field]:($rowNumber + data->dataRowspan[$row][$field]) into one cell
 *      data->dataColspan[$row][$field] => merge excelColumns[$field]:$rowNumber to transIntoExcelKey(int(excelColumns[$field]) + dataColspan[$row][$field]):$rowNumber into one cell
 *
 * html content
 *      if you set config->excel->editor[$this->rawExcelData->kind] like 'excelColumns1,excelColumns2...', and excelColumns in that, then $value of all column's cell will be process to remove html tag
 *
 * write sysData and use droplist style on cell
 * sysData is an array like (excelColumns => valueList), system use this sheet to store extraData.
 * if you want to have droplist style on some column in sheet1, you can set data->($exceKey . 'List'), data->listStyle and  data->sysData sothat the data will be writen into the sysData sheet and you can see the droplist style is enable.
 * the data->listStyle and data->sysData is an  array of series value like ['dropListStyleColumnName' . 'List'] , like ('nameList', 'categoryList', ...) the dropListStyleColumnName used to indicate witch column need that style and data->[dropListStyleColumnName . 'List'] use to transfer data for system get real data to build datalist in sysdata sheet.
 *
 * FreezePane
 * if you set config->excel->freeze->{$this->data->kind}->targetColumnName, this column will be freezed
 *
 * Set width
 * You can set $data->customWidth like array($field => width, $field2 => width, $field3 => width,...) to set width by you like
 * or modify
 *       config->excel->titleFields
 *       config->excel->centerFields
 *       config->excel->dateFields
 * to have default style
 *
 * color
 * if you set data->nocolor, the excel file won't have color
 *
 * File title
 * The lang->excel->title->{data->kind} is the title of data->kind excel file
 *
 * SysData title
 * The lang->excel->title->sysValue is the name of sysData sheet , this is only can use for xls file.
 */
class excel extends model
{
    /**
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->phpExcel        = $this->app->loadClass('phpexcel');
        $this->file            = $this->loadModel('file');
        $this->sysDataColIndex = 0;
        $this->hasSysData      = false;
    }
    /**
     * Init for excel data.
     *
     * @param  int    $data
     * @access public
     * @return void
     */
    public function init($data)
    {
        $this->rawExcelData   = $data;
        $this->fields         = $data->fields;
        $this->rows           = $data->rows;
        $this->headerRowCount = isset($data->headerRowCount) ? $data->headerRowCount : 1;
        $this->fieldsKey      = $this->headerRowCount == 1 ? array_keys($this->fields) : array_keys(reset($this->fields));
    }
    /**
     * Export data to Excel. This is main function.
     *
     * @param  object $data
     * @param  string $fileType xls | xlsx
     * @param  string $savePath, if $savePath != '', then the file will save in $savePath
     * @access public
     * @return void
     */
    public function export($excelData, $fileType = 'xls', $savePath = '', $schemaSheets = '', $schemaSheetIndex = null)
    {
        $sheetIndex = 0;
        foreach($excelData->dataList as $data) $this->phpExcel->createSheet(); // Create sheets.

        foreach($excelData->dataList as $data)
        {
            $this->init($data);

            $this->excelColumns = array();
            foreach($this->fieldsKey as $colIndex => $field) $this->excelColumns[$field] = $this->setExcelField($colIndex);

            /* Set file base property */
            $excelProps = $this->phpExcel->getProperties();
            $excelProps->setCreator('ZenTao');
            $excelProps->setLastModifiedBy('ZenTao');
            $excelProps->setTitle('Office XLS Document');
            $excelProps->setSubject('Office XLS Document');
            $excelProps->setDescription('Document generated by PhpSpreadsheet.');
            $excelProps->setKeywords('office excel PhpSpreadsheet');
            $excelProps->setCategory('Result file');

            $excelSheet = $this->phpExcel->getSheet($sheetIndex);
            $sheetTitle = isset($this->rawExcelData->title) ? $this->rawExcelData->title : $this->rawExcelData->kind;
            if($sheetTitle) $excelSheet->setTitle($sheetTitle);

            $sheetRow = 1;
            if($this->headerRowCount == 1)
            {
                foreach($this->fields as $field => $fieldName)
                {
                    $cell = $this->excelColumns[$field] . $sheetRow;
                    $excelSheet->setCellValueExplicit($cell, $fieldName, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                }
                $sheetRow++;
            }
            else
            {
                foreach($this->fields as $fieldIndex => $fields)
                {
                    foreach($fields as $field => $fieldName)
                    {
                        if(isset($this->excelColumns[$field]))
                        {
                            $cell = $this->excelColumns[$field] . $sheetRow;
                            /* Merge Cells.*/
                            if(isset($this->rawExcelData->headerRowspan[$fieldIndex][$field]) && is_int($this->rawExcelData->headerRowspan[$fieldIndex][$field]))
                            {
                                $endCell = $this->excelColumns[$field] . ($sheetRow + $this->rawExcelData->headerRowspan[$fieldIndex][$field] - 1);
                                $excelSheet->mergeCells($cell . ":" . $endCell);
                            }
                            if(isset($this->rawExcelData->headerColspan[$fieldIndex][$field]) && is_int($this->rawExcelData->headerColspan[$fieldIndex][$field]))
                            {
                                $column  = $this->setExcelField($this->rawExcelData->headerColspan[$fieldIndex][$field] - 1, $this->excelColumns[$field]);
                                $endCell = $column . $sheetRow;
                                $excelSheet->mergeCells($cell . ":" . $endCell);
                            }

                            $excelSheet->setCellValueExplicit($cell, $fieldName, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
                    }
                    $sheetRow++;
                }
            }

            /* Write system data in excel.*/
            $this->writeSysData();

            $skipNumberCell = array(); // When merging cells, data cannot be merged. When assigning values to cells, it is necessary to skip merging data other than the first row
            foreach($this->rows as $rowIndex => $row)
            {
                foreach($row as $field => $value)
                {
                    if(isset($this->excelColumns[$field]))
                    {
                        $cell = $this->excelColumns[$field] . $sheetRow;
                        /* Merge Cells.*/
                        if (isset($this->rawExcelData->dataRowspan[$rowIndex][$field]) && is_int($this->rawExcelData->dataRowspan[$rowIndex][$field]))
                        {
                            $endCell = $this->excelColumns[$field] . ($sheetRow + $this->rawExcelData->dataRowspan[$rowIndex][$field] - 1);
                            /* Merge underlying data.  */
                            for($row = $sheetRow + 1; $row <= $sheetRow + $this->rawExcelData->dataRowspan[$rowIndex][$field] - 1; $row++)
                            {
                                $skipNumberCell[] = $this->excelColumns[$field] . $row;
                            }

                            $excelSheet->mergeCells($cell . ":" . $endCell);
                        }

                        if(isset($this->rawExcelData->dataColspan[$rowIndex][$field]) && is_int($this->rawExcelData->dataColspan[$rowIndex][$field]))
                        {
                            $column  = $this->setExcelField($this->rawExcelData->dataColspan[$rowIndex][$field] - 1, $this->excelColumns[$field]);
                            $endCell = $column . $sheetRow;
                            $excelSheet->mergeCells($cell . ":" . $endCell);
                        }

                        /* Wipe off html tags.*/
                        if(isset($this->config->excel->editor[$this->rawExcelData->kind]) and in_array($field, $this->config->excel->editor[$this->rawExcelData->kind])) $value = $this->file->excludeHtml($value);
                        if(!in_array($cell, $skipNumberCell))
                        {
                            if(isset($this->rawExcelData->percentageFields[$rowIndex][$field]))
                            {
                                $excelSheet->setCellValueExplicit($cell, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                            }
                            elseif(isset($this->rawExcelData->numberFields) && in_array($field, $this->rawExcelData->numberFields))
                            {
                                $excelSheet->setCellValueExplicit($cell, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                            }
                            else
                            {
                                $excelSheet->setCellValueExplicit($cell, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                            }
                        }

                        /* Add comments to cell, xls don't work, must be xlsx. */
                        if(isset($this->rawExcelData->comments[$rowIndex][$field])) $excelSheet->getComment($cell)->getText()->createTextRun($this->rawExcelData->comments[$rowIndex][$field]);

                        /* Calculate date. */
                        if((strpos($field, 'Date') !== false || in_array($field, $this->config->excel->dateFields)) && !helper::isZeroDate($value)) $excelSheet->setCellValueExplicit($cell, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    }

                    /* Build excel list.*/
                    if(isset($this->rawExcelData->listStyle) and in_array($field, $this->rawExcelData->listStyle)) $this->buildList($excelSheet, $field, $sheetRow);
                }
                $sheetRow++;
            }

            $this->setStyle($excelSheet, $sheetRow - 1);
            $this->setAlignment($excelSheet);

            if(isset($this->rawExcelData->help))
            {
                $excelSheet->mergeCells("A" . $sheetRow . ":" . end($this->excelColumns) . $sheetRow);
                $excelSheet->setCellValue("A" . $sheetRow, $this->rawExcelData->help);
            }

            $sheetIndex++;
        }

        /* If hasn't sys data remove the last sheet. */
        if(!$this->hasSysData) $this->phpExcel->removeSheetByIndex($this->phpExcel->getSheetCount() - 1);
        $this->phpExcel->setActiveSheetIndex(0);

        if(!empty($schemaSheets))
        {
            foreach($schemaSheets as $schemaSheet)
            {
                $schemaSheetRows = $schemaSheet->getHighestRow();
                if($schemaSheetRows > 1) $this->phpExcel->addSheet($schemaSheet, $schemaSheetIndex);
            }
        }

        /* Encode the file name for IE. */
        $fileName = $excelData->fileName;
        if(strpos($this->server->http_user_agent, 'MSIE') !== false || strpos($this->server->http_user_agent, 'Trident') !== false) $fileName = urlencode($fileName);

        /* Clean the ob content to make sure no space or utf-8 bom output. */
        $obLevel = ob_get_level();
        for($i = 0; $i < $obLevel; $i++) ob_end_clean();

        /* Set the file name and save path. */
        if(preg_match('/Safari/', $_SERVER['HTTP_USER_AGENT']))
        {
            $fileName   = rawurlencode($fileName);
            $attachment = "attachment; filename*=utf-8''{$fileName}.{$fileType}";
        }
        else
        {
            $fileName   = str_replace('+', '%20', urlencode($fileName));
            $attachment = "attachment; filename=\"{$fileName}.{$fileType}\";";
        }

        /* Set the download headers. */
        helper::setcookie('downloading', 1, 0, $this->config->webRoot, '', false, false);
        helper::header('Content-Type', 'application/vnd.ms-excel');
        helper::header('Content-Disposition', $attachment);
        helper::header('Cache-Control', 'max-age=0');

        $excelWriter = $this->phpExcel->createWriter($fileType);
        $excelWriter->setPreCalculateFormulas(false);
        $excelWriter->save($savePath ?: 'php://output');
        exit;
    }
    /**
     * Set excel filed name.
     *
     * @param  int    $colIndex
     * @param  string $column
     * @access public
     * @return string
     */
    public function setExcelField($colIndex, $column = 'A')
    {
        for($col = 1; $col <= $colIndex; $col++) $column++;
        return $column;
    }
    /**
     * Write SysData sheet in xls.
     *
     * @access public
     * @return void
     */
    public function writeSysData()
    {
        if(!isset($this->rawExcelData->sysDataList)) return true;

        $this->hasSysData = true;

        $sheetIndex = $this->phpExcel->getSheetCount() - 1;
        $this->phpExcel->getSheet($sheetIndex)->setTitle($this->lang->excel->title->sysValue);

        foreach($this->rawExcelData->sysDataList as $field)
        {
            $column  = $this->setExcelField($this->sysDataColIndex);
            $dataKey = $field . 'List';
            if(!isset($this->rawExcelData->$dataKey)) continue;

            $row = 1;
            foreach($this->rawExcelData->$dataKey as $value)
            {
                $this->phpExcel->getSheet($sheetIndex)->setCellValueExplicit("$column$row", $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $row++;
            }
            $this->sysDataColIndex++;
        }
    }
    /**
     * Build dropmenu list.
     * For a tip , if you want to modify that function , search "phpExcel DataValidation namedRange" in stackoverflow.com maybe helpful.
     *
     * @param  int    $excelSheet
     * @param  int    $field
     * @param  int    $row
     * @access public
     * @return void
     */
    public function buildList($excelSheet, $field, $row)
    {
        $listName = $field . 'List';
        $colIndex = array_search($field, $this->rawExcelData->sysDataList);
        $column   = $this->setExcelField($colIndex);
        if(isset($this->rawExcelData->$listName))
        {
            $itemCount = count($this->rawExcelData->$listName);
            if($itemCount == 0) $itemCount = 1;
            $range = "{$this->lang->excel->title->sysValue}!\${$column}\$1:\${$column}\$" . $itemCount;
        }
        else
        {
            $range = is_array($this->rawExcelData->$listName) ? '' : '"' . $this->rawExcelData->$listName . '"';
        }
        $objValidation = $excelSheet->getCell($this->excelColumns[$field] . $row)->getDataValidation();
        $objValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
            ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
            ->setAllowBlank(false)
            ->setShowErrorMessage(false)
            ->setShowDropDown(true)
            ->setErrorTitle($this->lang->excel->error->title)
            ->setError($this->lang->excel->error->info)
            ->setFormula1($range);
    }
    /**
     * Set excel style.
     *
     * @param  object $excelSheet
     * @param  int    $endRow
     * @access public
     * @return void
     */
    public function setStyle($excelSheet, $endRow)
    {
        $startRow  = $this->headerRowCount + 1;
        $endColumn = $this->setExcelField(count($this->excelColumns) - 1);

        if(isset($this->rawExcelData->help) and isset($this->rawExcelData->extraNum)) $endRow--;

        /* Freeze column.*/
        if(isset($this->config->excel->freeze->{$this->rawExcelData->kind}))
        {
            $column = $this->excelColumns[$this->config->excel->freeze->{$this->rawExcelData->kind}];
            $column++;
            $excelSheet->FreezePane($column . $startRow);
        }

        /* Set row height. */
        $excelSheet->getDefaultRowDimension()->setRowHeight(20);

        /* Set content style for this table.*/
        $contentStyle = $excelSheet->getStyle("A1:{$endColumn}{$endRow}");
        $contentStyle->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
            ->setWrapText(true);
        $contentStyle->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->getColor()->setARGB('FF808080');
        $contentStyle->getFont()->setSize(9);
        if(!isset($this->rawExcelData->nocolor))
        {
            $contentStyle->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFB2D7EA');
        }

        /* Set header style for this table.*/
        $headerStyle = $excelSheet->getStyle("A1:{$endColumn}{$this->headerRowCount}");
        $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFont()->setBold(true);
        if(!isset($this->rawExcelData->nocolor))
        {
            $headerStyle->getFill()->getStartColor()->setARGB('FF343399');
            $headerStyle->getFont()->getColor()->setARGB('FFFFFFFF');
        }

        /* Set column width and cell style. */
        $customWidth = $this->rawExcelData->customWidth ?? [];
        foreach($this->excelColumns as $key => $column)
        {
            /* Set column width. */
            $columnWidth = 10;
            if(strpos($key, 'Date') !== false || in_array($key, $this->config->excel->dateFields)) $columnWidth = 12; // Set column width of date fields.
            if(in_array($key, $this->config->excel->titleFields)) $columnWidth = $this->config->excel->width->title ?? 25; // Set column width of title fields.
            if(isset($this->config->excel->editor[$this->rawExcelData->kind]) and in_array($key, $this->config->excel->editor[$this->rawExcelData->kind])) $columnWidth = $this->config->excel->width->content ?? 50; // Set column width of editor fields.
            if(isset($customWidth[$key])) $columnWidth = $customWidth[$key]; // Set column width by userdefined settings.
            $excelSheet->getColumnDimension($column)->setWidth($columnWidth);

            /* Set cell alignment of center fields. */
            if(in_array($key, $this->config->excel->centerFields))
            {
                $excelSheet->getStyle("{$column}{$startRow}:{$column}{$endRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }

            /* Set cell format of date fields. */
            if(strpos($key, 'Date') !== false || in_array($key, $this->config->excel->dateFields))
            {
                $excelSheet->getStyle("{$column}{$startRow}:{$column}{$endRow}")->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD2);
            }
        }

        /* Set row color. */
        if(!isset($this->rawExcelData->nocolor))
        {
            if(isset($this->rawExcelData->colors))
            {
                foreach($this->rawExcelData->colors as $row => $color)
                {
                    $beginColumn = $this->excelColumns[$color->begin];
                    $endColumn   = $this->excelColumns[$color->end];
                    $excelSheet->getStyle("{$beginColumn}{$row}:{$endColumn}{$row}")->getFill()->getStartColor()->setRGB($color->color);
                }
            }
            else
            {
                if($startRow % 2 == 0) $startRow++; // If data start row is even, plus 1 to make it odd.

                /* Set odd row background color. */
                for($row = $startRow; $row <= $endRow; $row += 2)
                {
                    $excelSheet->getStyle("A{$row}:{$endColumn}{$row}")->getFill()->getStartColor()->setARGB('FFDEE6FB');
                }
            }
        }
    }
    /**
     * Set alignment.
     *
     * @param  object $excelSheet
     * @access public
     * @return bool
     */
    public function setAlignment($excelSheet)
    {
        if(!isset($this->rawExcelData->percentageFields)) return true;

        foreach($this->rawExcelData->percentageFields as $row => $fields)
        {
            foreach($fields as $key => $field)
            {
                if(isset($this->excelColumns[$key]))
                {
                    $cell = $this->excelColumns[$key] . ($this->headerRowCount + $row + 1);
                    $excelSheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
            }
        }
    }
}
