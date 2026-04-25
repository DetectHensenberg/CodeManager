<?php
$lang->projectchange->browse   = '變更列表';
$lang->projectchange->create   = '發起變更';
$lang->projectchange->edit     = '編輯變更';
$lang->projectchange->view     = '變更詳情';
$lang->projectchange->submit   = '發起評審';
$lang->projectchange->recall   = '撤回評審';
$lang->projectchange->review   = '評審變更';
$lang->projectchange->progress = '審批進度';
$lang->projectchange->delete   = '刪除變更';

$lang->projectchange->id            = '編號';
$lang->projectchange->project       = '所屬項目';
$lang->projectchange->name          = '變更名稱';
$lang->projectchange->urgency       = '變更等級';
$lang->projectchange->type          = '變更類型';
$lang->projectchange->deliverable   = '變更對象';
$lang->projectchange->status        = '狀態';
$lang->projectchange->approval      = '所屬流程';
$lang->projectchange->reviewers     = '評審人員';
$lang->projectchange->setReviewer   = '下一節點審批人';
$lang->projectchange->reviewResult  = '評審結果';
$lang->projectchange->reviewOpinion = '評審意見';
$lang->projectchange->owner         = '負責人';
$lang->projectchange->reason        = '變更原因';
$lang->projectchange->desc          = '變更描述';
$lang->projectchange->deadline      = '計劃完成時間';
$lang->projectchange->reviewer      = '審批人';
$lang->projectchange->createdBy     = '由誰創建';
$lang->projectchange->createdDate   = '創建時間';
$lang->projectchange->editedBy      = '由誰編輯';
$lang->projectchange->editedDate    = '編輯時間';
$lang->projectchange->comment       = '備註';
$lang->projectchange->deleted       = '是否刪除';
$lang->projectchange->basicInfo     = '基本信息';
$lang->projectchange->files         = '相關附件';

$lang->projectchange->urgencyList['normal']   = '一般';
$lang->projectchange->urgencyList['major']    = '重大';
$lang->projectchange->urgencyList['critical'] = '特大';

$lang->projectchange->typeList['story']  = '需求變更';
$lang->projectchange->typeList['design'] = '設計變更';
$lang->projectchange->typeList['stage']  = '階段變更';
$lang->projectchange->typeList['case']   = '用例變更';

$lang->projectchange->statusList['wait']      = '待評審';
$lang->projectchange->statusList['reviewing'] = '評審中';
$lang->projectchange->statusList['pass']      = '評審通過';
$lang->projectchange->statusList['reject']    = '評審失敗';
$lang->projectchange->statusList['reverting'] = '回退中';

$lang->projectchange->featureBar = array();
$lang->projectchange->featureBar['browse']['all']       = '全部';
$lang->projectchange->featureBar['browse']['wait']      = '待評審';
$lang->projectchange->featureBar['browse']['reviewing'] = '評審中';
$lang->projectchange->featureBar['browse']['pass']      = '評審通過';
$lang->projectchange->featureBar['browse']['reject']    = '評審失敗';

$lang->projectchange->confirmDelete     = "刪除項目變更，將同時刪除對應的評審數據，請確認。";
$lang->projectchange->deleteHint        = "%s狀態下不允許刪除。";
$lang->projectchange->deliverableNotice = "下拉選項為打基線的交付物，變更評審通過後將允許變更交付物。";
