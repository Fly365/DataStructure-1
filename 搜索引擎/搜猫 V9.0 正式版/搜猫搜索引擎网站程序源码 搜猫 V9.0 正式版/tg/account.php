<?php

require_once('global.php');
is_login();
$pagetitle='�˻���Ϣ';
$action=$_REQUEST['action'];
switch($action)
{
case 'saveinfo':
$email=HtmlReplace($_POST['email']);
$question=HtmlReplace($_POST['question']);
$answer=HtmlReplace(trim($_POST['answer']));
if(empty($answer))
{
$array=array('email'=>$email,'question'=>$question);
}
else
{
$array=array('email'=>$email,'question'=>$question,'answer'=>md5($answer));
}
$db->update('ve123_zz_user',$array,"user_name='".$user['user_name']."'");
header('location:account.php?msg='.urlencode('�޸���Ϣ�ɹ�'));
break;
case 'saveepw':
$oldpassword=trim(HtmlReplace($_POST['oldpassword']));
$newpassword=trim(HtmlReplace($_POST['newpassword']));
$array=array('email'=>$email);
if(md5($oldpassword)!=$user['password'])
{
header('location:account.php?action=epw&msg='.urlencode('�����벻��ȷ����ȷ��������!'));
}
else
{
$array=array('password'=>md5($newpassword));
$db->update('ve123_zz_user',$array,"user_name='".$user['user_name']."'");
header('location:account.php?action=epw&msg='.urlencode('��������ɹ�!'));
}
break;
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��ҳ--';echo $pagetitle;;echo '</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
';
if($action=='')
{
;echo '	<table width="100%" border="1" cellspacing="0" cellpadding="0" class="">
	<form name="form1" method="post" action="account.php">
	<input type="hidden" name="action" value="saveinfo">
    <tr>
      <td>&nbsp;</td>
      <td style=\'color:#f00;\'>';
$msg=HtmlReplace($_GET['msg']);
if(empty($msg))
{
echo '�޸ĸ�����Ϣ';
}
else
{
echo $msg;
}
;echo '</td>
    </tr>
    <tr>
    <td width="100">�û�����</td>
    <td>';echo $user['user_name'];;echo '</td>
  </tr>
  <tr>
    <td>��ϵ��������</td>
    <td>';echo $user['real_name'];;echo '</td>
  </tr>
  <tr>
    <td>�����ʼ� �� </td>
    <td><input type="text" name="email" value="';echo $user['email'];;echo '"></td>
  </tr>
    <tr>
    <td>�һ��������⣺</td>
    <td><input name="question" type="text" size="60"  value="';echo $user['question'];;echo '"/></td>
  </tr>
  <tr>
    <td>�һ�����𰸣�</td>
    <td><input name="answer" type="text" size="60" />
      (�粻�޸��Ա�����)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="�ύ"></td>
  </tr></form>
</table>
';
}
elseif($action=='epw')
{
;echo '<table width="100%" border="1" cellspacing="0" cellpadding="0" class="">
<form id="form2" name="form2" method="post" action="account.php">
<input type="hidden" name="action" value="saveepw" />
  <tr>
    <td width="100">&nbsp;</td>
    <td style=\'color:#f00;\'>
	';
$msg=HtmlReplace($_GET['msg']);
if(empty($msg))
{
echo '�޸��������';
}
else
{
echo $msg;
}
;echo '	</td>
  </tr>
  <tr>
    <td>ԭ���룺</td>
    <td><input type="text" name="oldpassword" /></td>
  </tr>
  <tr>
    <td>�����룺</td>
    <td><input type="text" name="newpassword" /></td>
  </tr>
  <tr>
    <td>ȷ�������룺</td>
    <td><input type="text" name="newpassword2" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit2" value="�ύ" /></td>
  </tr>
  </form>
</table>

';
}

?>