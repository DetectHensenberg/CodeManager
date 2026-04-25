<?php
/**
 * The close file of nc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     nc
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = defineFieldList('nc');
$fields->field('comment')->label($lang->comment)->control('editor')->width('full');

formPanel
(
    set::title($title),
    set::layout('horz'),
    set::fields($fields)
);

history();
