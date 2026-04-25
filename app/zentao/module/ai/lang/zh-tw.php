<?php

/**
 * The ai module zh-tw lang file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禪道軟件（青島）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Wenrui LI <liwenrui@easycorp.ltd>
 * @package     ai
 * @link        https://www.zentao.net
 */
$lang->ai->common = 'AI配置';

/* Definitions of table columns, used to sprintf error messages to dao::$errors. */
$lang->prompt = new stdclass();
$lang->prompt->name             = '名稱';
$lang->prompt->desc             = '描述';
$lang->prompt->model            = '預設模型';
$lang->prompt->module           = '所屬分組';
$lang->prompt->source           = '對象數據';
$lang->prompt->targetForm       = '目標表單';
$lang->prompt->purpose          = '操作';
$lang->prompt->elaboration      = '補充要求';
$lang->prompt->knowledgeLib     = '知識庫';
$lang->prompt->role             = '角色';
$lang->prompt->characterization = '角色描述';
$lang->prompt->status           = '階段';
$lang->prompt->createdBy        = '由誰創建';
$lang->prompt->createdDate      = '創建時間';
$lang->prompt->editedBy         = '最後編輯';
$lang->prompt->editedDate       = '編輯時間';
$lang->prompt->deleted          = '是否已刪除';

/* Lang for privs, keys are paired with privlang items. */
$lang->ai->modelBrowse             = '瀏覽語言模型';
$lang->ai->modelView               = '查看語言模型詳情';
$lang->ai->modelCreate             = '創建語言模型';
$lang->ai->modelEdit               = '編輯語言模型';
$lang->ai->modelEnable             = '啟用語言模型';
$lang->ai->modelDisable            = '禁用語言模型';
$lang->ai->modelDelete             = '刪除語言模型';
$lang->ai->modelTestConnection     = '測試連接';
$lang->ai->promptCreate            = '創建禪道智能體';
$lang->ai->promptEdit              = '編輯禪道智能體';
$lang->ai->promptDelete            = '刪除禪道智能體';
$lang->ai->promptAssignRole        = '指定角色';
$lang->ai->promptSelectDataSource  = '選擇對象';
$lang->ai->promptSetPurpose        = '確認操作';
$lang->ai->promptSetTargetForm     = '結果處理';
$lang->ai->promptFinalize          = '準備發佈';
$lang->ai->promptAudit             = '調試禪道智能體';
$lang->ai->promptPublish           = '發佈禪道智能體';
$lang->ai->promptUnpublish         = '取消發佈';
$lang->ai->promptBrowse            = '瀏覽禪道智能體列表';
$lang->ai->promptView              = '查看禪道智能體詳情';
$lang->ai->promptExecute           = '執行禪道智能體';
$lang->ai->promptExecutionReset    = '重置執行';
$lang->ai->roleTemplates           = '管理角色模板';
$lang->ai->chat                    = '聊天';
$lang->ai->createMiniProgram       = '創建通用智能體';
$lang->ai->editMiniProgram         = '編輯通用智能體';
$lang->ai->configuredMiniProgram   = '配置通用智能體';
$lang->ai->testMiniProgram         = '調試通用智能體';
$lang->ai->miniProgramList         = '瀏覽通用智能體列表';
$lang->ai->miniProgramView         = '查看通用智能體詳情';
$lang->ai->publishMiniProgram      = '發佈通用智能體';
$lang->ai->unpublishMiniProgram    = '下架通用智能體';
$lang->ai->publishSuccess          = '發佈成功';
$lang->ai->unpublishSuccess        = '下架成功';
$lang->ai->deleteMiniProgram       = '刪除通用智能體';
$lang->ai->exportMiniProgram       = '導出通用智能體';
$lang->ai->importMiniProgram       = '導入通用智能體';
$lang->ai->editMiniProgramCategory = '維護分組';
$lang->ai->assistants              = '瀏覽AI助手';
$lang->ai->assistantView           = '查看AI助手詳情';
$lang->ai->assistantCreate         = '創建AI助手';
$lang->ai->assistantEdit           = '編輯AI助手';
$lang->ai->assistantPublish        = '發佈AI助手';
$lang->ai->assistantWithdraw       = '停用AI助手';
$lang->ai->assistantDelete         = '刪除AI助手';

$lang->ai->name                   = '名稱';
$lang->ai->store                  = '商店';
$lang->ai->export                 = '導出';
$lang->ai->import                 = '導入';
$lang->ai->saveFail               = '保存失敗';
$lang->ai->installPackage         = '安裝包';
$lang->ai->toPublish              = '安裝後發佈';
$lang->ai->toZentaoStoreAIPage    = '點擊可跳轉至禪道官網應用商店通用智能體頁面。';
$lang->ai->exitManage             = '退出管理界面';

$lang->ai->chatPlaceholderMessage = 'Hi，我是 AI 助手阿道，您可以問我任何問題。';
$lang->ai->chatPlaceholderInput   = '問問阿道…';
$lang->ai->chatSystemMessage      = '你叫阿道，是禪道的 AI 助手兼吉祥物，你可以回答用戶的問題和與用戶聊天。你當前所處的環境是禪道項目管理軟件。';
$lang->ai->chatSend               = '發送';
$lang->ai->chatReset              = '清空';
$lang->ai->chatNoResponse         = '會話發生了錯誤，<a id="retry" class="text-blue">點擊這裡重試</a>。';
$lang->ai->noMiniProgram          = '您訪問的通用智能體不存在';

$lang->ai->nextStep  = '下一步';
$lang->ai->goTesting = '去調試';
$lang->ai->maintenanceGroup = '維護分組';

$lang->ai->maintenanceGroupDuplicated = '分組名不能重複';

$lang->ai->requiredList['0'] = '非必填';
$lang->ai->requiredList['1'] = '必填';

$lang->ai->validate = new stdclass();
$lang->ai->validate->noEmpty       = '%s不能為空。';
$lang->ai->validate->dirtyForm     = '%s的參數配置已變動，是否保存並返回？';
$lang->ai->validate->nameNotUnique = '該名稱已使用，請嘗試其他名稱。';

$lang->ai->prompts = new stdclass();
$lang->ai->prompts->common       = '禪道智能體';
$lang->ai->prompts->emptyList    = '暫時沒有禪道智能體。';
$lang->ai->prompts->create       = '創建禪道智能體';
$lang->ai->prompts->edit         = '編輯禪道智能體';
$lang->ai->prompts->id           = 'ID';
$lang->ai->prompts->name         = '名稱';
$lang->ai->prompts->description  = '描述';
$lang->ai->prompts->createdBy    = '創建者';
$lang->ai->prompts->createdDate  = '創建時間';
$lang->ai->prompts->targetForm   = '表單';
$lang->ai->prompts->funcDesc     = '功能描述';
$lang->ai->prompts->deleted      = '已刪除';
$lang->ai->prompts->stage        = '階段';
$lang->ai->prompts->basicInfo    = '基本信息';
$lang->ai->prompts->editInfo     = '創建編輯';
$lang->ai->prompts->createdBy    = '由誰創建';
$lang->ai->prompts->publishedBy  = '由誰發佈';
$lang->ai->prompts->draftedBy    = '由誰下架';
$lang->ai->prompts->lastEditor   = '最後編輯';
$lang->ai->prompts->modelNeutral = '通用';

$lang->ai->prompts->viewTypeList            = array();
$lang->ai->prompts->viewTypeList['list']    = '列表視圖';
$lang->ai->prompts->viewTypeList['card']    = '卡片視圖';

$lang->ai->prompts->summary = '本頁共 %s 個禪道智能體。';
$lang->ai->prompts->fieldSeparator = '、';

$lang->ai->prompts->action = new stdclass();
$lang->ai->prompts->action->goDesignConfirm  = '當前禪道智能體未完成，是否繼續設計？';
$lang->ai->prompts->action->goDesign         = '去設計';
$lang->ai->prompts->action->draftConfirm     = '下架後，禪道智能體將不能繼續使用，您確定要下架嗎？';
$lang->ai->prompts->action->design           = '設計';
$lang->ai->prompts->action->test             = '調試';
$lang->ai->prompts->action->edit             = '編輯';
$lang->ai->prompts->action->publish          = '發佈';
$lang->ai->prompts->action->unpublish        = '下架';
$lang->ai->prompts->action->delete           = '刪除';
$lang->ai->prompts->action->disable          = '禁用';
$lang->ai->prompts->action->deleteConfirm    = '刪除後，禪道智能體將不能繼續使用，您確定要刪除嗎？';
$lang->ai->prompts->action->publishSuccess   = '發佈成功';
$lang->ai->prompts->action->unpublishSuccess = '下架成功';
$lang->ai->prompts->action->deleteSuccess    = '刪除成功';

/* Steps of prompt creation. */
$lang->ai->prompts->assignRole       = '指定角色';
$lang->ai->prompts->selectDataSource = '選擇對象';
$lang->ai->prompts->setPurpose       = '確認操作';
$lang->ai->prompts->setTargetForm    = '結果處理';
$lang->ai->prompts->finalize         = '準備發佈';

/* Role assigning. */
$lang->ai->prompts->model               = '預設模型';
$lang->ai->prompts->role                = '角色';
$lang->ai->prompts->characterization    = '角色描述';
$lang->ai->prompts->rolePlaceholder     = '“你來扮演 <一個什麼角色>”';
$lang->ai->prompts->charPlaceholder     = '該角色的具體描述信息';
$lang->ai->prompts->roleTemplate        = '角色模版';
$lang->ai->prompts->roleTemplateTip     = '引用模板後，修改角色、角色描述不會對模板造成影響。';
$lang->ai->prompts->addRoleTemplate     = '添加角色模板';
$lang->ai->prompts->editRoleTemplate    = '編輯角色模板';
$lang->ai->prompts->editRoleTemplateTip = '本次編輯不會影響已使用該模版的禪道智能體';
$lang->ai->prompts->roleAddedSuccess    = '角色模版保存成功';
$lang->ai->prompts->roleDelConfirm      = '刪除不會影響已用角色模版的禪道智能體，是否刪除？';
$lang->ai->prompts->roleDelSuccess      = '角色模板已刪除';
$lang->ai->prompts->roleTemplateSave    = '存為角色模板';
$lang->ai->prompts->roleTemplateSaveList = array();
$lang->ai->prompts->roleTemplateSaveList['save']    = '保存';
$lang->ai->prompts->roleTemplateSaveList['discard'] = '不保存';

/* Data source selecting. */
$lang->ai->prompts->selectData       = '選擇欄位';
$lang->ai->prompts->selectDataTip    = '選擇對象後，此處會展示已選對象的欄位。';
$lang->ai->prompts->selectedFormat   = '已選對象為{0}，已選 {1} 條欄位';
$lang->ai->prompts->nonSelected      = '暫無所選欄位。';
$lang->ai->prompts->sortTip          = '可根據重要性給數據欄位排序。';
$lang->ai->prompts->object           = '對象';
$lang->ai->prompts->field            = '欄位';

/* Purpose setting. */
$lang->ai->prompts->purpose        = '操作';
$lang->ai->prompts->purposeTip     = '“我希望<它能完成什麼事情，以便于達到什麼樣的目標>”';
$lang->ai->prompts->elaboration    = '補充要求';
$lang->ai->prompts->elaborationTip = '“我希望<它的回答請注意一些補充要求>”';
$lang->ai->prompts->inputPreview   = '輸入預覽';
$lang->ai->prompts->dataPreview    = '對象數據預覽';
$lang->ai->prompts->rolePreview    = '角色禪道智能體預覽';
$lang->ai->prompts->promptPreview  = '操作禪道智能體預覽';

/* Target form selecting. */
$lang->ai->prompts->selectTargetForm    = '選擇表單';
$lang->ai->prompts->selectTargetFormTip = '選擇後，可以將大語言模型返回的結果直接錄入到禪道對應的表單中。';
$lang->ai->prompts->goingTesting        = '即將跳轉至調試頁面';
$lang->ai->prompts->goingTestingFail    = '暫無可調試的對象';

/* Prompt form settings. */
$lang->ai->prompts->formDefaultTitle  = '請補充下列表單內容：';
$lang->ai->prompts->formSubmitBtnText = '生成';

$lang->ai->prompts->testData['product']['product']['name'] = '企業網站建設平台';
$lang->ai->prompts->testData['product']['product']['desc'] = '企業網站建設平台是一個專為現代企業設計的官網管理平台，旨在幫助公司以專業、創新的方式展示自我。該平台整合了最新的企業動態、項目成果、聯繫方式以及工商信息，讓訪客能夠一目瞭然地瞭解公司的核心價值和服務。通過清晰簡潔的界面和直觀的導航，企業在綫視窗提升了用戶體驗，幫助企業與客戶和合作夥伴之間建立更緊密的聯繫。無論是信息更新還是內容管理，企業在綫視窗都為企業提供了高效、靈活的解決方案，助力品牌建設與業務發展。';

$lang->ai->prompts->testData['project']['project']['name']     = '企業網站開發項目';
$lang->ai->prompts->testData['project']['project']['type']     = '產品型';
$lang->ai->prompts->testData['project']['project']['desc']     = '企業網站開發項目旨在通過結合瀑布與敏捷的開發模式，快速、高效地構建一個功能齊全、用戶友好且具備高可擴展性的企業官網。該項目將通過詳細的需求分析、設計、開發和測試階段確保最終交付的產品能夠滿足用戶需求並具備良好的用戶體驗。';
$lang->ai->prompts->testData['project']['project']['begin']    = '2025-01-01';
$lang->ai->prompts->testData['project']['project']['end']      = '2025-06-01';
$lang->ai->prompts->testData['project']['project']['estimate'] = '800h';

$lang->ai->prompts->testData['project']['programplans']['name']      = array('需求分析與規劃', '系統設計', '開發與測試', '上線準備與發佈');
$lang->ai->prompts->testData['project']['programplans']['desc']      = array('在這一階段，將與各個利益相關者進行溝通，收集、分析並確認網站的功能需求和用戶故事。', '基于確認的需求，進行系統架構設計與頁面原型設計，為後續的開發打下基礎。', '在這一階段，將根據系統設計進行詳細開發，併進行單元測試以確保功能的正確性。', '進行最終的系統測試、用戶驗收測試以及上線準備，確保官網能夠順利交付。');
$lang->ai->prompts->testData['project']['programplans']['status']    = array('已關閉', '已關閉', '進行中', '未開始');
$lang->ai->prompts->testData['project']['programplans']['begin']     = array('2025-01-01', '2025-02-01', '2025-04-01', '2025-05-15');
$lang->ai->prompts->testData['project']['programplans']['end']       = array('2025-01-31', '2025-02-28', '2025-05-14', '2025-06-01');
$lang->ai->prompts->testData['project']['programplans']['realBegan'] = array('2025-01-01', '2025-02-01', '2025-04-01', '-');
$lang->ai->prompts->testData['project']['programplans']['realEnd']   = array('2025-01-31', '2025-02-28', '-', '-');
$lang->ai->prompts->testData['project']['programplans']['progress']  = array('100%', '100%', '41%', '0%');
$lang->ai->prompts->testData['project']['programplans']['estimate']  = array('190', '190', '290', '120');
$lang->ai->prompts->testData['project']['programplans']['consumed']  = array('200', '190', '120', '0');
$lang->ai->prompts->testData['project']['programplans']['left']      = array('0', '0', '170', '120');

$lang->ai->prompts->testData['project']['executions']['name']      = array('企業網站1.0', '企業網站2.0', '企業網站3.0');
$lang->ai->prompts->testData['project']['executions']['desc']      = array('開發智能企業官網的核心功能模組，包括首頁、新聞中心和關於我們，完成單元測試。', '實現企業網站2.0版本，包括成果展示和售後服務頁面，修復y1.0版本Bug，完成單元測試', '開發附加功能模組，如聯繫方式、工商信息等，同時進行整合測試，確保各模組協同工作。');
$lang->ai->prompts->testData['project']['executions']['status']    = array('進行中', '未開始', '未開始');
$lang->ai->prompts->testData['project']['executions']['begin']     = array('2025-04-01', '2025-04-14', '2025-04-21');
$lang->ai->prompts->testData['project']['executions']['end']       = array('2025-04-11', '2025-04-18', '2025-05-14');
$lang->ai->prompts->testData['project']['executions']['realBegan'] = array('2025-04-01', '-', '-');
$lang->ai->prompts->testData['project']['executions']['realEnd']   = array('-', '-', '-');
$lang->ai->prompts->testData['project']['executions']['estimate']  = array('120', '100', '70');
$lang->ai->prompts->testData['project']['executions']['consumed']  = array('77', '0', '0');
$lang->ai->prompts->testData['project']['executions']['left']      = array('50', '100', '70');
$lang->ai->prompts->testData['project']['executions']['progress']  = array('64%', '0%', '0%');

$lang->ai->prompts->testData['story']['story']['title']    = '實現企業網站首頁';
$lang->ai->prompts->testData['story']['story']['spec']     = "作為本公司的用戶，我希望在首頁能夠方便地獲取網站的基本信息，以便我能夠快速瞭解公司的最新動態、部分成果展示、聯繫方式及工商信息等。\n - 公司最新動態模組。\n - 公司成果展示模組。\n - 公司聯繫方式和工商信息展示。";
$lang->ai->prompts->testData['story']['story']['verify']   = "1. 首頁應包含最新動態版塊，展示最近的新聞和活動信息。\n2. 應有一個部分成果展示區，突出公司過去的重要項目和成就。\n 3. 明確展示聯繫方式，包括電話、電子郵件和地址，確保訪客能輕鬆找到。\n 4. 工商信息應詳細列出，包括公司註冊信息和相關資質，確保用戶能夠核實公司的合法性和可靠性。\n 5. 所有信息應在首頁清晰可見，佈局美觀，易於導航。";
$lang->ai->prompts->testData['story']['story']['product']  = '企業網站建設平台';
$lang->ai->prompts->testData['story']['story']['module']   = '首頁';
$lang->ai->prompts->testData['story']['story']['pri']      = '1';
$lang->ai->prompts->testData['story']['story']['category'] = '研發需求';
$lang->ai->prompts->testData['story']['story']['estimate'] = '3sp';

$lang->ai->prompts->testData['productplan']['productplan']['title']  = '2.0版本';
$lang->ai->prompts->testData['productplan']['productplan']['desc']   = "- 實現企業網站2.0版本，包括成果展示和售後服務頁面 \n - 修復1.0版本遺留的Bug";
$lang->ai->prompts->testData['productplan']['productplan']['begin']  = '2025-04-14';
$lang->ai->prompts->testData['productplan']['productplan']['end']    = '2025-04-18';

$lang->ai->prompts->testData['productplan']['stories']['title']    = array('實現成果展示頁面', '實現售後服務頁面');
$lang->ai->prompts->testData['productplan']['stories']['module']   = array('成果展示', '售後服務');
$lang->ai->prompts->testData['productplan']['stories']['pri']      = array('1', '1');
$lang->ai->prompts->testData['productplan']['stories']['estimate'] = array('1sp', '2sp');
$lang->ai->prompts->testData['productplan']['stories']['status']   = array('激活', '激活');
$lang->ai->prompts->testData['productplan']['stories']['stage']    = array('測試中', '研發中');

$lang->ai->prompts->testData['productplan']['bugs']['title']  = array('首頁最新動態模組報錯', '成果展示表徵圖與標題重疊');
$lang->ai->prompts->testData['productplan']['bugs']['pri']    = array('1', '2');
$lang->ai->prompts->testData['productplan']['bugs']['status'] = array('已解決', '激活');

$lang->ai->prompts->testData['release']['release']['product'] = '企業網站建設平台';
$lang->ai->prompts->testData['release']['release']['name']    = '企業官網1.0版本';
$lang->ai->prompts->testData['release']['release']['desc']    = "- 實現企業網站首頁 \n - 實現新聞中心頁面 \n - 實現關於我們頁面";
$lang->ai->prompts->testData['release']['release']['date']    = '2025-04-11';

$lang->ai->prompts->testData['release']['stories']['title']    = array('實現企業網站首頁', '實現新聞中心頁面', '實現關於我們頁面');
$lang->ai->prompts->testData['release']['stories']['estimate'] = array('3sp', '2sp', '1sp');

$lang->ai->prompts->testData['release']['bugs']['title']  = '無';

$lang->ai->prompts->testData['execution']['execution']['name']     = '企業網站1.0';
$lang->ai->prompts->testData['execution']['execution']['desc']     = '開發智能企業官網的核心功能模組，包括首頁、新聞中心和關於我們，完成單元測試。';
$lang->ai->prompts->testData['execution']['execution']['estimate'] = '120';

$lang->ai->prompts->testData['execution']['tasks']['name']         = array('迭代計劃會', '首頁開發設計', '首頁開發', '首頁測試', '新聞中心開發設計', '新聞中心頁面開發', '新聞中心頁面測試', '關於我們開發設計', '關於我們頁面開發', '關於我們頁面測試', '迭代回顧會');
$lang->ai->prompts->testData['execution']['tasks']['pri']          = array('1', '1', '2', '3', '1', '2', '3', '1', '2', '3', '4');
$lang->ai->prompts->testData['execution']['tasks']['status']       = array('已關閉', '已完成', '已完成', '進行中', '已完成', '進行中', '未開始', '進行中', '未開始', '未開始', '未開始');
$lang->ai->prompts->testData['execution']['tasks']['estimate']     = array('40h', '12h', '10h', '2h', '6h', '8h', '4h', '4h', '8h', '4h', '22h');
$lang->ai->prompts->testData['execution']['tasks']['consumed']     = array('40h', '12h', '10h', '1h', '6h', '6h', '0h', '2h', '0h', '0h', '0h');
$lang->ai->prompts->testData['execution']['tasks']['left']         = array('0h', '0h', '0h', '1h', '0h', '2h', '4h', '2h', '8h', '4h', '22h');
$lang->ai->prompts->testData['execution']['tasks']['progress']     = array('100%', '100%', '100%', '50%', '100%', '75%', '0%', '50%', '0%', '0%', '0%');
$lang->ai->prompts->testData['execution']['tasks']['estStarted']   = array('2025-04-01', '2025-04-01', '2025-04-02', '2025-04-04', '2025-04-02', '2025-04-02', '2025-04-07', '2025-04-03', '2025-04-03', '2025-04-08', '2025-04-11');
$lang->ai->prompts->testData['execution']['tasks']['realStarted']  = array('2025-04-01', '2025-04-01', '2025-04-02', '2025-04-04', '2025-04-02', '2025-04-02', '-', '2025-04-03', '-', '-', '-');
$lang->ai->prompts->testData['execution']['tasks']['finishedDate'] = array('2025-04-01', '2025-04-01', '2025-04-04', '-', '2025-04-02', '-', '-', '-', '-', '-', '-');
$lang->ai->prompts->testData['execution']['tasks']['closedReason'] = array('已完成', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-');

$lang->ai->prompts->testData['task']['task']['name']        = '迭代計劃會';
$lang->ai->prompts->testData['task']['task']['desc']        = "迭代計劃會旨在確保團隊在下一個開發周期內的工作具有清晰的方向和目標，促進團隊成員之間的溝通與協作，並幫助團隊合理分配資源。<br> 本次計劃會任務目標是：產品經理跟研發和測試人員澄清企業官網的核心功能模組（包括首頁、新聞中心和關於我們）的需求，保證研發測試能在迭代周期內按期完成計劃需求。";
$lang->ai->prompts->testData['task']['task']['pri']         = '1';
$lang->ai->prompts->testData['task']['task']['status']      = '已關閉';
$lang->ai->prompts->testData['task']['task']['estimate']    = '40h';
$lang->ai->prompts->testData['task']['task']['consumed']    = '40h';
$lang->ai->prompts->testData['task']['task']['left']        = '0h';
$lang->ai->prompts->testData['task']['task']['progress']    = '100%';
$lang->ai->prompts->testData['task']['task']['story']       = 0;
$lang->ai->prompts->testData['task']['task']['estStarted']  = '2025-04-01';
$lang->ai->prompts->testData['task']['task']['realStarted'] = '2025-04-01';

$lang->ai->prompts->testData['case']['case']['title']         = '實現企業網站首頁';
$lang->ai->prompts->testData['case']['case']['precondition']  = '1. 企業網站的基礎框架已建成，並部署在伺服器上。2. 用戶已能訪問企業網站。';
$lang->ai->prompts->testData['case']['case']['scene']         = '用戶訪問企業網站首頁';
$lang->ai->prompts->testData['case']['case']['product']       = '企業網站建設平台';
$lang->ai->prompts->testData['case']['case']['module']        = '首頁';
$lang->ai->prompts->testData['case']['case']['pri']           = '1';
$lang->ai->prompts->testData['case']['case']['type']          = '功能測試';
$lang->ai->prompts->testData['case']['case']['lastRunResult'] = '通過';
$lang->ai->prompts->testData['case']['case']['status']        = '正常';

$lang->ai->prompts->testData['case']['steps']['desc']   = array('1.用戶訪問企業網站首頁。', '2.用戶查看最新動態模組，檢查是否包含最近的新聞和活動信息。', '3.用戶查看成果展示模組，檢查是否突出展示公司的重要項目和成就。', '4.用戶查看聯繫方式模組，確認包含有效的電話、電子郵件和公司地址。', '5.用戶查看工商信息模組，確認公司註冊信息和相關資質是否詳細且準確。', '6.檢查所有信息的顯示位置是否清晰可見。', '7.用戶使用導航功能查看其他頁面，確保導航易於使用。');
$lang->ai->prompts->testData['case']['steps']['expect'] = array('用戶成功訪問企業網站首頁，首頁加載正常。', '最新動態模組：顯示最近的新聞和活動信息', '成果展示模組：突出展示公司過去的重要項目和成就。', '聯繫方式模組：清晰展示電話、電子郵件和地址，用戶能夠輕鬆找到。', '工商信息模組：詳細列出公司註冊信息和相關資質。', '用戶能夠一眼看到所有信息，且信息的位置合理，版面美觀。', '用戶能夠順利使用導航功能找到其他相關頁面，導航過程流暢無障礙。');

$lang->ai->prompts->testData['bug']['bug']['title']     = '首頁最新動態模組報錯';
$lang->ai->prompts->testData['bug']['bug']['steps']     = "步驟：<br> 1. 打開應用首頁<br> 2. 滾動到最新動態模組 <br>結果：<br> 觀察到模組出現錯誤提示。<br>期望：<br> 正常顯示最新動態，沒有報錯。";
$lang->ai->prompts->testData['bug']['bug']['severity']  = '1';
$lang->ai->prompts->testData['bug']['bug']['pri']       = '1';
$lang->ai->prompts->testData['bug']['bug']['status']    = '已解決';
$lang->ai->prompts->testData['bug']['bug']['confirmed'] = '已確認';
$lang->ai->prompts->testData['bug']['bug']['type']      = '代碼錯誤';

$lang->ai->prompts->testData['doc']['doc']['title']      = '為何精心打造的產品遭遇市場冷遇？';
$lang->ai->prompts->testData['doc']['doc']['addedBy']    = '-';
$lang->ai->prompts->testData['doc']['doc']['addedDate']  = '-';
$lang->ai->prompts->testData['doc']['doc']['editedBy']   = '-';
$lang->ai->prompts->testData['doc']['doc']['editedDate'] = '-';
$lang->ai->prompts->testData['doc']['doc']['content']    = '每一位產品人都曾經歷過這樣的困惑：<br>
我們投入了無數心血開發的產品，性能遠超競品，價格也有競爭力，團隊對它充滿信心...然而市場反饋卻冷若冰霜。銷售數據慘淡，用戶增長停滯，投資回報遙遙無期。<br>
更令人沮喪的是，當你召集團隊分析原因時，每個部門都有自己的解釋：<br>
"是營銷預算不夠！"<br>"是渠道策略有問題！"<br>"是市場還沒教育好！"<br>"是銷售團隊執行不到位！"<br>
眾說紛紜中，真相卻越來越模糊。你開始懷疑：我們到底忽略了什麼？為什麼看似完美的產品就是贏不了市場？<br>
事實上，產品成功從來不是單一因素決定的。就像一把精密的鎖，需要所有齒輪都對準才能順利打開。而在競爭激烈的市場中，產品不是輸在你最擅長的地方，而是倒在你未曾注意的短板上。<br>
產品成功的八維度全景圖<br>
$APPEALS模型正是幫助我們找出這塊"短板"的系統工具。它將產品競爭力分解為八個關鍵維度：<br>
$（Price，產品價格）：不僅是數字高低，更關乎價值感知<br>
A（Availability，可獲得性）：產品多容易被目標用戶獲取到<br>
P（Packaging，包裝）：從視覺到觸感的整體體驗<br>
P（Performance，性能）：核心功能的實際表現<br>
E（Easy to use，易用性）：用戶上手和使用的便捷程度<br>
A（Assurances，保證程度）：品質保障和售後服務<br>
L（Life cycle of cost，生命周期成本）：長期使用的總體成本<br>
S（Social acceptance，社會接受程度）：品牌形象與社會認同<br>
這八個維度共同構成了產品市場競爭力的全景圖。就像醫生需要全面體檢才能找出病因，產品團隊也需要通過$APPEALS模型的全面診斷，才能發現真正的問題所在。<br>
從主觀判斷到數據驅動決策<br>
有人會提出疑問："但是，這些維度我們平時也會考慮啊，有什麼不同嗎？"<br>
確實，有經驗的產品經理往往憑直覺就能考慮到多個因素。然而，直覺分析存在三大陷阱：<br>
維度遺漏：我們往往關注自己熟悉的領域，而忽視其他維度<br>
主觀偏見：對自家產品的"情感投入"容易導致評估偏差<br>
權重混亂：不同市場、不同產品類型，各維度的重要性大不相同<br>
$APPEALS模型通過結構化分析，將模糊的直覺轉化為清晰的數據，讓產品決策更加科學、客觀。<br>
讓強大模型觸手可及<br>
然而，知道$APPEALS模型只是第一步，如何有效應用它才是關鍵。這就是我們開發"禪道決策分析解決方案"的初衷——讓強大的理論模型變得簡單易用。<br>
"禪道決策分析解決方案"是一款專為產品和市場決策者打造的智能分析工具，強大的模型設計器將$APPEALS模型數字化、流程化，幫助團隊快速找出產品的競爭優勢和致命短板。<br>
智能分析如何解鎖產品潛力??<br>
維度權重智能配置<br>
不同行業、不同產品類型，八大維度的重要性各不相同。禪道決策分析解決方案可根據產品特性智能推薦$APPEALS各維度權重配置，也支持團隊根據行業經驗進行自定義調整。<br>
結構化問題引導<br>
每個維度下，"思引師"設計了一系列關鍵問題，引導團隊全面思考。例如在"社會接受度"維度下，系統會引導你思考："產品是否符合當前社會價值觀？""是否有知名KOL認可？""用戶使用產品是否會獲得社交認同？"<br>
競品對比分析<br>
同時評估多個競品，通過雷達圖直觀展示各產品在八維度上的表現差異，一目瞭然地發現自身產品的優勢與劣勢。<br>
智能改進建議<br>
基于分析結果，提供表格視圖，支持按問題查看和按分析對象查看兩種方式，多視角總覽分析結果。並提供內置圖形結果建議，讓資源投入更加精準高效。<br>
從問題到解決方案的四步路徑??<br>
配置對象：定義要分析的主體產品、所處細分市場和競對產品。<br>維度配置：調整八大維度定義及權重，突出關鍵因素。<br>問題評估：團隊共同回答系統引導的結構化問題，併進行對比打分。<br>改進規劃：多角度總覽分析結果和系統建議，制定優化方案。<br>
整個過程通常只需1-2小時，卻能避免數月的市場試錯成本。正如一位用戶所說："$APPEALS模型就像產品的全息掃描器，它以結構化的方式揭示了我們長期忽視的系統性問題，讓產品決策從主觀猜測轉向了數據驅動的精準分析。"<br>
禪道決策分析解決方案的價值不僅在於分析，更在於它改變了團隊的思考方式：<br>
打破部門壁壘：八維度分析需要研發、市場、銷售等多部門共同參與，促進了跨部門協作。<br>
克服認知偏見：結構化問題和數據可視化幫助團隊跳出主觀判斷。<br>
形成共識基礎：基于同一模型的分析結果，讓團隊更容易達成戰略共識。<br>
讓數據為你的產品決策保駕護航<br>
產品為什麼賣不動？答案往往不在你已知的強項上，而隱藏在那些被忽視的維度中。$APPEALS八維度分析框架就像一張精準的市場地圖，為你導航出產品成功的最佳路徑。<br>
當市場反饋不如預期，當競爭對手似乎總能搶佔先機，不要再憑直覺做決策。系統性的分析才能帶來真正的突破。<br>
如果你的產品正面臨市場困境，如果你渴望在激烈的競爭中找到真正的差異化優勢，$APPEALS分析將是你最有力的決策工具。<br>
即日起，我們提供為期30天的免費試用，掃瞄下方二維碼，立即開啟你的產品診斷之旅。讓數據驅動決策，讓模型指引方向，讓你的產品找到真正的競爭力！';

/* Finalize page. */
$lang->ai->moduleDisableTip = '系統根據所選對象自動關聯分組';

/* Data source definition. */
$lang->ai->dataSource = array();

$lang->ai->dataSource['my']['common']          = '地盤';
$lang->ai->dataSource['product']['common']     = '產品';
$lang->ai->dataSource['story']['common']       = '需求';
$lang->ai->dataSource['productplan']['common'] = '計劃';
$lang->ai->dataSource['release']['common']     = '發佈';
$lang->ai->dataSource['project']['common']     = '項目';
$lang->ai->dataSource['execution']['common']   = '執行';
$lang->ai->dataSource['task']['common']        = '任務';
$lang->ai->dataSource['bug']['common']         = 'Bug';
$lang->ai->dataSource['case']['common']        = '用例';
$lang->ai->dataSource['doc']['common']         = '文檔';

$lang->ai->dataSource['my']['efforts']['common']    = '日誌列表';
$lang->ai->dataSource['my']['efforts']['date']      = '日期';
$lang->ai->dataSource['my']['efforts']['work']      = '工作內容';
$lang->ai->dataSource['my']['efforts']['account']   = '記錄人';
$lang->ai->dataSource['my']['efforts']['consumed']  = '耗時';
$lang->ai->dataSource['my']['efforts']['left']      = '剩餘';
$lang->ai->dataSource['my']['efforts']['objectID']  = '對象';
$lang->ai->dataSource['my']['efforts']['product']   = '產品';
$lang->ai->dataSource['my']['efforts']['project']   = '項目';
$lang->ai->dataSource['my']['efforts']['execution'] = '執行';

$lang->ai->dataSource['product']['product']['common']  = '產品';
$lang->ai->dataSource['product']['product']['name']    = '產品名稱';
$lang->ai->dataSource['product']['product']['desc']    = '產品描述';
$lang->ai->dataSource['product']['modules']['common']  = '產品模組列表';
$lang->ai->dataSource['product']['modules']['name']    = '模組名稱';
$lang->ai->dataSource['product']['modules']['modules'] = '子模組';

$lang->ai->dataSource['productplan']['productplan']['common'] = '計劃';
$lang->ai->dataSource['productplan']['productplan']['title']  = '計劃名稱';
$lang->ai->dataSource['productplan']['productplan']['desc']   = '計劃描述';
$lang->ai->dataSource['productplan']['productplan']['begin']  = '開始時間';
$lang->ai->dataSource['productplan']['productplan']['end']    = '結束時間';

$lang->ai->dataSource['productplan']['stories']['common']   = '需求列表';
$lang->ai->dataSource['productplan']['stories']['title']    = '需求名稱';
$lang->ai->dataSource['productplan']['stories']['module']   = '所屬模組';
$lang->ai->dataSource['productplan']['stories']['pri']      = '優先順序';
$lang->ai->dataSource['productplan']['stories']['estimate'] = '預計故事點';
$lang->ai->dataSource['productplan']['stories']['status']   = '狀態';
$lang->ai->dataSource['productplan']['stories']['stage']    = '階段';

$lang->ai->dataSource['productplan']['bugs']['common'] = 'Bug列表';
$lang->ai->dataSource['productplan']['bugs']['title']  = 'Bug標題';
$lang->ai->dataSource['productplan']['bugs']['pri']    = '優先順序';
$lang->ai->dataSource['productplan']['bugs']['status'] = '狀態';

$lang->ai->dataSource['release']['release']['common']  = '發佈';
$lang->ai->dataSource['release']['release']['product'] = '所屬產品';
$lang->ai->dataSource['release']['release']['name']    = '發佈名稱';
$lang->ai->dataSource['release']['release']['desc']    = '發佈描述';
$lang->ai->dataSource['release']['release']['date']    = '發佈日期';

$lang->ai->dataSource['release']['stories']['common']   = '需求列表';
$lang->ai->dataSource['release']['stories']['title']    = '需求名稱';
$lang->ai->dataSource['release']['stories']['estimate'] = '預估故事點';

$lang->ai->dataSource['release']['bugs']['common'] = 'Bug列表';
$lang->ai->dataSource['release']['bugs']['title']  = 'Bug標題';

$lang->ai->dataSource['project']['project']['common']   = '項目';
$lang->ai->dataSource['project']['project']['name']     = '項目名稱';
$lang->ai->dataSource['project']['project']['type']     = '項目類型';
$lang->ai->dataSource['project']['project']['desc']     = '項目描述';
$lang->ai->dataSource['project']['project']['begin']    = '計劃開始';
$lang->ai->dataSource['project']['project']['end']      = '計劃結束';
$lang->ai->dataSource['project']['project']['estimate'] = '預計工時';

$lang->ai->dataSource['project']['programplans']['common']    = '階段列表';
$lang->ai->dataSource['project']['programplans']['name']      = '階段名稱';
$lang->ai->dataSource['project']['programplans']['desc']      = '階段描述';
$lang->ai->dataSource['project']['programplans']['status']    = '階段狀態';
$lang->ai->dataSource['project']['programplans']['begin']     = '計劃開始';
$lang->ai->dataSource['project']['programplans']['end']       = '計劃完成';
$lang->ai->dataSource['project']['programplans']['realBegan'] = '實際開始';
$lang->ai->dataSource['project']['programplans']['realEnd']   = '實際完成';
$lang->ai->dataSource['project']['programplans']['progress']  = '任務進度';
$lang->ai->dataSource['project']['programplans']['estimate']  = '預計工時';
$lang->ai->dataSource['project']['programplans']['consumed']  = '消耗工時';
$lang->ai->dataSource['project']['programplans']['left']      = '剩餘工時';

$lang->ai->dataSource['project']['executions']['common']    = '迭代列表';
$lang->ai->dataSource['project']['executions']['name']      = '執行名稱';
$lang->ai->dataSource['project']['executions']['desc']      = '執行描述';
$lang->ai->dataSource['project']['executions']['status']    = '執行狀態';
$lang->ai->dataSource['project']['executions']['begin']     = '計劃開始';
$lang->ai->dataSource['project']['executions']['end']       = '計劃完成';
$lang->ai->dataSource['project']['executions']['realBegan'] = '實際開始';
$lang->ai->dataSource['project']['executions']['realEnd']   = '實際完成';
$lang->ai->dataSource['project']['executions']['estimate']  = '預計工時';
$lang->ai->dataSource['project']['executions']['consumed']  = '消耗工時';
$lang->ai->dataSource['project']['executions']['left']      = '剩餘工時';
$lang->ai->dataSource['project']['executions']['progress']  = '進度';

$lang->ai->dataSource['story']['story']['common']   = '需求';
$lang->ai->dataSource['story']['story']['title']    = '需求標題';
$lang->ai->dataSource['story']['story']['spec']     = '需求描述';
$lang->ai->dataSource['story']['story']['verify']   = '驗收標準';
$lang->ai->dataSource['story']['story']['product']  = '產品';
$lang->ai->dataSource['story']['story']['module']   = '模組';
$lang->ai->dataSource['story']['story']['pri']      = '優先順序';
$lang->ai->dataSource['story']['story']['category'] = '需求類型';
$lang->ai->dataSource['story']['story']['estimate'] = '預計工時';

$lang->ai->dataSource['execution']['execution']['common']   = '執行';
$lang->ai->dataSource['execution']['execution']['name']     = '執行名稱';
$lang->ai->dataSource['execution']['execution']['desc']     = '執行描述';
$lang->ai->dataSource['execution']['execution']['estimate'] = '預計工時';

$lang->ai->dataSource['execution']['tasks']['common']       = '任務列表';
$lang->ai->dataSource['execution']['tasks']['name']         = '任務名稱';
$lang->ai->dataSource['execution']['tasks']['pri']          = '優先順序';
$lang->ai->dataSource['execution']['tasks']['status']       = '狀態';
$lang->ai->dataSource['execution']['tasks']['estimate']     = '預計工時';
$lang->ai->dataSource['execution']['tasks']['consumed']     = '已消耗';
$lang->ai->dataSource['execution']['tasks']['left']         = '剩餘';
$lang->ai->dataSource['execution']['tasks']['progress']     = '進度';
$lang->ai->dataSource['execution']['tasks']['estStarted']   = '預計開始';
$lang->ai->dataSource['execution']['tasks']['realStarted']  = '實際開始';
$lang->ai->dataSource['execution']['tasks']['finishedDate'] = '完成日期';
$lang->ai->dataSource['execution']['tasks']['closedReason'] = '關閉原因';

$lang->ai->dataSource['task']['task']['common']      = '任務';
$lang->ai->dataSource['task']['task']['name']        = '任務名稱';
$lang->ai->dataSource['task']['task']['desc']        = '任務描述';
$lang->ai->dataSource['task']['task']['pri']         = '優先順序';
$lang->ai->dataSource['task']['task']['status']      = '狀態';
$lang->ai->dataSource['task']['task']['estimate']    = '預計';
$lang->ai->dataSource['task']['task']['consumed']    = '消耗';
$lang->ai->dataSource['task']['task']['left']        = '剩餘';
$lang->ai->dataSource['task']['task']['progress']    = '進度';
$lang->ai->dataSource['task']['task']['estStarted']  = '預計開始';
$lang->ai->dataSource['task']['task']['realStarted'] = '實際開始';
$lang->ai->dataSource['task']['task']['story']       = '相關需求';

$lang->ai->dataSource['case']['case']['common']        = '用例';
$lang->ai->dataSource['case']['case']['title']         = '標題';
$lang->ai->dataSource['case']['case']['precondition']  = '前置條件';
$lang->ai->dataSource['case']['case']['scene']         = '所屬場景';
$lang->ai->dataSource['case']['case']['product']       = '所屬產品';
$lang->ai->dataSource['case']['case']['module']        = '所屬模組';
$lang->ai->dataSource['case']['case']['pri']           = '優先順序';
$lang->ai->dataSource['case']['case']['type']          = '類型';
$lang->ai->dataSource['case']['case']['lastRunResult'] = '結果';
$lang->ai->dataSource['case']['case']['status']        = '狀態';

$lang->ai->dataSource['case']['steps']['common'] = '步驟列表';
$lang->ai->dataSource['case']['steps']['desc']   = '步驟描述';
$lang->ai->dataSource['case']['steps']['expect'] = '預期';

$lang->ai->dataSource['bug']['bug']['common']    = 'Bug';
$lang->ai->dataSource['bug']['bug']['title']     = 'Bug標題';
$lang->ai->dataSource['bug']['bug']['steps']     = '重現步驟';
$lang->ai->dataSource['bug']['bug']['severity']  = '級別';
$lang->ai->dataSource['bug']['bug']['pri']       = '優先順序';
$lang->ai->dataSource['bug']['bug']['status']    = '狀態';
$lang->ai->dataSource['bug']['bug']['confirmed'] = '確認';
$lang->ai->dataSource['bug']['bug']['type']      = 'Bug類型';

$lang->ai->dataSource['doc']['doc']['common']     = '文檔';
$lang->ai->dataSource['doc']['doc']['title']      = '文檔標題';
$lang->ai->dataSource['doc']['doc']['content']    = '文檔正文';
$lang->ai->dataSource['doc']['doc']['addedBy']    = '創建者';
$lang->ai->dataSource['doc']['doc']['addedDate']  = '創建日期';
$lang->ai->dataSource['doc']['doc']['editedBy']   = '修改者';
$lang->ai->dataSource['doc']['doc']['editedDate'] = '修改日期';

/* Target form definition. See `$config->ai->targetForm`. */
$lang->ai->targetForm = array();
$lang->ai->targetForm['product']['common']        = '產品';
$lang->ai->targetForm['story']['common']          = '需求';
$lang->ai->targetForm['productplan']['common']    = '計劃';
$lang->ai->targetForm['projectrelease']['common'] = '發佈';
$lang->ai->targetForm['project']['common']        = '項目';
$lang->ai->targetForm['execution']['common']      = '執行';
$lang->ai->targetForm['task']['common']           = '任務';
$lang->ai->targetForm['testcase']['common']       = '用例';
$lang->ai->targetForm['bug']['common']            = 'Bug';
$lang->ai->targetForm['doc']['common']            = '文檔';
$lang->ai->targetForm['empty']['common']          = '';

$lang->ai->targetForm['product']['tree/managechild'] = '維護模組';
$lang->ai->targetForm['product']['doc/create']       = '創建文檔';

$lang->ai->targetForm['story']['create']         = '提需求';
$lang->ai->targetForm['story']['batchcreate']    = '批量提需求';
$lang->ai->targetForm['story']['change']         = '變更需求';
$lang->ai->targetForm['story']['totask']         = '需求建任務';
$lang->ai->targetForm['story']['testcasecreate'] = '需求建用例';
$lang->ai->targetForm['story']['subdivide']      = '需求細分';

$lang->ai->targetForm['productplan']['edit']   = '編輯計劃';
$lang->ai->targetForm['productplan']['create'] = '創建子計劃';

$lang->ai->targetForm['projectrelease']['doc/create'] = '創建文檔';

$lang->ai->targetForm['project']['risk/create']        = '創建風險';
$lang->ai->targetForm['project']['issue/create']       = '創建問題';
$lang->ai->targetForm['project']['doc/create']         = '創建文檔';
$lang->ai->targetForm['project']['programplan/create'] = '設置階段';

$lang->ai->targetForm['execution']['batchcreatetask']  = '批量創建任務';
$lang->ai->targetForm['execution']['createtestreport'] = '創建測試報告';
$lang->ai->targetForm['execution']['createqa']         = '創建 QA';
$lang->ai->targetForm['execution']['createrisk']       = '創建風險';
$lang->ai->targetForm['execution']['createissue']      = '創建問題';

$lang->ai->targetForm['task']['edit']        = '編輯任務';
$lang->ai->targetForm['task']['batchcreate'] = '批量創建子任務';

$lang->ai->targetForm['testcase']['edit']         = '編輯用例';
$lang->ai->targetForm['testcase']['createscript'] = '創建自動化腳本';

$lang->ai->targetForm['bug']['edit']            = '編輯 Bug';
$lang->ai->targetForm['bug']['story/create']    = 'Bug 轉需求';
$lang->ai->targetForm['bug']['testcase/create'] = 'Bug 建用例';

$lang->ai->targetForm['doc']['create'] = '創建文檔';
$lang->ai->targetForm['doc']['edit']   = '編輯文檔';

$lang->ai->targetForm['empty']['empty'] = '空';

$lang->ai->prompts->statuses = array();
$lang->ai->prompts->statuses['']       = '全部';
$lang->ai->prompts->statuses['draft']  = '未發佈';
$lang->ai->prompts->statuses['active'] = '已發佈';

$lang->ai->featureBar['prompts']['']       = '全部';
$lang->ai->featureBar['prompts']['draft']  = '未發佈';
$lang->ai->featureBar['prompts']['active'] = '已發佈';

$lang->ai->prompts->modules = array();
$lang->ai->prompts->modules['']            = '所有分組';
// $lang->ai->prompts->modules['my']          = '地盤';
$lang->ai->prompts->modules['product']     = '產品';
$lang->ai->prompts->modules['project']     = '項目';
$lang->ai->prompts->modules['story']       = '需求';
$lang->ai->prompts->modules['productplan'] = '計劃';
$lang->ai->prompts->modules['release']     = '發佈';
$lang->ai->prompts->modules['execution']   = '執行';
$lang->ai->prompts->modules['task']        = '任務';
$lang->ai->prompts->modules['case']        = '用例';
$lang->ai->prompts->modules['bug']         = 'Bug';
$lang->ai->prompts->modules['doc']         = '文檔';

$lang->ai->conversations = new stdclass();
$lang->ai->conversations->common = '會話';

$lang->ai->miniPrograms                    = new stdClass();
$lang->ai->miniPrograms->common            = '通用智能體';
$lang->ai->miniPrograms->emptyList         = '暫時沒有通用智能體。';
$lang->ai->miniPrograms->create            = '創建通用智能體';
$lang->ai->miniPrograms->configuration     = '基本信息配置';
$lang->ai->miniPrograms->downloadTip       = '發佈後將在通用智能體廣場上展示，並會自動同步到客戶端上。';
$lang->ai->miniPrograms->download          = '下載禪道客戶端';
$lang->ai->miniPrograms->category          = '所屬分類';
$lang->ai->miniPrograms->icon              = '表徵圖';
$lang->ai->miniPrograms->desc              = '簡介';
$lang->ai->miniPrograms->categoryList      = array('work' => '工作', 'personal' => '個人', 'life' => '生活', 'creative' => '創意', 'others' => '其它');
$lang->ai->miniPrograms->allCategories     = array('' => '所有分組');
$lang->ai->miniPrograms->collect           = '收藏';
$lang->ai->miniPrograms->more              = '更多';
$lang->ai->miniPrograms->iconModification  = '表徵圖修改';
$lang->ai->miniPrograms->customBackground  = '自定義背景色';
$lang->ai->miniPrograms->customIcon        = '自定義icon';
$lang->ai->miniPrograms->backToListPage    = '返回列表頁';
$lang->ai->miniPrograms->lastStep          = '上一步';
$lang->ai->miniPrograms->backToListPageTip = '選擇對象的參數配置已變動，是否保存並返回？';
$lang->ai->miniPrograms->saveAndBack       = '保存並返回';
$lang->ai->miniPrograms->publishConfirm    = array('您確定要發佈嗎？', '發佈後將在一級導航AI模組中顯示，客戶端將會同步更新。');
$lang->ai->miniPrograms->emptyPrompterTip  = '通用智能體提詞為空，請編輯後再進行發佈';
$lang->ai->miniPrograms->maintenanceGroup  = '維護通用智能體分組';

$lang->ai->miniPrograms->latestPublishedDate = '最新發佈時間';
$lang->ai->miniPrograms->deleteTip           = '確定刪除該通用智能體？';
$lang->ai->miniPrograms->disableTip          = '下架通用智能體用戶將無法使用，是否確認下架？';
$lang->ai->miniPrograms->publishTip          = '發佈後將在通用智能體模型廣場中顯示，客戶端將會同步更新。';
$lang->ai->miniPrograms->unpublishedTip      = '您使用的通用智能體沒有發佈';

$lang->ai->miniPrograms->placeholder          = new stdClass();
$lang->ai->miniPrograms->placeholder->name    = '請輸入通用智能體名稱';
$lang->ai->miniPrograms->placeholder->desc    = '請輸入通用智能體簡介';
$lang->ai->miniPrograms->placeholder->default = '請輸入填寫提示，預設為“請輸入”';
$lang->ai->miniPrograms->placeholder->input   = '請輸入';
$lang->ai->miniPrograms->placeholder->prompt  = '請輸入提詞設計';
$lang->ai->miniPrograms->placeholder->asking  = '繼續追問';

$lang->ai->miniPrograms->deleteFieldTip = '您確定刪除該欄位嗎？';

$lang->ai->miniPrograms->field                      = new stdClass();
$lang->ai->miniPrograms->field->name                = '欄位名稱';
$lang->ai->miniPrograms->field->duplicatedNameTip   = '該名稱已使用，請嘗試其他名稱';
$lang->ai->miniPrograms->field->type                = '控件類型';
$lang->ai->miniPrograms->field->typeList            = array('text' => '單行文本', 'textarea' => '多行文本', 'radio' => '單選', 'checkbox' => '多選');
$lang->ai->miniPrograms->field->placeholder         = '填寫提示';
$lang->ai->miniPrograms->field->required            = '是否必填';
$lang->ai->miniPrograms->field->requiredOptions     = array('否', '是');
$lang->ai->miniPrograms->field->add                 = '新增欄位';
$lang->ai->miniPrograms->field->addTip              = '請點擊此處以添加欄位信息';
$lang->ai->miniPrograms->field->edit                = '編輯欄位';
$lang->ai->miniPrograms->field->configuration       = '配置區';
$lang->ai->miniPrograms->field->debug               = '調試區';
$lang->ai->miniPrograms->field->preview             = '預覽區';
$lang->ai->miniPrograms->field->fields              = '表單配置';
$lang->ai->miniPrograms->field->prompt              = '提詞';
$lang->ai->miniPrograms->field->fieldConfig         = '欄位配置';
$lang->ai->miniPrograms->field->knowledgeLibs       = '知識庫掛載';
$lang->ai->miniPrograms->field->option              = '選項';
$lang->ai->miniPrograms->field->contentDebugging    = '內容調試';
$lang->ai->miniPrograms->field->contentDebuggingTip = '請在此處輸入欄位內容進行調試。';
$lang->ai->miniPrograms->field->prompterDesign      = '提詞設計';
$lang->ai->miniPrograms->field->prompterDesignTip   = '輸入“<>”符號可引用已配置的欄位，“<>”前後採用空格進行間隔。';
$lang->ai->miniPrograms->field->prompterPreview     = '提詞預覽';
$lang->ai->miniPrograms->field->generateResult      = '生成結果';
$lang->ai->miniPrograms->field->resultPreview       = '結果預覽';

$lang->ai->miniPrograms->field->default = array(
    '角色',
    '場景',
    '目標',
    '作為一名 <角色> ，我希望在 <場景> 時，能 <目標> 。'
);

$lang->ai->miniPrograms->field->emptyNameWarning       = '「%s」不能為空';
$lang->ai->miniPrograms->field->duplicatedNameWarning  = '「%s」重複';
$lang->ai->miniPrograms->field->emptyOptionWarning     = '請至少配置一個選項';

$lang->ai->miniPrograms->statuses = array(
    ''            => '全部',
    'draft'       => '未發佈',
    'active'      => '已發佈',
    'createdByMe' => '由我創建'
);

$lang->ai->featureBar['miniprograms']['']            = '全部';
$lang->ai->featureBar['miniprograms']['draft']       = '未發佈';
$lang->ai->featureBar['miniprograms']['active']      = '已發佈';
$lang->ai->featureBar['miniprograms']['createdByMe'] = '由我創建';

$lang->ai->miniPrograms->publishedOptions   = array('未發佈', '已發佈');
$lang->ai->miniPrograms->optionName         = '選項名稱';
$lang->ai->miniPrograms->promptTemplate     = '提詞模板';
$lang->ai->miniPrograms->fieldConfiguration = '欄位配置';
$lang->ai->miniPrograms->summary            = '本頁共 %s 個通用智能體。';
$lang->ai->miniPrograms->generate           = '生成';
$lang->ai->miniPrograms->regenerate         = '重新生成';
$lang->ai->miniPrograms->noModel            = array('尚未配置語言模型，請聯繫管理員或跳轉至後台配置<a id="to-language-model">語言模型</a>。', '若已完成相關配置，請嘗試<a id="reload-current">重新加載</a>頁面。');
$lang->ai->miniPrograms->clearContext       = '上下文內容已清除';
$lang->ai->miniPrograms->newVersionTip      = '通用智能體已于 %s 更新，以上為過往記錄';
$lang->ai->miniPrograms->disabledTip        = '當前通用智能體已被禁用。';
$lang->ai->miniPrograms->chatNoResponse     = '會話發生了錯誤';

$lang->ai->models = new stdclass();
$lang->ai->models->title          = '語言模型配置';
$lang->ai->models->common         = '語言模型';
$lang->ai->models->name           = '語言模型名稱';
$lang->ai->models->type           = '語言模型';
$lang->ai->models->vendor         = '供應商';
$lang->ai->models->base           = 'API 基礎地址';
$lang->ai->models->key            = 'API Key';
$lang->ai->models->secret         = 'Secret Key';
$lang->ai->models->resource       = 'Resource';
$lang->ai->models->deployment     = 'Deployment';
$lang->ai->models->proxyType      = '代理類型';
$lang->ai->models->proxyAddr      = '代理地址';
$lang->ai->models->description    = '描述';
$lang->ai->models->createdDate    = '添加時間';
$lang->ai->models->createdBy      = '添加者';
$lang->ai->models->editedDate     = '修改時間';
$lang->ai->models->editedBy       = '修改者';
$lang->ai->models->usesProxy      = '使用代理';
$lang->ai->models->testConnection = '測試連接';
$lang->ai->models->unconfigured   = '未配置';
$lang->ai->models->create         = '添加語言模型';
$lang->ai->models->edit           = '編輯模型參數';
$lang->ai->models->view           = '查看模型參數';
$lang->ai->models->enable         = '啟用語言模型';
$lang->ai->models->disable        = '禁用語言模型';
$lang->ai->models->details        = '語言模型詳情';
$lang->ai->models->concealTip     = '完整信息在編輯時可見';
$lang->ai->models->upgradeBiz     = '更多AI功能，盡在<a target="_blank" href="https://www.zentao.net/page/enterprise.html" class="text-blue">企業版</a>！';
$lang->ai->models->noModelError   = '暫無可用的語言模型，請聯繫管理員配置。';
$lang->ai->models->noModels       = '暫時沒有語言模型，添加模型並配置相關參數後可以使用 AI 相關功能。';
$lang->ai->models->confirmDelete  = '刪除模型後，關聯的禪道智能體、通用智能體及AI會話將會無法使用，是否確認刪除？';
$lang->ai->models->confirmDisable = '您確認要禁用該語言模型嗎？';
$lang->ai->models->default        = '預設';
$lang->ai->models->defaultTip     = '預設語言模型（第一個可用的語言模型）將會用於運行未指定語言模型的禪道智能體、通用智能體，也將會用於聊天。';
$lang->ai->models->authFailure    = 'API 認證失敗';

$lang->ai->models->testConnectionResult = new stdclass();
$lang->ai->models->testConnectionResult->success    = '連接成功';
$lang->ai->models->testConnectionResult->fail       = '連接失敗';
$lang->ai->models->testConnectionResult->failFormat = '連接失敗：%s';

$lang->ai->models->statusList = array();
$lang->ai->models->statusList['0']   = '停用';
$lang->ai->models->statusList['off'] = '停用';
$lang->ai->models->statusList['1']   = '啟用';
$lang->ai->models->statusList['on']  = '啟用';

$lang->ai->models->proxyStatusList = array();
$lang->ai->models->proxyStatusList['0']   = '否';
$lang->ai->models->proxyStatusList['off'] = '否';
$lang->ai->models->proxyStatusList['1']   = '是';
$lang->ai->models->proxyStatusList['on']  = '是';

$lang->ai->models->typeList = array();
$lang->ai->models->typeList['openai-gpt35'] = 'OpenAI / GPT-3.5';
$lang->ai->models->typeList['openai-gpt4']  = 'OpenAI / GPT-4';
$lang->ai->models->typeList['baidu-ernie']  = '百度 / 文心一言';

$lang->ai->models->vendorList = new stdclass();
$lang->ai->models->vendorList->{'openai-gpt35'} = array('openai' => 'OpenAI', 'azure' => 'Azure', 'openaiCompatible' => '自定義');
$lang->ai->models->vendorList->{'openai-gpt4'}  = array('openai' => 'OpenAI', 'azure' => 'Azure', 'openaiCompatible' => '自定義');
$lang->ai->models->vendorList->{'baidu-ernie'}  = array('baidu' => '百度千帆大模型平台');

$lang->ai->models->vendorTips = new stdclass();
$lang->ai->models->vendorTips->azure            = 'Azure 中 OpenAI GPT 版本 (3.5 或 4) 需要在創建資源時指定。';
$lang->ai->models->vendorTips->openaiCompatible = '指定的 API 需要支持 Function Calling，否則某些功能可能無法正常使用。';

$lang->ai->models->proxyTypes = array();
$lang->ai->models->proxyTypes['']       = '不使用代理';
$lang->ai->models->proxyTypes['socks5'] = 'SOCKS5';

$lang->ai->models->promptFor = '輸入給 %s';

$lang->ai->designStepNav = array();
$lang->ai->designStepNav['assignrole']       = '指定角色';
$lang->ai->designStepNav['selectdatasource'] = '選擇對象';
$lang->ai->designStepNav['setpurpose']       = '確認操作';
$lang->ai->designStepNav['settargetform']    = '結果處理';
$lang->ai->designStepNav['finalize']         = '準備發佈';

$lang->ai->dataTypeDesc = '%s是%s類型，%s';

$lang->ai->dataType            = new stdclass();
$lang->ai->dataType->pri       = new stdClass();
$lang->ai->dataType->pri->type = '數值';
$lang->ai->dataType->pri->desc = '1 是最高優先順序，4 是最低優先順序。';

$lang->ai->dataType->estimate       = new stdClass();
$lang->ai->dataType->estimate->type = '數值';
$lang->ai->dataType->estimate->desc = '單位為小時。';

$lang->ai->dataType->consumed = $lang->ai->dataType->estimate;
$lang->ai->dataType->left     = $lang->ai->dataType->estimate;

$lang->ai->dataType->progress       = new stdClass();
$lang->ai->dataType->progress->type = '百分比';
$lang->ai->dataType->progress->desc = '0 是未開始，100是已完成。';

$lang->ai->dataType->datetime       = new stdClass();
$lang->ai->dataType->datetime->type = '日期時間';
$lang->ai->dataType->datetime->desc = '格式為：1970-01-01 00:00:01，沒有則留空。';

$lang->ai->dataType->estStarted   = $lang->ai->dataType->datetime;
$lang->ai->dataType->realStarted  = $lang->ai->dataType->datetime;
$lang->ai->dataType->finishedDate = $lang->ai->dataType->datetime;

$lang->ai->demoData            = new stdclass();
$lang->ai->demoData->notExist  = '暫無演示數據。';
$lang->ai->demoData->story     = array(
    'story' => array(
        'title'    => '開發一個在綫學習平台',
        'spec'     => '我們需要開發一個在綫學習平台，能夠提供課程管理、學生管理、教師管理等功能。',
        'verify' => '1. 所有功能均能夠正常運行，沒有明顯的錯誤和異常。2. 界面美觀、易用性好。3. 平台能夠滿足用戶需求，具有較高的用戶滿意度。4. 代碼質量好，結構清晰、易於維護。',
        'module'   => 7,
        'pri'      => 1,
        'estimate' => 1,
        'product'  => 1,
        'category' => 'feature',
    ),
);
$lang->ai->demoData->execution = array(
    'execution' => array(
        'name'     => '在綫學習平台軟件開發',
        'desc'     => '本計劃旨在開發一款在綫學習平台軟件，該軟件將提供可訪問的學習資源，包括文本、視頻和音頻等，以及一些學習工具如考試、測試和討論論壇等。',
        'estimate' => 7,
    ),
    'tasks'     => array(
        0 =>
        array(
            'name'         => '技術選型',
            'pri'          => 1,
            'status'       => 'done',
            'estimate'     => 1,
            'consumed'     => 1,
            'left'         => 0,
            'progress'     => 100,
            'estStarted'   => '2023-07-02 00:00:00',
            'realStarted'  => '2023-07-02 00:00:00',
            'finishedDate' => '2023-07-02 00:00:00',
            'closedReason' => '已完成',
        ),
        1 =>
        array(
            'name'         => 'UI設計',
            'pri'          => 1,
            'status'       => 'doing',
            'estimate'     => 2,
            'consumed'     => 1,
            'left'         => 1,
            'progress'     => 50,
            'estStarted'   => '2023-07-03 00:00:00',
            'realStarted'  => '2023-07-03 00:00:00',
            'finishedDate' => '',
            'closedReason' => '',
        ),
        2 =>
        array(
            'name'         => '開發',
            'pri'          => 1,
            'status'       => 'wait',
            'estimate'     => 1,
            'consumed'     => 0,
            'left'         => 1,
            'progress'     => 0,
            'estStarted'   => '',
            'realStarted'  => '',
            'finishedDate' => '',
            'closedReason' => '',
        ),
    ),
);

/* Forms as JSON Schemas. */
$lang->ai->formSchema = array();
$lang->ai->formSchema['story']['create'] = new stdclass();
$lang->ai->formSchema['story']['create']->title = '需求';
$lang->ai->formSchema['story']['create']->type  = 'object';
$lang->ai->formSchema['story']['create']->properties = new stdclass();
$lang->ai->formSchema['story']['create']->properties->title  = new stdclass();
$lang->ai->formSchema['story']['create']->properties->spec   = new stdclass();
$lang->ai->formSchema['story']['create']->properties->verify = new stdclass();
$lang->ai->formSchema['story']['create']->properties->title->type         = 'string';
$lang->ai->formSchema['story']['create']->properties->title->description  = '需求的標題';
$lang->ai->formSchema['story']['create']->properties->spec->type          = 'string';
$lang->ai->formSchema['story']['create']->properties->spec->format        = 'html';
$lang->ai->formSchema['story']['create']->properties->spec->description   = '需求的描述';
$lang->ai->formSchema['story']['create']->properties->verify->type        = 'string';
$lang->ai->formSchema['story']['create']->properties->verify->format      = 'html';
$lang->ai->formSchema['story']['create']->properties->verify->description = '需求的驗收標準';
$lang->ai->formSchema['story']['create']->required = array('title', 'spec', 'verify');
$lang->ai->formSchema['story']['change'] = $lang->ai->formSchema['story']['create'];

$lang->ai->formSchema['story']['batchcreate'] = new stdclass();
$lang->ai->formSchema['story']['batchcreate']->title = '批量創建需求';
$lang->ai->formSchema['story']['batchcreate']->type  = 'object';
$lang->ai->formSchema['story']['batchcreate']->properties = new stdclass();
$lang->ai->formSchema['story']['batchcreate']->properties->stories  = new stdclass();
$lang->ai->formSchema['story']['batchcreate']->properties->stories->type        = 'array';
$lang->ai->formSchema['story']['batchcreate']->properties->stories->description = '需求列表';
$lang->ai->formSchema['story']['batchcreate']->properties->stories->items       = $lang->ai->formSchema['story']['create'];

$lang->ai->formSchema['productplan']['create'] = new stdclass();
$lang->ai->formSchema['productplan']['create']->title = '產品計劃';
$lang->ai->formSchema['productplan']['create']->type  = 'object';
$lang->ai->formSchema['productplan']['create']->properties = new stdclass();
$lang->ai->formSchema['productplan']['create']->properties->title  = new stdclass();
$lang->ai->formSchema['productplan']['create']->properties->begin  = new stdclass();
$lang->ai->formSchema['productplan']['create']->properties->end    = new stdclass();
$lang->ai->formSchema['productplan']['create']->properties->desc   = new stdclass();
$lang->ai->formSchema['productplan']['create']->properties->title->type         = 'string';
$lang->ai->formSchema['productplan']['create']->properties->title->description  = '產品計劃的標題';
$lang->ai->formSchema['productplan']['create']->properties->begin->type         = 'string';
$lang->ai->formSchema['productplan']['create']->properties->begin->description  = '產品計劃的開始時間';
$lang->ai->formSchema['productplan']['create']->properties->end->type           = 'string';
$lang->ai->formSchema['productplan']['create']->properties->end->description    = '產品計劃的結束時間';
$lang->ai->formSchema['productplan']['create']->properties->desc->type          = 'string';
$lang->ai->formSchema['productplan']['create']->properties->desc->description   = '產品計劃的描述';
$lang->ai->formSchema['productplan']['create']->required = array('title', 'begin', 'end');
$lang->ai->formSchema['productplan']['edit'] = $lang->ai->formSchema['productplan']['create'];

$lang->ai->formSchema['task']['create'] = new stdclass();
$lang->ai->formSchema['task']['create']->title = '任務';
$lang->ai->formSchema['task']['create']->type  = 'object';
$lang->ai->formSchema['task']['create']->properties = new stdclass();
$lang->ai->formSchema['task']['create']->properties->type     = new stdclass();
$lang->ai->formSchema['task']['create']->properties->name     = new stdclass();
$lang->ai->formSchema['task']['create']->properties->desc     = new stdclass();
$lang->ai->formSchema['task']['create']->properties->pri      = new stdclass();
$lang->ai->formSchema['task']['create']->properties->estimate = new stdclass();
$lang->ai->formSchema['task']['create']->properties->begin    = new stdclass();
$lang->ai->formSchema['task']['create']->properties->end      = new stdclass();
$lang->ai->formSchema['task']['create']->properties->type->type            = 'string';
$lang->ai->formSchema['task']['create']->properties->type->description     = '任務的類型';
$lang->ai->formSchema['task']['create']->properties->type->enum            = array('design', 'devel', 'request', 'test', 'study', 'discuss', 'ui', 'affair', 'misc');
$lang->ai->formSchema['task']['create']->properties->name->type            = 'string';
$lang->ai->formSchema['task']['create']->properties->name->description     = '任務的名稱';
$lang->ai->formSchema['task']['create']->properties->desc->type            = 'string';
$lang->ai->formSchema['task']['create']->properties->desc->description     = '任務的描述';
$lang->ai->formSchema['task']['create']->properties->pri->type             = 'string';
$lang->ai->formSchema['task']['create']->properties->pri->description      = '任務的優先順序';
$lang->ai->formSchema['task']['create']->properties->pri->enum             = array('1', '2', '3', '4');
$lang->ai->formSchema['task']['create']->properties->estimate->type        = 'number';
$lang->ai->formSchema['task']['create']->properties->estimate->description = '任務的預計工時';
$lang->ai->formSchema['task']['create']->properties->begin->type           = 'string';
$lang->ai->formSchema['task']['create']->properties->begin->format         = 'date';
$lang->ai->formSchema['task']['create']->properties->begin->description    = '任務的預計開始日期';
$lang->ai->formSchema['task']['create']->properties->end->type             = 'string';
$lang->ai->formSchema['task']['create']->properties->end->format           = 'date';
$lang->ai->formSchema['task']['create']->properties->end->description      = '任務的預計結束日期';
$lang->ai->formSchema['task']['create']->required = array('type', 'name');
$lang->ai->formSchema['task']['edit'] = $lang->ai->formSchema['task']['create'];

$lang->ai->formSchema['task']['batchcreate'] = new stdclass();
$lang->ai->formSchema['task']['batchcreate']->title = '批量創建任務';
$lang->ai->formSchema['task']['batchcreate']->type  = 'object';
$lang->ai->formSchema['task']['batchcreate']->properties = new stdclass();
$lang->ai->formSchema['task']['batchcreate']->properties->tasks  = new stdclass();
$lang->ai->formSchema['task']['batchcreate']->properties->tasks->type                          = 'array';
$lang->ai->formSchema['task']['batchcreate']->properties->tasks->description                   = '任務列表';
$lang->ai->formSchema['task']['batchcreate']->properties->tasks->items                         = $lang->ai->formSchema['task']['create'];
$lang->ai->formSchema['task']['batchcreate']->properties->tasks->items->properties->estStarted = clone $lang->ai->formSchema['task']['batchcreate']->properties->tasks->items->properties->begin;
$lang->ai->formSchema['task']['batchcreate']->properties->tasks->items->properties->deadline   = clone $lang->ai->formSchema['task']['batchcreate']->properties->tasks->items->properties->end;
unset($lang->ai->formSchema['task']['batchcreate']->properties->tasks->items->properties->begin);
unset($lang->ai->formSchema['task']['batchcreate']->properties->tasks->items->properties->end);

$lang->ai->formSchema['bug']['create'] = new stdclass();
$lang->ai->formSchema['bug']['create']->title = 'Bug';
$lang->ai->formSchema['bug']['create']->type  = 'object';
$lang->ai->formSchema['bug']['create']->properties = new stdclass();
$lang->ai->formSchema['bug']['create']->properties->title       = new stdclass();
$lang->ai->formSchema['bug']['create']->properties->steps       = new stdclass();
$lang->ai->formSchema['bug']['create']->properties->severity    = new stdclass();
$lang->ai->formSchema['bug']['create']->properties->pri         = new stdclass();
$lang->ai->formSchema['bug']['create']->properties->openedBuild = new stdclass();
$lang->ai->formSchema['bug']['create']->properties->title->type              = 'string';
$lang->ai->formSchema['bug']['create']->properties->title->description       = 'Bug 的標題';
$lang->ai->formSchema['bug']['create']->properties->steps->type              = 'string';
$lang->ai->formSchema['bug']['create']->properties->steps->description       = '重現步驟';
$lang->ai->formSchema['bug']['create']->properties->severity->type           = 'string';
$lang->ai->formSchema['bug']['create']->properties->severity->description    = 'Bug 的嚴重程度';
$lang->ai->formSchema['bug']['create']->properties->severity->enum           = array('1', '2', '3', '4');
$lang->ai->formSchema['bug']['create']->properties->pri->type                = 'string';
$lang->ai->formSchema['bug']['create']->properties->pri->description         = 'Bug 的優先順序';
$lang->ai->formSchema['bug']['create']->properties->pri->enum                = array('1', '2', '3', '4');
$lang->ai->formSchema['bug']['create']->properties->openedBuild->type        = 'string';
$lang->ai->formSchema['bug']['create']->properties->openedBuild->description = 'Bug 影響的版本';
$lang->ai->formSchema['bug']['create']->properties->openedBuild->enum        = array('trunk');
$lang->ai->formSchema['bug']['create']->required = array('title', 'steps', 'severity', 'pri', 'openedBuild');
$lang->ai->formSchema['bug']['edit'] = $lang->ai->formSchema['bug']['create'];

$lang->ai->formSchema['testcase']['create'] = new stdclass();
$lang->ai->formSchema['testcase']['create']->title = '用例';
$lang->ai->formSchema['testcase']['create']->type  = 'object';
$lang->ai->formSchema['testcase']['create']->properties = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->type         = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->stage        = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->title        = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->precondition = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->steps        = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->steps->items              = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties  = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties->steps   = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties->expects = new stdclass();
$lang->ai->formSchema['testcase']['create']->properties->type->type                                     = 'string';
$lang->ai->formSchema['testcase']['create']->properties->type->description                              = '用例的類型';
$lang->ai->formSchema['testcase']['create']->properties->type->enum                                     = array('feature', 'performance', 'config', 'install', 'security', 'interface', 'unit', 'other');
$lang->ai->formSchema['testcase']['create']->properties->stage->type                                    = 'string';
$lang->ai->formSchema['testcase']['create']->properties->stage->description                             = '用例適用環節';
$lang->ai->formSchema['testcase']['create']->properties->stage->enum                                    = array('unittest', 'feature', 'intergrate', 'system', 'smoke', 'bvt');
$lang->ai->formSchema['testcase']['create']->properties->title->type                                    = 'string';
$lang->ai->formSchema['testcase']['create']->properties->title->description                             = '用例的標題';
$lang->ai->formSchema['testcase']['create']->properties->precondition->type                             = 'string';
$lang->ai->formSchema['testcase']['create']->properties->precondition->description                      = '用例的前置條件';
$lang->ai->formSchema['testcase']['create']->properties->steps->type                                    = 'array';
$lang->ai->formSchema['testcase']['create']->properties->steps->description                             = '用例的步驟列表';
$lang->ai->formSchema['testcase']['create']->properties->steps->items->type                             = 'object';
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties->steps->type          = 'string';
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties->steps->description   = '步驟的描述';
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties->expects->type        = 'string';
$lang->ai->formSchema['testcase']['create']->properties->steps->items->properties->expects->description = '步驟的預期結果';
$lang->ai->formSchema['testcase']['create']->required = array('type', 'title', 'steps');
$lang->ai->formSchema['testcase']['edit'] = $lang->ai->formSchema['testcase']['create'];

$lang->ai->formSchema['testreport']['create'] = new stdclass();
$lang->ai->formSchema['testreport']['create']->title = '測試報告';
$lang->ai->formSchema['testreport']['create']->type  = 'object';
$lang->ai->formSchema['testreport']['create']->properties = new stdclass();
$lang->ai->formSchema['testreport']['create']->properties->begin  = new stdclass();
$lang->ai->formSchema['testreport']['create']->properties->end    = new stdclass();
$lang->ai->formSchema['testreport']['create']->properties->title  = new stdclass();
$lang->ai->formSchema['testreport']['create']->properties->report = new stdclass();
$lang->ai->formSchema['testreport']['create']->properties->begin->type         = 'string';
$lang->ai->formSchema['testreport']['create']->properties->begin->format       = 'date';
$lang->ai->formSchema['testreport']['create']->properties->begin->description  = '測試開始時間';
$lang->ai->formSchema['testreport']['create']->properties->end->type           = 'string';
$lang->ai->formSchema['testreport']['create']->properties->end->format         = 'date';
$lang->ai->formSchema['testreport']['create']->properties->end->description    = '測試開始時間';
$lang->ai->formSchema['testreport']['create']->properties->title->type         = 'string';
$lang->ai->formSchema['testreport']['create']->properties->title->description  = '測試報告的標題';
$lang->ai->formSchema['testreport']['create']->properties->report->type        = 'string';
$lang->ai->formSchema['testreport']['create']->properties->report->description = '測試報告的內容';
$lang->ai->formSchema['testreport']['create']->required = array('begin', 'end', 'title', 'report');
$lang->ai->formSchema['execution']['testreport'] = $lang->ai->formSchema['testreport']['create'];

$lang->ai->formSchema['doc']['edit'] = new stdclass();
$lang->ai->formSchema['doc']['edit']->title = '文檔';
$lang->ai->formSchema['doc']['edit']->type  = 'object';
$lang->ai->formSchema['doc']['edit']->properties = new stdclass();
$lang->ai->formSchema['doc']['edit']->properties->title   = new stdclass();
$lang->ai->formSchema['doc']['edit']->properties->content = new stdclass();
$lang->ai->formSchema['doc']['edit']->properties->title->type          = 'string';
$lang->ai->formSchema['doc']['edit']->properties->title->description   = '文檔的標題';
$lang->ai->formSchema['doc']['edit']->properties->content->type        = 'string';
$lang->ai->formSchema['doc']['edit']->properties->content->description = '文檔的正文';
$lang->ai->formSchema['doc']['edit']->required = array('title', 'content');

$lang->ai->formSchema['doc']['selectlibtype'] = $lang->ai->formSchema['doc']['edit'];

$lang->ai->formSchema['tree']['browse'] = new stdclass();
$lang->ai->formSchema['tree']['browse']->title = '模組';
$lang->ai->formSchema['tree']['browse']->type  = 'object';
$lang->ai->formSchema['tree']['browse']->properties = new stdclass();
$lang->ai->formSchema['tree']['browse']->properties->modules = new stdclass();
$lang->ai->formSchema['tree']['browse']->properties->modules->type  = 'array';
$lang->ai->formSchema['tree']['browse']->properties->modules->title = '模組';
$lang->ai->formSchema['tree']['browse']->properties->modules->items = new stdclass();
$lang->ai->formSchema['tree']['browse']->properties->modules->items->type = 'string';
$lang->ai->formSchema['tree']['browse']->required = array('modules');

$lang->ai->formSchema['programplan']['create'] = new stdclass();
$lang->ai->formSchema['programplan']['create']->title = '計劃階段';
$lang->ai->formSchema['programplan']['create']->type  = 'object';
$lang->ai->formSchema['programplan']['create']->properties = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->type  = 'array';
$lang->ai->formSchema['programplan']['create']->properties->stages->title = '階段列表';
$lang->ai->formSchema['programplan']['create']->properties->stages->items = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->type = 'object';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->names      = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->attributes = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->milestone  = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->begin      = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->end        = new stdclass();
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->names->type             = 'string';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->names->description      = '階段名稱';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->attributes->type        = 'string';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->attributes->description = '階段類型';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->attributes->enum        = array('request', 'design', 'dev', 'qa', 'release', 'review', 'other');
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->milestone->type         = 'boolean';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->milestone->description  = '是否為里程碑';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->begin->type             = 'string';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->begin->format           = 'date';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->begin->description      = '階段開始時間';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->end->type               = 'string';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->end->format             = 'date';
$lang->ai->formSchema['programplan']['create']->properties->stages->items->properties->end->description        = '階段結束時間';
$lang->ai->formSchema['programplan']['create']->required = array('stages');

/* Forms as JSON Schemas. */
$lang->ai->formSchema['empty']['empty'] = new stdclass();
$lang->ai->formSchema['empty']['empty']->title = '自定義';
$lang->ai->formSchema['empty']['empty']->type  = 'object';
$lang->ai->formSchema['empty']['empty']->properties = new stdclass();
$lang->ai->formSchema['empty']['empty']->properties->title = new stdclass();

$lang->ai->promptMenu = new stdclass();
$lang->ai->promptMenu->dropdownTitle = '%s智能助手';
$lang->ai->promptMenu->assignedTo    = '委派%s';

$lang->ai->dataInject = new stdclass();
$lang->ai->dataInject->success = '已將禪道智能體執行結果填寫到表單中';
$lang->ai->dataInject->fail    = '禪道智能體執行結果填寫失敗';

$lang->ai->execute = new stdclass();
$lang->ai->execute->loading    = '禪道智能體執行中';
$lang->ai->execute->auditing   = '即將跳轉至調試頁面並執行禪道智能體';
$lang->ai->execute->success    = '禪道智能體執行成功';
$lang->ai->execute->fail       = '禪道智能體執行失敗';
$lang->ai->execute->failFormat = '禪道智能體執行失敗：%s。';
$lang->ai->execute->failReasons = array();
$lang->ai->execute->failReasons['noPrompt']     = '禪道智能體不存在';
$lang->ai->execute->failReasons['noObjectData'] = '對象數據獲取失敗';
$lang->ai->execute->failReasons['noResponse']   = '請求返回值為空';
$lang->ai->execute->failReasons['noTargetForm'] = '目標表單地址獲取失敗，或表單必要變數獲取失敗（可能原因為無法找到關聯的對象，請檢查對象間的關聯關係）';
$lang->ai->execute->executeErrors = array();
$lang->ai->execute->executeErrors['-1'] = '禪道智能體不存在';
$lang->ai->execute->executeErrors['-2'] = '對象數據獲取失敗';
$lang->ai->execute->executeErrors['-3'] = '序列化對象數據失敗';
$lang->ai->execute->executeErrors['-4'] = '沒有可用的語言模型';
$lang->ai->execute->executeErrors['-5'] = '表單結構獲取失敗';
$lang->ai->execute->executeErrors['-6'] = 'API 返回值為空或返回了錯誤';

$lang->ai->audit = new stdclass();
$lang->ai->audit->designPrompt = '禪道智能體設計';
$lang->ai->audit->afterSave    = '保存後';
$lang->ai->audit->regenerate   = '重新生成';
$lang->ai->audit->exit         = '退出調試';

$lang->ai->audit->backLocationList = array();
$lang->ai->audit->backLocationList[0] = '返回調試頁面';
$lang->ai->audit->backLocationList[1] = '返回調試頁面並重新生成';

$lang->ai->engineeredPrompts = new stdclass();
$lang->ai->engineeredPrompts->askForFunctionCalling = array((object)array('role' => 'user', 'content' => '請把我所發的下一條消息內容轉換為 function 調用。'), (object)array('role' => 'assistant', 'content' => '好的，我會把下一條消息轉換為 function 調用。'));

$lang->ai->aiResponseException = array();
$lang->ai->aiResponseException['notFunctionCalling'] = '禪道智能體執行返回值結構不正確，請重試（可能可以通過優化禪道智能體來解決）';

$lang->ai->assistant = new stdclass();
$lang->ai->assistant->view                     = 'AI 助手詳情';
$lang->ai->assistant->title                    = 'AI 助手';
$lang->ai->assistant->create                   = '添加助手';
$lang->ai->assistant->details                  = '基本信息';
$lang->ai->assistant->edit                     = '編輯助手';
$lang->ai->assistant->name                     = 'AI 助手';
$lang->ai->assistant->refModel                 = '引用語言模型';
$lang->ai->assistant->createdDate              = '添加時間';
$lang->ai->assistant->publishedDate            = '發佈時間';
$lang->ai->assistant->desc                     = '簡介';
$lang->ai->assistant->descPlaceholder          = '請簡述此 AI 助手的功能及可以給使用者帶來的體驗。';
$lang->ai->assistant->systemMessage            = '系統內置消息';
$lang->ai->assistant->systemMessagePlaceholder = '您可以賦予此 AI 對話“人設”，例如，“你是一個周報小助手，會根據輸入的內容生成格式化的周報”。';
$lang->ai->assistant->greetings                = '問候語';
$lang->ai->assistant->greetingsPlaceholder     = '您可以設置此AI對話的打招呼文案，例如，“哈嘍，我是你的周報小助手，還在為寫周報困擾嗎，試試將一周的工作發送給我試試？”';
$lang->ai->assistant->publish                  = '發佈';
$lang->ai->assistant->withdraw                 = '停用';
$lang->ai->assistant->confirmPublishTip        = '發佈後將顯示在禪道右下角 AI 對話和客戶端對話中，是否確認發佈？';
$lang->ai->assistant->confirmWithdrawTip       = '停用後前台用戶將無法看到此 AI 助手，是否確認停用？';
$lang->ai->assistant->duplicateTip             = '同一語言模型下的助手名稱不可重複。';
$lang->ai->assistant->confirmDeleteTip         = '確認刪除此 AI 助手？';
$lang->ai->assistant->switchAndClearContext    = '切換助手%s，上下文關係已清除';
$lang->ai->assistant->noLlm                    = '沒有可用的語言模型，請先創建一個。';
$lang->ai->assistant->defaultAssistant         = '全能助手';

$lang->ai->assistant->statusList = array();
$lang->ai->assistant->statusList['0']   = '未發佈';
$lang->ai->assistant->statusList['off'] = '未發佈';
$lang->ai->assistant->statusList['1']   = '已發佈';
$lang->ai->assistant->statusList['on']  = '已發佈';

// for render action changes.
$lang->aiassistant = $lang->ai->assistant;
