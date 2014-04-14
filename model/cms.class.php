<?php

!defined('IN_TIPASK') && exit('Access Denied');

class cmsmodel {

    var $dbcms;
    var $db;
    var $base;

    function cmsmodel(&$base) {
        $this->base = $base;
        $this->db = new db($this->base->setting['cms_db_server'], $this->base->setting['cms_db_user'], $this->base->setting['cms_db_password'], $this->base->setting['cms_db_name'], DB_CHARSET, DB_CONNECT);
    }

    function get_list() {
        $articlelist = array();
        $query = $this->db->query("SELECT * FROM " . $this->base->setting['cms_db_article_tbname'] . " WHERE 1=1 " . tstripslashes($this->base->setting['cms_db_article_sort']));
        while ($article = $this->db->fetch_array($query)) {
            $article['title'] = $article[$this->base->setting['cms_db_article_field']];
            $article['href'] = str_replace("{articleid}", $article[$this->base->setting['cms_db_article_primary']], $this->base->setting['cms_article_url']);
            $articlelist[] = $article;
        }
        return $articlelist;
    }

}
