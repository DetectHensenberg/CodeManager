<?php
$lang->action->label->service    = 'Service|service|view|id=%s';
$lang->action->label->serverroom = 'IDC|serverroom|browse|';
$lang->action->label->host       = 'Host|host|view|id=%s';
$lang->action->label->vm         = 'Virtual Machine|vm|view|id=%s';
$lang->action->label->vmtemplate = 'Virtual Template';
$lang->action->label->deploy     = 'Deploy|deploy|view|id=%s';
$lang->action->label->deploystep = 'Deploy Step|deploy|viewStep|id=%s';
$lang->action->label->account    = "Account|account|view|id=%s";
$lang->action->label->domain     = "Domain|domain|view|id=%s";

$lang->action->objectTypes['service']    = 'Service';
$lang->action->objectTypes['serverroom'] = 'IDC';
$lang->action->objectTypes['host']       = 'Host';
$lang->action->objectTypes['deploy']     = 'Release';
$lang->action->objectTypes['deploystep'] = 'Deploy Step';
$lang->action->objectTypes['domain']     = 'Domain';
$lang->action->objectTypes['account']    = 'Account';

$lang->action->desc->online        = '$date, set online by <strong>$actor</strong> .' . "\n";
$lang->action->desc->offline       = '$date, set offline by <strong>$actor</strong> .' . "\n";
$lang->action->desc->linkhost      = '$date, the host is linked by <strong>$actor</strong> .' . "\n";
$lang->action->desc->linkservice   = '$date, the service is linked by <strong>$actor</strong> .' . "\n";
$lang->action->desc->linkcomponent = '$date, the component is linked by <strong>$actor</strong> .' . "\n";
$lang->action->desc->linkcases     = '$date, the case is linked by <strong>$actor</strong> .' . "\n";
$lang->action->desc->suspend       = '$date, suspended by <strong>$actor</strong> .' . "\n";
$lang->action->desc->resume        = '$date, resumed by <strong>$actor</strong> .' . "\n";
$lang->action->desc->reboot        = '$date, restarted by <strong>$actor</strong> .' . "\n";
$lang->action->desc->destroy       = '$date, closed by<strong>$actor</strong>.' . "\n";

$lang->action->label->online        = 'set online';
$lang->action->label->offline       = 'set offline';
$lang->action->label->linkhost      = 'linked hosts to';
$lang->action->label->linkservice   = 'link services to';
$lang->action->label->linkcomponent = 'link components to';
$lang->action->label->linkcases     = 'link cases to';
$lang->action->label->suspend       = 'suspended';
$lang->action->label->resume        = 'restored';
$lang->action->label->reboot        = 'restarted';
$lang->action->label->destroy       = 'closed';

$lang->action->dynamicAction->vm['created'] = 'Create VM';
$lang->action->dynamicAction->vm['suspend'] = 'Suspend VM';
$lang->action->dynamicAction->vm['resume']  = 'Resume VM';
$lang->action->dynamicAction->vm['reboot']  = 'Reboot VM';
$lang->action->dynamicAction->vm['destroy'] = 'Destory VM';

$lang->action->dynamicAction->vmtemplate['created'] = 'Create VM Template';
$lang->action->dynamicAction->vmtemplate['edited']  = 'Edit VM Template';
