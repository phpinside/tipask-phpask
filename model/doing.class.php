<?php

!defined('IN_TIPASK') && exit('Access Denied');

class doingmodel {

    var $db;
    var $base;

    function doingmodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }

}
