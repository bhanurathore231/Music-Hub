<?php

/**

 *

 * The template used for displaying freelancer post basics

 *

 * @package   Workreap

 * @author    amentotech

 * @link      https://amentotech.com/user/amentotech/portfolio

 * @version 1.0

 * @since 1.0

 */

global $post,$current_user;
$user_identity 	 = $current_user->ID;
$linked_profile  = workreap_get_linked_profile_id($user_identity);
$post_id 					= $linked_profile; 
$user_id		= workreap_get_linked_profile_id($user_identity);

$basic_content	= 'withoutstats';

if( isset( $freelancer_stats ) && $freelancer_stats === 'show' ){

	$basic_content	= 'withstats';

}



$content					= get_the_content();

$completed_jobs				= workreap_count_posts_by_meta( 'projects' ,'', '_freelancer_id', $post_id, 'completed');

$total_completed_jobs		= !empty($completed_jobs) ? $completed_jobs : 0;



$ongoing_jobs				= workreap_count_posts_by_meta( 'projects' ,'', '_freelancer_id', $post_id, 'hired');

$total_ongoing_jobs			= !empty($ongoing_jobs) ? $ongoing_jobs : 0;



$cancelled_jobs				= workreap_count_posts_by_meta( 'proposals' ,$user_id, '', '', 'cancelled');

$total_cancelled_jobs		= !empty($cancelled_jobs) ? $cancelled_jobs : 0;



$earnings					= workreap_get_sum_payments_freelancer($user_id,'completed','amount');

$earnings					= !empty($earnings) ? $earnings : 0;





$completed_services			= workreap_count_posts_by_meta( 'services-orders' ,'', '_service_author', $user_id, 'completed');

$total_completed_services	= !empty($completed_services) ? $completed_services : 0;



$ongoing_services			= workreap_count_posts_by_meta( 'services-orders' ,'', '_service_author', $user_id, 'hired');

$total_ongoing_services		= !empty($ongoing_services) ? $ongoing_services : 0;



$cancelled_services			= workreap_count_posts_by_meta( 'services-orders' ,0, '_service_author', $user_id, 'cancelled');

$total_cancelled_services	= !empty($cancelled_services) ? $cancelled_services : 0;


$freelancer_avatar = apply_filters(

		'workreap_freelancer_avatar_fallback', workreap_get_freelancer_avatar( array( 'width' => 300, 'height' => 300 ), $post_id ), array( 'width' => 300, 'height' => 300 )

	);



$socialmediaurls	= array();

if( function_exists('fw_get_db_settings_option')  ){

	$socialmediaurl	= fw_get_db_settings_option('freelancer_social_profile_settings', $default_value = null);

	$login_register = fw_get_db_settings_option('enable_login_register');

}



$socialmediaurl 		= !empty($socialmediaurls) ? $socialmediaurls['gadget'] : '';



$social_settings	= array();

if (function_exists('workreap_get_social_media_icons_list')){

	$social_settings	= workreap_get_social_media_icons_list('no');

}



$applicationClass	= 'wt-access-both';

if( $application_access === 'job_base' ){

	$applicationClass	= 'wt-access-jobs';

} else if( $application_access === 'service_base' ){

	$applicationClass	= 'wt-access-services';

}



$freelancer_title 		= workreap_get_username('',$post_id); 





$login_page	= '';

if (!empty($login_register['enable']['login_page'][0]) && !empty($login_register['enable']['login_signup_type']) && $login_register['enable']['login_signup_type'] == 'pages' ) {

	$login_page = get_the_permalink($login_register['enable']['login_page'][0]);

}



?>

<div class="container profile-page">

	<div class="row">

		<div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">

			<div class="wt-userprofileholder pop-up-view">

				<?php do_action('workreap_featured_freelancer_tag',$user_id);?>

				<div class="col-12 col-sm-12 col-md-12 col-lg-3 float-left user-pic">

					<div class="row">

						<div class="wt-userprofile">

							<figure>

								<img src="<?php echo esc_url( $freelancer_avatar );?>" alt="<?php esc_attr_e('freelancer','workreap');?>">

								<?php echo do_action('workreap_print_user_status',$user_id);?>

							</figure>

							<div class="wt-title toolip-wrapo pop-up-view-profile">

								<?php do_action('workreap_get_verification_check',$post_id);?>

								<div class="wt-sinle-pmeta pop-up-view-profile">

									<?php do_action('workreap_freelancer_get_reviews',$post_id,'v1');?>

									<span class="wtmember-since pop-up-view-profile"><?php esc_html_e('Joined','workreap');?>&nbsp;<?php echo get_the_date( get_option('date_format') );?></span>

									<?php

									if(!empty($social_settings) && !empty($socialmediaurl) && $socialmediaurl === 'enable') { ?>

										<ul class="wt-socialiconssimple">

											<?php

												foreach($social_settings as $key => $val ) {

													$icon		= !empty( $val['icon'] ) ? $val['icon'] : '';

													$color			= !empty( $val['color'] ) ? $val['color'] : '#484848';



													$enable_value   = !empty($socialmediaurls['enable'][$key]['gadget']) ? $socialmediaurls['enable'][$key]['gadget'] : '';

													if( !empty($enable_value) && $enable_value === 'enable' ){ 

														$social_url	= '';

														if( function_exists('fw_get_db_post_option') ){

															$social_url	= fw_get_db_post_option($post_id, $key, null);

														}

														$social_url	= !empty($social_url) ? $social_url : '';

														if(!empty($social_url)) {?>

															<li>

																<a href="<?php echo esc_url($social_url); ?>" target="_blank">

																	<i class="wt-icon <?php echo esc_attr( $icon );?>" style="color:<?php echo esc_attr( $color );?>"></i>

																</a>

															</li>

														<?php } ?>

													<?php } ?>

												<?php } ?>

										</ul>

									<?php } ?>

								</div>

								<?php do_action('workreap_profile_strength_html',$post->ID,true);?>

							</div>


							<div class="wt-description <?php echo esc_attr( $basic_content );?>">


							</div>

						</div>

					</div>

				</div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-9 float-left <?php echo esc_attr( $basic_content );?>">

					<div class="row">

						<div class="wt-profile-content-holder hide-earning-<?php echo esc_attr($hide_freelancer_earning);?>">

							<div class="wt-proposalhead wt-userdetails">

								<?php if( !empty( $tag_line ) ){?><h2><?php echo esc_html(stripslashes($tag_line));?></h2><?php } ?>

									<div class="wt-description">

										<?php the_content();?>

									</div>
									
									<div class="all-filters-view-hwe pop-up-profile">
								<div class="row">
										<div class="col">	
									<?php 
									$artist_type_selected = wp_get_post_terms( $post_id, $taxonomy = 'artist_type', $args = array() ) ;
										echo "Artist Type: <b>".$artist_type_selected[0]->name."</b>";
									?>
										</div>
										<div class="col">
									<?php
									$music_genre_selected = wp_get_post_terms( $post_id, $taxonomy = 'music_genre', $args = array() ) ;
										echo "Music Genre: <b>".$music_genre_selected[0]->name."</b>";	
									?>
										</div>
								</div>
								<div class="row">
									<div class="col">
									<?php
									$number_of_members_selected = wp_get_post_terms( $post_id, $taxonomy = 'number_of_members', $args = array() ) ;
										echo "No. of Members: <b>".$number_of_members_selected[0]->name."</b>";	
									?>
									</div>
									<div class="col">
									<?php	
									$instruments_associated_with_act_selected = wp_get_post_terms( $post_id, $taxonomy = 'instruments_associated_with_act', $args = array() ) ;
										echo "Instruments: <b>".$instruments_associated_with_act_selected[0]->name."</b>";	
									?>
									</div>
								</div>
								<div class="row">
									<div class="col">
									<?php
										$age_range_selected = wp_get_post_terms( $post_id, $taxonomy = 'age_range', $args = array() ) ;
										echo "Age Range: <b>".$age_range_selected[0]->name."</b>";	
									?>
									</div>
									<div class="col">
									<?php
										$years_performing_selected = wp_get_post_terms( $post_id, $taxonomy = 'years_performing', $args = array() ) ;
										echo "Years Performing: <b>".$years_performing_selected[0]->name."</b>";
									?>
									</div>
								</div>	
								<div class="row">
									<div class="col">
									<?php
										$next_gig_selected = wp_get_post_terms( $post_id, $taxonomy = 'next_gig', $args = array() ) ;
										echo "Next Gig: <b>".$next_gig_selected[0]->name."</b>";
									?>
									</div>
									<div class="col">
									<?php	
										$school_selected = wp_get_post_terms( $post_id, $taxonomy = 'school', $args = array() ) ;
										echo "School: <b>".$school_selected[0]->name."</b>";
									?>
									</div>
								</div>	
								<div class="row">
									<div class="col">
									<?php
									$city_selected = wp_get_post_terms( $post_id, $taxonomy = 'city', $args = array() ) ;
										echo "City: <b>".$city_selected[0]->name."</b>";
									?>
									</div>
									<div class="col">
									<?php	
										$representation_selected = wp_get_post_terms( $post_id, $taxonomy = 'representation', $args = array() ) ;
										echo "Representation: <b>".$representation_selected[0]->name."</b>";			
									?>
									</div>
								</div>	
								
								</div>
							<?php
							$site_url = get_site_url();
							?>
							<a class="btn btn-primary backtosearch" href="<?php echo esc_url(get_the_permalink($linked_profile));?>"><?php esc_html_e('View Full Profile','workreap'); ?></a>
							</div>
							

							<?php if( isset( $freelancer_stats ) && $freelancer_stats === 'show' ){?>

								<div id="wt-statistics" class="wt-statistics wt-profilecounter <?php echo esc_attr( $applicationClass );?>">

									<?php if( $application_access === 'job_base' ){?>

										<div class="wt-statisticcontent wt-countercolor1">

											<h3 ><?php echo intval($total_ongoing_jobs);?></h3>

											<h4><?php _e('Ongoing projects','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor2">

											<h3><?php echo intval($total_completed_jobs);?></h3>

											<h4><?php _e('Completed projects','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor4">

											<h3><?php echo intval($total_cancelled_jobs);?></h3>

											<h4><?php _e('Cancelled projects','workreap');?></h4>

										</div>

									<?php }else if( $application_access === 'service_base'){?>

										<div class="wt-statisticcontent wt-countercolor1">

											<h3 ><?php echo intval($total_ongoing_services);?></h3>

											<h4><?php _e('Ongoing services','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor2">

											<h3><?php echo intval($total_completed_services);?></h3>

											<h4><?php _e('Completed services','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor4">

											<h3><?php echo intval($total_cancelled_services);?></h3>

											<h4><?php _e('Cancelled services','workreap');?></h4>

										</div>

									<?php } else{?>

										<div class="wt-statisticcontent wt-countercolor1">

											<h3 ><?php echo intval($total_ongoing_jobs);?></h3>

											<h4><?php _e('Ongoing projects','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor2">

											<h3><?php echo intval($total_completed_jobs);?></h3>

											<h4><?php _e('Completed projects','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor4">

											<h3><?php echo intval($total_cancelled_jobs);?></h3>

											<h4><?php _e('Cancelled projects','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor1">

											<h3 ><?php echo intval($total_ongoing_services);?></h3>

											<h4><?php _e('Ongoing services','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor2">

											<h3><?php echo intval($total_completed_services);?></h3>

											<h4><?php _e('Completed services','workreap');?></h4>

										</div>

										<div class="wt-statisticcontent wt-countercolor4">

											<h3><?php echo intval($total_cancelled_services);?></h3>

											<h4><?php _e('Cancelled services','workreap');?></h4>

										</div>

									<?php }?>

									

									<?php if(isset($hide_freelancer_earning) && $hide_freelancer_earning !== 'yes'){?>

										<div class="wt-statisticcontent wt-countercolor3 wt-earnstat">

											<h3><?php echo workreap_price_format($earnings);?></h3>

											<h4><?php _e('Total earnings','workreap');?></h4>

										</div>

									<?php }?>

									<div class="wt-description">

										<p><?php esc_html_e('* Click the button to send an offer','workreap');?></p>

										<?php if( is_user_logged_in() ) {?>

											<a class="wt-btn wt-send-offers" href="#" onclick="event_preventDefault(event);">

												<?php esc_html_e('Send Message','workreap');?>

											</a>

										<?php } else {?>

											<a class="wt-btn wt-loginfor-offer" data-url="<?php echo esc_url($login_page);?>" href="#" onclick="event_preventDefault(event);">

												<?php esc_html_e('Send Message','workreap');?>

											</a>

										<?php } ?>


									</div>

								</div>

							<?php } ?>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>