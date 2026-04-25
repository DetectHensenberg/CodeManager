<?php
namespace zin;

jsVar('content', $content);

formPanel(
    set::title($title),
    set::actions(array(array('text' => $lang->confirm, 'class' => 'primary', 'data-dismiss' => 'modal'))),
    div(setID('markdownContent'))
);
