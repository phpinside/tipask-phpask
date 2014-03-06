<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/editor/ueditor.config.js" type="text/javascript"></script> 
<script src="<?=SITE_URL?>js/editor/ueditor.all.js" type="text/javascript"></script> 
<div class="wrapper mt10 clearfix">
    
<? include template('user_menu'); ?>
    <div class="user-content">
        <div class="my-answerbox">
            <div class="title">我的消息<span class="flright"><input type="button" value="写消息" class="normal-button" onclick="javascript:document.location = '<?=SITE_URL?>?message/send.html'"/></span></div>            
            <div id="qa-tabcard">
                <ul>
                    <li<? if($type=="personal") { ?> class="on"<? } ?>><? if($type=="personal") { ?>私人消息<? } else { ?><a href="<?=SITE_URL?>?message/personal.html">私人消息</a><? } ?></li>
                    <li<? if($type=="system") { ?> class="on"<? } ?>><? if($type=="system") { ?>系统消息<? } else { ?><a href="<?=SITE_URL?>?message/system.html">系统消息</a><? } ?></li>
                </ul>
            </div>
            <form name="msgform" action="<?=SITE_URL?>?message/remove/inbox.html" method="POST" onsubmit="javascript:if (!confirm('确定删除所选消息?'))
                        return false;">
                <ul class="q-tabmod mt10">
                    
<? if(is_array($messagelist)) { foreach($messagelist as $message) { ?>
                    <li>
                        <div class="avatar">
                            <a href="<?=SITE_URL?>?u-<?=$message['fromuid']?>.html" title="supermustang" target="_blank" class="pic"><img alt="<?=$message['from']?>" src="<?=$message['from_avatar']?>" onmouseover="pop_user_on(this, '<?=$message['fromuid']?>', 'text');"  onmouseout="pop_user_out();"/></a>
                        </div>
                        <div class="msgcontent">
                            <h3>
                                <input type='checkbox' value="<?=$message['id']?>" name="messageid[]"/>
                                <? if($message['fromuid']==$user['uid']) { ?>  
                                <a href="<?=SITE_URL?>?user/score.html">您</a> 对 <a href="<?=SITE_URL?>?u-<?=$message['fromuid']?>.html"><?=$message['touser']?></a> 说：
                                <? } else { ?>                                <a href="<?=SITE_URL?>?u-<?=$message['fromuid']?>.html"><?=$message['from']?></a> 对 <a href="<?=SITE_URL?>?user/score.html">您</a> 说：
                                <? } ?>                                <?=$message['subject']?>
                            </h3>
                            <p><?=$message['content']?></p>
                            <div class="related">
                                <div class="pv"><?=$message['format_time']?></div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </li>
                    
<? } } ?>
                    <li><div class="manage-box"><input type="checkbox"value="chkall" id="chkall" onclick="checkall('messageid[]');"/> 全选  <input type="submit" value="删除" name="submit" class="button_2" /></div></li>
                </ul>
            </form>
            <? if('personal'==$type) { ?>            <ul class="q-tabmod mt10">
                <form name="commentform" action="<?=SITE_URL?>?message/send.html" method="POST" onsubmit="return check_form();">
                    <li>
                        <div class="avatar">
                            <span class="pic"><img alt="<?=$user['username']?>" src="<?=$user['avatar']?>"/></span>
                        </div>
                        <div class="msgcontent">
                            <script type="text/plain" id="content" name="content" style="height: 122px;"></script>
                            <script type="text/javascript">UE.getEditor('content');</script>
                            <div class="related">
                                <input type="text" class="code-input" id="code" name="code" onblur="check_code()">&nbsp;<span class="verifycode"><img src="<?=SITE_URL?>?user/code.html" onclick="javascript:updatecode();" id="verifycode"></span><a href="javascript:updatecode();" class="changecode">&nbsp;换一个</a>
                                <span id="codetip"></span>
                                <input type="hidden" name="username" value="<?=$fromuser['username']?>" />
                                <input type="submit" value="提&nbsp;交" class="normal-button flright" name="submit">
                            </div>
                        </div>
                        <div class="clr"></div>
                    </li>
                </form>
            </ul>
            <? } ?>            <div class="pages"><?=$departstr?></div>
        </div>
    </div>
</div>
<script type="text/javascript">
function check_form() {
    if ($.trim(UE.getEditor('content').getPlainTxt()) == '') {
        alert("消息内容不能为空!");
        return false;
    }
    return true;
}
</script>
<? include template('footer'); ?>
