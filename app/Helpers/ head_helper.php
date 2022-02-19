<?php

/**
 * Head files loader
 * @author Patrick Karungari
 **/

function headscripts($path)
{
    if(is_string($path))
    {
        if(str_contains('admin/blog/create', $path)){

            echo "<script src='" .base_url($path)."'></script>\n";
        }
        //echo "<script type='text/javascript' src='". base_url($path) ."'></script>\n";
    }elseif(is_array ($path)){
        foreach ($path as $p) {
            echo "<script type='text/javascript' src='". base_url($p) ."'></script>\n";
        }
    }
}

function headlinks($path)
{
    if(is_string($path))
    {
        echo "<link rel='stylesheet' href='". base_url($path) ."'/>\n";
    }elseif(is_array ($path)){
        foreach ($path as $p) {
            echo "<link rel='stylesheet' href='". base_url($p) ."'/>\n";
        }
    }
}
?>