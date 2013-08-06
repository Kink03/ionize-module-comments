<?php 
if (count($comments))
{}else{echo "No comments";}
?>
<ul class="commentPanelList list mb20 mt10">

    <?php foreach ($comments as $comment) : ?>

        <?php
        $id = $comment['id_article_comment'];
        ?>

        <li class="comment<?=$id ?> pointer" id="comment_<?=$id ?>" data-id="<?=$id ?>">
            <a class="icon drag left"></a>
            <a class="icon delete right"></a>
            <a class="left pl5 edit title" data-id="<?php echo $id ?>">
                
                <?=$id ."---"; ?>
                <?=$comment['author']."---" ?>
                <?=$comment['content']."---" ?>
                <?=$comment['created']."---" ?>
                <?=$comment['status']==1 ? "public":"unpublic"; ?>
                
            </a>
        </li>

    <?php endforeach; ?>

</ul>

<script type="text/javascript">

    // Click Event to display the details of one creator
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

</script>