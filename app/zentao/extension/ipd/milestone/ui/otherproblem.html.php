<?php
namespace zin;

$buildOtherproblems = function() use ($otherproblems, $projectID, $executionID, $lang)
{
    $total   = count($otherproblems);
    $canSave = hasPriv('milestone', 'saveOtherProblem');
    $table   = h::table
    (
        setID('otherproblems'),
        setClass('table bordered condensed bg-white mb-4'),
        h::tbody
        (
            h::tr(h::th(set::colspan(5), setClass('text-left'), $lang->milestone->otherproblem)),
            h::tr
            (
                h::td(set::rowspan($total + 2), setID('problemTd'), $lang->milestone->problemandsuggest),
                h::td($lang->milestone->prodescr),
                h::td($lang->milestone->needhelp),
                h::td($lang->milestone->suggest),
                h::td(setClass('w-36'), $lang->milestone->options)
            ),
            empty($total) ? h::tr
            (
                h::td(input(set::name('contents[]'))),
                h::td(input(set::name('support[]'))),
                h::td(input(set::name('measures[]'))),
                $canSave ? h::td
                (
                    btn(icon('plus'), set::type('link'), setClass('addItem'), set::onclick('addProblemItem(this)')),
                    btn(icon('close'), set::type('link'), setClass('addItem'), set::onclick('delProblemItem(this)')),
                    btn(set::btnType('submit'), set::type('primary'), setClass('ml-2'), $lang->save)
                ) : h::td()
            ) : null,
            $total ? array_map(function($item) use($lang, $canSave)
            {
                return h::tr
                (
                    h::td(input(set::name('contents[]'), set::value($item->contents))),
                    h::td(input(set::name('support[]'), set::value($item->support))),
                    h::td(input(set::name('measures[]'), set::value($item->measures))),
                    $canSave ? h::td
                    (
                        btn(icon('plus'), set::type('link'), setClass('addItem'), set::onclick('addProblemItem(this)')),
                        btn(icon('close'), set::type('link'), setClass('addItem'), set::onclick('delProblemItem(this)')),
                        btn(set::btnType('submit'), set::type('primary'), setClass('ml-2'), $lang->save)
                    ) : h::td()
                );
            }, $otherproblems) : null
        )
    );

    return div
    (
        form
        (
            setID('otherproblemsForm'),
            set::method('post'),
            set::action($this->createLink('milestone', 'saveOtherProblem')),
            set::actions(array()),
            $table,
            formHidden('projectID', $projectID),
            formHidden('executionID', $executionID)
        ),
        jsVar('canSaveOtherProblem', $canSave),
        pageJS
        (
            <<<'JAVASCRIPT'
window.addProblemItem = function(obj)
{
    const $this = $(obj);
    const $tr   = $this.closest('tr');
    $tr.after($tr.prop('outerHTML'));

    const $next = $tr.next();
    $next.find('input').val('');

    const $problemTd = $tr.closest('table').find('#problemTd');
    const rowspan    = $problemTd.attr('rowspan');
    $problemTd.attr('rowspan', Number(rowspan) + 1)
};

window.delProblemItem = function(obj)
{
    const length = $('#otherproblems tbody tr').length;
    if(length <= 3) return;

    const $this = $(obj);
    const $tr   = $this.closest('tr');
    $tr.remove();

    const $problemTd = $tr.closest('table').find('#problemTd');
    const rowspan    = $problemTd.attr('rowspan');
    $problemTd.attr('rowspan', Number(rowspan) - 1);

    if(canSaveOtherProblem)
    {
        const formData = new FormData($('#otherproblemsForm')[0]);
        $.post($.createLink('milestone', 'saveOtherProblem'), formData);
    }
};
JAVASCRIPT
            
        )
    );
};