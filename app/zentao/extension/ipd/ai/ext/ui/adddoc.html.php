<?php
namespace zin;

$spaces = array();
if($from == 'teamknowledgelib') unset($lang->ai->knowledgeLibs->spaces['mine']);
foreach($lang->ai->knowledgeLibs->spaces as $space => $name)
{
    if($space == 'api' && hasPriv('api', 'index')) $spaces[$space] = $name;
    if($space != 'api' && hasPriv('doc', ($space === 'custom' ? 'team' : $space) . 'Space')) $spaces[$space] = $name;
}

$defaultSpace = !empty($spaces) ? array_keys($spaces)[0] : '';
$this->loadModel('doc');
$app->loadLang('api');

unset($config->doc->dtable->fieldList['actions']);
$cols = array();
foreach($config->doc->dtable->fieldList as $colName => $col)
{
    if(in_array($colName, array('objectName', 'module'))) continue;
    if($colName == 'id') $col['type'] = 'checkID';
    $col['sortType'] = false;
    $cols[$colName] = $col;
}

formPanel(setID('addDocForm'), set::title($title), set::actions(array()), on::init()->do('$(function() {setTimeout(toggleSpace, 50); });'), formGroup
(
    set::name('space'),
    set::label($lang->ai->knowledgeLibs->selectedSpace),
    set::control(array('type' => 'radioList', 'inline' => true)),
    set::items($spaces),
    set::value($defaultSpace),
    on::change('[name=space]', 'toggleSpace')
), formGroup
(
    setClass('api-type hidden'),
    set::label($lang->api->libType),
    radioList(set::name('apiType'), set::items($lang->api->libTypeList), set::value('product'), set::inline(true), on::change()->call('toggleApiType', jsRaw('event.target.value')))
), formGroup
(
    setClass('w-1/2 specific-space'),
    set::label($lang->ai->knowledgeLibs->space),
    picker
    (
        set::name('libParentID'),
        set::items(array()),
        set::value(''),
        on::change('[name=libParentID]', 'toggleLibParentID')
    )
), formGroup
(
    setClass('w-1/2'),
    set::label($lang->ai->knowledgeLibs->selectedDocLibrary),
    picker
    (
        set::name('libID'),
        set::items(array()),
        set::value(''),
        on::change('[name=libID]', 'toggleLibID')
    )
));
div(setClass('btns-type mt-4'), btn
(
    setClass('ghost rounded'),
    set::text($lang->ai->featureBar['adddoc']['all']),
    setData('id', 'all'),
    label(setClass('size-sm canvas ring-0 rounded-md'), 0),
    on::click()->call('toggleBrowseType', "all", jsRaw('this'))
), btn
(
    setClass('ghost rounded'),
    set::text($lang->ai->featureBar['adddoc']['draft']),
    setData('id', 'draft'),
    label(setClass('size-sm canvas ring-0 rounded-md hidden'), 0),
    on::click()->call('toggleBrowseType', "draft", jsRaw('this'))
));
dtable
(
    setID('docSelectTable'),
    set::cols($cols),
    set::data(array()),
    set::userMap($users),
    set::checkable(true),
    set::height(200),
    set::onCheckChange(jsRaw('window.checkedChange')),
    set::onRenderCell(jsRaw('window.renderDocCell')),
    set::footToolbar(array(array('text' => $lang->doc->insertText, 'data-on' => 'click', 'data-call' => "insertListToAI('#docSelectTable', 'doc')"))),
    set::footPager(usePager())
);
