<?php

namespace Box\Spout\Writer\Common\Manager\Style;

use Box\Spout\Common\Entity\Style\Style;

/**
 * Class PossiblyUpdatedStyle
 * Indicates if style is updated.
 * It allow to know if style registration must be done.
 */
class PossiblyUpdatedStyle
{
    private $style;
    private $isUpdated;

    /**
     * @param \Box\Spout\Common\Entity\Style\Style $style
     * @param bool $isUpdated
     */
    public function __construct($style, $isUpdated)
    {
        $this->style = $style;
        $this->isUpdated = $isUpdated;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function isUpdated()
    {
        return $this->isUpdated;
    }
}
