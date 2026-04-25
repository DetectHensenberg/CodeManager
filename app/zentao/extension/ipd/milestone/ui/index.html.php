<?php
/**
 * The index ui view file of milestone module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <wangyidong@chandao.com>
 * @package     milestone
 * @link        https://www.zentao.net
 */
namespace zin;

div
(
    setClass('flex flex-auto mb-4'),
    backBtn
    (
        set::icon('back'),
        set::type('primary-outline'),
        set::back('APP'),
        $lang->goback
    ),
    !empty($milestoneItems) || !empty($productItems) ?  div
    (
        setClass('flex'),
        !empty($productItems) ? picker
        (
            setClass('ml-4'),
            set::width('150px'),
            set::name('product'),
            set::items($productItems),
            set::value($productID),
            set::required(true)
        ) : null,
        picker
        (
            setClass('ml-4'),
            set::width('150px'),
            set::name('milestone'),
            set::items($milestoneItems),
            set::value($executionID),
            set::required(true),
            empty($milestoneItems) ? set::placeholder($lang->noData) : null
        )
    ) : null
);

if(empty($executionID))
{
    div(setClass('table-empty-tip'), p($lang->noData));
}
else
{
    include 'basicinfo.html.php';
    include 'process.html.php';
    include 'chart.html.php';
    include 'productquality.html.php';
    include 'workhour.html.php';
    include 'progress.html.php';
    include 'rectifying.html.php';
    include 'condition.html.php';
    include 'projectrisk.html.php';
    include 'otherproblem.html.php';

    $buildBasicInfo();
    $buildProcess();
    $buildChart();
    $buildProductQuality();
    $buildWorkhour();
    $buildProgress();
    $buildRectifying();
    $buildCondition();
    $buildProjectRisk();
    $buildOtherproblems();
}
