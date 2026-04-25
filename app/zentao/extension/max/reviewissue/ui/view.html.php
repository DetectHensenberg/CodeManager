<?php
/**
 * The resolved view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

$operateList = $this->loadModel('common')->buildOperateMenu($issue);
$actions     = array();
if(!$issue->deleted)
{
    $actions = $operateList['mainActions'];
    if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, array(array('type' => 'divider')), $operateList['suffixActions']);
}

$items = array();
$items[$lang->reviewissue->review] = hasPriv('review', 'view') ? array
    (
        'control'  => 'link',
        'url'      => createLink('review', 'view', "id={$issue->review}"),
        'text'     => $issue->reviewTitle,
        'title'    => $issue->reviewTitle,
        'data-app' => 'project'
    ) : $issue->reviewTitle;
$items[$lang->reviewissue->title]      = $issue->title;
$items[$lang->reviewissue->status]     = zget($lang->reviewissue->statusList, $issue->status);
$items[$lang->reviewissue->assignedTo] = empty($issue->assignedTo) ? '' : zget($users, $issue->assignedTo) . $lang->at . $issue->assignedDate;
$items[$lang->reviewissue->createdBy]  = zget($users, $issue->createdBy) . $lang->at . $issue->createdDate;

$tabs = array();
$tabs[] = setting()->group('basic')
    ->title($lang->reviewissue->issueInfo)
    ->control('datalist')
    ->items($items);

$issue->title = $issue->opinion;
detail
(
    set::urlFormatter(array('{id}' => $issue->id, '{project}' => $issue->project, '{status}' => $issue->status)),
    set::backBtn(array('back' => ',reviewissue-issue,')),
    set::object($issue),
    set::sections(array()),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
