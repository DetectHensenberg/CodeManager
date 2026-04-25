<?php
namespace zin;

query('#testtask')->each(function($node)
{
    $node->setProp('key', 'testtaskAssigntome');
    $node->setProp('plugins', array('cellspan'));
    $node->setProp('getCellSpan', jsRaw('window.getCellSpan'));
    $node->setProp('onRenderCell', jsRaw('window.onRenderCell'));

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
                    $testtaskInfo->build          = $build->id;
                    $testtaskInfo->product        = $build->product;
                    $testtaskInfo->buildName      = $build->name;
                    $testtaskInfo->projectName    = $build->projectName;
                    $testtaskInfo->executionName  = $build->executionName;
                    $testtaskInfo->productName    = $build->productName;
                    $testtaskInfo->executionBuild = $build->executionName . '/' . $build->name;
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
