<?php
/**
 * The ai prompt edit view file of ai module of ZenTaoPMS.
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
    ->value($prompt->name)
    ->width('full');

$fields->field('desc')
    ->label($lang->ai->prompts->description)
    ->control('textarea', array('rows' => 6))
    ->value($prompt->desc)
    ->width('full');

formGridPanel(set::title($title . '-' . $prompt->name), set::defaultMode('full'), set::modeSwitcher(false), set::size('sm'), set::submitBtnText($lang->save), set::fields($fields), on::inited()->call('window.initPromptForm'), on::input('[name="name"]')->call('window.changePromptName', jsRaw('event')));
