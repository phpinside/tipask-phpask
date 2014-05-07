<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); ?>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat<?=$setting['seo_suffix']?>" target="main"><b>控制面板首页</b></a>&nbsp;&raquo;&nbsp;专家管理</div>
</div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="<?=$type?>"><?=$message?></td>
    </tr>
</table><? } ?><form action="index.php?admin_expert/add<?=$setting['seo_suffix']?>" method="post" onsubmit="return checkform(this);">
    <table width="100%" cellspacing="1" cellpadding="4" align="center" class="tableborder">
        <tbody>
            <tr class="header" ><td colspan="3">专家管理</td></tr>
            <tr class="altbg1"><td colspan="3">1、用户名必须是系统已注册用户。2、分类为系统已添加分类，多个分类用,隔开,最多不超过3个</td></tr>
            <tr>
                <td width="30%" >用户名:<input type="text" name="username"/></td>
                <td  width="40%">擅长分类ID:<input type="text" name="goodatcategory" id="categorys" size="50" onfocus="showselect()"/></td>
                <td  width="30%"><input class="button" type="submit" value="提 交" ></td>
            </tr>
        </tbody>
    </table>
</form>
<form action="index.php?admin_expert/remove<?=$setting['seo_suffix']?>" method="post">
    <table width="100%" border="0" cellpadding="4" cellspacing="1" class="tableborder">
        <tr class="header">
            <td width="10%"><input class="checkbox" value="chkall" id="chkall" onclick="checkall('delete[]')" type="checkbox" name="chkall"><label for="chkall">删除</label></td>
            <td  width="40%">用户名</td>
            <td  width="50%">擅长分类</td>
        </tr>
        
<? if(is_array($expertlist)) { foreach($expertlist as $expert) { ?>
        <tr>
            <td width="20" class="altbg2"><input class="checkbox" type="checkbox" value="<?=$expert['uid']?>" name="delete[]"></td>
            <td width="300" class="altbg2"><strong><?=$expert['username']?></strong></td>
            <td width="100" class="altbg2">
                
<? if(is_array($expert['category'])) { foreach($expert['category'] as $category) { ?>
                <a href="<?=SITE_URL?>c-<?=$category['cid']?>.html" target="_blank"><?=$category['categoryname']?></a>&nbsp;&nbsp;
                
<? } } ?>
            </td>
        </tr>
        
<? } } ?>
        <? if($departstr) { ?>        <tr class="smalltxt">
            <td class="altbg2" colspan="3"><div class="scott"><?=$departstr?></div></td>
        </tr>
        <? } ?>        <tr class="altbg1"><td colspan="3" class="altbg1"  align="left"><input type="submit" name="submit" class="button" value="提&nbsp;交" /></td></tr>
    </table>    
</form>
<div id="catedialog" title="选择分类" style="display: none">
    <div id="dialogcate">
        <table border="0" cellpadding="0" cellspacing="0" width="460px">
            <tr valign="top">
                <td width="125px">
                    <select  id="category1" class="catselect" size="8" name="category1" ></select>
                </td>
                <td align="center" valign="middle" width="25px"><div style="display: none;" id="jiantou1">>></div></td>
                <td width="125px">                                        
                    <select  id="category2"  class="catselect" size="8" name="category2" style="display:none"></select>                                        
                </td>
                <td align="center" valign="middle" width="25px"><div style="display: none;" id="jiantou2">>>&nbsp;</div></td>
                <td width="125px">
                    <select id="category3"  class="catselect" size="8"  name="category3" style="display:none"></select>
                </td>
            </tr>
            <tr>
                <td colspan="5"><span><input type="button" class="button" value="添&nbsp;&nbsp;加" onclick="add_category();"/></span></td>
            </tr>
        </table>
        <div>
            <p>已选分类</p>
            <ul id="select_category"></ul>
            <input type="button" class="button" value="确认添加" onclick="save_change();"/>
        </div>
        
    </div>
</div>

<br>
<div id="ulid" style="display: none"></div>
<script type="text/javascript">
    var category1 = <?=$categoryjs['category1']?>;
    var category2 = <?=$categoryjs['category2']?>;
    var category3 = <?=$categoryjs['category3']?>;
    $(document).ready(function() {
        init_category1(category1);
        fill_sub_category(category2, $("#category1 option:selected").val(), "category2");
        //分类选择
        $("#category1").change(function() {
            fillcategory(category2, $("#category1 option:selected").val(), "category2");
            $("#jiantou1").show();
            $("#category2").show();
        });
        $("#category2").change(function() {
            fillcategory(category3, $("#category2 option:selected").val(), "category3");
            $("#jiantou2").show();
            $("#category3").show();
        });
    });
    function init_category1(category1) {
        var selectedcid1 = $("#selectcid1").val();
        $("#category1").append("<option value='0'>根分类</option>");
        for (var i = 0; i < category1.length; i++) {
            var selected = '';
            if (selectedcid1 === category1[i][0]) {
                selected = ' selected';
            }
            $("#category1").append("<option value='" + category1[i][0] + "' " + selected + ">" + category1[i][1] + "</option>");
        }
    }
    function fill_sub_category(category2, value1, cateid) {
        var optionhtml = '<option value="0">父分类</option>';
        var selectedcid = 0;
        if (cateid === "category2") {
            selectedcid = $("#selectcid2").val();
        } else if (cateid === "category3") {
            selectedcid = $("#selectcid3").val();
        }
        for (var i = 0; i < category2.length; i++) {
            if (value1 === category2[i][0]) {
                var selected = '';
                if (selectedcid === category2[i][1]) {
                    selected = ' selected';
                    $("#" + cateid).show();
                }
                optionhtml += "<option value='" + category2[i][1] + "' " + selected + ">" + category2[i][2] + "</option>";
            }
        }
        $("#" + cateid).html(optionhtml);
    }
    function checkform(form) {
        var username = form.username.value;
        var goodatcate = form.goodatcategory.value;
        if (username == '' || goodatcate == '') {
            alert("用户名或分类不能为空");
            return false;
        }
        return true;
    }

    function showselect() {
        $("#catedialog").dialog({
            width: 520,
            modal: true,
            resizable: false,
            position:{my:"bottom-60"}
        });
        $("#catedialog").dialog("open");
    }

    function add_category() {
        var current = null;
        var select_category1 = $("#category1 option:selected");
        var select_category2 = $("#category2 option:selected");
        var select_category3 = $("#category3 option:selected");
        if(select_category3.val()){
            current = select_category3
        }else if(select_category2.val()){
            current = select_category2
        }else if(select_category1.val()){
            current = select_category1;
        }
        if(!current){
            alert("您还未选择任何分类!");
            return false;
        }
        $("#select_category").append('<li id="'+current.val()+'" style="list-style-type: none;">'+current.html()+'   <a href="javascript:void(0)" onclick="remove_category('+current.val()+')">删除</a></li>');        
    }
    function remove_category(cid) {
        $("#"+cid).remove();
    }
    
    function save_change(){
        var categoryids = "";
        $("#select_category li").each(function(){
            categoryids+=" "+$(this).attr("id");
        });
        $("#categorys").val(categoryids);
        $("#catedialog").dialog("close");
    }
</script>
<? include template(footer,admin); ?>
