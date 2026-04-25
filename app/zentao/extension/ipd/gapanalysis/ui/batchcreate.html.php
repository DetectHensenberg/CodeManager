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

jsVar('roles', $rolePairs);
jsVar('errorSameAccount', $lang->gapanalysis->errorSameAccount);

/* ====== Define the page structure with zin widgets ====== */
formBatchPanel(set::id('gapanalysisBatchCreateForm'), set::title($lang->gapanalysis->batchCreate), set::headingActionsClass('flex-auto row-reverse justify-between w-11/12'), formBatchItem
(
    set::name('account'),
    set::label($lang->gapanalysis->account),
    set::control('picker'),
    set::items($members),
    set::width('240px')
), formBatchItem
(
    set::name('role'),
    set::label($lang->gapanalysis->role),
    set::disabled(true),
    set::width('240px')
), formBatchItem
(
    set::name('analysis'),
    set::label($lang->gapanalysis->analysis),
    set::control('textarea'),
    set::value('')
), formBatchItem
(
    set::name('needTrain'),
    set::label($lang->gapanalysis->needTrain),
    set::control('picker'),
    set::items($lang->gapanalysis->needTrainList),
    set::ditto(true),
    set::value('no')
), on::change('[data-name="account"]', 'refreshRole'));

/* ====== Render page ====== */
render();
