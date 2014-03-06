<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrapper mt10 clearfix">
    
<? include template('user_menu'); ?>
    <div class="user-content">
        <form name="msgform" action="<?=SITE_URL?>?message/remove/inbox.html" method="POST" onsubmit="javascript:if (!confirm('确定删除所选消息?'))
                    return false;">
            <div class="my-answerbox">
                <div class="title">我的消息<span class="flright"><input type="button" value="写消息" class="normal-button" onclick="javascript:document.location = '<?=SITE_URL?>?message/send.html'"/></span></div>            
                <div id="qa-tabcard">
                    <ul>
                        <li<? if($regular=="message/personal") { ?> class="on"<? } ?>><? if($regular=="message/personal") { ?>私人消息<? } else { ?><a href="<?=SITE_URL?>?message/personal.html">私人消息</a><? } ?></li>
                        <li<? if($regular=="message/system") { ?> class="on"<? } ?>><? if($regular=="message/system") { ?>系统消息<? } else { ?><a href="<?=SITE_URL?>?message/system.html">系统消息</a><? } ?></li>
                    </ul>
                </div>
                <ul class="q-tabmod mt10">
                    
<? if(is_array($messagelist)) { foreach($messagelist as $message) { ?>
                    <li id="msg<?=$message['id']?>" <? if($message['new']) { ?>class="new"<? } ?>>
                        <div class="avatar">
                            <a href="<?=SITE_URL?>?u-<?=$message['fromuid']?>.html" title="supermustang" target="_blank" class="pic"><img alt="<?=$message['from']?>" src="<?=$message['from_avatar']?>" onmouseover="pop_user_on(this, '<?=$message['fromuid']?>', 'text');"  onmouseout="pop_user_out();"/></a>
                        </div>
                        <div class="msgcontent">
                            <h3>
                                <input type='checkbox' value="<?=$message['id']?>" name="messageid[]"/>
                                <? if($message['fromuid']==0) { ?>                                <?=$message['subject']?>
                                <? } else { ?>                                <a href="<?=SITE_URL?>?u-<?=$message['fromuid']?>.html"><?=$message['from']?></a> 对 <a href="<?=SITE_URL?>?user/score.html">您</a> 说：
                                <? } ?>                            </h3>
                            <div class="detail" onclick="javascript:document.location = '<?=SITE_URL?>?message/view/<?=$type?>/<?=$message['fromuid']?>.html';"><? echo cutstr($message['content'],300,'') ?></div>
                            <div class="related">
                                <div class="pv"><?=$message['format_time']?></div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </li>
                    
<? } } ?>
                </ul>
                <div class="manage-box"><input type="checkbox" value="chkall" id="chkall" onclick="checkall('messageid[]');"/> 全选  <input type="submit" value="删除" name="submit" class="button_2" /></div>
                <div class="pages"><?=$departstr?></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
            $(document).ready(function() {
                $(".q-tabmod li").hover(function() {
                    $(this).addClass("li-hover");
                }, function() {
                    $(this).removeClass("li-hover");
                });
            });
</script>
<? include template('footer'); ?>
