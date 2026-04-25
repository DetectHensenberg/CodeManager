window.changeDeliverable = function(e) {
    const deliverable = e.target.value;
    const url = $.createLink('project', 'createDeliverable', `projectID=${projectID}&deliverableID=${deliverable}`);
    loadTarget(url, '.createdeliverable-body');
}