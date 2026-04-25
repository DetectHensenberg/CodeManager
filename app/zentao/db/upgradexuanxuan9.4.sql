ALTER TABLE `zt_im_message` ADD COLUMN `read` JSON NULL AFTER `data`;

ALTER TABLE `zt_im_message`
MODIFY COLUMN `contentType` enum(
    'text',
    'plain',
    'emotion',
    'image',
    'file',
    'object',
    'code',
    'merge',
    'voice'
) NOT NULL DEFAULT 'text';
