<?php

!defined('IN_TIPASK') && exit('Access Denied');

class answercontrol extends base {

    function __construct(& $get, & $post) {
        parent::__construct($get, $post);
        $this->load('answer');
        $this->load('answer_comment');
        $this->load('question');
    }

    function onviewcomment() {
        $answerid = intval($this->get[2]);
        $commentlist = $_ENV['answer_comment']->get_by_aid($answerid, 0, 50);
        $commentstr = '<li class="loading">暂无评论 :)</li>';
        if ($commentlist) {
            $commentstr = "";
            $admin_control = ($this->user['grouptype'] == 1) ? '<span class="span-line">|</span><a href="javascript:void(0)" onclick="deletecomment({commentid},{answerid});">删除</a>' : '';
            foreach ($commentlist as $comment) {
                $viewurl = urlmap('user/space/' . $comment['authorid'], 2);
                if ($admin_control) {
                    $admin_control = str_replace("{commentid}", $comment['id'], $admin_control);
                    $admin_control = str_replace("{answerid}", $comment['aid'], $admin_control);
                }
                $commentstr.='<li><div class="other-comment"><a href="' . $viewurl . '" title="' . $comment['author'] . '" target="_blank" class="pic"><img width="30" height="30" src="' . $comment['avatar'] . '"  onmouseover="pop_user_on(this, \'' . $comment['authorid'] . '\', \'\');"  onmouseout="pop_user_out();"></a><p><a href="' . $viewurl . '" title="' . $comment['author'] . '" target="_blank">' . $comment['author'] . '</a>：' . $comment['content'] . '</p></div><div class="replybtn"><span class="times">' . $comment['format_time'] . '</span>' . $admin_control . '</div></li>';
            }
        }
        exit($commentstr);
    }

    function onaddcomment() {
        if (isset($this->post['content'])) {
            $content = $this->post['content'];
            $answerid = intval($this->post['answerid']);
            $_ENV['answer_comment']->add($answerid, $content);
            exit('1');
        }
    }

    function ondeletecomment() {
        if (isset($this->post['commentid'])) {
            $commentid = intval($this->post['commentid']);
            $answerid = intval($this->post['answerid']);
            $_ENV['answer_comment']->remove($commentid,$answerid);
            exit('1');
        }
    }

}

?>
