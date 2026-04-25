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

            foreach($testtask->productGroup as $builds)
            {
                $testtask->prowspan = count($builds);
                foreach($builds as $build)
                {
                    $testtaskInfo = clone $testtask;
                    $testtaskInfo->build         = $build->id;
                    $testtaskInfo->product       = data('product.id');
                    $testtaskInfo->project       = $build->project;
                    $testtaskInfo->buildName     = $build->name;
                    $testtaskInfo->projectName   = $build->projectName;
                    $testtaskInfo->executionName = $build->executionName;
                    $testtaskInfo->productName   = $build->productName;
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
