<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="path"><a href="<?php echo $web_path;?>"><?php echo $site_name;?></a> &gt&gt
<?php if($type==0) { ?>
ȫ������
<?php } elseif($type==1) { ?>
���������
<?php } elseif($type==2) { ?>
�ѽ������
<?php } elseif($type==3) { ?>
ͶƱ������
<?php } elseif($type==5) { ?>
�߷�����
<?php } elseif($type==6) { ?>
�Ƽ�������
<?php } ?>
</div>
<div id="left2">
<div class="w100">
<div id="subline"></div>
<div id="sub">
<?php if($type==0) { ?>
<span>ȫ������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php"><b>ȫ������</b></a>
<?php } if($type==2) { ?>
<span>�ѽ������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?type=2"><b>�ѽ������</b></a>
<?php } if($type==1) { ?>
<span>���������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?type=1"><b>���������</b></a>
<?php } if($type==3) { ?>
<span>ͶƱ������</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?type=3"><b>ͶƱ������</b></a>
<?php } if($type==5) { ?>
<span>�߷�����</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>browse.php?type=5"><b>�߷�����</b></a>
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
<tr><td class="nl" height="30">����</td>
<td class="nl" align="center" width="10%">�ش���</td>
<td class="nl" align="center" width="10%">״̬</td>
<td class="nl" align="center" width="10%">����ʱ��</td></tr>
<?php if(is_array($ques_list)) { foreach($ques_list as $question) { ?>
<tr><td>
<?php if($question['score']) { ?>
<img width="12" height="11" align="absmiddle" alt="����<?php echo $ques_score;?>��" src="<?php echo $web_path;?><?php echo $styledir;?>/s_money.gif" /><span class="red" title="����<?php echo $ques_score;?>��"><?php echo $question['score'];?></span>
<?php } ?>
<span class="f14"><a href="<?php echo $web_path;?>question.php?qid=<?php echo $question['qid'];?>" target="_blank"><?php echo $question['title'];?></a> [<a class="lgy" href="<?php echo $web_path;?>browse.php?sortid=<?php echo $question['sid'];?>&type=<?php echo $type;?>"><?php echo $question['sort'];?></a>]</span></td>
<td align="center"><?php echo $question['answercount'];?></td>
<td align="center"><script type="text/javascript">disQstate(<?php echo $question['status'];?>);</script></td>
<td align="center"><?php echo $question['asktime'];?></td></tr>
<?php } } ?>
</table>
<?php } else { ?>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr><td height="30" align="center">�Բ��𣬱�Ŀ¼����ʱû�����⣬��ӭ����Ϊ�����������ĵ�һ�ˣ�</td></tr>
</table>
<?php } ?>
<div id="pg">
<?php if($page>1) { ?>
<a href="<?php echo $web_path;?>browse.php?type=<?php echo $type;?>&page=1">[��ҳ]</a>                                                                                                          
<a href="<?php echo $web_path;?>browse.php?type=<?php echo $type;?>&page=<?php echo $page_front;?>">ǰһҳ</a>
<?php } if($pagecount>1) { echo $pagelinks;?>
<?php } if($page<$pagecount) { ?>
<a href="<?php echo $web_path;?>browse.php?type=<?php echo $type;?>&page=<?php echo $page_next;?>">��һҳ</a>                                                                                                                        
<a href="<?php echo $web_path;?>browse.php?type=<?php echo $type;?>&page=<?php echo $pagecount;?>">[βҳ]</a>
<?php } ?>
                     
</div>
</div>
</div>
<div id="right2">
<div class="t3 bcb"><div class="t3t bgb">�ȵ�����</div></div>
<div class="b3 bcb mb12">
<div class="w100">
<?php if(is_array($hotques_list)) { foreach($hotques_list as $hq) { ?>
&#8226; <span class="f13"><a class="lq" href="<?php echo $web_path;?>question.php?qid=<?php echo $hq['qid'];?>" target="_blank" title="<?php echo $hq['title'];?>"><?php echo $hq['stitle'];?></a></span><br />
<?php } } ?>
</div>
</div>
</div>
</div>
<br />
<?php include template('footer'); ?>
