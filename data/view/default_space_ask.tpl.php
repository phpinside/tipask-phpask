<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrapper mt10 clearfix">
    
<? include template('space_menu'); ?>
    <div class="user-content">
        <div class="my-answerbox">
            <div class="title">我的提问</div>
            <div id="qa-tabcard">
                <ul>
                    <li<? if($status==1) { ?> class="on"<? } ?>><? if($status==1) { ?>待解决问题<? } else { ?><a href="<?=SITE_URL?>?user/space_ask/<?=$member['uid']?>.html">待解决问题</a><? } ?></li>
                    <li<? if($status==2) { ?> class="on"<? } ?>><? if($status==2) { ?>已解决问题<? } else { ?><a href="<?=SITE_URL?>?user/space_ask/<?=$member['uid']?>/2.html">已解决问题</a><? } ?></li>
                </ul>
            </div>

            <div class="bd">
                <div class="cls-qa-table">
                    <table>
                        <tbody>
                            <tr><th class="s0">标题</th><th class="s1">回答/浏览</th><th class="s2">时间</th></tr>
                            
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
                            <tr>
                                <td class="title">
                                    <div class="tit-full">
                                        <div class="wrap">
                                            <? if($question['price'] > 0) { ?>                                            <span class="gold"><img src="<?=SITE_URL?>css/default/gold.gif"><?=$question['price']?></span>
                                            <? } ?>                                            <a href="<?=SITE_URL?>?q-<?=$question['id']?>.html" target="_blank" title="<?=$question['title']?>"><? echo cutstr($question['title'],60) ?></a>
                                            <a title="<?=$question['category_name']?>" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" class="type" target="_blank">[<?=$question['category_name']?>]</a>                                        </div>
                                    </div>
                                </td>
                                <td><?=$question['answers']?>/<?=$question['views']?></td>
                                <td><?=$question['format_time']?></td>
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
