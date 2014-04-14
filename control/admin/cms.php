<?php

!defined('IN_TIPASK') && exit('Access Denied');

class admin_cmscontrol extends base {

    function admin_cmscontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load('setting');
    }

    function onsetting() {
        if (isset($this->post['submit'])) {
            foreach ($this->post as $key => $value) {
                $this->setting[$key] = $value;
            }
            $_ENV['setting']->update($this->setting);
        }
        include template("cms_setting", "admin");
    }

}
