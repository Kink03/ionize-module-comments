
<div class="divider">
	<a class="button light" id="newCommentToolbarButton">
		<i class="icon-plus"></i><?= lang('module_comments_button_add') ?>
	</a>
</div>

<script type="text/javascript">

	$('newCommentToolbarButton').addEvent('click', function(e)
	{
            // see : /themes/admin/javascript/ionize/ionize_window.js
            // ION.formWindow : function(id, form, title, wUrl, wOptions, data)
            
		ION.formWindow(
			'comment',
			'commentForm',
			Lang.get('module_comments_button_add'),
			admin_url + 'module/comments/comment/create',
			{
				'width':350,
				'height':200
			}
		);
	});

</script>
