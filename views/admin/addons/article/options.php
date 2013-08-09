
<h3 class="toggler toggler-options"><?= lang('module_comments_options_title') ?></h3>

<div class="element element-options">

	<div class="element-content">

		<dl class="small">
			<dt>
				<label for="comments_allowed" title="<?= lang('module_comments_comment_allowed_help') ?>"><?= lang('module_comments_comment_allowed') ?></label>
			</dt>
			<dd>
				<input id="comments_allowed" name="comments_allowed" type="checkbox" class="inputcheckbox" <?php if ($comment_allow == 1):?> checked="checked" <?php endif;?> value="1">
			</dd>
		</dl>
		<div>
			<h4><?= lang('module_comments_options_subtitle') ?></h4>
			
			<ul class="commentPanelList list mb20 mt10">
			<?php if ( ! empty($comments)) : ?>

				<?php foreach ($comments as $comment) : ?>

		        <?php
		        	$id = $comment['id_article_comment'];
		        ?>

		        <li class="comment<?=$id ?> pointer" id="comment_<?=$id ?>" data-id="<?=$id ?>">
		            <a class="icon drag left"></a>
		            <a class="icon delete right"></a>
		            <a class="left pl5 edit title" data-id="<?php echo $id ?>">
		                
		                <?=$id ." - " ?>
		                <?=$comment['author']." - " ?>
		                <?=word_limiter($comment['content'],4)." - " ?>
		                <?=$comment['status']==1 ? lang('module_comments_label_Online') : lang('module_comments_label_Offline') ?>
		            </a>
		        </li>

		    	<?php endforeach; ?>

		    <?php else : ?>
		    	<?= lang('module_comments_no_comment') ?>
		    <?php endif; ?>
			</ul>

			<a class="button light" id="newCommentOptionsButton"><i class="icon-plus"></i><?= lang('module_comments_button_add') ?></a>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	
	$('newCommentOptionsButton').addEvent('click', function(e)
	{    
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

	$$('.commentPanelList li').each(function(item, idx)
    {
        var id = item.getProperty('data-id');
        var a = item.getElement('a.title');
        var del = item.getElement('a.delete');

        a.addEvent('click', function(e)
        {
            // see : /themes/admin/javascript/ionize/ionize_window.js
            // ION.formWindow : function(id, form, title, wUrl, wOptions, data)
            ION.formWindow(
                    'comment' + id, // ID of the window
                    'commentForm' + id, // ID of the comment form
                    'module_comments_title_edit_comment', // lang term of the window title
                    'module/comments/comment/get/' + id, // URL of the controller
                    {
                        'width': 350,
                        'height': 200
                    }
            );
        });

        ION.initRequestEvent(
            del, // The item to add the event on
            admin_url + 'module/comments/comment/delete/' + id, // URL to call
            {}, // Data to send. Here nothing.
            // Confirmation object
                    {
                        'confirm': true,
                        'message': Lang.get('ionize_confirm_element_delete')
                    }
        );
                    

    });

	// comments_allowed XHR update
	$('comments_allowed').addEvent('click', function(e)
	{
		var value = (this.checked) ? '1' : '0';
		ION.JSON('article/update_field', {'field': 'comment_allow', 'value': value, 'id_article': $('id_article').value});
	});
	

</script>