<?php
$lang->reporttemplate->create         = '創建報告模板';
$lang->reporttemplate->edit           = '編輯';
$lang->reporttemplate->editAction     = '編輯報告模板';
$lang->reporttemplate->delete         = '刪除模板';
$lang->reporttemplate->deleteAbbr     = '刪除';
$lang->reporttemplate->deleteAction   = '刪除報告模板';
$lang->reporttemplate->browse         = '瀏覽報告模板';
$lang->reporttemplate->view           = '報告模板詳情';
$lang->reporttemplate->addCategory    = '添加分類';
$lang->reporttemplate->editCategory   = '編輯分類';
$lang->reporttemplate->deleteCategory = '刪除分類';
$lang->reporttemplate->pause          = '停用';
$lang->reporttemplate->pauseAction    = '停用報告模板';
$lang->reporttemplate->cron           = '定時生成';

$lang->reporttemplate->lib            = '所屬範圍';
$lang->reporttemplate->module         = '分類';
$lang->reporttemplate->objects        = '適用流程';
$lang->reporttemplate->title          = '模板標題';
$lang->reporttemplate->status         = '模板狀態';
$lang->reporttemplate->desc           = '模板簡介';
$lang->reporttemplate->acl            = '模板訪問控制';
$lang->reporttemplate->reportAcl      = '生成報告的訪問控制';
$lang->reporttemplate->cycle          = '生成頻率';
$lang->reporttemplate->content        = '模板內容';
$lang->reporttemplate->basic          = '基本信息';
$lang->reporttemplate->basicStatistic = '基本統計';
$lang->reporttemplate->progress       = '進度分析';
$lang->reporttemplate->resource       = '資源分析';
$lang->reporttemplate->fixedProgress  = '修復進度';
$lang->reporttemplate->outline        = '模板大綱';
$lang->reporttemplate->beginDate      = '開始日期';
$lang->reporttemplate->endDate        = '結束日期';
$lang->reporttemplate->allProject     = '全部流程';
$lang->reporttemplate->dateRange      = '日期範圍';
$lang->reporttemplate->cronLog        = '定時日誌';

$lang->reporttemplate->aclList['open']    = '公開（有瀏覽報告模板權限，即可訪問）';
$lang->reporttemplate->aclList['private'] = '私有（僅創建者和白名單用戶可訪問）';

$lang->reporttemplate->statusList['draft']  = '草稿';
$lang->reporttemplate->statusList['normal'] = '已發佈';
$lang->reporttemplate->statusList['pause']  = '已停用';

$lang->reporttemplate->cronTitle             = '定時規則設置';
$lang->reporttemplate->cronTurnon            = '是否定時生成';
$lang->reporttemplate->cronTurnonList['on']  = '是';
$lang->reporttemplate->cronTurnonList['off'] = '否';

$lang->reporttemplate->cronFrequency              = '生成頻率';
$lang->reporttemplate->cronFrequencyList['day']   = '每天';
$lang->reporttemplate->cronFrequencyList['week']  = '每週';
$lang->reporttemplate->cronFrequencyList['month'] = '每月';
$lang->reporttemplate->cronFrequencyTips['day']   = '（每天 0:00 生成報告）';
$lang->reporttemplate->cronFrequencyTips['week']  = '（每週一 0:00 生成報告）';
$lang->reporttemplate->cronFrequencyTips['month'] = '（每月1號 0:00 生成報告）';

$lang->reporttemplate->appendUsers['PROJECTPM']          = '項目負責人';
$lang->reporttemplate->appendUsers['PROJECTTEAM']        = '項目團隊成員';
$lang->reporttemplate->appendUsers['PROJECTSTAKEHOLDER'] = '項目干係人';
$lang->reporttemplate->appendUsers['PROJECTWHITELIST']   = '項目白名單';

$lang->reporttemplate->titleTemplate['day']   = '%s每天報告';
$lang->reporttemplate->titleTemplate['week']  = '%s周報';
$lang->reporttemplate->titleTemplate['month'] = '%s月度規劃報告';

$lang->reporttemplate->weekNumber[0] = '第一周';
$lang->reporttemplate->weekNumber[1] = '第二周';
$lang->reporttemplate->weekNumber[2] = '第三周';
$lang->reporttemplate->weekNumber[3] = '第四周';
$lang->reporttemplate->weekNumber[4] = '第五周';
$lang->reporttemplate->weekNumber[5] = '第六周';

$lang->reporttemplate->hotDate      = '修改日期';
$lang->reporttemplate->scope        = '範圍';
$lang->reporttemplate->scopeField   = '所屬範圍';
$lang->reporttemplate->categoryName = '分類名稱';
$lang->reporttemplate->templateDesc = '模板簡介';
$lang->reporttemplate->groups       = '分組';
$lang->reporttemplate->users        = '用戶';

$lang->reporttemplate->noCategory              = '沒有分類';
$lang->reporttemplate->noTemplate              = '沒有報告模板';
$lang->reporttemplate->noDesc                  = '暫時沒有描述';
$lang->reporttemplate->createTypeFirst         = '請先創建報告模板分類';
$lang->reporttemplate->confirmPause            = '您確定要停用此模板嗎?';
$lang->reporttemplate->confirmDelete           = '您確定刪除該報告模板嗎?';
$lang->reporttemplate->confirmDeleteCategory   = '您確定要刪除該分類嗎？';
$lang->reporttemplate->leaveEditingConfirm     = '模板編輯中，確定要離開嗎？';
$lang->reporttemplate->searchScopePlaceholder  = '搜索範圍';
$lang->reporttemplate->searchModulePlaceholder = '搜索分類';
$lang->reporttemplate->insertSystemData        = '插入系統數據';
$lang->reporttemplate->executionDataTips       = "獲取項目內全部{$lang->execution->common}數據";
$lang->reporttemplate->noneConditionTips       = '未設置條件將獲取項目內全部數據。';
$lang->reporttemplate->chartBlockTip           = '由該模板生成報告時展示相應的圖表';
$lang->reporttemplate->emptyDataTip            = '此篩選條件下，暫無符合條件系統數據。';
$lang->reporttemplate->devRateTip              = '類型為%s的任務中，（%s的任務數÷ 任務數）×  100%%';
$lang->reporttemplate->testRateTip             = '類型為%s的任務中，（%s的任務數÷ 任務數）×  100%%';
$lang->reporttemplate->taskTotalCount          = '總計：%s 個任務';
$lang->reporttemplate->logTemplate             = '成功生成報告%s個，生成失敗%s個';

$lang->reporttemplate->doingSummaryTip = <<<EOD
需求數: %s中所有需求數量之和
剩餘需求數: %s中所有未關閉的需求數量之和
任務數: %s中所有任務數量之和
剩餘任務數: %s中狀態不是“ 已關閉” 和“ 已完成” 的任務數量求和
剩餘工時數: %s中所有任務剩餘工時數求和, 過濾父任務, 過濾狀態為已取消和已關閉的任務
消耗工時數: %s中所有任務剩餘工時數求和, 過濾父任務
%s進度: 消耗工時數 ÷（消耗工時數+剩餘工時數）× 100%
EOD;

$lang->reporttemplate->closedSummaryTip = <<<EOD
執行關閉後第二天顯示統計數據，統計規則如下：
開發效率: %s關閉時已交付的研發需求規模數÷按%s統計的任務消耗工時數
需求驗收通過率: %s關閉時驗收通過的研發需求數÷按%s統計的有效研發需求數
需求按計劃完成率: %s關閉時已交付的研發需求數÷截止%s開始當天的研發需求數
開發任務完成率: %s關閉時已完成的開發類型任務數÷按%s統計的開發任務數
測試任務完成率: %s關閉時已完成的測試類型任務數÷按%s統計的測試任務數
測試缺陷密度: 按%s統計的新增有效Bug數÷%s關閉時研發完畢的研發需求規模數
EOD;

$lang->reporttemplate->notice = new stdclass();
$lang->reporttemplate->notice->filter     = '篩選條件';
$lang->reporttemplate->notice->noSettings = '項目內全部%s數據';
$lang->reporttemplate->notice->noSupport  = '當前項目暫不支持“%s”';
$lang->reporttemplate->notice->logLimit   = '最多顯示最新20條記錄';

$lang->reporttemplate->disabledHint = new stdclass();
$lang->reporttemplate->disabledHint->pause  = '該模板暫未發佈';
$lang->reporttemplate->disabledHint->delete = '內置報告模板不能刪除';

$lang->reporttemplate->error = new stdclass();
$lang->reporttemplate->error->deleteCategory   = '該分類下有報告模板，請移除模板後刪除';
$lang->reporttemplate->error->beginMoreThanEnd = '開始日期不能大於結束日期';

$lang->reporttemplate->builtInScopes = array();
$lang->reporttemplate->builtInScopes['rnd']  = array();
$lang->reporttemplate->builtInScopes['rnd']['project'] = '項目';

$lang->reporttemplate->filterTypes = array();
$lang->reporttemplate->filterTypes[] = array('all', '全部');
$lang->reporttemplate->filterTypes[] = array('draft', '草稿');
$lang->reporttemplate->filterTypes[] = array('released', '已發佈');
$lang->reporttemplate->filterTypes[] = array('paused', '已停用');
$lang->reporttemplate->filterTypes[] = array('createdByMe', '我創建的');

$lang->reporttemplate->quickEditMenuList['properties']   = '屬性';
$lang->reporttemplate->quickEditMenuList['lists']        = '列表';
$lang->reporttemplate->quickEditMenuList['measurements'] = '數據';
$lang->reporttemplate->quickEditMenuList['charts']       = '圖表';

$lang->reporttemplate->filterList['projectStory'] = '項目研發需求篩選器';
$lang->reporttemplate->filterList['HLDS']         = '概要設計篩選器';
$lang->reporttemplate->filterList['DDS']          = '詳細設計篩選器';
$lang->reporttemplate->filterList['DBDS']         = '資料庫設計篩選器';
$lang->reporttemplate->filterList['ADS']          = '介面設計篩選器';
$lang->reporttemplate->filterList['task']         = '任務篩選器';
$lang->reporttemplate->filterList['projectCase']  = '項目用例篩選器';
$lang->reporttemplate->filterList['projectBug']   = '項目Bug篩選器';

$lang->reporttemplate->project   = $lang->projectCommon;
$lang->reporttemplate->execution = $lang->execution->common;
$lang->reporttemplate->task      = '任務';
$lang->reporttemplate->story     = '需求';
$lang->reporttemplate->bug       = 'Bug';
$lang->reporttemplate->testcase  = '用例';
$lang->reporttemplate->weekly    = '報告';

$lang->reporttemplate->measurementList['execution']['total']     = "{$lang->execution->common}數";
$lang->reporttemplate->measurementList['execution']['doingNum']  = "進行中{$lang->execution->common}數";
$lang->reporttemplate->measurementList['execution']['closedNum'] = "已關閉{$lang->execution->common}數";
$lang->reporttemplate->measurementList['execution']['delayNum']  = "延期{$lang->execution->common}數";

$lang->reporttemplate->measurementList['task']['taskNum']     = '任務數';
$lang->reporttemplate->measurementList['task']['doneNum']     = '已完成任務數';
$lang->reporttemplate->measurementList['task']['consumed']    = '已消耗工時數';
$lang->reporttemplate->measurementList['task']['left']        = '剩餘工時數';
$lang->reporttemplate->measurementList['task']['bugTaskNum']  = 'Bug轉任務的數量';
$lang->reporttemplate->measurementList['task']['bugConsume']  = 'Bug轉任務的消耗工時';

$lang->reporttemplate->measurementList['story']['storyNum']        = '需求條目數';
$lang->reporttemplate->measurementList['story']['storyScale']      = '需求規模數';
$lang->reporttemplate->measurementList['story']['devNum']          = '研發完畢需求條目數';
$lang->reporttemplate->measurementList['story']['devScale']        = '研發完畢需求規模數';
$lang->reporttemplate->measurementList['story']['testNum']         = '測試完畢需求條目數';
$lang->reporttemplate->measurementList['story']['testScale']       = '測試完畢需求規模數';
$lang->reporttemplate->measurementList['story']['doneNum']         = '已完成需求條目數';
$lang->reporttemplate->measurementList['story']['doneScale']       = '已完成需求規模數';
$lang->reporttemplate->measurementList['story']['closedNum']       = '已關閉需求條目數';
$lang->reporttemplate->measurementList['story']['closedScale']     = '已關閉需求規模數';
$lang->reporttemplate->measurementList['story']['changedNum']      = '變更需求條目數';
$lang->reporttemplate->measurementList['story']['changedScale']    = '變更需求規模數';
$lang->reporttemplate->measurementList['story']['defect']          = '研發完畢的需求的缺陷密度';
$lang->reporttemplate->measurementList['story']['hasCaseStoryNum'] = '有用例的需求數';
$lang->reporttemplate->measurementList['story']['caseCoverage']    = '需求用例覆蓋率';
$lang->reporttemplate->measurementList['story']['caseDensity']     = '需求用例密度';

$lang->reporttemplate->measurementList['bug']['total']     = 'Bug總數';
$lang->reporttemplate->measurementList['bug']['effective'] = '有效Bug數';
$lang->reporttemplate->measurementList['bug']['useCase']   = '執行用例產生的Bug數';
$lang->reporttemplate->measurementList['bug']['fixed']     = '已修復Bug數';

$lang->reporttemplate->measurementList['testcase']['caseNum'] = '用例數';

$lang->reporttemplate->measurementList['weekly']['term']  = '報告周期';
$lang->reporttemplate->measurementList['weekly']['staff'] = '投入人數';

$lang->reporttemplate->chartList['project']['basicStatistic']['gantt']    = '甘特圖';
$lang->reporttemplate->chartList['project']['basicStatistic']['workload'] = "{$lang->projectCommon}計劃工作量統計";

$lang->reporttemplate->chartList['project']['progress']['summary'] = "{$lang->projectCommon}進展狀況";

$lang->reporttemplate->chartList['execution']['basicStatistic']['closedRate']    = "{$lang->execution->common}關閉率";
$lang->reporttemplate->chartList['execution']['basicStatistic']['delayRate']     = "{$lang->execution->common}延期率";
$lang->reporttemplate->chartList['execution']['basicStatistic']['statusMap']     = "{$lang->execution->common}狀態分佈";
$lang->reporttemplate->chartList['execution']['basicStatistic']['doingSummary']  = "進行中{$lang->execution->common}彙總表";
$lang->reporttemplate->chartList['execution']['basicStatistic']['closedSummary'] = "已關閉{$lang->execution->common}彙總表";

$lang->reporttemplate->chartList['task']['basicStatistic']['doneRate']   = '任務完成率';
$lang->reporttemplate->chartList['task']['basicStatistic']['taskRate']   = '任務進度';
$lang->reporttemplate->chartList['task']['basicStatistic']['statusMap']  = '任務狀態分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['assignMap']  = '任務指派給分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['ownerMap']   = '任務完成者分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['moduleMap']  = '任務一級模組分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['typeMap']    = '任務類型分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['priMap']     = '任務優先順序分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['reasonMap']  = '任務關閉原因分佈';
$lang->reporttemplate->chartList['task']['basicStatistic']['devRate']    = '開發類型任務完成率';
$lang->reporttemplate->chartList['task']['basicStatistic']['testRate']   = '測試類型任務完成率';
$lang->reporttemplate->chartList['task']['basicStatistic']['finished']   = '已完成任務情況';
$lang->reporttemplate->chartList['task']['basicStatistic']['unfinished'] = '未完成任務情況';
$lang->reporttemplate->chartList['task']['basicStatistic']['workplan']   = '工作計劃';

$lang->reporttemplate->chartList['task']['progress']['typeHour']   = '不同類型任務的進度統計表';
$lang->reporttemplate->chartList['task']['progress']['statusData'] = '不同類型任務的狀態統計表';
$lang->reporttemplate->chartList['task']['progress']['dailyNum']   = '每日完成任務數量柱狀圖(近14天)';

$lang->reporttemplate->chartList['task']['resource']['bugRate']           = 'Bug轉任務的數量占比';
$lang->reporttemplate->chartList['task']['resource']['bugConsumeRate']    = 'Bug轉任務的消耗工時占比';
$lang->reporttemplate->chartList['task']['resource']['userEfforts']       = '按團隊成員統計的任務消耗工時數';
$lang->reporttemplate->chartList['task']['resource']['teamEfforts']       = '按團隊成員統計的工時投入';
$lang->reporttemplate->chartList['task']['resource']['workAssignSummary'] = '任務指派彙總表';
$lang->reporttemplate->chartList['task']['resource']['workSummary']       = '任務完成彙總表';

$lang->reporttemplate->chartList['story']['basicStatistic']['statusMap']   = '需求狀態分佈';
$lang->reporttemplate->chartList['story']['basicStatistic']['stageMap']    = '需求階段分佈';
$lang->reporttemplate->chartList['story']['basicStatistic']['productMap']  = "需求來源{$lang->productCommon}模組分佈";
$lang->reporttemplate->chartList['story']['basicStatistic']['sourceMap']   = '需求來源分佈';
$lang->reporttemplate->chartList['story']['basicStatistic']['priMap']      = '需求優先順序分佈';
$lang->reporttemplate->chartList['story']['basicStatistic']['categoryMap'] = '需求所屬類別分佈';
$lang->reporttemplate->chartList['story']['basicStatistic']['userMap']     = '需求由誰創建分佈';

$lang->reporttemplate->chartList['story']['progress']['devRate']       = '按條目統計的需求研發完畢率';
$lang->reporttemplate->chartList['story']['progress']['devScaleRate']  = '按規模統計的需求研發完畢率';
$lang->reporttemplate->chartList['story']['progress']['testRate']      = '按條目統計的需求測試完畢率';
$lang->reporttemplate->chartList['story']['progress']['testScaleRate'] = '按規模統計的需求測試完畢率';
$lang->reporttemplate->chartList['story']['progress']['doneRate']      = '按條目統計的需求完成率';
$lang->reporttemplate->chartList['story']['progress']['doneScaleRate'] = '按規模統計的需求完成率';

$lang->reporttemplate->chartList['bug']['basicStatistic']['efficientRate'] = 'Bug有效率';
$lang->reporttemplate->chartList['bug']['basicStatistic']['fixedRate']     = 'Bug修復率';
$lang->reporttemplate->chartList['bug']['basicStatistic']['caseBugRate']   = '用例產生的Bug占比';
$lang->reporttemplate->chartList['bug']['basicStatistic']['statusMap']     = 'Bug狀態分佈';
$lang->reporttemplate->chartList['bug']['basicStatistic']['productMap']    = 'Bug來源產品模組分佈';
$lang->reporttemplate->chartList['bug']['basicStatistic']['severityMap']   = 'Bug嚴重程度分佈';
$lang->reporttemplate->chartList['bug']['basicStatistic']['priMap']        = 'Bug優先順序分佈';
$lang->reporttemplate->chartList['bug']['basicStatistic']['resolutionMap'] = 'Bug解決方案分佈';
$lang->reporttemplate->chartList['bug']['basicStatistic']['typeMap']       = 'Bug類型分佈';

$lang->reporttemplate->chartList['bug']['fixedProgress']['dailyNum']         = '每日新增、解決、關閉Bug數';
$lang->reporttemplate->chartList['bug']['fixedProgress']['userCreatedBugs']  = '按團隊成員統計的創建Bug數';
$lang->reporttemplate->chartList['bug']['fixedProgress']['userResolvedBugs'] = '按團隊成員統計的解決Bug數';

$lang->reporttemplate->chartList['testcase']['basicStatistic']['userCreatedCases']  = '按團隊成員統計的創建用例數';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['userExecutedCases'] = '按團隊成員統計的執行用例次數';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['productMap']        = '用例來源產品模組分佈';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['statusMap']         = '用例狀態分佈';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['priMap']            = '用例優先順序分佈';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['resultMap']         = '用例結果分佈';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['typeMap']           = '用例類型分佈';
