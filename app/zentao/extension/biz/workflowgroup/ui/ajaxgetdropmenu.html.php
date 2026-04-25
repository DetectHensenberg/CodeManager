<?php
/**
 * The ajaxgetdropmenu view file of workflowgroup module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowgroup
 * @link        https://www.zentao.net
 */
namespace zin;

$data = array();

/* 处理分组数据。Process grouped data. */
foreach($workflowGroups as $groupID => $groupName)
{
    $item = array();
    $item['id']        = $groupID;
    $item['text']      = $groupName;
    $item['type']      = 'workflowgroup';
    $item['keys']      = zget($groupsPinyin, $groupName, '');
    $item['active']    = $groupID == $currentGroupID || (empty($groupID) && empty($currentGroupID));
    $data[] = $item;
}

/**
 * 定义最终的 JSON 数据。
 * Define the final json data.
 */

$json = array();
$json['data']       = $data;
$json['searchHint'] = $lang->searchAB;
$json['link']       = $link;
$json['itemType']   = 'workflowgroup';

/**
 * 渲染 JSON 字符串并发送到客户端。
 * Render json data to string and send to client.
 */
renderJson($json);
