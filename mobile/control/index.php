<?php

!defined('IN_TIPASK') && exit('Access Denied');

class indexcontrol extends base {

    function indexcontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load("question");
    }

    function ondefault() {
        $questionlist = $_ENV['question']->list_by_cfield_cvalue_status('', 0, 1, 0, $this->setting['list_indexnosolve']);
        include template('index');
    }
}

?>