<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); ?>
<script type="text/javascript">g_site_url = '<?=SITE_URL?>';
    g_prefix = '<?=$setting['seo_prefix']?>';
    g_suffix = '{<?=$setting?>['
    seo_suffix']}';</script>
<script src="<?=SITE_URL?>js/editor/ueditor.config.js" type="text/javascript"></script> 
<script src="<?=SITE_URL?>js/editor/ueditor.all.js" type="text/javascript"></script> 
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat<?=$setting['seo_suffix']?>" target="main"><b>控制面板首页</b></a>&nbsp;&raquo;&nbsp;站点设置</div>
</div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="<?=$type?>"><?=$message?></td>
    </tr>
</table><? } ?><form action="index.php?admin_setting/base<?=$setting['seo_suffix']?>" method="post">
    <a name="基本设置"></a>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
        <tr class="header">
            <td colspan="2">站点设置</td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>网站名称:</b><br>
                <span class="smalltxt">网站名称，将显示在页面Title处</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['site_name']?>" name="site_name"></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>网站注册协议:</b><br>
                <span class="smalltxt">网站注册协议，注册的时候需要同意使用协议才能注册</span></td>
            <td class="altbg2">
                <script type="text/plain" id="register_clause" name="register_clause" style="width:610px;height:300px;"><?=$setting['register_clause']?></script>
                <script type="text/javascript">UE.getEditor('register_clause',{toolbars: [["autotypeset","link","unlink","fullscreen"]]});</script>
            </td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>网站备案号:</b><br>
                <span class="smalltxt">格式类似“京ICP证030173号”，它将显示在页面底部，没有请留空</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['site_icp']?>" name="site_icp"></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>默认模板:</b><br>
                <span class="smalltxt">设置网站的前台的默认模板</span></td>
            <td class="altbg2">
                <select name="tpl_dir" >
                    
<? if(is_array($tpllist)) { foreach($tpllist as $value) { ?>
                    <option class="select" value="<?=$value?>" <? if($value==$setting['tpl_dir']) { ?> selected <? } ?> ><?=$value?></option>
                    
<? } } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>第三方分享代码:</b><br><span class="smalltxt">在问题查看页底部可以分享问题</span></td>
            <td class="altbg2"><textarea class="area" name="question_share" cols="48" rows="4"><?=$setting['question_share']?></textarea></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>网站统计代码:</b><br><span class="smalltxt">页面底部可以显示第三方统计，如google统计代码或者51la统计等</span></td>
            <td class="altbg2"><textarea class="area" name="site_statcode" cols="48" rows="4"><?=$setting['site_statcode']?></textarea></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>列表页大小:</b><br><span class="smalltxt">全局分页数据显示大小</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['list_default']?>" name="list_default"></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>系统缓存时间（分钟）:</b><br><span class="smalltxt">如果设置为0，表示不缓存相关数据，包括首页缓存、积分排行榜等</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['index_life']?>" name="index_life"></td>
        </tr>   
        <tr>
            <td class="altbg1" width="45%"><b>问题过期时间（天）:</b><br><span class="smalltxt">问题过期时间至少是3天，可根据网站活跃度自行调整</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['overdue_days']?>" name="overdue_days" maxlength="4"></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>分类问题数目统计(分钟):</b><br><span class="smalltxt">建议设置为60，如果设置为0，表示实时统计，强烈建议不要实时统计，以免服务器压力过大。</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['sum_category_time']?>" name="sum_category_time"></td>
        </tr>   
        <tr>
            <td class="altbg1" width="45%"><b>在线用户统计时长(分钟):</b><br><span class="smalltxt">建议设置为30，最小不要少于5，否则后果自负。</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['sum_onlineuser_time']?>" name="sum_onlineuser_time"></td>
        </tr>   
        <tr>
            <td class="altbg1" width="45%"><b>RSS更新时间（分钟）:</b><br><span class="smalltxt">时间越短则资料实时性就越高，但会加重服务器负担，通常可设置为 30～180 范围内的数值</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['rss_ttl']?>" name="rss_ttl"></td>
        </tr>   
        <tr>
            <td class="altbg1" width="45%"><b>通知方式:</b><br>
                <span class="smalltxt">当问题状态改变，通知相关的人</span></td>
            <td class="altbg2">
                <input class="checkbox" type="checkbox" <? if($setting['notify_message']) { ?>checked<? } ?> value="1" name="notify_message">&nbsp;站内消息&nbsp;&nbsp;
                       <input class="checkbox" type="checkbox" <? if($setting['notify_mail']) { ?>checked<? } ?> value="1" name="notify_mail">&nbsp;邮件通知&nbsp;&nbsp;
            </td>
        </tr>
    </table>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
        <tr class="header">
            <td colspan="2">防灌水设置</td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>允许直接提问:</b><br>
                <span class="smalltxt">若不需要审核问题，用户的提问就可以直接出现在首页或者列表页</span></td>
            <td class="altbg2">
                <input class="radio" type="radio" <? if(0==$setting['verify_question']) { ?>checked<? } ?> value="0" name="verify_question" >&nbsp;全部不需要审核&nbsp;&nbsp;
                       <input class="radio" type="radio" <? if(1==$setting['verify_question']) { ?>checked<? } ?> value="1" name="verify_question" >&nbsp;提问需要审核&nbsp;&nbsp;
                       <input class="radio" type="radio" <? if(2==$setting['verify_question']) { ?>checked<? } ?> value="2" name="verify_question" >&nbsp;回答问题需要审核&nbsp;&nbsp;
                       <input class="radio" type="radio" <? if(3==$setting['verify_question']) { ?>checked<? } ?> value="3" name="verify_question" >&nbsp;全部需要审核
            </td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>问题补充次数限制:</b><br>
                <span class="smalltxt">设置问题补充的最大次数</span></td>
            <td class="altbg2"><input type="text" name="apend_question_num" value="<?=$setting['apend_question_num']?>" /></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>关是否允许发站外URL:</b><br>
                <span class="smalltxt">是否允许内容包含URL，合理的设置可以有效的减少广告帖的量</span></td>
            <td class="altbg2">
                <input  class="radio" type="radio" <? if(0==$setting['allow_outer']) { ?>checked<? } ?> value="0" name="allow_outer">&nbsp;禁止发表&nbsp;&nbsp;
                        <input  class="radio" type="radio" <? if(1==$setting['allow_outer']) { ?>checked<? } ?> value="1" name="allow_outer">&nbsp;允许发表，但所提问题进入审核&nbsp;&nbsp;
                        <input  class="radio" type="radio" <? if(2==$setting['allow_outer']) { ?>checked<? } ?> value="2" name="allow_outer">&nbsp;允许发表，但不解析&nbsp;&nbsp;
                        <input  class="radio" type="radio" <? if(3==$setting['allow_outer']) { ?>checked<? } ?> value="3" name="allow_outer">&nbsp;允许发表，并正常解析
            </td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>只允许专家回答问题:</b><br>
                <span class="smalltxt">该选项选中之后只允许专家回答问题</span></td>
            <td class="altbg2"><input class="radio" type="radio" <? if($setting['allow_expert']) { ?>checked<? } ?> value="1" name="allow_expert">&nbsp;是&nbsp;&nbsp;<input class="radio" type="radio" <? if(!$setting['allow_expert']) { ?>checked<? } ?> value="0" name="allow_expert">&nbsp;否</td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>启用验证码:</b><br>
                <span class="smalltxt">验证码可以避免恶意注册及恶意灌水，请选择需要打开验证码的操作</span></td>
            <td class="altbg2">
                <input class="checkbox" type="checkbox" <? if($setting['code_register']) { ?>checked<? } ?> value="1" name="code_register">&nbsp;注册&nbsp;&nbsp;
                       <input class="checkbox" type="checkbox" <? if($setting['code_login']) { ?>checked<? } ?> value="1" name="code_login">&nbsp;登录&nbsp;&nbsp;
                       <input class="checkbox" type="checkbox" <? if($setting['code_ask']) { ?>checked<? } ?> value="1" name="code_ask">&nbsp;提问和回答&nbsp;&nbsp;
                       <input class="checkbox" type="checkbox" <? if($setting['code_message']) { ?>checked<? } ?> value="1" name="code_message">&nbsp;站内消息
            </td>
        </tr>
    </table>
    <br>
    <center><input type="submit" class="button" name="submit" value="提 交"></center><br>
</form>
<br>
<? include template(footer,admin); ?>
