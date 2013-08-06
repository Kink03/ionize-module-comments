<div id="maincolumn">
 
    <h2 class="main demo"><?php echo lang('module_comments_title'); ?></h2>
 
    <div class="subtitle">
 
        <!-- About this module -->
        <p class="lite">
            <?php echo lang('module_comments_about'); ?>
        </p>
 
    </div>
 
<hr />  
	
	
	
	<!-- Выводим список комментов -->
    <div id="moduleCommentsList"></div>
 
</div>
 
<script type="text/javascript">
 
    // инициализация панели toolbox является обязательным
    ION.initModuleToolbox('comments','comments_toolbox');
 
    // Обновление списка комментов
    ION.HTML(
            'module/comments/comment/get_list',      // URL to the controller 
            {},                                 // Data send by POST. Nothing
            {'update':'moduleCommentsList'}  // JS request options
    );
 
</script>