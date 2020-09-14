<?php

/**
 * 获取访问者ip
 */


function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){//check ip from share internet
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){//to check ip is pass from proxy
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getTree($arr,$id='id',$pid='topic_id',$child = 'children',$root=null)
{
    $tree = [];
    foreach ($arr as $key => $val) {
        if ($val[$pid] == $root) {
            //获取当前$pid所有子类
            unset($arr[$key]);
            if (!empty($arr)) {
                $child = getTree($arr, $id, $pid, $child, $val[$id]);
                if (!empty($child)) {
                    $val['children'] = $child;
                }
            }
            $tree[] = $val;
        }
    }
    return $tree;
}
