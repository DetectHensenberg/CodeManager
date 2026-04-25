<?php
/**
 * The admin view file of review module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     review
 * @link        https://www.zentao.net
 */
namespace zin;

if(!$hasDeliverable)
{
    $currentModuleName = $lang->deliverable->common;
    include('../../common/ext/ui/closefeaturenotice.html.php');
    return;
}

$cols = $this->loadModel('datatable')->getSetting('review', 'admin');
if($browseType == 'baseline') $cols['actions']['list']['delete']['hint'] = $lang->review->cannotDeleteFlow;
if(!empty($cols['flow']))     $cols['flow']['map']     = $approvals;
if(!empty($cols['objectID'])) $cols['objectID']['map'] = $browseType == 'decision' ? $decisions : $deliverables;

if($browseType == 'decision') $cols['actions']['list']['delete']['hint'] = $lang->review->deleteDecision;

$reviews = initTableData($reviews, $cols, $this->review);

if(!$hasBaseline) unset($lang->review->featureBar['admin']['baseline']);
if(!$hasChange)   unset($lang->review->featureBar['admin']['projectchange']);
featureBar
(
    set::current($browseType),
    set::linkParams("groupID=$groupID&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
);

($browseType == 'deliverable' && hasPriv('review', 'createFlow')) || $browseType == 'decision' ? toolbar
(
    item
    (
        set::text($lang->review->createFlow),
        set::icon('plus'),
        $browseType == 'deliverable' ? set::className('btn primary') : set::className('btn disabled'),
        $browseType == 'deliverable' ? set::url(createLink('review', 'createFlow', "groupID=$groupID")) : null,
        $browseType == 'deliverable' ? setData(array('toggle' => 'modal', 'size' => 'sm')) : null,
        $browseType == 'decision' ? set::hint($lang->review->createDecision) : null
    )
) : null;

foreach($reviews as $id => $review)
{
    if($review->objectType == 'change' && isset($review->actions[0]['name']) && $review->actions[0]['name'] == 'reviewcl')
    {
        $reviews[$id]->actions[0]['disabled'] = true;
        $reviews[$id]->actions[0]['hint']     = $lang->review->cannotReviewChange;
    }
}

dtable
(
    set::cols($cols),
    set::data($reviews),
    set::userMap($users),
    set::customCols(true),
    set::orderBy($orderBy),
    set::sortLink(inlink('admin', "groupID=$groupID&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager())
);
