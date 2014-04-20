<?php

!defined('IN_TIPASK') && exit('Access Denied');

class doingmodel {

    var $db;
    var $base;
    var $actiontable = array(
        '1' => '提出了问题',
        '2' => '回答了该问题',
        '3' => '评论该回答',
        '4' => '关注了该问题',
        '5' => '赞同了该回答',
        '6' => '对该回答进行了追问',
        '7' => '继续回答了该问题'
    );

    function doingmodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }

    function add($authorid, $author, $action, $qid, $content = '', $referid = 0, $refer_authorid = 0, $refer_content = '') {
        $content && $content = strip_tags($content);
        $refer_content && $refer_content = strip_tags($refer_content);
        $this->db->query("INSERT INTO " . DB_TABLEPRE . "doing(doingid,authorid,author,action,questionid,content,referid,refer_authorid,refer_content,createtime) VALUES (NULL,$authorid,'$author',$action,$qid,'$content',$referid,$refer_authorid,'$refer_content',{$this->base->time})");
    }

    function list_by_type($searchtype = 'all', $start = 0, $limit = 20) {
        $doinglist = array();
        $sql = "SELECT q.title,q.attentions,q.answers,q.views,q.time,d.* FROM " . DB_TABLEPRE . "doing AS d," . DB_TABLEPRE . "question AS q WHERE q.id=d.questionid";
        ($type == 'my') && $sql .= " AND d.authorid=" . $this->base->user['uid'];
        ($type == 'attentto') && $sql .=" AND q.id IN (SELECT qid FROM " . DB_TABLEPRE . "question_attention WHERE followerid=" . $this->base->user['uid'] . ")";
        $sql .=" ORDER BY d.createtime DESC LIMIT $start,$limit";
        $query = $this->db->query($sql);
        while ($doing = $this->db->fetch_array($query)) {
            $doing['question_time'] = tdate($doing['time']);
            $doing['doing_time'] = tdate($doing['createtime']);
            $doing['avatar'] = get_avatar_dir($doing['authorid']);
            $doing['actiondesc'] = $this->actiontable[$doing['action']];
            if ($doing['refer_authorid']) {
                $doing['refer_avatar'] = get_avatar_dir($doing['refer_authorid']);
            }
            $doinglist[] = $doing;
        }
        return $doinglist;
    }

    function rownum_by_type($searchtype = 'all') {
        $sql = "SELECT count(d.questionid) FROM " . DB_TABLEPRE . "doing AS d," . DB_TABLEPRE . "question AS q WHERE q.id=d.questionid";
        ($type == 'my') && $sql .= " AND d.authorid=" . $this->base->user['uid'];
        ($type == 'atentto') && $sql .=" AND q.id IN (SELECT qid FROM " . DB_TABLEPRE . "question_attention WHERE followerid=" . $this->base->user['uid'] . ")";        
        return $this->db->result_first($sql);
    }

}
