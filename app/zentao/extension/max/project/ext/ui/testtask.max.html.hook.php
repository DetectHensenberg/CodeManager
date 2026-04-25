<?php
namespace zin;

query('dtable')->each(function($node)
{
    $node->setProp('plugins', array('cellspan'));
    $node->setProp('getCellSpan', jsRaw('window.getCellSpan'));
    $data = $node->prop('data');

    $testtasks = array();
    foreach($data as $testtask)
    {
        if($testtask->joint && !empty($testtask->productGroup))
        {
            $trowspan = 0;
            foreach($testtask->productGroup as $builds) $trowspan += count($builds);
            $testtask->trowspan = $trowspan;

            $index = 0;
            foreach($testtask->productGroup as $builds)
            {
                $testtask->prowspan = count($builds);
                foreach($builds as $build)
                {
                    $testtaskInfo = clone $testtask;
                    $testtaskInfo->build         = $build->id;
                    $testtaskInfo->product       = $build->product;
                    $testtaskInfo->project       = data('projectID');
                    $testtaskInfo->buildName     = $build->name;
                    $testtaskInfo->projectName   = $build->projectName;
                    $testtaskInfo->executionName = $build->executionName;
                    $testtaskInfo->productName   = $build->productName;

                    if($index > 0) $testtaskInfo->id .= '_' . $build->id;
                    $index ++;

                    $testtasks[] = $testtaskInfo;
                }
            }
        }
        else
        {
            $testtasks[] = $testtask;
        }
    }
    $node->setProp('data', $testtasks);
});
