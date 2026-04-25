<?php
namespace zin;

global $lang;

jsVar('currentMethod', 'create');

$model         = data('model');
$copyProjectID = data('copyProjectID');
$charter       = data('charter');

query('formGridPanel')->each(function($node) use($lang, $charter)
{
    $fields = $node->prop('fields');

    if(data('model') != 'kanban')
    {
        $fields->field('budget')
            ->foldable(false)
            ->moveAfter('workflowGroup');

        if(data('model') == 'ipd') $fields->moveAfter('workflowGroup', 'charter');
        $fields->orders('workflowGroup,budget');

        $fields->autoLoad('workflowGroup');
    }

    $fields->field('hasProduct')->hidden(true);
    $node->setProp('fields', $fields);
});
