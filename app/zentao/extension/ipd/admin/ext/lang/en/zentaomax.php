<?php
$lang->admin->toSetting       = 'Go to Setting';
$lang->admin->setModuleNotice = 'Please first open the "%s" feature in the "Feature Switch" to configure it.';

$lang->admin->menuList->feature['subMenu']['measure']     = array('link' => "Measurement|measurement|settips|", 'subModule' => 'sqlbuilder,measurement,report', 'links' => array('measurement|settips|', 'measurement|browse|', 'sqlbuilder|browsesqlview|', 'measurement|template|'));
$lang->admin->menuList->feature['subMenu']['meetingroom'] = array('link' => "Meeting Room|meetingroom|browse|", 'subModule' => 'meetingroom');

$lang->admin->menuList->feature['menuOrder']['45'] = 'measure';
$lang->admin->menuList->feature['menuOrder']['55'] = 'meetingroom';

if(helper::hasFeature('issue'))          $lang->admin->menuList->feature['tabMenu']['project']['issue']         = array('link' => "{$lang->issue->common}|custom|set|module=issue&fieldList=typeList", 'exclude' => 'custom');
if(helper::hasFeature('risk'))           $lang->admin->menuList->feature['tabMenu']['project']['risk']          = array('link' => "{$lang->risk->common}|custom|set|module=risk&fieldList=sourceList", 'exclude' => 'custom');
if(helper::hasFeature('opportunity'))    $lang->admin->menuList->feature['tabMenu']['project']['opportunity']   = array('link' => "{$lang->opportunity->common}|custom|set|module=opportunity&fieldList=sourceList", 'exclude' => 'custom');
if(helper::hasFeature('project_change')) $lang->admin->menuList->feature['tabMenu']['project']['projectchange'] = array('link' => "{$lang->projectchange->common}|custom|set|module=projectchange&fieldList=urgencyList", 'exclude' => 'custom');
if(helper::hasFeature('auditplan'))      $lang->admin->menuList->feature['tabMenu']['project']['nc']            = array('link' => "Test|custom|set|module=nc&fieldList=typeList", 'exclude' => 'custom');
$lang->admin->menuList->feature['tabMenu']['project']['estimate'] = array('link' => 'Estimate|custom|estimate|');
$lang->admin->menuList->feature['tabMenu']['project']['subject']  = array('link' => 'Subject|subject|browse|', 'subModule' => 'subject');

if(helper::hasFeature('issue'))          $lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['50'] = 'issue';
if(helper::hasFeature('risk'))           $lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['55'] = 'risk';
if(helper::hasFeature('opportunity'))    $lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['60'] = 'opportunity';
if(helper::hasFeature('project_change')) $lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['65'] = 'projectchange';
if(helper::hasFeature('auditplan'))      $lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['70'] = 'nc';

$lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['75'] = 'estimate';
$lang->admin->menuList->feature['tabMenu']['menuOrder']['project']['80'] = 'subject';

if(helper::hasFeature('deliverable'))
{
    $lang->admin->menuList->projectflow['childMenu']['deliverable'] = array('link' => 'Deliverable Category|deliverable|browse|id=%s', 'subModule' => ',tree,');
    $lang->admin->menuList->projectflow['menuOrder']['20'] = 'deliverable';
}

if(helper::hasFeature('process')) $lang->admin->menuList->projectflow['childMenu']['report'] = array('link' => 'Flow Report|workflowgroup|report|id=%s');
if(helper::hasFeature('auditplan') || helper::hasFeature('deliverable') || helper::hasFeature('cm') || helper::hasFeature('change')) $lang->admin->menuList->projectflow['childMenu']['setmodule'] = array('link' => 'Feature Switch|workflowgroup|setmodule|id=%s');
if(helper::hasFeature('process'))     $lang->admin->menuList->projectflow['childMenu']['process']  = array('link' => 'Process|process|browse|id=%s', 'subModule' => 'process,activity');
if(helper::hasFeature('auditplan'))   $lang->admin->menuList->projectflow['childMenu']['auditcl']  = array('link' => 'Auditcl|auditcl|browse|id=%s', 'subModule' => 'auditcl');
if(helper::hasFeature('deliverable')) $lang->admin->menuList->projectflow['childMenu']['review']   = array('link' => 'Review|review|admin|id=%s', 'subModule' => 'review,reviewcl');

$lang->admin->menuList->projectflow['menuOrder']['5'] = 'report';
$lang->admin->menuList->projectflow['menuOrder']['7'] = 'setmodule';
if(helper::hasFeature('process'))     $lang->admin->menuList->projectflow['menuOrder']['10'] = 'process';
if(helper::hasFeature('auditplan'))   $lang->admin->menuList->projectflow['menuOrder']['15'] = 'auditcl';
if(helper::hasFeature('deliverable')) $lang->admin->menuList->projectflow['menuOrder']['25'] = 'review';

if(helper::hasFeature('process'))
{
    $lang->admin->menuList->projectflow['childMenu']['process']['subMenu']['process']  = array('link' => 'Process|process|browse|id=%s', 'subModule' => 'process');
    $lang->admin->menuList->projectflow['childMenu']['process']['subMenu']['activity'] = array('link' => 'Activity|activity|browse|id=%s', 'subModule' => 'activity');
}

if(helper::hasFeature('deliverable'))
{
    $lang->admin->menuList->projectflow['childMenu']['review']['subMenu']['review']   = array('link' => 'Review|review|admin|id=%s');
    $lang->admin->menuList->projectflow['childMenu']['review']['subMenu']['cllist']   = array('link' => 'Review Checklist|reviewcl|browse|id=%s', 'subModule' => 'reviewcl', 'exclude' => 'reviewcl-setcategory');
    $lang->admin->menuList->projectflow['childMenu']['review']['subMenu']['category'] = array('link' => 'Review Category|reviewcl|setcategory|id=%s', 'subModule' => 'custom');
}

if(!helper::hasFeature('meeting'))    unset($lang->admin->menuList->feature['subMenu']['meetingroom'], $lang->admin->menuList->feature['menuOrder'][55]);
if(!helper::hasFeature('measrecord')) unset($lang->admin->menuList->feature['subMenu']['measure'],     $lang->admin->menuList->feature['menuOrder'][45]);
