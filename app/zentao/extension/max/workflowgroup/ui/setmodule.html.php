<?php
namespace zin;

jsVar('changeLang', $lang->admin->setModule->change);
jsVar('deliverableLang', $lang->admin->setModule->deliverable);
jsVar('cmLang', $lang->admin->setModule->cm);
jsVar('openDependFeature', $lang->admin->notice->openDependFeature);
jsVar('closeDependFeature', $lang->admin->notice->closeDependFeature);

$model = in_array($group->projectModel, array('scrum', 'agileplus')) ? 'scrum' : 'waterfall';
$disabledFeatures = !empty($group->disabledFeatures) ? explode(',', $group->disabledFeatures) : array();

$cards = [];
$i     = 0;
foreach($config->workflowgroup->featureGroup[$model] as $feature)
{
    if(!helper::hasFeature("project_{$feature}")) continue;
    $isDisabled = in_array($feature, $disabledFeatures);
    $cards[] = div
    (
        setClass('col flex-none w-1/3'),
        h::label
        (
            div
            (
                setClass('border py-2 pl-4 ml-4 mt-4 h-20'),
                div
                (
                    setClass('flex items-center'),
                    h::input
                    (
                        set::type('checkbox'),
                        set::id("feature-{$feature}"),
                        set::name("features[]"),
                        set::value($feature),
                        set::checked(!$isDisabled),
                        on::change('changeModule')
                    ),
                    h4(setClass('font-bold text-gray-800 ml-2 text-md'), $lang->workflowgroup->featureList[$feature]['name'])
                ),
                div(setClass('ml-5 pr-2.5'), p(setClass('text-gray-600 leading-relaxed break-words m-0'), $lang->workflowgroup->featureList[$feature]['desc']))
            )
        )
    );

    $i ++;
}

if(empty($cards))
{
    div
    (
        setClass('dtable-empty-tip bg-white rounded-lg p-4'),
        div
        (
            setClass('row gap-4 items-center'),
            div
            (
                setClass('text-gray'),
                $lang->workflowgroup->notice->allFeatureClosed
            )
        )
    );
}
else
{
    formPanel
    (
        set::actions(array('submit')),
        h4( $lang->workflowgroup->setModule),
        div
        (
            setClass('flex flex-wrap'),
            $cards
        )
    );
}

h::css('div.col label {cursor: pointer;}');