<?php
/**
 * Comments module's Comment Model
 * To avoid models collision, the models should be named like this :
 * <Module>_<Model name>_model
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments_comment_model extends Base_model {

    //comments table
    protected $_comments_table = 'article_comment';

    /**
     * Model Constructor
     * @access	public
     */
    public function __construct() {
        $this->set_table($this->_comments_table);
        $this->set_pk_name('id_article_comment');
        
		parent::__construct();
    }

    public function save($inputs) {
        // Arrays of data which will be saved
        $data = array();

        // Fields of the comment table
        $fields = $this->list_fields();

        // Set the data to the posted value.
        foreach ($fields as $field)
            $data[$field] = $inputs[$field];

        //$lang_fields = $this->list_fields($this->_comment_lang_table);
//        foreach(Settings::get_languages() as $language)
//        {
//            foreach ($lang_fields as $field)
//            {
//                if ($field != $this->pk_name && $field != 'lang')
//                {
//                    $input_field = $field.'_'.$language['lang'];
//                    if ($inputs[$input_field] !== FALSE)
//                        $data_lang[$language['lang']][$field] = $inputs[$input_field];
//                }
//            }
//        }

        return parent::save($data);
    }

    
/**
     * Deletes one Comment
     *
     * @param int   $id
     *
     * @return int  Number of delete items in comments table
     *
     */
    public function delete($id)
    {
        $nb_rows = parent::delete($id, $this->_comments_table);
     
        //if ($nb_rows > 0)
        //parent::delete($id, $this->_author_lang_table);
     
        return $nb_rows;
    }
    
    
/*----------------------------------------------------------------------------*/
    
    public function get_comments($id_article)
	{
		$this->db->where( "id_article = $id_article" );
        $this->db->where("status = 1"); // TODO - add to adminpanel in config
		$query = $this->db->get( $this->_comments_table);
		
		return $query->result_array();
	}
     
    /**
	 * Saving one blog comment 
	 *
	 * @param		id		article id
	 * @returns		int		created id
	 */
	public function insert_comment($id_article)
	{
        
		// Retrieve data // Получение данных
		$email 		= $this->input->post("email");
		$content 	= nl2br($this->input->post("content"));
		$author 	= $this->input->post("author");
                $site           = $this->input->post("site");
                $status_publ    = $this->input->post("status");
                $ip             = $this->input->ip_address($this->input->post("ip")); 
		
		// Checking data
		if (empty($email)||empty($author)||empty($content))
			return false; 
		
		// Defining record
		$data = array( 
                            "content"       =>	$content,
                            "author"        =>	$author,
                            "email"         =>	$email,
                            "created"       =>	date('Y-m-d H:i:s'),
                            "id_article"    =>	$id_article,
                            "site"          =>  $site,
                            "status"        =>  $status_publ,
                            "ip"            =>  $ip
                    );
					
					
		// Saving record
		$this->db->insert( $this->table, $data );
		
		// Returns created id 
		//return $this->db->insert_id();
		return true;
	}
        
        
    public function update_article($id_article)
	{
		
		// "comments_allow" is a checkbox, will be defined in POST array if checked
		if ($this->input->post("comments_allow")) 
			$comment_allow = "1";
		else
			$comment_allow = "0";
			
		 		
		// Defining record
		$data = array( 
			"comment_allow"=>$comment_allow 
			);
										
			// Updating record
			$this->db->update( "article", $data, "id_article = $id_article" );
		
		return $comment_allow;
		
	}

	public function list_by_article($id_article)
	{

        $this->db->where( "id_article = $id_article" );
        $this->db->order_by("created", "DESC");
		$query = $this->db->get( $this->_comments_table);
		
		return $query->result_array();
	}

       
        
}