<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

use Config\Database;

function get_option($key, $default = false)
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
        return true;
    }
    return false;
}

function set_option($key, $value = '')
{
    $db = Database::connect();
    $builder = $db->table('options');
    if (key_option_exists($key)) {
        $builder->where(['meta_key' => $key, 'meta_parent' => null])->update(['meta_value' => $value]);
    } else {
        @$builder->insert(['meta_key' => $key, 'meta_value' => $value]);
    }
    return true;
}

function update_option($key, $value = '')
{
    return set_option($key, $value);
}

function get_parent_option($parent, $key, $default = false)
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
    return true;
}

function update_parent_option($parent, $key, $value = '')
{
    return set_parent_option($parent, $key, $value);
}
