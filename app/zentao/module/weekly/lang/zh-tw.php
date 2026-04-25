<?php
/**
 * The weekly module lang file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     weekly
 * @version     $Id
 * @link        https://www.zentao.net
 */
$lang->weekly->common   = '報告';
$lang->weekly->index    = '周報總覽';
$lang->weekly->progress = '完成百分比';
$lang->weekly->workload = '工作量';
$lang->weekly->total    = '合計';

$lang->weekly->reportTtitle   = $lang->projectCommon . ': %s 周報（第 %s 周）';
$lang->weekly->summary        = $lang->projectCommon . '進展狀況';
$lang->weekly->finished       = '本週工作完成情況（100%完成的工作）';
$lang->weekly->postponed      = '本週未完成工作';
$lang->weekly->nextWeek       = '下周工作計劃';
$lang->weekly->workloadByType = '工作量統計';

$lang->weekly->term            = '報告周期';
$lang->weekly->project         = $lang->projectCommon . '名稱';
$lang->weekly->master          = '項目經理 ';
$lang->weekly->staff           = '本週投入人數';
$lang->weekly->projectTemplate = "{$lang->projectCommon}周報模板";

$lang->weekly->weekDesc       = '第 %s 周( %s ~ %s)';
$lang->weekly->progress       = $lang->projectCommon . '當前進展狀況';
$lang->weekly->analysisResult = '分析結果';
$lang->weekly->cost           = $lang->projectCommon . '成本';

$lang->weekly->pv = '計劃完成的工作(PV)';
$lang->weekly->ev = '實際完成的工作(EV)';
$lang->weekly->ac = '實際花費的成本(AC)';
$lang->weekly->sv = '進度偏差率(SV%)';
$lang->weekly->cv = '成本偏差率（CV%）';

$lang->weekly->totalCount  = '總計 : %u 個任務';
$lang->weekly->builtinDesc = "系統內置的{$lang->projectCommon}周報模板，每週一在{$lang->projectCommon}下自動生成本週周報。";

$lang->weekly->exportWeeklyReport = '導出周報';

$lang->weekly->builtInScopes = array();
$lang->weekly->builtInScopes['rnd']  = array();
$lang->weekly->builtInScopes['rnd']['project'] = '項目';

$lang->weekly->builtInCategoryList['month']     = '月報';
$lang->weekly->builtInCategoryList['week']      = '周報';
$lang->weekly->builtInCategoryList['day']       = '日報';
$lang->weekly->builtInCategoryList['milestone'] = '里程碑報告';

$lang->weekly->reportHelpNotice = <<<EOD
<h2>PV 計劃完成的工作</h2>
計算方式：
<br />1）任務預計開始日期、截止日期在本週起止日期範圍內，累加預計工時
<br />2）任務預計開始日期、截止日期在本週起止日期之前，累加預計工時
<br />3）任務預計開始日期小於本週開始日期，截止日期大於本週開始日期，小於本週結束日期，累加預計工時
<br />4）任務預計開始日期大於本週開始日期，小於本週截止日期，截止日期大於本週結束日期，累加 （任務的預計工時÷任務工期天數）×  任務預計開始到本週結束日期的天數
<br />5）任務預計開始日期等於本週開始日期，截止日期大於本週結束日期，累加 （任務的預計工時÷任務工期天數）×  任務預計開始到本週結束日期的天數
<br />6）任務預計開始日期小於本週開始日期，截止日期等於本週結束日期，累加預計工時
<br />7）任務預計開始日期小於本週開始日期，截止日期大於本週結束日期，累加 （任務的預計工時÷任務工期天數）×  任務預計開始到本週結束日期的天數
<p>統計範圍：</p>
1）本週開始日期：周一 00:00:00  本週結束日期：根據工作日和節假日的計算來確定
<br />2）為避免重複計算，只包含子任務，不包括父任務
<br />3）不包括已刪除的任務
<br />4）不包括已取消的任務
<br />5）不包括已刪除執行中的任務
<br />6）任務未填寫預計開始日期，預計開始日期預設取任務所屬階段的計劃開始日期
<br />7）任務未填寫預計截止日期，預計截止日期預設取任務所屬階段的計劃完成日期
<br />8）計算公式只計算工作日
<h2>EV實際完成的工作</h2>
計算方式：
<br />1）任務狀態為已完成，累加預計工時
<br />2）任務狀態為已關閉且關閉原因為已完成，累加預計工時
<br />3）任務狀態為進行中、已暫停，累加 預計工時×完成進度
<p>統計範圍：</p>
1）本週結束日期之前消耗工時不為0的任務
<br />2）為避免重複計算，只包含子任務，不包括父任務
<br />3）不包括已刪除的任務
<br />4）不包括已取消的任務
<br />5）不包括已刪除執行中的任務
<br />6）完成進度=已消耗工時÷(已消耗工時+剩餘工時)
<h2>AC 實際花費（消耗）的成本</h2>
計算方式：
<br />1）累加本週結束日期之前所有消耗的工時
<p>統計範圍：</p>
1）所有消耗的工時包括任務、需求、Bug、用例、構建、測試單、問題、風險、文檔、評審的耗時
<br />2）為避免重複計算，只包含子任務，不包括父任務
<br />3）包括已刪除的任務、需求、Bug、用例、構建、測試單、問題、風險、文檔、評審的耗時
<br />4）包括已刪除執行中任務、需求、Bug、用例、構建、測試單、文檔的耗時
<br />5）包括取消的任務、問題、風險的耗時
<h2>SV(%)進度偏差率</h2>
計算方式：SV(%) = -1 * (1 - (EV / PV))%
<h2>CV(%) 成本偏差率</h2>
計算方式：CV(%) = -1 * (1 - (EV / AC))%
EOD;
$lang->weekly->blockHelpNotice = <<<EOD
<h2>本週進度</h2>
計算方式：
<br />1）項目進度=已消耗任務工時 /（已消耗任務工時 + 剩餘任務工時）*100%
<p>統計範圍：</p>
1）只統計任務的工時消耗數據。
<br />2）為避免重複計算，任務工時只包含子任務，不包括父任務
<br />3）包括已取消任務消耗的工時
<br />4）不包括已刪除任務中消耗的工時
<br />5）不包括已刪除執行中任務消耗的工時
<br />6）不包括已取消任務的剩餘工時
<br />7）不包括已刪除執行中任務的剩餘工時
<h2>PV 計劃完成的工作</h2>
計算方式：
<br />1）任務預計開始日期、截止日期在本週起止日期範圍內，累加預計工時
<br />2）任務預計開始日期、截止日期在本週起止日期之前，累加預計工時
<br />3）任務預計開始日期小於本週開始日期，截止日期大於本週開始日期，小於本週結束日期，累加預計工時
<br />4）任務預計開始日期大於本週開始日期，小於本週截止日期，截止日期大於本週結束日期，累加 （任務的預計工時÷任務工期天數）×  任務預計開始到本週結束日期的天數
<br />5）任務預計開始日期等於本週開始日期，截止日期大於本週結束日期，累加 （任務的預計工時÷任務工期天數）×  任務預計開始到本週結束日期的天數
<br />6）任務預計開始日期小於本週開始日期，截止日期等於本週結束日期，累加預計工時
<br />7）任務預計開始日期小於本週開始日期，截止日期大於本週結束日期，累加 （任務的預計工時÷任務工期天數）×  任務預計開始到本週結束日期的天數
<p>統計範圍：</p>
1）本週開始日期：周一 00:00:00  本週結束日期：根據工作日和節假日的計算來確定
<br />2）為避免重複計算，只包含子任務，不包括父任務
<br />3）不包括已刪除的任務
<br />4）不包括已取消的任務
<br />5）不包括已刪除執行中的任務
<br />6）任務未填寫預計開始日期，預計開始日期預設取任務所屬階段的計劃開始日期
<br />7）任務未填寫預計截止日期，預計截止日期預設取任務所屬階段的計劃完成日期
<br />8）計算公式只計算工作日
<h2>EV實際完成的工作</h2>
計算方式：
<br />1）任務狀態為已完成，累加預計工時
<br />2）任務狀態為已關閉且關閉原因為已完成，累加預計工時
<br />3）任務狀態為進行中、已暫停，累加 預計工時×完成進度
<p>統計範圍：</p>
1）本週結束日期之前消耗工時不為0的任務
<br />2）為避免重複計算，只包含子任務，不包括父任務
<br />3）不包括已刪除的任務
<br />4）不包括已取消的任務
<br />5）不包括已刪除執行中的任務
<br />6）完成進度=已消耗工時÷(已消耗工時+剩餘工時)
<h2>AC 實際花費（消耗）的成本</h2>
計算方式：
<br />1）累加本週結束日期之前所有消耗的工時
<p>統計範圍：</p>
1）所有消耗的工時包括任務、需求、Bug、用例、構建、測試單、問題、風險、文檔、評審的耗時
<br />2）為避免重複計算，只包含子任務，不包括父任務
<br />3）包括已刪除的任務、需求、Bug、用例、構建、測試單、問題、風險、文檔、評審的耗時
<br />4）包括已刪除執行中任務、需求、Bug、用例、構建、測試單、文檔的耗時
<br />5）包括取消的任務、問題、風險的耗時
<br />
<h2>SV(%)進度偏差率</h2>
計算方式：SV(%) = -1 * (1 - (EV / PV))%
<h2>CV(%) 成本偏差率</h2>
計算方式：CV(%) = -1 * (1 - (EV / AC))%
EOD;

$lang->weekly->builtinRawContent = '{"type":"page","meta":{"id":"mKJhETwxpP","title":"項目周報模板","createDate":1758524215597,"tags":[]},"blocks":{"type":"block","id":"leP1pQM_0N","flavour":"affine:page","version":2,"props":{"title":{"$blocksuite:internal:text$":true,"delta":[{"insert":"項目周報模板"}]}},"children":[{"type":"block","id":"cDel0u6OKK","flavour":"affine:note","version":1,"props":{"xywh":"[0,0,498,92]","background":"--affine-note-background-white","index":"a0","lockedBySelf":false,"hidden":false,"displayMode":"both","edgeless":{"style":{"borderRadius":8,"borderSize":4,"borderStyle":"none","shadowType":"--affine-note-shadow-box"}}},"children":[{"type":"block","id":"57JpxtRtgl","flavour":"affine:paragraph","version":1,"props":{"align":"left","type":"text","text":{"$blocksuite:internal:text$":true,"delta":[{"insert":" ","attributes":{"holder":{"id":"-bGoKXonda","name":"weekly_term","text":"報告周期","hint":"篩選條件：“日期範圍”介於本週","data":{"type":"weekly_term","blockID":1538,"hint":"篩選條件：“日期範圍”介於本週","text":"報告周期"}}}},{"insert":"周報："},{"insert":" ","attributes":{"holder":{"id":"ZZ2iJ1NbSm","name":"property_name","text":"項目名稱","hint":"項目名稱"}}},{"insert":"項目由項目經理"},{"insert":" ","attributes":{"holder":{"id":"No8p_noVvo","name":"property_PM","text":"負責人","hint":"負責人"}}},{"insert":"負責，投入人數為"},{"insert":" ","attributes":{"holder":{"id":"yMx6IXU_PN","name":"weekly_staff","text":"投入人數","hint":"篩選條件：“日期範圍”介於本週","data":{"type":"weekly_staff","blockID":1539,"hint":"篩選條件：“日期範圍”介於本週","text":"投入人數"}}}}]},"collapsed":false},"children":[]},{"type":"block","id":"u_7TkQplvX","flavour":"affine:embed-zui-custom","version":1,"props":{"index":"a0","xywh":"[0,0,0,0]","lockedBySelf":false,"rotate":0,"content":{"exportUrl":"exportZentaoChart___TML_ZENTAOCHART__{project_progress_summary}","fetcher":[{"module":"reporttemplate","method":"ajaxZentaoChart","params":"type=project_progress_summary&blockID=__TML_ZENTAOCHART__{project_progress_summary}"}],"clearBeforeLoad":false,"isTemplate":true,"title":"項目進展狀況"}},"children":[]},{"type":"block","id":"JF8LjhZ00l","flavour":"affine:embed-zui-custom","version":1,"props":{"index":"a0","xywh":"[0,0,0,0]","lockedBySelf":false,"rotate":0,"content":{"exportUrl":"exportZentaoChart___TML_ZENTAOCHART__{task_basicStatistic_finished}","fetcher":[{"module":"reporttemplate","method":"ajaxZentaoChart","params":"type=task_basicStatistic_finished&blockID=__TML_ZENTAOCHART__{task_basicStatistic_finished}"}],"clearBeforeLoad":false,"isTemplate":true,"title":"已完成任務情況"}},"children":[]},{"type":"block","id":"vLxMdWbsaL","flavour":"affine:embed-zui-custom","version":1,"props":{"index":"a0","xywh":"[0,0,0,0]","lockedBySelf":false,"rotate":0,"content":{"exportUrl":"exportZentaoChart___TML_ZENTAOCHART__{task_basicStatistic_unfinished}","fetcher":[{"module":"reporttemplate","method":"ajaxZentaoChart","params":"type=task_basicStatistic_unfinished&blockID=__TML_ZENTAOCHART__{task_basicStatistic_unfinished}"}],"clearBeforeLoad":false,"isTemplate":true,"title":"未完成任務情況"}},"children":[]},{"type":"block","id":"2kIWtGbWIc","flavour":"affine:embed-zui-custom","version":1,"props":{"index":"a0","xywh":"[0,0,0,0]","lockedBySelf":false,"rotate":0,"content":{"exportUrl":"exportZentaoChart___TML_ZENTAOCHART__{task_basicStatistic_workplan}","fetcher":[{"module":"reporttemplate","method":"ajaxZentaoChart","params":"type=task_basicStatistic_workplan&blockID=__TML_ZENTAOCHART__{task_basicStatistic_workplan}"}],"clearBeforeLoad":false,"isTemplate":true,"title":"工作計劃"}},"children":[]},{"type":"block","id":"YQQsS51bpa","flavour":"affine:embed-zui-custom","version":1,"props":{"index":"a0","xywh":"[0,0,0,0]","lockedBySelf":false,"rotate":0,"content":{"exportUrl":"exportZentaoChart___TML_ZENTAOCHART__{project_basicStatistic_workload}","fetcher":[{"module":"reporttemplate","method":"ajaxZentaoChart","params":"type=project_basicStatistic_workload&blockID=__TML_ZENTAOCHART__{project_basicStatistic_workload}"}],"clearBeforeLoad":false,"isTemplate":true,"title":"項目計劃工作量統計"}},"children":[]},{"type":"block","id":"woAbzWK8vw","flavour":"affine:paragraph","version":1,"props":{"align":"left","type":"text","text":{"$blocksuite:internal:text$":true,"delta":[]},"collapsed":false},"children":[]}]}]}}';
