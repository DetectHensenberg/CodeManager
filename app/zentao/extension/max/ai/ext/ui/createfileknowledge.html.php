<?php
namespace zin;

formPanel
(
    setClass('add-file-form'),
    set::title($lang->ai->knowledgeLibs->addFileLabel),
    set::submitBtnText($lang->save),
    fileSelector(set::maxFileCount(1), set::mode('box'), set::name('files'), set::accept($config->ai->myknowledgelib->acceptFileTypes), set::tip(sprintf($lang->ai->knowledgeLibs->tips->file, strtoupper(ini_get('upload_max_filesize')))))
);
