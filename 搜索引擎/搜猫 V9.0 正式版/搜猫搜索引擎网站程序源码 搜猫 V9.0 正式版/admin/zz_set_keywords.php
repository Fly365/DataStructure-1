<?php

require 'global.php';
headhtml();
;echo '<div class="nav" style="display:;"><a href="?">��ҳ</a><a href="?action=addform&p_cid=';echo $p_cid;echo '">���</a></div>
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
$db->query("delete from ve123_zz_set_keywords where key_id='".intval($_GET['key_id'])."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="50">ID</th>
    <th>�ؼ���</th>
    <th width="80">��ͼ۸�</th>
    <th width="80">����</th>
  </tr>
  ';
$result=$db->query('select * from ve123_zz_set_keywords');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['key_id'];echo '</td>
    <td>';echo $rs['keywords'];;echo '</td>
    <td>';echo $rs['price'];;echo '</td>
    <td><a href="?action=modify&key_id=';echo $rs['key_id'];;echo '">�޸�</a>&nbsp;&nbsp;<a href="?action=del&key_id=';echo $rs['key_id'];;echo '" onClick="if(!confirm(\'ȷ��ɾ����?\')) return false;">ɾ��</a></td>
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
$key_id=intval($_GET['key_id']);
$sql="select * from ve123_zz_set_keywords where key_id='$key_id'";
$rs=$db->get_one($sql);
$keywords=$rs['keywords'];
$price=$rs['price'];
$sort_id=$rs['sort_id'];
$btn_txt='ȷ���޸�';
}
else
{
$btn_txt='ȷ�����';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">�ؼ���:</td>
    <td>
      <input name="keywords" type="text" value="';echo $keywords;echo '" size="50" /></td>
  </tr>
  <tr>
    <td>��ͼ۸�:</td>
    <td><input name="price" type="text" size="50"  value="';echo $price;echo '"/></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="key_id" value="';echo $key_id;echo '">
	<input type="hidden" name="do_action" value="';echo $do_action;echo '">
	<input type="submit" name="Submit" value="';echo $btn_txt;echo '" />	</td>
  </tr>
  </form>
</table>
';
}
;echo '
';
function saveform()
{
global $db;
$keywords=trim($_POST['keywords']);
$price=trim($_POST['price']);
$key_id=intval($_POST['key_id']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('keywords'=>$keywords,'price'=>$price);
$db->update('ve123_zz_set_keywords',$array,"key_id='$key_id'");
jsalert('�޸ĳɹ�');
}
else
{
$array=array('keywords'=>$keywords,'price'=>$price);
$db->insert('ve123_zz_set_keywords',$array);
jsalert('�ύ�ɹ�');
}
}
;echo '
';
?>