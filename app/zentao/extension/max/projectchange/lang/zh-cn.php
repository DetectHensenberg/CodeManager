<?php
$lang->projectchange->browse   = '变更列表';
$lang->projectchange->create   = '发起变更';
$lang->projectchange->edit     = '编辑变更';
$lang->projectchange->view     = '变更详情';
$lang->projectchange->submit   = '发起评审';
$lang->projectchange->recall   = '撤回评审';
$lang->projectchange->review   = '评审变更';
$lang->projectchange->progress = '审批进度';
$lang->projectchange->delete   = '删除变更';

$lang->projectchange->id            = '编号';
$lang->projectchange->project       = '所属项目';
$lang->projectchange->name          = '变更名称';
$lang->projectchange->urgency       = '变更等级';
$lang->projectchange->type          = '变更类型';
$lang->projectchange->deliverable   = '变更对象';
$lang->projectchange->status        = '状态';
$lang->projectchange->approval      = '所属流程';
$lang->projectchange->reviewers     = '评审人员';
$lang->projectchange->setReviewer   = '下一节点审批人';
$lang->projectchange->reviewResult  = '评审结果';
$lang->projectchange->reviewOpinion = '评审意见';
$lang->projectchange->owner         = '负责人';
$lang->projectchange->reason        = '变更原因';
$lang->projectchange->desc          = '变更描述';
$lang->projectchange->deadline      = '计划完成时间';
$lang->projectchange->reviewer      = '审批人';
$lang->projectchange->createdBy     = '由谁创建';
$lang->projectchange->createdDate   = '创建时间';
$lang->projectchange->editedBy      = '由谁编辑';
$lang->projectchange->editedDate    = '编辑时间';
$lang->projectchange->comment       = '备注';
$lang->projectchange->deleted       = '是否删除';
$lang->projectchange->basicInfo     = '基本信息';
$lang->projectchange->files         = '相关附件';

$lang->projectchange->urgencyList['normal']   = '一般';
$lang->projectchange->urgencyList['major']    = '重大';
$lang->projectchange->urgencyList['critical'] = '特大';

$lang->projectchange->typeList['story']  = '需求变更';
$lang->projectchange->typeList['design'] = '设计变更';
$lang->projectchange->typeList['stage']  = '阶段变更';
$lang->projectchange->typeList['case']   = '用例变更';

$lang->projectchange->statusList['wait']      = '待评审';
$lang->projectchange->statusList['reviewing'] = '评审中';
$lang->projectchange->statusList['pass']      = '评审通过';
$lang->projectchange->statusList['reject']    = '评审失败';
$lang->projectchange->statusList['reverting'] = '回退中';

$lang->projectchange->featureBar = array();
$lang->projectchange->featureBar['browse']['all']       = '全部';
$lang->projectchange->featureBar['browse']['wait']      = '待评审';
$lang->projectchange->featureBar['browse']['reviewing'] = '评审中';
$lang->projectchange->featureBar['browse']['pass']      = '评审通过';
$lang->projectchange->featureBar['browse']['reject']    = '评审失败';

$lang->projectchange->confirmDelete     = "删除项目变更，将同时删除对应的评审数据，请确认。";
$lang->projectchange->deleteHint        = "%s状态下不允许删除。";
$lang->projectchange->deliverableNotice = "下拉选项为打基线的交付物，变更评审通过后将允许变更交付物。";
