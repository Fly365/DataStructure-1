<?php
require "global.php";
set_time_limit(0);
?>
<link rel="stylesheet" href="xp.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
            <style type="text/css">
<!--
.RED {
	color: #CC0000;
	font-weight: bold;
}
.BLUUE {
	color: #00BB00;
	font-weight: bold;
}
-->
            </style>
            <table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="888888" bordercolordark="#FFFFFF" bgcolor="#ded9be">
              <tr> 
              <td> 
<a href="?action=addform">�����վ</a>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#888888" bordercolordark="#FFFFFF" bgcolor="#e5e1cb">
              <tr> 
              <td> 
<?php
$action=$_GET["action"];
switch ($action)
{	
    case "addform":
	addform($action);
	break;
	case "saveform":
    saveform();
    break;
	case "dell_links":
	dell_links(HtmlReplace($_GET["site_id"]));
	break;	
	case "modify":
	addform($action);
	break;
	case "zhua_sites":  //��¼ȫվ
	$site_id=$_GET["site_id"];       
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"98%\"><iframe src=\"start.php?action=zhua_sites&site_id=".$site_id."\" height=\"450\" width=\"100%\"></iframe></td></tr></table><br>";
	break;	
	case "geng_sites":  //������ץվ
	$site_id=$_GET["site_id"];       
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"98%\"><iframe src=\"start.php?action=geng_sites&site_id=".$site_id."\" height=\"450\" width=\"100%\"></iframe></td></tr></table><br>";
	break;	
		case "del":
	     $site_id=intval($_GET["site_id"]);
		 $db->query("delete from ve123_site_find where site_id='".$site_id."'");
		break;
	/*
	case "qiangzhi":
	qiangzhi($action);
	break;
	case "update_in_site_all_links":
	$url=$_GET["url"];
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"98%\"><iframe src=\"start.php?action=update_in_site_link&url=".$url."\" height=\"450\" width=\"100%\"></iframe></td></tr></table><br>";
	break;
	case "qiangzhi_update_links":
	$url=$_GET["url"];
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"98%\"><iframe src=\"start.php?action=update_in_site_link&qiangzhi=1&url=".$url."\" height=\"450\" width=\"98%\"></iframe></td><td width=\"98%\"></td></tr></table><br>";
	break;		
	case "update_qp":
	$url=$_GET["url"];
	echo "<iframe src=\"start.php?action=update_qp&url=".$url."\" height=\"100\" width=\"100%\"></iframe>";
	break;
	case "update_all_qp":
	$url=$_GET["url"];
	echo "<iframe src=\"start.php?action=update_all_qp&url=".$url."\" height=\"100\" width=\"100%\"></iframe>";
	break;*/
}	
?>
</td>
</tr>
</table>
<?php
$url=(trim($_POST["url"]));
?>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">

  <tr>
    <th width="40">ID</th>
    <th>��ַվ</th>
    <th width="35">��¼</th>
    <th width="250">����</th>
  </tr>
  <?php
  if($action=="search")
  { 
        $where=" where";
		if(!empty($url))
		{
			$where.=" url like '%".$url."%'";
		}
		else
		{
		    $where="";
		}
  }
  $sql="select * from ve123_site_find".$where;
  $result=$db->query($sql);
  $total=$db->num_rows($result);//��¼����
  $pagesize=300;//ÿҳ��ʾ��
  $totalpage=ceil($total/$pagesize);
  $page=intval($_GET["page"]);
  if($page<=0){$page=1;}
  $offset=($page-1)*$pagesize;
  $result=$db->query($sql." order by site_id desc limit $offset,$pagesize");
  while ($row=$db->fetch_array($result))
  {
  ?>
  <tr>
    <td align="center"><?php echo $row["site_id"]?></td>
    <td><?php echo "<a href=\"".$row["url"]."\" target=\"_blank\">".$row["url"]."</a>";?></td>
    <td align="center"><font class="red"><?php echo count_links($row["site_id"]);?></font></td>
    <td>
	<a href="?action=modify&amp;site_id=<?php echo $row["site_id"]?>">�޸�</a>	
	<a href="?action=zhua_sites&site_id=<?php echo $row["site_id"];?>">ץȫվ</a>
	<a href="?action=geng_sites&site_id=<?php echo $row["site_id"];?>">������ץվ</a>
	<a onclick="if(!confirm('ȷ�������?')) return false;" href="?action=dell_links&amp;site_id=<?php echo $row["site_id"]?>">���</a>
	--  <a href="?action=del&site_id=<?php echo $row["site_id"];?>" onclick="if(!confirm('ȷ��ɾ����?')) return false;"><span class="RED">ɾ��</span></a>	</td>
  </tr>
  <?php
  }
  ?>
</table>
 <table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
 <tr><td>
<?php
echo pageshow($page,$totalpage,$total,"?");
?></td></tr></table>
<?php
function addform($do_action)
{
global $db;
  if ($do_action=="modify")
  {
      $site_id=intval($_GET["site_id"]);
	  $sql="select * from ve123_site_find where site_id='$site_id'";
	  $row=$db->get_one($sql);
	  $url=$row["url"];
	  $btn_txt="�޸�";
  }
  else
  {
     $btn_txt="���";
  }
?>
 <table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
<form id="form1" name="form1" method="post" action="?action=saveform">

  <tr>
    <td width="100" rowspan="2"><span class="RED"><?php echo $btn_txt?></span> ģʽ:</td>
     <td height="50">��վ��ַ: <input name="url" type="text" value="<?php echo $url?>" size="70" />
     ��ַ֮���� ���磺http://www.hao123.com </td>
  </tr>
  <tr>
    <td>
	<input type="hidden" name="site_id" value="<?php echo $site_id?>">
	<input type="hidden" name="do_action" value="<?php echo $do_action?>">
	<input type="submit" name="Submit" value="ȷ��<?php echo $btn_txt?>" />
	</td>
  </tr>
  </form>
</table>
<?php
}
?>

<?php
function saveform()
{
	global $db;
   $url=trim($_POST["url"]);
   $site_id=$_POST["site_id"];
   $do_action=$_POST["do_action"];
   
   if ($do_action=="modify")
   {
     $array=array('url'=>$url);
	 $db->update("ve123_site_find",$array,"site_id='$site_id'");
	 jsalert("�޸ĳɹ�");
   }
   else
   {
        $row=$db->get_one("select * from ve123_site_find where url like '%".getdomain($url)."%'");
		 if(empty($row))
		 {
		    $array=array('url'=>$url);
	        $db->insert("ve123_site_find",$array);
            jsalert("�ύ�ɹ�");
		}
		else
		{
		    jsalert($url."��ַ�Ѵ���");
		}
   }
}

function count_links($url)
{
   global $db;
   $domain=getdomain($url);
   $query=$db->query("select site_id from ve123_sites where site_no='".$site_id."'");
   return $db->num_rows($query);
}
function dell_links($site_id)
{
   global $db;
   $db->query("delete from ve123_sites where site_no='".$site_id."'");
   $db->query("delete from ve123_links where site_id='".$site_id."'");
   $db->query("delete from ve123_sites_temp");
   jsalert("����ɹ�");
}
?>
