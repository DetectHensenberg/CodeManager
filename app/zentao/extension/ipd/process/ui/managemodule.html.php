<?php
namespace zin;

jsVar('moduleProcesses', $moduleProcesses);
jsVar('cannotDelete', $lang->process->cannotDelete);
jsVar('cannotDeleteWithName', $lang->process->cannotDeleteWithName);

$items[] = array('name' => 'id',   'label' => $lang->process->id, 'width' => '40px', 'required' => false, 'hidden' => true);
$items[] = array('name' => 'name', 'label' => $lang->process->moduleName, 'width' => '240px', 'required' => true);

$data = array();
foreach($modules as $id => $name)
{
    if(!$id) continue;
    $data[] = array('id' => $id, 'name' => trim($name, '/'), 'count' => isset($moduleProcesses[$id]) ? $moduleProcesses[$id]->count : 0);
}

$maxRows = !empty($data) ? count($data) + 1 : 5;
$batchFormOptions = array();
$batchFormOptions['actions'] = array('sort', 'add', 'delete');
formBatchPanel
(
    set::batchFormOptions($batchFormOptions),
    set::title($lang->process->manageModule),
    set::actionsText(''),
    set::data($data),
    set::sortable(true),
    set::items($items),
    set::onRenderRow(jsRaw('window.handleRenderRow')),
    set::maxRows($maxRows)
);