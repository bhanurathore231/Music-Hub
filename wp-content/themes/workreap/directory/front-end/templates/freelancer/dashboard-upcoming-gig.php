<?php
/**
 *
 * The template part for displaying upcoming gig 
 *
 * @package   Workreap
 * @author    Amentotech
 * @link      http://amentotech.com/
 * @since 1.0
 */

global $current_user;
$user_identity 	 	= $current_user->ID;
?>
<div class="wt-yourdetails wt-tabsinfo">
	<div class="wt-tabscontenttitle">
		<h2><?php esc_html_e('Gigs', 'workreap'); ?></h2>
	</div>
	<div class="wt-formtheme wt-userform">
	<fieldset>	
			<div class="form-group toolip-wrapo">
            <?php echo do_shortcode('[submit_event_form]'); ?>
            </fieldset>
	</div>
</div>