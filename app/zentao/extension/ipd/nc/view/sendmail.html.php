<?php
/**
 * The mail file of auditplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun
 * @package     auditplan
 * @version     $Id: sendmail.html.php 4626 2013-04-10 05:34:36Z chencongzhi520@gmail.com $
 * @link        https://www.zentao.net
 */
?>
<?php $mailTitle = 'NC #' . $object->id . ' ' . $object->title;?>
<?php include $this->app->getModuleRoot() . 'common/view/mail.header.html.php';?>
<?php $app = $object->execution ? 'execution' : 'project';?>
<tr>
  <td>
    <table cellpadding='0' cellspacing='0' width='600' style='border: none; border-collapse: collapse;'>
      <tr>
        <td style='padding: 10px; background-color: #F8FAFE; border: none; font-size: 14px; font-weight: 500; border-bottom: 1px solid #e5e5e5;'>
          <?php echo html::a($domain . helper::createLink('nc', 'view', "ncID=$object->id", 'html') . "#app=$app", $mailTitle, '', "style='color: #333; text-decoration: underline;'");?>
        </td>
      </tr>
    </table>
  </td>
</tr>
<?php include $this->app->getModuleRoot() . 'common/view/mail.footer.html.php';?>
