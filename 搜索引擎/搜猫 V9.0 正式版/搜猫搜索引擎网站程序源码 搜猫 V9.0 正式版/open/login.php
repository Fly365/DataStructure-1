<?php
session_start();
require("global.php");
$action=$_REQUEST["action"];
switch($action)
{
    case "login":
	        $user_name=trim(HtmlReplace($_POST["entered_login"]));
			$password=trim(HtmlReplace($_POST["entered_password"]));
			$imagecode=trim(HtmlReplace($_POST["entered_imagecode"]));
	        $check=$db->get_one("select * from ve123_zz_user where user_name='".$user_name."' and password='".md5($password)."'");
	        if(empty($check))
	        {
			     header("location:login.php?msg=".urlencode("�û������������!"));
			}
			elseif($_SESSION['dd_ckstr']!=$imagecode)
			{
			     header("location:login.php?msg=".urlencode("��֤�����!"));
			}
			else
			{
			    $_SESSION["user_name"]=$user_name;
		        header("location:./");
			}
	break;
	case "logou":
	      unset($_SESSION["user_name"]);
	break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $config["name"];?>��������ƽ̨</title>
<META http-equiv=Content-Type content="text/html; charset=gbk"><LINK 
href="images/index_old.css" type=text/css rel=stylesheet><LINK 
href="images/general_old.css" type=text/css rel=stylesheet>
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

<META content="MSHTML 6.00.2900.5969" name=GENERATOR>
<style type="text/css">
<!--
.STYLE1 {
	font-family: "����";
	color: #FF0000;
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
</HEAD>
<BODY>
<DIV class=main>
<DIV id=wrapper>
<DIV id=header>
<DIV class=header_left><A href="../open"><IMG 
src="../images/log.gif" width="110" height="40"></A><IMG style="MARGIN: 0px 15px" 
src="images/line.gif"><A href="../open"><IMG 
src="images/logoword.gif"></A> </DIV>
</DIV>
<DIV style="CLEAR: both"></DIV>
<DIV id=container>
<DIV id=content>
<DIV id=content_inner1></DIV>
<DIV id=content_inner2>
<DIV class=title><span class="STYLE1"><?php echo $config["name"];?>��������ƽ̨��ʲô��</span></DIV>
<DIV 
class=ci><?php echo $config["name"];?>��������ƽ̨��һ������<?php echo $config["name"];?>��ҳ�����Ŀ��ŵ����ݷ���ƽ̨�����վ���Ϳ����ߣ�<BR>����ֱ���ύ�ṹ�������ݵ�<?php echo $config["name"];?>���������У�ʵ�ָ�ǿ�󡢸��ḻ��Ӧ�ã�ʹ�û���ø���<BR>���������飬����ø����м�ֵ��������<BR><BR>�ھ�����Ҫ�����롢��˺󣬿���ͨ������ƽ̨ʵ�ֵ���ɫ�����У�<BR>��ָ���ؼ��ʣ�����ȷ����ֱ�ӵ�Ӱ��Ŀ���û���<BR>��ָ������λ�ã���ͳһ����ȫ���չ�����ݣ�<BR>��ָ����ʽ�����ḻ����ǡ������Ӧ��Դ���������������֣�<BR>��ָ������Ƶ�ʣ���<?php echo $config["name"];?>����������ּ�ʱͬ����<BR><BR>
�����ǡ�<A 
href="../s/?wd=360��ȫ��ʿ" 
target=_blank>360��ȫ��ʿ</A>����ʵ����</DIV>
<DIV class=ci2><LABEL>����ʵ����</LABEL> 
  <A 
href="../s/?wd=����" target=_blank>����</A> <A 
href="../s/?wd=2010���籭" 
target=_blank>2010���籭</A> <A 
href="../s/?wd=����˹��" 
target=_blank>����˹��</A> <SPAN>......</SPAN> </DIV>
</DIV>
<DIV id=content_inner3>
<DIV class=title><span class="STYLE1"><?php echo $config["name"];?>��������ƽ̨��ӭʲô������Դ���룿</span></DIV>
<DIV 
class=ci2>Ϊ�������յ��û����鼰ƽ̨�ĳ���������չ����˶�������Դ���ϸ�Ҫ��<BR><BR>��Ŀǰֻ���ܡ�ȷ���ԡ�������Դ��<BR>���������ݣ�Ҫ��ȷ��ȫ�棬���Ҹ��¼�ʱ��<BR>�����ڷ���Ҫ��߶ȵ��ȶ��ԣ��Ϳ��ٵ���Ӧʱ�䡣<BR><BR></DIV>
<DIV 
class=ci3><SPAN>��ȷ���ԡ���Դ</SPAN>��ָ��׼�ġ���ȷ�ģ�����Ψһֵ�����ݣ����磺<BR>����������һ��ʡ���������NBA���̡��ȡ������Ǳ�׼�Ե����ݣ�������𲽷ſ��� 
</DIV></DIV>
<DIV id=content_inner4>
<DIV class=title><IMG title=����Ҫʹ�ã�����β����� src="images/left_title3.gif"> 
</DIV>
<DIV class=ci><A class=step1off onMouseOver="changClassname(this,'1')" 
onmouseout="changClassname(this,'1')" 
href="http://www.baidu.com/search/open_help.html#n2" 
target=_blank>ע��ƽ̨<BR>��֤������վ </A><A class=step2off 
onmouseover="changClassname(this,'2')" onMouseOut="changClassname(this,'2')" 
href="http://www.baidu.com/search/open_help.html#s1" 
target=_blank>ȷ��չ����ʽ<BR>ָ���������� </A><A class=step3off 
onmouseover="changClassname(this,'3')" onMouseOut="changClassname(this,'3')" 
href="http://www.baidu.com/search/open_help.html#s2" 
target=_blank>�ύ��Դ����<BR>�ȴ����</A> <A class=step4off 
onmouseover="changClassname(this,'4')" onMouseOut="changClassname(this,'4')" 
href="http://www.baidu.com/search/open_help.html#s3" 
target=_blank>���ͨ��<BR>������չ��</A> </DIV></DIV>
<DIV style="FONT-SIZE: 12px"><IMG style="MARGIN: 0px 8px; VERTICAL-ALIGN: -2px" 
src="images/send_email.gif">��ƽ̨���κ�������飬���µ����ǣ�����</DIV>
</DIV>
<DIV id=aside>
<DIV class=aside_inner1>
<form action='login.php' METHOD=post onSubmit="return checkData()">
	<input type="hidden" name="action" value="login">
	  <table width="90%" border="0" cellspacing="0" cellpadding="0" style="padding-left:20px; padding-top:10px;">
	  <tr>
			<td height="20" colspan="2">
			  <?php
			$msg=HtmlReplace($_GET["msg"]);
			if(empty($msg))
			{
			   echo "ע���û����¼";
			}
			else
			{
			    echo $msg;
			}
			?>			</td>
			</tr>
		<tr>
		  <td height="20" class="f14">�û�����</td>
		  <td>
			
				<input type="text" name="entered_login" class=txt>
			    </td>
		</tr>
		<tr>
		  <td height="20" class="f14">�ܡ��룺</td>
		  <td>
			
				<input type="password" name="entered_password" class=txt>
	     	  </tr>
		<tr>
		  <td height="20" class="f14">��֤�룺</td>
		  <td><input name="entered_imagecode" type="text" id="entered_imagecode" size="6" maxlength="4">
			&nbsp;<img src="../include/vdimgck.php" align="absmiddle"></td>
		</tr>
		<tr>
		  <td height="35">&nbsp;</td>
		  <td><input type="submit" name="button2" id="button2" value="" class=login_button onclick="javascript:window.location.href='open/reg.php'">
			&nbsp;<a href="getpwd.php" style="MARGIN-TOP: -2px; FONT-SIZE: 12px; MARGIN-LEFT: 10px; VERTICAL-ALIGN: text-top" >�һ�����</a></td>
		</tr>
	  </table>
	</form>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<FORM action=register.php method=get>
<DIV class=title>û��ƽ̨�ʺ�?</DIV>
<div align="center"><a href="reg.php" title="����ע��" target="_blank">
  <img src="images/reg.gif" style="vertical-align:middle">
  </a></div>
</FORM></DIV>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<DIV class=aside_inner2><SPAN class=t1>�����ȵ�</SPAN> 
<DIV class=ci1>��<A href="http://open.baidu.com/coop/kefu.html" 
target=_blank>ƽ̨������¼�ͷ��绰��Դ</A><SUP>new</SUP><BR>��<A 
href="http://open.baidu.com/coop/xiazai.html" 
target=_blank>ƽ̨������¼��������Դ</A><SUP>new</SUP><BR></DIV></DIV>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<DIV class=aside_inner2><SPAN class=t1>��������</SPAN> 
<DIV class=ci1>��<A href="#" 
target=_blank><?php echo $config["name"];?>��������ƽ̨��sitemap�к�����</A><BR>��<A 
href="#" 
target=_blank>��Դ��¼�ı�׼��ʲô��</A><BR>��<A 
href="#" 
target=_blank>����ύ��Դ����Դ�ύ������ʲô��</A><BR>��<A 
href="#" 
target=_blank>��Դ�ύ���û���Ч��</A><BR>��<A 
href="#" 
target=_blank>�ҿ����ύ�����Դô��</A><BR>��<A 
href="#" 
target=_blank>��Ҫ�µ�չ����ʽ��</A><BR>��<A 
href="#" 
target=_blank>��Щ�������ױ��Һ��ԣ�</A><BR>��<A 
href="#" 
target=_blank>��Դ���ߺ����ܼ��չ�����ô��</A><BR>�� <SPAN 
style="FONT-WEIGHT: bold; COLOR: #0055ba; FONT-FAMILY: ����"><A 
href="#" 
target=_blank>����&gt;&gt;</A></SPAN> </DIV>
<DIV 
style="MARGIN-TOP: 1.5em; MARGIN-LEFT: 25px; LINE-HEIGHT: 180%">�����������⣿<BR>��ӭ����<A 
style="COLOR: #0055ba" 
href="http://shiwww.com/bbs/" 
target=_blank><?php echo $config["name"];?>��������ƽ̨��̳</A>���ۡ� </DIV></DIV>
<DIV style="CLEAR: both"></DIV>
<DIV 
style="BORDER-TOP: #b2beda 1px solid; MARGIN-LEFT: 2px; OVERFLOW: hidden; MARGIN-RIGHT: 2px; HEIGHT: 2px; BACKGROUND-COLOR: #fff"></DIV>
<DIV style="MARGIN-TOP: 20px; TEXT-ALIGN: center"><A title=������� 
href="http://x.baidu.com/" target=_blank></A> </DIV>
</DIV>
<DIV style="CLEAR: both"></DIV></DIV>
<DIV id=footer>
<P class=b>&copy;2010  &nbsp;&nbsp;&nbsp;&nbsp; <A 
href="#">ʹ��<?php echo $config["name"];?>��������ǰ�ض�</A> <A 
href="http://www.miibeian.gov.cn/" target=_blank><?php echo $config["icp"];?></A><IMG 
src="images/gs.gif"> </P>
</DIV></DIV></DIV></BODY></HTML>
