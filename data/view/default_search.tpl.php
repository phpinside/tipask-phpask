<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrapper clearfix">
    <div id="container">
        <div class="srsite">
            <? if($rownum) { ?>            <div class="resultinfo mt15"><?=$setting['site_name']?>为您找到相关结果约<?=$rownum?>个</div>
            <? } ?>            <? if($corrected_words) { ?>            <div class="resultinfo mt15">
                您要找的是不是:
                
<? if(is_array($corrected_words)) { foreach($corrected_words as $correct_word) { ?>
                <a href="<?=SITE_URL?>?question/search/<?=$correct_word?>.html"><?=$correct_word?></a>
                
<? } } ?>
            </div>
            <? } ?>            <div id="qa-tabcard" style="width:570px;">
                <ul>
                    <? if(1==$status) { ?><li class="on">全部问题</li><? } else { ?><li><a href="<?=SITE_URL?>?question/search/<?=$word?>.html">全部问题</a></li><? } ?>                    <? if(2==$status) { ?><li class="on">已解决<? } else { ?><li><a href="<?=SITE_URL?>?question/search/<?=$word?>/2.html">已解决</a></li><? } ?>                </ul>
            </div>
            <? if($questionlist) { ?>            <div clsss="clearfix" id="qaresult">
                <ul class="qa-list">
                    
<? if(is_array($questionlist)) { foreach($questionlist as $question) { ?>
                    <li class="item">
                        <div class="qa-i-hd">
                            <h3><a href="<?=SITE_URL?>?q-<?=$question['id']?>.html" target="_blank"><?=$question['title']?></a><? if(in_array($question['status'],array(2,6))) { ?><img title="已解决" src="<?=SITE_URL?>css/default/solved.gif" /><? } ?></h3>
                        </div>
                        <div class="qa-i-bd"><? echo cutstr($question['description'],250,'...'); ?></div>
                        <div class="qa-i-ft"><span class="cate"><a href="<?=SITE_URL?>?c-<?=$question['cid']?>.html" target="_blank" text="qaresult-cate"><?=$question['category_name']?></a></span> - 提问人:<a href="<?=SITE_URL?>?u-<?=$question['authorid']?>.html"><?=$question['author']?></a> - <?=$question['answers']?>个回答 - 提问时间: <?=$question['format_time']?></div>
                    </li>
                    
<? } } ?>
                </ul>
            </div>
            <? } else { ?>            <div id="no-result">
                <p>抱歉，未找到和 <span>"</span><em><?=$word?></em><span>"</span>相关的网页。</p>
                <strong>建议您：</strong>
                <ul>
                    <li><span>检查输入是否正确</span></li>
                    <li><span>简化查询词或尝试其他相关词</span></li>
                    <li><span>阅读</span><a target="_blank" href="<?=SITE_URL?>?index/help.html">帮助</a><span>或</span><a target="_blank" href="http://info.so.360.cn/feedback.html">提出意见反馈</a></li>
                </ul>
            </div>
            <? } ?>            <? if($departstr) { ?>            <div class="pages"><?=$departstr?></div>
            <? } ?>            <div class="mod-relation">
                <div id="rs">
                    <table>
                        <tbody>
                            <tr>
                                <th class="tt" rowspan="2">相关搜索</th>
                                
<? if(is_array($related_words)) { foreach($related_words as $index => $word) { ?>
                                <? if($index<=3) { ?>                                <th><a href="<?=SITE_URL?>?question/search/<?=$word?>.html"><?=$word?></a></th>
                                <td></td>
                                <? } ?>                                
<? } } ?>
                            </tr>
                            <tr><th><a href="<?=SITE_URL?>?question/search/<?=$related_words['4']?>.html"><?=$related_words['4']?></a></th><td></td><th><a href="<?=SITE_URL?>?question/search/<?=$related_words['5']?>.html"><?=$related_words['5']?></a></th><td></td><th><a href="<?=SITE_URL?>?question/search/<?=$related_words['6']?>.html"><?=$related_words['6']?></a></th><td></td><th><a href="<?=SITE_URL?>?question/search/<?=$related_words['7']?>.html"><?=$related_words['7']?></a></th><td></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="hot-search">
            <div class="hd"><h3>热门搜索</h3></div>
            <div class="bd">
                <ul>
                    
<? if(is_array($hot_words)) { foreach($hot_words as $hostword) { ?>
                    <li><a href="<?=SITE_URL?>?question/search/<?=$hostword?>.html"><?=$hostword?></a></li>
                    
<? } } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<? include template('footer'); ?>
