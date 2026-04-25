<?php
public function excludeHtml($content, $extra = '')
{
    return $this->loadExtension('excel')->excludeHtml($content, $extra);
}

public function getRowsFromExcel($file)
{
    return $this->loadExtension('excel')->getRowsFromExcel($file);
}

public function insertImgToXlsx($imgList, $path)
{
    return $this->loadExtension('excel')->insertImgToXlsx($imgList, $path);
}
