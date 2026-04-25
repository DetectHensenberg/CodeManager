<?php
/**
 * 获取流程概览数据。
 * Get workflow report.
 *
 * @param  int    $groupID
 * @access public
 * @return string
 */
public function getReport($groupID)
{
    return $this->loadExtension('zentaomax')->getReport($groupID);
}
