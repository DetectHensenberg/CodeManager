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
$lang->aiapp->common           = 'AI';
$lang->aiapp->squareCategories = array('collection' => '我的收藏', 'discovery' => '發現', 'latest' => '最新');
$lang->aiapp->newVersionTip    = '小程序已于 %s 更新，以上為過往記錄';
$lang->aiapp->noMiniProgram    = '您訪問的小程序不存在';
$lang->aiapp->title            = '小程序';
$lang->aiapp->unpublishedTip   = '您使用的小程序沒有發佈';
$lang->aiapp->noModelError     = '暫無可用的語言模型，請聯繫管理員配置。';
$lang->aiapp->chatNoResponse   = '會話發生了錯誤';
$lang->aiapp->more             = '更多';
$lang->aiapp->collect          = '收藏';
$lang->aiapp->deleted          = '已刪除';
$lang->aiapp->clear            = '清空';
$lang->aiapp->modelCurrent     = '當前語言模型';
$lang->aiapp->categoryList     = array('work' => '工作', 'personal' => '個人', 'life' => '生活', 'creative' => '創意', 'others' => '其它');
$lang->aiapp->generate         = '生成';
$lang->aiapp->regenerate       = '重新生成';
$lang->aiapp->emptyNameWarning = '「%s」不能為空';
$lang->aiapp->chatTip          = '請在左側輸入欄位內容，生成結果試試吧。';
$lang->aiapp->noModel          = array('尚未配置語言模型，請聯繫管理員或跳轉至後台配置<a id="to-language-model">語言模型</a>。', '若已完成相關配置，請嘗試<a id="reload-current">重新加載</a>頁面。');
$lang->aiapp->clearContext     = '上下文內容已清除';
$lang->aiapp->newChatTip       = '請在左側輸入欄位內容，開啟新對話。';
$lang->aiapp->disabledTip      = '當前小程序已被禁用。';
$lang->aiapp->continueasking   = '繼續追問';

$lang->aiapp->miniProgramSquare  = '查看通用智能體廣場';
$lang->aiapp->collectMiniProgram = '收藏通用智能體';
$lang->aiapp->miniProgramChat    = '執行通用智能體';
$lang->aiapp->view               = '查看通用智能體詳情';
$lang->aiapp->browseConversation = '瀏覽智能會話';
$lang->aiapp->manageGeneralAgent = '管理通用智能體';
$lang->aiapp->models             = '瀏覽模型列表';

$lang->aiapp->id                 = 'ID';
$lang->aiapp->model              = '模型名稱';
$lang->aiapp->converse           = '開始會話';
$lang->aiapp->pageSummary        = '共 %s 項';

$lang->aiapp->tips = new stdClass();
$lang->aiapp->tips->noData = '暫無數據';

$lang->aiapp->langData                      = new stdClass();
$lang->aiapp->langData->name                = '禪道';
$lang->aiapp->langData->storyReview         = '需求評審';
$lang->aiapp->langData->storyReviewHint     = '對當前頁面需求進行評審';
$lang->aiapp->langData->storyReviewMessage  = "下面是要進行評審的需求：\n\n### 需求標題\n\n{title}\n\n### 需求描述\n\n{spec}\n\n### 需求驗收標準\n\n{verify}";
$lang->aiapp->langData->aiReview            = 'AI 評審';
$lang->aiapp->langData->currentPage         = '當前頁面';
$lang->aiapp->langData->story               = '需求';
$lang->aiapp->langData->demand              = '需求池需求';
$lang->aiapp->langData->bug                 = 'BUG';
$lang->aiapp->langData->doc                 = '文檔';
$lang->aiapp->langData->design              = '設計';
$lang->aiapp->langData->feedback            = '反饋';
$lang->aiapp->langData->currentDocContent   = '當前文檔';
$lang->aiapp->langData->globalMemoryTitle   = '禪道';
$lang->aiapp->langData->zaiConfigNotValid   = '尚未進行ZAI配置，請聯繫管理員進行<a href="{zaiConfigUrl}">ZAI配置</a>。<br>若已完成相關配置，請嘗試重新加載頁面。';
$lang->aiapp->langData->unauthorizedError   = '授權失敗，無效的 API 密鑰，請聯繫管理員進行<a href="{zaiConfigUrl}">ZAI配置</a>。<br>若已完成相關配置，請嘗試重新加載頁面。';
$lang->aiapp->langData->processDataPrefix   = "要進行處理的數據如下：\n{data}";
$lang->aiapp->langData->processedDataResult = "處理後的數據如下：\n```json\n{data}\n```";
$lang->aiapp->langData->agentResultSummary  = '對方案中數據的變化進行解釋，儘量對變化的屬性分別進行說明。';
$lang->aiapp->langData->promptResultTitle   = '方案標題，如果沒有合適標題可以省略';
$lang->aiapp->langData->promptExtraLimit    = '通常工具 `{toolName}` 只需要調用一次，除非用戶特殊要求提供多個方案。';
$lang->aiapp->langData->promptResultReturn  = '已經在界面展示處理後的數據，無需對處理後的數據進行重複展示，也不需要進一步描述和解釋，提醒我可以通過點擊“應用到{formName}表單”按鈕來使用這些數據。';
$lang->aiapp->langData->goTesting           = '去調試';
$lang->aiapp->langData->notSupportPreview   = '暫不支持預覽該內容';
$lang->aiapp->langData->dataListSizeInfo    = '共 %s 條數據';
$lang->aiapp->langData->promptTestDataIntro = '下面是要進行{name}的示例{type}：';
$lang->aiapp->langData->searchingKLibs      = '正在查找知識庫...';
$lang->aiapp->langData->recentChats         = '最近聊天';
$lang->aiapp->langData->aiTeammateTasks     = '數字員工任務';
$lang->aiapp->langData->searchTasks         = '搜索數字員工任務';
