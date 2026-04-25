<?php
namespace zin;

$buildRectifying = function() use($projectID, $executionID, $measures, $lang)
{
    $total    = count($measures);
    $first    = array_shift($measures);
    $trList   = array();
    $trList[] = h::tr
    (
        h::th(set::rowspan($total ? $total : 1), setClass('text-center w-48'), setID('measuresTd'), $lang->milestone->corrective),
        h::td(input(set::name('measures[]'), set::value($first), set::onchange('submitMeasurse()'))),
        h::td
        (
            setClass('w-36'),
            btn(icon('plus'),  set::type('link'), setClass('addItem'), set::onclick('addMeasurseItem(this)')),
            btn(icon('close'), set::type('link'), setClass('delItem'), set::onclick('delMeasurseItem(this)')),
            btn(set::btnType('submit'), set::type('primary'), setClass('ml-2'), $lang->save)
        )
    );
    if($total > 1)
    {
        $trList = array_merge($trList, array_map(function($item) use($lang)
        {
            return h::tr
            (
                h::td(input(set::name('measures[]'), set::value($item), set::onchange('submitMeasurse()'))),
                h::td
                (
                    setClass('w-36'),
                    btn(icon('plus'),  set::type('link'), setClass('addItem'), set::onclick('addMeasurseItem(this)')),
                    btn(icon('close'), set::type('link'), setClass('delItem'), set::onclick('delMeasurseItem(this)')),
                    btn(set::btnType('submit'), set::type('primary'), setClass('ml-2'), $lang->save)
                )
            );
        }, $measures));
    }

    $table = h::table(setClass('table condensed bordered bg-white mb-4'), h::tbody($trList));
    return div
    (
        setClass('mt-4 bg-white'),
        form
        (
            setID('measuresForm'),
            set::actions(array()),
            set::action(createLink('milestone', 'ajaxAddMeasures')),
            $table,
            formHidden('projectID', $projectID),
            formHidden('executionID', $executionID)
        ),
        pageJS
        (
          <<<'JAVASCRIPT'
window.addMeasurseItem = function(obj)
{
    const $this       = $(obj);
    const $tr         = $this.closest('tr');
    $tr.after($tr.prop('outerHTML'));

    const $next = $tr.next();
    if($tr.find('#measuresTd').length > 0) $next.find('#measuresTd').remove();
    $next.find('input').val('');

    const $measuresTd = $tr.closest('table').find("#measuresTd");
    const rowspan     = $measuresTd.attr("rowspan");
    $measuresTd.attr("rowspan", Number(rowspan) + 1);
}

window.delMeasurseItem = function(obj)
{
    const $this  = $(obj);
    const $tr    = $this.closest('tr');
    const $table = $tr.closest('table');
    const $next  = $tr.next();
    const length = $table.find('tbody tr').length;
    if(length <= 1) return;

    if($tr.find('#measuresTd').length > 0) $next.prepend($tr.find('#measuresTd').prop('outerHTML'));
    $tr.remove();
    $table.find("#measuresTd").attr("rowspan", length - 1);

    submitMeasurse();
}

window.submitMeasurse = function()
{
    const formData = new FormData($('#measuresForm')[0]);
    $.post($.createLink('milestone', 'ajaxAddMeasures'), formData);
}
JAVASCRIPT
        )
    );
};