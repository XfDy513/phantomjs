<style type="text/css">
.main .main-right-box {
position: absolute;
top:130px;
right:30px;
left:30px;
bottom:30px;
}
</style>


<div class="main-right-box">
<h5>{lang_admin('wechat_public_number_list')}</h5>
<div class="blank20"></div>
<div class="box" id="box">
<input class="btn btn-primary" type="button" value=" {lang_admin('add_public_number')} " onclick="gotourl(this)" data-dataurlname="{lang_admin('add_public_number')}" data-dataurl="{$base_url}/index.php?case=weixin&act=add&admin_dir={get('admin_dir',true)}&site=default" />
<div class="blank30"></div>
<div id="tagscontent" class="right_box">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">


  <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="catid"><!--id-->{lang_admin('id')}</th>
          <th class="catname"><!--name-->{lang_admin('wechat_public_number')}</th>
          <th class="catid">{lang_admin('original_id')}</th>
          <th class="htmldir"><!--url-->{lang_admin('wechat_number')}</th>
          <th class="manage">{lang_admin('dosomething')}</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">

<td class="catid" >{$d['id']}</td>
<td class="catname" align="left">{$d['name']}</td>
<td class="catid" align="left">{$d['oldid']}</td>
<td class="htmldir" align="left">{$d['weixinid']}</td>
<td class="manage">
<a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixin/add2/id/'.$d['id']);?>" title="{lang_admin('edit')}"><i class="glyphicon glyphicon-edit"></i></a>
<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinmenu/list/id/'.$d['id']);?>" title="{lang_admin('menu')}"><i class="glyphicon glyphicon-list-alt"></i></a>
<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinreply/list/id/'.$d['id']);?>" title="{lang_admin('reply')}"><i class="glyphicon glyphicon-comment"></i></a>
<a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"  data-dataurl="<?php echo url('weixin/del/id/'.$d['id']);?>" title="{lang_admin('delete')}"><i class="glyphicon glyphicon-trash"></i></a>
</td>
</tr>
{/loop}
      </tbody>
    </table>
	</div>
</form>


<div class="blank30"></div>
</div>
</div>