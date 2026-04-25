<?php
/**
 * The index view file of reporttemplate module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Mengyi Liu
 * @package     reporttemplate
 * @link        https://www.zentao.net
 */
namespace zin;

$scopeItems = array();
foreach($scopeList as $scope)
{
    $cardItems = array();
    if(!empty($templates[$scope->id]))
    {
        foreach($templates[$scope->id] as $template)
        {
            $cardDesc   = $template->templateDesc ? $template->templateDesc : $lang->reporttemplate->noDesc;
            $cardDate   = formatTime($template->hotDate, 'Y-m-d');
            $viewLink   = createLink('reporttemplate', 'view', "reporttemplateID=$template->id");
            $editLink   = createLink('reporttemplate', 'edit', "reporttemplateID=$template->id");
            $deleteLink = createLink('reporttemplate', 'delete', "templateID=$template->id");

            $actions = array();
            if(hasPriv('reporttemplate', 'edit')) $actions[] = array('icon' => 'edit', 'text' => $this->lang->reporttemplate->edit, 'url' => $editLink);
            if(hasPriv('reporttemplate', 'delete')) $actions[] = array('icon' => 'trash', 'text' => $this->lang->reporttemplate->deleteAbbr, 'url' => $deleteLink, 'data-confirm' => $this->lang->reporttemplate->confirmDelete, 'innerClass' => 'ajax-submit');

            $cardItems[] = div
            (
                hasPriv('reporttemplate', 'view') ? on::click()->do("clickTemplateCard(event, '$viewLink')") : null,
                setClass('reporttemplate-space-card-lib px-2 w-1/4 group'),
                div
                (
                    setClass('canvas border rounded py-2 px-3 col gap-1 hover:shadow-lg hover:border-primary relative cursor-pointer'),
                    div
                    (
                        setClass('flex gap-2 items-center pt-2 pb-1 mr-4'),
                        icon
                        (
                            setClass('icon-file-archive text-2xl')
                        ),
                        div
                        (
                            setClass('font-bold text-clip flex-auto'),
                            set::title($template->title),
                            $template->title
                        ),
                        $template->status == 'draft' ? label
                        (
                            setClass('special-pale flex-none'),
                            $lang->reporttemplate->statusList['draft']
                        ) : null
                    ),
                    div
                    (
                        setClass('py-1'),
                        $lang->reporttemplate->hotDate . ': ' . $cardDate
                    ),
                    div
                    (
                        setClass('text-gray text-clip text-sm py-1'),
                        set::title($cardDesc),
                        $cardDesc
                    ),
                    div
                    (
                        setClass('toolbar absolute top-1 right-1 opacity-0 group-hover:opacity-100'),
                        !empty($actions) ? dropdown
                        (
                            btn(setClass('size-sm dropdown'), set::type('ghost'), set::icon('ellipsis-v'), set::caret(false)),
                            set::items($actions),
                            set::flip(true),
                            set::placement('bottom-center'),
                            set::strategy('absolute'),
                            set::hasIcons(false)
                        ) : null
                    )
                )
            );
        }
    }

    $scopeItems[] = div
    (
        setClass('reporttemplate-space-card ring rounded surface-light'),
        div
        (
            setClass('row items-center justify-between gap-2 px-2.5 py-1 border-b'),
            div
            (
                setClass('row items-center ml-2 flex-none'),
                div
                (
                    setClass('min-w-0 flex-auto'),
                    strong($scope->name),
                    span(setClass('label ml-2 flex-none bg-white size-sm text-sm'), $lang->reporttemplate->scope)
                )
            ),
            toolbar
            (
                hasPriv('reporttemplate', 'browse') ? item(set(array
                (
                    'type'  => 'ghost',
                    'caret' => 'right',
                    'class' => 'text-primary',
                    'text'  => $lang->more,
                    'url'   => createLink('reporttemplate', 'browse', "libID={$scope->id}")
                ))) : null
            )
        ),
        div
        (
            setClass('reporttemplate-space-card-libs py-3 px-1.5'),
            !empty($cardItems) ? div
            (
                setClass('row'),
                $cardItems
            ) : div
            (
                setClass('center gap-4 py-10'),
                div
                (
                    setClass('text-gray'),
                    $lang->reporttemplate->noTemplate
                )
            )
        )
    );
}

div
(
    setClass('reporttemplate-home-body flex-auto min-h-0 col gap-4 p-0.5 items-stretch overflow-auto scrollbar-hover'),
    $scopeItems
);
