<?php 
/**
 * Messaging template
 **/
global $current_user;
$user_identity = $current_user->ID;
$cookie_active_tab = $_COOKIE['profile-active-tab'];
$linked_profile  = workreap_get_linked_profile_id($user_identity);
$is_cometchat 	= false;
$is_wpguppy 	= false;
if (function_exists('fw_get_db_settings_option')) {
	$chat_api = fw_get_db_settings_option('chat');
	if (!empty($chat_api['gadget']) && $chat_api['gadget'] === 'cometchat') {
		$is_cometchat = true;
	}elseif (!empty($chat_api['gadget']) && $chat_api['gadget'] === 'guppy') {
		$is_wpguppy = true;
	}
}
$site_url = home_url();
?>
<section class="wt-haslayout am-chat-module">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <div class="wt-dashboardbox wt-messages-holder">
	        <div class="wt-dashboardboxtitle">
	           <h2><?php esc_html_e('Messages', 'workreap'); ?></h2>
			</div>
			<?php if ($is_cometchat) { ?>
				<?php echo do_shortcode("[atomchat layout='embedded' width='1290' height='980']");?>
			<?php } else if ($is_wpguppy) {?>
				<div class="wt-haslayout"><?php echo do_shortcode("[getGuppyConversation]");?></div>
			<?php }else{?>
				<div class="col-12 d-flex">
				<div class="col-3">
				<div class="wt-dashboardtabs" style="width: 100%;">

					<ul class="wt-tabstitle nav navbar-nav">
					<li class="nav-item wt-list-faq-profile" data>
					<a  data-link="wt-list-faq-profile" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-faq-profile'?>"><?php esc_html_e('Images', 'workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-specialization">
						<a data-link="wt-list-specialization" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-specialization'?>"><?php esc_html_e('Bio', 'workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-experience">
						<a  data-link="wt-list-experience" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-education'?>"><?php esc_html_e('Filters', 'workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-projects">
						<a data-link="wt-list-projects" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-projects'?>"><?php esc_html_e('Audio', 'workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-videos">
						<a  data-link="wt-list-videos" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-videos'?>"><?php esc_html_e('Videos', 'workreap'); ?></a></li>
					<li class="nav-item wt-list-socials">
					<a  data-link="wt-list-socials" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-socials-profile'?>"><?php esc_html_e('Social profiles', 'workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-upcoming-gig">
						<a  data-link="wt-list-upcoming-gig" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-upcoming-gig'?>"><?php esc_html_e('Upcoming Gig', 'workreap'); ?></a></li>	
					<li class="nav-item">
					<a  data-link="wt-list-basics" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-skills'?>"><?php esc_html_e('Personal Details', 'workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-view-my-profile">
					<a data-link="wt-list-view-my-profile" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-viewprofile'?>"><?php esc_html_e('View my profile','workreap'); ?></a>
					</li>
					<li class="nav-item wt-list-industrial">
						<a  data-link="wt-list-industrial" href="<?php echo $site_url.'/dashboard/?ref=profile&mode=settings&identity='.$user_identity.'&?tab=wt-industrial-experience'?>"><?php esc_html_e('Delete Account', 'workreap'); ?></a>
					</li>
					</ul>
				</div>
				</div>
				<div class="col-9">
				<div class="wt-dashboardboxtitle wt-titlemessages chat-current-user"></div>
				<div class="wt-dashboardboxcontent wt-dashboardholder wt-offersmessages">	
					<?php
						if ( $_GET['identity'] == $user_identity) {
							do_action('fetch_users_threads', $user_identity);
						}
					?>
				</div>
				</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php get_template_part('directory/front-end/templates/dashboard', 'underscore');?>