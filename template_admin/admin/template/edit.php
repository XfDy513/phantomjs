<div class="main-right-box">
<h5>{lang_admin('template_source_code')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('you_can_edit_template_annotations_to_make_it_easier_to_categorize_and_select_templates_for_content')}
</div>


<style type="text/css">
	textarea {width:100%; height:300px; overflow:auto;}
	.textarea-rows {outline:1px solid #999;}
</style>


<form name="form1" id="form1" method="post" action="">


<div class="page">{$link_str}</div>


<div class="table-responsive">

<table class="table table-hover">
<thead>
<tr class="th">
                <th>{lang_admin('name')}</th>
                <th>{lang_admin('describe')}</th>
                
            </tr>
        </thead>

  <tbody>
    {loop $tps $tpl $tp}
    <?php if (preg_match('/#/',$tp)) continue; ?>
    {php $_tp=str_replace('_html','.html',$tp);}
    {php $_tp=str_replace('_css','.css',$_tp);}
    {php $_tp=str_replace('_js','.js',$_tp);}
    {php $tpt=str_replace('/','_d_',$tpl);}

    {php $cs=preg_replace('%\/.*%', '', $tpl);}


    {if preg_match('/\.|└/',$tp)}
               <tr class="{$cs}_li" style="display:none" >
    {else}
               <tr  id="{$tpt}_div">
    {/if}
                    <td>
						<span style="float:left;">
                            {$_tp}
						</span>
                        {if preg_match('/.(html|css|js)/',$tp)}
                        <span style="cursor:pointer;padding-left:10px" onclick="toggle_edit('#{$tpt}')" id="{$tpt}_state_toggle">[{lang_admin('see')}]</span>
                        {elseif !preg_match('/└/',$_tp)}
                        <span style="float:left;cursor:pointer;" onclick="$('.{$tpt}_li').toggle()" id="{$tpt}_dir_state_toggle">&nbsp;<i class="glyphicon glyphicon-folder-open"></i></span>
                        {/if}
                    </td>
                    <td>
                        <input type="text" name="{$tpl}_name" class="form-control" value="{=@help::tpl_name($tpl)}">
                    </td>
                    <!-- <td width="31%" style="padding-left:10px;">
                        <input type="text" name="{$tpl}_note" class="form-control" value="{=@help::tpl_note($tpl)}">
                    </td> -->
                </tr>
          

                <!--dir-->
                <tr id="{$tpt}"  name="textareaTr" style="display:none" >
                   <td colspan="2" >
                                    <div id="{$tpt}_textarea">
                                        <textarea id="{$tpt}_content" name="{$tpt}_content"  class="textarea-number"></textarea>
                                    </div>

                                    <div class="padding10">
                                        <div id="{$tpt}_save_button" style="display:none">
                                            <input type="button" value="{lang_admin('preservation')}" name="{$tpt}_edit" class="btn btn-success"
                                                   onclick="if(get('{$tpt}_fck')) content=getContent('{$tpt}_content'); else content=this.form.{$tpt}_content.value;  edit_save('{$tpt}',content);"/>
                                        </div>
                                    </div>
                  </td>
                </tr>
    {/loop}

	  </tbody>
        </table>
</div>
<div class="blank30"></div>
<div class="line"></div>
    <div class="blank30"></div>
    <input type="submit" value=" {lang_admin('modify')} " name="submit" class="btn btn-primary" />
</form>
<div class="page">{$link_str}</div>


<form name="editform" id="editform" method="post" action="<?php echo url('template/save');?>" >
    <input type="hidden" value="" name="sid" id="sid" />
    <input type="hidden" value="" name="slen" id="slen" />
    <input type="hidden" value="" name="scontent" id="scontent" />
</form>

</div>
</div>


<script id="autolinenumber" src="{$base_url}/common/plugins/auto-line-number/auto-line-number.js"></script>
<script src="{$base_url}/common/plugins/auto-line-number/jquery-form.js"></script>
<script type="text/javascript">
    function hide_edit(id) {
        $(id+'_save_button').css('display','none');
        $(id).hide('fast');
        $(id+'_content').val('');
        // $(id+'_textarea').html('');
        //$(id+'_content').resizable('destroy')
    }

    function show_edit(id) {

        $.ajax({
            url: '<?php echo url('template/fetch',true);?>',
            data:'&id='+id,
            type: 'POST',
            dataType: 'json',
            timeout: 3000,
            error: function(){
            },
            success: function(data){
                $(id+'_content').val(data.content);
                $(id+'_content').setTextareaCount( $(id+'_content'));
                $(id+'_content').css('width','98%');
                $('.textarea-group').css('width','100%');
                if(data.content)
                    $(id+'_save_button').css('display','block');
            }
        });

        $(id).show('fast');
        //$(id+'_content').resizable();
    }


    function show_fckedit(id) {
        $.ajax({
            url: '<?php echo url('template/fckedit',true);?>',
            data:'&id='+id,
            type: 'POST',
            dataType: 'json',
            timeout: 3000,
            error: function(){
            },
            success: function(data){
                $(id+'_textarea').html(data.content);
                if(data.content)
                    $(id+'_save_button').css('display','block');
            }
        });

        $(id).show('fast');
        //$(id+'_content').resizable();
    }

    function toggle_edit(id,fck) {
        if($(id).css('display')=='none') {
            show_edit(id);
            $(id+'_state_toggle').html("[{lang_admin('hide')}]");
        }
        else {
            if(fck)  show_fckedit(id);
            else{
                hide_edit(id);
                $(id+'_state_toggle').html("[{lang_admin('see')}]");
            }
        }
    }


    function edit_save(id,content) {
        content=content.replace(/\<\?php.+?\?>/g, '');
        $('#sid').val(id);
        $('#slen').val(content.length);
        $('#scontent').val(content);
        $('#editform').ajaxSubmit(function(data) {
            if(data=='ok') alert("{lang_admin('save_successfully')}");
            else alert("{lang_admin('save_failed')}");
        });
    }


    function helper() {
        $("#example").dialog({ modal: true });
    }
</script>

<script type="text/javascript">
	$(".textarea-number").setTextareaCount({
		width: "30px",
		bgColor: "#eee",
		color: "#333",
		display: "inline-block"
	});
</script>