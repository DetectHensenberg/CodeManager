<?php
namespace zin;

jsVar('groupID', $groupID);

$form  = "<div class='panel panel-form panel-form-batch size-lg shadow' style='--zt-panel-form-max-width: auto;'>";
$form .= "<div class='panel-heading'><div class='panel-title text-lg'>{$lang->auditcl->batchCreate}</div></div>";
$form .= "<div class='panel-body'>";
$form .= "<form class='load-indicator main-form' method='post' id='batchCreateForm'>";
$form .= "<table class='table table-bordered'>";
$form .= "<thead>";
$form .= "<tr>";
$form .= "<th>{$lang->auditcl->process}<span class='required'></span></th>";
$form .= "<th>{$lang->auditcl->activity}<span class='required'></span></th>";
$form .= "<th>{$lang->auditcl->title}<span class='required'></span></th>";
$form .= "</tr>";
$form .= "</thead>";
$form .= "<tbody id='formlist'>";

foreach($processGroup as $processID => $activityGroup)
{
    $rowspan     = count($activityGroup) + 1;
    $processName = current($activityGroup)->processName;

    $form .= "<tr>";
    $form .= "<td id='process{$processID}' rowspan='{$rowspan}'>{$processName}</td>";
    $form .= "</tr>";

    $index = 0;
    foreach($activityGroup as $activityID => $activity)
    {
        $form .= "<tr>";
        $form .= "<td>{$activity->activityName}</td>";
        $form .= "<td>";
        $form .= "<div class='title-{$activityID}-{$index}-activity item flex activity-title'>";
        $form .= html::input("title[{$activityID}][]", '', 'class="form-control check-title"');
        $form .= "<a href='javascript:;' class='btn btn-link' onclick='addTitle(\"{$activityID}-{$index}-activity\", this)'><i class='icon icon-plus'></i></a>";
        $form .= "<a href='javascript:;' class='btn btn-link' onclick='delTitle(this)'><i class='icon icon-trash'></i></a>";
        $form .= "</div>";
        $form .= "</td>";
        $form .= "</tr>";

        $index++;
    }
}

$form .= "</tbody>";
$form .= "<tfoot>";
$form .= "</tfoot>";
$form .= "</table>";
$form .= "<div class='toolbar form-actions form-group no-label'>";
$form .= "<button class='toolbar-item btn primary' type='submit'><span class='text'>" . $lang->save . "</span></button>";
$form .= "<button class='toolbar-item btn open-url' type='button' data-back='auditcl-browse'><span class='text'>" . $lang->goback . "</span></button>";
$form .= "</div>";
$form .= "</form>";
$form .= "</div>";
$form .= "</div>";

html($form);