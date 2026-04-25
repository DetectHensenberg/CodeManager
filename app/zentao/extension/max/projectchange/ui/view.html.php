<?php
/**
 * The view file of projectchange module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     projectchange
 * @link        https://www.zentao.net
 */
namespace zin;

$operateList = $this->loadModel('common')->buildOperateMenu($projectchange);
$actions     = $operateList['mainActions'];
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $actions ? array(array('type' => 'divider')) : array(), $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()->title($lang->projectchange->deliverable)->control(array('control' => 'dtable', 'cols' => array_values($config->projectchange->deliverable->dtable->fieldList), 'data' => array_values($deliverables), 'userMap' => $users));
$sections[] = setting()->title($lang->projectchange->reason)->control('html')->content($projectchange->reason);
$sections[] = setting()->title($lang->projectchange->desc)->control('html')->content($projectchange->desc);
if(!empty($projectchange->files)) $sections[] = setting()->control('fileList')->files($projectchange->files)->object($projectchange)->padding(false);

$items = array();
$items[$lang->projectchange->urgency]   = zget($lang->projectchange->urgencyList, $projectchange->urgency, $projectchange->urgency);
$items[$lang->projectchange->type]      = zget($lang->projectchange->typeList, $projectchange->type, $projectchange->type);
$items[$lang->projectchange->owner]     = zget($users, $projectchange->owner, '');
$items[$lang->projectchange->status]    = zget($lang->projectchange->statusList, $projectchange->status, '');
$items[$lang->projectchange->deadline]  = substr($projectchange->deadline, 0, 10);
$items[$lang->projectchange->createdBy] = zget($users, $projectchange->createdBy) . (formatTime($projectchange->createdDate) ? $lang->at . $projectchange->createdDate : '');

$tabs[] = setting()
    ->group('basic')
    ->title($lang->projectchange->basicInfo)
    ->control('datalist')
    ->items($items)
    ->labelWidth(80);

detail
(
    set::object($projectchange),
    set::urlFormatter(array('{id}' => $projectchange->id, '{approval}' => $projectchange->approval, '{reviewID}' => $projectchange->reviewID)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions)),
    set::backBtn(array('url' => createLink('projectchange', 'browse', "projectID={$projectchange->project}")))
);
