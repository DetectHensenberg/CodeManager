<?php
namespace zin;

global $lang;

jsVar('currentMethod', 'edit');

$projectID = data('projectID');
$project   = data('project');
$from      = data('from');
$programID = data('programID');
$loadUrl   = helper::createLink('project', 'edit', "projectID={$projectID}&from={$from}&programID={$programID}&extra=charter={charter}");
query('formGridPanel')->each(function($node) use($lang, $loadUrl, $project)
{
    $fields = $node->prop('fields');

    if(data('config.systemMode') == 'light' || $project->model == 'kanban') $fields->field('parent')->wrapAfter();
    $fields->field('charter')
        ->class('charterBox')
        ->control(array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeCharter'))
        ->items(data('charters'))
        ->value(data('charter'))
        ->disabled(data('disableModel'))
        ->hidden(data('config.systemMode') == 'light' || $project->model == 'kanban' || (!helper::hasFeature('program') && data('config.edition') != 'ipd'))
        ->moveAfter('parent');

    $fields->field('linkType')->value(data('linkType'))->hidden(true);

    $fields->field('productsBox')
        ->width('full')
        ->required(data('copyProject.parent') || data('parentProgram.id') || data('project.parent'))
        ->hidden(!data('charter') && !data('project.hasProduct'))
        ->control(array
        (
            'control'           => 'productsBox',
            'productItems'      => data('charter') ? data('charterProductPairs') : data('allProducts'),
            'branchGroups'      => data('charter') ? data('branchPairs') : data('branchGroups'),
            'planGroups'        => data('charter') ? data('charterPlans') : data('productPlans'),
            'roadmapGroups'     => data('productRoadmaps'),
            'productPlans'      => data('charter') ? data('charterPlans') : data('productPlans'),
            'linkedProducts'    => data('charter') ? data('charterProducts') : data('linkedProducts'),
            'linkedBranches'    => data('linkedBranches'),
            'project'           => data('project') ? data('project') : data('copyProject'),
            'hasNewProduct'     => data('app.rawMethod') == 'create',
            'isStage'           => data('isStage'),
            'type'              => data('linkType'),
            'charterID'         => data('charter'),
            'errorSameProducts' => $lang->project->errorSameProducts,
            'selectTip'         => $lang->project->selectProductTip
        ));

    $fields->autoLoad('charter', 'productsBox,linkType');

    $fields->orders('parent,charter,name', 'days,PM,budget');

    $fields->field('hasProduct')->hidden(true);

    $node->setProp('fields', $fields);
    $node->setProp('loadUrl', $loadUrl);
});
