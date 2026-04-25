<?php
/**
 * 设置设计导航。
 * Set design menu.
 *
 * @param  int    $projectID
 * @param  int    $productID
 * @param  string $type
 * @access public
 * @return void
 */
public function setMenu($projectID, $productID = 0, $type = '')
{
    $this->loadExtension('zentaomax')->setMenu($projectID, $productID, $type);
}
