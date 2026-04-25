<?php
$lang->ai->list                             = '列表';
$lang->ai->designPrompt                     = '设计禅道智能体';
$lang->ai->apply                            = '应用';
$lang->ai->assistant->createTip             = '配置完成后将在客户端的语言模型对话下展示';
$lang->ai->miniPrograms->downloadTip        = '发布后将在通用智能体模型广场中显示，客户端将会同步更新。';
$lang->ai->miniPrograms->knowledgeLibAdd    = '添加知识库';
$lang->ai->miniPrograms->knowledgeLibAddTip = '挂载知识库增强通用智能体能力。';

$lang->ai->configZaiHint = '请先进行 ZAI 配置';

$lang->ai->prompts->noRedirect = '无需返回禅道表单';

$lang->ai->audit = new stdclass();
$lang->ai->audit->designPrompt          = '提词设计';
$lang->ai->audit->afterSave             = '保存后';
$lang->ai->audit->promptForModel        = '输入给模型';
$lang->ai->audit->backLocationList      = array();
$lang->ai->audit->backLocationList['0'] = '返回调试页面';
$lang->ai->audit->backLocationList['1'] = '返回调试页面并重新生成';

if(!isset($lang->ai->knowledgeLibs)) $lang->ai->knowledgeLibs = new stdclass();
$lang->ai->knowledgeLibs->common           = '知识库';
$lang->ai->knowledgeLibs->noData           = '暂无知识库。';
$lang->ai->knowledgeLibs->create           = '创建知识库';
$lang->ai->knowledgeLibs->myKnowledgeLib   = '我的知识库';
$lang->ai->knowledgeLibs->teamKnowledgeLib = '组织知识库';
$lang->ai->knowledgeLibs->addFileLabel     = '添加本地文件';

$lang->ai->knowledgeLibs->importActions['doc']    = '从文档库导入';
$lang->ai->knowledgeLibs->importActions['asset']  = '从资产库导入';
$lang->ai->knowledgeLibs->importTypes['doclib']   = '文档库';
$lang->ai->knowledgeLibs->importTypes['assetlib'] = '资产库';

$lang->ai->knowledgeLibs->customAdd                = '自定义添加';
$lang->ai->knowledgeLibs->zentaoData               = '禅道对象数据';
$lang->ai->knowledgeLibs->importFromAsset          = '资产库导入';
$lang->ai->knowledgeLibs->duplicateImport          = '该%s已导入，无法重复导入';
$lang->ai->knowledgeLibs->draft                    = '草稿';
$lang->ai->knowledgeLibs->published                = '已发布';
$lang->ai->knowledgeLibs->unavailable              = '暂不可用';
$lang->ai->knowledgeLibs->unpublished              = '已下架';
$lang->ai->knowledgeLibs->deleted                  = '已删除';
$lang->ai->knowledgeLibs->createdTime              = '创建时间: %s';
$lang->ai->knowledgeLibs->confirmPublish           = '发布后可在智能会话和智能体中挂载知识库。';
$lang->ai->knowledgeLibs->confirmUnpublish         = '下架后，智能会话和智能体中将无法挂载该知识库，您确定要下架吗？';
$lang->ai->knowledgeLibs->confirmDelete            = '确定删除该知识库？';
$lang->ai->knowledgeLibs->confirmDeleteFile        = '确认要删除该知识？';
$lang->ai->knowledgeLibs->aiChat                   = 'AI 问答';
$lang->ai->knowledgeLibs->searchTest               = '搜索测试';
$lang->ai->knowledgeLibs->addKnowledge             = '添加知识';
$lang->ai->knowledgeLibs->viewSourceData           = '查看原数据';
$lang->ai->knowledgeLibs->selectContent            = '请选择要查看的内容';
$lang->ai->knowledgeLibs->AddToKnowledgeLib        = '添加到知识库';
$lang->ai->knowledgeLibs->getKnowledgeChunksFailed = '获取知识内容块失败';
$lang->ai->knowledgeLibs->needSyncKnowledgeItem    = '需要先同步更新知识内容';
$lang->ai->knowledgeLibs->syncingKnowledgeItem     = '正在向量化，请稍后查看';
$lang->ai->knowledgeLibs->emptyKnowledgeData       = '暂无知识内容';
$lang->ai->knowledgeLibs->exitSearchTest           = '退出搜索测试';
$lang->ai->knowledgeLibs->testText                 = '测试文本';
$lang->ai->knowledgeLibs->inputContent             = '输入内容';
$lang->ai->knowledgeLibs->lastSyncedTime           = '最后同步';
$lang->ai->knowledgeLibs->neverSynced              = '未同步';
$lang->ai->knowledgeLibs->syncFailed               = '同步失败';
$lang->ai->knowledgeLibs->syncFailedHint           = '请检查 ZAI 配置，确保 ZAI 服务可用';
$lang->ai->knowledgeLibs->syncFailedCountAlert     = '%s 个数据同步失败，请检查 ZAI 配置，确保 ZAI 服务可用';
$lang->ai->knowledgeLibs->updateListData           = '更新列表数据';
$lang->ai->knowledgeLibs->syncListToZAI            = '同步列表数据到 ZAI';
$lang->ai->knowledgeLibs->syncListToZAIConfirm     = '是否将当前列表 %s 个数据同步到 ZAI 向量化数据库中？';
$lang->ai->knowledgeLibs->noDataNeedToUpdate       = '暂无数据需要更新';
$lang->ai->knowledgeLibs->syncingData              = '正在同步数据……';
$lang->ai->knowledgeLibs->updateFromSourceData     = '从原始数据更新列表';
$lang->ai->knowledgeLibs->updateFromSourceConfirm  = '更新列表数据后将重新向量化，确认更新？';
$lang->ai->knowledgeLibs->cannotExtractFileContent = '无法提取文件内容';
$lang->ai->knowledgeLibs->fileNotFound             = '原始文件不存在';
$lang->ai->knowledgeLibs->emptyKnowledgeContent    = '知识内容为空，请点击“查看原始数据”并输入内容';

$lang->ai->knowledgeLibs->createMyKnowledgeLib        = '创建我的知识库';
$lang->ai->knowledgeLibs->createTeamKnowledgeLib      = '创建组织知识库';
$lang->ai->knowledgeLibs->editMyKnowledgeLib          = '编辑我的知识库';
$lang->ai->knowledgeLibs->editTeamKnowledgeLib        = '编辑组织知识库';
$lang->ai->knowledgeLibs->noKnowledgeLib              = '知识库不存在';
$lang->ai->knowledgeLibs->knowledgeLibName            = '知识库名称';
$lang->ai->knowledgeLibs->knowledgeLibDesc            = '知识库描述';
$lang->ai->knowledgeLibs->knowledgeLibDescPlaceholder = '知识库的具体描述信息';

$lang->ai->knowledgeLibs->acl                = '访问控制';
$lang->ai->knowledgeLibs->myPrivateAccess    = '私有（仅创建者可见）';
$lang->ai->knowledgeLibs->teamPublicAccess   = '公开（有组织知识库视图权限即可访问）';
$lang->ai->knowledgeLibs->teamPrivateAccess  = '私有（仅创建者和白名单用户可见）';
$lang->ai->knowledgeLibs->defaultAccess      = '默认（有所选文档库访问控制权限的用户即可访问）';
$lang->ai->knowledgeLibs->whiteList          = '白名单';
$lang->ai->knowledgeLibs->group              = '用户组';
$lang->ai->knowledgeLibs->user               = '用户';
$lang->ai->knowledgeLibs->noPrivToView       = '没有权限查看该知识库';

$lang->ai->knowledgeLibs->selectedSpace            = '选择空间';
$lang->ai->knowledgeLibs->space                    = '所属空间';
$lang->ai->knowledgeLibs->selectedDocLibrary       = '选择文档库';
$lang->ai->knowledgeLibs->selectedAssetType        = '选择分组';
$lang->ai->knowledgeLibs->selectedAssetLib         = '选择资产库';
$lang->ai->knowledgeLibs->selectKnowledgeLib       = '选择知识库';
$lang->ai->knowledgeLibs->knowledgeLibSpace        = '知识库空间';
$lang->ai->knowledgeLibs->pleaseSelectKnowledgeLib = '请选择知识库';

$lang->ai->knowledgeLibs->addDoc             = '添加文档';
$lang->ai->knowledgeLibs->knowledgeTypeName  = '知识类型';
$lang->ai->knowledgeLibs->customText         = '自定义文本';
$lang->ai->knowledgeLibs->localFile          = '本地文件';
$lang->ai->knowledgeLibs->file               = '文件';
$lang->ai->knowledgeLibs->creator            = $lang->openedByAB;
$lang->ai->knowledgeLibs->status             = $lang->statusAB;
$lang->ai->knowledgeLibs->category           = '分类';
$lang->ai->knowledgeLibs->createdDate        = '创建日期';
$lang->ai->knowledgeLibs->addKnowledgeTip    = '为你的知识库添加知识吧';
$lang->ai->knowledgeLibs->noPrivAddKnowledge = '暂无添加知识权限，请联系管理员开通';

$lang->ai->knowledgeLibs->spaces['mine']    = '我的空间';
$lang->ai->knowledgeLibs->spaces['custom']  = '团队空间';
$lang->ai->knowledgeLibs->spaces['product'] = '产品空间';
$lang->ai->knowledgeLibs->spaces['project'] = '项目空间';
$lang->ai->knowledgeLibs->spaces['api']     = '接口空间';

$lang->ai->knowledgeLibs->assets['story']       = '需求库';
$lang->ai->knowledgeLibs->assets['case']        = '用例库';
$lang->ai->knowledgeLibs->assets['issue']       = '问题库';
$lang->ai->knowledgeLibs->assets['risk']        = '风险库';
$lang->ai->knowledgeLibs->assets['opportunity'] = '机会库';
$lang->ai->knowledgeLibs->assets['practice']    = '最佳实践库';
$lang->ai->knowledgeLibs->assets['component']   = '组件库';

$lang->ai->knowledgeLibs->objectLabels['feedback']    = '反馈';
$lang->ai->knowledgeLibs->objectLabels['ticket']      = '工单';
$lang->ai->knowledgeLibs->objectLabels['issue']       = '问题';
$lang->ai->knowledgeLibs->objectLabels['risk']        = '风险';
$lang->ai->knowledgeLibs->objectLabels['opportunity'] = '机会';
$lang->ai->knowledgeLibs->objectLabels['practice']    = '最佳实践';
$lang->ai->knowledgeLibs->objectLabels['component']   = '组件';

$lang->ai->knowledgeLibs->knowledgeTypes         = array();
$lang->ai->knowledgeLibs->knowledgeTypes['text'] = array('label' => $lang->ai->knowledgeLibs->customText, 'icon' => 'file-text', 'action' => 'createtextknowledge');
$lang->ai->knowledgeLibs->knowledgeTypes['file'] = array('label' => $lang->ai->knowledgeLibs->localFile,  'icon' => 'folder-o',  'action' => 'createfileknowledge');

$lang->ai->knowledgeLibs->knowledgeName      = '知识名称';
$lang->ai->knowledgeLibs->knowledgeContent   = '知识内容';
$lang->ai->knowledgeLibs->generateTitleByAI  = '根据知识内容 AI 生成';
$lang->ai->knowledgeLibs->objectTypeList     = '%s列表';
$lang->ai->knowledgeLibs->viewContent        = '查看内容';
$lang->ai->knowledgeLibs->confirmBatchDelete = '您确认删除已选中的%s吗？';
$lang->ai->knowledgeLibs->noItemSelected     = '请至少选择一项';

$lang->ai->knowledgeLibs->knowledgeObjectTypes = array(
    'story' => array(
        'label' => $lang->ai->dataSource['story']['common'],
        'icon'  => 'lightbulb'
    ),
    'task' => array(
        'label'  => $lang->ai->dataSource['task']['common'],
        'icon'   => 'check-list',
        'priv'   => 'taskBrowse',
        'module' => 'execution',
        'method' => 'task',
        'params' => 'execution=0&status=unclosed&param=0&orderBy=&recTotal=0&recPerPage=100&pageID=1&from=ai'
    ),
    'case' => array(
        'label' => $lang->ai->dataSource['case']['common'],
        'icon'  => 'testcase'
    ),
    'bug' => array(
        'label' => $lang->ai->dataSource['bug']['common'],
        'icon'  => 'bug'
    ),
    'plan' => array(
        'label'  => $lang->ai->dataSource['productplan']['common'],
        'icon'   => 'calendar',
        'key'    => 'productPlan',
        'priv'   => 'productplanBrowse',
        'module' => 'productplan',
        'method' => 'browse',
        'params' => 'productID=0&branch=&browseType=undone&queryID=0&orderBy=begin_desc&recTotal=0&recPerPage=20&pageID=1&from=ai'
    ),
    'release' => array(
        'label' => $lang->ai->dataSource['release']['common'],
        'icon'  => 'publish'
    ),
    'feedback' => array(
        'label'  => $lang->ai->knowledgeLibs->objectLabels['feedback'],
        'icon'   => 'feedback',
        'priv'   => 'feedbackBrowse',
        'module' => 'feedback',
        'method' => 'admin',
        'params' => 'browseType=wait&param=0&orderBy=editedDate_desc,id_desc&recTotal=0&recPerPage=20&pageID=1&from=ai'
    ),
    'ticket' => array(
        'label'  => $lang->ai->knowledgeLibs->objectLabels['ticket'],
        'icon'   => 'ticket',
        'priv'   => 'ticketBrowse',
        'module' => 'ticket',
        'method' => 'browse',
        'params' => 'browseType=wait&param=0&orderBy=id_desc&recTotal=0&recPerPage=20&pageID=1&from=ai'
    ),
    'doc' => array(
        'label'  => $lang->ai->dataSource['doc']['common'],
        'icon'   => 'doc',
        'action' => 'adddoc'
    ),
);

$lang->ai->knowledgeLibs->knowledgeObjectImportTypes = array(
    'issue'       => array('label' => $lang->ai->knowledgeLibs->objectLabels['issue'],       'icon' => 'help'),
    'risk'        => array('label' => $lang->ai->knowledgeLibs->objectLabels['risk'],        'icon' => 'alert'),
    'opportunity' => array('label' => $lang->ai->knowledgeLibs->objectLabels['opportunity'], 'icon' => 'group'),
    'practice'    => array('label' => $lang->ai->knowledgeLibs->objectLabels['practice'],    'icon' => 'checked'),
    'component'   => array('label' => $lang->ai->knowledgeLibs->objectLabels['component'],   'icon' => 'icon-cog-outline'),
);

$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['story']['product'] = array(
    'label'  => '产品需求列表',
    'key'    => 'productStory',
    'priv'   => 'productStory',
    'module' => 'product',
    'method' => 'browse',
    'params' => 'productID=0&branch=all&browseType=&param=0&storyType=story&orderBy=&recTotal=0&recPerPage=20&pageID=1&projectID=0&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['story']['project'] = array(
    'label'  => '项目需求列表',
    'key'    => 'projectStory',
    'priv'   => 'projectStory',
    'module' => 'projectStory',
    'method' => 'story',
    'params' => 'projectID=0&productID=0&branch=&browseTyp=&param=0&storyType=story&orderBy=id_desc&recTotal=0&recPerPage=20&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['story']['execution'] = array(
    'label'  => '执行需求列表',
    'key'    => 'executionStory',
    'priv'   => 'executionStory',
    'module' => 'execution',
    'method' => 'story',
    'params' => 'executionID=0&storyType=story&orderBy=&type=all&param=0&recTotal=0&recPerPage=20&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['story']['plan'] = array(
    'label'  => '计划需求列表',
    'key'    => 'planStory',
    'priv'   => 'productplanView',
    'module' => 'productplan',
    'method' => 'story',
    'params' => 'productID=0&planID=0&blockID=0&orderBy=&recTotal=0&recPerPage=20&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['story']['business'] = array(
    'label'  => '业务需求列表',
    'key'    => 'ER',
    'priv'   => 'epicBrowse',
    'module' => 'product',
    'method' => 'browse',
    'params' => 'productID=0&branch=all&browseType=&param=0&storyType=epic&orderBy=&recTotal=0&recPerPage=20&pageID=1&projectID=0&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['story']['user'] = array(
    'label'  => '用户需求列表',
    'key'    => 'UR',
    'priv'   => 'requirementBrowse',
    'module' => 'product',
    'method' => 'browse',
    'params' => 'productID=0&branch=all&browseType=&param=0&storyType=requirement&orderBy=&recTotal=0&recPerPage=20&pageID=1&projectID=0&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['case']['product'] = array(
    'label'  => '产品用例列表',
    'key'    => 'productCase',
    'priv'   => 'productBug',
    'module' => 'testcase',
    'method' => 'browse',
    'params' => 'productID=0&branch=&browseType=all&param=0&caseType=&orderBy=id_desc&recTotal=0&recPerPage=100&pageID=1&projectID=0&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['case']['caselib'] = array(
    'label'  => '用例库用例列表',
    'key'    => 'caselibCase',
    'priv'   => 'productBug',
    'module' => 'caselib',
    'method' => 'browse',
    'params' => 'libID=0&browseType=all&param=0&orderBy=id_desc&recTotal=0&recPerPage=100&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['bug']['product'] = array(
    'label'  => '产品Bug列表',
    'key'    => 'productBug',
    'priv'   => 'productBug',
    'module' => 'bug',
    'method' => 'browse',
    'params' => 'productID=0&branch=&browseType=&param=0&orderBy=&recTotal=0&recPerPage=20&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['bug']['plan'] = array(
    'label'  => '计划Bug列表',
    'key'    => 'planBug',
    'priv'   => 'productplanView',
    'module' => 'productplan',
    'method' => 'bug',
    'params' => 'productID=0&planID=0&blockID=0&orderBy=&recTotal=0&recPerPage=20&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['release']['product'] = array(
    'label'  => '产品发布列表',
    'key'    => 'productRelease',
    'priv'   => 'releaseBrowse',
    'module' => 'release',
    'method' => 'browse',
    'params' => 'productID=0&branch=all&type=all&orderBy=&param=0&recTotal=0&recPerPage=20&pageID=1&from=ai'
);
$lang->ai->knowledgeLibs->knowledgeObjectSubTypes['release']['project'] = array(
    'label'  => '项目发布列表',
    'key'    => 'projectRelease',
    'priv'   => 'projectReleaseBrowse',
    'module' => 'projectRelease',
    'method' => 'browse',
    'params' => 'projectID=0&executionID=0&type=all&orderBy=&recTotal=0&recPerPage=20&pageID=1&from=ai'
);

$lang->ai->featureBar['myknowledgelib']['']     = $lang->all;
$lang->ai->featureBar['myknowledgelib']['1']    = $lang->ai->knowledgeLibs->published;
$lang->ai->featureBar['myknowledgelib']['0']    = $lang->ai->knowledgeLibs->draft;

$lang->ai->featureBar['teamknowledgelib'] = $lang->ai->featureBar['myknowledgelib'];

$lang->ai->featureBar['adddoc']['all']   = '全部';
$lang->ai->featureBar['adddoc']['draft'] = '草稿';

$lang->ai->knowledgeLibs->importType    = '导入类型';

$lang->ai->knowledgeLibs->categoryList = array();
$lang->ai->knowledgeLibs->categoryList['']       = '';
$lang->ai->knowledgeLibs->categoryList['custom'] = '自定义';
$lang->ai->knowledgeLibs->categoryList['doclib'] = '文档导入';

$lang->ai->knowledgeLibs->importTypeList = array();
$lang->ai->knowledgeLibs->importTypeList['']       = '';
$lang->ai->knowledgeLibs->importTypeList['custom'] = $lang->ai->knowledgeLibs->customAdd;
$lang->ai->knowledgeLibs->importTypeList['doclib'] = $lang->ai->knowledgeLibs->importActions['doc'];
if(($this->config->edition == 'max' || $this->config->edition == 'ipd') && isset($lang->ai->knowledgeLibs->assets))
{
    foreach($lang->ai->knowledgeLibs->assets as $assetType => $assetName)
    {
        $lang->ai->knowledgeLibs->importTypeList[$assetType . 'lib'] = $assetName;
    }
}

$lang->ai->knowledgeLibs->publishedList = array();
$lang->ai->knowledgeLibs->publishedList['']  = '';
$lang->ai->knowledgeLibs->publishedList['0'] = $lang->ai->knowledgeLibs->draft;
$lang->ai->knowledgeLibs->publishedList['1'] = $lang->ai->knowledgeLibs->published;

/* 知识库对象列表 - 列名 */
$lang->ai->knowledgeLibs->columnName['default']['id']              = 'ID';
$lang->ai->knowledgeLibs->columnName['default']['title']           = '标题';
$lang->ai->knowledgeLibs->columnName['doc']['title']               = '文档标题';
$lang->ai->knowledgeLibs->columnName['doc']['addedByAB']           = '创建者';
$lang->ai->knowledgeLibs->columnName['doc']['addedDate']           = '创建日期';
$lang->ai->knowledgeLibs->columnName['doc']['editedBy']            = '修改者';
$lang->ai->knowledgeLibs->columnName['doc']['editedDate']          = '修改日期';
$lang->ai->knowledgeLibs->columnName['issue']['title']             = '问题名称';
$lang->ai->knowledgeLibs->columnName['issue']['pri']               = 'P';
$lang->ai->knowledgeLibs->columnName['issue']['severity']          = '严重程度';
$lang->ai->knowledgeLibs->columnName['issue']['status']            = '状态';
$lang->ai->knowledgeLibs->columnName['issue']['issueType']         = '类型';
$lang->ai->knowledgeLibs->columnName['issue']['assetCreatedBy']    = '创建者';
$lang->ai->knowledgeLibs->columnName['issue']['assetCreatedDate']  = '创建日期';
$lang->ai->knowledgeLibs->columnName['issue']['assignedTo']        = '审批人';
$lang->ai->knowledgeLibs->columnName['issue']['approvedDate']      = '审批日期';
$lang->ai->knowledgeLibs->columnName['risk']['title']              = '风险名称';
$lang->ai->knowledgeLibs->columnName['risk']['pri']                = 'P';
$lang->ai->knowledgeLibs->columnName['risk']['status']             = '状态';
$lang->ai->knowledgeLibs->columnName['risk']['strategy']           = '策略';
$lang->ai->knowledgeLibs->columnName['risk']['assetCreatedBy']     = '创建者';
$lang->ai->knowledgeLibs->columnName['risk']['assetCreatedDate']   = '创建日期';
$lang->ai->knowledgeLibs->columnName['risk']['assignedTo']         = '审批人';
$lang->ai->knowledgeLibs->columnName['risk']['approvedDate']       = '审批日期';

$lang->ai->knowledgeLibs->columnName['opportunity']['name']             = '机会名称';
$lang->ai->knowledgeLibs->columnName['opportunity']['pri']              = 'P';
$lang->ai->knowledgeLibs->columnName['opportunity']['status']           = '状态';
$lang->ai->knowledgeLibs->columnName['opportunity']['opportunityType']  = '类型';
$lang->ai->knowledgeLibs->columnName['opportunity']['assetCreatedBy']   = '创建者';
$lang->ai->knowledgeLibs->columnName['opportunity']['assetCreatedDate'] = '创建日期';
$lang->ai->knowledgeLibs->columnName['opportunity']['assignedTo']       = '审批人';
$lang->ai->knowledgeLibs->columnName['opportunity']['approvedDate']     = '审批日期';

/* 知识库对象列表 - 枚举映射配置 */
$lang->ai->knowledgeLibs->columnValueMap['risk']['pri'] = array();
$lang->ai->knowledgeLibs->columnValueMap['risk']['pri']['high']   = '高';
$lang->ai->knowledgeLibs->columnValueMap['risk']['pri']['middle'] = '中';
$lang->ai->knowledgeLibs->columnValueMap['risk']['pri']['low']    = '低';

$lang->ai->knowledgeLibs->columnValueMap['issue']['severity'] = array();
$lang->ai->knowledgeLibs->columnValueMap['issue']['severity']['0'] = '';
$lang->ai->knowledgeLibs->columnValueMap['issue']['severity']['1'] = '严重';
$lang->ai->knowledgeLibs->columnValueMap['issue']['severity']['2'] = '较严重';
$lang->ai->knowledgeLibs->columnValueMap['issue']['severity']['3'] = '较小';
$lang->ai->knowledgeLibs->columnValueMap['issue']['severity']['4'] = '建议';

$lang->ai->knowledgeLibs->columnValueMap['issue']['status'] = array();
$lang->ai->knowledgeLibs->columnValueMap['issue']['status']['active'] = '已入库';
$lang->ai->knowledgeLibs->columnValueMap['issue']['status']['draft']  = '待审批';

$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType'] = array();
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['']             = '';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['design']       = '设计问题';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['code']         = '程序缺陷';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['performance']  = '性能问题';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['version']      = '版本控制';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['storyadd']     = '需求新增';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['storychanged'] = '需求修改';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['storyremoved'] = '需求删除';
$lang->ai->knowledgeLibs->columnValueMap['issue']['issueType']['data']         = '数据问题';

$lang->ai->knowledgeLibs->columnValueMap['risk']['status'] = array();
$lang->ai->knowledgeLibs->columnValueMap['risk']['status']['active'] = '已入库';
$lang->ai->knowledgeLibs->columnValueMap['risk']['status']['draft']  = '待审批';

$lang->ai->knowledgeLibs->columnValueMap['risk']['strategy'] = array();
$lang->ai->knowledgeLibs->columnValueMap['risk']['strategy']['']             = '';
$lang->ai->knowledgeLibs->columnValueMap['risk']['strategy']['avoidance']    = '规避';
$lang->ai->knowledgeLibs->columnValueMap['risk']['strategy']['mitigation']   = '缓解';
$lang->ai->knowledgeLibs->columnValueMap['risk']['strategy']['transference'] = '转移';
$lang->ai->knowledgeLibs->columnValueMap['risk']['strategy']['acceptance']   = '接受';

$lang->ai->knowledgeLibs->columnValueMap['opportunity']['pri'] = array();
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['pri']['high']   = '高';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['pri']['middle'] = '中';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['pri']['low']    = '低';

$lang->ai->knowledgeLibs->columnValueMap['opportunity']['status'] = array();
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['status']['active'] = '已入库';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['status']['draft']  = '待审批';

$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType'] = array();
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['']            = '';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['technical']   = '技术类';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['manage']      = '管理类';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['business']    = '业务类';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['requirement'] = '需求类';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['resource']    = '资源类';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType']['others']      = '其他';

$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy'] = array();
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy']['']        = '';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy']['monitor'] = '监控';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy']['create']  = '创造';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy']['utilize'] = '利用';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy']['enhance'] = '增强';
$lang->ai->knowledgeLibs->columnValueMap['opportunity']['strategy']['accept']  = '接受';

if(!isset($lang->ai->knowledgeLibs->tips)) $lang->ai->knowledgeLibs->tips = new stdclass();
$lang->ai->knowledgeLibs->tips->emptyFile  = '请选择要上传的文件';
$lang->ai->knowledgeLibs->tips->file       = '可点击添加上传，支持PDF、WORD、PPT、EXCEL、TXT、MD、JSON、YAML不超过 %s';
$lang->ai->knowledgeLibs->tips->searchTest = '请输入测试内容后查看测试结果。';
$lang->ai->knowledgeLibs->tips->nameRepeat = '知识库名称已有%s这条记录了。';

$lang->ai->browseMyknowledgeLib        = '浏览我的知识库列表';
$lang->ai->browseTeamknowledgeLib      = '浏览组织知识库列表';
$lang->ai->createKnowledgelibAction    = '创建知识库';
$lang->ai->importFromDocAction         = '从文档库导入知识库';
$lang->ai->importFromAssetAction       = '从资产库导入知识库';
$lang->ai->editKnowledgelibAction      = '编辑知识库';
$lang->ai->publishKnowledgelibAction   = '发布知识库';
$lang->ai->unpublishKnowledgelibAction = '下架知识库';
$lang->ai->deleteKnowledgelibAction    = '删除知识库';
$lang->ai->searchKnowledgelibAction    = '搜索测试';
$lang->ai->searchKnowledgelibCheck     = '测试';
$lang->ai->aiChatWithKnowledgeLib      = 'AI问答';
$lang->ai->createKnowledgeAction       = '添加知识';
$lang->ai->deleteKnowledgeAction       = '删除知识';
$lang->ai->editKnowledgeAction         = '编辑知识';
