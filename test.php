<?php
setcookie("user","084e0343a0486ff05530df6c705c8bb4",time()+15*24*3600);
$site=$_COOKIE["user"];
if( $site != "21232f297a57a5a743894a0e4a801fc3" ){
	echo "<h1>请用管理员身份登录</h1><!--某些东西被不可逆的方式给加密了-->";
}else{
	echo "<h1>哈哈，用了管理身份也看不到什么，旗子flag不在这里显示</h1><!--flag:我很好奇你是怎么进来的-->";
}
