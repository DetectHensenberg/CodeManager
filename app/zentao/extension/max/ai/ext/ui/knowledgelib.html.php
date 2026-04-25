<?php
namespace zin;
$this->app->loadLang('ai');

jsVar('confirmPublish', $lang->ai->knowledgeLibs->confirmPublish);
jsVar('confirmUnpublish', $lang->ai->knowledgeLibs->confirmUnpublish);
jsVar('confirmDelete', $lang->ai->knowledgeLibs->confirmDelete);
jsVar('currentMethod', $currentMethod);

$userListMap = array();
foreach($userList as $user)
{
    $userListMap[$user->account] = $user;
}

$pager         = data('pager');
$recTotal      = $pager ? $pager->recTotal : 0;
$recPerPage    = $pager ? $pager->recPerPage : 20;
$pageID        = $pager ? $pager->pageID : 1;
$queryMenuLink = createLink('ai', $currentMethod, "category={$category}&published=bysearch&orderBy={$orderBy}&param={queryID}&recTotal={$recTotal}&recPerPage={$recPerPage}&pageID={$pageID}");

featureBar(
    set::current($published),
    set::linkParams("category={$category}&published={key}&orderBy={$orderBy}&param=0"),
    set::linkMethod($currentMethod),
    set::queryMenuLinkCallback(array(function ($key) use ($queryMenuLink) {
        return str_replace('{queryID}', (string)$key, $queryMenuLink);
    })),
    li(searchToggle(set::module($currentMethod), set::open($published == 'bysearch')))
);

$type = ($currentMethod === 'myknowledgelib') ? 'my' : 'team';

/* 生成创建/导入链接 */
$createUrl = function($action) use ($currentMethod)
{
    return createLink('ai', $action, array('type' => $currentMethod === 'myknowledgelib' ? 'my' : 'team'));
};

/* 菜单配置 */
$menuConfig = array(
    array('category' => '',       'name' => $lang->all),
    array('category' => 'custom', 'name' => $lang->ai->knowledgeLibs->customAdd),
    array('category' => 'doclib', 'name' => $lang->ai->knowledgeLibs->importActions['doc']),
);

$importActions = array();
if(hasPriv('ai', 'importfromdoc'))
{
    $importActions[] = array(
        'text'        => $lang->ai->knowledgeLibs->importActions['doc'],
        'data-toggle' => 'modal',
        'data-size'   => 'sm',
        'url'         => $createUrl('importfromdoc')
    );
}
if($config->edition == 'max' || $config->edition == 'ipd')
{
    if(hasPriv('ai', 'importfromasset'))
    {
        $importActions[] = array(
            'text'        => $lang->ai->knowledgeLibs->importActions['asset'],
            'data-toggle' => 'modal',
            'data-size'   => 'sm',
            'url'         => $createUrl('importfromasset')
        );
    }

    $menuConfig[] = array('category' => '', 'name' => $lang->ai->knowledgeLibs->importFromAsset, 'type' => 'group');
    if(isset($lang->ai->knowledgeLibs->assets))
    {
        foreach($lang->ai->knowledgeLibs->assets as $assetType => $assetName) $menuConfig[] = array('category' => $assetType . 'lib', 'name' => $assetName);
    }
}

$canCreateknowledgelib = $currentMethod === 'myknowledgelib' ? hasPriv('ai', 'myknowledgelib') && hasPriv('ai', 'createknowledgelib') : hasPriv('ai', 'teamknowledgelib') && hasPriv('ai', 'createknowledgelib');
toolbar
(
    btnGroup
    (
        !$canCreateknowledgelib ? null : btn
        (
            setClass('primary'),
            set::icon('plus'),
            set::text($lang->ai->knowledgeLibs->create),
            setData(array('toggle' => 'modal', 'size' => 'sm')),
            set('href', createLink('ai', 'createknowledgelib', array('type' => $currentMethod === 'myknowledgelib' ? 'my' : 'team')))
        ),
        empty($importActions) ? null : dropdown
        (
            btn(setClass('dropdown-toggle'), setClass('primary'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::placement('bottom-end'),
            set::items($importActions)
        )
    )
);

/* 构建分类树 */
$buildCategoryTree = function($config) use ($currentMethod)
{
    $categoryTree = array();
    $index = 1;
    foreach($config as $item)
    {
        $menuItem = (object) array('id' => $index++, 'parent' => 0, 'name' => $item['name']);
        if(isset($item['type']) && $item['type'] === 'group')
        {
            $menuItem->url = '';
            $menuItem->type = 'group';
        }
        else
        {
            $menuItem->url = inlink($currentMethod, "category={$item['category']}");
        }
        $categoryTree[] = $menuItem;
    }
    return $categoryTree;
};

/* 获取激活的菜单项 */
$getActiveKey = function($config, $category)
{
    $index = 1;
    foreach($config as $item)
    {
        if(isset($item['type']) && $item['type'] === 'group')
        {
            $index++;
            continue;
        }
        if($item['category'] === $category) return $index;
        $index++;
    }
    return 1;
};

$categoryTree = $buildCategoryTree($menuConfig);
$activeKey = $getActiveKey($menuConfig, $category);

sidebar(
    moduleMenu(
        set::showDisplay(false),
        set::modules($categoryTree),
        set::activeKey($activeKey),
        set::closeLink(inlink($currentMethod))
    )
);

/* 构建下拉菜单 */
$buildDropdown = function($knowledgeLib) use ($lang)
{
    if($knowledgeLib->published == '0')
    {
        $secondItem = !hasPriv('ai', 'publishknowledgelib') ? null : array('text' => $lang->ai->prompts->action->publish, 'data-action' => 'publish', 'data-id' => $knowledgeLib->id, 'onClick' => jsRaw('window.knowledgeLibAction'));
    }
    else
    {
        $secondItem = !hasPriv('ai', 'unpublishknowledgelib') ? null : array('text' => $lang->ai->prompts->action->unpublish, 'data-action' => 'unpublish', 'data-id' => $knowledgeLib->id, 'onClick' => jsRaw('window.knowledgeLibAction'));
    }

    if(empty($secondItem) && !hasPriv('ai', 'editknowledgelib') && !hasPriv('ai', 'deleteknowledgelib')) return null;

    return dropdown(
        btn(
            setClass('ghost size-sm card-action-btn'),
            set::icon('ellipsis-v')
        ),
        set::items(array(
            !hasPriv('ai', 'editknowledgelib') ? null : array('text' => $lang->edit,'data-action' => 'edit','data-id' => $knowledgeLib->id,'onClick' => jsRaw('window.knowledgeLibAction')),
            $secondItem,
            !hasPriv('ai', 'deleteknowledgelib') ? null : array('text' => $lang->delete,'data-action' => 'delete','data-id' => $knowledgeLib->id,'onClick' => jsRaw('window.knowledgeLibAction'))
        )),
        set::placement('bottom-end'),
        set::caret(false)
    );
};

/* 构建卡片 */
$knowledgeCard = function($knowledgeLib) use ($lang, $buildDropdown, $currentMethod, $userListMap)
{
    $creator = isset($userListMap[$knowledgeLib->createdBy]) ? $userListMap[$knowledgeLib->createdBy] : null;
    $creatorName = $creator ? $creator->realname : $knowledgeLib->createdBy;

    $draftTag = $knowledgeLib->published == '0'
        ? span(
            setClass('draft-tag'),
            $lang->ai->knowledgeLibs->draft
        )
        : null;
    return div(
        setClass('knowledge-card'),
        a(
            set::href(inlink('knowledgelibview', "id={$knowledgeLib->id}")),
            h3(
                setClass('card-title'),
                set::title($knowledgeLib->name),
                icon('doclib'),
                span($knowledgeLib->name),
                $draftTag
            ),
            div(
                setClass('card-description'),
                set::title($knowledgeLib->desc),
                $knowledgeLib->desc
            ),
            div(
                setClass('card-meta'),
                div(
                    setClass('creator'),
                    avatar(
                        set::size('sm'),
                        set::text($creatorName),
                        $creator && !empty($creator->avatar) ? set::src($creator->avatar) : null
                    ),
                    span($creatorName)
                ),
                span(
                    setClass('created-date'),
                    sprintf($lang->ai->knowledgeLibs->createdTime, substr($knowledgeLib->createdDate, 0, 10))
                )
            )
        ),
        $buildDropdown($knowledgeLib)
    );
};

/* 构建空视图 */
$buildEmptyView = function($category) use ($lang, $createUrl, $canCreateknowledgelib)
{
    $isAsset = !empty($category) && $category != 'doclib' && $category != 'custom';
    $btnText = '';
    $btnLink = '';
    if((empty($category) || $category == 'custom') && $canCreateknowledgelib)
    {
        $btnText = $lang->ai->knowledgeLibs->create;
        $btnLink = $createUrl('createknowledgelib');
    }
    elseif($category == 'doclib' && hasPriv('ai', 'importfromdoc'))
    {
        $btnText = $lang->ai->knowledgeLibs->importActions['doc'];
        $btnLink = $createUrl('importfromdoc');
    }
    elseif($isAsset && hasPriv('ai', 'importfromasset'))
    {
        $btnText = $lang->ai->knowledgeLibs->importActions['asset'];
        $btnLink = $createUrl('importfromasset');
    }

    return div(
        setClass('empty-view'),
        span($lang->ai->knowledgeLibs->noData),
        btn
        (
            setClass('text-primary ghost'),
            setData('toggle', 'modal'),
            setData('size', 'sm'),
            set::url($btnLink),
            $btnText
        )
    );
};

if(empty($knowledgeLibs))
{
    $buildEmptyView($category);
}
else
{
    div(
        setClass('page-knowledge'),
        div(
            setClass('knowledge-container'),
            array_map($knowledgeCard, $knowledgeLibs)
        ),
        div(
            setClass('pager-container'),
            pager(set(usePager()))
        )
    );
}
