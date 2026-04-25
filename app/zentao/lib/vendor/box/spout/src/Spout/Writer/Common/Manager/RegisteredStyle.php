<?php

namespace Box\Spout\Writer\Common\Manager;

use Box\Spout\Common\Entity\Style\Style;

/**
 * Class RegisteredStyle
 * Allow to know if this style must replace actual row style.
 */
class RegisteredStyle
{
    /**
     * @var Style
     */
    private $style;

    /**
     * @var bool
     */
    private $isMatchingRowStyle;

    /**
     * @param \Box\Spout\Common\Entity\Style\Style $style
     * @param bool $isMatchingRowStyle
     */
    public function __construct($style, $isMatchingRowStyle)
    {
        $this->style = $style;
        $this->isMatchingRowStyle = $isMatchingRowStyle;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function isMatchingRowStyle()
    {
        return $this->isMatchingRowStyle;
    }
}
