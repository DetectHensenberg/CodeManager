<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConditionalStyles
{
    private $worksheet;

    private $worksheetXml;

    private $dxfs;

    /**
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $workSheet
     * @param \SimpleXMLElement $worksheetXml
     * @param mixed[] $dxfs
     */
    public function __construct($workSheet, $worksheetXml, $dxfs = [])
    {
        $this->worksheet = $workSheet;
        $this->worksheetXml = $worksheetXml;
        $this->dxfs = $dxfs;
    }

    public function load()
    {
        $this->setConditionalStyles(
            $this->worksheet,
            $this->readConditionalStyles($this->worksheetXml)
        );
    }

    private function readConditionalStyles($xmlSheet)
    {
        $conditionals = [];
        foreach ($xmlSheet->conditionalFormatting as $conditional) {
            foreach ($conditional->cfRule as $cfRule) {
                if (((string) $cfRule['type'] == Conditional::CONDITION_NONE
                    || (string) $cfRule['type'] == Conditional::CONDITION_CELLIS
                    || (string) $cfRule['type'] == Conditional::CONDITION_CONTAINSTEXT
                    || (string) $cfRule['type'] == Conditional::CONDITION_EXPRESSION)
                    && isset($this->dxfs[(int) ($cfRule['dxfId'])])) {
                    $conditionals[(string) $conditional['sqref']][(int) ($cfRule['priority'])] = $cfRule;
                }
            }
        }

        return $conditionals;
    }

    /**
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet
     * @param mixed[] $conditionals
     */
    private function setConditionalStyles($worksheet, $conditionals)
    {
        foreach ($conditionals as $ref => $cfRules) {
            ksort($cfRules);
            $conditionalStyles = $this->readStyleRules($cfRules);

            // Extract all cell references in $ref
            $cellBlocks = explode(' ', str_replace('$', '', strtoupper($ref)));
            foreach ($cellBlocks as $cellBlock) {
                $worksheet->getStyle($cellBlock)->setConditionalStyles($conditionalStyles);
            }
        }
    }

    private function readStyleRules($cfRules)
    {
        $conditionalStyles = [];
        foreach ($cfRules as $cfRule) {
            $objConditional = new Conditional();
            $objConditional->setConditionType((string) $cfRule['type']);
            $objConditional->setOperatorType((string) $cfRule['operator']);

            if ((string) $cfRule['text'] != '') {
                $objConditional->setText((string) $cfRule['text']);
            }

            if (isset($cfRule['stopIfTrue']) && (int) $cfRule['stopIfTrue'] === 1) {
                $objConditional->setStopIfTrue(true);
            }

            if (count($cfRule->formula) > 1) {
                foreach ($cfRule->formula as $formula) {
                    $objConditional->addCondition((string) $formula);
                }
            } else {
                $objConditional->addCondition((string) $cfRule->formula);
            }
            $objConditional->setStyle(clone $this->dxfs[(int) ($cfRule['dxfId'])]);
            $conditionalStyles[] = $objConditional;
        }

        return $conditionalStyles;
    }
}
