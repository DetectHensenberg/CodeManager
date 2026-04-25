<?php
$config->custom->canAdd['baseline']      = 'objectList';
$config->custom->canAdd['nc']            = 'typeList,severityList';
$config->custom->canAdd['issue']         = 'typeList,severityList,priList';
$config->custom->canAdd['risk']          = 'categoryList,sourceList';
$config->custom->canAdd['opportunity']   = 'sourceList,typeList';
$config->custom->canAdd['bug']          .= ',injectionList,identifyList';
$config->custom->canAdd['projectchange'] = 'urgencyList,typeList';

array_splice($config->custom->allFeatures, 5, 0, 'projectDetail');
array_splice($config->custom->allFeatures, 14, 0, 'assetlib');

$config->custom->dataFeatures[] = 'issue';
$config->custom->dataFeatures[] = 'risk';
$config->custom->dataFeatures[] = 'opportunity';
$config->custom->dataFeatures[] = 'process';
$config->custom->dataFeatures[] = 'auditplan';
$config->custom->dataFeatures[] = 'meeting';
$config->custom->dataFeatures[] = 'deliverable';
$config->custom->dataFeatures[] = 'review';
$config->custom->dataFeatures[] = 'cm';
$config->custom->dataFeatures[] = 'change';
$config->custom->dataFeatures[] = 'assetlib';
$config->custom->dataFeatures[] = 'measrecord';
$config->custom->dataFeatures[] = 'gapanalysis';
$config->custom->dataFeatures[] = 'researchplan';

$config->custom->projectFeatures = array('issue', 'risk', 'opportunity', 'process', 'auditplan', 'meeting', 'deliverable', 'review', 'cm', 'change', 'measrecord', 'gapanalysis', 'researchplan');

$config->custom->notSetMethods[] = 'role';

$config->custom->relateObjectList['issue'] = $lang->issue->common;
$config->custom->relateObjectList['risk']  = $lang->risk->common;

$config->custom->objectOwner['project'][] = 'issue';
$config->custom->objectOwner['project'][] = 'risk';

$config->custom->relateObjectFields['issue'] = array('id', 'relation', 'pri', 'severity', 'title', 'project', 'createdBy', 'assignedTo', 'status');
$config->custom->relateObjectFields['risk']  = array('id', 'relation', 'pri', 'rate', 'name', 'project', 'createdBy', 'assignedTo', 'status');

$config->custom->customFields['meeting'] = array('custom' => array('createFields'));

$config->custom->fieldList['bug']['create'] .= ',injection,identify';
$config->custom->fieldList['bug']['edit']   .= ',injection,identify';
