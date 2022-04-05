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
