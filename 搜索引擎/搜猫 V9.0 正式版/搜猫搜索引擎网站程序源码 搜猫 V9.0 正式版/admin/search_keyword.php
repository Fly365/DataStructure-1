<?php

require 'global.php';
headhtml();
;echo '<script language="javascript">
   function getCheckedvalue(e){
    var str=\'\';
    for(var i=0;i<e.elements.length-1;i++)
	{  
	  if(e.elements[i].checked==true)
	  { 
	    str=str+e.elements[i].value+",";
	  }  
	}
	location.href="?action=del&kid="+str;
  }
</script>
<div class="nav" style="display:;"><a href="?action=addform">���</a></div>
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
$array=explode(',',$_REQUEST['kid']);
for($i=0;$i<sizeof($array)-1;$i++){
$sql="delete from ve123_search_keyword where kid='".$array[$i]."'";
$db->query($sql);}
echo "<script>location.href='?action=dolistform'</script>";
break;
}
;echo '';
$kw=HtmlReplace(trim($_REQUEST['kw']));
;echo '<form id="search_form" name="search_form" method="post" action="?action=search">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <td width="100">�ؼ���:</td>
    <td><input type="text" name="kw" value="';echo $kw;;echo '"/>
      <input type="submit" name="Submit2" value="����" /></td>
  </tr>
</table>
</form>

<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th width="30">ѡ��</th>
    <th>�ؼ���</th>
    <th width="120">��ѯ����</th>
    <th width="80">����</th>
  </tr>
<form id="kid[]" name="kid[]" method="post" action="?action=dolistform" onsubmit="return checkform();">
  ';
if($action=='search')
{
$where=' where';
if(!empty($kw))
{
$where.=" keyword like '%".$kw."%'";
}
else
{
$where='';
}
}
$sql='select * from ve123_search_keyword'.$where;
$result=$db->query($sql);
$total=$db->num_rows($result);
$pagesize=50;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$result=$db->query($sql." order by kid desc limit $offset,$pagesize");
while ($rs=$db->fetch_array($result))
{
;echo '  <tr>
    <td>';echo $rs['kid'];echo '</td>
    <td align="center"><input type="checkbox" name="kid[]" value="';echo $rs['kid'];echo '" /></td>
    <td>';echo "<a target=\"_blank\" href=\"../s/?wd=".urlencode($rs['keyword'])."\" >".$rs['keyword'];;echo '</td>
    <td>';echo $rs['hits'];;echo '</td>
    <td align="center"><a href="?action=modify&amp;kid=';echo $rs['kid'];echo '">�޸�</a></td>

    <td style="display:none;">
	<a href="?action=modify&amp;kid=';echo $rs['kid'];echo '">�޸�</a>
	<a href="?action=del&kid=';echo $rs['kid'];;echo '" onclick="if(!confirm(\'ȷ��ɾ����?\')) return false;">ɾ��</a>	</td>
  </tr>
  ';
}
;echo '
  <tr>
    <th colspan="7">
<div align="center"> 
                ȫѡ<input name="chkall" type="checkbox" id="chkall" onclick="CheckAll(this.form,\'kid[]\')" value="checkbox">&nbsp;&nbsp;<strong>����</strong><input name="do_action" type="radio" value="del" checked="checked">ɾ��&nbsp;&nbsp; 
                <input type="button" name="Submit" value=" ִ �� " onclick="getCheckedvalue(this.form)">
        </div>	</th>
    </tr></form>

</table>
';
echo pageshow($page,$totalpage,$total,'?action='.$action.'&kw='.$kw.'&');
;echo '';
function addform($do_action)
{
global $db;
if ($do_action=='modify')
{
$kid=$_GET['kid'];
$sql="select * from ve123_search_keyword where kid='$kid'";
$rs=$db->get_one($sql);
$keyword=$rs['keyword'];
$ip=$rs['ip'];
$btn_txt='ȷ���޸�';
}
else
{
$btn_txt='ȷ���ύ';
}
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">�ؼ���:</td>
    <td><input name="keyword" type="text" value="';echo $keyword;echo '" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="kid" value="';echo $kid;echo '">
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
$keyword=trim($_POST['keyword']);
$kid=$_POST['kid'];
$do_action=$_POST['do_action'];
if ($do_action=='modify')
{
$array=array('keyword'=>$keyword);
$db->update('ve123_search_keyword',$array,"kid='$kid'");
jsalert('�޸ĳɹ�');
}
else
{
$array=array('keyword'=>$keyword);
$db->insert('ve123_search_keyword',$array);
jsalert('�ύ�ɹ�');
}
}
;echo '
';
?>