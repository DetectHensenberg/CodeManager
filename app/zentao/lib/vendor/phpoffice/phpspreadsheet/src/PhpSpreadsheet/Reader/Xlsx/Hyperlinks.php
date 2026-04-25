<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Hyperlinks
{
    private $worksheet;

    private $hyperlinks = [];

    /**
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $workSheet
     */
    public function __construct($workSheet)
    {
        $this->worksheet = $workSheet;
    }

    /**
     * @param \SimpleXMLElement $relsWorksheet
     */
    public function readHyperlinks($relsWorksheet)
    {
        foreach ($relsWorksheet->Relationship as $element) {
            if ($element['Type'] == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink') {
                $this->hyperlinks[(string) $element['Id']] = (string) $element['Target'];
            }
        }
    }

    /**
     * @param \SimpleXMLElement $worksheetXml
     */
    public function setHyperlinks($worksheetXml)
    {
        foreach ($worksheetXml->hyperlink as $hyperlink) {
            $this->setHyperlink($hyperlink, $this->worksheet);
        }
    }

    /**
     * @param \SimpleXMLElement $hyperlink
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet
     */
    private function setHyperlink($hyperlink, $worksheet)
    {
        // Link url
        $linkRel = $hyperlink->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships');

        foreach (Coordinate::extractAllCellReferencesInRange($hyperlink['ref']) as $cellReference) {
            $cell = $worksheet->getCell($cellReference);
            if (isset($linkRel['id'])) {
                $hyperlinkUrl = $this->hyperlinks[(string) $linkRel['id']];
                if (isset($hyperlink['location'])) {
                    $hyperlinkUrl .= '#' . (string) $hyperlink['location'];
                }
                $cell->getHyperlink()->setUrl($hyperlinkUrl);
            } elseif (isset($hyperlink['location'])) {
                $cell->getHyperlink()->setUrl('sheet://' . (string) $hyperlink['location']);
            }

            // Tooltip
            if (isset($hyperlink['tooltip'])) {
                $cell->getHyperlink()->setTooltip((string) $hyperlink['tooltip']);
            }
        }
    }
}
