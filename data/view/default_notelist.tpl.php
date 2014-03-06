<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="nav-line">
    <a class="first" href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
    &gt; <span>公告列表</span>
</div>
<div class="wrapper clearfix">
    <div class="content-left">
        <div id="mod-answer-list" class="mod-answer-list">
            <div class="bd">
                <div class="cls-qa-table">
                    <table>
                        <tbody>
                            <tr class=""><th class="s0">标题</th><th class="s1">评论/浏览</th><th class="s2">时间</th></tr>
                            
<? if(is_array($notelist)) { foreach($notelist as $index => $note) { ?>
                            <tr>
                                <td class="title">
                                    <div class="tit-full">
                                        <div class="wrap">
                                            <a <? if($note['url']) { ?> href="<?=$note['url']?>"  <? } else { ?>  href="<?=SITE_URL?>?note/view/<?=$note['id']?>.html" <? } ?> target="_blank" title="<?=$note['title']?>"><? echo cutstr($note['title'],50); ?></a>&nbsp;
                                        </div>
                                    </div>
                                </td>
                                <td><?=$note['comments']?>/<?=$note['views']?></td>
                                <td><?=$note['format_time']?></td>
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
        <!-- 关注问题排行榜 -->
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
