<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ionize, creative CMS
 *
 * @package		Ionize
 * @author		 
 * @license		http://ionizecms.com/doc-license
 * @link		http://ionizecms.ru
 * @since		Version 0.0.1
 */

// ------------------------------------------------------------------------

/**
 * #module_name Module Controller
 *
 * @author		 
 *
 * @usage		Have a look at the readme.txt file
 *
 *
 */


class Comments extends My_Module 
{

	// ------------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}


	// ------------------------------------------------------------------------

	/**
	 * Just do nothing.
	 * 
	 *
	 */
	function index()
	{
		//echo "выводим на index в контролллере";
		$this->template['title'] = 'comments module title'; // var in views
        $this->output('main_comments'); //views
	}

	
	// ------------------------------------------------------------------------


	
}