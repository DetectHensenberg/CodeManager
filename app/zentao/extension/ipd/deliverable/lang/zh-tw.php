<?php
$lang->deliverable->name            = '交付物類型';
$lang->deliverable->title           = '交付物名稱';
$lang->deliverable->version         = '版本號';
$lang->deliverable->versionStatus   = '版本狀態';
$lang->deliverable->module          = '所屬分類';
$lang->deliverable->desc            = '描述';
$lang->deliverable->createdByAB     = '創建者';
$lang->deliverable->createdBy       = '由誰創建';
$lang->deliverable->createdDate     = '創建日期';
$lang->deliverable->lastEditedBy    = '最後修改';
$lang->deliverable->lastEditedDate  = '最後修改日期';
$lang->deliverable->template        = '引用模板';
$lang->deliverable->files           = '上傳模板';
$lang->deliverable->activity        = '所屬活動';
$lang->deliverable->addActivity     = '添加活動';
$lang->deliverable->trimmable       = '是否可裁剪';
$lang->deliverable->trimRule        = '裁剪準則';
$lang->deliverable->when            = '檢查環節';
$lang->deliverable->required        = '是否必須提交';
$lang->deliverable->or              = '或';
$lang->deliverable->basicInfo       = '基本信息';
$lang->deliverable->selectDoc       = '請選擇文檔模板';
$lang->deliverable->whenClose       = '關閉時';
$lang->deliverable->moduleSetting   = '分類設置';
$lang->deliverable->status          = '狀態';
$lang->deliverable->reviewStatus    = '評審狀態';
$lang->deliverable->toEdit          = '去關聯';
$lang->deliverable->isBaseline      = '是否為基線';
$lang->deliverable->submitedBy      = '由誰提交';
$lang->deliverable->baseline        = '所屬基線';
$lang->deliverable->baselineVersion = '基線版本號';

$lang->deliverable->createByTemplate   = '從模板創建';
$lang->deliverable->selectDocInProject = '請選擇項目中已發佈且你可查看的文檔。';

$lang->deliverable->browse  = '瀏覽交付物類型列表';
$lang->deliverable->create  = '新建交付物類型';
$lang->deliverable->edit    = '編輯交付物類型';
$lang->deliverable->delete  = '刪除交付物類型';
$lang->deliverable->enable  = '啟用交付物類型';
$lang->deliverable->disable = '停用交付物類型';
$lang->deliverable->view    = '查看交付物類型詳情';

$lang->deliverable->createAbbr  = '新建';
$lang->deliverable->createTitle = '新建交付物類型';
$lang->deliverable->editTitle   = '編輯交付物類型';

$lang->deliverable->moduleLang = new stdclass();
$lang->deliverable->moduleLang->common         = '分類維護';
$lang->deliverable->moduleLang->manage         = '分類維護';
$lang->deliverable->moduleLang->module         = '分類';
$lang->deliverable->moduleLang->name           = '分類名稱';
$lang->deliverable->moduleLang->create         = '創建分類';
$lang->deliverable->moduleLang->edit           = '編輯分類';
$lang->deliverable->moduleLang->repeatName     = '分類名“ %s” 已經存在！';
$lang->deliverable->moduleLang->confirmDelete  = '您確定要刪除該分類嗎？';
$lang->deliverable->moduleLang->shouldNotBlank = '分類名不能為空格！';

$lang->deliverable->abbr = new stdclass();
$lang->deliverable->abbr->template = '模板';

$lang->deliverable->typeLang = new stdclass();
$lang->deliverable->typeLang->summary = '本頁共有%s個交付物類型';

$lang->deliverable->trimmableList['0']  = '不可裁剪';
$lang->deliverable->trimmableList['1']  = '可裁剪';

$lang->deliverable->requiredList['0'] = '選擇提交';
$lang->deliverable->requiredList['1'] = '必須提交';

$lang->deliverable->statusList['enabled']  = '啟用';
$lang->deliverable->statusList['disabled'] = '停用';

$lang->deliverable->versionStatusList['latest']  = '最新';
$lang->deliverable->versionStatusList['updated'] = '有更新';

$lang->deliverable->baselineList['0'] = '否';
$lang->deliverable->baselineList['1'] = '是';

$lang->deliverable->confirmDelete    = '將同步刪除交付物評審流程及檢查清單，是否繼續？';
$lang->deliverable->summary          = '本頁共有%s個交付物';
$lang->deliverable->exceededCountTip = '每個交付物只能上傳一個檔案';

$lang->deliverable->featureBar['browse']['all'] = '全部';

$lang->deliverable->addedDoc    = '新增交付物文檔：%s';
$lang->deliverable->deletedDoc  = '刪除交付物文檔：%s';
$lang->deliverable->addedFile   = '新增交付物附件：%s';
$lang->deliverable->deletedFile = '刪除交付物附件：%s';
$lang->deliverable->renamedFile = '重命名交付物附件：%s -> %s';
$lang->deliverable->renamedDoc  = '重命名交付物文檔：%s -> %s';

$lang->deliverable->stageMustBeSelected = '請至少選擇一個交付物的檢查環節！';
$lang->deliverable->deleteModuleConfirm = '無法刪除包含交付物類型的分類。';
$lang->deliverable->confirmEnable       = '該交付物未關聯“所屬分類”或“所屬活動”，請關聯後再啟用。';
$lang->deliverable->builtinConfirm      = '內置交付物禁止修改';
$lang->deliverable->trimableNotice      = '交付物類型的“可裁剪”屬性受所屬活動的裁剪屬性約束';

$lang->deliverable->buildinModule['plan']   = '計劃類';
$lang->deliverable->buildinModule['story']  = '需求類';
$lang->deliverable->buildinModule['design'] = '設計類';
$lang->deliverable->buildinModule['test']   = '測試類';
$lang->deliverable->buildinModule['other']  = '其他類';

$lang->deliverable->action = new stdclass();
$lang->deliverable->action->enabled  = array('main' => '$date, 由 <strong>$actor</strong> 啟用。');
$lang->deliverable->action->disabled = array('main' => '$date, 由 <strong>$actor</strong> 停用。');
