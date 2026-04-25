<?php
/**
 * The browse view file of roadmap module of ZenTaoPMS.
 * @copyright   Copyright 2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Hao Sun <sunhao@easycorp.ltd>
 * @package     roadmap
 * @link        https://www.zentao.net
 */
namespace zin;

$zooming  = isset($zooming) ? $zooming : 'month';
$userList = array();
if(!empty($users))
{
    foreach($users as $account => $realname)
    {
        $user = array();
        $user['key']   = $account;
        $user['label'] = $realname;
        $userList[]    = $user;
    }
}

featureBar
(
    btn
    (
        setID('fullScreenBtn'),
        setClass('mr-4'),
        set::type('ghost'),
        set::icon('fullscreen'),
        on::click()->call('enterGanttFullscreen'),
        $lang->programplan->full
    ),
    div
    (
        setClass('row items-center gap-2'),
        strong($lang->execution->gantt->format . '：'),
        radioList
        (
            set::name('zooming'),
            set::value($zooming),
            set::items($lang->roadmap->zooming),
            set::inline(),
            on::change()->call('zoomTasks', jsRaw('event.target.value'))
        )
    )
);

if(hasPriv('roadmap', 'create') && $config->vision == 'or')
{
    $toolbarItems = [];
    $toolbarItems[] = ['text' => $lang->roadmap->create, 'url' => createLink('roadmap', 'create', "productID={$productID}"), 'icon' => 'plus', 'type' => 'primary'];
    toolbar(set::items($toolbarItems));
}

$ganttFields = [];
$ganttFields['text'] = $lang->roadmap->name;
$ganttFields['status'] = $lang->roadmap->status;
$ganttFields['start_date'] = $lang->roadmap->begin;
$ganttFields['end_date'] = $lang->roadmap->end;
$ganttFields['requirements'] = $lang->roadmap->requirments;
if($config->vision == 'or') $ganttFields['actions'] = $lang->roadmap->actions;
if($product->type != 'normal') $ganttFields['branch'] = sprintf($lang->roadmap->branch, $lang->product->branchName[$product->type]);

div
(
    setClass('.gantt_container'),
    style::height('calc(100vh - 120px)'),
    zui::gantt
    (
        set::_id('ganttView'),
        set::height('100%'),
        set::zooming($zooming),
        set::ganttType($ganttType),
        set::productType($product->type),
        set::ganttFields($ganttFields),
        set::progressColor($lang->execution->gantt->progressColor),
        set::readonly(true),
        set::userList($userList),
        set::roadmaps(json_decode($roadmaps)),
        set::exts('zentao'),
        set::todayTips($lang->programplan->today),
        set::errors([
            'taskDrag' => $lang->programplan->error->taskDrag
        ]),
        set('$options', jsRaw('window.setGanttOptions'))
    )
);
