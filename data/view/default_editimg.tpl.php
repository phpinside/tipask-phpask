<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrapper mt10 clearfix">
    
<? include template('user_menu'); ?>
    <div class="user-content">
        <div class="my-answerbox">
            <div class="title">个人信息</div>
            <div id="qa-tabcard">
                <ul>
                    <li><a href="<?=SITE_URL?>?user/profile.html">个人资料</a></li>
                    <li><a href="<?=SITE_URL?>?user/uppass.html">修改密码</a></li>
                    <li class="on">修改头像</li>
                </ul>
            </div>
            <div class="loginform">
                <? if(isset($imgstr)) { ?>                <?=$imgstr?>
                <? } else { ?>                <form  action="<?=SITE_URL?>?user/uppass.html" method="post">
                    <div class="input-bar">
                        <p>
                            说明：<br />
                            1、支持jpg、gif、png、jpeg四种格式图片上传<br />
                            2、图片大小不能超过2M;<br />
                            3、图片长宽大于80*80px时系统将自动压缩
                        </p>
                        <div class="avatarbox mt15">
                            <img class="avatar" alt="<?=$user['username']?>" src="<?=$user['avatar']?>" />
                        </div>
                        <div class="avatarbox_r mt15">
                            <input id="file_upload" name="file_upload" type="file"/>
                            <input type="button" name="uploadavatar" id="uploadavatar" class="normal-button" value="保&nbsp;存" />
                        </div>
                    </div>
                </form>
                <? } ?>            </div>
            <div class="clr"></div>
        </div>
    </div>
</div>
<link href="<?=SITE_URL?>js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<script src="<?=SITE_URL?>js/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#file_upload').uploadify({
            'swf': '<?=SITE_URL?>js/uploadify/uploadify.swf',
            'uploader': "<?=SITE_URL?>?user/editimg/<?=$user['uid']?>.html",
            'auto': false,
            'buttonImage': '<?=SITE_URL?>js/uploadify/selectimg.gif',
            'fileObjName': 'userimage',
            'multi': false,
            'fileSizeLimit': "2MB",
            'fileTypeExts': '*.jpg;*.jpeg;*.gif;*.png',
            'fileTypeDesc': 'User Avatar(.JPG, .GIF, .PNG,.JPEG)',
            'onUploadSuccess': function() {
                alert('头像上传成功!');
                document.location = "<?=SITE_URL?>?user/editimg.html";
            }
        });
        $("#uploadavatar").click(function() {
            $('#file_upload').uploadify("upload", "*");
        });
    });
</script>
<? include template('footer'); ?>
