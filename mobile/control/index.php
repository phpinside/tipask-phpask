<?php

!defined('IN_TIPASK') && exit('Access Denied');

class indexcontrol extends base {

    function indexcontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load("question");
    }

    function ondefault() {
        $questionlist = $_ENV['question']->list_by_cfield_cvalue_status('', 0, 1, 0, $this->setting['list_indexnosolve']);        
        
        $navtitle = "问题专家";
        $page = max(1, intval($this->get[2]));
        $pagesize = intval($this->setting['list_default']/2);
        $startindex = ($page - 1) * $pagesize;
        $questionlist = $_ENV['question']->list_by_cfield_cvalue_status('', 0, 'all', 0,$pagesize);
        $rownum = $_ENV['question']->rownum_by_cfield_cvalue_status('', 0,'all');
        $departstr = page($rownum, $pagesize, $page, "index/default");
        include template('index');
    }
}

?>