<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */


use Config\Database;

function get_option($key, $default = FALSE)
{
    $db = Database::connect();
    $result = $db->table('options')->getWhere(['meta_key' => $key])->getRow();
    if (isset($result->meta_value)) {
        return $result->meta_value;
    }

    return $default;
}

function key_option_exists($key)
{
    $db = Database::connect();
    $result = $db->table('options')->where(['meta_key' => $key])->countAllResults();
    if ($result > 0) {
        return TRUE;
    }
    return FALSE;
}

function set_option($key, $value = '')
{
    $db = Database::connect();
    $builder = $db->table('options');
    if (key_option_exists($key)) {
        $builder->where(['meta_key' => $key, 'meta_parent' => NULL])->update(['meta_value' => $value]);
    } else {
        @$builder->insert(['meta_key' => $key, 'meta_value' => $value]);
    }
    return TRUE;
}

function update_option($key, $value = '')
{
    return set_option($key, $value);
}

function get_parent_option($parent, $key, $default = FALSE)
{
    $db = Database::connect();
    $result = $db->table('options')->getWhere(['meta_parent' => $parent, 'meta_key' => $key])->getRow();
    if (isset($result->meta_value)) {
        return $result->meta_value;
    }

    return $default;
}

function set_parent_option($parent, $key, $value = '')
{
    $db = Database::connect();
    $builder = $db->table('options');
    if (key_option_exists($key)) {
        $builder->where(['meta_key' => $key, 'meta_parent' => $parent])->update(['meta_value' => $value]);
    } else {
        @$builder->insert(['meta_parent' => $parent, 'meta_key' => $key, 'meta_value' => $value]);
    }
    return TRUE;
}

function update_parent_option($parent, $key, $value = '')
{
    return set_parent_option($parent, $key, $value);
}