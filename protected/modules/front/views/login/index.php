<!DOCTYPE html>
<html lang="em">
<head>
	<meta charset="UTF-8" />
	<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title></title>
	<meta name="description" content="" />
	<meta content="telephone=no" name="format-detection" />
	<meta content="email=no" name="format-detection" />

	<link rel="stylesheet" href="/static/front/css/style.css" />
	
</head>
<body class="loginBg">
	
	<div class="logo"><img src="/static/front/img/logo.png" /></div>
	
	<ul class="login">
		<li><input type="text" name='username' placeholder="请输入手机号码" class="input_phone" /></li>
		<li><input type="password" name='password' placeholder="请输入登录密码" class="input_pass" /></li>
		<li class="mt1"><input type="image" src="/static/front/img/btn1.png" class="btnRed btnLogin" /></li>
		<li><a href="#"><img src="/static/front/img/ico_5.png" />记录密码？</a></li>
	</ul>
	
	<footer class="footer">
		<ul class="clearfix">
			<li><a href="#"><img src="/static/front/img/ico_m1.png" /><p>采价系统</p><b>1</b></a></li>
			<li><a href="#"><img src="/static/front/img/ico_m2.png" /><p>通知公告</p></a></li>
			<li><a href="#"><img src="/static/front/img/ico_m3.png" /><p>管理中心</p></a></li>
		</ul>
	</footer>

	<script src="/static/front/js/jquery-2.2.2.min.js"></script>
	<script src="/static/front/js/script.js"></script>
        <script type="text/javascript">
            $(function(){
                $(document).on("click",".btnLogin",function(){
                    var url = "<?php echo $this->createUrl('login') ?>";
                    var username = $("input[name='username']").val();
                    var password = $("input[name='password']").val();
                    $.post(url,{username:username,password:password},function(data){
                        if(data.sta == 0){
                            alert(data.msg);
                        }else{
                            window.location.href = "<?php echo $this->createUrl("/front") ?>";
                        }
                    },'json');
                });
            });
        </script>
</body>
</html>