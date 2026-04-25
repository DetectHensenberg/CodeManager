<?php
global $config;
$lang->admin->property = new stdclass();
$lang->admin->property->companyName     = '公司名稱';
$lang->admin->property->startDate       = '授權時間';
$lang->admin->property->expireDate      = '授權到期時間';
$lang->admin->property->serviceDeadline = '技術服務到期時間';
$lang->admin->property->user            = '授權人數';
$lang->admin->property->ip              = '授權IP';
$lang->admin->property->mac             = '授權MAC';
$lang->admin->property->domain          = '授權域名';

$lang->admin->menuSetting['productflow']['name']   = '產品流程';
$lang->admin->menuSetting['productflow']['desc']   = '配置多種產品流程。';
$lang->admin->menuSetting['projectflow']['name']   = '項目流程';
$lang->admin->menuSetting['projectflow']['desc']   = '配置多種項目執行流程。';
$lang->admin->menuSetting['workflow']['name']      = '工作流';
$lang->admin->menuSetting['workflow']['desc']      = '配置全局通用的工作流。';
$lang->admin->menuSetting['approvalflow']['name']  = '審批流';
$lang->admin->menuSetting['approvalflow']['desc']  = '配置各類審批流程與規則。';

$lang->admin->menuList->productflow['name']  = $lang->admin->menuSetting['productflow']['name'];
$lang->admin->menuList->productflow['desc']  = $lang->admin->menuSetting['productflow']['desc'];
$lang->admin->menuList->productflow['link']  = 'workflowgroup|product';
$lang->admin->menuList->productflow['order'] = 70;
$lang->admin->menuList->productflow['group'] = 'flow';
$lang->admin->menuList->productflow['icon']  = 'product';
$lang->admin->menuList->productflow['bg']    = 'primary';

$lang->admin->menuList->productflow['subMenu']['flow']   = array('link' => "{$lang->admin->menuSetting['productflow']['name']}|workflowgroup|product");
$lang->admin->menuList->productflow['childMenu']['flow'] = array('link' => '工作流|workflowgroup|design|id=%s');

$lang->admin->menuList->productflow['menuOrder']['5']  = 'view';
$lang->admin->menuList->productflow['menuOrder']['10'] = 'classify';
$lang->admin->menuList->productflow['menuOrder']['15'] = 'auditcl';
$lang->admin->menuList->productflow['menuOrder']['25'] = 'reviewcl';
$lang->admin->menuList->productflow['menuOrder']['30'] = 'flow';

$lang->admin->menuList->projectflow['name']  = $lang->admin->menuSetting['projectflow']['name'];
$lang->admin->menuList->projectflow['desc']  = $lang->admin->menuSetting['projectflow']['desc'];
$lang->admin->menuList->projectflow['link']  = 'workflowgroup|project';
$lang->admin->menuList->projectflow['order'] = 71;
$lang->admin->menuList->projectflow['group'] = 'flow';
$lang->admin->menuList->projectflow['icon']  = 'project';
$lang->admin->menuList->projectflow['bg']    = 'special';

$lang->admin->menuList->projectflow['subMenu']['flow']     = array('link' => "{$lang->admin->menuSetting['projectflow']['name']}|workflowgroup|project");
$lang->admin->menuList->projectflow['childMenu']['stage']  = array('link' => "{$lang->stage->list}|stage|browse|id=%s", 'subModule' => 'stage');
$lang->admin->menuList->projectflow['childMenu']['flow']   = array('link' => '工作流|workflowgroup|design|id=%s');

$lang->admin->menuList->projectflow['dividerMenu'] = ',process,flow,';

$lang->admin->menuList->projectflow['menuOrder']['24'] = 'stage';
$lang->admin->menuList->projectflow['menuOrder']['30'] = 'flow';

$lang->admin->menuList->workflow['name']  = $lang->admin->menuSetting['workflow']['name'];
$lang->admin->menuList->workflow['desc']  = $lang->admin->menuSetting['workflow']['desc'];
$lang->admin->menuList->workflow['link']  = 'workflow|browseFlow';
$lang->admin->menuList->workflow['order'] = 72;
$lang->admin->menuList->workflow['group'] = 'flow';
$lang->admin->menuList->workflow['icon']  = 'flow';
$lang->admin->menuList->workflow['bg']    = 'success';

$lang->admin->menuList->workflow['subMenu']['flow']         = array('link' => '工作流|workflow|browseflow|', 'subModule' => 'workflowaction,workflowcondition,workflowlabel,workflowlayout,workflowlinkage,workflowhook');
$lang->admin->menuList->workflow['subMenu']['datasource']   = array('link' => '數據源|workflowdatasource|browse|');
$lang->admin->menuList->workflow['subMenu']['workflowrule'] = array('link' => '驗證規則|workflowrule|browse|');

$lang->admin->menuList->workflow['menuOrder']['5']  = 'flow';
$lang->admin->menuList->workflow['menuOrder']['10'] = 'flowgroup';
$lang->admin->menuList->workflow['menuOrder']['15'] = 'datasource';
$lang->admin->menuList->workflow['menuOrder']['20'] = 'workflowrule';

$lang->admin->menuList->approvalflow['name']  = $lang->admin->menuSetting['approvalflow']['name'];
$lang->admin->menuList->approvalflow['desc']  = $lang->admin->menuSetting['approvalflow']['desc'];
$lang->admin->menuList->approvalflow['link']  = 'approvalflow|browse';
$lang->admin->menuList->approvalflow['order'] = 73;
$lang->admin->menuList->approvalflow['group'] = 'flow';
$lang->admin->menuList->approvalflow['icon']  = 'review';
$lang->admin->menuList->approvalflow['bg']    = 'important';

$lang->admin->menuList->system['subMenu']['libreoffice'] = array('link' => 'Office|custom|libreoffice|');
$lang->admin->menuList->system['menuOrder']['60']        = 'libreoffice';

$lang->admin->menuList->feature['subMenu']['feedback'] = array('link' => "反饋|custom|required|module=feedback", 'exclude' => 'set,required');
$lang->admin->menuList->feature['menuOrder']['35']     = 'feedback';

$lang->admin->menuList->feature['tabMenu']['feedback']['feedback'] = array('link' => "反饋|custom|required|module=feedback", 'links' => array('custom|set|module=feedback&field=review'), 'exclude' => 'custom-set,custom-required');
$lang->admin->menuList->feature['tabMenu']['feedback']['ticket']   = array('link' => "工單|custom|required|module=ticket", 'exclude' => 'custom-set,custom-required');

if($config->vision == 'lite') unset($lang->admin->menuList->feature['subMenu']['feedback'], $lang->admin->menuList->feature['menuOrder']['35']);

$lang->admin->menuList->feature['subMenu']['relation'] = array('link' => "關聯關係|custom|browseRelation|", 'alias' => 'browserelation');
$lang->admin->menuList->feature['menuOrder']['41']     = 'relation';
$lang->admin->menuList->feature['dividerMenu']         = ',relation,';

if($config->systemMode != 'light' && $config->vision != 'lite' && ($config->edition == 'ipd' || helper::hasFeature('program')))
{
    $lang->admin->menuList->feature['subMenu']['charter'] = array('link' => "立項|custom|setCharterInfo|", 'alias' => 'setcharterinfo');
    $lang->admin->menuList->feature['menuOrder']['6']     = 'charter';
}
