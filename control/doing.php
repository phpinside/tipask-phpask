<?php

!defined('IN_TIPASK') && exit('Access Denied');

class doingcontrol extends base {

    function doingcontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load("doing");
    }

    function ondefault() {
        $type = 'all';
        $recivetype = $this->get[2];
        if($recivetype){
            $type = $recivetype;
        }
        $page = max(1, intval($this->get[3]));
        $pagesize = 3;
        $startindex = ($page - 1) * $pagesize;
        $doinglist = $_ENV['doing']->list_by_type($type,$startindex,$pagesize);
        $rownum = $_ENV['doing']->rownum_by_type($type);
        $departstr = page($rownum, $pagesize, $page, "doing/default/$type");
        include template('doing');
    }

}

?>