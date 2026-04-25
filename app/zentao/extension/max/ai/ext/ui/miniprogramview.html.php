<?php
namespace zin;

$fieldsTableProps = array('control' => 'dtable', 'data' => array(), 'cols' => array());
$fieldsTableProps['cols'][] = array('name' => 'name', 'title' => $lang->ai->miniPrograms->field->name, 'type' => 'shortTitle', 'sortType' => false);
$fieldsTableProps['cols'][] = array('name' => 'type', 'title' => $lang->ai->miniPrograms->field->type, 'type' => 'category', 'sortType' => false);
$fieldsTableProps['cols'][] = array('name' => 'options', 'title' => $lang->ai->miniPrograms->optionName, 'type' => 'shortTitle', 'sortType' => false);
$fieldsTableProps['cols'][] = array('name' => 'placeholder', 'title' => $lang->ai->miniPrograms->field->placeholder, 'flex' => 1);
$fieldsTableProps['cols'][] = array('name' => 'required', 'title' => $lang->ai->miniPrograms->field->required, 'width' => 80);

foreach ($fields as $field)
{
    $fieldsTableProps['data'][] = array
    (
        'name'        => $field->name,
        'type'        => $lang->ai->miniPrograms->field->typeList[$field->type],
        'options'     => empty($field->options) ? '-' : $field->options,
        'placeholder' => empty($field->placeholder) ? '-' : $field->placeholder,
        'required'    => $lang->ai->miniPrograms->field->requiredOptions[$field->required]
    );
}

$formatedPrompt = str_replace('&lt;', '<', $miniProgram->prompt);
$formatedPrompt = str_replace('&gt;', '>', $formatedPrompt);
$formatedPrompt = preg_replace('/<([^>]+)>/', '<strong><$1></strong>', $formatedPrompt);

list($iconName, $iconTheme) = explode('-', $miniProgram->icon);
$basicInfoProps = array('control' => 'datalist', 'items' => array());
$basicInfoProps['items'][$lang->ai->miniPrograms->category] = $categoryList[$miniProgram->category];
$basicInfoProps['items'][$lang->prompt->name] = $miniProgram->name;
$basicInfoProps['items'][$lang->ai->miniPrograms->desc] = array('content' => wg(div(set::title($miniProgram->desc), $miniProgram->desc)));
$basicInfoProps['items'][$lang->prompt->model] = array('content' => wg(zui::aiModelName($miniProgram->model)));
$basicInfoProps['items'][$lang->prompt->status] = $lang->ai->miniPrograms->publishedOptions[$miniProgram->published];
$basicInfoProps['items'][$lang->ai->miniPrograms->icon] = array
(
    'content' => wg(div(
        setClass('w-12 h-12 rounded-full border center'),
        setStyle(array('border' => "1px solid {$config->ai->miniPrograms->themeList[$iconTheme][1]}", 'background-color' => $config->ai->miniPrograms->themeList[$iconTheme][0])),
        html($config->ai->miniPrograms->iconList[$iconName]))
    )
);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();

$sections[] = setting()
    ->title($lang->ai->miniPrograms->fieldConfiguration)
    ->control($fieldsTableProps);

$sections[] = setting()
    ->title($lang->ai->miniPrograms->promptTemplate)
    ->control('html')
    ->content($formatedPrompt);

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->ai->prompts->basicInfo)
    ->control($basicInfoProps);

/* 右上角工具栏。 The top right toolbar. */
$isNotBuiltIn = $miniProgram->builtIn == '0';
$isPublished  = $miniProgram->published == '1';
$toolbar      = array();

if($isNotBuiltIn && $isPublished && hasPriv('ai', 'exportMiniProgram'))
{
    $toolbar[] = array('icon' => 'export', 'size' => 'md', 'type' => 'primary', 'text' => $lang->ai->export, 'className' => 'ajax-submit', 'download' => "{$miniProgram->name}.ztapp.zip", 'url' => createLink('ai', 'exportMiniProgram', "appID=$miniProgram->id"));
}
if(hasPriv('ai', 'createMiniProgram'))
{
    $toolbar[] = array('icon' => 'plus', 'size' => 'md', 'type' => 'primary', 'text' => $lang->ai->miniPrograms->create, 'url' => createLink('ai', 'createMiniProgram'));
}

/* 底部操作栏。 The bottom actions bar. */
$actions = array();
if($miniProgram->deleted !== '1')
{
    if($isPublished)
    {
        if(hasPriv('ai', 'unpublishMiniProgram')) $actions[] = array('icon' => 'ban-circle', 'text' => $lang->ai->prompts->action->unpublish, 'className' => 'ajax-submit', 'data-confirm' => array('message' => $lang->ai->miniPrograms->disableTip, 'icon' => 'icon-exclamation-sign icon-lg text-warning icon-2x opacity-100'), 'url' => createLink('ai', 'unpublishMiniProgram', "appID=$miniProgram->id"));
    }
    else
    {
        if($isNotBuiltIn && hasPriv('ai', 'editMiniProgram'))
        {
            $actions[] = array('icon' => 'edit', 'text' => $lang->ai->prompts->action->edit, 'url' => createLink('ai', 'editMiniProgram', "appID=$miniProgram->id"));
        }
        if($isNotBuiltIn && hasPriv('ai', 'testMiniProgram'))
        {
            $actions[] = array('icon' => 'menu-backend', 'text' => $lang->ai->prompts->action->test, 'data-toggle' => 'modal', 'data-size' => 'full', 'url' => createLink('ai', 'testMiniProgram', "appID=$miniProgram->id"));
        }
        if(hasPriv('ai', 'publishMiniProgram'))
        {
            $actions[] = array('icon' => 'publish', 'text' => $lang->ai->prompts->action->publish, 'className' => 'ajax-submit', 'data-confirm' => array('message' => $lang->ai->miniPrograms->publishTip, 'icon' => 'icon-exclamation-sign icon-lg text-warning icon-2x opacity-100'), 'url' => createLink('ai', 'publishMiniProgram', "appID=$miniProgram->id"));
        }
        if($isNotBuiltIn && hasPriv('ai', 'deleteMiniProgram'))
        {
            $actions[] = array('icon' => 'trash', 'text' => $lang->ai->prompts->action->delete, 'className' => 'ajax-submit', 'data-confirm' => array('message' => $lang->ai->miniPrograms->deleteTip, 'icon' => 'icon-exclamation-sign icon-lg text-warning icon-2x opacity-100'), 'url' => createLink('ai', 'deleteMiniProgram', "appID=$miniProgram->id&deleted=1"));
        }
    }
}

detail
(
    set::objectType('miniProgram'),
    set::object($miniProgram),
    set::sections($sections),
    set::tabs($tabs),
    set::toolbar(array('items' => $toolbar, 'gap' => 2)),
    set::actions(array_values($actions)),
    set::backBtn(array('back' => 'ai-miniPrograms'))
);
