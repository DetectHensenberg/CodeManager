<?php
$config->message->objectTypes['waterfall']   = array('submit', 'cancel', 'review', 'revert', 'forward');
$config->message->objectTypes['opportunity'] = array('opened', 'edited', 'assigned', 'tracked', 'closed', 'canceled', 'hangup', 'activated', 'commented');
$config->message->objectTypes['risk']        = array('opened', 'edited', 'assigned', 'tracked', 'closed', 'canceled', 'hangup', 'activated', 'commented');
$config->message->objectTypes['issue']       = array('opened', 'edited', 'assigned', 'issueconfirmed', 'resolved', 'closed', 'canceled', 'activated', 'commented');
$config->message->objectTypes['rule']        = array('executed');
$config->message->objectTypes['reviewissue'] = array('opened', 'edited', 'assigned', 'resolved', 'closed', 'activated');
$config->message->objectTypes['auditplan']   = array('created', 'edited', 'assigned', 'checked');
$config->message->objectTypes['nc']          = array('opened', 'edited', 'assigned', 'resolved', 'closed', 'activated');

$config->message->available['mail']['waterfall']     = $config->message->objectTypes['waterfall'];
$config->message->available['message']['waterfall']  = $config->message->objectTypes['waterfall'];
$config->message->available['webhook']['waterfall']  = $config->message->objectTypes['waterfall'];
$config->message->available['sms']['waterfall']      = $config->message->objectTypes['waterfall'];
if(isset($config->message->available['xuanxuan'])) $config->message->available['xuanxuan']['waterfall'] = $config->message->objectTypes['waterfall'];

$config->message->objectTypes['meeting'] = array('opened', 'edited', 'minuted');

$config->message->available['mail']['meeting']    = $config->message->objectTypes['meeting'];
$config->message->available['webhook']['meeting'] = $config->message->objectTypes['meeting'];

$config->message->available['mail']['opportunity']    = $config->message->objectTypes['opportunity'];
$config->message->available['message']['opportunity'] = $config->message->objectTypes['opportunity'];
$config->message->available['webhook']['opportunity'] = $config->message->objectTypes['opportunity'];
$config->message->available['sms']['opportunity']     = $config->message->objectTypes['opportunity'];

$config->message->available['mail']['risk']    = $config->message->objectTypes['risk'];
$config->message->available['message']['risk'] = $config->message->objectTypes['risk'];
$config->message->available['webhook']['risk'] = $config->message->objectTypes['risk'];
$config->message->available['sms']['risk']     = $config->message->objectTypes['risk'];

$config->message->available['mail']['issue']    = $config->message->objectTypes['issue'];
$config->message->available['message']['issue'] = $config->message->objectTypes['issue'];
$config->message->available['webhook']['issue'] = $config->message->objectTypes['issue'];
$config->message->available['sms']['issue']     = $config->message->objectTypes['issue'];

$config->message->available['mail']['rule']    = $config->message->objectTypes['rule'];
$config->message->available['message']['rule'] = $config->message->objectTypes['rule'];
$config->message->available['webhook']['rule'] = $config->message->objectTypes['rule'];
$config->message->available['sms']['rule']     = $config->message->objectTypes['rule'];

$config->message->setting['message']['setting']  = $config->message->available['message'];
$config->message->setting['webhook']['setting']  = $config->message->available['webhook'];
$config->message->setting['mail']['setting']     = $config->message->available['mail'];
$config->message->setting['sms']['setting']      = $config->message->available['sms'];

$config->message->available['mail']['reviewissue']    = $config->message->objectTypes['reviewissue'];
$config->message->available['message']['reviewissue'] = $config->message->objectTypes['reviewissue'];
$config->message->available['webhook']['reviewissue'] = $config->message->objectTypes['reviewissue'];
$config->message->available['sms']['reviewissue']     = $config->message->objectTypes['reviewissue'];

$config->message->available['mail']['auditplan']    = $config->message->objectTypes['auditplan'];
$config->message->available['message']['auditplan'] = $config->message->objectTypes['auditplan'];
$config->message->available['webhook']['auditplan'] = $config->message->objectTypes['auditplan'];
$config->message->available['sms']['auditplan']     = $config->message->objectTypes['auditplan'];

$config->message->available['mail']['nc']    = $config->message->objectTypes['nc'];
$config->message->available['message']['nc'] = $config->message->objectTypes['nc'];
$config->message->available['webhook']['nc'] = $config->message->objectTypes['nc'];
$config->message->available['sms']['nc']     = $config->message->objectTypes['nc'];

if(isset($config->message->setting['xuanxuan'])) $config->message->setting['xuanxuan']['setting'] = $config->message->available['xuanxuan'];
