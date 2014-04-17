<?php

!defined('IN_TIPASK') && exit('Access Denied');

class doingcontrol extends base {

    function expertcontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load("doing");
    }

    function ondefault() {
        include template('doing');
    }

}

?>