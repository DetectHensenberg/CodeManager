<?php
namespace zin;

global $lang;

jsVar('currentMethod', 'edit');

$projectID = data('projectID');
$from      = data('from');
$programID = data('programID');
query('formGridPanel')->each(function($node) use($lang)
{
    $fields = $node->prop('fields');

    $fields->field('hasProduct')->hidden(true);

    $fields->field('budget')
        ->foldable(false)
        ->moveAfter('charter');

    $fields->orders('workflowGroup,budget');

    $fields->autoLoad('workflowGroup', 'productsBox');
    $node->setProp('fields', $fields);
});

query('.categoryBox .picker-box')->on('change', jsCallback()->call('changeCategory'));
