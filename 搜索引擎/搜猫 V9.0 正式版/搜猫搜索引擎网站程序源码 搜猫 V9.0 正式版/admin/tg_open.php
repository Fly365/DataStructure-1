<?php

require 'global.php';
headhtml();
;echo '<div class="nav" style="display:;"><a href="?action=addform">���</a></div>
<script language="javascript">
   function checkform()
   {
		 if(document.pageform.filename.value==""){alert("�ļ����Ʋ���Ϊ��!");document.pageform.filename.focus();return false;}
   }
</script>
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
$about_id=intval($_GET['about_id']);
$db->query("delete from ve123_tg_open where about_id='".$about_id."'");
break;
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="73">ID</th>
    <th width="245">�����ؼ���</th>
    <th width="270">��ַ</th>
	<th width="215">Ԥ��Ч��</th>
    <th width="66">����</th>
  </tr>
  ';
$result=$db->query('select * from ve123_tg_open order by about_id desc');
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['about_id'];;echo '</td>
    <td>';echo $rs['filename'];;echo '</td>
    <td>';echo "<a target=\"_blank\" href=\"".$site['url'].'/tg/html/'.$rs['filename'].".html\" title=\"�鿴".$rs['title']."\">".$rs['filename'].'.html';;echo '</a></td>
	<td>';echo "<a target=\"_blank\" href=\"".$site['url'].'/s/?wd='.$rs['filename']."\" title=\"�鿴".$rs['title']."\">".$rs['filename'].'';;echo '</a></td>
    <td><a href="?action=modify&amp;about_id=';echo $rs['about_id'];echo '">�޸�</a>
	<a href="?action=del&about_id=';echo $rs['about_id'];;echo '" onclick="if(!confirm(\'ȷ��ɾ����?\')) return false;">ɾ��</a>	</td>
  </tr>
  ';
}
;echo '</table>

';
function addform($do_action)
{
global $db;
if ($do_action=='modify')
{
$about_id=$_GET['about_id'];
$sql="select * from ve123_tg_open where about_id='$about_id'";
$rs=$db->get_one($sql);
$title=$rs['title'];
$content=$rs['content'];
$filename=$rs['filename'];
$url=$rs['url'];
$sortid=$rs['sortid'];
$is_show=$rs['is_show'];
$btn_txt='ȷ���޸�';
}
else
{
$btn_txt='ȷ���ύ';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="pageform" name="pageform" method="post" action="?action=saveform" onsubmit="return checkform()">
  <tr>
    <td width="100">�����ؼ���:</td>
    <td><input type="text" name="filename" value="';echo $filename;;echo '"/></td>
  </tr>
  <tr>
  <tr>
    <td>����:</td>
    <td><input type="text" name="sortid" value="';echo $sortid;echo '"/></td>
  </tr>
  <tr>
    <td>��ҳ����:</td>
    <td>
	<textarea name="content" id="content" cols="50" rows="15" style="width:100%;">';echo $content;echo '</textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="about_id" value="';echo $about_id;echo '">
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
global $db,$config;
$title=addslashes(HtmlReplace(trim($_POST['title'])));
$content=my_addslashes(trim($_POST['content']));
$filename=HtmlReplace(trim($_POST['filename']));
$url=HtmlReplace(trim($_POST['url']));
$sortid=intval($_POST['sortid']);
$about_id=intval($_POST['about_id']);
$do_action=HtmlReplace($_POST['do_action']);
$is_show=$_POST['is_show'];
ob_start();
require 'temp/open.php';
$str=ob_get_contents();
ob_end_clean();
$str=stripslashes($str);
file_put_contents('../tg/html/'.$filename.'.html',$str);
if ($do_action=='modify')
{
$array=array('title'=>$title,'content'=>$content,'url'=>$url,'filename'=>$filename,'sortid'=>$sortid,'is_show'=>$is_show);
$db->update('ve123_tg_open',$array,"about_id='$about_id'");
jsalert('�޸ĳɹ�');
}
else
{
$array=array('title'=>$title,'content'=>$content,'url'=>$url,'filename'=>$filename,'sortid'=>$sortid,'is_show'=>$is_show);
$db->insert('ve123_tg_open',$array);
jsalert('�ύ�ɹ�');
}
}
;echo '
';
?>