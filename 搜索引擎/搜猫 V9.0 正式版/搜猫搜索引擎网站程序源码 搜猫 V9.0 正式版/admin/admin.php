<?php

require 'global.php';
headhtml();
;echo '<style type="text/css">
<!--
.STYLE1 {
	color: #0000FF;
	font-weight: bold;
}
.STYLE3 {
	color: #FF0000;
	font-weight: bold;
	font-size: 14px;
}
.STYLE4 {color: #0000FF}
-->
</style>

';
$action=$_GET['action'];
switch ($action)
{
case 'saveform':
saveform();
break;
case 'addform':
addform($action);
break;
case 'modify':
addform($action);
break;
case 'del':
$db->query("delete from ve123_admin where admin_id='".intval($_GET['admin_id'])."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="75">ID</th>
    <th width="174">�û���</th>
	<th width="198">����</th>
    <th width="219">���ε�¼IP</th>
    <th width="185">�ϴε�¼IP</th>
  </tr>
  ';
$result=$db->query('select * from ve123_admin ');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['admin_id'];;echo '</td>
    <td>';echo $rs['adminname'];;echo '</td>
	<td>��ʾ���ݲ���ʾ!!</td>
    <td>';echo $rs['loginip'];;echo '</td>
    <td>';echo $rs['lastloginip'];;echo '</td>
    <td width="129">
	<a href="?action=modify&admin_id=';echo $rs['admin_id'];;echo '">�޸�����</a>&nbsp;&nbsp;
	<a href="?action=del&admin_id=';echo $rs['admin_id'];;echo '" onClick="if(!confirm(\'ȷ��ɾ����?\')) return false;">ɾ��</a></td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db,$p_cid;
if ($do_action=='modify')
{
$admin_id=intval($_GET['admin_id']);
$sql="select * from ve123_admin where admin_id='$admin_id'";
$rs=$db->get_one($sql);
$adminname=$rs['adminname'];
$password=$rs['password'];
$admin_id=$rs['admin_id'];
$btn_txt='ȷ���޸�';
}
else
{
$btn_txt='ȷ�����';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">�û���:</td>
    <td>
      <input name="adminname" type="text" value="';echo $adminname;echo '" size="50" /></td>
  </tr>
    <tr>
      <td>����:</td>
      <td>
      <input name="password" type="text" size="50" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="admin_id" value="';echo $admin_id;echo '">
	<input type="hidden" name="do_action" value="';echo $do_action;echo '">
	<input type="submit" name="Submit" value="';echo $btn_txt;echo '" />	</td>
  </tr>
  </form>
</table>
<p>
  ';
}
;echo '  
  ';
function saveform()
{
global $db;
$adminname=trim($_POST['adminname']);
$password=trim($_POST['password']);
$admin_id=intval($_POST['admin_id']);
$do_action=$_POST['do_action'];
if($password=='')
{
jsalert('���벻��Ϊ��,����������!');
die();
}
if ($do_action=='modify')
{
$array=array('adminname'=>$adminname,'password'=>$password,'admin_id'=>$admin_id);
$db->update('ve123_admin',$array,"admin_id='$admin_id'");
jsalert('�޸ĳɹ�');
}
else
{
$array=array('adminname'=>$adminname,'password'=>$password,'admin_id'=>$admin_id);
$db->insert('ve123_admin',$array);
jsalert('�ύ�ɹ�');
}
}
;echo '</p>
<div class="nav" style="display:;"><a href="admin.php">��ҳ</a><a href="?action=addform&amp;p_cid=';echo $p_cid;echo '">��ӹ���Ա</a></div>
<p>&nbsp; </p>
';
?>