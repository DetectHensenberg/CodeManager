<?php
/**
 * The detail view file of workflowgroup module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Gang Liu <liugang@chandao.com>
 * @package     workflowgroup
 * @link        https://www.zentao.net
 */
namespace zin;

/* 关闭总开关。 */
if(!helper::hasFeature('process'))
{
    div
    (
        setClass('dtable shadow ring rounded dtable-hover-row dtable-hover-col dtable-is-empty'),
        div
        (
            setClass('dtable-empty-tip'),
            div
            (
                setClass('row gap-4 items-center text-gray'),
                $lang->workflowgroup->noProcessTip
            )
        )
    );
    return;
}

/* 关闭项目流程开关。 */
if(!$hasProcess)
{
    $currentModuleName = $lang->process->common;
    include('../../../common/ext/ui/closefeaturenotice.html.php');
    return;
}

$html  = '<table class="table">';
$html .= '<thead>';
$html .= "<tr>";

foreach($lang->workflowgroup->reportThead as $key => $thead)
{
    if(!$hasDeliverable && in_array($key, ['deliverable', 'approval', 'reviewcl'])) continue;
    if(!$hasAuditplan && $key == 'auditcl') continue;
    $html .= "<th>{$thead}</th>";
}

$html .= "</tr>";
$html .= '</thead>';
$html .= '<tbody>';

foreach($report as $module => $processList)
{
    $moduleRowspan     = 0;
    $processRowspanMap = array();

    foreach($processList as $pid => $activityList)
    {
        $processRowspan = 0;
        foreach($activityList as $aid => $activity)
        {
            $activityRowspan = !empty($activity->deliverables) ? count($activity->deliverables) : 1;
            $processRowspan += $activityRowspan;
            $moduleRowspan  += $activityRowspan;
        }
        $processRowspanMap[$pid] = $processRowspan;
    }

    $isModuleFirstRow = true;
    foreach($processList as $pid => $activityList)
    {
        $isProcessFirstRow = true;
        foreach($activityList as $aid => $activity)
        {
            $activityRowspan = !empty($activity->deliverables) ? count($activity->deliverables) : 1;
            $isActivityFirstRow = true;
            $activity->optional = $activity->optional ? $activity->optional : 'yes';

            if($activity->deliverables && $hasDeliverable)
            {
                foreach($activity->deliverables as $deliverable)
                {
                    $html .= "<tr>";

                    if($isModuleFirstRow)
                    {
                        $html .= "<td rowspan='{$moduleRowspan}'>{$activity->moduleName}</td>";
                        $isModuleFirstRow = false;
                    }

                    if($isProcessFirstRow && $isActivityFirstRow)
                    {
                        $html .= "<td rowspan='{$processRowspanMap[$pid]}' class='text-center'>{$activity->pname}</td>";
                    }

                    $optional = zget($lang->activity->optionalList, $activity->optional, 'yes');
                    $icon     = $activity->optional == 'yes' ? "<i class='icon icon-crop text-primary' title='{$optional}'></i>" : "<i class='icon icon-crop-disabled text-primary' title='{$optional}'></i>";
                    if($isActivityFirstRow)
                    {
                        $html .= "<td rowspan='{$activityRowspan}' class='text-center'>{$activity->aname} {$icon}</td>";
                        if($hasAuditplan)
                        {
                            $auditclCount = hasPriv('auditcl', 'browse') ? html::a(createLink('auditcl', 'browse', "id={$groupID}&pid={$activity->pid}"), $activity->auditclCount) : $activity->auditclCount;
                            $html .= "<td rowspan='{$activityRowspan}' class='text-center'>{$auditclCount}</td>";
                        }
                        $isActivityFirstRow = false;
                    }

                    $trimmable = zget($lang->deliverable->trimmableList, $deliverable->trimmable, '1');
                    $icon      = $deliverable->trimmable == '1' ? "<i class='icon icon-crop text-primary' title='{$trimmable}'></i>" : "<i class='icon icon-crop-disabled text-primary' title='{$trimmable}'></i>";
                    $html .= "<td class='text-center'>{$deliverable->name} {$icon}</td>";
                    $html .= "<td class='text-center'>{$deliverable->flowName}</td>";
                    $param = $deliverable->aid ? "id={$groupID}&type=byreview&aid={$deliverable->aid}" : "id={$groupID}";
                    $reviewclCount = hasPriv('reviewcl', 'browse') ? html::a(createLink('reviewcl', 'browse', $param), $deliverable->reviewclCount) : $deliverable->reviewclCount;
                    $html .= "<td class='text-center'>{$reviewclCount}</td>";

                    $html .= "</tr>";
                }
            }
            else
            {
                $html .= "<tr>";

                if($isModuleFirstRow)
                {
                    $html .= "<td rowspan='{$moduleRowspan}'>{$activity->moduleName}</td>";
                    $isModuleFirstRow = false;
                }

                if($isProcessFirstRow)
                {
                    $html .= "<td rowspan='{$processRowspanMap[$pid]}' class='text-center'>{$activity->pname}</td>";
                }

                if(empty($activity->aname))
                {
                    $html .= "<td class='text-center'></td>";
                    if($hasAuditplan) $html .= "<td class='text-center'></td>";
                }
                else
                {
                    $optional = zget($lang->activity->optionalList, $activity->optional, 'yes');
                    $icon     = $activity->optional == 'yes' ? "<i class='icon icon-crop text-primary' title='{$optional}'></i>" : "<i class='icon icon-crop-disabled text-primary' title='{$optional}'></i>";

                    $html .= "<td class='text-center'>{$activity->aname} {$icon}</td>";

                    if($hasAuditplan)
                    {
                        $auditclCount = hasPriv('auditcl', 'browse') ? html::a(createLink('auditcl', 'browse', "id={$groupID}&pid={$activity->pid}"), $activity->auditclCount) : $activity->auditclCount;
                        $html .= "<td class='text-center'>{$auditclCount}</td>";
                    }
                }

                if($hasDeliverable)
                {
                    $html .= "<td class='text-center'></td>";
                    $html .= "<td class='text-center'></td>";
                    $html .= "<td class='text-center'></td>";
                }

                $html .= "</tr>";
            }

            $isProcessFirstRow = false;
        }
    }
}

$html .= '</tbody>';
$html .= '</table>';

h::css('.table td {border: 1px solid #ebedf3;}');
panel(html($html));
