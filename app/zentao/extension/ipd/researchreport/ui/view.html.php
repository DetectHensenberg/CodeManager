<?php
/**
 * The view view file of researchreport module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     researchreport
 * @link        https://www.zentao.net
 */
namespace zin;

$operateList = !$report->deleted ? $this->loadModel('common')->buildOperateMenu($report) : array();
$actions     = !empty($operateList['suffixActions']) ? $operateList['suffixActions'] : array();

$basicInfoItems = array();
$basicInfoItems[$lang->researchreport->author]          = array('control' => 'text', 'text' => zget($users, $report->author));
$basicInfoItems[$lang->researchreport->relatedPlan]     = array('control' => 'link', 'text' => zget($planPairs, $report->relatedPlan), 'url' => hasPriv('researchplan', 'view') ? createLink('researchplan', 'view', "planID=$report->relatedPlan") : '');
$basicInfoItems[$lang->researchreport->customer]        = array('control' => 'text', 'text' => $report->customer);
$basicInfoItems[$lang->researchreport->researchObjects] = array('control' => 'text', 'text' => $report->researchObjects);
$basicInfoItems[$lang->researchreport->researchTime]    = array('control' => 'text', 'text' => (!helper::isZeroDate($report->begin) and !helper::isZeroDate($report->end)) ? substr($report->begin, 0, 16) . ' ~ ' . substr($report->end, 0, 16) : '');
$basicInfoItems[$lang->researchreport->location]        = array('control' => 'text', 'text' => $report->location);
$basicInfoItems[$lang->researchreport->method]          = array('control' => 'text', 'text' => zget($lang->researchreport->methodList, $report->method));
$basicInfo = datalist
(
    set::className('researchreport-basic-info'),
    set::items($basicInfoItems)
);

$lifeTimeItems = array();
$lifeTimeItems[$lang->researchreport->createdBy]   = array('control' => 'text', 'text' => zget($users, $report->createdBy));
$lifeTimeItems[$lang->researchreport->createdDate] = array('control' => 'text', 'text' => $report->createdDate);
$lifeTimeItems[$lang->researchreport->editedBy]    = array('control' => 'text', 'text' => zget($users, $report->editedBy));
$lifeTimeItems[$lang->researchreport->editedDate]  = array('control' => 'text', 'text' => helper::isZeroDate($report->editedDate) ? '' : $report->editedDate);
$lifeTime = datalist
(
    set::className('researchreport-lift-item'),
    set::items($lifeTimeItems)
);

$URItems = array();
foreach($relatedUR as $id => $title)
{
    $URText = '#' . $id . ' ' . $title;
    $URItems[] = (object)array('id' => $id, 'title' => $URText);
}

$canViewUR = hasPriv('requirement', 'view');
$relativeItems[] = array('title' => $lang->researchreport->legendFromUR, 'hint' => $lang->researchreport->legendFromUR, 'items' => $URItems, 'url' => $canViewUR ? createLink('requirement', 'view', "id={id}") : null, 'data-toggle' => 'modal', 'data-size' => 'lg');

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->researchreport->basicInfo)
    ->children(wg($basicInfo));

$tabs[] = setting()
    ->group('basic')
    ->title($lang->researchreport->lifeTime)
    ->children(wg($lifeTime));

$tabs[] = setting()
    ->group('relatives')
    ->title($lang->researchreport->legendRelated)
    ->control('relatedList')
    ->showIDLabel(false)
    ->data($relativeItems);

$sections = array();
$sections[] = setting()
    ->title($lang->researchreport->content)
    ->control('html')
    ->content($report->content);

detail
(
    set::objectType('report'),
    set::objectID($report->id),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
