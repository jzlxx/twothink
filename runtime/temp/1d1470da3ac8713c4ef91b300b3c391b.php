<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:96:"D:\phpStudy\PHPTutorial\WWW\twothink\public/../application/user/view/default/login\register.html";i:1552702738;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo config('WEB_SITE_TITLE'); ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>Bootstrap 101 Template</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="__STATIC__/bootstrap/js/html5shiv.js"></script>
  <script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
  <script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <section>
    <div class="span12">
      <form class="login-form" action="" method="post">
        <div class="form-group">
          <label class="control-label" for="inputUsername">用户名</label>
          <div class="controls">
            <input type="text" id="inputUsername" class="form-control" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="inputPassword">密码</label>
          <div class="controls">
            <input type="password" id="inputPassword"  class="form-control" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="inputRePassword">确认密码</label>
          <div class="controls">
            <input type="password" id="inputRePassword" class="form-control" placeholder="请再次输入密码" recheck="password" errormsg="您两次输入的密码不一致" nullmsg="请填确认密码" datatype="*" name="repassword">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="inputEmail">邮箱</label>
          <div class="controls">
            <input type="text" id="inputEmail" class="form-control" placeholder="请输入电子邮件"  ajaxurl="/member/checkUserEmailUnique.html" errormsg="请填写正确格式的邮箱" nullmsg="请填写邮箱" datatype="e" value="" name="email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="inputVerify">验证码</label>
          <div class="controls">
            <input type="text" id="inputVerify" class="form-control" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label"></label>
          <div class="controls verifyimg">
            <img src="/captcha.html" alt="captcha" />            </div>
          <div class="controls Validform_checktip text-warning"></div>
        </div>
        <div class="form-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary onlineBtn">注 册</button>
            <p><span><span class="pull-left"><span>已有账号? <a href="/user/login/index.html">立即登录</a></span> </span></p>

          </div>
        </div>
      </form>
    </div>
  </section>
</div>
</body>
	<script type="text/javascript">
    	$(document)
	    	.ajaxStart(function(){
	    		$("button:submit").addClass("log-in").attr("disabled", true);
	    	})
	    	.ajaxStop(function(){
	    		$("button:submit").removeClass("log-in").attr("disabled", false);
	    	});


    	$("form").submit(function(){
    		var self = $(this);
    		$.post(self.attr("action"), self.serialize(), success, "json");
    		return false;

    		function success(data){
    			if(data.code){
    				window.location.href = data.url;
    			} else {
    				self.find(".Validform_checktip").text(data.msg);
    				//刷新验证码
    				$(".verifyimg img").click();
    			}
    		}
    	});

		$(function(){
      //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        }); 
    });
	</script>
</html>
