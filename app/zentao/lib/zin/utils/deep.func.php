<?php
namespace zin\utils;

/**
 * @param object|mixed[] $data
 * @param mixed $defaultValue
 * @return mixed
 */
function deepGet(&$data, $namePath, $defaultValue = null)
{
    $names = explode('.', $namePath);
    foreach($names as $name)
    {
        if(is_object($data))
        {
            if(!isset($data->$name)) return $defaultValue;
            $data = &$data->$name;
            continue;
        }
        if(!is_array($data) || !isset($data[$name])) return $defaultValue;
        $data = &$data[$name];
    }
    return $data === null ? $defaultValue : $data;
}

/**
 * @param mixed[]|object $data
 * @param mixed $value
 */
function deepSet(&$data, $namePath, $value)
{
    $names = explode('.', $namePath);
    $lastName = array_pop($names);
    if(!empty($names))
    {
        foreach($names as $name)
        {
            if(!is_array($data) && !is_object($data)) return;

            if(is_array($data) && !isset($data[$name]))  $data[$name] = array();
            if(is_object($data) && !isset($data->$name)) $data->$name = new \stdClass();
            $data = &$data[$name];
        }
    }

    if(is_array($data))      $data[$lastName] = $value;
    elseif(is_object($data)) $data->$lastName = $value;
}
