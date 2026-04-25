<?php
/**
 * 将交付物配置项渲染成可读的变更记录。
 * Process deliverable json.
 *
 * @param  string $objectType
 * @param  int    $objectID
 * @param  object $history
 * @access public
 * @return string
 */
public function processDeliverableJson($objectType, $objectID, $history)
{
    return $this->loadExtension('zentaomax')->processDeliverableJson($objectType, $objectID, $history);
}

/**
 * 恢复被删除对象的关联数据。
 * Recover related data of deleted object.
 *
 * @param  object    $action
 * @param  object    $object
 * @access protected
 * @return void
 */
protected function recoverRelatedData($action, $object)
{
    parent::recoverRelatedData($action, $object);
    if($action->objectType == 'reporttemplate')
    {
        $module = $this->dao->select('id,deleted')->from(TABLE_MODULE)->where('id')->eq($object->module)->fetch();
        if($module->deleted != '0')
        {
            $this->dao->update(TABLE_MODULE)->set('deleted')->eq(actionModel::BE_UNDELETED)->where('id')->eq($object->module)->exec();
            $this->dao->update(TABLE_ACTION)->set('extra')->eq(actionModel::BE_UNDELETED)->where('objectType')->eq('reporttemplatecategory')->andWhere('objectID')->eq($object->module)->exec();
            $this->create('reporttemplatecategory', $object->module, 'undeleted');
        }

        $files = $this->loadModel('file')->getByObject('reportTemplate', $action->objectID);
        if($files) $this->dao->update(TABLE_FILE)->set('deleted')->eq(actionModel::BE_UNDELETED)->where('id')->in(array_keys($files))->exec();
    }

    if($action->objectType == 'weekly')
    {
        $module = $this->dao->select('id,deleted')->from(TABLE_MODULE)->where('id')->eq($object->module)->fetch();
        if($module && $module->deleted != '0')
        {
            $this->dao->update(TABLE_MODULE)->set('deleted')->eq(actionModel::BE_UNDELETED)->where('id')->eq($object->module)->exec();
            $this->dao->update(TABLE_ACTION)->set('extra')->eq(actionModel::BE_UNDELETED)->where('objectType')->eq('reportcategory')->andWhere('objectID')->eq($object->module)->exec();
            $this->create('reportcategory', $object->module, 'undeleted');
        }

        $files = $this->loadModel('file')->getByObject('weekly', $action->objectID);
        if($files) $this->dao->update(TABLE_FILE)->set('deleted')->eq(actionModel::BE_UNDELETED)->where('id')->in(array_keys($files))->exec();
    }
}
