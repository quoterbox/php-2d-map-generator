<?php
if(!function_exists('debug')){

    function debug($message) : void
    {
        messInfo($message);
        die("DEBUG END");
    }

}

if(!function_exists('messInfo')) {

    function messInfo($text): void
    {
        echo '<pre>';
        print_r($text);
        echo '</pre>';
    }

}

if(!function_exists('sortArrayByFieldName')) {

    function sortArrayByFieldName($a, $b): int
    {
        return mb_strtolower($a->getName()) <=> mb_strtolower($b->getName());
    }

}

if(!function_exists('sortArrayById')) {

    function sortArrayById($a, $b): int
    {
        return $a['id'] <=> $b['id'];
    }

}
