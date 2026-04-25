<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlotArea
{
    /**
     * PlotArea Layout.
     *
     * @var Layout
     */
    private $layout;

    /**
     * Plot Series.
     *
     * @var DataSeries[]
     */
    private $plotSeries = [];

    /**
     * Create a new PlotArea.
     *
     * @param null|Layout $layout
     * @param DataSeries[] $plotSeries
     */
    public function __construct($layout = null, $plotSeries = [])
    {
        $this->layout = $layout;
        $this->plotSeries = $plotSeries;
    }

    /**
     * Get Layout.
     *
     * @return Layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Get Number of Plot Groups.
     *
     * @return array of DataSeries
     */
    public function getPlotGroupCount()
    {
        return count($this->plotSeries);
    }

    /**
     * Get Number of Plot Series.
     *
     * @return int
     */
    public function getPlotSeriesCount()
    {
        $seriesCount = 0;
        foreach ($this->plotSeries as $plot) {
            $seriesCount += $plot->getPlotSeriesCount();
        }

        return $seriesCount;
    }

    /**
     * Get Plot Series.
     *
     * @return array of DataSeries
     */
    public function getPlotGroup()
    {
        return $this->plotSeries;
    }

    /**
     * Get Plot Series by Index.
     *
     * @param mixed $index
     *
     * @return DataSeries
     */
    public function getPlotGroupByIndex($index)
    {
        return $this->plotSeries[$index];
    }

    /**
     * Set Plot Series.
     *
     * @param DataSeries[] $plotSeries
     *
     * @return PlotArea
     */
    public function setPlotSeries($plotSeries)
    {
        $this->plotSeries = $plotSeries;

        return $this;
    }

    /**
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet
     */
    public function refresh($worksheet)
    {
        foreach ($this->plotSeries as $plotSeries) {
            $plotSeries->refresh($worksheet);
        }
    }
}
