<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Ods;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Mimetype extends WriterPart
{
    /**
     * Write mimetype to plain text format.
     *
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet|null $spreadsheet
     *
     * @return string XML Output
     */
    public function write($spreadsheet = null)
    {
        return 'application/vnd.oasis.opendocument.spreadsheet';
    }
}
