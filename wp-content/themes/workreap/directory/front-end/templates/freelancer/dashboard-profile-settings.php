<?php

/**

 *

 * The template part for displaying the dashboard menu

 *

 * @package   Workreap

 * @author	Amentotech

 * @link	  http://amentotech.com/

 * @since 1.0

 */

global $current_user, $wp_roles, $userdata, $post;

$user_identity 	 = $current_user->ID;

$linked_profile  = workreap_get_linked_profile_id($user_identity);

$post_id 		 = $linked_profile;

$freelancer_avatar = apply_filters(

		'workreap_freelancer_avatar_fallback', workreap_get_freelancer_avatar( array( 'width' => 225, 'height' => 225 ), $post_id ), array( 'width' => 225, 'height' => 225 )

	);



$freelancer_gallery_option	= '';

$freelancer_faq_option		= '';

$socialmediaurls	= array();

$experience	= '';

$specialization	= '';

if( function_exists('fw_get_db_settings_option')  ){

	$freelancer_gallery_option	= fw_get_db_settings_option('freelancer_gallery_option', $default_value = null);

	$frc_remove_awards	= fw_get_db_settings_option('frc_remove_awards', $default_value = null);

	$specialization		= fw_get_db_settings_option('freelancer_specialization', $default_value = null);

	$experience			= fw_get_db_settings_option('freelancer_industrial_experience', $default_value = null);

	$socialmediaurl		= fw_get_db_settings_option('freelancer_social_profile_settings', $default_value = null);

	$remove_experience	= fw_get_db_settings_option('frc_remove_experience', 'no');

	$remove_education	= fw_get_db_settings_option('frc_remove_education', 'no');

	$freelancer_faq_option	= fw_get_db_settings_option('freelancer_faq_option', $default_value = null);

}



$socialmediaurl 		= !empty($socialmediaurl['gadget'] ) ? $socialmediaurl['gadget'] : '';

$portfolio_settings		= apply_filters('workreap_portfolio_settings','no');

$cookie_active_tab = $_COOKIE['profile-active-tab'];
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">		

	<form class="wt-user-profile">	

		<div class="wt-dashboardbox wt-dashboardtabsholder">

			<div class="wt-dashboardtabs">

				<ul class="wt-tabstitle nav navbar-nav">
				<li class="nav-item wt-list-faq-profile" data>
				<a <?php if($cookie_active_tab == 'wt-list-faq-profile'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-faq-profile" href="#wt-faq-profile"><?php esc_html_e('Images', 'workreap'); ?></a>
				</li>
				<li class="nav-item wt-list-specialization">
					<a <?php if($cookie_active_tab == 'wt-list-specialization'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-specialization" href="#wt-specialization"><?php esc_html_e('Bio', 'workreap'); ?></a>
				</li>
				<li class="nav-item wt-list-experience">
					<a <?php if($cookie_active_tab == 'wt-list-experience'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-experience" href="#wt-education"><?php esc_html_e('Filters', 'workreap'); ?></a>
				</li>
				<li class="nav-item wt-list-projects">
					<a <?php if($cookie_active_tab == 'wt-list-projects'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-projects" href="#wt-projects"><?php esc_html_e('Audio', 'workreap'); ?></a>
				</li>
				<li class="nav-item wt-list-videos">
					<a <?php if($cookie_active_tab == 'wt-list-videos'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-videos" href="#wt-videos"><?php esc_html_e('Videos', 'workreap'); ?></a></li>
				<li class="nav-item wt-list-socials">
				<a <?php if($cookie_active_tab == 'wt-list-socials'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-socials" href="#wt-socials-profile"><?php esc_html_e('Social profiles', 'workreap'); ?></a>
				</li>
				<li class="nav-item wt-list-upcoming-gig">
					<a <?php if($cookie_active_tab == 'wt-list-upcoming-gig'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-upcoming-gig" href="#wt-upcoming-gig"><?php esc_html_e('Upcoming Gig', 'workreap'); ?></a></li>	
				<li class="nav-item">
				<a <?php if($cookie_active_tab == 'wt-list-basics' OR $cookie_active_tab ==''){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-basics" href="#wt-skills"><?php esc_html_e('Personal Details', 'workreap'); ?></a>
				</li>
                <li class="nav-item wt-list-view-my-profile">
				<a <?php if($cookie_active_tab == 'wt-list-view-my-profile'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-view-my-profile" href="#wt-viewprofile"><?php esc_html_e('View my profile','workreap'); ?></a>
				</li>
				<li class="nav-item wt-list-industrial">
					<a <?php if($cookie_active_tab == 'wt-list-industrial'){ echo 'class="active show"'; }?> data-toggle="tab" data-link="wt-list-industrial" href="#wt-industrial-experience"><?php esc_html_e('Delete Account', 'workreap'); ?></a>
				</li>
				</ul>
			</div>

			<div class="wt-tabscontent tab-content">

				<div class="wt-personalskillshold tab-pane fade <?php if($cookie_active_tab == 'wt-list-basics' OR $cookie_active_tab == '' ){ echo 'active show'; }?>" id="wt-skills">

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'basics'); ?>

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'avatar'); ?>

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'banner'); ?>

					<?php

						if(!empty($portfolio_settings) && $portfolio_settings === 'no' ){

							if(!empty($freelancer_gallery_option) && $freelancer_gallery_option === 'enable' ){

								get_template_part('directory/front-end/templates/freelancer/dashboard', 'gallery'); 

							}

						}

					?>

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'resume'); ?>

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'location'); ?>

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'skills'); ?>	

					

				</div>

				

					<div class="wt-faqholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-faq-profile'){ echo 'active show'; }?>" id="wt-faq-profile">

						<?php get_template_part('directory/front-end/templates/dashboard','faq'); ?>

					</div>

				

					<div class="wt-educationholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-experience'){ echo 'active show'; }?>" id="wt-education">

						<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'experience'); ?>	


					</div>


				

					<div class="wt-awardsholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-projects'){ echo 'active show'; }?>" id="wt-projects">

						<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'projects'); ?>

					</div>

			
				<div class="wt-awardsholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-upcoming-gig'){ echo 'active show'; }?>" id="wt-upcoming-gig">

						<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'upcoming-gig'); ?>

					</div>

				

					<div class="wt-awardsholder tab-pane fade" id="wt-awards">

						<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'awards'); ?>	

					</div>

				

				<div class="wt-awardsholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-videos'){ echo 'active show'; }?>" id="wt-videos">

					<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'videos'); ?>

				</div>

				

					<div class="wt-awardsholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-specialization'){ echo 'active show'; }?>" id="wt-specialization">

						<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'specialization'); ?>

					</div>

				

				

					<div class="wt-awardsholder tab-pane fade <?php if($cookie_active_tab == 'wt-list-industrial'){ echo 'active show'; }?>" id="wt-industrial-experience">

						<?php get_template_part('directory/front-end/templates/freelancer/dashboard', 'industrial-experience'); ?>

					</div>

				

				

					<div class="wt-personalskillshold wt-socials-profile  tab-pane fade <?php if($cookie_active_tab == 'wt-list-socials'){ echo 'active show'; }?>" id="wt-socials-profile">

					<?php get_template_part('directory/front-end/templates/dashboard', 'social-profile'); ?>

					</div>

						<div class="wt-personalskillshold wt-viewprofile  tab-pane fade <?php if($cookie_active_tab == 'wt-list-view-my-profile'){ echo 'active show'; }?>" id="wt-viewprofile">

							<?php get_template_part('directory/front-end/templates/dashboard', 'view-profile'); ?>

								</div>

			

			</div>

		</div>

		<div class="wt-updatall">

			<?php wp_nonce_field('wt_freelancer_data_nonce', 'profile_submit'); ?>

			<i class="ti-announcement"></i>

			<span><?php esc_html_e('Update all the latest changes made by you, by just clicking on “Save &amp; Update button.', 'workreap'); ?></span>

			<a class="wt-btn wt-update-profile-freelancer" data-id="<?php echo esc_attr( $user_identity ); ?>" data-post="<?php echo esc_attr( $post_id ); ?>" href="#" onclick="event_preventDefault(event);"><?php esc_html_e('Save &amp; Update', 'workreap'); ?></a>

		</div>	

	</form>		

</div>

<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4 col-xl-3">

	<div class="wt-authorcodescan wt-codescanholder">

		<?php  do_action('workreap_get_qr_code','freelancer',intval( $post_id ));?>

	</div>

	<?php if ( is_active_sidebar( 'sidebar-dashboard' ) ) {?>

		<div class="wt-haslayout wt-dashside">

			<?php dynamic_sidebar( 'sidebar-dashboard' ); ?>

		</div>

	<?php }?>

</div>



