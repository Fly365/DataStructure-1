<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="path"><a href="<?php echo $web_path;?>"><?php echo $site_name;?></a> &gt;&gt; <?php echo $guide;?></div>
<div id="left2">
<?php if($menu_list) { ?>
<div class="t3 bcg"><div class="t3t bgg"><?php echo $sort_title;?></div></div>
<div class="b3 bcg mb12">
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<?php if(is_array($menu_list)) { foreach($menu_list as $sl) { if(!($sl['id']%4)) { ?>
<tr>
<?php } if($sl['sid']==$sortid) { ?>
<td class="f14" width="25%" height="22">&#8226;&nbsp;<font color="red"><?php echo $sl['sort'];?>(<?php echo $sl['qcount'];?>)</font></td>
<?php } else { ?>
<td class="f14" width="25%" height="22">&#8226;&nbsp;<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sl['sid'];?>"><?php echo $sl['sort'];?></a>(<?php echo $sl['qcount'];?>)</td>
<?php } } } ?>
</table>
</div>
<?php } ?>
<div id="subline"></div>
<div id="sub">
<?php if($type==0) { ?>
<span>ȫ������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>"><b>ȫ������</b></a>
<?php } if($type==2) { ?>
<span>�ѽ������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=2"><b>�ѽ������</b></a>
<?php } if($type==1) { ?>
<span>���������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=1"><b>���������</b></a>
<?php } if($type==3) { ?>
<span>ͶƱ������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=3"><b>ͶƱ������</b></a>
<?php } if($type==5) { ?>
<span>�߷�����</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=5"><b>�߷�����</b></a>
<?php } ?>
</div>
<div class="subt bgg">���������Ŀ <?php echo $quescount;?> ��</div>
<?php if($quescount) { ?>
<script type="text/javascript">
function disQstate(s)
{ 
switch (s)
{
case 1:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_time.gif" alt="���������">';break;
case 2:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_ok.gif"  alt ="�ѽ������">';break;
case 3:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_vote.gif" alt="ͶƱ������">';break;
case 4:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_cancel.gif" alt="�ѹر�����">';break;
default: var op='δ֪����';
}
document.write(op);
}
</script>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr>
<td class="nl" height="30">����</td>
<td class="nl" align="center" width="7%">�ش���</td>
<td class="nl" align="center" width="10%">״̬</td>
<td class="nl" align="center" width="10%">����ʱ��</td></tr>
<?php if(is_array($question_list)) { foreach($question_list as $question) { ?>
<tr><td>
<?php if($question['score']) { ?>
<img width="12" height="11" align="absmiddle" alt="����<?php echo $ques_score;?>��" src="<?php echo $web_path;?><?php echo $styledir;?>/s_money.gif" /><span class="red" title="����<?php echo $ques_score;?>��"><?php echo $question['score'];?></span>
<?php } ?>
<span class="f14"><a href="<?php echo $web_path;?><?php echo $question['url'];?>" target="_blank"><?php echo $question['title'];?></a>
  [<a class="lgy" href="<?php echo $web_path;?>browse.php?sortid=<?php echo $question['sid'];?>&type=<?php echo $type;?>"><?php echo $question['sort'];?></a>]</span></td>
<td align="middle"><?php echo $question['answercount'];?></td>
<td align="middle"><script type="text/javascript">disQstate(<?php echo $question['status'];?>);</script></td>
<td align="middle"><?php echo $question['asktime'];?></td></tr>
<?php } } ?>
</table>
<?php } else { ?>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr><td height="30" align="center">�Բ��𣬱�Ŀ¼����ʱû�����⣬��ӭ����Ϊ�����������ĵ�һ�ˣ�</td></tr>
</table>
<?php } ?>
<div id="pg">
<?php if($page>1) { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=<?php echo $type;?>&page=1">[��ҳ]</a>                                                                                                          
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=<?php echo $type;?>&page=<?php echo $page_front;?>">ǰһҳ</a>
<?php } if($pagecount>1) { echo $pagelinks;?>
<?php } if($page<$pagecount) { ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=<?php echo $type;?>&page=<?php echo $page_next;?>">��һҳ</a>                                                                                                                        
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $sortid;?>&type=<?php echo $type;?>&page=<?php echo $pagecount;?>">[βҳ]</a>
<?php } ?>
                     
</div>
</div>
<div id="right2">
<div class="t3 bcb"><div class="t3t bgb">�ȵ�����</div></div>
<div class="b3 bcb mb12">
<div class="w100">
<?php if(is_array($hotques_list)) { foreach($hotques_list as $hq) { ?>
&#8226; <span class="f13"><a class="lq" href="<?php echo $web_path;?><?php echo $hq['url'];?>" target="_blank" title="<?php echo $hq['title'];?>"><?php echo $hq['stitle'];?></a></span><br />
<?php } } ?>
</div>
</div>
</div>
</div>
<?php include template('footer'); ?>
