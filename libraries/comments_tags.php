<?php

/**
 * Ionize Comments module tags
 *
 * This class define the Comments module tags
 *
 * @package		Ionize
 * @author		
 * @license		http://ionizecms.com/doc-license
 * @link		http://ionizecms.com
 * @since		Version 1.0.3
 *
 *
 */

/**
 * Comments Module's TagManager 
 *
 */
class Comments_Tags extends TagManager {

    /**
     * Tags declaration 
     * 
     */
    
    public static $tag_definitions = array
        (
        "comments:comments"                         => "tag_comments", // Comments loop
        "comments:comment_form"                     => "tag_comment_form", // Display "comment" form
        "comments:comment_save"                     => "tag_comment_save", // Save new comment
        "comments:comments_count"                   => "tag_comments_count", // Return number of comments for an article
        "comments:content"                          => "tag_content", // Return comment content
        "comments:author"                           => "tag_author", // Return comment author
        "comments:email"                            => "tag_email", // Return comment email
        "comments:date"                             => "tag_date", // Display comment date
        "comments:id"                               => "tag_id", // Display comment id
        "comments:gravatar"                         => "tag_gravatar", // Display avatar, using gravatar site
        "comments:comments_allowed"                 => "tag_comments_allowed", // Display nested content if comments allowed
        "comments:comments_admin"                   => "tag_comments_admin", // Display admin options & save change
        "comments:message"                          => "tag_message", 
        "comments:success_message"                  => "tag_success_message", // Display success flash message
        "comments:error_message"                    => "tag_error_message", // Display error flash message
        "comments:comments_allowed"                 => "tag_comments_allowed",  // Display error flash message 
        "comments:author_site"                      => 'tag_author_site'
    );

    /**
     * Base module tag
     *
     */
    public static function index(FTL_Binding $tag) {
        $str = $tag->expand();
        return $str;
    }

    // ------------------------------------------------------------------------
    /**
     * Loads the main Front module's view
     *
     * @param FTL_Binding $tag
     *
     * @return mixed
     */
    public static function tag_comments_main(FTL_Binding $tag) {
        $view = self::$ci->load->view('index', '', TRUE);

        return $view;
    }

    /*     * *********************************************************************
     * Display the form for new blog comment entry
     * Might not be used, use a partial view instead
     */

    public static function tag_comment_form(FTL_Binding $tag) {

        // the tag returns the content of this view :   
        //return $tag->parse_as_nested(file_get_contents(MODPATH . 'Comments/views/comment_form' . EXT));
    }

    /*     * *********************************************************************
     * Save the new entry, if "POST" detected
     *
     */

    public static function tag_comment_save(FTL_Binding $tag) {
        // get CodeIgniter instance
        $CI = & get_instance();

        // Comment was posted, saving it
        if ($content = $CI->input->post('content')) {
            // Loads the comments module model
            if (!isset($CI->comment_model))
                $CI->load->model('comments_comment_model', 'comment_model', true);

            // Save comment 
            if ($CI->comment_model->insert_comment($tag->locals->article['id_article']))   
                $CI->locals->showSuccessFlashMessage = true;
            else
                $CI->locals->showErrorFlashMessage = true;
        }


        return;
    }

    /*     * *********************************************************************
     * Displaying comments
     * Loops through the list of existing comments 
     */

    public static function tag_comments(FTL_Binding $tag) {

        $CI = & get_instance();
        // Loads the comments module model
        if (!isset($CI->comment_model))
            $CI->load->model('comments_comment_model', 'comment_model', true);

        // Load comments
        $comments = $CI->comment_model->get_comments($tag->locals->article['id_article']);


        // Make comment count available to child tags
        if (isset($comments))
            $tag->locals->comment_count = sizeof($comments);
        else
            $tag->locals->comment_count = 0;

        $output = ""; // Var used to store the built display
        // Loop through comments
        foreach ($comments as $comment) {
            // Make comment available to child tags
            //$tag->locals->comment = $comment;
            $tag->set('comment', $comment);

            // Get "comments" tag content & execute child tags
            $output .= $tag->expand();
        }

        // Return output, for display
        return $output;

    }

    /*     * *********************************************************************
     * Display number of comments attached to the post
     *
     */

    public static function tag_comments_count(FTL_Binding $tag) {
        // get CodeIgniter instance
        $CI = & get_instance();
        // Loads the comments module model
        if (!isset($CI->comment_model))
            $CI->load->model('comments_comment_model', 'comment_model', true);

        // Load comments
        $comments = $CI->comment_model->get_comments($tag->locals->article['id_article']);


        return sizeof($comments);
    }

    /*     * *********************************************************************
     * Display comment's content
     *
     */

    public static function tag_content(FTL_Binding $tag) {
        return $tag->locals->comment["content"];
    }

    /*     * *********************************************************************
     * Display comment's author
     *
     */

    public static function tag_author(FTL_Binding $tag) {
        return $tag->locals->comment["author"];
    }
    
        /*     * *********************************************************************
     * Display comment's author
     *
     */

    public static function tag_author_site(FTL_Binding $tag) {
        return $tag->locals->comment["site"];
    }
    
    
    
    

    /*     * *********************************************************************
     * Display comment's email
     *
     */

    public static function tag_email(FTL_Binding $tag) {
        return $tag->locals->comment["email"];
    }

    /*     * *********************************************************************
     * Display comment's creation date
     *
     */

    public static function tag_date(FTL_Binding $tag) {
        if (!isDate($tag->locals->comment["created"]))
            return;
        return $tag->locals->comment["created"];
    }

    /*     * *********************************************************************
     * Display comment's id
     *
     */

    public static function tag_id(FTL_Binding $tag) {
        return $tag->locals->comment["id_article_comment"];
    }

    /*     * **********************************************************************
     * Display comment's author's gravatar
     *
     * Attributes :
     * default : 	can be "mm" (people shadow), "identicon" (default), 
      "monsterid", "wavatar", "retro"
     * 				or link to a public accessible default image 
     * TODO :
     * - Allow to define the size
     */

    public static function tag_gravatar(FTL_Binding $tag) {
        // Using "identicon" if no other default avatar is specified 
        $default_avatar = isset($tag->attr['default']) ? $tag->attr['default'] : 'identicon';

        $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($tag->locals->comment["email"]))) . "?s=80&d=" . $default_avatar;
        return $grav_url;
    }

    /*     * ***********************************************************************
     * Display toolbar for admin : allow to configure comments for an article
     *
     */

    public static function tag_comments_admin(FTL_Binding $tag) {

        $CI = & get_instance();
        $allowed = Authority::can('access', 'admin');

// Display tag content & apply modifications if needed (only if the user is member of "admins+" group)
        if ($allowed) {

            // Loading comments model if needed
            if (!isset($CI->comment_model))
                $CI->load->model('comments_comment_model', 'comment_model', true);

            // Checking if comments should be enabled/disabled (POST) should be done
            if ($CI->input->post("comments_article_update") == "1") {
                $tag->locals->article['comment_allow'] = $CI->comment_model->update_article($tag->locals->article['id_article']);
                $tag->locals->showFlashMessage = true;
                //$CI->locals->showFlashMessage = true;
                //$CI->locals->showSuccessFlashMessage = true;
            }

            if ($CI->input->post("comment_delete") == "1") {
                $CI->comment_model->delete($CI->input->post("id_article_comment"));
                $tag->locals->showFlashMessage = true;
            }

            return $tag->expand();
        }
    }

    /*     * *************************************************************************
     * Display a flash message to inform admin that action was completed
     *
     */

    public static function tag_message(FTL_Binding $tag) {

        if ($tag->locals->showFlashMessage == true) {
            $class = isset($tag->attr['class']) ? ' class="' . $tag->attr['class'] . '"' : '';
            $id = isset($tag->attr['id']) ? ' id="' . $tag->attr['id'] . '"' : '';
            $tag_open = isset($tag->attr['tag']) ? "<" . $tag->attr['tag'] . $id . $class . ">" : '';
            $tag_close = isset($tag->attr['tag']) ? "</" . $tag->attr['tag'] . ">" : '';

            return $tag_open . $tag->expand() . $tag_close;
        }
    }

    /*     * *************************************************************************
     * Display a flash message to inform user that action was completed
     *
     */

    public static function tag_success_message(FTL_Binding $tag) {
        $CI = & get_instance();

        // Build flash message "success"
        if (isset($CI->locals->showSuccessFlashMessage) && $CI->locals->showSuccessFlashMessage == true) {
            $class = isset($tag->attr['class']) ? ' class="' . $tag->attr['class'] . '"' : '';
            $id = isset($tag->attr['id']) ? ' id="' . $tag->attr['id'] . '"' : '';
            $tag_open = isset($tag->attr['tag']) ? "<" . $tag->attr['tag'] . $id . $class . ">" : '';
            $tag_close = isset($tag->attr['tag']) ? "</" . $tag->attr['tag'] . ">" : '';

            return $tag_open . $tag->expand() . $tag_close;
        }
    }

    /*     * *************************************************************************
     * Display a flash error message to inform user that action wasn't completed
     *
     */

    public static function tag_error_message(FTL_Binding $tag) {
        $CI = & get_instance();

        // Build flash message "success"
        if (isset($CI->locals->showErrorFlashMessage) && $CI->locals->showErrorFlashMessage == true) {
            $class = isset($tag->attr['class']) ? ' class="' . $tag->attr['class'] . '"' : '';
            $id = isset($tag->attr['id']) ? ' id="' . $tag->attr['id'] . '"' : '';
            $tag_open = isset($tag->attr['tag']) ? "<" . $tag->attr['tag'] . $id . $class . ">" : '';
            $tag_close = isset($tag->attr['tag']) ? "</" . $tag->attr['tag'] . ">" : '';

            return $tag_open . $tag->expand() . $tag_close;
        }
    }

    /*     * *************************************************************************
     * Expands the tag (display tag content) if comments are allowed
     *
     */

    public static function tag_comments_allowed(FTL_Binding $tag) {
        $result = $tag->locals->article['comment_allow'] == "1" ? $result = $tag->expand() : $result = "";

        //return $result;
        return $result;
    }

}
