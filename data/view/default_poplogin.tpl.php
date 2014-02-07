<? if(!defined('IN_TIPASK')) exit('Access Denied'); global $starttime,$querynum;$mtime = explode(' ', microtime());$runtime=number_format($mtime['1'] + $mtime['0'] - $starttime,6); $setting=$this->setting;$user=$this->user;$headernavlist=$this->nav;$regular=$this->regular; ?><div class="poploginform">
    <form name="loginform"  action="<?=SITE_URL?>?user/login.html" method="post" onsubmit="return checkform();">
        <div class="input-bar">
            <div id="user_error" class="user_error"></div>
            <h2>用户名</h2>
            <input type="text" class="normal-input" id="username" name="username" />
        </div>
        <div class="clr"></div>
        <div class="input-bar">
            <h2>密&nbsp;&nbsp;码</h2>
            <input type="password" class="normal-input" id="password" name="password" />
        </div>
        <? if($setting['code_login']) { ?>        <div class="clr"></div>
        <div class="input-bar">
            <h2>验证码</h2>
            <input type="text" class="code-input" id="code" name="code" onblur="check_code();"/><span id="codetip"></span>
        </div>
        <div class="clr"></div>
        <div class="code-bar">
            <span class="verifycode"><img  src="<?=SITE_URL?>?user/code.html" onclick="javascript:updatecode();" id="verifycode"></span><a class="changecode" href="javascript:updatecode();">&nbsp;看不清?</a>
        </div>
        <? } ?>        <div class="clr"></div>
        <div class="auto-login">
            <input type="checkbox" id="cookietime" name="cookietime" value="2592000" /> 下次自动登录
        </div>
        <div class="auto-login">
            <input type="hidden" name="forward" value="<?=$forward?>"/>
            <input type="submit" value="登&nbsp;录" class="normal-button" name="submit" /><a href="<?=SITE_URL?>?user/getpass.html" class="red">忘记密码?</a><a href="<?=SITE_URL?>?user/register.html" class="red">注册新账号</a>
        </div>
        <div class="auto-login">
            其他账号登陆：<span title="新浪登录" class="sinaWebLogin"><a href="javascript:void(0);"><s></s></a></span><span title="QQ登录" class="qqLogin"><a href="javascript:void(0);"><s></s></a></span>
        </div>
    </form>
    <div class="clr"></div>
    <script type="text/javascript">
        function checkform() {
            var username = $("#username").val();
            var password = $("#password").val();
            if ($.trim(username) === '') {
                $("#user_error").html("请输入您的账号");
                $("#username").focus();
                return false;
            }
            if (password === '') {
                $("#user_error").html("请输入您的密码");
                $("#password").focus();
                return false;
            }
            $("#user_error").html("");
            check_code();
            if ($('#codetip').hasClass("input_error")) {
                $("#code").focus();
                return false;
            }
            $.ajax({
                type: "POST",
                async: false,
                cache: false,
                url: "<?=SITE_URL?>index.php?user/ajaxlogin",
                data: "username=" + $.trim(username) + "&password=" + password,
                success: function(ret) {
                    if (ret == '-1') {
                        $("#user_error").html("用户名或密码错误");
                    } else {
                        $("#user_error").html("");
                    }
                }
            });
            if ($("#user_error").html() != '') {
                return false;
            } else {
                return true;
            }

        }
    </script>

</div>