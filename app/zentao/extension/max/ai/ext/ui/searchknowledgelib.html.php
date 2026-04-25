<?php
namespace zin;

detailHeader
(
    to::prefix
    (
        backBtn
        (
            set::icon('back'),
            set::type('secondary'),
            set::url(createLink('ai', 'knowledgelibview', "id={$knowledgeLib->id}&type=$type&contentID=$contentID")),
            $lang->goback
        ),
        entityLabel
        (
            set(array(
                'entityID' => $knowledgeLib->id,
                'level'    => 1,
                'text'     => $knowledgeLib->name
            ))
        )
    ),
    to::suffix
    (
        btn
        (
            setClass('btn ghost'),
            set::icon('exit'),
            set::url(createLink('ai', 'knowledgelibview', "id={$knowledgeLib->id}&type=$type&contentID=$contentID")),
            $lang->ai->knowledgeLibs->exitSearchTest
        )
    )
);

function getLabelClassName($similarity)
{
    switch($similarity)
    {
        case $similarity > 0.8:
            return 'high';
        case $similarity > 0.5 && $similarity <= 0.8:
            return 'medium';
        default:
            return 'low';
    }
}

$fnBuildResult = function() use ($lang, $result, $isEmpty)
{
    $emptyText = $isEmpty ? $this->lang->noData : $lang->ai->knowledgeLibs->tips->searchTest;
    if(empty($result) || $isEmpty) return p(setClass('h-full flex justify-center items-center text-gray'), $emptyText);

    $resultList = array();
    foreach($result as $index => $item)
    {
        $item['similarity'] = round($item['similarity'], 4);
        $labelClassName = getLabelClassName($item['similarity']);
        $markdownContainerId = 'markdownContent_' . $index;
        $resultList[] = div
        (
            setClass('py-5 pl-4 rounded-sm relative overflow-hidden'),
            setStyle(array('background-color' => '#F8FAFD', 'padding-right' => '80px', 'min-height' => '100px')),
            div
            (
                setClass("triangle-label absolute top-0 right-0 $labelClassName"),
                span
                (
                    setClass('font-medium absolute top-2.5 z-10'),
                    setStyle(array('right' => '-60px', 'font-size' => '10px')),
                    $item['similarity'] * 100 . '%'
                )
            ),
            div
            (
                setID($markdownContainerId),
                setData(array('content' => $item['chunk_content']))
            )
        );
    }
    return div(setClass('flex col gap-5'), $resultList);
};

formPanel(setClass('bg-canvas search-form'), setStyle(array('height' => 'calc(100vh - 160px)', 'max-width' => 'unset')), set::bodyClass('h-full'), set::formClass('h-full'), set::actions(array()), setData(array('knowledgeLibID' => $knowledgeLib->id, 'contentID' => $contentID, 'inputTip' => $lang->ai->knowledgeLibs->tips->searchTest, 'type' => $type)), formRow
(
    setClass('flex justify-center gap-6', empty($result) ? 'pt-6' : 'pt-0'),
    setStyle(array('align-items' => 'center')),
    div($lang->ai->knowledgeLibs->testText),
    formGroup(setClass('w-1/3'), set::name('content'), set::value($content), set::placeholder($lang->ai->knowledgeLibs->inputContent)),
    btn
    (
        setClass('btn primary'),
        on::click()->call('searchKnowledgeLib'),
        $lang->ai->searchKnowledgelibCheck
    )
), div(setClass('h-full scrollbar-thin scrollbar-hover overflow-auto'), $fnBuildResult()));
