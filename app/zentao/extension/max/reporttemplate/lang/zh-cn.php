<?php
$lang->reporttemplate->create         = '创建报告模板';
$lang->reporttemplate->edit           = '编辑';
$lang->reporttemplate->editAction     = '编辑报告模板';
$lang->reporttemplate->delete         = '删除模板';
$lang->reporttemplate->deleteAbbr     = '删除';
$lang->reporttemplate->deleteAction   = '删除报告模板';
$lang->reporttemplate->browse         = '浏览报告模板';
$lang->reporttemplate->view           = '报告模板详情';
$lang->reporttemplate->addCategory    = '添加分类';
$lang->reporttemplate->editCategory   = '编辑分类';
$lang->reporttemplate->deleteCategory = '删除分类';
$lang->reporttemplate->pause          = '停用';
$lang->reporttemplate->pauseAction    = '停用报告模板';
$lang->reporttemplate->cron           = '定时生成';

$lang->reporttemplate->lib            = '所属范围';
$lang->reporttemplate->module         = '分类';
$lang->reporttemplate->objects        = '适用流程';
$lang->reporttemplate->title          = '模板标题';
$lang->reporttemplate->status         = '模板状态';
$lang->reporttemplate->desc           = '模板简介';
$lang->reporttemplate->acl            = '模板访问控制';
$lang->reporttemplate->reportAcl      = '生成报告的访问控制';
$lang->reporttemplate->cycle          = '生成频率';
$lang->reporttemplate->content        = '模板内容';
$lang->reporttemplate->basic          = '基本信息';
$lang->reporttemplate->basicStatistic = '基本统计';
$lang->reporttemplate->progress       = '进度分析';
$lang->reporttemplate->resource       = '资源分析';
$lang->reporttemplate->fixedProgress  = '修复进度';
$lang->reporttemplate->outline        = '模板大纲';
$lang->reporttemplate->beginDate      = '开始日期';
$lang->reporttemplate->endDate        = '结束日期';
$lang->reporttemplate->allProject     = '全部流程';
$lang->reporttemplate->dateRange      = '日期范围';
$lang->reporttemplate->cronLog        = '定时日志';

$lang->reporttemplate->aclList['open']    = '公开（有浏览报告模板权限，即可访问）';
$lang->reporttemplate->aclList['private'] = '私有（仅创建者和白名单用户可访问）';

$lang->reporttemplate->statusList['draft']  = '草稿';
$lang->reporttemplate->statusList['normal'] = '已发布';
$lang->reporttemplate->statusList['pause']  = '已停用';

$lang->reporttemplate->cronTitle             = '定时规则设置';
$lang->reporttemplate->cronTurnon            = '是否定时生成';
$lang->reporttemplate->cronTurnonList['on']  = '是';
$lang->reporttemplate->cronTurnonList['off'] = '否';

$lang->reporttemplate->cronFrequency              = '生成频率';
$lang->reporttemplate->cronFrequencyList['day']   = '每天';
$lang->reporttemplate->cronFrequencyList['week']  = '每周';
$lang->reporttemplate->cronFrequencyList['month'] = '每月';
$lang->reporttemplate->cronFrequencyTips['day']   = '（每天 0:00 生成报告）';
$lang->reporttemplate->cronFrequencyTips['week']  = '（每周一 0:00 生成报告）';
$lang->reporttemplate->cronFrequencyTips['month'] = '（每月1号 0:00 生成报告）';

$lang->reporttemplate->appendUsers['PROJECTPM']          = '项目负责人';
$lang->reporttemplate->appendUsers['PROJECTTEAM']        = '项目团队成员';
$lang->reporttemplate->appendUsers['PROJECTSTAKEHOLDER'] = '项目干系人';
$lang->reporttemplate->appendUsers['PROJECTWHITELIST']   = '项目白名单';

$lang->reporttemplate->titleTemplate['day']   = '%s每天报告';
$lang->reporttemplate->titleTemplate['week']  = '%s周报';
$lang->reporttemplate->titleTemplate['month'] = '%s月度规划报告';

$lang->reporttemplate->weekNumber[0] = '第一周';
$lang->reporttemplate->weekNumber[1] = '第二周';
$lang->reporttemplate->weekNumber[2] = '第三周';
$lang->reporttemplate->weekNumber[3] = '第四周';
$lang->reporttemplate->weekNumber[4] = '第五周';
$lang->reporttemplate->weekNumber[5] = '第六周';

$lang->reporttemplate->hotDate      = '修改日期';
$lang->reporttemplate->scope        = '范围';
$lang->reporttemplate->scopeField   = '所属范围';
$lang->reporttemplate->categoryName = '分类名称';
$lang->reporttemplate->templateDesc = '模板简介';
$lang->reporttemplate->groups       = '分组';
$lang->reporttemplate->users        = '用户';

$lang->reporttemplate->noCategory              = '没有分类';
$lang->reporttemplate->noTemplate              = '没有报告模板';
$lang->reporttemplate->noDesc                  = '暂时没有描述';
$lang->reporttemplate->createTypeFirst         = '请先创建报告模板分类';
$lang->reporttemplate->confirmPause            = '您确定要停用此模板吗?';
$lang->reporttemplate->confirmDelete           = '您确定删除该报告模板吗?';
$lang->reporttemplate->confirmDeleteCategory   = '您确定要删除该分类吗？';
$lang->reporttemplate->leaveEditingConfirm     = '模板编辑中，确定要离开吗？';
$lang->reporttemplate->searchScopePlaceholder  = '搜索范围';
$lang->reporttemplate->searchModulePlaceholder = '搜索分类';
$lang->reporttemplate->insertSystemData        = '插入系统数据';
$lang->reporttemplate->executionDataTips       = "获取项目内全部{$lang->execution->common}数据";
$lang->reporttemplate->noneConditionTips       = '未设置条件将获取项目内全部数据。';
$lang->reporttemplate->chartBlockTip           = '由该模板生成报告时展示相应的图表';
$lang->reporttemplate->emptyDataTip            = '此筛选条件下，暂无符合条件系统数据。';
$lang->reporttemplate->devRateTip              = '类型为%s的任务中，（%s的任务数÷ 任务数）×  100%%';
$lang->reporttemplate->testRateTip             = '类型为%s的任务中，（%s的任务数÷ 任务数）×  100%%';
$lang->reporttemplate->taskTotalCount          = '总计：%s 个任务';
$lang->reporttemplate->logTemplate             = '成功生成报告%s个，生成失败%s个';

$lang->reporttemplate->doingSummaryTip = <<<EOD
需求数: %s中所有需求数量之和
剩余需求数: %s中所有未关闭的需求数量之和
任务数: %s中所有任务数量之和
剩余任务数: %s中状态不是“ 已关闭” 和“ 已完成” 的任务数量求和
剩余工时数: %s中所有任务剩余工时数求和, 过滤父任务, 过滤状态为已取消和已关闭的任务
消耗工时数: %s中所有任务剩余工时数求和, 过滤父任务
%s进度: 消耗工时数 ÷（消耗工时数+剩余工时数）× 100%
EOD;

$lang->reporttemplate->closedSummaryTip = <<<EOD
执行关闭后第二天显示统计数据，统计规则如下：
开发效率: %s关闭时已交付的研发需求规模数÷按%s统计的任务消耗工时数
需求验收通过率: %s关闭时验收通过的研发需求数÷按%s统计的有效研发需求数
需求按计划完成率: %s关闭时已交付的研发需求数÷截止%s开始当天的研发需求数
开发任务完成率: %s关闭时已完成的开发类型任务数÷按%s统计的开发任务数
测试任务完成率: %s关闭时已完成的测试类型任务数÷按%s统计的测试任务数
测试缺陷密度: 按%s统计的新增有效Bug数÷%s关闭时研发完毕的研发需求规模数
EOD;

$lang->reporttemplate->notice = new stdclass();
$lang->reporttemplate->notice->filter     = '筛选条件';
$lang->reporttemplate->notice->noSettings = '项目内全部%s数据';
$lang->reporttemplate->notice->noSupport  = '当前项目暂不支持“%s”';
$lang->reporttemplate->notice->logLimit   = '最多显示最新20条记录';

$lang->reporttemplate->disabledHint = new stdclass();
$lang->reporttemplate->disabledHint->pause  = '该模板暂未发布';
$lang->reporttemplate->disabledHint->delete = '内置报告模板不能删除';

$lang->reporttemplate->error = new stdclass();
$lang->reporttemplate->error->deleteCategory   = '该分类下有报告模板，请移除模板后删除';
$lang->reporttemplate->error->beginMoreThanEnd = '开始日期不能大于结束日期';

$lang->reporttemplate->builtInScopes = array();
$lang->reporttemplate->builtInScopes['rnd']  = array();
$lang->reporttemplate->builtInScopes['rnd']['project'] = '项目';

$lang->reporttemplate->filterTypes = array();
$lang->reporttemplate->filterTypes[] = array('all', '全部');
$lang->reporttemplate->filterTypes[] = array('draft', '草稿');
$lang->reporttemplate->filterTypes[] = array('released', '已发布');
$lang->reporttemplate->filterTypes[] = array('paused', '已停用');
$lang->reporttemplate->filterTypes[] = array('createdByMe', '我创建的');

$lang->reporttemplate->quickEditMenuList['properties']   = '属性';
$lang->reporttemplate->quickEditMenuList['lists']        = '列表';
$lang->reporttemplate->quickEditMenuList['measurements'] = '数据';
$lang->reporttemplate->quickEditMenuList['charts']       = '图表';

$lang->reporttemplate->filterList['projectStory'] = '项目研发需求筛选器';
$lang->reporttemplate->filterList['HLDS']         = '概要设计筛选器';
$lang->reporttemplate->filterList['DDS']          = '详细设计筛选器';
$lang->reporttemplate->filterList['DBDS']         = '数据库设计筛选器';
$lang->reporttemplate->filterList['ADS']          = '接口设计筛选器';
$lang->reporttemplate->filterList['task']         = '任务筛选器';
$lang->reporttemplate->filterList['projectCase']  = '项目用例筛选器';
$lang->reporttemplate->filterList['projectBug']   = '项目Bug筛选器';

$lang->reporttemplate->project   = $lang->projectCommon;
$lang->reporttemplate->execution = $lang->execution->common;
$lang->reporttemplate->task      = '任务';
$lang->reporttemplate->story     = '需求';
$lang->reporttemplate->bug       = 'Bug';
$lang->reporttemplate->testcase  = '用例';
$lang->reporttemplate->weekly    = '报告';

$lang->reporttemplate->measurementList['execution']['total']     = "{$lang->execution->common}数";
$lang->reporttemplate->measurementList['execution']['doingNum']  = "进行中{$lang->execution->common}数";
$lang->reporttemplate->measurementList['execution']['closedNum'] = "已关闭{$lang->execution->common}数";
$lang->reporttemplate->measurementList['execution']['delayNum']  = "延期{$lang->execution->common}数";

$lang->reporttemplate->measurementList['task']['taskNum']     = '任务数';
$lang->reporttemplate->measurementList['task']['doneNum']     = '已完成任务数';
$lang->reporttemplate->measurementList['task']['consumed']    = '已消耗工时数';
$lang->reporttemplate->measurementList['task']['left']        = '剩余工时数';
$lang->reporttemplate->measurementList['task']['bugTaskNum']  = 'Bug转任务的数量';
$lang->reporttemplate->measurementList['task']['bugConsume']  = 'Bug转任务的消耗工时';

$lang->reporttemplate->measurementList['story']['storyNum']        = '需求条目数';
$lang->reporttemplate->measurementList['story']['storyScale']      = '需求规模数';
$lang->reporttemplate->measurementList['story']['devNum']          = '研发完毕需求条目数';
$lang->reporttemplate->measurementList['story']['devScale']        = '研发完毕需求规模数';
$lang->reporttemplate->measurementList['story']['testNum']         = '测试完毕需求条目数';
$lang->reporttemplate->measurementList['story']['testScale']       = '测试完毕需求规模数';
$lang->reporttemplate->measurementList['story']['doneNum']         = '已完成需求条目数';
$lang->reporttemplate->measurementList['story']['doneScale']       = '已完成需求规模数';
$lang->reporttemplate->measurementList['story']['closedNum']       = '已关闭需求条目数';
$lang->reporttemplate->measurementList['story']['closedScale']     = '已关闭需求规模数';
$lang->reporttemplate->measurementList['story']['changedNum']      = '变更需求条目数';
$lang->reporttemplate->measurementList['story']['changedScale']    = '变更需求规模数';
$lang->reporttemplate->measurementList['story']['defect']          = '研发完毕的需求的缺陷密度';
$lang->reporttemplate->measurementList['story']['hasCaseStoryNum'] = '有用例的需求数';
$lang->reporttemplate->measurementList['story']['caseCoverage']    = '需求用例覆盖率';
$lang->reporttemplate->measurementList['story']['caseDensity']     = '需求用例密度';

$lang->reporttemplate->measurementList['bug']['total']     = 'Bug总数';
$lang->reporttemplate->measurementList['bug']['effective'] = '有效Bug数';
$lang->reporttemplate->measurementList['bug']['useCase']   = '执行用例产生的Bug数';
$lang->reporttemplate->measurementList['bug']['fixed']     = '已修复Bug数';

$lang->reporttemplate->measurementList['testcase']['caseNum'] = '用例数';

$lang->reporttemplate->measurementList['weekly']['term']  = '报告周期';
$lang->reporttemplate->measurementList['weekly']['staff'] = '投入人数';

$lang->reporttemplate->chartList['project']['basicStatistic']['gantt']    = '甘特图';
$lang->reporttemplate->chartList['project']['basicStatistic']['workload'] = "{$lang->projectCommon}计划工作量统计";

$lang->reporttemplate->chartList['project']['progress']['summary'] = "{$lang->projectCommon}进展状况";

$lang->reporttemplate->chartList['execution']['basicStatistic']['closedRate']    = "{$lang->execution->common}关闭率";
$lang->reporttemplate->chartList['execution']['basicStatistic']['delayRate']     = "{$lang->execution->common}延期率";
$lang->reporttemplate->chartList['execution']['basicStatistic']['statusMap']     = "{$lang->execution->common}状态分布";
$lang->reporttemplate->chartList['execution']['basicStatistic']['doingSummary']  = "进行中{$lang->execution->common}汇总表";
$lang->reporttemplate->chartList['execution']['basicStatistic']['closedSummary'] = "已关闭{$lang->execution->common}汇总表";

$lang->reporttemplate->chartList['task']['basicStatistic']['doneRate']   = '任务完成率';
$lang->reporttemplate->chartList['task']['basicStatistic']['taskRate']   = '任务进度';
$lang->reporttemplate->chartList['task']['basicStatistic']['statusMap']  = '任务状态分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['assignMap']  = '任务指派给分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['ownerMap']   = '任务完成者分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['moduleMap']  = '任务一级模块分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['typeMap']    = '任务类型分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['priMap']     = '任务优先级分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['reasonMap']  = '任务关闭原因分布';
$lang->reporttemplate->chartList['task']['basicStatistic']['devRate']    = '开发类型任务完成率';
$lang->reporttemplate->chartList['task']['basicStatistic']['testRate']   = '测试类型任务完成率';
$lang->reporttemplate->chartList['task']['basicStatistic']['finished']   = '已完成任务情况';
$lang->reporttemplate->chartList['task']['basicStatistic']['unfinished'] = '未完成任务情况';
$lang->reporttemplate->chartList['task']['basicStatistic']['workplan']   = '工作计划';

$lang->reporttemplate->chartList['task']['progress']['typeHour']   = '不同类型任务的进度统计表';
$lang->reporttemplate->chartList['task']['progress']['statusData'] = '不同类型任务的状态统计表';
$lang->reporttemplate->chartList['task']['progress']['dailyNum']   = '每日完成任务数量柱状图(近14天)';

$lang->reporttemplate->chartList['task']['resource']['bugRate']           = 'Bug转任务的数量占比';
$lang->reporttemplate->chartList['task']['resource']['bugConsumeRate']    = 'Bug转任务的消耗工时占比';
$lang->reporttemplate->chartList['task']['resource']['userEfforts']       = '按团队成员统计的任务消耗工时数';
$lang->reporttemplate->chartList['task']['resource']['teamEfforts']       = '按团队成员统计的工时投入';
$lang->reporttemplate->chartList['task']['resource']['workAssignSummary'] = '任务指派汇总表';
$lang->reporttemplate->chartList['task']['resource']['workSummary']       = '任务完成汇总表';

$lang->reporttemplate->chartList['story']['basicStatistic']['statusMap']   = '需求状态分布';
$lang->reporttemplate->chartList['story']['basicStatistic']['stageMap']    = '需求阶段分布';
$lang->reporttemplate->chartList['story']['basicStatistic']['productMap']  = "需求来源{$lang->productCommon}模块分布";
$lang->reporttemplate->chartList['story']['basicStatistic']['sourceMap']   = '需求来源分布';
$lang->reporttemplate->chartList['story']['basicStatistic']['priMap']      = '需求优先级分布';
$lang->reporttemplate->chartList['story']['basicStatistic']['categoryMap'] = '需求所属类别分布';
$lang->reporttemplate->chartList['story']['basicStatistic']['userMap']     = '需求由谁创建分布';

$lang->reporttemplate->chartList['story']['progress']['devRate']       = '按条目统计的需求研发完毕率';
$lang->reporttemplate->chartList['story']['progress']['devScaleRate']  = '按规模统计的需求研发完毕率';
$lang->reporttemplate->chartList['story']['progress']['testRate']      = '按条目统计的需求测试完毕率';
$lang->reporttemplate->chartList['story']['progress']['testScaleRate'] = '按规模统计的需求测试完毕率';
$lang->reporttemplate->chartList['story']['progress']['doneRate']      = '按条目统计的需求完成率';
$lang->reporttemplate->chartList['story']['progress']['doneScaleRate'] = '按规模统计的需求完成率';

$lang->reporttemplate->chartList['bug']['basicStatistic']['efficientRate'] = 'Bug有效率';
$lang->reporttemplate->chartList['bug']['basicStatistic']['fixedRate']     = 'Bug修复率';
$lang->reporttemplate->chartList['bug']['basicStatistic']['caseBugRate']   = '用例产生的Bug占比';
$lang->reporttemplate->chartList['bug']['basicStatistic']['statusMap']     = 'Bug状态分布';
$lang->reporttemplate->chartList['bug']['basicStatistic']['productMap']    = 'Bug来源产品模块分布';
$lang->reporttemplate->chartList['bug']['basicStatistic']['severityMap']   = 'Bug严重程度分布';
$lang->reporttemplate->chartList['bug']['basicStatistic']['priMap']        = 'Bug优先级分布';
$lang->reporttemplate->chartList['bug']['basicStatistic']['resolutionMap'] = 'Bug解决方案分布';
$lang->reporttemplate->chartList['bug']['basicStatistic']['typeMap']       = 'Bug类型分布';

$lang->reporttemplate->chartList['bug']['fixedProgress']['dailyNum']         = '每日新增、解决、关闭Bug数';
$lang->reporttemplate->chartList['bug']['fixedProgress']['userCreatedBugs']  = '按团队成员统计的创建Bug数';
$lang->reporttemplate->chartList['bug']['fixedProgress']['userResolvedBugs'] = '按团队成员统计的解决Bug数';

$lang->reporttemplate->chartList['testcase']['basicStatistic']['userCreatedCases']  = '按团队成员统计的创建用例数';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['userExecutedCases'] = '按团队成员统计的执行用例次数';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['productMap']        = '用例来源产品模块分布';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['statusMap']         = '用例状态分布';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['priMap']            = '用例优先级分布';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['resultMap']         = '用例结果分布';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['typeMap']           = '用例类型分布';
