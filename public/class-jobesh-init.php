<?php
/**
 * Init
 *
 * @package     JobesH
 * @subpackage  JobesH/public
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class JobesH_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		$projects_post_type = new JobesH_Register_Post_Type( 'Projects', '', array(), array( 'supports' => array( 'title', 'editor', 'thumbnail' ) ) );
		$tasks_performed_taxonomy = new JobesH_Register_Taxonomies( 'projects', 'Taskes Performed' );
		$team_post_type = new JobesH_Register_Post_Type( 'Team', '', array(), array( 'supports' => array( 'title', 'editor', 'thumbnail' ) ) );
	}
}