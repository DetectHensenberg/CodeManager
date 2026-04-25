<?php
/**
 * The ai createPrompt view file of ai module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Zemei Wang <wangzemei@easycorp.ltd>
 * @package     ai
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = defineFieldList('ai.createPrompt');

$fields->field('name')
    ->label($lang->ai->prompts->name)
    ->control('input')
    ->required(true)
    ->width('full');

$fields->field('desc')
    ->label($lang->ai->prompts->description)
    ->control('textarea', array('rows' => 6))
    ->width('full');

formGridPanel(set::title($title), set::defaultMode('full'), set::modeSwitcher(false), set::size('sm'), set::submitBtnText($lang->ai->nextStep), set::fields($fields), on::inited()->call('window.initPromptForm'), on::input('[name="name"]')->call('window.changePromptName', jsRaw('event')));
