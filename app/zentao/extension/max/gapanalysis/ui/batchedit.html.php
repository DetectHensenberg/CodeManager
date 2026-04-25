<?php
/**
 * The select template view file of doc module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yue Liu<liuyue@chandao.com>
 * @package     gapanalysis
 * @link        https://www.zentao.net
 */
namespace zin;

/* ====== Define the page structure with zin widgets ====== */
formBatchPanel
(
    set::id('gapanalysisBatchEditForm'),
    set::title($lang->gapanalysis->batchEdit),
    set::mode('edit'),
    set::data(array_values($gapanalysises)),
    formBatchItem
    (
        set::name('id'),
        set::label($lang->idAB),
        set::control('hidden'),
        set::hidden(true)
    ),
    formBatchItem
    (
        set::name('id'),
        set::label($lang->idAB),
        set::control('index'),
        set::width('64px')
    ),
    formBatchItem
    (
        set::name('realname'),
        set::label($lang->gapanalysis->account),
        set::disabled(true)
    ),
    formBatchItem
    (
        set::name('account'),
        set::label($lang->gapanalysis->account),
        set::hidden(true)
    ),
    formBatchItem
    (
        set::name('role'),
        set::label($lang->gapanalysis->role),
        set::disabled(true)
    ),
    formBatchItem
    (
        set::name('needTrain'),
        set::label($lang->gapanalysis->needTrain),
        set::control('picker'),
        set::items($lang->gapanalysis->needTrainList)
    )
);

/* ====== Render page ====== */
render();
