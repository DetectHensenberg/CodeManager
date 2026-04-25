<?php
/**
 * The ajaxSelectTemplate view file of weekly module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     weekly
 * @link        https://www.zentao.net
 */
namespace zin;
jsVar('projectID', $projectID);
jsVar('module', $module);

modalHeader(set::title($lang->weekly->selectTemplate), set::titleClass('panel-title text-lg'));

featureBar
(
    set::current('all'),
    set::isModal(true),
    set::linkParams("project={$projectID}"),
    div
    (
        set::className('ml-2'),
        zui::searchBox
        (
            set::circle(true),
            set::delay(1000),
            set::defaultValue($searchName),
            set::onChange(jsRaw('window.handleSearchBoxChange'))
        )
    )
);

$buildScopeCards = function($templates) use ($lang)
{
    $cardItems = array();
    foreach($templates as $template)
    {
        $cardDesc = $template->templateDesc ? $template->templateDesc : $lang->reporttemplate->noDesc;
        $viewLink = createLink('reporttemplate', 'view', "templateID=$template->id");

        $cardItems[] = div
        (
            on::click()->do("clickCard(event)"),
            setClass('doc-space-card-lib p-2 w-1/4 group'),
            div
            (
                setClass('templateCard canvas border rounded py-2 px-3 col gap-1 hover:shadow-lg hover:border-primary relative cursor-pointer'),
                setData('templateID', $template->id),
                div
                (
                    setClass('flex gap-2 items-center py-2'),
                    icon
                    (
                        setClass('icon-file-archive text-2xl')
                    ),
                    div
                    (
                        setClass('font-bold text-clip'),
                        common::hasPriv('reporttemplate', 'view') ? a(set::href($viewLink), $template->title, set::title($template->title), set(array('data-toggle' => 'modal', 'data-size' => 'lg'))) : span($template->title, set::title($template->title))
                    )
                ),
                div
                (
                    setClass('text-gray text-clip text-sm py-1'),
                    set::title($cardDesc),
                    $cardDesc
                )
            )
        );
    }

    return $cardItems;
};

div
(
    setClass('templateCardPanel ring rounded'),
    div
    (
        setClass('py-2 px-1.5'),
        empty($templateList) ? div
        (
            setClass('flex justify-center emptyBox'),
            div
            (
                setClass('text-gray-500'),
                $lang->reporttemplate->noTemplate
            )
        ) : div
        (
            setClass('flex flex-wrap'),
            $buildScopeCards($templateList)
        )
    )
);

div
(
    setClass('center nextButton fixed bottom-0 left-0 right-0 bg-white py-2 shadow-lg z-10'),
    button
    (
        setClass('btn primary disabled'),
        span($lang->weekly->next),
        set::onclick('clickNextButton()')
    )
);
