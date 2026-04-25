<?php
namespace zin;

$app->loadLang('admin');
$imgPath = $config->webRoot . 'theme/default/images/main/featureswitcher.png';
div
(
    setClass('reminder-setting-container'),
    div
    (
        setClass('reminder-setting-card'),
        div
        (
            setClass('reminder-setting-header'),
            span(setClass('reminder-setting-title'), icon('exclamation-sign'), $lang->closedFeatureNotice)
        ),
        div
        (
            setClass('reminder-setting-tip'),
            sprintf($lang->admin->setModuleNotice, $currentModuleName)
        ),
        div(setClass('reminder-setting-switches'), h::img(set::src($imgPath))),
        div
        (
            setClass('reminder-setting-actions'),
            btn
            (
                setClass('btn primary'),
                set::url(createLink('workflowgroup', 'setmodule', 'groupID=' . $groupID)),
                $lang->admin->toSetting
            )
        )
    )
);

h::css
(
    <<<CSS
.reminder-setting-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 200px);
    padding: 40px 20px;
}

.reminder-setting-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 32px;
    max-width: 600px;
    width: 100%;
}

.reminder-setting-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.reminder-setting-header i.icon-exclamation-sign {
    color: #ff9800;
    font-size: 20px;
}

.reminder-setting-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.reminder-setting-switches {
    padding: 12px;
    border-radius: 8px;
    background: rgba(var(--color-secondary-500-rgb), 0.1);
}

.reminder-setting-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding-top: 24px;
}

.reminder-setting-actions .btn {
    min-width: 100px;
}
CSS

);