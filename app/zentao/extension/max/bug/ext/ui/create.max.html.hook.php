<?php
namespace zin;

global $lang;
query('formGridPanel')->each(function($node) use($lang)
{
    $lang   = data('lang');
    $fields = $node->prop('fields');

    $fields->field('injection')
        ->foldable()
        ->control('picker')
        ->items($lang->bug->injectionList);

    $fields->field('identify')
         ->foldable()
         ->control('picker')
         ->items($lang->bug->identifyList);

    $fields->orders('task,injection,identify');
    $node->setProp('fields', $fields);
});
