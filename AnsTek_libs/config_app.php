<?php

define("PATH_BASE",$_SERVER['DOCUMENT_ROOT'] . "/drlook_concurso/");
define("PATH_URL","http://localhost:83/drlook_concurso/");

function getPath($file,$inc){

    $inc = str_replace(array('/'),'\\',$inc);
    
    $fa = explode('\\',$file);
    $oa = explode('\\',$inc);
    unset($fa[count($fa) - 1]);
    unset($oa[count($oa) - 1]);
    
    $ret = '';
     
    krsort($oa);
    krsort($fa);
     
    foreach($fa as $k => $v){
         if($v != $oa[$k] ){
            $ret .= '../';
        }
        else{
            unset($oa[$k]);
            unset($fa[$k]);
        }
    }
    
    ksort($oa);
    $dif = implode('/',$oa);
    
    return str_replace('//','/',$ret.$dif.'/'.basename($inc));
}

?>