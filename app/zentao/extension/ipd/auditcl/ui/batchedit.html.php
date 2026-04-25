<?php
namespace zin;

jsVar('groupID', $groupID);

$form  = "<div class='panel panel-form panel-form-batch size-lg shadow' style='--zt-panel-form-max-width: auto;'>";
$form .= "<div class='panel-heading'><div class='panel-title text-lg'>{$lang->auditcl->batchEdit}</div></div>";
$form .= "<div class='panel-body'>";
$form .= "<form class='load-indicator main-form' method='post' id='batchEditForm'>";
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
    $processName = '';
    foreach($activityGroup as $auditcl)
    {
        $processName = current($auditcl)->processName;
        break;
    }

    $rowspan = count($activityGroup) + 1;

    $form .= "<tr>";
    $form .= "<td id='process{$processID}' rowspan='{$rowspan}'>{$processName}</td>";
    $form .= "</tr>";

    foreach($activityGroup as $activityID => $auditclList)
    {
        $activityName = current($auditclList)->activityName;

        $form .= "<tr>";
        $form .= "<td>{$activityName}</td>";
        $form .= "<td>";
        foreach($auditclList as $auditcl)
        {
            $form .= "<div class='title-{$activityID} item flex activity-title'>";
            $form .= html::input("title[{$auditcl->id}]", $auditcl->title, 'class="form-control check-title"');
            $form .= "</div>";
        }
        $form .= "</td>";
        $form .= "</tr>";
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