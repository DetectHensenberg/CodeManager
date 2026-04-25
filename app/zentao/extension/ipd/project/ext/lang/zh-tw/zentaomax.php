<?php
$lang->project->approval               = '評審設置';
$lang->project->previous               = '上一步';
$lang->project->deliverable            = '交付物列表';
$lang->project->deliverableAbbr        = '交付物';
$lang->project->template               = '項目模板';
$lang->project->templateList           = '項目模板列表';
$lang->project->templateName           = '項目模板名稱';
$lang->project->createTemplate         = '創建項目模板';
$lang->project->editTemplate           = '編輯項目模板';
$lang->project->publishTemplate        = '發佈項目模板';
$lang->project->disableTemplate        = '停用項目模板';
$lang->project->createTemplateAbbr     = '從已有項目創建';
$lang->project->copyProjectID          = '選擇項目';
$lang->project->model                  = '項目模型';
$lang->project->newProject             = '全新項目';
$lang->project->deleteTemplate         = '刪除項目模板';
$lang->project->inUse                  = '使用中';
$lang->project->noDesc                 = '暫時沒有描述';
$lang->project->needRelease            = '待發佈';
$lang->project->templatePriv           = '設置項目模板權限';
$lang->project->tplAcl                 = '編輯和使用權限';
$lang->project->disabled               = '停用';
$lang->project->baseline               = '基線';
$lang->project->templateDesc           = '描述';
$lang->project->createDeliverable      = '提交交付物';
$lang->project->createDeliverableAbbr  = '提交';
$lang->project->submitDeliverable      = '發起評審';
$lang->project->recallDeliverable      = '撤回評審';
$lang->project->reviewDeliverable      = '評審交付物';
$lang->project->editDeliverable        = '編輯交付物';
$lang->project->viewDeliverable        = '交付物詳情';
$lang->project->deleteDeliverable      = '刪除交付物';
$lang->project->editApproval           = '編輯評審流程';
$lang->project->flow                   = '審批流';
$lang->project->deliverableChecklist   = '交付物檢查';
$lang->project->needConfirm            = '未確認';
$lang->project->confirmed              = '已確認';
$lang->project->hasApproval            = '是否有評審流程';
$lang->project->updateVersion          = '更新版本';

$lang->project->templateAclList['open']    = '公開 (有權限的用戶即可查看使用)';
$lang->project->templateAclList['private'] = '私有 (只有創建人和白名單用戶可以編輯和使用)';

$lang->project->approvalflow = new stdclass();
$lang->project->approvalflow->flow   = '審批流程';
$lang->project->approvalflow->object = '審批對象';

$lang->project->approvalflow->objectList[''] = '';
$lang->project->approvalflow->objectList['stage'] = '階段';
$lang->project->approvalflow->objectList['task']  = '任務';

$lang->project->deliverableList['create'] = '創建時的交付物';
$lang->project->deliverableList['close']  = '關閉時的交付物';

$lang->project->hasApprovalList[1] = '需要評審';
$lang->project->hasApprovalList[0] = '無需評審';

$lang->project->copyProjectConfirm       = '完善' . $lang->projectCommon . '信息';
$lang->project->executionInfoConfirm     = '完善' . $lang->executionCommon . '信息';
$lang->project->stageInfoConfirm         = '完善階段信息';
$lang->project->kanbanInfoConfirm        = '完善看板信息';
$lang->project->confirmDeleteTemplate    = '確認要刪除項目模板嗎?';
$lang->project->confirmDisableTemplate   = '您確定要停用此項目模板嗎?';
$lang->project->cannotPublishTemplate    = '當前項目模板下的項目流程狀態為停用/刪除，無法發佈。';
$lang->project->confirmDeleteDeliverable = '刪除交付物後，原文檔不會被刪除。';

$lang->project->executionInfoTips     = "為了避免重複，請修改{$lang->executionCommon}名稱和{$lang->executionCommon}代號，設置計劃開始時間和計劃完成時間。";
$lang->project->executionInfoTipsAbbr = "為了避免重複，請修改{$lang->executionCommon}名稱和{$lang->executionCommon}代號。";
$lang->project->deliverableTips       = '交付物提交比例=已提交交付物個數/必填和已提交交付物的總數';
$lang->project->whenClosedTips        = '（項目未關閉時，不會對關閉時的交付物進行嚴格校驗）';
$lang->project->deliverableFrozenTips = '交付物打基線後不允許編輯';

$lang->project->chosenProductStage = '請為"%s"' . $lang->productCommon . '選擇要複製的階段：';
$lang->project->notCopyStage       = '不複製';
$lang->project->completeCopy       = '複製完成';
$lang->project->noTemplateData     = '暫無項目模板';
$lang->project->notSubmit          = '未提交';

$lang->project->copyProject->code                = '『' . $lang->projectCommon . '』代號不可重複需要修改';
$lang->project->copyProject->executionCode       = '『' . $lang->executionCommon . '』代號不可重複需要修改';
$lang->project->copyProject->select              = '選擇要複製的' . $lang->projectCommon;
$lang->project->copyProject->confirmData         = '確認要複製的數據';
$lang->project->copyProject->improveData         = '完善新' . $lang->projectCommon . '的數據';
$lang->project->copyProject->completeData        = '完成' . $lang->projectCommon . '複製';
$lang->project->copyProject->selectPlz           = '請選擇要複製的' . $lang->projectCommon;
$lang->project->copyProject->cancel              = '取消複製';
$lang->project->copyProject->all                 = '全部數據';
$lang->project->copyProject->basic               = '基礎數據';
$lang->project->copyProject->allList             = array($lang->projectCommon . '自身的數據', $lang->projectCommon . '所包含的%s', $lang->projectCommon . '和%s的文檔目錄', $lang->projectCommon . '%s所包含的任務', 'QA質量保證計劃', '過程裁剪設置', '團隊成員安排與權限');
$lang->project->copyProject->noSprintList        = array($lang->projectCommon . '自身的數據', $lang->projectCommon . '所包含的任務', $lang->projectCommon . '的文檔目錄', '團隊成員安排與權限');
$lang->project->copyProject->ipdAllList          = array($lang->projectCommon . '自身的數據', $lang->projectCommon . '所包含的%s', $lang->projectCommon . '和%s的文檔目錄', $lang->projectCommon . '%s所包含的任務', '團隊成員安排與權限');
$lang->project->copyProject->kanbanAllList       = array($lang->projectCommon . '自身的數據', $lang->projectCommon . '所包含的看板', $lang->projectCommon . '和看板的文檔目錄', $lang->projectCommon . '看板所包含的任務', '團隊成員安排');
$lang->project->copyProject->toComplete          = '去完善';
$lang->project->copyProject->selectProjectPlz    = '請選擇' . $lang->projectCommon;
$lang->project->copyProject->confirmCopyDataTip  = '請確認要複製的數據：';
$lang->project->copyProject->basicInfo           = $lang->projectCommon . '數據（所屬' . $lang->projectCommon . '集，' . $lang->projectCommon . '名稱，' . $lang->projectCommon . '代號，所屬' . $lang->productCommon . '）';
$lang->project->copyProject->selectProgram       = '請選擇' . $lang->projectCommon . '集';
$lang->project->copyProject->sprint              = $lang->executionCommon;
$lang->project->copyProject->planFinishSmall     = '"計劃完成"必須大於"計劃開始"';
$lang->project->copyProject->errorExecutionBegin = "{$lang->executionCommon}的計劃開始不能小於所屬{$lang->projectCommon}的開始時間%s。";
$lang->project->copyProject->errorExecutionEnd   = "{$lang->executionCommon}的計劃完成不能大於所屬{$lang->projectCommon}的結束時間%s。";
$lang->project->copyProject->errorStageBegin     = "階段的計劃開始不能小於所屬{$lang->projectCommon}的開始時間%s。";
$lang->project->copyProject->errorStageEnd       = "階段的計劃完成不能大於所屬{$lang->projectCommon}的結束時間%s。";
$lang->project->copyProject->errorKanbanBegin    = "看板的計劃開始不能小於所屬{$lang->projectCommon}的開始時間%s。";
$lang->project->copyProject->errorKanbanEnd      = "看板的計劃完成不能大於所屬{$lang->projectCommon}的結束時間%s。";

$lang->project->action->managedeliverable = '$date, 由 <strong>$actor</strong> 維護交付物。' . "\n";
$lang->project->action->disabled          = '$date, 由 <strong>$actor</strong> 停用。' . "\n";

$lang->project->featureBar['template']['all'] = '全部';

$lang->project->featureBar['deliverable']['wait']       = '未提交';
$lang->project->featureBar['deliverable']['normal']     = '已提交';
$lang->project->featureBar['deliverable']['mine']       = '我提交';
$lang->project->featureBar['deliverable']['submitbyme'] = '由我發起';
$lang->project->featureBar['deliverable']['pending']    = '待評審';
$lang->project->featureBar['deliverable']['pendingme']  = '待我評審';
$lang->project->featureBar['deliverable']['more']       = '更多';

$lang->project->featureBar['approval']['all'] = '全部';

$lang->project->moreSelects['deliverable']['more']['reviewing']    = '評審中';
$lang->project->moreSelects['deliverable']['more']['reviewedbyme'] = '我評審過';
$lang->project->moreSelects['deliverable']['more']['pass']         = '評審通過';
$lang->project->moreSelects['deliverable']['more']['fail']         = '評審失敗';

$lang->project->deliverableEmpty         = '交付物不能為空';
$lang->project->deliverableCategoryEmpty = '交付物類型不能為空';
$lang->project->submitedBy               = '提交人';
$lang->project->submitedDate             = '提交日期';
$lang->project->viewApprovalProgress     = '查看審批進度';
$lang->project->submitFrom               = '提交來源';
$lang->project->selectDoc                = '選擇文檔';
$lang->project->activity                 = '活動';
$lang->project->deliverableChecklist     = '交付物檢查列表';

$lang->project->featureBar['deliverablechecklist']['all']    = '全部';
$lang->project->featureBar['deliverablechecklist']['wait']   = '未提交';
$lang->project->featureBar['deliverablechecklist']['normal'] = '已提交';

global $config;
if($config->systemMode == 'light') $lang->project->copyProject->basicInfo = $lang->projectCommon . '數據（' . $lang->projectCommon . '名稱，' . $lang->projectCommon . '代號，所屬' . $lang->productCommon . '）';
if(!helper::hasFeature('project_auditplan')) unset($lang->project->copyProject->allList[4]);
if(!helper::hasFeature('project_process'))   unset($lang->project->copyProject->allList[5]);
