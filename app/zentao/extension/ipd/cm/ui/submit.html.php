<?php
/**
 * The create file of cm module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     cm
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('viewURL', inlink('view', "baselineID={$baseline->id}"));

$reviewBox = '';
$content   = '';
if(empty($nodes))
{
    $content = div
    (
        setClass('h-8 content-center'),
        span($lang->noData)
    );
}
else
{
    $nodeTrs = array();
    foreach($nodes as $node)
    {
        $rangeUsers = $users;
        if(isset($node['range']['reviewer']))
        {
            $rangeUsers = array();
            foreach($node['range']['reviewer'] as $range) $rangeUsers[$range] = zget($users, $range, array());
        }

        $reviewers = array();
        foreach(array('appointees', 'role', 'position', 'self', 'upLevel', 'superior', 'superiorList', 'productRole', 'projectRole', 'executionRole') as $key)
        {
            if(isset($node[$key]['reviewer']))
            {
                foreach($node[$key]['reviewer'] as $reviewer) $reviewers[$reviewer] = zget($users, $reviewer);
            }
        }

        $ccRangeUsers = $users;
        if(isset($node['range']['ccer']))
        {
            $ccRangeUsers = array();
            foreach($node['range']['ccer'] as $range) $ccRangeUsers[$range] = zget($users, $range, array());
        }

        $ccers = array();
        foreach(array('appointees', 'role', 'position', 'upLevel', 'superior') as $key)
        {
            if(isset($node[$key]['ccer']))
            {
                foreach($node[$key]['ccer'] as $ccer) $ccers[$ccer] = zget($users, $ccer);
            }
        }

        $nodeID = $node['id'];
        $currentReviewers = '';
        $currentCcers     = '';
        if(isset($nodeReviewerPairs[$nodeID]))
        {
            $currentReviewers = $nodeReviewerPairs[$nodeID]['reviewers'];
            $currentCcers     = $nodeReviewerPairs[$nodeID]['ccs'];

            $currentReviewers = join(',', $currentReviewers);
            $currentCcers     = join(',', $currentCcers);
        }

        $nodeTrs[] = h::tr
        (
            h::td
            (
                setClass('text-center'),
                $node['title'],
                formHidden('ids[]', $node['id'])
            ),
            h::td
            (
                setClass('text-center'),
                in_array('reviewer', $node['types']) ? div
                (
                    picker
                    (
                        set::id("reviewer{$node['id']}"),
                        set::name('reviewer[' . $node['id'] . '][]'),
                        set::items(array_diff(array_intersect_key($users, $rangeUsers), $reviewers)),
                        set::value($currentReviewers),
                        set::multiple(true)
                    ),
                    $reviewers ? div
                    (
                        setClass('otherReviewer mt-2.5'),
                        $lang->approval->otherReviewer . join(',', $reviewers)
                    ) : null
                ) : div
                (
                    formHidden('reviewer[' . $node['id'] . '][]', ''),
                    $reviewers ? join(',', $reviewers) : null
                )
            ),
            h::td
            (
                setClass('text-center'),
                in_array('ccer', $node['types']) ? div
                (
                    picker
                    (
                        set::name('ccer[' . $node['id'] . '][]'),
                        set::items(array_diff(array_intersect_key($users, $rangeUsers), $ccers)),
                        set::value($currentCcers),
                        set::multiple(true)
                    ),
                    $ccers ? div
                    (
                        setClass('otherCcer mt-2.5'),
                        $lang->approval->otherCcer . join(',', $ccers)
                    ) : null
                ) : div
                (
                    formHidden('ccer[' . $node['id'] . '][]', ''),
                    $ccers ? join(',', $ccers) : null
                )
            )
        );
    }

    $content = h::table
    (
        setClass('table bordered'),
        h::thead
        (
            h::tr
            (
                h::th
                (
                    setClass('text-center'),
                    width('1/5'),
                    $lang->approval->node
                ),
                h::th
                (
                    setClass('text-center'),
                    width('2/5'),
                    $lang->approval->reviewer
                ),
                h::th
                (
                    setClass('text-center'),
                    width('2/5'),
                    $lang->approval->ccer
                )
            )
        ),
        h::tbody
        (
            $nodeTrs
        )
    );
}

$reviewerBox = div
(
    setID('reviewerBox'),
    setStyle('width', '100%'),
    $content
);

formPanel
(
    set::title($title),
    set::layout('horz'),
    formGroup
    (
        set::label($lang->cm->reviewer),
        $reviewerBox
    )
);
