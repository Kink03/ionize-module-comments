<?php
    $id = $id_article_comment;
?>
 
<form name="commentForm<?php echo $id ?>" id="commentForm<?php echo $id ?>" action="<?php echo admin_url() ?>module/comments/comment/save">
 
    <!-- Hidden fields -->
    <input id="id_article_comment<?php echo $id ?>" name="id_article_comment" type="hidden" value="<?php echo $id ?>" />
 
    <!-- number article -->
    <dl class="small">        
        <dt>
            <label for="id_article<?php echo $id_article ?>"><?php echo lang('module_comments_article')?></label>
        </dt>
        <dd>
            <input id="id_article<?php echo $id_article ?>" name="id_article" class="inputtext required" type="text" value="<?php echo $id_article ?>" data-validators="required"/>
        </dd>
    </dl>  
    
    
    
    <!--   -->
    <dl class="small">        
        <dt>
            <label for="site<?php echo $site ?>"><?php echo lang('module_comments_site')?></label>
        </dt>
        <dd>
            <input id="site<?php echo $site ?>" name="site" class="inputtext" type="text" value="<?php echo $site ?>"  />
        </dd>
   </dl>     
        
    <!--   -->
    <dl class="small">        
        <dt>
            <label for="created<?php echo $created ?>"><?php echo lang('module_comments_created')?></label>
        </dt>
        <dd>
            <input id="site<?php echo $created ?>" name="created" class="inputtext" type="text" value="<?php echo $created ?>"  />
        </dd>        
        
        <dt>
            <label for="updated<?php echo $updated ?>"><?php echo lang('module_comments_updated')?></label>
        </dt>
        <dd>
            <input id="updated<?php echo $updated ?>" name="updated" class="inputtext" type="text" value="<?php echo $updated ?>"  />
        </dd> 
        
        <dt>
            <label for="ip<?php echo $ip ?>"><?php echo lang('module_comments_ip')?></label>
        </dt>
        <dd>
            <input id="ip<?php echo $ip ?>" name="ip" class="inputtext" type="text" value="<?php echo $ip ?>"  />
        </dd> 
        
        
        <dl class="small"> 
        <dt>
            <label for="author<?php echo $id ?>"><?php echo lang('module_comments_author')?></label>
        </dt>
        <dd>
            <input id="author<?php echo $id ?>" name="author" class="inputtext required" type="text" value="<?php echo $author ?>" data-validators="required"/>
        </dd>
        </dl>
        
        
      
        
        <dt>
            <label for="email<?php echo $id ?>"><?php echo lang('module_comments_email')?></label>
        </dt>
        <dd>
            <!-- 
                The validation of this mandatory field is first done by JS
                by adding the attribute data-validators="required"
                see : <a href="http://mootools.net/docs/more/Forms/Form.Validator#Validators" target="_blank">http://mootools.net/docs/more/Forms/Form.Validator#Validators</a>
            -->
            <input id="email<?php echo $id ?>" name="email" class="inputtext required" type="text" value="<?php echo $email ?>" data-validators="required"/>
        </dd>
        </dl>
    
    
    <!-- Статус публикации -->
    <dl class="small">        
        <dt>
            <label><?php echo lang('module_comments_label_status')?></label>
        </dt>
        <dd>
            <input id="status<?php echo $id ?>" name="status" <?php if ($status == 1):?>checked="checked" <?php endif; ?>class="radio" type="radio" value="1" />
            <label for="status<?php echo $id ?>">
                <?php echo lang('module_comments_label_Online')?>
            </label>
             <br />
            <input id="status<?php echo $id ?>" name="status" <?php if ($status == 0):?>checked="checked" <?php endif; ?>class="radio" type="radio" value="0" />
            <label for="status<?php echo $id ?>">
                <?php echo lang('module_comments_label_Offline')?>
            </label>
        </dd>
    </dl>




<!-- Статус Admin-->
    <dl class="small">        
        <dt>
            <label><?php echo lang('module_comments_label_admin')?></label>
        </dt>
        <dd>
            <input id="admin<?php echo $id ?>" name="admin" <?php if ($status == 1):?>checked="checked" <?php endif; ?>class="radio" type="radio" value="1" />
            <label for="admin<?php echo $id ?>">
                <?php echo lang('module_comments_label_mod_admin')?>
            </label>
             <br />
            <input id="nomodadmin<?php echo $id ?>" name="admin" <?php if ($status == 0):?>checked="checked" <?php endif; ?>class="radio" type="radio" value="0" />
            <label for="nomodadmin<?php echo $id ?>">
                <?php echo lang('module_comments_label_no_mod_admin')?>
            </label>
        </dd>
    </dl>



<label for="content"><?php echo lang('module_comments_label_comment')?></label> 
 <textarea id="content<?php echo $id ?>" name="content" class="textarea autogrow" rel=""><?php echo $content ?></textarea>
</label>    
 
    
 
</form>
 
<!-- Save / Cancel buttons
   Must be named bSave[windows_id] where 'window_id' is the used ID
   or the window opening through ION.formWindow()
-->
<div class="buttons">
    <button id="bSavecomment<?php echo $id ?>" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCancelcomment<?php echo $id ?>"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>
 
<script type="text/javascript">
 
    // Tabs init
    new TabSwapper({
        tabsContainer: 'commentTab<?php echo $id ?>',
        sectionsContainer: 'commentTabContent<?php echo $id ?>',
        selectedClass: 'selected',
        tabs: 'li',
        clickers: 'li a',
        sections: 'div.tabcontent<?php echo $id ?>'
    });
 
    // Autogrow textareas of the given form ID
    ION.initFormAutoGrow('commentForm<?php echo $id ?>');
 
</script>
