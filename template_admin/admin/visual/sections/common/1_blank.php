<!-- 组件 -->
<div class="visual-drag-box box-element" style="clear:both;height:5px;">
    <span class="drag label btn-group drag-container">
        <button type="button" class="btn btn-black"><i class="icon-grid"></i></button>
        <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
        <ul class="dropdown-menu btn-black-dropdown-menu">
            <li><a title="{lang_admin('layer_attributes')}" data-target="#div-config" role="button" data-toggle="modal"><i class="glyphicon glyphicon-cog"></i>{lang_admin('layer_attributes')}</a></li>
            <li><a title="{lang_admin('delete')}" class="remove"><i class="glyphicon glyphicon-remove"></i>{lang_admin('delete')}</a></li>
        </ul>
    </span>
	<div class="preview">
		<img src="{$base_url}/common/plugins/visual/images/section/blank.png">
		<p>{lang_admin('visual_blank')}</p>
	</div>
	<div class="view">
		<div class="visual-audio">
			<div class="codearea">
				<div class="blank5 visual-blank"></div>
			</div>
			<div class="viewarea">
				<div class="blank5 visual-blank"></div>
			</div>
		</div>
	</div>
</div>
<!-- 组件结束 -->