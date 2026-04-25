<?php
namespace zin;

$this->app->loadLang('ai');

/* 当前类型的名称 */
$typeLabel = '';
if(isset($lang->ai->knowledgeLibs->knowledgeObjectTypes[$objectType]['label']))
{
    $typeLabel = $lang->ai->knowledgeLibs->knowledgeObjectTypes[$objectType]['label'];
}
elseif(isset($lang->ai->knowledgeLibs->knowledgeObjectImportTypes[$objectType]['label']))
{
    $typeLabel = $lang->ai->knowledgeLibs->knowledgeObjectImportTypes[$objectType]['label'];
}

jsVar('confirmDeleteFile', $lang->ai->knowledgeLibs->confirmDeleteFile);
jsVar('confirmBatchDelete', sprintf($lang->ai->knowledgeLibs->confirmBatchDelete, $typeLabel));
jsVar('noItemSelected', $lang->ai->knowledgeLibs->noItemSelected);
jsVar('confirmPublish', $lang->ai->knowledgeLibs->confirmPublish);
jsVar('confirmUnpublish', $lang->ai->knowledgeLibs->confirmUnpublish);
jsVar('syncFailedText', $lang->ai->knowledgeLibs->syncFailed);
jsVar('syncFailedHint', $lang->ai->knowledgeLibs->syncFailedHint);
jsVar('knowledgeLibId', $knowledgeLib->id);
jsVar('knowledgeItemId', $contentID);
jsVar('knowledgeFrom', $from);
jsVar('knowledgeLib', $knowledgeLib);

/* 构建自定义添加菜单配置 */
$buildCustomMenuConfig = function() use ($lang, $textFileItems)
{
    $menuConfig = array();

    /* 自定义文本 */
    $textChildren = array();
    if(!empty($textFileItems['text']))
    {
        foreach($textFileItems['text'] as $item) $textChildren[] = array('id' => $item->id, 'text' => $item->title);
    }
    if(!empty($textChildren))
    {
        $menuConfig[] = array('text' => $lang->ai->knowledgeLibs->customText, 'icon' => 'file-text', 'type' => 'text', 'children' => $textChildren);
    }

    /* 本地文件 */
    $fileChildren = array();
    if(!empty($textFileItems['file']))
    {
        foreach($textFileItems['file'] as $item) $fileChildren[] = array('id' => $item->id, 'text' => $item->title);
    }
    if(!empty($fileChildren))
    {
        $menuConfig[] = array('text' => $lang->ai->knowledgeLibs->localFile, 'icon' => 'folder-o', 'type' => 'file', 'children' => $fileChildren);
    }

    return $menuConfig;
};

/* 构建禅道对象数据菜单配置 */
$buildZentaoDataMenuConfig = function() use ($lang)
{
    $menuConfig = array();

    /* 禅道对象 */
    foreach($lang->ai->knowledgeLibs->knowledgeObjectTypes as $itemType => $item)
    {
        $menuConfig[] = array('text' => $item['label'], 'icon' => $item['icon'], 'type' => $itemType, 'className' => 'kb-item-' . $itemType);
    }

    /* 资产库导入 */
    foreach($lang->ai->knowledgeLibs->knowledgeObjectImportTypes as $importItemType => $item)
    {
        $menuConfig[] = array('text' => $item['label'], 'icon' => $item['icon'], 'type' => $importItemType, 'className' => 'kb-item-' . $importItemType);
    }

    return $menuConfig;
};

/* 构建菜单项 */
$buildMenuItems = function($config) use ($knowledgeLib, $type, $objectType, $contentID, $stats)
{
    $items = array();

    foreach($config as $item)
    {
        $menuItem = array('id' => $item['type'], 'text' => $item['text'], 'icon' => $item['icon']);

        if(isset($item['children']))
        {
            $menuItem['className'] = 'kb-' . $item['type'];
            $menuItem['children']  = array();

            foreach($item['children'] as $child)
            {
                $isActive = ($type === $item['type'] && $contentID == $child['id']);

                $menuItem['children'][] = array(
                    'id'     => $child['id'],
                    'text'   => $child['text'],
                    'active' => $isActive,
                    'url'    => inlink('knowledgelibview', "id={$knowledgeLib->id}&type={$item['type']}&contentID={$child['id']}")
                );
            }

            $items[] = $menuItem;
        }
        else
        {
            if(!in_array($item['type'], $stats->objectTypes)) continue;

            $isActive = ($objectType === $item['type']);

            $menuItem['className'] = 'kb-item-' . $item['type'];
            $menuItem['active']    = $isActive;
            $menuItem['url']       = inlink('knowledgelibview', "id={$knowledgeLib->id}&type=object_{$item['type']}");

            $items[] = $menuItem;
        }
    }

    return $items;
};

$selectedId = $type === 'object' ? $objectType : $contentID;

$canAIChat          = hasPriv('ai', 'aichatwithknowledgelib');
$canSearch          = hasPriv('ai', 'searchknowledgelib');
$switchPublish      = $knowledgeLib->published == '1' ? hasPriv('ai', 'unpublishknowledgelib') : hasPriv('ai', 'publishknowledgelib');
$canCreateKnowledge = hasPriv('ai', 'createknowledge');
$canDeleteKnowledge = hasPriv('ai', 'deleteknowledgeitem');
$canEditKnowledge   = hasPriv('ai', 'editknowledge');
$showActions        = $canAIChat || $canSearch || $switchPublish;

$headerActions = array();
if(!$isEmpty && $showActions)
{
    $headerActions = array(
        $knowledgeLib->published == '1' && $canAIChat ? btn(
            set::icon('ai'),
            set::text($lang->ai->knowledgeLibs->aiChat),
            set::type('ghost'),
            set::size('small'),
            on::click()->call('openAIChatWithKnowledgeLib')
        ) : null,
        $canSearch ? btn(
            set::icon('search'),
            set::text($lang->ai->knowledgeLibs->searchTest),
            set::type('ghost'),
            set::size('small'),
            set::url(createLink('ai', 'searchknowledgelib', "knowledgeLibID={$knowledgeLib->id}&type=$type&contentID=$contentID"))
        ) : null,
        $switchPublish ? btn(
            set::icon($knowledgeLib->published == '1' ? 'cancel' : 'publish'),
            set::text($knowledgeLib->published == '1' ? $lang->ai->prompts->action->unpublish : $lang->ai->prompts->action->publish),
            set::type('ghost'),
            set::size('small'),
            on::click()->call($knowledgeLib->published == '1' ? 'unpublishKnowledgeLib' : 'publishKnowledgeLib')
        ) : null
    );
}

/* Permission Config. */
$privs = array();
$privs['taskBrowse']           = hasPriv('execution', 'task');
$privs['productStory']         = hasPriv('product', 'browse');
$privs['projectStory']         = hasPriv('projectstory', 'story');
$privs['executionStory']       = hasPriv('execution', 'story');
$privs['productplanView']      = hasPriv('productplan', 'view');
$privs['requirementBrowse']    = hasPriv('product', 'requirement');
$privs['epicBrowse']           = hasPriv('product', 'epic');
$privs['productBug']           = hasPriv('bug', 'browse');
$privs['releaseBrowse']        = hasPriv('release', 'browse');
$privs['projectReleaseBrowse'] = hasPriv('projectRelease', 'browse');
$privs['productplanBrowse']    = hasPriv('productplan', 'browse');
$privs['feedbackBrowse']       = hasPriv('feedback', 'admin');
$privs['ticketBrowse']         = hasPriv('ticket', 'browse');

/* 构建创建菜单项 */
$buildCreateItems = function($menuConfig) use ($knowledgeLib, $lang, $privs, $from, $config)
{
    $createItems = array();

    foreach($lang->ai->knowledgeLibs->knowledgeTypes as $knowledgeType => $menuConfig)
    {
        $menuItem = array('icon' => $menuConfig['icon'], 'text' => $menuConfig['label'], 'className' => 'kb-item-' . $knowledgeType);

        if(!empty($menuConfig['action']))
        {
            $menuItem['data-toggle'] = 'modal';
            $menuItem['data-size']   = $menuConfig['action'] == 'adddoc' ? 'lg' : 'md';
            $menuItem['url']         = createLink('ai', $menuConfig['action'], "lib={$knowledgeLib->id}&from={$from}");
        }

        $createItems[] = $menuItem;
    }

    foreach($lang->ai->knowledgeLibs->knowledgeObjectTypes as $itemObjectType => $itemConfig)
    {
        $priv = isset($itemConfig['priv']) ? $itemConfig['priv'] : null;
        if($priv && isset($privs[$priv]) && !$privs[$priv]) continue;

        $menuItem = array('icon' => $itemConfig['icon'], 'text' => $itemConfig['label'], 'className' => 'kb-item-' . $itemObjectType);
        if(!empty($itemConfig['module']))
        {
            $menuItem['url']         = createLink($itemConfig['module'], $itemConfig['method'], $itemConfig['params']);
            $menuItem['data-toggle'] = 'modal';
            $menuItem['data-size']   = 'lg';
        }

        if(isset($lang->ai->knowledgeLibs->knowledgeObjectSubTypes[$itemObjectType]))
        {
            $subItems = array();
            foreach($lang->ai->knowledgeLibs->knowledgeObjectSubTypes[$itemObjectType] as $subType => $subLabel)
            {
                $priv = isset($subLabel['priv']) ? $subLabel['priv'] : null;
                if($priv && isset($privs[$priv]) && !$privs[$priv]) continue;
                if($subLabel['key'] == 'ER' && !$config->enableER)  continue;
                if($subLabel['key'] == 'UR' && !$config->URAndSR)   continue;

                $subItem = array('text' => is_array($subLabel) ? $subLabel['label'] : $subLabel);

                if(!empty($itemConfig['action']))
                {
                    $subItem['innerClass'] = 'ajax-get';
                    $subItem['url']        = createLink('ai', $itemConfig['action'], "lib={$knowledgeLib->id}&objectType={$itemObjectType}&subType={$subType}&from={$from}");
                }

                if(is_array($subLabel) && !empty($subLabel['module']))
                {
                    $subItem['url']         = createLink($subLabel['module'], $subLabel['method'], $subLabel['params']);
                    $subItem['data-toggle'] = 'modal';
                    $subItem['data-size']   = 'lg';
                }

                $subItems[] = $subItem;
            }
            $menuItem['items'] = $subItems;
        }
        else if(!empty($itemConfig['action']))
        {
            $menuItem['data-toggle'] = 'modal';
            $menuItem['data-size']   = $itemConfig['action'] == 'adddoc' ? 'lg' : 'md';
            $menuItem['url']         = createLink('ai', $itemConfig['action'], "lib={$knowledgeLib->id}&from={$from}");
        }

        $createItems[] = $menuItem;
    }

    return $createItems;
};

/* 构建选择提示 */
$buildVoidView = function($message)
{
    return div(
        setClass('void-view'),
        $message
    );
};

/* 构建文本/文件视图 */
$buildTextView = function($knowledge) use ($lang)
{
    return div
    (
        setClass('section-content'),
        div
        (
            setClass('show-content'),
            zui::AIKnowledgeChunkList
            (
                set::id($knowledge->id),
                set::needSyncKnowledgeItemText($lang->ai->knowledgeLibs->needSyncKnowledgeItem),
                set::syncingKnowledgeItemText($lang->ai->knowledgeLibs->syncingKnowledgeItem),
                set::emptyKnowledgeDataText($lang->ai->knowledgeLibs->emptyKnowledgeData)
            )
        ),
        div
        (
            setClass('origin-content hidden'),
            setStyle(array('max-height' => 'calc(100vh - 280px)')),
            editor
            (
                set::maxHeight('calc(100vh - 280px)'),
                set::resizable(false),
                set::name('content'),
                set::markdown($knowledge->contentType == 'markdown'),
                set::uploadUrl('disabled'),
                html($knowledge->content)
            ),
            div
            (
                setClass('bg-canvas text-center mt-2 actions'),
                setData(array('knowledgeID' => $knowledge->id, 'knowledgeTitle' => $knowledge->title)),
                btn(
                    set::type('primary'),
                    set::text($lang->save),
                    on::click()->call('saveTextKnowledge')
                )
            )
        )
    );
};

/* 构建对象视图 */
$buildObjectView = function($objectType, $objectList, $objectCols) use ($lang, $knowledgeLib, $pager, $users)
{
    $objectList = initTableData($objectList, $objectCols, null);

    $footToolbar = hasPriv('ai', 'deleteknowledgeitem') ? array(
        'items' => array(
            array(
                'text'      => $lang->delete,
                'data-on'   => 'click',
                'data-call' => "handleBatchDeleteBtnClick('.dtable')"
            )
        ),
        'btnProps' => array('size' => 'sm', 'btnType' => 'secondary')
    ) : null;

    $dtablePager = $pager ? usePager(array(
        'recPerPage'  => $pager->recPerPage,
        'recTotal'    => $pager->recTotal,
        'linkCreator' => createLink('ai', 'knowledgelibview', "id={$knowledgeLib->id}&type=object_{$objectType}&contentID=0&recTotal={recTotal}&recPerPage={recPerPage}&pageID={page}")
    )) : false;
    $dtableProps = [
        'id'           => 'knowledgeObjectList',
        'cols'         => $objectCols,
        'data'         => $objectList,
        'userMap'      => $users,
        'footPager'    => $dtablePager,
        'footToolbar'  => $footToolbar,
        'emptyTip'     => $lang->noData,
        'checkable'    => hasPriv('ai', 'deleteknowledgeitem'),
        'extraHeight'  => '+,#mainContent>.detail-header,.page-kbview>.main-content>.section-header,36',
        'onRenderCell' => jsRaw('window.renderObjectTableCell')
    ];

    return dtable(set($dtableProps));
};

$customMenuConfig = $buildCustomMenuConfig();

/* 构建主视图 */
$buildMainView = function() use ($selectedId, $lang, $type, $objectType, $knowledgeData, $objectList, $objectCols, $knowledgeLib, $canEditKnowledge, $canDeleteKnowledge, $buildVoidView, $buildTextView, $buildObjectView, $buildZentaoDataMenuConfig, $customMenuConfig, $buildMenuItems)
{
    $mainContent = null;
    $knowledge = $knowledgeData;

    $zentaoMenuConfig = $buildZentaoDataMenuConfig();
    $customMenuItems = $buildMenuItems($customMenuConfig);
    $zentaoMenuItems = $buildMenuItems($zentaoMenuConfig);

    if(empty($type) || empty($knowledge))
    {
        $mainContent = $buildVoidView($lang->ai->knowledgeLibs->selectContent);
    }
    else
    {
        switch($type) {
            case 'text':
            case 'file':
                $mainContent = $buildTextView($knowledge);
                break;
            case 'object':
                $mainContent = $buildObjectView($objectType, $objectList, $objectCols);
                break;
            default:
                $mainContent = $buildVoidView($lang->ai->knowledgeLibs->selectContent);
        }
    }

    return div(
        setClass('page-kbview'),
        sidebar(
            setClass('sidebar-left'),
            set::width(220),
            set::minWidth(220),
            panel(
                tabs(
                    tabPane(
                        set::key('custom'),
                        set::title($lang->ai->knowledgeLibs->customAdd),
                        set::active($type !== 'object'),
                        treeEditor(
                            set::id('knowledgeTree'),
                            set::items($customMenuItems),
                            set::selected($selectedId),
                            set::defaultNestedShow(true),
                            set::canSplit(false),
                            set::collapsedIcon('folder text-warning'),
                            set::expandedIcon('folder-open text-warning'),
                            set::normalIcon(''),
                            set::preserve(false)
                        )
                    ),
                    tabPane(
                        set::key('zentao'),
                        set::title($lang->ai->knowledgeLibs->zentaoData),
                        set::active($type === 'object'),
                        treeEditor(
                            set::id('knowledgeTree'),
                            set::items($zentaoMenuItems),
                            set::selected($selectedId),
                            set::defaultNestedShow(true),
                            set::canSplit(false),
                            set::collapsedIcon('folder text-warning'),
                            set::expandedIcon('folder-open text-warning'),
                            set::normalIcon(''),
                            set::preserve(false)
                        )
                    )
                )
            )
        ),
        div(
            setClass('main-content min-w-0'),
            $knowledge ? div(
                setClass('section-header'),
                h2(span(
                    set::title($knowledge->title),
                    $knowledge->title
                ), $type != 'object' ? input(
                    set::type('text'),
                    setClass('size-sm'),
                    set::value($knowledge->title),
                    set::maxlength(255),
                    on::blur()->call('updateName')
                ) : null, $type != 'object' && $canEditKnowledge ? btn(
                    setClass('edit-btn'),
                    set::type('ghost'),
                    set::icon('edit'),
                    on::click()->call('toggleEditMode')
                ) : null),
                $type == 'object' ? div(
                    setClass('actions'),
                    $canEditKnowledge ? btn(
                        setID('syncObjectListBtn'),
                        set::type('ghost'),
                        set::icon('refresh'),
                        set::text($lang->ai->knowledgeLibs->updateListData),
                        set::hint($lang->ai->knowledgeLibs->updateFromSourceData),
                        on::click()->call('requestSyncObjectListToZAI', $knowledgeLib->id, $objectType, false, true)
                    ): null
                ) : div(
                    setClass('actions'),
                    $canEditKnowledge && $type == 'text' ? div(
                        setClass('show-source'),
                        span($lang->ai->knowledgeLibs->viewSourceData),
                        switcher(on::change()->call('toggleShowSource', jsRaw('event')))
                    ) : null,
                    $type == 'text' ? divider() : null,
                    $canDeleteKnowledge ? btn(setClass('ajax-submit'), set::type('ghost'), set::icon('trash'), set::hint($lang->delete), set::url(createLink('ai', 'deleteknowledgeitem', "id=$selectedId&knowledgeLibID=$knowledgeLib->id")), setData('confirm', $lang->ai->knowledgeLibs->confirmDeleteFile)) : null
                )
            ) : null,
            $mainContent
        )
    );
};

$createMenuItems = $buildCreateItems($customMenuConfig);

/* 构建空视图 */
$buildEmptyView = function() use ($lang, $canCreateKnowledge, $createMenuItems)
{
    $title     = $lang->ai->knowledgeLibs->noPrivAddKnowledge;
    $actions   = array();
    $menuItems = array();

    if($canCreateKnowledge)
    {
        $title     = $lang->ai->knowledgeLibs->addKnowledgeTip;
        $menuItems = $createMenuItems;
    }

    foreach($menuItems as $menuItem)
    {
        if(isset($menuItem['items']) && !empty($menuItem['items']))
        {
            $actions[] = dropdown(
                btn(
                    setClass($menuItem['className']),
                    set::icon($menuItem['icon']),
                    set::text($menuItem['text'])
                ),
                set::items($menuItem['items']),
                set::placement('bottom-center')
            );
        }
        else
        {
            $btnProps = array(setClass($menuItem['className']), set::icon($menuItem['icon']), set::text($menuItem['text']));

            if(!empty($menuItem['url']))
            {
                $btnProps[] = set('href', $menuItem['url']);
                $btnProps[] = setData(array('toggle' => $menuItem['data-toggle'], 'size' => $menuItem['data-size']));
            }

            $actions[] = btn(...$btnProps);
        }
    }

    return div
    (
        setClass('empty-view'),
        h2($title),
        div(setClass('add-actions'), $actions)
    );
};

detailHeader(
    to::prefix(
        backBtn(
            set::icon('back'),
            set::type('secondary'),
            set::url(inlink($from)),
            $lang->goback
        ),
        entityLabel(
            set(array(
                'entityID' => $knowledgeLib->id,
                'level'    => 1,
                'text'     => $knowledgeLib->name,
                'title'    => $knowledgeLib->name
            ))
        )
    ),
    to::suffix(
        div(
            setClass('flex items-center gap-x-1'),
            $headerActions,
            $canCreateKnowledge ? dropdown(
                btn(set::icon('plus'), set::text($lang->ai->knowledgeLibs->addKnowledge), set::type('primary')),
                set::placement('bottom-end'),
                set::items($createMenuItems)
            ) : null
        )
    )
);

if($isEmpty)
{
    $buildEmptyView();
}
else
{
    $buildMainView();
}
