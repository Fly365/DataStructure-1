<?php

function is_login()
{
global $user;
if(empty($user['user_name']))
{
header('location:login.php');
}
}
function get_qijia($keywords)
{
global $db,$zz_config;
$row=$db->get_one("select * from ve123_zz_set_keywords where keywords='".$keywords."'");
if(empty($row))
{
$qijia=$zz_config['default_point'];
}
else
{
$qijia=$row['price'];
}
return $qijia;
}
function headhtml()
{
global $user,$zz_user_group_array;
$filename=basename($_SERVER['SCRIPT_NAME']);
$action=$_REQUEST['action'];
;echo '        <div class="head">
        	<div class="head-wrapper">
        		<a href="#" id="Logo" class="logo"><img width="133px" height="43px" src="../images/log.gif" title="��ʱ���ƹ�" alt="��ʱ���ƹ�ƽ̨" /></a>
        		<div id="RightTopNav" class="right-top-nav">
        			<strong>';echo $user['user_name'];;echo '</strong>
        			<span id="BridgeHi">����:';echo $user['user_group'];;echo '</span>
        			
        			<a href="login.php?action=logou">�˳�</a>
        			<div id="ContactMenu">
        				<div id="BridgeService"></div>
        				<div><span class="block"><a id="RightNavMyPromoAdvLink" target="_blank" href="#">������Ϣ</a></span></div>
        				<div><span class="block"><a id="RightNavMessToBdLink" target="_blank" href="#">����</a></span></div>
        			</div>
        			<iframe id="ContactMenuMask" class="contact-mask"></iframe>
        		</div>
        		<div id="HelpTip" class="right-bottom-nav"></div>
        		<div id="MainNavigation" class="mainnav">
        			<span';if($filename=='index.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="./">��ҳ</a>
					<i></i></span>
        			<span';if($filename=='manage.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="../open/manage.php">����ƽ̨</a>
        			<i></i></span>
        			<span';if($filename=='manage.php'){echo " class=\"current\"";};echo '><u></u>
        			    <a href="manage.php">�ƹ����</a>
        			<i></i></span>
					<span';if($filename=='tg_open.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="tg_open.php">����ҳ�Ҳ��ƹ�</a>
        			<i></i></span>
					<span';if($filename=='account.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="account.php">�˻���Ϣ</a>
        			<i></i></span>
                    <span';if($filename=='aipay.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="aipay.php">��Ա����ֵ</a>
        			<i></i></span>
                    <span';if($filename=='pay.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="pay.php">֧������ֵ</a>
        			<i></i></span>
					<span';if($filename=='getpoints.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="getpoints.php">��λ�û���</a>
        			<i></i></span>
        			<span';if($filename=='reports.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="reports.php">����</a>
        			<i></i></span>
					
					<span';if($filename=='union.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="union.php">���˴���</a>
        			<i></i></span> 
       		  </div>
       	  </div>
		';
if($filename=='account.php')
{
;echo '				<div id="SubNavigation" class="subnav">
		<div class="subnav-wrapper">

			<span';if($action==''){echo " class=\"current\"";};echo '><i></i><u></u><s></s><b></b><a href="';echo $filename;;echo '" target="_self">�����趨</a></span>
			<span class="split">|</span>
			
			
			<span';if($action=='epw'){echo " class=\"current\"";};echo '><i></i><u></u><s></s><b></b><a href="?action=epw" target="_self">�޸�����</a></span>
			<span class="split"></span>
	
		</div>
	</div>
		';
}
;echo '		';
if($filename=='manage.php')
{
;echo '				<div id="SubNavigation" class="subnav">
		<div class="subnav-wrapper">

			<span';if($action==''){echo " class=\"current\"";};echo '><i></i><u></u><s></s><b></b><a href="';echo $filename;;echo '" target="_self">��ӹؼ���</a></span>
			<span class="split">|</span>
			
			
			
	
		</div>
	</div>
		';
}
;echo '        	<div class="head-bottom"></div>
        </div>
';
}
;echo '';
function foothtml()
{
global $config;
;echo '	</div>
        <div id="MaskDiv" class="maskDivNoColor"></div>
        <div class="foot">';echo $config['copyright'];;echo '		&nbsp;&nbsp;<a target="_blank" href="http://www.1230530.com/">Powered by 1230530.Com</a>
		</div>

	</body>
</html>
';
}

?>
