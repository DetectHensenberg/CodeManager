<?php
namespace zin;

global $app;
query('formBatchPanel')->each(function($node) use($app)
{
    $items = $node->prop('items');
    foreach($items as $index => $item)
    {
        if(($app->tab == 'project' || $app->tab == 'execution') && ($item['name'] == 'module' || $item['name'] == 'scene')) $items[$index]['hidden'] = true;
    }
    $node->setProp('items', $items);
});
