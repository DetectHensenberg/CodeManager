<?php
/**
 * 获取知识库在 ZAI 的 key。
 * Get key of knowledge base in ZAI.
 *
 * @access public
 * @param string|int $collection
 * @return string
 */
public function getCollectionKey($collection)
{
    return $this->loadExtension('zentaobiz')->getCollectionKey($collection);
}


/**
 * 判断用户是否可以查看对象。
 * Check if user can view object.
 *
 * @access public
 * @param string $objectType
 * @param int    $objectID
 * @param array|null $attrs
 * @return bool
 */
public function canViewObject($objectType, $objectID, $attrs = null)
{
    if($this->app->user->admin) return true;

    $knowledgeLibID = $attrs && isset($attrs['knowledgeLib']) ? $attrs['knowledgeLib'] : 0;
    if($objectType === 'knowledge' || $knowledgeLibID)
    {
        if(empty($knowledgeLibID) && $objectType === 'knowledge')
        {
            $knowledge = $this->loadModel('ai')->getKnowledgeItemByID($objectID);
            if(!$knowledge || $knowledge->deleted) return false;
            $knowledgeLibID = $knowledge->lib;
        }
        $knowledgeLib        = $knowledgeLibID ? $this->loadModel('ai')->getKnowledgeLibByID($knowledgeLibID) : null;
        $canViewKnowledgeLib = $knowledgeLib ? $this->loadModel('ai')->checkKnowledgeLibPriv($knowledgeLib) : false;
        if(!$canViewKnowledgeLib || $objectType === 'knowledge' || $objectType === 'file') return $canViewKnowledgeLib;
    }

    if($objectType === 'plan')
    {
        $product = $attrs && isset($attrs['product']) ? $attrs['product'] : 0;
        if(empty($product))
        {
            $plan = $this->loadModel('productplan')->getByID($objectID);
            if(!$plan) return false;
            $product = $plan->product;
        }
        return strpos(',' . $this->app->user->view->products . ',', ",$product,") !== false;
    }

    if($objectType === 'release' || $objectType === 'ticket' || $objectType === 'issue')
    {
        $release = $this->loadModel($objectType)->getByID($objectID);
        if(!$release) return false;
        if($release->product && strpos(',' . $this->app->user->view->products . ',', ",$release->product,") !== false) return true;

        if($release->project)
        {
            $projectIDList = explode(',', $release->project);
            foreach($projectIDList as $projectID)
            {
                if(strpos(',' . $this->app->user->view->projects . ',', ",$projectID,") === false) return false;
            }
            return true;
        }

        return false;
    }

    if($objectType === 'risk' || $objectType === 'opportunity')
    {
        $risk = $this->loadModel($objectType)->getByID($objectID);
        if(!$risk) return false;
        if($risk->project && strpos(',' . $this->app->user->view->projects . ',', ",$risk->product,") !== false) return true;
        return false;
    }

    return parent::canViewObject($objectType, $objectID, $attrs);
}

/**
 * 创建聊天。
 * Create chat.
 *
 * @access public
 * @param string $title
 * @param array|string $prompts
 * @param array $settings
 * @param array $customData
 * @param array $references
 * @return array|false
 */
public function createChat($title, $prompts, $settings = [], $customData = [], $references = [])
{
    return $this->loadExtension('zentaobiz')->createChat($title, $prompts, $settings, $customData, $references);
}

/**
 * 准备消息。
 * Prepare messages for posting to a chat.
 *
 * @access public
 * @param string|object|array $messages
 * @return array
 */
public function prepareMessages($messages)
{
    return $this->loadExtension('zentaobiz')->prepareMessages($messages);
}

/**
 * 发送消息到聊天。
 * Send message to chat.
 *
 * @access public
 * @param string $chatID
 * @param string|object|array $message
 * @param array $tools
 * @param callable|Collator|null $onSaveMessage
 * @param callable|Collator|null $onCallTool
 * @param string|null $bgid
 * @return array|false
 */
public function postMessage($chatID, $message, $tools = [], $onSaveMessage = null, $onCallTool = null, $bgid = null)
{
    return $this->loadExtension('zentaobiz')->postMessage($chatID, $message, $tools, $onSaveMessage, $onCallTool, $bgid);
}

/**
 * 获取聊天。
 * Get chat.
 *
 * @access public
 * @param string $chatID
 * @return array|false
 */
public function getChat($chatID)
{
    return $this->loadExtension('zentaobiz')->getChat($chatID);
}

/**
 * 更新聊天。
 * Update chat.
 *
 * @access public
 * @param string $chatID
 * @param array $data
 * @return array|false
 */
public function updateChat($chatID, $data)
{
    return $this->loadExtension('zentaobiz')->updateChat($chatID, $data);
}

/**
 * 更新聊天标题。
 * Update chat title.
 *
 * @access public
 * @param string $chatID
 * @param string $title
 * @return array|false
 */
public function updateChatTitle($chatID, $title)
{
    return $this->loadExtension('zentaobiz')->updateChatTitle($chatID, $title);
}

/**
 * 生成聊天标题。
 * Generate chat title.
 *
 * @access public
 * @param string $chatID
 * @return array|false
 */
public function generateChatTitle($chatID)
{
    return $this->loadExtension('zentaobiz')->generateChatTitle($chatID);
}
