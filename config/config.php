<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$config['module']['comments'] = array
(
    'module'        => "Comments",
    'name'          => "Comments Module",
    'description'   => "Comments module. Manage Comments.",
    'author'        => "Victor Efremov (aka XTRO)",
    'version'       => "0.2a",
 
    // 'uri' should be the module's folder in lowercase.
    // From 1.0.3, it is not mandatory to set 'uri'.
    'uri'           => 'comments',
    'has_admin'     => TRUE,
    'has_frontend'  => FALSE,

 
    // Array of resources
    // These resources will be added to the role's management panel
    // to allow / deny actions on them.
    'resources' => array(
        /*
         * Default added resource : 'module/<module_key>'
         *
         * Important :
         * 		The module has one default resource : 'access'
         * 		If the main checkbox is checked for one role in the module's permissions,
         * 		the role will:
         * 		- See the module icon on the dashboard if the module has one admin panel
         * 		- Have the module link in the menu "Modules" if the module has one admin panel
         *
         * Usage : Authority::can('access', 'module/<module_key>')
         *
         * Actions based rules (Added with this config file) :
         * '<resource_key>' => array(
         *		'title' => 'Resource title',
         *		'actions' => '<action_key_1>, <action_key_2>, <action_key_3>',
         *		'description' => 'Description of the resource in the role panel'
         * )
         * Usage : Authority::can('<action_key_1>', 'module/<module_key>/<resource_key>')
         */
        // Authority::can('access', 'module/comments/admin')
                // Authority::can('access', 'module/comments/my_resource')
        'my_resource' => array(
                'title' => 'My Comments Module Resource',
                'actions' => 'edit,save,delete'
        ),
        'my_resource/one_child_resource' => array
        (
                // Parent of the module's ressource in the resources tree
                'parent' => 'my_resource',
                'title' => 'One Child Resource',
                'actions' => 'action_1',
        ),
	),
);

return $config['module']['comments'];



/*
 *
		'admin' => array(
			'title' => 'Demo Module Administration'
		),
		'one_resource' => array
		(
			// Title of the resource
			'title' => 'Resource name',
			// Can be 'edit', 'eat_cheese', what you want
			'actions' => 'action_key_1,action_key_2',
		),
		// Authority::can('access', 'module/demo/one_resource/one_child_resource'
		'one_resource/one_child_resource' => array
		(
			// Parent of the module's ressource in the resources tree
			'parent' => 'one_resource',
			'title' => 'One Child Resource',
			'actions' => 'action_1',
		),
		// Authority::can('access', 'module/demo/one_resource_in_parent'
		'one_resource_in_parent' => array
		(
			// Parent of the module's ressource in the resources tree
			'parent' => 'one_resource',
			'title' => 'One Resource in the Parent Tree',
			'actions' => 'action_1',
		),

 *
 *
 */