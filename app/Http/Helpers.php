<?php
if ( ! function_exists('findAndReplace'))
{
    function findAndReplace($string, $query)
    {
        return str_ireplace($query, "<span class='replace-it'>" . $query . "</span>", $string);
    }
}

if ( ! function_exists('errorText'))
{
    function errorText($string)
    {
        return "<span class='error-text'>" . $string . "</span>";
    }
}

if ( ! function_exists('labelText'))
{
    function labelText($string, $type)
    {
        return "<span class='label label-" . $type . "'>" . $string . "</span>";
    }
}