<?php

session_start();
require('global.php');
$action=$_REQUEST['action'];
switch($action)
{
case 'login':
$user_name=trim(HtmlReplace($_POST['entered_login']));
$password=trim(HtmlReplace($_POST['entered_password']));
$imagecode=trim(HtmlReplace($_POST['entered_imagecode']));
$check=$db->get_one("select * from ve123_zz_user where user_name='".$user_name."' and password='".md5($password)."'");
if(empty($check))
{
header('location:login.php?msg='.urlencode('�û������������!'));
}
elseif($_SESSION['dd_ckstr']!=$imagecode)
{
header('location:login.php?msg='.urlencode('��֤�����!'));
}
else
{
$_SESSION['user_name']=$user_name;
header('location:./');
}
break;
case 'logou':
unset($_SESSION['user_name']);
break;
}
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">

<link rel="shortcut icon" href="/favicon.ico">
<link href="ima/style090901.css" rel="stylesheet" type="text/css">
</style> 
<script language="JavaScript">
<!--
function SymError()
{
  return true;
}
window.onerror = SymError;
//-->
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
//  ------ check form ------
function checkData() {
	var f1 = document.forms[0];
	var wm = "�Բ��������������ˣ�";
	var noerror = 1;

	// --- entered_login ---
	var t1 = f1.entered_login;
	if (t1.value == "" || t1.value == " ") {
		wm += "�û�����";
		noerror = 0;
	}

	// --- entered_password ---
	var t1 = f1.entered_password;
	if (t1.value == "" || t1.value == " ") {
		wm += "���룬";
		noerror = 0;
	}

	var t1 = f1.entered_imagecode;
	if (t1.value == "" || t1.value == " ") {
		wm += "��֤�룬";
		noerror = 0;
	}

	// --- check if errors occurred ---
	if (noerror == 0) {
		alert(wm.substr(0, wm.length-1));
		return false;
	}
	else return true;
}

//-->
</SCRIPT>
<style type="text/css">

</style>
<title>';echo $config['name'];;echo '�ƹ����</title></head><body>
<!--TOP start-->
<div class="Top"> <img src="../images/log.gif"  alt="';echo $config['name'];;echo '" width="110" height="40" class="logo_float"> <img src="../images/tg.gif" width="75" height="40" class="logo_float"></div>
<!--TOP end-->
<!--Main start-->
<div class="Main" style="margin-top: 0px; clear: both;">
  <div class="Main_left">
    <div class="Main_left_logo_a" title="';echo $config['name'];;echo '�ƹ����ϵͳ--����������һƷ��"></div>
    <div class="Main_left_text_1">
      <div class="Main_left_text_img"><a href="../tg/reg.php" target="_blank" title="����������ҵ������ƽ̨"><img src="ima/mashangzhuce.jpg" alt="����ע��" border="0"></a></div>
      <div class="Main_left_text_1a"><a href="';echo $config['url'];;echo '" target="_blank">';echo $config['name'];;echo '�й���׼���˳���98���ĵ�����Ϣ��</a><br><a href="http://1230530.com/" target="_blank">';echo $config['name'];;echo '�й�ӵ��4800G����������</a></div>
    </div>
    <div class="Main_left_bottom">
      <div class="Main_left_bottom_img"></div>
      <div class="Main_left_bottom_text">
        <div class="Main_left_bottom_text1"><a href="';echo $config['url'];;echo '" target="_blank">';echo $config['name'];;echo '�ƹ�</a></div>
        <div class="Main_left_bottom_text2">��������ȣ�<br>
          ���к�λ�ã�<br>
          ���ƹ㵯���鷢</div>
      </div>
      <div class="Main_left_bottom_img1"></div>
      <div class="Main_left_bottom_texta">
        <div class="Main_left_bottom_texta1"><a href="';echo $config['url'];;echo '" target="_blank">��ȫ�ȶ�</a></div>
        <div class="Main_left_bottom_texta2">��ǿ����ϵͳ, ������Ϣ��Ч�����ʳ���98����99.8��</div>
      </div>
    </div>
  </div>
  <!--login start-->
  <div class="login" style="position: relative;">
    <div class="login_month"></div>
    <div class="login_month_img1"></div>
    <div class="login_month_img"></div>
    <div class="login_top"></div>
    <div class="login_middle">
      <div class="login_middle_img"></div>
      <div class="login_middle_img1" style="background-position: -416px -46px;"></div>
      <div class="login_middle_clear"></div>
	<form action=\'login.php\' METHOD=post onSubmit="return checkData()">
	<input type="hidden" name="action" value="login">
      <table class="login_table" border="0" cellspacing="0">
			';
$msg=HtmlReplace($_GET['msg']);
if(empty($msg))
{
echo '�������û���';
}
else
{
echo $msg;
}
;echo '			</td>
		</tr>
		<tr>
      <form name="form" method="post" action="/s/web__login.asp?action=login">
		
      <table class="login_table" border="0" cellspacing="0">
        <tbody><tr>
          <td class="login_table_text1">�û���</td>
          <td class="login_table_text1_1"><input class="login_table_text1_input" name="entered_login"id="entered_login"  maxlength="50" style="border-color: rgb(132, 161, 189); font-weight: bold; font-family: Verdana,Arial,Helvetica,sans-serif; ime-mode: disabled;" type="text" ></td>
          <td class="login_table_text1_img" title="$ Googie.cn"></td>
        </tr>
        <tr>
          <td class="login_table_space1" colspan="3"></td>
        </tr>
        <tr>
          <td class="login_table_text2">�� &nbsp;��</td>
          <td class="login_table_text1_1"><input class="login_table_text1_input" name="entered_password" type="password" id="email"></td>
          <td class="login_table_text2_2">&nbsp;<a href="getpwd.php" target="_blank" title="�һ�����" class="c_black">����������?</a></td>
        </tr>
        <tr>
          <td class="login_table_space1" colspan="3"></td>
        </tr>
        <tr>
          <td class="login_table_text2">��֤��</td>
          <td colspan="2">
          	<input class="login_table_select" type=text type="submit" name="entered_imagecode" id="entered_imagecode" style="height: auto; font-family: Verdana,Arial,Helvetica,sans-serif; line-height: 14px;" size="30" value=""><img src="../include/vdimgck.php" align="absmiddle">
          </td>
        </tr>
        <tr>
          <td class="login_table_space1" colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3"><div class="login_table_text2_1">
            <span onmouseover="document.getElementById(\'autoLoginDiv\').style.display=\'\'" onmouseout="document.getElementById(\'autoLoginDiv\').style.display=\'none\'">
			<input type=checkbox id="remUsername" style="float: left;" checked>
              <span style="float: left; margin-top: 3px;"><label for="remUsername">��ǿ��ȫ��&nbsp;</label></span></span><a href="../a/help.html"><img style="float: left; display: inline; margin-top: 2px;" src="ima/whyssl.gif" alt="ʲô���Զ���¼" title="ʲô���Զ���¼" border="0"></a>
              
              <input   id="secure" checked="checked" style="float: left; margin-left: 10px;" type="checkbox">
              <span style="float: left; margin-top: 3px;"><label for="secure">�����û���</label></span> <!--

              </a>-->
			  <div style="border: 1px solid rgb(255, 153, 0); padding: 5px; position: absolute; width: 180px; height: 35px; background-color: rgb(255, 239, 164); left: 3px; top: 18px; text-align: left; line-height: 150%; color: rgb(220, 104, 0); display: none;" id="autoLoginDiv">Ϊ��������Ϣ��ȫ���벻Ҫ�����ɻ��õ�����ʹ�ô˹��ܣ�
			  </div>
            </div></td>
        </tr>
        <tr>
          <td class="login_table_space3" colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3"><input name="Submit" title="ע���ƹ�" value="" class="btn1"type="submit">
                        <a href="/tg/reg.php" target="_blank" class="btn3" title="����ע��"></a>
    </td>
        </tr>
        <tr></tr>
        <tr>
          <td colspan="3"><div class="login_table_space2"></div></td>
        </tr>
        <tr>
          <td colspan="3" style="padding: 0px;"><div class="login_table_text3"></div></td>
        </tr>
      </tbody></table>
      </form>
    </div>
    <div class="login_bottom"></div>
  </div>
  <!--login end-->
</div>
<!--Main end-->
<!--bottom1 start-->
<script type="text/javascript">
	<!--
	document.forms[0].entered_login.select();
	document.forms[0].entered_login.focus();
	//-->
</script>
<!--bottom1 end-->
<!--bottom2 start-->
<div class="bottom2">
  <div class="bottom2_text"><br>
  <a href="../" target="_blank">Copyright</a> <a href="';echo $config['url'];;echo '"></a> &#169; 2010-2012 <a href="';echo $config['url'];;echo '">';echo $config['name'];;echo '���������ƹ�ƽ̨</a></div>
</div>
<!--bottom2 end-->
<script type="text/javascript" src="float/float.js" charset="gb2312"></script>
</html>
';
?>
