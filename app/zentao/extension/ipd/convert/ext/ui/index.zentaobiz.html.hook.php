<?php
namespace zin;

global $lang;

$importConfluence = panel
(
    setClass('mt-2'),
    set::title($lang->convert->confluence->import),
    div
    (
        setClass('flex justify-between panel-form text-center mx-auto size-sm p-8 gap-4'),
        div
        (
            setClass('border border-hover rounded-md cursor-pointer open-url p-4 flex-1'),
            set(array('data-url' => createLink('convert', 'importConfluenceNotice'))),
            div
            (
                setClass('text-xl font-bold mb-4'),
                $lang->convert->confluence->import
            ),
            div
            (
                setClass('text-gray mb-4'),
                $lang->convert->confluence->importDesc
            )
        ),
        div(setClass('border border-hover rounded-md cursor-pointer open-url p-4 flex-1 invisible')),
        div(setClass('border border-hover rounded-md cursor-pointer open-url p-4 flex-1 invisible'))
    )
);
query('#importJira')->after($importConfluence);
