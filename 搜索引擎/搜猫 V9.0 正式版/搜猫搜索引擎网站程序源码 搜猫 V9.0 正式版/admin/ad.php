<?php

require 'global.php';
headhtml();
$ad_class=array('1'=>'����ҳ�Ҳ�Ͳ�','2'=>'����ҳ�Ҳ�(��˵����ʾ)','3'=>'��ҳ���λ');
$type=intval($_GET['type']);
;echo '<div class="nav" style="display:;"><a href="?action=addform&type=';echo $type;;echo '">���</a></div>
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
$ad_id=intval($_GET['ad_id']);
$db->query("delete from ve123_ad where ad_id='".$ad_id."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg  class_nav" style="display:none">
  <tr>
    <td>
	';
foreach($ad_class as $key=>$value)
{
if($type==$key)
{
$class=" class=\"selectstyle\"";
}
else
{
$class='';
}
echo '<a'.$class." href=\"?type=".$key."\">".$value.'</a>';
}
;echo '</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg  class_nav">
  <tr>
    <td>';echo $ad_class[$type];;echo '</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th width="100">��վ����</th>
    <th>���ӵ�ַ</th>
    <th width="80">�Ƿ���ʾ</th>
    <th width="80">����ID</th>
    <th width="80">����</th>
  </tr>
  ';
if(!empty($type))
{
$where=" where type='".$type."'";
}
$sql='select * from ve123_ad'.$where.' order by sortid asc';
$result=$db->query($sql);
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['ad_id'];echo '</td>
    <td>';echo $rs['title'];echo '</td>
    <td>';echo "<a href=\"".$rs['siteurl']."\" target=\"_blank\">".$rs['siteurl'].'</a>';;echo '</td>
    <td>
	';
if($rs['is_show'])
{
echo '��';
}
else
{
echo "<font color=\"red\">��</font>";
}
;echo '	</td>
    <td>';echo $rs['sortid'];;echo '</td>
    <td><a href="?action=modify&amp;ad_id=';echo $rs['ad_id'];echo '&type=';echo $rs['type'];;echo '">�޸�</a>
	<a href="?action=del&ad_id=';echo $rs['ad_id'];;echo '" onclick="if(!confirm(\'ȷ��ɾ����?\')) return false;">ɾ��</a>	</td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db,$type;
if ($do_action=='modify')
{
$ad_id=$_GET['ad_id'];
$sql="select * from ve123_ad where ad_id='$ad_id'";
$rs=$db->get_one($sql);
$title=$rs['title'];
$siteurl=$rs['siteurl'];
$type=$rs['type'];
$content=$rs['content'];
$sortid=$rs['sortid'];
$is_show=$rs['is_show'];
$btn_txt='ȷ���޸�';
}
else
{
$btn_txt='ȷ���ύ';
$is_show=1;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">��վ����:</td>
    <td>
      <input name="title" type="text" value="';echo $title;echo '" size="80"/>    </td>
  </tr>
  <tr>
    <td>���ӵ�ַ:</td>
    <td><input name="siteurl" type="text" value="';echo $siteurl;echo '" size="80" /></td>
  </tr>
  <tr ';if($do_action=='modify'){echo "style=\"display:none;\"";};echo '>
    <td>��ʾ����:</td>
    <td><input name="type" type="radio" value="1" ';if($type==1) echo "checked=\"checked\"";;echo ' />
    ����ҳ�Ҳ�
      <input type="radio" name="type" value="2" ';if($type==2) echo "checked=\"checked\"";;echo '/>
      ����ҳ�Ҳ�(��˵����ʾ)
	   <input type="radio" name="type" value="3" ';if($type==3) echo "checked=\"checked\"";;echo '/>
      ��ҳ���λ	  </td>
  </tr>
  <tr>
    <td>����ID:</td>
    <td><input type="text" name="sortid"  value="';echo $sortid;echo '"/></td>
  </tr>
  <tr>
    <td>�Ƿ���ʾ:</td>
    <td><input name="is_show" type="checkbox" value="1" ';if($is_show){echo "checked=\"checked\"";};echo ' /></td>
  </tr>
  <tr>
    <td>��ϸ˵��:</td>
    <td><textarea name="content" cols="80" rows="8">';echo $content;;echo '</textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="ad_id" value="';echo $ad_id;echo '">
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
$title=trim($_POST['title']);
$siteurl=trim($_POST['siteurl']);
$type=trim($_POST['type']);
$content=trim($_POST['content']);
$ad_id=$_POST['ad_id'];
$sortid=intval($_POST['sortid']);
$is_show=intval($_POST['is_show']);
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('title'=>$title,'siteurl'=>$siteurl,'type'=>$type,'content'=>$content,'sortid'=>$sortid,'is_show'=>$is_show);
$db->update('ve123_ad',$array,"ad_id='$ad_id'");
jsalert('�޸ĳɹ�');
}
else
{
$array=array('title'=>$title,'siteurl'=>$siteurl,'type'=>$type,'content'=>$content,'sortid'=>$sortid,'is_show'=>$is_show);
$db->insert('ve123_ad',$array);
jsalert('�ύ�ɹ�');
}
}
;echo '
';
?>