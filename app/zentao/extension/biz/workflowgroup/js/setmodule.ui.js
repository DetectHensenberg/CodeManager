function changeModule(event)
{
    const id = $(event.target).attr('id');
    if($(event.target).prop('checked'))
    {
        checkRelated(id, 'open');
    }
    else
    {
        checkRelated(id, 'close');
    }
};

/**
 * 设置模块的checkbox和hidden input状态
 * @param {string} id - 模块ID
 * @param {boolean} checked - 是否选中
 */
function setModuleState(id, checked)
{
    const checkboxSelector = `#${id}`;
    $(checkboxSelector).prop('checked', checked);
}

/**
 * 检查模块是否已启用
 * @param {string} id - 模块ID
 * @returns {boolean} 是否已启用
 */
function isModuleEnabled(id)
{
    return $(`#${id}`).prop('checked');
}

/**
 * 显示依赖关系确认对话框
 * @param {string} message - 确认消息
 * @param {Function} onConfirm - 确认回调
 * @param {Function} onCancel - 取消回调
 */
function showDependencyConfirm(message, onConfirm, onCancel)
{
    zui.Modal.confirm(
    {
        message: message,
        icon: 'icon-exclamation-sign',
        iconClass: 'warning-pale rounded-full icon-2x'
    }).then((res) =>
    {
        if(res)
        {
            if(onConfirm) onConfirm();
            return false;
        }
        if(onCancel) onCancel();
    });
}

window.checkRelated = function(id, type)
{
    if(type === 'open')
    {
        // 开启 项目变更 时，需要确保 交付物 已开启
        if(id == 'feature-cm')
        {
            if(!isModuleEnabled('feature-deliverable'))
            {
                const message = openDependFeature.replace('{source}', cmLang).replace('{target}', deliverableLang);
                showDependencyConfirm(
                    message,
                    () => setModuleState('feature-deliverable', true),
                    () => setModuleState('feature-cm', false)
                );
                return false;
            }
        }
        // 开启 项目变更 时，需要确保 交付物 和 基线 都已开启
        else if(id == 'feature-change')
        {
            const deliverableEnabled = isModuleEnabled('feature-deliverable');
            const cmEnabled          = isModuleEnabled('feature-cm');

            if(!deliverableEnabled || !cmEnabled)
            {
                let message = openDependFeature.replace('{source}', changeLang);
                const missingLangs = [];

                if(!deliverableEnabled) missingLangs.push(deliverableLang);
                if(!cmEnabled) missingLangs.push(cmLang);

                message = message.replace('{target}', missingLangs.join(','));

                showDependencyConfirm(
                    message,
                    () =>
                    {
                        if(!deliverableEnabled) setModuleState('feature-deliverable', true);
                        if(!cmEnabled) setModuleState('feature-cm', true);
                    },
                    () => setModuleState('feature-change', false)
                );
                return false;
            }
        }
    }
    else
    {
        // 关闭 交付物 时，如果 项目变更 或 基线 已开启，需要提示关闭它们
        if(id == 'feature-deliverable')
        {
            const changeEnabled = isModuleEnabled('feature-change');
            const cmEnabled     = isModuleEnabled('feature-cm');

            if(changeEnabled || cmEnabled)
            {
                let message = closeDependFeature.replace('{source}', deliverableLang);
                const activeLangs = [];

                if(changeEnabled) activeLangs.push(changeLang);
                if(cmEnabled) activeLangs.push(cmLang);

                message = message.replace('{target}', activeLangs.join(','));

                showDependencyConfirm(
                    message,
                    () =>
                    {
                        if(changeEnabled) setModuleState('feature-change', false);
                        if(cmEnabled) setModuleState('feature-cm', false);
                    },
                    () => setModuleState('feature-deliverable', true)
                );
            }
        }
        // 关闭 基线 时，如果 项目变更 已开启，需要提示关闭 项目变更
        else if(id == 'feature-cm')
        {
            if(isModuleEnabled('feature-change'))
            {
                const message = closeDependFeature.replace('{source}', cmLang).replace('{target}', changeLang);
                showDependencyConfirm(
                    message,
                    () => setModuleState('feature-change', false),
                    () => setModuleState('feature-cm', true)
                );
            }
        }
    }
}