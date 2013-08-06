<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Module admin controller
*
*
*/

class Comments extends Module_Admin 
{

    /** 
     * Constructor
     *
     * @access  public
     * @return  void
     */
    public function construct() 
    {

    }

    // ------------------------------------------------------------------------

	/**
	* Admin panel
	* Called from the modules list.
	*
	* @access	public
	* @return	parsed view
	*/
    public function index() {

        //print "module default controller output";
        //$this->template['title'] = 'Admint-Comments module title';
        $this->output('admin/comments');
    }

    // ------------------------------------------------------------------------

    public function _addons($object = array())
    {
        $CI =& get_instance();
     
        $CI->load->model('comments_comment_model', 'comment_model', true);

        // Send the article to the view
        $data['article'] = $object;

        if (array_key_exists('comment_allow', $object)) { //just article, not page or whatever!
            $data['comment_allow'] = $data['article']['comment_allow'];
            $data['comments'] = $CI->comment_model->list_by_article($data['article']['id_article']);
        }

        // Options panel Top Addon
        $CI->load_addon_view(
            'comments', // Module folder
            'article', // Parent panel code
            'options_bottom', // Placehoder code
            'admin/addons/article/options', // View to display in the placeholder
            $data // Data send to the view
        );
    }

}