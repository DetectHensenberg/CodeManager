<?php
global $config;

$lang->review->id                  = '編號';
$lang->review->delete              = '刪除評審';
$lang->review->deleted             = '已刪除';
$lang->review->common              = '評審';
$lang->review->assess              = '評審';
$lang->review->record              = '評審記錄';
$lang->review->explain             = '評審說明';
$lang->review->resultExplain       = '評審結論說明';
$lang->review->reviewResult        = '評審結果';
$lang->review->conclusion          = '評審結論（是否通過）';
$lang->review->recall              = '撤回評審';
$lang->review->files               = '附件';
$lang->review->start               = '發起評審';
$lang->review->finish              = '結束';
$lang->review->toAudit             = '提交審計';
$lang->review->create              = '發起評審';
$lang->review->submit              = '提交評審';
$lang->review->submitDeliverable   = '發起交付物評審';
$lang->review->submitBaseline      = '發起基線評審';
$lang->review->submitIpd           = '發起TR與DCP評審';
$lang->review->submitProjectchange = '發起項目變更評審';
$lang->review->createFlow          = '新建評審流程';
$lang->review->edit                = '編輯評審';
$lang->review->editFlow            = '編輯評審流程';
$lang->review->deleteFlow          = '刪除評審流程';
$lang->review->browse              = '瀏覽評審';
$lang->review->admin               = '瀏覽評審流程列表';
$lang->review->view                = '評審詳情';
$lang->review->viewFlow            = '預覽評審流程';
$lang->review->title               = '評審標題';
$lang->review->type                = '評審類型';
$lang->review->cm                  = '配置項';
$lang->review->cmTitle             = '基線名稱';
$lang->review->deliverables        = '評審的交付物';
$lang->review->object              = '評審對象';
$lang->review->content             = '評審內容來源';
$lang->review->doclib              = '相關文檔庫';
$lang->review->template            = '相關模板';
$lang->review->doc                 = '相關文檔';
$lang->review->version             = '版本號';
$lang->review->deliverable         = '交付物';
$lang->review->reviewedBy          = '已評審人';
$lang->review->reviewer            = '評審人員';
$lang->review->reviewReport        = '評審報告';
$lang->review->exportReport        = '導出評審報告';
$lang->review->reviewerCount       = '評審人數';
$lang->review->deadline            = '計劃完成時間';
$lang->review->comment             = '備註';
$lang->review->createdBy           = '由誰創建';
$lang->review->createdDate         = '創建時間';
$lang->review->submitedBy          = '由誰發起';
$lang->review->reviewedHours       = '評審時長（小時）';
$lang->review->area                = '評審地點';
$lang->review->audit               = '審計';
$lang->review->auditedBy           = '由誰審計';
$lang->review->issueCount          = '缺陷總數';
$lang->review->issueFoundRate      = '缺陷發現率';
$lang->review->issues              = '發現的問題';
$lang->review->isIssue             = '是否缺陷';
$lang->review->result              = '評審節點及結果';
$lang->review->nodeDetail          = '節點詳情';
$lang->review->status              = '狀態';
$lang->review->opinion             = '修改意見';
$lang->review->finalOpinion        = '評審意見';
$lang->review->reviewcl            = '檢查清單';
$lang->review->reviewedDate        = '評審時間';
$lang->review->consumed            = '消耗工時';
$lang->review->basicInfo           = '基本信息';
$lang->review->product             = '所屬' . $lang->productCommon;
$lang->review->auditResult         = '審計結果';
$lang->review->auditedDate         = '審計時間';
$lang->review->auditOpinion        = '審計意見';
$lang->review->issueList           = '問題列表';
$lang->review->lastIssue           = '上次遺留問題';
$lang->review->fullScreen          = '全屏';
$lang->review->auditedByEmpty      = '由誰審計不能為空！';
$lang->review->exporting           = '正在導出...';
$lang->review->lastReviewedDate    = '最後評審時間';
$lang->review->lastAuditedDate     = '最後審計時間';
$lang->review->lastEditedBy        = '最後修改';
$lang->review->createBaseline      = '打基線';
$lang->review->opinionDate         = '建議解決時間';
$lang->review->setReviewer         = '下一節點審批人';
$lang->review->issueCountTip       = "{$lang->review->issueCount}統計的是{$lang->review->common}不符合項的問題總數";
$lang->review->issueFoundRateTip   = "{$lang->review->issueFoundRate}={$lang->review->issueCount}/{$lang->review->reviewedHours}";
$lang->review->untitled            = '未命名';
$lang->review->objectID            = '交付物類型';
$lang->review->flow                = '審批流';
$lang->review->createApproval      = '新建審批流';
$lang->review->approval            = '評審流程名稱';
$lang->review->relatedBy           = '維護人';
$lang->review->relatedDate         = '維護時間';
$lang->review->deliverableEmptyTip = '暫無交付物數據，請點擊“確定”去創建。';

$lang->review->browseAction = '評審列表';

$lang->review->pageAllSummary = '本頁共 %total% 個評審，待評審 %wait%，評審中 %reviewing%，評審通過 %pass%。';
$lang->review->pageSummary    = '本頁共 %s 個評審。';

$lang->object = new stdclass();
$lang->object->product = $lang->review->product;

$lang->review->report = new stdclass();
$lang->review->report->common = '評審報告';

$lang->review->reportCreatedBy  = '報告提交人';
$lang->review->reportApprovedBy = '報告審批人';

$lang->review->listCategory = '分類';
$lang->review->listTitle    = '檢查內容';
$lang->review->listItem     = '檢查項';
$lang->review->listResult   = '是否符合';

$lang->review->contentList['template'] = '系統模板生成';
$lang->review->contentList['doc']      = $lang->projectCommon . '文檔';

$lang->review->noBook        = '暫無相關說明書，請到文檔維護說明書';
$lang->review->stopSubmit    = '檢查清單中存在不符合項';
$lang->review->confirmDelete = '您確定刪除該評審嗎？刪除後該評審下的問題也會刪除！';
$lang->review->confirmRecall = '您確定要撤回該評審嗎？';

$lang->review->statusList['draft']     = '待評審';
$lang->review->statusList['reverting'] = '回退中';
$lang->review->statusList['reviewing'] = '評審中';
$lang->review->statusList['pass']      = '評審通過';
$lang->review->statusList['fail']      = '評審失敗';
$lang->review->statusList['done']      = '完成';

$lang->review->resultList['pass']        = '通過';
$lang->review->resultList['conditional'] = '有條件通過';
$lang->review->resultList['fail']        = '不通過';

$lang->review->auditResultList['pass']    = '通過';
$lang->review->auditResultList['needfix'] = '修改後再次審計';
$lang->review->auditResultList['fail']    = '重新走評審流程';

$lang->review->resultLable['pass']    = 'success';
$lang->review->resultLable['fail']    = 'danger';
$lang->review->resultLable['needfix'] = 'info';

$lang->review->reviewResultList['pass']        = '通過';
$lang->review->reviewResultList['needfix']     = '修改後通過';
$lang->review->reviewResultList['conditional'] = '有條件通過';
$lang->review->reviewResultList['fail']        = '不通過';

$lang->review->checkList['1']  = '符合';
$lang->review->checkList['0']  = '不符合';
$lang->review->checkList['na'] = '不適用';

$lang->review->resolvedList['1'] = '已解決';
$lang->review->resolvedList['0'] = '未解決';

$lang->review->typeList['all']           = '全部';
$lang->review->typeList['decision']      = 'TR與DCP評審';
$lang->review->typeList['deliverable']   = '交付物評審';
$lang->review->typeList['baseline']      = '基線評審';
$lang->review->typeList['projectchange'] = '項目變更評審';

$lang->review->featureBar['browse']['all']          = '全部';
$lang->review->featureBar['browse']['wait']         = '待我評審';
$lang->review->featureBar['browse']['reviewing']    = '評審中';
$lang->review->featureBar['browse']['reviewedbyme'] = '我評審過';
$lang->review->featureBar['browse']['createdbyme']  = '由我發起';

$lang->review->featureBar['admin']['deliverable']   = '交付物評審';
$lang->review->featureBar['admin']['decision']      = 'TR與DCP評審';
$lang->review->featureBar['admin']['baseline']      = '基線評審';
$lang->review->featureBar['admin']['projectchange'] = '項目變更評審';

$lang->review->editFlowLabel['review']   = '交付物類型';
$lang->review->editFlowLabel['decision'] = 'TR與DCP評審';
$lang->review->editFlowLabel['baseline'] = '評審流程';

$lang->review->decisionList['TR']  = 'TR評審點';
$lang->review->decisionList['DCP'] = 'DCP評審點';

$lang->review->baselineReviews = array();
$lang->review->baselineReviews['baseline'] = '基線評審';
$lang->review->baselineReviews['change']   = '項目變更評審';

$lang->review->resultExplainList['pass'] = "通過：工作成果合格，“無需修改”或者“需要輕微修改但不必再審核”。";
$lang->review->resultExplainList['fail'] = '不通過：工作成果不合格，需要作比較大的修改，之後必須重新對其評審。';

$lang->review->issue = new stdclass();
$lang->review->issue->id           = '序號';
$lang->review->issue->summary      = '缺陷分析及跟蹤';
$lang->review->issue->desc         = '缺陷描述';
$lang->review->issue->analyse      = '缺陷分析';
$lang->review->issue->introAnalyse = '引入分析';
$lang->review->issue->resolvedBy   = '修改人';
$lang->review->issue->deadline     = '修改期限';
$lang->review->issue->resolvedDate = '修改完成時間';
$lang->review->issue->severity     = '嚴重程度';
$lang->review->issue->verifiedBy   = '驗證人';
$lang->review->issue->status       = '狀態';

$lang->review->action = new stdclass();
$lang->review->action->reviewed  = array('main' => '$date, 由 <strong>$actor</strong> 評審，結果為 <strong>$extra</strong>。', 'extra' => 'resultList');
$lang->review->action->submit    = array('main' => '$date, 由 <strong>$actor</strong> 提交評審。');
$lang->review->action->recall    = array('main' => '$date, 由 <strong>$actor</strong> 撤回評審。');
$lang->review->action->toaudit   = array('main' => '$date, 由 <strong>$actor</strong> 提交審計， 指派給 <strong>$extra</strong>。');
$lang->review->action->audited   = array('main' => '$date, 由 <strong>$actor</strong> 審計，結果為 <strong>$extra</strong>。', 'extra' => 'auditResultList');

$lang->reviewresult = new stdclass();
$lang->reviewresult->consumed    = '消耗工時';
$lang->reviewresult->createdDate = '審計時間';

$lang->review->selectApprovalText = '評審：第%s次';

$lang->review->cannotReview       = '抱歉！您沒有該條數據的審批權限。';
$lang->review->cannotDeleteFlow   = '內置評審流程不可以刪除';
$lang->review->confirmDeleteFlow  = '將同步刪除檢查清單，是否繼續？';
$lang->review->createDecision     = '請在階段列表新建評審點，評審流程會同步生成。';
$lang->review->deleteDecision     = '只能在階段列表中刪除評審點。';
$lang->review->cannotReviewChange = '項目變更評審無需配置檢查清單';
