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
<a href="?action=addform">�����վ</a>&nbsp;&nbsp;&nbsp;
<a href="?action=update_all_qp">��������QPȨ��ֵ</a>&nbsp;&nbsp;&nbsp;<a href="?action=update_not_qp">���»�ûδ���µ�QPȨ��ֵ</a>&nbsp;&nbsp;&nbsp;<a href="?action=qiangzhi">ǿ�������վ</a></td>
</tr>
</table>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#888888" bordercolordark="#FFFFFF" bgcolor="#e5e1cb">
              <tr> 
              <td> 
<?php
$action=$_GET["action"];
switch ($action)
{
    case "saveform":
    saveform();
    break;
    case "qiangzhisave":
    qiangzhisave();
    break;
    case "addform":
	addform($action);
	break;
	case "qiangzhi":
	qiangzhi($action);
	break;
	case "modify":
	addform($action);
	break;

	case "options":
	options(intval($_GET["site_id"]));
	break;
	case "dell_links":
	dell_links(HtmlReplace($_GET["url"]));
	break;

	case "del":
	     $site_id=intval($_GET["site_id"]);
		 $db->query("delete from ve123_sites where site_id='".$site_id."'");
	break;
	case "add_in_site_link":  
	$site_id=$_GET["site_id"];       
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"98%\"><iframe src=\"start.php?action=add_in_site_link&site_id=".$site_id."\" height=\"450\" width=\"100%\"></iframe></td></tr></table><br>";
	break;
	case "add_all_lry":  //��¼ȫվ
	$site_id=$_GET["site_id"];       
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"98%\"><iframe src=\"start.php?action=add_all_lry&site_id=".$site_id."\" height=\"450\" width=\"100%\"></iframe></td></tr></table><br>";
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
	break;
	case "update_not_qp":
	$url=$_GET["url"];
	echo "<iframe src=\"start.php?action=update_not_qp&url=".$url."\" height=\"100\" width=\"100%\"></iframe>";
	break;
}	
?>
</td>
</tr>
</table>
<?php
$url=(trim($_POST["url"]));
?>

<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="888888" bordercolordark="#FFFFFF" bgcolor="#ded9be">
  <tr>
    <td width="60"><span class="RED">��ַ����:</span></td>
    <td><form id="search_form" name="search_form" method="post" action="?action=search&amp;">
		<input name="url" type="text" value="<?php echo $url;?>" size="30"/>
      	<input type="submit" name="Submit2" value="��ҳ" />
	</td>
	<td></form></td>
	 <td>
		<form id="search_form" name="search_form" method="get" action="links.php?action=search&amp;">
		<input name="url" type="text" value="" size="30"/>
      	<input name="Submit3" type="submit" id="Submit3" value="��ҳ" />
		<input type="hidden" name="action" value="search" />
	</td>
	<td></form></td>
  </tr>
</table>

<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">

  <tr>
    <th width="45">ID</th>
    <th width="372">��վ��ַ</th>
    <th width="42">���</th>
    <th width="59">��ҳ</th>
	<th width="55">QPȨ��ֵ</th>
    <th width="107">��¼</th>
    <th width="377">����</th>
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
  $sql="select * from ve123_sites".$where;
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
    <td align="center"><?php
							 if($row["spider_depth"]==-1) echo "ȫվ";
							 if($row["spider_depth"]==0) echo "��ҳ";
							 if($row["spider_depth"]>0) echo $row["spider_depth"];
						?></td>
    <td align="center"><?php echo $row["fpr"]?></td>
	<td align="center"><?php echo $row["qp"]?></td>
	<td align="center"><font class="red"><?php echo count_links($row["url"]);?></font></td>
    <td>
	<a href="?action=modify&amp;site_id=<?php echo $row["site_id"]?>">�޸�</a>	
	<a href="?action=add_in_site_link&site_id=<?php echo $row["site_id"];?>">��¼</a>
	<a href="?action=update_in_site_all_links&amp;url=<?php echo $row["url"]?>">����</a>	
	<a href="links.php?action=search&amp;url=<?php echo getdomain($row["url"])?>">���</a>
	<a onclick="if(!confirm('ȷ�������?')) return false;" href="?action=dell_links&amp;url=<?php echo $row["url"]?>">���</a>
	<a href="?action=add_all_lry&site_id=<?php echo $row["site_id"];?>">��¼ȫվ</a>
	<a href="?action=options&amp;site_id=<?php echo $row["site_id"]?>">��ϸѡ��</a>
	--  <a href="?action=del&site_id=<?php echo $row["site_id"];?>" onclick="if(!confirm('ȷ��ɾ����?')) return false;"><span class="RED">ɾ��</span></a>
	</td>
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
	  $sql="select * from ve123_sites where site_id='$site_id'";
	  $row=$db->get_one($sql);
	  $url=$row["url"];
	  $qp=$row["qp"];
	  $fpr=$row["fpr"];
	  $spider_depth=$row["spider_depth"];
	  $pagestart=$row["pagestart"];
	  $pagestop=$row["pagestop"];
	  $pageadd=$row["pageadd"];
	  $include_word=$row["include_word"];
	  $not_include_word=$row["not_include_word"];
	  $btn_txt="�޸�";
  }
  else
  {
    // $spider_depth="0";
	 $spider_depth="1";
	 $fpr="0";
	 $pagestart="1";
	 $pagestop="2";
	 $pageadd="1";
     $btn_txt="���";
  }
?>
 <table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
<form id="form1" name="form1" method="post" action="?action=saveform">

<?php if($fpr==1) { ?>
  <tr>
    <td width="100"><span class="RED"><?php echo $btn_txt?></span> ģʽ:</td>
    <td>  
			 <input type="radio" name="fpr" value="0"  onclick="getElementById('fd').style.display='none'"> ץȡ��ҳ
      		 <input name="fpr" type="radio" onClick="getElementById('fd').style.display=''" value="1" checked="checked">
      		 ��ҳץȡ (���ѡ�ж�ҳ,��������ȱ���Ϊ1) 	  </td>
  </tr>
  <tr>
    <td width="100">��վ��ַ:</td>
    <td><input name="url" type="text" value="<?php echo $url?>" size="60" />
      <a href="http://www.1230530.com/">�磺
            http://www.1230530.com</a><a href="http://www.1230530.com"></a><br>
      (��ҳ��{page}����)</td>
  </tr>
    <tr id="fd">
    <td height="35">��ҳ���ã�</td>
    <td align="left">��ʼҳ��
    <input type="text" name="pagestart" size="5" value="<?php echo $pagestart?>">
    ����ҳ��
    <input type="text" name="pagestop" size="5" value="<?php echo $pagestop?>"> 
     ������
    <input type="text" name="pageadd" size="5" value="<?php echo $pageadd?>">
    ��ÿҳ������ֵ��</td>
  </tr>
 <?php		} else { ?>
  <tr>
    <td width="100"><span class="RED"><?php echo $btn_txt?></span> ģʽ:</td>
     <td>  
       		<input type="radio" name="fpr" value="0" checked="checked"  onclick="getElementById('fd').style.display='none'"> ץȡ��ҳ 
      		<input type="radio" name="fpr" value="1" onClick="getElementById('fd').style.display=''">��ҳץȡ (���ѡ�ж�ҳ,��������ȱ���Ϊ1)	</td>
  </tr>
  <tr>
    <td width="100">��վ��ַ:</td>
    <td><input name="url" type="text" value="<?php echo $url?>" size="60" />
      <a href="http://www.1230530.com/">�磺
            http://www.1230530.com</a><a href="http://www.1230530.com"></a><br />

      (��ҳ��{page}����)</td>
  </tr>
    <tr id="fd" style="display:none;">
    <td height="35">��ҳ���ã�</td>
    <td align="left">��ʼҳ��
    <input type="text" name="pagestart" size="5" value="<?php echo $pagestart?>">
    ����ҳ��
    <input type="text" name="pagestop" size="5" value="<?php echo $pagestop?>"> 
     ������
    <input type="text" name="pageadd" size="5" value="<?php echo $pageadd?>">
    ��ÿҳ������ֵ��</td>
  </tr>
  		<?php	 } ?>

  <tr style="display:none">
    <td>QPȨ��ֵ:</td>
    <td><input name="qp" type="text" value="<?php echo $qp;?>" size="6" />
    (Ȩ��ֵԽ��,����Խ��ǰ)</td>
  </tr>
  <tr>
    <td>�������:</td>
    <td>
  <SELECT name="spider_depth">
	<option value="-1" <?php  if($spider_depth==-1) echo "selected";?>>ȫվ</option>
	<option value="0" <?php  if($spider_depth==0) echo "selected";?>>��ҳ</option>
	<option value="1" <?php  if($spider_depth==1) echo "selected";?>>1</option>
	<option value="2" <?php  if($spider_depth==2) echo "selected";?>>2</option>
	<option value="3" <?php  if($spider_depth==3) echo "selected";?>>3</option>
	<option value="4" <?php  if($spider_depth==4) echo "selected";?>>4</option>
	<option value="5" <?php  if($spider_depth==5) echo "selected";?>>5</option>
	<option value="6" <?php  if($spider_depth==6) echo "selected";?>>6</option>
	<option value="7" <?php  if($spider_depth==7) echo "selected";?>>7</option>
	<option value="8" <?php  if($spider_depth==8) echo "selected";?>>8</option>
	<option value="9" <?php  if($spider_depth==9) echo "selected";?>>9</option>
	<option value="10" <?php  if($spider_depth==10) echo "selected";?>>10</option>
	<option value="11" <?php  if($spider_depth==11) echo "selected";?>>11</option>
	<option value="12" <?php  if($spider_depth==12) echo "selected";?>>12</option>
	<option value="13" <?php  if($spider_depth==13) echo "selected";?>>13</option>
	<option value="14" <?php  if($spider_depth==14) echo "selected";?>>14</option>
	<option value="15" <?php  if($spider_depth==15) echo "selected";?>>15</option>	
</select> <?php  if($spider_depth>0) echo "<span class=RED>��</span>";?>
      ( ȫվֵΪ-1,��ҳΪ0,һ������Ϊ1,�������� )<br/></td>
  </tr>
      <td>QPȨ��ֵ:</td>
    <td><input name="qp" type="text" value="<?php echo $qp;?>" size="6" />
    (Ȩ��ֵԽ��,����Խ��ǰ)</td>
  <tr>
    <td>����ĳ�ֶ�</td>
    <td><textarea name="include_word" cols="60" rows="6"><?php echo $include_word;?></textarea>
      <br />
      
      (����ĳ�ֶε����Ӳ�ץȡ,Ϊ�ձ�ʾ������,ÿ��������,�Ÿ���)</td></tr>
  <tr>
    <td>������ĳ�ֶ�</td>
    <td><textarea name="not_include_word" cols="60" rows="6"><?php echo $not_include_word;?></textarea>
<br />

      (Ϊ�ձ�ʾ������,ÿ��������,�Ÿ���)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="site_id" value="<?php echo $site_id?>">
	<input type="hidden" name="do_action" value="<?php echo $do_action?>">
	<input type="submit" name="Submit" value="ȷ��<?php echo $btn_txt?>" />
	<?php
	if($do_action=="modify")
	{
	   echo "<a href=\"?action=options&site_id=".$site_id."\">��ϸѡ��</a>";
	}
	?>	</td>
  </tr>
  </form>
</table>
<?php
}
?>
<?php
function qiangzhi($do_action)
{
global $db;
  if ($do_action=="modify")
  {
      $site_id=intval($_GET["site_id"]);
	  $sql="select * from ve123_sites where site_id='$site_id'";
	  $row=$db->get_one($sql);
	  $url=$row["url"];
	  $qp=$row["qp"];
	  $fpr=$row["fpr"];
	  $spider_depth=$row["spider_depth"];
	  $pagestart=$row["pagestart"];
	  $pagestop=$row["pagestop"];
	  $pageadd=$row["pageadd"];
	  $include_word=$row["include_word"];
	  $not_include_word=$row["not_include_word"];
	  $btn_txt="ȷ���޸�";
  }
  else
  {
    // $spider_depth="0";
	 $spider_depth="1";
	 $fpr="0";
	 $pagestart="1";
	 $pagestop="2";
	 $pageadd="1";
     $btn_txt="ǿ�����";
  }
?>
 <table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
<form id="form1" name="form1" method="post" action="?action=qiangzhisave">
  <tr>
    <td width="100"><span class="BLUUE"><?php echo $btn_txt?></span> ģʽ:</td>
    <td>      <input type="radio" name="fpr" value="0" checked="checked"  onclick="getElementById('fd').style.display='none'"> 
      ץȡ��ҳ 
      <input type="radio" name="fpr" value="1" onClick="getElementById('fd').style.display=''">
    ��ҳץȡ (���ѡ�ж�ҳ,��������ȱ���Ϊ1)</td>
  </tr>
  <tr>
    <td width="100">��վ��ַ:</td>
    <td><input name="url" type="text" value="<?php echo $url?>" size="60" />
      <a href="http://www.1230530.com/">�磺
            http://www.1230530.com</a><a href="http://www.1230530.com"></a><br />

      (��ҳ��{page}����)</td>
  </tr>
    <tr id="fd" style="display:none;">
    <td height="35">��ҳ���ã�</td>
    <td align="left">��ʼҳ��
    <input type="text" name="pagestart" size="5" value="<?php echo $pagestart?>">
    ����ҳ��
    <input type="text" name="pagestop" size="5" value="<?php echo $pagestop?>"> 
     ������
    <input type="text" name="pageadd" size="5" value="<?php echo $pageadd?>">
    ��ÿҳ������ֵ��</td>
  </tr>
  <tr style="display:none">
    <td>QPȨ��ֵ:</td>
    <td><input name="qp" type="text" value="<?php echo $qp;?>" size="6" />
    (Ȩ��ֵԽ��,����Խ��ǰ)</td>
  </tr>
  <tr>
    <td>�������:</td>
    <td><input name="spider_depth" type="text" value="<?php echo $spider_depth;?>" size="6"/>
      (0��ʾֻ����ҳ,1��ʾ����ҳ��������������)</td>
  </tr>
  <tr>
    <td>����ĳ�ֶ�</td>
    <td><textarea name="include_word" cols="60" rows="6"><?php echo $include_word;?></textarea>
<br />

      (����ĳ�ֶε����Ӳ�ץȡ,Ϊ�ձ�ʾ������,ÿ�������ԷֺŸ���)</td>
  </tr>
  <tr>
    <td>������ĳ�ֶ�</td>
    <td><textarea name="not_include_word" cols="60" rows="6"><?php echo $not_include_word;?></textarea>
<br />

      (Ϊ�ձ�ʾ������,ÿ�������ԷֺŸ���)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="site_id" value="<?php echo $site_id?>">
	<input type="hidden" name="do_action" value="<?php echo $do_action?>">
	<input type="submit" name="Submit" value="<?php echo $btn_txt?>" />
	<?php
	if($do_action=="modify")
	{
	   echo "<a href=\"?action=options&site_id=".$site_id."\">��ϸѡ��</a>";
	}
	?>	</td>
  </tr>
  </form>
</table>
<?php
}
?>
<?php
function options($site_id)
{
    global $db;
	$row=$db->get_one("select * from ve123_sites where site_id='".$site_id."'");
	
?>
            <table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">��ַ:</td>
    <td><?php echo "<a target=\"_blank\" href=\"".$row["url"]."\">".$row["url"];?></a></td>
  </tr>
  <!--<tr>
    <td>�ϴθ���ʱ��:</td>
    <td><?php echo date("Y-m-d H:i:s",$row["indexdate"]);?></td>
  </tr>-->
  <tr>
    <td>����¼��ҳ:</td>
    <td><font class="red"><?php echo count_links($row["url"]);?></font>&nbsp;ҳ</td>
  </tr>
  <tr>
    <td>�������:</td>
    <td><font class="red"><?php echo $row["spider_depth"];?></font>&nbsp;(0��ʾֻ����ҳ)</td>
  </tr>
  <tr>
    <td>�������:</td>
    <td>
	<!--<a href="?action=update_qp&site_id=<?php echo $row["site_id"];?>">����qp</a>
	
	-->
	<a href="start.php?action=add_new_page&site_id=<?php echo $row["site_id"]?>">С֩��-��¼</a>
	<a href="start.php?action=add_in_site_link&site_id=<?php echo $row["site_id"];?>">��֩��-��¼</a>
	<a href="?action=update_in_site_all_links&amp;url=<?php echo $row["url"]?>">����������ҳ</a>
	<a href="?action=qiangzhi_update_links&amp;url=<?php echo $row["url"]?>">ǿ�Ƹ���</a>
	<a href="links.php?action=search&amp;url=<?php echo getdomain($row["url"])?>">�������¼</a>
	<a onclick="if(!confirm('ȷ�������?')) return false;" href="?action=dell_links&amp;url=<?php echo $row["url"]?>">���������ҳ</a>
	<a href="?action=modify&amp;site_id=<?php echo $row["site_id"]?>">�޸�</a>	</td>
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
   $qp=trim($_POST["qp"]);
   $fpr=trim($_POST["fpr"]);
   $pagestart=trim($_POST["pagestart"]);
   $pagestop=trim($_POST["pagestop"]);
   $pageadd=trim($_POST["pageadd"]);
   $spider_depth=intval($_POST["spider_depth"]);
   $include_word=$_POST["include_word"];
   $not_include_word=$_POST["not_include_word"];
   $site_id=$_POST["site_id"];
   $do_action=$_POST["do_action"];
   if ($fpr==1){$spider_depth=1;}
   if ($do_action=="modify")
   {
     $array=array('url'=>$url,'qp'=>$qp,'fpr'=>$fpr,'pagestart'=>$pagestart,'pagestop'=>$pagestop,'pageadd'=>$pageadd,'spider_depth'=>$spider_depth,'include_word'=>$include_word,'not_include_word'=>$not_include_word);
	 $db->update("ve123_sites",$array,"site_id='$site_id'");
	 jsalert("�޸ĳɹ�");
   }
   else
   {
        // $row=$db->get_one("select * from ve123_sites where url like '%".$url."%'");
           $row=$db->get_one("select * from ve123_sites where url like '%".getdomain($url)."%'");
		 if(empty($row))
		 {
		    $array=array('url'=>$url,'qp'=>$qp,'fpr'=>$fpr,'pagestart'=>$pagestart,'pagestop'=>$pagestop,'pageadd'=>$pageadd,'spider_depth'=>$spider_depth,'include_word'=>$include_word,'not_include_word'=>$not_include_word);
	        $db->insert("ve123_sites",$array);
            jsalert("�ύ�ɹ�");
		}
		else
		{
		    jsalert($url."��ַ�Ѵ���");
		}
   }
}
function qiangzhisave()
{
global $db;
   $url=trim($_POST["url"]);
   $qp=trim($_POST["qp"]);
   $fpr=trim($_POST["fpr"]);
   $pagestart=trim($_POST["pagestart"]);
   $pagestop=trim($_POST["pagestop"]);
   $pageadd=trim($_POST["pageadd"]);
   $spider_depth=intval($_POST["spider_depth"]);
   $include_word=$_POST["include_word"];
   $not_include_word=$_POST["not_include_word"];
   $site_id=$_POST["site_id"];
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
     $array=array('url'=>$url,'qp'=>$qp,'fpr'=>$fpr,'pagestart'=>$pagestart,'pagestop'=>$pagestop,'pageadd'=>$pageadd,'spider_depth'=>$spider_depth,'include_word'=>$include_word,'not_include_word'=>$not_include_word);
	 $db->update("ve123_sites",$array,"site_id='$site_id'");
	 jsalert("�޸ĳɹ�");
   }
   else
   {
        // $row=$db->get_one("select * from ve123_sites where url like '%".$url."%'");

		    $array=array('url'=>$url,'qp'=>$qp,'fpr'=>$fpr,'pagestart'=>$pagestart,'pagestop'=>$pagestop,'pageadd'=>$pageadd,'spider_depth'=>$spider_depth,'include_word'=>$include_word,'not_include_word'=>$not_include_word);
	        $db->insert("ve123_sites",$array);
            jsalert("�ύ�ɹ�");

   }
}
function count_links($url)
{
   global $db;
   $domain=getdomain($url);
   $query=$db->query("select link_id from ve123_links where title<>'' and url like '%".$domain."%' ");
   return $db->num_rows($query);
}
function dell_links($url)
{
   global $db;
   $db->query("delete from ve123_links where url like '%".getdomain($url)."%'");
   $db->query("delete from ve123_links_temp");
   jsalert("����ɹ�");
}
?>
