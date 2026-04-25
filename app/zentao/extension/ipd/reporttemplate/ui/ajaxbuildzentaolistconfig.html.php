<?php
/**
 * The buildzentaoconfig view file of document module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Tingting Dai <daitingting@easycorp.ltd>
 * @package     doc 
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    setID('buildZentaoConfig'),
    set::action(inlink('ajaxBuildZentaoListConfig', "type={$type}&oldBlockID={$oldBlockID}")),
    set::ajax(array('beforeSubmit' => jsRaw('clickSubmitForZentaoConfig'))),
    set::title($lang->reporttemplate->filterList[$type]),
    to::titleSuffix
    (
        span
        (
            setClass('text-muted text-sm text-gray-600 font-light'),
            span(setClass('text-warning mr-1'), icon('help')),
            $lang->docTemplate->filterTip
        )
    ),
    formGroup
    (
        set::label($lang->docTemplate->searchTab),
        set::name('searchTab'),
        set::required(true),
        set::items($tabs),
        set::value($searchTab)
    ),
    $type == 'projectCase' ? formGroup
    (
        set::label($lang->testcase->stage),
        set::name('caseStage'),
        set::value($caseStage),
        set::items($lang->testcase->stageList)
    ) : null,
    formHidden('templateID', '')
);
