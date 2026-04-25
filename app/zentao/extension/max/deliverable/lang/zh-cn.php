<?php
$lang->deliverable->name            = '交付物类型';
$lang->deliverable->title           = '交付物名称';
$lang->deliverable->version         = '版本号';
$lang->deliverable->versionStatus   = '版本状态';
$lang->deliverable->module          = '所属分类';
$lang->deliverable->desc            = '描述';
$lang->deliverable->createdByAB     = '创建者';
$lang->deliverable->createdBy       = '由谁创建';
$lang->deliverable->createdDate     = '创建日期';
$lang->deliverable->lastEditedBy    = '最后修改';
$lang->deliverable->lastEditedDate  = '最后修改日期';
$lang->deliverable->template        = '引用模板';
$lang->deliverable->files           = '上传模板';
$lang->deliverable->activity        = '所属活动';
$lang->deliverable->addActivity     = '添加活动';
$lang->deliverable->trimmable       = '是否可裁剪';
$lang->deliverable->trimRule        = '裁剪准则';
$lang->deliverable->when            = '检查环节';
$lang->deliverable->required        = '是否必须提交';
$lang->deliverable->or              = '或';
$lang->deliverable->basicInfo       = '基本信息';
$lang->deliverable->selectDoc       = '请选择文档模板';
$lang->deliverable->whenClose       = '关闭时';
$lang->deliverable->moduleSetting   = '分类设置';
$lang->deliverable->status          = '状态';
$lang->deliverable->reviewStatus    = '评审状态';
$lang->deliverable->toEdit          = '去关联';
$lang->deliverable->isBaseline      = '是否为基线';
$lang->deliverable->submitedBy      = '由谁提交';
$lang->deliverable->baseline        = '所属基线';
$lang->deliverable->baselineVersion = '基线版本号';

$lang->deliverable->createByTemplate   = '从模板创建';
$lang->deliverable->selectDocInProject = '请选择项目中已发布且你可查看的文档。';

$lang->deliverable->browse  = '浏览交付物类型列表';
$lang->deliverable->create  = '新建交付物类型';
$lang->deliverable->edit    = '编辑交付物类型';
$lang->deliverable->delete  = '删除交付物类型';
$lang->deliverable->enable  = '启用交付物类型';
$lang->deliverable->disable = '停用交付物类型';
$lang->deliverable->view    = '查看交付物类型详情';

$lang->deliverable->createAbbr  = '新建';
$lang->deliverable->createTitle = '新建交付物类型';
$lang->deliverable->editTitle   = '编辑交付物类型';

$lang->deliverable->moduleLang = new stdclass();
$lang->deliverable->moduleLang->common         = '分类维护';
$lang->deliverable->moduleLang->manage         = '分类维护';
$lang->deliverable->moduleLang->module         = '分类';
$lang->deliverable->moduleLang->name           = '分类名称';
$lang->deliverable->moduleLang->create         = '创建分类';
$lang->deliverable->moduleLang->edit           = '编辑分类';
$lang->deliverable->moduleLang->repeatName     = '分类名“ %s” 已经存在！';
$lang->deliverable->moduleLang->confirmDelete  = '您确定要删除该分类吗？';
$lang->deliverable->moduleLang->shouldNotBlank = '分类名不能为空格！';

$lang->deliverable->abbr = new stdclass();
$lang->deliverable->abbr->template = '模板';

$lang->deliverable->typeLang = new stdclass();
$lang->deliverable->typeLang->summary = '本页共有%s个交付物类型';

$lang->deliverable->trimmableList['0']  = '不可裁剪';
$lang->deliverable->trimmableList['1']  = '可裁剪';

$lang->deliverable->requiredList['0'] = '选择提交';
$lang->deliverable->requiredList['1'] = '必须提交';

$lang->deliverable->statusList['enabled']  = '启用';
$lang->deliverable->statusList['disabled'] = '停用';

$lang->deliverable->versionStatusList['latest']  = '最新';
$lang->deliverable->versionStatusList['updated'] = '有更新';

$lang->deliverable->baselineList['0'] = '否';
$lang->deliverable->baselineList['1'] = '是';

$lang->deliverable->confirmDelete    = '将同步删除交付物评审流程及检查清单，是否继续？';
$lang->deliverable->summary          = '本页共有%s个交付物';
$lang->deliverable->exceededCountTip = '每个交付物只能上传一个文件';

$lang->deliverable->featureBar['browse']['all'] = '全部';

$lang->deliverable->addedDoc    = '新增交付物文档：%s';
$lang->deliverable->deletedDoc  = '删除交付物文档：%s';
$lang->deliverable->addedFile   = '新增交付物附件：%s';
$lang->deliverable->deletedFile = '删除交付物附件：%s';
$lang->deliverable->renamedFile = '重命名交付物附件：%s -> %s';
$lang->deliverable->renamedDoc  = '重命名交付物文档：%s -> %s';

$lang->deliverable->stageMustBeSelected = '请至少选择一个交付物的检查环节！';
$lang->deliverable->deleteModuleConfirm = '无法删除包含交付物类型的分类。';
$lang->deliverable->confirmEnable       = '该交付物未关联“所属分类”或“所属活动”，请关联后再启用。';
$lang->deliverable->builtinConfirm      = '内置交付物禁止修改';
$lang->deliverable->trimableNotice      = '交付物类型的“可裁剪”属性受所属活动的裁剪属性约束';

$lang->deliverable->buildinModule['plan']   = '计划类';
$lang->deliverable->buildinModule['story']  = '需求类';
$lang->deliverable->buildinModule['design'] = '设计类';
$lang->deliverable->buildinModule['test']   = '测试类';
$lang->deliverable->buildinModule['other']  = '其他类';

$lang->deliverable->action = new stdclass();
$lang->deliverable->action->enabled  = array('main' => '$date, 由 <strong>$actor</strong> 启用。');
$lang->deliverable->action->disabled = array('main' => '$date, 由 <strong>$actor</strong> 停用。');
