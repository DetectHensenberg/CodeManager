<?php
/**
 * The submit view file of submit module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Mengyi Liu
 * @package     submit
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('viewURL', inlink('view', "reviewID={$review->id}"));

modalHeader();

form($review->type == 'deliverable' ? formGroup
(
    set::label($lang->review->version),
    set::width('1/2'),
    set::required(true),
    set::name('version'),
    set::value($review->version)
) : null, $review->type == 'deliverable' ? formGroup
(
    set::label($lang->review->deadline),
    set::width('1/2'),
    set::control('datePicker'),
    set::name('deadline'),
    set::value($review->deadline)
) : null, formGroup
(
    set::label($lang->review->reviewer),
    div(setID('reviewerBox'))
));

jsVar('projectID', $review->project);
jsVar('type', $review->type);
jsVar('reviewID', $review->id);
jsVar('objectID', $review->category);

pageJS(<<<JAVASCRIPT
$(function()
{
    var link = $.createLink('review', 'ajaxGetNodes', "project=" + projectID + '&object=' + type + '&objectID=' + objectID + '&reviewID=' + reviewID);
    loadCurrentPage({url: link, selector: '#reviewerBox', partial: true});
});
JAVASCRIPT
);

render();
