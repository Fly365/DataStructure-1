<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="path"><a href="<?php echo $web_path;?>"><?php echo $site_name;?></a> &gt&gt �������а�</div>
<div id="left2">
<div class="w100">
<div id="subline"></div>
<div id="sub">
<?php if($stype=='all') { ?>
<span>�ܻ������а�</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>scorelist.php"><b>�ܻ������а�</b></a>
<?php } if($stype=='week') { ?>
<span>���ܻ������а�</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>scorelist.php?stype=week"><b>���ܻ������а�</b></a>
<?php } if($stype=='month') { ?>
<span>���»������а�</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>scorelist.php?stype=month"><b>���»������а�</b></a>
<?php } ?>
</div>
<div class="subt bgg">�����ϰ� <?php echo $membercount;?> ��</div>
<?php if($membercount) { ?>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr>
<td class="nl" nowrap="nowrap" align="center" height="30" width="5%">&nbsp;&nbsp;����</td>
<td class="nl" nowrap="nowrap" align="center" width="15%">�û���</td>
<td class="nl" nowrap="nowrap" align="center" width="10%">����</td>
<td class="nl" nowrap="nowrap" align="center" width="5%">�� ��</td>
<td class="nl" nowrap="nowrap" align="center" width="20%">����¼</td>
</tr>
<?php if(is_array($score_list)) { foreach($score_list as $members) { ?>
<tr>
<td height="65" align=center><?php echo $members['orderid'];?></td>
<td height="65" align=center>
<a href="<?php echo $web_path;?>member.php?uid=<?php echo $members['uid'];?>" target="_blank"><?php echo $members['username'];?></a>
</td>
<td height="65" align=center><?php echo $members['newscore'];?></td>
<td height="65" align=center>
<?php if($members['gender']==1) { ?>
��
<?php } elseif($members['gender']==2) { ?>
Ů
<?php } else { ?>
����
<?php } ?>
</td>
<td height="65" align=center><?php echo $members['lastlogin'];?></td>
</tr>
<?php } } ?>
</table>
<?php } else { ?>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr><td height="30" align="center">&nbsp;</td></tr>
</table>
<?php } ?>
<div id="pg">
<?php if($page>1) { ?>
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=1">[��ҳ]</a>                                                                                                          
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=<?php echo $page_front;?>">ǰһҳ</a>
<?php } if($pagecount>1) { echo $pagelinks;?>
<?php } if($page<$pagecount) { ?>
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=<?php echo $page_next;?>">��һҳ</a>                                                                                                                        
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=<?php echo $pagecount;?>">[βҳ]</a>
<?php } ?>
                     
</div>
</div>
</div>
<div id="right2">
&nbsp;
</div>
</div>
<br />
<?php include template('footer'); ?>
