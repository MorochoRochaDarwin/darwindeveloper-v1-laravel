<?php
/**
 * Created by PhpStorm.
 * User: DARWIN
 * Date: 5/10/2016
 * Time: 15:32
 */


function tourl($text){
    $text_tmp=rawurlencode($text);

    $text_tmp=strtolower($text_tmp);
    $text_tmp=str_replace('%20','-',$text_tmp);
    return $text_tmp;
}


function muri(){
    return "http://$_SERVER[HTTP_HOST]";
}