<?php
/**
 * The diff file of cm module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     cm
 * @link        https://www.zentao.net
 */
namespace zin;
jsVar('projectID', $projectID);

if(isset($deliverables))
{
    jsVar('baseline',  $baseline);
    featureBar
    (
        to::leading(backBtn
        (
            set::icon('back'),
            set::type('secondary'),
            set::url(createLink('cm', 'browse', "projectID={$projectID}")),
            $lang->goback
        )),
        set::current('diff'),
        set::linkParams("projectID={$projectID}&baseline={$baseline}"),
        checkbox(set::rootClass('ml-2'), set::text($lang->cm->onlyChanges), set::checked($onlyChanges), setData(array('on' => 'change', 'call' => 'showOnlyChanges', 'params' => 'event')))
    );
    $index = 0;
    foreach($baselines as $baseline)
    {
        $index ++;
        $field = "baseline$index";
        $config->cm->diff->dtable->fieldList[$field]['title'] = "{$baseline->title} [{$baseline->version}]";
    }
    dtable
    (
        set::cols(array_values($config->cm->diff->dtable->fieldList)),
        set::data(array_values($deliverables)),
        set::onRenderCell(jsRaw('window.onRenderCell')),
        set::emptyTip($lang->cm->emptyDiff)
    );
}
else
{
    formPanel
    (
        set::title($title),
        set::layout('horz'),
        formGroup
        (
            set::label($lang->cm->baseline . '1'),
            set::required(true),
            set::control(array('control' => 'picker', 'items' => $baselines, 'shareSelections' => 'baseline', 'required' => false)),
            set::name('baseline1')
        ),
        formGroup
        (
            set::label($lang->cm->baseline . '2'),
            set::required(true),
            set::control(array('control' => 'picker', 'items' => $baselines, 'shareSelections' => 'baseline', 'required' => false)),
            set::name('baseline2')
        )
    );
}
