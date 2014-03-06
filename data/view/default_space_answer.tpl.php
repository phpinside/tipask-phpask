<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrapper mt10 clearfix">
    
<? include template('space_menu'); ?>
    <div class="user-content">
        <div class="my-answerbox">
            <div class="title">我的提问</div>
            <div id="qa-tabcard">
                <ul>
                    <li<? if($status=='all') { ?> class="on"<? } ?>><? if($status=='all') { ?>全部回答<? } else { ?><a href="<?=SITE_URL?>?user/space_answer.html">全部回答</a><? } ?></li>
                    <li<? if($status==2) { ?> class="on"<? } ?>><? if($status==2) { ?>被采纳的回答<? } else { ?><a href="<?=SITE_URL?>?user/space_answer/<?=$member['uid']?>/2.html}">被采纳的回答</a><? } ?></li>
                </ul>
            </div>
            <div class="bd">
                <div class="cls-qa-table">
                    <table>
                        <tbody>
                            <tr><th class="s0">标题</th><th class="s1">已采纳</th><th class="s2">时间</th></tr>
                            
<? if(is_array($answerlist)) { foreach($answerlist as $answer) { ?>
                            <tr>
                                <td class="title">
                                    <div class="tit-full">
                                        <div class="wrap">
                                            <a target="_blank" title="<?=$answer['title']?>" href="<?=SITE_URL?>?q-<?=$answer['qid']?>.html"><? echo cutstr($answer['title'],60) ?></a>
                                        </div>
                                </td>
                                <td><? if($answer['adopttime']>0) { ?><font color="green">√</font><? } else { ?>否<? } ?></td>
                                <td><?=$answer['time']?></td>
                            </tr>                   
                            
<? } } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pages"><?=$departstr?></div>
            </div>
        </div>
    </div>
</div>
<? include template('footer'); ?>
