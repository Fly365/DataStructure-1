<?php if(!defined('IN_CYASK')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
<title><?php echo $site_name;?>��¼</title>
<link href="<?php echo $styledir;?>/default.css" type=text/css rel=stylesheet />
<script type="text/javascript" src="include/functions.js"></script>
<script type="text/javascript">
function check_loginform(f)
{
var username;
var password;
username=str_trim(f.username.value);
password=str_trim(f.password.value);
f.username.value=username;
f.password.value=password;
if(f.username.value=="")
{
f.username.focus();
alert("�û�������Ϊ�գ�������дһ���û����ɡ�");
return false;
}
if(f.password.value=="")
{
f.password.focus();
alert("���벻��Ϊ�գ�����дһ������ɡ�");
return false;
}
}
</script>
</head>

<body>
<div id="main" style="height:100%">
<div align="left">
<table cellspacing="3" cellpadding="3" width="100%" border="0">
<tr><td valign="top" width="160">&nbsp;&nbsp;<a href="./"><img src="<?php echo $styledir;?>/1000ask.gif" border="0" /></a></td>
<td class="f14" nowrap="nowrap">&nbsp;&nbsp;<a href="./"><b>������ҳ</b></a></td></tr>
</table>
</div>
<div id="c90">
<div class="t3 bcb"><div class="t3t bgb">��¼</div></div>
<div class="b3 bcb mb12">
<br />
<form name="loginform" action="login.php" method="post" onsubmit="return check_loginform(this);">
<table cellspacing="0" cellpadding="0" width="100%" valign="top" border="0">
<tr>
<td class="f14" width="100%" height="50" colspan="2" valign="top" align="center">���ã���ӭ��¼<?php echo $site_name;?>�������û��ע�ᣬ����<a href="<?php echo $web_path;?>register.php?url=<?php echo $url;?>">ע��</a>��&nbsp;���������<?php echo $site_name;?>���û�������ֱ�ӵ�¼��</td></tr>
<tr>
<td class="f14" width="40%" height="35" align="right" valign="top" nowrap="nowrap">�û��� :&nbsp;&nbsp;&nbsp;</td>
<td width="60%" height="35" valign="top">
<input type="text" name="username" size="20" maxlength="20" value="<?php echo $loginuser;?>" />
<?php if($loginuser) { ?>
&nbsp;&nbsp;��¼�����û�
<?php } ?>
</td>
</tr>
<tr>
<td class="f14" height="35" align="right" valign="top" nowrap="nowrap">�����¼���� :&nbsp;&nbsp;&nbsp;</td>
<td height="35" valign="top">
<input type="password" name="password" size="20" maxlength="32" />
</td>
</tr>
<tr>
<td class="f14" height="35" align="right" nowrap="nowrap">&nbsp;</td>
<td height="35" valign="top">
<input type="checkbox" name="cookietime" value="1" checked /> �´��Զ���¼</td>
</tr>
<tr>
<td class="f14" height="35" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
<td height="35" valign="top">
<input type="submit" name="loginsubmit" value="��¼" class="bnsrh" />
<input type="hidden" name="command" value="login" />
<input type="hidden" name="formhash" value="<?php echo form_hash();?>" />
<input type="hidden" name="url" value="<?php echo $url;?>" />
&nbsp;&nbsp;<a href="register.php?command=getpw">��������</a>
</td></tr>
</table>
</form>
<br />
</div>
</div>
<br />
<?php include template('footer'); ?>
