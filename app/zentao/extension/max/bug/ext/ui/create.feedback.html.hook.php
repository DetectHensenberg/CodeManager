<?php
namespace zin;

$from      = data('from');
$fromType  = data('fromType');
$fromID    = data('fromID');
$productID = data('productID');

jsVar('fromID', $fromID);
jsVar('fromType', $fromType);

query('formGridPanel')->each(function($node)
{
    $feedback = data('feedback');
    $fromType = data('fromType');
    $fields   = $node->prop('fields');

    if($fromType == 'feedback')
    {
        $fields->field('feedback')->hidden()->value(data('feedbackID'));
        $fields->field('found')->hidden()->value($feedback->openedBy);
        $fields->field('feedbackBy')->value($feedback->feedbackBy)->readonly(true);
        $fields->field('notifyEmail')->value($feedback->notifyEmail)->readonly(true);
    }
    if($fromType == 'ticket') $fields->field('ticket')->hidden()->value(data('ticketID'));

    $node->setProp('fields', $fields);
});
