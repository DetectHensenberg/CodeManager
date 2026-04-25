<?php
$lang->project->approval               = '评审设置';
$lang->project->previous               = '上一步';
$lang->project->deliverable            = '交付物列表';
$lang->project->deliverableAbbr        = '交付物';
$lang->project->template               = '项目模板';
$lang->project->templateList           = '项目模板列表';
$lang->project->templateName           = '项目模板名称';
$lang->project->createTemplate         = '创建项目模板';
$lang->project->editTemplate           = '编辑项目模板';
$lang->project->publishTemplate        = '发布项目模板';
$lang->project->disableTemplate        = '停用项目模板';
$lang->project->createTemplateAbbr     = '从已有项目创建';
$lang->project->copyProjectID          = '选择项目';
$lang->project->model                  = '项目模型';
$lang->project->newProject             = '全新项目';
$lang->project->deleteTemplate         = '删除项目模板';
$lang->project->inUse                  = '使用中';
$lang->project->noDesc                 = '暂时没有描述';
$lang->project->needRelease            = '待发布';
$lang->project->templatePriv           = '设置项目模板权限';
$lang->project->tplAcl                 = '编辑和使用权限';
$lang->project->disabled               = '停用';
$lang->project->baseline               = '基线';
$lang->project->templateDesc           = '描述';
$lang->project->createDeliverable      = '提交交付物';
$lang->project->createDeliverableAbbr  = '提交';
$lang->project->submitDeliverable      = '发起评审';
$lang->project->recallDeliverable      = '撤回评审';
$lang->project->reviewDeliverable      = '评审交付物';
$lang->project->editDeliverable        = '编辑交付物';
$lang->project->viewDeliverable        = '交付物详情';
$lang->project->deleteDeliverable      = '删除交付物';
$lang->project->editApproval           = '编辑评审流程';
$lang->project->flow                   = '审批流';
$lang->project->deliverableChecklist   = '交付物检查';
$lang->project->needConfirm            = '未确认';
$lang->project->confirmed              = '已确认';
$lang->project->hasApproval            = '是否有评审流程';
$lang->project->updateVersion          = '更新版本';

$lang->project->templateAclList['open']    = '公开 (有权限的用户即可查看使用)';
$lang->project->templateAclList['private'] = '私有 (只有创建人和白名单用户可以编辑和使用)';

$lang->project->approvalflow = new stdclass();
$lang->project->approvalflow->flow   = '审批流程';
$lang->project->approvalflow->object = '审批对象';

$lang->project->approvalflow->objectList[''] = '';
$lang->project->approvalflow->objectList['stage'] = '阶段';
$lang->project->approvalflow->objectList['task']  = '任务';

$lang->project->deliverableList['create'] = '创建时的交付物';
$lang->project->deliverableList['close']  = '关闭时的交付物';

$lang->project->hasApprovalList[1] = '需要评审';
$lang->project->hasApprovalList[0] = '无需评审';

$lang->project->copyProjectConfirm       = '完善' . $lang->projectCommon . '信息';
$lang->project->executionInfoConfirm     = '完善' . $lang->executionCommon . '信息';
$lang->project->stageInfoConfirm         = '完善阶段信息';
$lang->project->kanbanInfoConfirm        = '完善看板信息';
$lang->project->confirmDeleteTemplate    = '确认要删除项目模板吗?';
$lang->project->confirmDisableTemplate   = '您确定要停用此项目模板吗?';
$lang->project->cannotPublishTemplate    = '当前项目模板下的项目流程状态为停用/删除，无法发布。';
$lang->project->confirmDeleteDeliverable = '删除交付物后，原文档不会被删除。';

$lang->project->executionInfoTips     = "为了避免重复，请修改{$lang->executionCommon}名称和{$lang->executionCommon}代号，设置计划开始时间和计划完成时间。";
$lang->project->executionInfoTipsAbbr = "为了避免重复，请修改{$lang->executionCommon}名称和{$lang->executionCommon}代号。";
$lang->project->deliverableTips       = '交付物提交比例=已提交交付物个数/必填和已提交交付物的总数';
$lang->project->whenClosedTips        = '（项目未关闭时，不会对关闭时的交付物进行严格校验）';
$lang->project->deliverableFrozenTips = '交付物打基线后不允许编辑';

$lang->project->chosenProductStage = '请为"%s"' . $lang->productCommon . '选择要复制的阶段：';
$lang->project->notCopyStage       = '不复制';
$lang->project->completeCopy       = '复制完成';
$lang->project->noTemplateData     = '暂无项目模板';
$lang->project->notSubmit          = '未提交';

$lang->project->copyProject->code                = '『' . $lang->projectCommon . '』代号不可重复需要修改';
$lang->project->copyProject->executionCode       = '『' . $lang->executionCommon . '』代号不可重复需要修改';
$lang->project->copyProject->select              = '选择要复制的' . $lang->projectCommon;
$lang->project->copyProject->confirmData         = '确认要复制的数据';
$lang->project->copyProject->improveData         = '完善新' . $lang->projectCommon . '的数据';
$lang->project->copyProject->completeData        = '完成' . $lang->projectCommon . '复制';
$lang->project->copyProject->selectPlz           = '请选择要复制的' . $lang->projectCommon;
$lang->project->copyProject->cancel              = '取消复制';
$lang->project->copyProject->all                 = '全部数据';
$lang->project->copyProject->basic               = '基础数据';
$lang->project->copyProject->allList             = array($lang->projectCommon . '自身的数据', $lang->projectCommon . '所包含的%s', $lang->projectCommon . '和%s的文档目录', $lang->projectCommon . '%s所包含的任务', 'QA质量保证计划', '过程裁剪设置', '团队成员安排与权限');
$lang->project->copyProject->noSprintList        = array($lang->projectCommon . '自身的数据', $lang->projectCommon . '所包含的任务', $lang->projectCommon . '的文档目录', '团队成员安排与权限');
$lang->project->copyProject->ipdAllList          = array($lang->projectCommon . '自身的数据', $lang->projectCommon . '所包含的%s', $lang->projectCommon . '和%s的文档目录', $lang->projectCommon . '%s所包含的任务', '团队成员安排与权限');
$lang->project->copyProject->kanbanAllList       = array($lang->projectCommon . '自身的数据', $lang->projectCommon . '所包含的看板', $lang->projectCommon . '和看板的文档目录', $lang->projectCommon . '看板所包含的任务', '团队成员安排');
$lang->project->copyProject->toComplete          = '去完善';
$lang->project->copyProject->selectProjectPlz    = '请选择' . $lang->projectCommon;
$lang->project->copyProject->confirmCopyDataTip  = '请确认要复制的数据：';
$lang->project->copyProject->basicInfo           = $lang->projectCommon . '数据（所属' . $lang->projectCommon . '集，' . $lang->projectCommon . '名称，' . $lang->projectCommon . '代号，所属' . $lang->productCommon . '）';
$lang->project->copyProject->selectProgram       = '请选择' . $lang->projectCommon . '集';
$lang->project->copyProject->sprint              = $lang->executionCommon;
$lang->project->copyProject->planFinishSmall     = '"计划完成"必须大于"计划开始"';
$lang->project->copyProject->errorExecutionBegin = "{$lang->executionCommon}的计划开始不能小于所属{$lang->projectCommon}的开始时间%s。";
$lang->project->copyProject->errorExecutionEnd   = "{$lang->executionCommon}的计划完成不能大于所属{$lang->projectCommon}的结束时间%s。";
$lang->project->copyProject->errorStageBegin     = "阶段的计划开始不能小于所属{$lang->projectCommon}的开始时间%s。";
$lang->project->copyProject->errorStageEnd       = "阶段的计划完成不能大于所属{$lang->projectCommon}的结束时间%s。";
$lang->project->copyProject->errorKanbanBegin    = "看板的计划开始不能小于所属{$lang->projectCommon}的开始时间%s。";
$lang->project->copyProject->errorKanbanEnd      = "看板的计划完成不能大于所属{$lang->projectCommon}的结束时间%s。";

$lang->project->action->managedeliverable = '$date, 由 <strong>$actor</strong> 维护交付物。' . "\n";
$lang->project->action->disabled          = '$date, 由 <strong>$actor</strong> 停用。' . "\n";

$lang->project->featureBar['template']['all'] = '全部';

$lang->project->featureBar['deliverable']['wait']       = '未提交';
$lang->project->featureBar['deliverable']['normal']     = '已提交';
$lang->project->featureBar['deliverable']['mine']       = '我提交';
$lang->project->featureBar['deliverable']['submitbyme'] = '由我发起';
$lang->project->featureBar['deliverable']['pending']    = '待评审';
$lang->project->featureBar['deliverable']['pendingme']  = '待我评审';
$lang->project->featureBar['deliverable']['more']       = '更多';

$lang->project->featureBar['approval']['all'] = '全部';

$lang->project->moreSelects['deliverable']['more']['reviewing']    = '评审中';
$lang->project->moreSelects['deliverable']['more']['reviewedbyme'] = '我评审过';
$lang->project->moreSelects['deliverable']['more']['pass']         = '评审通过';
$lang->project->moreSelects['deliverable']['more']['fail']         = '评审失败';

$lang->project->deliverableEmpty         = '交付物不能为空';
$lang->project->deliverableCategoryEmpty = '交付物类型不能为空';
$lang->project->submitedBy               = '提交人';
$lang->project->submitedDate             = '提交日期';
$lang->project->viewApprovalProgress     = '查看审批进度';
$lang->project->submitFrom               = '提交来源';
$lang->project->selectDoc                = '选择文档';
$lang->project->activity                 = '活动';
$lang->project->deliverableChecklist     = '交付物检查列表';

$lang->project->featureBar['deliverablechecklist']['all']    = '全部';
$lang->project->featureBar['deliverablechecklist']['wait']   = '未提交';
$lang->project->featureBar['deliverablechecklist']['normal'] = '已提交';

global $config;
if($config->systemMode == 'light') $lang->project->copyProject->basicInfo = $lang->projectCommon . '数据（' . $lang->projectCommon . '名称，' . $lang->projectCommon . '代号，所属' . $lang->productCommon . '）';
if(!helper::hasFeature('project_auditplan')) unset($lang->project->copyProject->allList[4]);
if(!helper::hasFeature('project_process'))   unset($lang->project->copyProject->allList[5]);
