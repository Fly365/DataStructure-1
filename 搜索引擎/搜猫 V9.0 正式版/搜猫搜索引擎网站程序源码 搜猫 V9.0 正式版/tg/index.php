<?php

require_once('global.php');
is_login();
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>';echo $config['name'];;echo '�ƹ�--��ҳ</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	    <style type="text/css">
<!--
.STYLE1 {color: #0000FF}
-->
        </style>
</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300"><div class="container my-acct">
                        <div id="AccTopCont" class="inner acc-inner">
                            <h4>�ҵ��˻�</h4>
                            <div class="acc-cont">
                                <ul>
                                    <li id="SingleSatus">
                                        <b>�˻���';echo $user['user_name'];;echo '</b>
                                        <p class="status" id="BreadNavigation"><span id="AccName" rel=""></span></p>
                                    </li>
								      <li id="SingleCount"><b>����';echo $user['user_group'];;echo '   ��(0 ��ͨ��Ա����1 ����)</span></b>                                    </li>
                                      <li id="SingleCount">
                                        <b>���֣�';echo $user['points'];;echo '</b>
                                        <p><em></em>��<a target="_parent" id="PayBillLink" href="getpoints.php" class="pay-bill">��λ�û���</a></p>
                                    </li>
                                </ul>
                                <div id="SelectUser" class="select-users">                                </div>
                          </div>
                            <div id="AccMask" class="mask-module"></div>
                        </div>
                        <div id="AccBack" class="acc-back"></div>
                        
                    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

';
?>