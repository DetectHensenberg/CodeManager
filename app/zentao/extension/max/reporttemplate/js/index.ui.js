/**
 * 点击模板卡片。
 * Click template card.
 *
 * @param  event
 * @param  url
 * @return null
 */
window.clickTemplateCard = function(event, url)
{
    const target = $(event.target);
    if(target.hasClass('icon') || target.hasClass('dropdown') || target.hasClass('toolbar')) return;

    openUrl(url);
}
