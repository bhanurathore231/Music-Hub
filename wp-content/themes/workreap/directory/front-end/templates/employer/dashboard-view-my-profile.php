<?php 

/**

 *

 * The template part for displaying the freelancer profile basics

 *

 * @package   Workreap

 * @author    Amentotech

 * @link      http://amentotech.com/

 * @since 1.0

 */

global $current_user, $wp_roles, $userdata, $post;
$user_identity 	 = $current_user->ID;
$link_id		 = workreap_get_linked_profile_id( $user_identity );

?>

<div class="wt-yourdetails wt-tabsinfo">

	<div class="wt-tabscontenttitle">

		<h2><?php esc_html_e('View my profile', 'workreap'); ?></h2>

	</div>

	<div class="wt-formtheme wt-userform">
        <?php echo esc_url(get_the_permalink($link_id));?>
	</div>

</div>


