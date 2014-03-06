<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="nav-line">
    <a class="first" href="<?=SITE_URL?>?c-all.html">全部分类</a>
    
<? if(is_array($navlist)) { foreach($navlist as $nav) { ?>
    &gt; <a href="<?=SITE_URL?>?c-<?=$nav['id']?>.html"><?=$nav['name']?></a> 
    
<? } } ?>
    <? if($cid!='all') { ?>&gt; <span><?=$category['name']?></span><? } ?></div>
<div class="wrapper clearfix">
    <div class="content-left">
        <div class="modbox classifymod">
            <div class="title">
                <? if($cid!='all') { ?>                <?=$category['name']?>
                <? } else { ?>                全部分类
                <? } ?>            </div>
            <ul class="classifymod-list clearfix">
                
<? if(is_array($sublist)) { foreach($sublist as $index => $sub) { ?>
                <? if($sub['id']==$cid) { ?>                <li><? echo cutstr($sub['name'],10,''); ?><em>(<?=$sub['questions']?>)</em></li>
                <? } else { ?>                <li><a href="<?=SITE_URL?>?c-<?=$sub['id']?>.html"><? echo cutstr($sub['name'],10,''); ?></a><em>(<?=$sub['questions']?>)</em></li>
                <? } ?>                
<? } } ?>
            </ul>
        </div>
        <div id="mod-answer-list" class="mod-answer-list mt10">
            <div class="hd">
                <ul class="tab-card">
                    <? if(all==$status) { ?><li class="on"><span>全部问题</span></li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/all.html">全部问题</a></li><? } ?>                    <? if(6==$status) { ?><li class="on">推荐问题</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/6.html">推荐问题</a></li><? } ?>                    <? if(4==$status) { ?><li class="on">悬赏问题</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/4.html">悬赏问题</a></li><? } ?>                    <? if(1==$status) { ?><li class="on"><font color="#ff6600">？</font>待解决</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/1.html"><font color="#ff6600">？</font>待解决</a></li><? } ?>                    <? if(2==$status) { ?><li class="on"><font color="#1bbf00">√ </font>已解决</li><? } else { ?><li class="current_none"><a href="<?=SITE_URL?>?c-<?=$cid?>/2.html"><font color="#1bbf00">√ </font>已解决</a></li><? } ?>             
                </ul>
            </div>
            <div class="bd">
                <div class="cls-qa-table">
                    <table>
                        <tbody>
                            <tr class=""><th class="s0">标题</th><th class="s1">回答/浏览</th><th class="s2">时间</th></tr>
                            
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
                            <tr>
                                <td class="title">
                                    <div class="tit-full">
                                        <div class="wrap">
                                            <span class="gold">                
                                                <? if($question['price'] > 0) { ?>                                                <img src="<?=SITE_URL?>css/default/gold.gif" /><?=$question['price']?>
                                                <? } ?>                                            </span>
                                            <a href="<?=SITE_URL?>?q-<?=$question['id']?>.html" target="_blank" title="<?=$question['title']?>"><? echo cutstr($question['title'],50); ?></a>&nbsp;<span class="cate">[<a target="_blank" href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" title="<?=$question['category_name']?>" class="lei"><? echo cutstr($question['category_name'],14,''); ?></a>]</span>
                                        </div>
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

    <div class="aside-right">
        <? if($expertlist) { ?>        <div class="modbox mb10">
            <? if($cid=='all') { ?>            <div class="title">推荐专家</div>
            <? } else { ?>            <div class="title"><?=$category['name']?>专家</div>
            <? } ?>            <ul class="left-expert-list">
                
<? if(is_array($expertlist)) { foreach($expertlist as $expert) { ?>
                <li>
                    <div class="pic"><a title="<?=$expert['name']?>" target="_blank" href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html"><img width="50" height="50" alt="<?=$expert['username']?>" src="<?=$expert['avatar']?>"  onmouseover="pop_user_on(this, '<?=$expert['uid']?>', '');"  onmouseout="pop_user_out();"/></a></div>
                    <h3><a title="<?=$expert['name']?>" target="_blank" href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html" onmouseover="pop_user_on(this, '<?=$expert['uid']?>', 'text');"  onmouseout="pop_user_out();"><?=$expert['username']?></a></h3>
                    <span><?=$expert['answers']?>回答</span>
                    <span>300赞同</span>
                    <input type="button" value="向TA求助" class="button_4" onclick="javascript:document.location = 'http://localhost/tipask-phpask/tipask2.5/?question/add/26.html'">
                </li>
                
<? } } ?>
            </ul>
        </div>
        <? } ?>        <!-- 关注问题排行榜 -->
        <div class="modbox">
            <div class="title">关注问题排行榜</div>
            <ul class="right-list">
                <? $attentionlist=$this->fromcache('attentionlist'); ?>                
<? if(is_array($attentionlist)) { foreach($attentionlist as $index => $question) { ?>
                <? $index++; ?>                <li>
                    <? if($index<4) { ?>                    <em class="n1"><?=$index?></em>
                    <? } else { ?>                    <em class="n2"><?=$index?></em>
                    <? } ?>                    <a  title="<?=$question['title']?>" target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html"><? echo cutstr($question['title'],40,''); ?></a>
                </li>
                
<? } } ?>
            </ul>
        </div>	
    </div>
</div>
<? include template('footer'); ?>
