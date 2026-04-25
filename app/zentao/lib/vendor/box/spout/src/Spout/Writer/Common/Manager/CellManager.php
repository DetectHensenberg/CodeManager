<?php

namespace Box\Spout\Writer\Common\Manager;

use Box\Spout\Common\Entity\Cell;
use Box\Spout\Common\Entity\Style\Style;
use Box\Spout\Writer\Common\Manager\Style\StyleMerger;

class CellManager
{
    /**
     * @var StyleMerger
     */
    protected $styleMerger;

    /**
     * @param StyleMerger $styleMerger
     */
    public function __construct($styleMerger)
    {
        $this->styleMerger = $styleMerger;
    }

    /**
     * Merges a Style into a cell's Style.
     *
     * @param Cell $cell
     * @param Style $style
     * @return void
     */
    public function applyStyle($cell, $style)
    {
        $mergedStyle = $this->styleMerger->merge($cell->getStyle(), $style);
        $cell->setStyle($mergedStyle);
    }
}
