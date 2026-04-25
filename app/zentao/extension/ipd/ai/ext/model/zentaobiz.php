<?php
/**
 * @param string $appID
 */
public function editMiniProgram($appID)
{
    return $this->loadExtension('zentaobiz')->editMiniProgram($appID);
}

/**
 * @param string $appID
 */
public function createZtAppJson($appID)
{
    return $this->loadExtension('zentaobiz')->createZtAppJson($appID);
}

/**
 * @param string $file
 */
public function createZtAppZip($file)
{
    return $this->loadExtension('zentaobiz')->createZtAppZip($file);
}

/**
 * @return bool|string
 * @param string $appID
 * @param string $deleted
 */
public function deleteMiniProgram($appID, $deleted = '1')
{
    return $this->loadExtension('zentaobiz')->deleteMiniProgram($appID, $deleted);
}

/**
 * @return int|bool
 * @param object $knowledge
 * @param bool $skipUpdateExternal
 */
public function createKnowledge($knowledge, $skipUpdateExternal = false)
{
    return $this->loadExtension('zentaobiz')->createKnowledge($knowledge, $skipUpdateExternal);
}

/**
 * @param object $knowledge
 * @param object|null $knowledgeLib
 */
public function updateExternalKnowledge($knowledge, $knowledgeLib = null)
{
    return $this->loadExtension('zentaobiz')->updateExternalKnowledge($knowledge, $knowledgeLib);
}

/**
 * @param int $id
 * @param object $knowledge
 */
public function updateKnowledge($id, $knowledge)
{
    return $this->loadExtension('zentaobiz')->updateKnowledge($id, $knowledge);
}

/**
 * @return object|false
 * @param int $id
 */
public function getKnowledgeItemByID($id)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeItemByID($id);
}

/**
 * @param bool|string $skipUpdateExternal
 * @param int $id
 * @param object $data
 */
public function updateKnowledgeItem($id, $data, $skipUpdateExternal = false)
{
    return $this->loadExtension('zentaobiz')->updateKnowledgeItem($id, $data, $skipUpdateExternal);
}

/**
 * @param bool|string $skipUpdateExternal
 * @return object|false
 * @param object $knowledge
 */
public function updateKnowledgeItemFromSource($knowledge, $skipUpdateExternal = 'no')
{
    return $this->loadExtension('zentaobiz')->updateKnowledgeItemFromSource($knowledge, $skipUpdateExternal);
}

/**
 * @return object|false
 * @param string $objectType
 * @param int $objectID
 */
public function getKnowledgeObjectByID($objectType, $objectID)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeObjectByID($objectType, $objectID);
}

/**
 * @param int $id
 */
public function deleteKnowledgeItem($id)
{
    return $this->loadExtension('zentaobiz')->deleteKnowledgeItem($id);
}

/**
 * @param object|bool|null $knowledgeLib
 */
public function checkKnowledgeLibPriv($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->checkKnowledgeLibPriv($knowledgeLib);
}

/**
 * @param string $type
 * @param string $category
 * @param string $published
 * @param string $orderBy
 * @param object|null $pager
 */
public function getKnowledgeLibs($type = 'my', $category = '', $published = '', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibs($type, $category, $published, $orderBy, $pager);
}

/**
 * @return object|false
 * @param int $id
 */
public function getKnowledgeLibByID($id)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibByID($id);
}

/**
 * @param mixed[] $ids
 */
public function getKnowledgeLibsByIDs($ids)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibsByIDs($ids);
}

/**
 * @param int $libID
 */
public function getKnowledgeLibStats($libID)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibStats($libID);
}

/**
 * @param int $libID
 */
public function getTextFileItems($libID)
{
    return $this->loadExtension('zentaobiz')->getTextFileItems($libID);
}

/**
 * @param int $id
 */
public function publishKnowledgeLib($id)
{
    return $this->loadExtension('zentaobiz')->publishKnowledgeLib($id);
}

/**
 * @param int $id
 */
public function unpublishKnowledgeLib($id)
{
    return $this->loadExtension('zentaobiz')->unpublishKnowledgeLib($id);
}

/**
 * @param int $id
 */
public function deleteKnowledgeLib($id)
{
    return $this->loadExtension('zentaobiz')->deleteKnowledgeLib($id);
}

/**
 * @param string $type
 * @param int $queryID
 * @param string $actionURL
 */
public function buildKnowledgeLibSearchForm($type, $queryID, $actionURL)
{
    $this->loadExtension('zentaobiz')->buildKnowledgeLibSearchForm($type, $queryID, $actionURL);
}

/**
 * @param string $type
 * @param int $queryID
 * @param string $orderBy
 * @param object|null $pager
 */
public function getKnowledgeLibsBySearch($type, $queryID, $orderBy, $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibsBySearch($type, $queryID, $orderBy, $pager);
}

/**
 * @param string $type
 * @param string $category
 * @param string $published
 * @param string $orderBy
 * @param int $param
 * @param int $recTotal
 * @param int $recPerPage
 * @param int $pageID
 */
public function browseKnowledgeLib($type, $category, $published, $orderBy, $param, $recTotal = 0, $recPerPage = 20, $pageID = 1)
{
    return $this->loadExtension('zentaobiz')->browseKnowledgeLib($type, $category, $published, $orderBy, $param, $recTotal, $recPerPage, $pageID);
}

/**
 * @return int|bool
 * @param object $knowledgeLib
 * @param string $actionType
 */
public function createKnowledgeLib($knowledgeLib, $actionType = 'created')
{
    return $this->loadExtension('zentaobiz')->createKnowledgeLib($knowledgeLib, $actionType);
}

/**
 * @param object $knowledgeLib
 */
public function ensureExternalKnowledgeLib($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->ensureExternalKnowledgeLib($knowledgeLib);
}

/**
 * @param int $id
 * @param object $knowledgeLib
 */
public function editKnowledgeLib($id, $knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->editKnowledgeLib($id, $knowledgeLib);
}

/**
 * @return int|bool
 * @param object $knowledgeLib
 */
public function importFromDoc($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->importFromDoc($knowledgeLib);
}

/**
 * @return int|bool
 * @param object $knowledgeLib
 */
public function importFromAsset($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->importFromAsset($knowledgeLib);
}

/**
 * @param string $objectType
 */
public function buildKnowledgeObjectData($objectType, $source)
{
    return $this->loadExtension('zentaobiz')->buildKnowledgeObjectData($objectType, $source);
}

/**
 * @param string $objectType
 */
public function prepareMarkdownLangMap($objectType)
{
    return $this->loadExtension('zentaobiz')->prepareMarkdownLangMap($objectType);
}

/**
 * @param int $libID
 * @param string $type
 * @param string $objectType
 * @param string $orderBy
 * @param object|null $pager
 */
public function getKnowledgeItems($libID, $type, $objectType, $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeItems($libID, $type, $objectType, $orderBy, $pager);
}

/**
 * @param int $libID
 * @param string $objectType
 * @param object|null $pager
 */
public function getKnowledgeItemsByObjectType($libID, $objectType, $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeItemsByObjectType($libID, $objectType, $pager);
}

/**
 * @param object $knowledge
 */
public function isKnowledgeNeedSync($knowledge)
{
    return $this->loadExtension('zentaobiz')->isKnowledgeNeedSync($knowledge);
}

/**
 * @param int $lib
 * @param string $objectType
 * @param mixed[] $objectIdList
 */
public function getKnowledgeByObjectIdList($lib, $objectType, $objectIdList)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeByObjectIdList($lib, $objectType, $objectIdList);
}

/**
 * @param mixed[] $idList
 */
public function batchDeleteKnowledgeItem($idList)
{
    return $this->loadExtension('zentaobiz')->batchDeleteKnowledgeItem($idList);
}

/**
 * @param string $objectType
 */
public function getKnowledgeObjectCols($objectType)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeObjectCols($objectType);
}

/**
 * @param mixed[] $items
 */
public function prepareReleaseKnowledgeImportList($items)
{
    return $this->loadExtension('zentaobiz')->prepareReleaseKnowledgeImportList($items);
}

/**
 * @param object $knowledgeLib
 */
public function checkExistKnowledgeLib($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->checkExistKnowledgeLib($knowledgeLib);
}
