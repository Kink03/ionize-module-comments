<?php
/**
 * Ionize  Module
 * Frontend Main view
 *
 * Loaded by the tag : <ion:comment:main />
 *
 * Receives : no vars
 */
?>

<!-- Container for the Comments List -->
<div id="moduleCommentsList"></div>


<script type="text/javascript">

	// Controller URL to call
	var url = 'comments/comment/get_list';

	// Ajax request
	jQuery.ajax(
		url,
		{
			type:'post',
			// Get the result (the view HTML string)
			// and display it in the Authors List container
			success: function(result)
			{
				$('#moduleCommentsList').html(result);
			}
		}
	);

</script>