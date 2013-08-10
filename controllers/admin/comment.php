<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Module Admin controller
*
*
*/

class Comment extends Module_Admin 
{

    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    public function construct() 
	{

        // Loads the model as 'comment_model'
        $this->load->model('comments_comment_model', 'comment_model', true);
		
    }

    public function get_list() 
	{
        $conds = array(
            'order_by' => 'created DESC'
        );
        
        $this->template['comments'] = $this->comment_model->get_list($conds);
        $this->output('admin/comments_list');
    }

    /**
     * Displays detailed comments
     * @param int ID : id of the comment
     *
     */
    public function get($id) 
	{
        $where = array(
            'id_article_comment' => $id
        );
        $this->template = $this->comment_model->get($where);
        $this->output('admin/comment_detail');
    }

    /**
     * Displays detailed comments of one article
     * @param int ID : id of the article
     *
     */
    public function list_by_article($id) 
    {
        $where = array(
            'id_article' => $id,
            'order_by' => 'created DESC'
        );
        $this->template['comments'] = $this->comment_model->list_by_article($where);
        $this->output('admin/comments_article_list');
    }

    /**
     * Saves one comment
     *
     */
    public function save() {

        // The content must be set
        if ($this->input->post('content') != '') {
            $id_comment = $this->comment_model->save($this->input->post());

        // Update the comments list
        $this->update[] = array(
            'element' => 'moduleCommentsList',
            'url' => admin_url() . 'module/comments/comment/get_list'
        );

        // Send the user a message
        $this->success(lang('ionize_message_operation_ok'));
        } else {
            // Send the user a message
            $this->error(lang('ionize_message_operation_nok'));
        }
    }

    /**
     * Displays the comment form
     *
     */
    function create() {
        $this->comment_model->feed_blank_template($this->template);
        $this->output('admin/comment_detail');
    }

    /**
     * Delete one author
     *
     */
    public function delete($id) {
        if ($this->comment_model->delete($id) > 0) {
            // Update the comments list
            $this->update[] = array(
                'element' => 'moduleCommentsList',
                'url' => admin_url() . 'module/comments/comment/get_list'
            );

            // Send the user a message
            $this->success(lang('ionize_message_operation_ok'));
        } else {
            // Send the user a message
            $this->error(lang('ionize_message_operation_nok'));
        }
    }



    

}