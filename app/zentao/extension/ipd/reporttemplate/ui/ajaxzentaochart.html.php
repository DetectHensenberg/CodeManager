<?php
/**
 * The ajaxZentaoChart view file of reporttemplate module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     reporttemplate
 * @link        https://www.zentao.net
 */
namespace zin;

h::css("thead.freeze{position: sticky; top: -2px; z-index: 2;}");

$buildTable = function($options) use($lang)
{
    $dataset = zget($options, 'dataset', array());
    if(empty($dataset)) return div(setClass('canvas border rounded py-3 px-3 text-center text-gray'), $lang->noData);

    $theadRows = array();
    foreach(zget($options, 'headers', array()) as $header)
    {
        $columns = array();
        foreach($header as $row)
        {
            $columns[] = h::th(zget($row, 'label', ''), isset($row['helpIcon']) ? h::span(icon('help'), set::title($row['hint'])) : null, !empty($row['rowspan']) && $row['rowspan'] > 1 ? set::rowspan($row['rowspan']) : null, !empty($row['colspan']) && $row['colspan'] > 1 ? set::colspan($row['colspan']) : null);
        }
        $theadRows[] = h::tr($columns);
    }

    $allRowspan  = zget($options, 'rowspan', array());
    $lineRowspan = array();
    $tbodyRows   = array();

    foreach($dataset as $lineIndex => $line)
    {
        $row = array();
        foreach($line as $colIndex => $cell)
        {
            if(isset($lineRowspan[$colIndex]) && $lineRowspan[$colIndex] > 1)
            {
                $lineRowspan[$colIndex]--;
                continue;
            }

            $lineRowspan[$colIndex] = isset($allRowspan[$lineIndex][$colIndex]) ? $allRowspan[$lineIndex][$colIndex] : 0;
            $colspan   = 1;
            $className = '';
            if(is_array($cell))
            {
                $colspan   = isset($cell['colspan']) && $cell['colspan'] > 1 ? $cell['colspan'] : $colspan;
                $className = isset($cell['className']) ? $cell['className'] : $className;
                $cell      = isset($cell['text']) ? $cell['text'] : '';
            }
            $row[] = h::td
            (
                html($cell),
                set::title(strip_tags((string)$cell)),
                $className ? set::className($className) : null,
                $lineRowspan[$colIndex] > 1 ? set::rowspan($lineRowspan[$colIndex]) : null,
                $colspan > 1 ? set::colspan($colspan) : null
            );
        }
        $tbodyRows[] = h::tr($row);
    }

    return h::table(setClass('table bordered text-center'), h::thead(setClass('freeze whitespace-nowrap'), $theadRows), h::tbody(setClass('whitespace-nowrap'), $tbodyRows));
};

if(strpos($type, '_gantt') !== false && !empty($canUseGantt))
{
    $userList = array();
    foreach($users as $account => $realname) $userList[] = array('key' => $account, 'label' => $realname);
}

$noticeTip = '';
if($notTemplate)
{
    if(strpos($type, '_gantt') !== false && empty($canUseGantt)) $noticeTip = sprintf($lang->reporttemplate->notice->noSupport, $lang->reporttemplate->chartList['project']['basicStatistic']['gantt']);
    if(isset($chart) && empty($chart['options'])) $noticeTip = $lang->reporttemplate->emptyDataTip;
}

$isChart   = isset($chart['options']) && zget($chart, 'chartType', '') != 'table';
$isTable   = isset($chart['options']) && zget($chart, 'chartType', '') == 'table';
$titleTip  = '';
$tipHeight = '';
if(!empty($chart['tips'])) $titleTip = $chart['tips'];
if($module == 'project' && $chartKey == 'summary') $tipHeight = 'h-44';

$actions      = array();
$hasCondition = true;
if(in_array($module, array('project', 'execution'))) $hasCondition = false;
if($module == 'project' && $chartKey == 'summary')   $hasCondition = true;
if($hasCondition) $actions[] = array('icon' => 'menu-backend', 'text' => $lang->settings, 'data-toggle' => 'modal', 'url' => createLink('reporttemplate', 'ajaxBuildZentaoChartConfig', "type={$type}&blockID={$blockID}&projectID={$projectID}"));
$actions[] = array('icon' => 'trash', 'text' => $lang->delete, 'zui-on-click' => "deleteZentaoChart($blockID)");

div
(
    set('data-id', $blockID),
    setClass('zentao-chart my-3'),
    setCssVar('--affine-font-base', '13px!important'),
    setStyle('font-size', '13px'),
    setStyle('max-height', '500px'),
    setStyle('overflow-y', 'auto'),
    css('.is-readonly .zentao-chart-actions {display: none}'),
    div
    (
        setClass('zentao-chart-heading row items-center gap-2 mb-1'),
        h2
        (
            setClass('font-bold text-xl'),
            $title,
            $titleTip ? span(setClass('pl-1'), setData(array('toggle' => 'dropdown', 'trigger' => 'hover')), icon('help')) : null,
            $titleTip ? h::menu(setClass("dropdown-menu custom p-1 {$tipHeight} overflow-auto"), setStyle(array('font-weight' => 'normal', 'font-size' => '12px', 'line-height' => '1.5')), html($titleTip)) : null
        ),
        div
        (
            setClass('zentao-chart-actions toolbar flex-auto justify-end'),
            dropdown
            (
                set::trigger('hover'),
                set::placement('bottom-end'),
                set::items($actions),
                btn(set::icon('ellipsis-v'), set::caret(false), set::type('ghost'))
            )
        )
    ),
    !$notTemplate ? div
    (
        setClass('canvas border rounded py-3 px-3'),
        div
        (
            setClass('config-tip text-center px-3 py-2 text-gray-400'),
            div($lang->reporttemplate->chartBlockTip),
            div($conditionText)
        )
    ) : null,
    $noticeTip ? div
    (
        setClass('canvas border rounded py-3 px-3'),
        div
        (
            setClass('config-tip text-center px-3 py-2 text-gray-400'),
            div($noticeTip)
        )
    ) : null,
    $isChart ? div
    (
        setClass('chartBox chart'),
        echarts(set($chart['options']), set::width('100%'), set::height(300), zget($chart, 'chartType', '') == 'waterpolo' ? set::exts('liquidfill') : null)
    ) : null,
    $isTable ? div(setClass('chartBox table'), set::style(array('max-height' => '300px', 'overflow-y' => 'auto')), $buildTable($chart['options'])) : null,
    !empty($canUseGantt) ? div
    (
        setClass('chartBox gantt'),
        $this->view->notTemplate ? setData('link', createLink('programplan', 'browse', "projectID=$projectID&productID=0&type=gantt")) : null,
        zui::gantt
        (
            set::onInit(jsRaw('window.onInitGantt')),
            set::data($ganttData['data']),
            set::links($ganttData['links']),
            set::ganttFields($ganttFields),
            set::showFields('text,PM,status,begin,deadline,duration'),
            set::userList($userList),
            set::exts('zentao')
        )
    ) : null
);
