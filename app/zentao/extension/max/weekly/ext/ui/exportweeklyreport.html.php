<?php
/**
 * The exportweeklyreport template view file of weekly module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <wangyidong@chandao.com>
 * @package     weekly
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->export),
    set::target('_self'),
    set::action($this->createLink('weekly', 'exportweeklyreport', "module={$module}&projectID={$project->id}&productID={$productID}")),
    on::submit('setDownloading'),
    formGroup
    (
        set::label($lang->setFileName),
        set::name('fileName'),
        set::value(sprintf($lang->weekly->exportWeekly, $project->name))
    ),
    formHidden('selectedWeekBegin', ''),
    set::actions(array('submit')),
    set::submitBtnText($lang->export)
);

h::js
(
<<<'JAVASCRIPT'
$(function()
{
    const $exportWeeklyBtn = $('#exportWeeklyBtn');
    $('input[name=selectedWeekBegin]').val($exportWeeklyBtn.length > 0 ? $exportWeeklyBtn.data('selectedweekbegin') : '');
})

window.setDownloading = function(event)
{
    /* Opera don't support, omit it. */
    if(navigator.userAgent.toLowerCase().indexOf("opera") > -1) return true;

    $.cookie.set('downloading', 0, {expires:config.cookieLife, path:config.webRoot});
    $('.upload-btn').attr('disabled', 'disabled').addClass('disabled loading');

    var time = setInterval(function()
    {
        if($.cookie.get('downloading') == 1)
        {
            const modal = zui.Modal.query(event.target);
            if(modal) modal.hide();
            if(!modal) parent.$.closeModal();
            $.cookie.set('downloading', null, {expires:config.cookieLife, path:config.webRoot});
            clearInterval(time);
        }
    }, 300);
    return true;
};
JAVASCRIPT
);
