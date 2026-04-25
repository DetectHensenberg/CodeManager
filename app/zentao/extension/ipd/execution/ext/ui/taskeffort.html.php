<?php
/**
 * The taskeffort view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@chandao.com>
 * @package     execution
 * @version     $Id: editrelation.html.php 935 2024-08-08 15:14:24Z $
 * @link        https://www.zentao.net
 */
namespace zin;

$taskList      = array();
$groupIndex    = 0;
$rowIndex      = 0;
$canCreateTask = hasPriv('task', 'create', (object)['execution' => $executionID]);
$createLink    = createLink('task', 'create', "execution=$executionID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : ''));

featureBar
(
    hasPriv('execution', 'computeTaskEffort') ? btn(
        setClass('mr-2'),
        set::type('primary'),
        set::icon('refresh'),
        set::url('#computeModal'),
        toggle::modal(),
        $lang->execution->computeTaskEffort
    ) : null,
    btn(
        set::type('ghost'),
        set::url('execution', 'taskeffort', "executionID=$executionID&group=$groupBy&type=" . ($type == 'noweekend' ? 'withweekend' : 'noweekend')),
        set::hint($type == 'noweekend' ? $lang->execution->withweekend : $lang->execution->noweekend),
        div(setClass('checkbox-primary', $type == 'noweekend' ? '' : 'checked'), h::label($lang->execution->withweekend))
    )
);

$toolbarItems = [];
if($canCreateTask) $toolbarItems[] = ['type' => 'primary', 'text' => $lang->task->create, 'icon' => 'plus', 'url' => $createLink];

toolbar(set::items($toolbarItems));

$mainContent = null;
$hasTable    = false;
if(empty($tasks))
{
    $mainContent = div
    (
        setClass('dtable-empty-tip'),
        span(setClass('text-gray'), $lang->task->noTask),
        $canCreateTask ? btn(
            setClass('ml-2'),
            set::type('primary-pale'),
            set::icon('plus'),
            set::url($createLink),
            $lang->task->create
        ) : null
    );
}
else
{
    $executionBegin = helper::isZeroDate($execution->realBegan) ? $execution->begin : $execution->realBegan;
    if((time() - strtotime($executionBegin)) < 0)
    {
        $mainContent = div(setClass('dtable-empty-tip'), span(setClass('text-gray'), $lang->task->noStart));
    }
    else
    {
        $hasTable    = true;
    }
}

div
(
    setClass('shadow rounded ring canvas'),
    $mainContent,
    rawContent()
);
?>

<?php if($hasTable):?>
<div id='tasksTable' class='load-indicator loading'>
  <div id='tableContainer' zui-init="initTaskEffortTable()">
    <div id='tableHeader'>
      <div id='headerColGroup'>
        <div id='groupMenu' class="dropdown">
          <button type="button" class="btn primary-pale w-full justify-between" data-toggle="dropdown">
              <span class="text"><?php echo zget($lang->execution->groups, $groupBy, null);?></span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu menu">
              <?php foreach($lang->execution->groups as $key => $value):?>
              <?php if(empty($key)) continue;?>
              <?php if($execution->type == 'ops' && $key == 'story') continue;?>
              <li class="menu-item item font-normal"><a <?php echo $key == $groupBy ? ' class="selected"' : ''; ?> href="<?php echo createLink('execution', 'taskeffort', "executionID=$executionID&groupBy=$key");?>"><?php echo $value;?></a></li>
              <?php endforeach;?>
            </ul>
        </div>
      </div>
      <div id='headerColName'><?php echo $lang->task->common;?></div>
      <div id='headerTimeline'>
        <div id='timeline'>
          <div id='timeList'></div>
        </div>
      </div>
    </div>
    <div id='tableBody'>
      <div id='groups'>
        <?php $isGroupByAssignTo = $groupBy == 'assignedTo';?>
        <?php foreach($tasks as $groupKey => $groupTasks):?>
        <?php
          $groupName = $groupKey;
          if($groupBy == 'story') $groupName = empty($groupName) ? $this->lang->task->noStory : zget($groupByList, $groupKey);
          if($isGroupByAssignTo and $groupName == '') $groupName = $this->lang->task->noAssigned;
        ?>
        <div class='row-group' data-id='<?php echo $groupIndex; ?>' id='group-<?php echo $groupIndex; ?>'>
          <?php $index = 0;?>
          <?php foreach($groupTasks as $task):?>
            <?php $taskList[] = isset($task->burn) ? $task->burn : 0; ?>
            <?php if($index == 0): ?>
            <div class='cell-group group-name'>
              <span class='<?php echo ($isGroupByAssignTo and $groupName == $app->user->account) ? 'text-red' : 'text-primary'; ?>'><?php echo $groupName; ?></an>
              <?php if($isGroupByAssignTo and isset($members[$task->assignedTo])): ?>
              <div class='small'><?php printf($lang->execution->memberHoursAB, $users[$task->assignedTo], $members[$task->assignedTo]->totalHours); ?></div>
              <?php endif; ?>
            </div>
            <div class='cell-group group-tasks'>
            <?php endif; ?>
              <div class='group-task' id='task-<?php echo $rowIndex; ?>' data-row='<?php echo $rowIndex; ?>' data-group='<?php echo $groupIndex; ?>' ta-index='<?php echo $index; ?>'>
                <?php
                  if(isset($task->multiple)) echo '<span class="label label-light label-badge">' . $lang->task->multipleAB . '</span> ';
                  if($task->parent > 0 && $task->isParent == '0') echo '<span class="label label-light label-badge">' . $lang->task->childrenAB . '</span> ';
                  if($task->isParent) echo '<span class="label">' . $lang->task->parentAB . '</span> ';
                  if(!common::printLink('task', 'view', "task=$task->id", $task->name, '', 'class="text-primary"')) echo $task->name;
                ?>
              </div>
              <?php $index++;?>
              <?php $rowIndex++;?>
              <?php endforeach;?>
            </div>
        </div>
        <?php $groupIndex++;?>
        <?php endforeach;?>
      </div>
      <div id='cellsContainer'>
        <div id='cells'></div>
      </div>
    </div>
    <div id='tableFooter'>
      <div id='footerTotal'><?php echo $lang->team->totalHours?></div>
      <div id='scrollbarContainer'>
        <div id='scrollbar'></div>
      </div>
      <div id='totalCells'>
        <div id='totalDays'></div>
      </div>
    </div>
  </div>
</div>
<?php
jsVar('counts', $counts);
jsVar('rowsCount', $rowIndex);
jsVar('groupsCount', $groupIndex);
jsVar('days', $dateList);
jsVar('taskList', $taskList);
jsVar('today', helper::today());
jsVar('endMoreThanToday', $lang->execution->endMoreThanToday);
jsVar('beginMoreThanEnd', $lang->execution->beginMoreThanEnd);
jsVar('leftText', $lang->task->leftAB);
jsVar('consumedText', $lang->task->consumedAB);
?>
<?php endif;?>

<div class="modal fade" id="computeModal">
  <div class="modal-dialog size-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $lang->execution->computeTaskEffort;?></h4>
      </div>
      <div class="modal-body">
        <form class="form form-horz">
          <div class="form-group">
            <label id='dateRange' class="form-label"><?php echo $lang->execution->beginAndEnd;?></label>
            <div class='input-group'>
              <?php echo html::input('begin', date('Y-m-d', strtotime('-30 days')), "class='form-control form-date'");?>
              <span class='input-group-addon'><?php echo $lang->execution->to;?></span>
              <?php echo html::input('end', date('Y-m-d'), "class='form-control form-date'");?>
            </div>
          </div>
          <div class="form-actions">
            <?php echo html::commonButton($lang->save, "id='saveButton' zui-on-click='computeTaskEffort()'", 'btn primary btn-wide');?>
            <?php echo html::commonButton($lang->cancel, "data-dismiss='modal'", 'btn btn-wide');?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
