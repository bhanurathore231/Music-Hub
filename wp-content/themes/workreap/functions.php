<?php

/**

 *

 * Theme Files

 *

 * @package   Workreap

 * @author    amentotech

 * @link      https://themeforest.net/user/amentotech/portfolio

 * @since 1.0

 */

require_once ( get_template_directory() . '/theme-config/theme-setup/class-theme-setup.php'); //Theme setup

require_once ( get_template_directory() . '/includes/sidebars.php'); //Theme sidebars

require_once ( get_template_directory() . '/includes/functions.php'); //Theme functionality

require_once workreap_override_templates( '/includes/class-headers.php' );

require_once workreap_override_templates( '/includes/class-footers.php' );

require_once workreap_override_templates( '/includes/class-titlebars.php' );

require_once workreap_override_templates( '/includes/class-notifications.php' );

require_once workreap_override_templates( '/includes/scripts.php' );



require_once ( get_template_directory() . '/includes/google_fonts.php'); // goolge fonts

require_once ( get_template_directory() . '/includes/hooks.php'); //Hooks

require_once ( get_template_directory() . '/includes/template-tags.php'); //Tags

require_once ( get_template_directory() . '/includes/jetpack.php'); //jetpack

require_once ( get_template_directory() . '/theme-config/tgmp/init.php'); //TGM init

require_once ( get_template_directory() . '/framework-customizations/includes/option-types.php'); //Custom options

require_once workreap_override_templates( '/includes/constants.php' );

require_once ( get_template_directory() . '/includes/class-woocommerce.php'); //Woocommerce

require_once workreap_override_templates( '/directory/front-end/class-dashboard-menu.php' );

require_once ( get_template_directory() . '/includes/redius-search/location_check.php');

require_once ( get_template_directory() . '/directory/front-end/hooks.php');

require_once ( get_template_directory() . '/directory/front-end/functions.php');

require_once ( get_template_directory() . '/directory/front-end/woo-hooks.php');

require_once ( get_template_directory() . '/includes/languages.php');

require_once ( get_template_directory() . '/demo-content/data-importer/importer.php'); //Users dummy data

require_once workreap_override_templates( '/includes/typo.php' );

require_once ( get_template_directory() . '/directory/back-end/dashboard.php');

require_once ( get_template_directory() . '/directory/back-end/hooks.php');

require_once ( get_template_directory() . '/directory/back-end/functions.php');

require_once ( get_template_directory() . '/directory/front-end/ajax-hooks.php');

require_once ( get_template_directory() . '/directory/front-end/filepermission/class-file-permission.php');

require_once ( get_template_directory() . '/directory/front-end/term_walkers.php'); //Term walkers


add_filter( 'submit_event_form_steps', 'remove_event_preview_step' );

add_shortcode( 'custom_shortcode_hwe', 'custom_shortcode_audio'); 

function checkURLProtocol($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function custom_shortcode_audio(){
	$args = array(
		'post_type' => 'freelancers',
		'post_status' => 'publish',
		'orderby'     => 'modified',
		'order'       => 'DESC',
		'numberposts'	=> 4
	);
	$listings = get_posts( $args );
	
	if(!empty($listings)){
		$html='<div class="row">';
		foreach($listings as $list){

			$key_1_values = get_post_meta($list->ID,'_projects', true);
			if(!empty($key_1_values)){
				$audios = end($key_1_values);
				$title = $audios['title'];
				$audio_link = $audios['link'];
				$image_url = $audios['image']['url'];
				if(!empty($audio_link)){
					$html .='<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 float-left wt-verticaltop customgenrediv">';
					$html .='<a style="display: inline-block;" class="hwe_open_audio_model" data-url="'.$audio_link.'" href="javascript:void(0);"><div class="wt-project wt-crprojects custom-css-for-latest-upload-img">';
					$html .= '<img class="latest-song-img" src="'.$image_url.'" alt="image">';		
					$html .= '<p class="latest-song-title">'.$title.'</p>'; 
					$html .='</div>
					</a>
					';
					$html .='</div>';    
				}
				
			}
	}
	$html.='</div>';
	return $html;
}
}
add_action('wp_head', 'custom_code_for_form');
function custom_code_for_form(){  
    ?>
	
   <script>
    
    jQuery(document).ready(function(){ 
		jQuery('#submit-event-form #event_title').val('Event');
		jQuery('#submit-event-form .fieldset-event_title').hide();
	
        jQuery(".wt-btn.wt-joinnowbtn").click(function(){
        jQuery(".form-group.form-group-half:nth-child(3) input").attr("placeholder","Artist/Band Name");
  });
  jQuery(".form-group.wt-checkbox-wrap:nth-child(2) .wt-radio:nth-child(3) label").click(function(){
	jQuery(".form-group.form-group-half:nth-child(3) input").attr("placeholder","Business name");
  });
  jQuery(".form-group.wt-checkbox-wrap:nth-child(2) .wt-radio:nth-child(2) label").click(function(){
	jQuery(".form-group.form-group-half:nth-child(3) input").attr("placeholder","Artist/Band Name");
  });
  jQuery(".form-group.wt-checkbox-wrap .wt-joinnowfooter p input[type=checkbox]").trigger('click');
  jQuery(".form-group.wt-checkbox-wrap .wt-joinnowfooter").css('display','none');
  jQuery(".form-group .form-control").each(function() {
  var school_placeholder=jQuery(this).attr('placeholder');
    if(school_placeholder=="I’m looking for"){
      jQuery(this).attr('placeholder','Please Select a School to Search');
      jQuery(this).prop('readonly', true);
    }
  });
  jQuery(".form-group .wt-formoptions .wt-radioholder .wt-radio label").click(function(){
  var school_value=jQuery(this).text();
  jQuery(".form-group .form-control").each(function() {
  var placeholder=jQuery(this).attr('placeholder');
  if(placeholder=="Please Select a School to Search"){
    jQuery(this).val(school_value);
    jQuery(this).prop('readonly', true);
  }
  });
  });  
  let searchParams = new URLSearchParams(window.location.search);
  let param1 = searchParams.get('searchtype');
  jQuery("#mCSB_1_container span input").each(function(){
    school_tax=jQuery(this).val();
    if(param1==school_tax){
      jQuery(this).prop('checked', true);
      jQuery()
    }
  });
  if(param1){
  jQuery(".wt-widgettitle h2").each(function(){
    checktextschool=jQuery(this).text();
    if(checktextschool=="School:( 0 selected )"){
      jQuery(this).text("School:( 1 selected )");
    }
  });
}
})   
</script>
   <?php
} 

function hwe_add_custom_code_head_frontend(){
    if(!is_user_logged_in()){
    ?>
    
    <script type="text/javascript">
    setInterval(function(){
        console.log("checking");
        if(!document.getElementById('hweboot')) {
            console.log("comeinside");
            var hwehead = document.getElementsByTagName('HEAD')[0];
            var hwelink1 = document.createElement('link');
            hwelink1.rel = 'stylesheet';
            hwelink1.id = 'hweboot';
            hwelink1.type = 'text/css';
            hwelink1.href = '<?php echo get_site_url(); ?>/wp-content/themes/workreap/css/bootstrap.min.css';
            
            var hwelink2 = document.createElement('link');
            hwelink2.rel = 'stylesheet';
            hwelink2.type = 'text/css';
            hwelink2.href = '<?php echo get_site_url(); ?>/wp-content/themes/workreap/style.css';
            
            var hwelink3 = document.createElement('link');
            hwelink3.rel = 'stylesheet';
            hwelink3.type = 'text/css';
            hwelink3.href = '<?php echo get_site_url(); ?>/wp-content/themes/workreap/css/typo.css';
            
            var hwelink4 = document.createElement('link');
            hwelink4.rel = 'stylesheet';
            hwelink4.type = 'text/css';
            hwelink4.href = '<?php echo get_site_url(); ?>/wp-content/themes/workreap/css/main.css';
            
            hwehead.appendChild(hwelink1);
            hwehead.appendChild(hwelink2);
            hwehead.appendChild(hwelink3);
            hwehead.appendChild(hwelink4);
        }
    },100);

    jQuery(document).ready(function(){
        jQuery('.hwe_landing_sign_in_bt').click(function(){
           jQuery('#loginpopup').modal('show');
           return false;
        }); 
        
        jQuery('.hwe_landing_sign_up_bt').click(function(){
            jQuery('#joinpopup').modal('show'); 
           return false;
        }); 
    });
    </script>
    <?php
    }
}

add_action('wp_head', 'hwe_add_custom_code_head_frontend');

add_filter('seedprod_lpage_content', 'hwe_seedprod_lpage_content_apply_particles');

function hwe_seedprod_lpage_content_apply_particles($content){
	global $post;

	if(!is_user_logged_in()){
		$content .= '
		<script type="text/javascript" src="'.get_site_url().'/wp-content/themes/workreap/js/particles.min.js" id="particles-js"></script>
		<script type="text/javascript" src="'.get_site_url().'/wp-content/themes/workreap/
hwe-script/app.js" id="particles-js"></script>
<style>
.particles-js-canvas-el{
position:absolute;
background-image: linear-gradient(180deg, #934CFF 0%, #F62B84 100%);
background-color: transparent;
opacity: 1;
transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
}
.hwe_landing_sign_in_bt{
position:relative;
z-index:9999;
}
.hwe_landing_sign_up_bt{
position:relative;
z-index:9999;
}
.hwe_heading_landing_page{
position:relative;
z-index:9999;
}
.hwe_subheading_landing_page{
position:relative;
z-index:9999;
}
</style>
';
	}
	return $content;
}



add_shortcode('hwe-event-calender', 'hwe_function_custom_event_calender');

function hwe_function_custom_event_calender(){
	ob_start();
	$args = array(
		'post_type' => 'event_listing',
		'post_status' => array('publish', 'expired'),
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'asc',
		'date_query'     => array(
				'column'  => 'post_date',  // Use 'post_date' for local time
				'groupby' => 'date',  // Group by day
			),
		);
	
	$query = new WP_Query($args);	
	$alreadyadate = array();
	$calender_block_dates = array();
	foreach($query->posts as $querypost){
		$event_id = $querypost->ID;
		$post_date = $querypost->post_date;
		
		if(in_array(date('Y-m-d', strtotime($post_date)),$alreadyadate)){
			continue;
		}
		$alreadyadate[] = date('Y-m-d', strtotime($post_date));
		$author_id = $querypost->post_author;

		$user_info = get_user_by( 'ID', $author_id );
		$user_id = $user_info->data->ID;
		$user_avatar = get_avatar_url($user_id);
		$display_name=$user_info->display_name;
		$nicename = $user_info->user_nicename;
	
		
	
		$_event_location = get_post_meta($event_id, '_event_location', true);
		$_venue_name = get_post_meta($event_id, '_venue_name', true);
		$_event_start_date = get_post_meta($event_id, '_event_start_date', true);
		
		$event_name = '<span>Date: '.$_event_start_date.'</span><br/>';
		if(!empty($_event_location)){
			$event_name .= '<span>Location: '.$_event_location.'</span><br/>';
		}
		$event_name .= '<span>Artist Name: '.$display_name.'</span><br/>';
		if(!empty($_venue_name)){
			$event_name .= '<span>Venue Name: '.$_venue_name.'</span><br/>';
		}
		$event_name .= '<a href="'.get_site_url().'/freelancer/'.$nicename.'" style="background: #000;color: #fff;padding: 2px 5px;vertical-align: middle;border-radius: 3px;" target="_blank">View Artist Profile</a>';

		$calender_block_dates[] = array(
										'start' => $_event_start_date, 
										'end' => $_event_start_date, 
										'event_title' => $event_name
								);
	}		
	?>
	<link href="<?php echo get_template_directory_uri().'/calendar/availability-calendar.css' ?>" rel="stylesheet" />
	<script src="<?php echo get_template_directory_uri().'/calendar/availability-calendar.js' ?>"></script> 
	<div id='hwe_event_calendar'></div>
	
	<script>
	<?php 
	if(!empty($calender_block_dates)){
	?>	
	var calendarData = <?php echo json_encode($calender_block_dates); ?>;
	<?php
	}
	else{
	?>	
	var calendarData = [];
	<?php
	} 
	?>		
	jQuery('#hwe_event_calendar').availabilityCalendar(calendarData);	
	</script>
	<?php
	$output = ob_get_contents();
	ob_get_clean();
	return $output;
}

add_action('wp_footer', 'hwe_add_model_popup_mp3');

function hwe_add_model_popup_mp3(){
	?>
	<div id="hweMp3PlayerModel" class="hwemodal">
	  <div class="hwemodal-content">
		<div class="hwemodal-header">
		  <span class="hweclose">&times;</span>
		</div>
		<div class="hwemodal-body">
		   <audio id="audioPlayer" controls>
			  <source id="audioSource" src="" type="audio/ogg">
			</audio> 
		</div>
		
	  </div>
	</div>
	<style>
	.hwemodal {
	  display: none;
	  position: fixed;
	  z-index: 1;
	  padding-top: 100px;
	  left: 0;
	  top: 53px;
	  width: 100%;
	  height: 100%; 
	  overflow: auto;
	  background-color: rgb(0,0,0);
	  background-color: rgba(0,0,0,0.4);
	}

	.hwemodal-content {
	  position: relative;
	  background-color: #fefefe;
	  margin: auto;
	  padding: 0;
	  border: 1px solid #888;
	  width: 335px;
	  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
	  -webkit-animation-name: animatetop;
	  -webkit-animation-duration: 0.4s;
	  animation-name: animatetop;
	  animation-duration: 0.4s
	}

	
	@-webkit-keyframes animatetop {
	  from {top:-300px; opacity:0} 
	  to {top:0; opacity:1}
	}

	@keyframes animatetop {
	  from {top:-300px; opacity:0}
	  to {top:0; opacity:1}
	}

	
	.hweclose {
	  color: white;
	  float: right;
	  font-size: 28px;
	  font-weight: bold;
	}

	.hweclose:hover,
	.hweclose:focus {
	  color: #000;
	  text-decoration: none;
	  cursor: pointer;
	}


	.hwemodal-body {padding: 7px 16px;}


	</style>
	<script>
	var hweMp3PlayerModel = document.getElementById("hweMp3PlayerModel");
	jQuery(document).ready(function(){
		jQuery(".hwe_open_audio_model").click(function(){
			var mp3filesrc = jQuery(this).data('url');
			document.getElementById("audioSource").src = mp3filesrc; 
			hweMp3PlayerModel.style.display = "block";
			document.getElementById("audioPlayer").load();
			document.getElementById("audioPlayer").play();
		});
		
		jQuery('.hwedataTarget').css('cursor', 'pointer');
		jQuery('.hwedataTarget').on('click', function(){
			jQuery('#wpem-event-box-layout').trigger('click');
			var mydate = jQuery(this).data('date');
			window.location.href = '<?php echo get_site_url(); ?>/events?cldate='+mydate;
			return false;
		});
		
		jQuery('.hwedataTarget div').on('click', function(event) {
			event.stopPropagation();
			console.log('Child element clicked');
		});
		
		jQuery('.wt-dashboardtabs ul.navbar-nav > li.nav-item a').click(function(){
			var thistablink = jQuery(this).data('link');
			hweSetCookie('profile-active-tab', thistablink, 1)			
		});

		jQuery('#project_country_select').change(function(){
			var selected_country = jQuery(this).val();
			
			
			jQuery.ajax({
				type : "post",
				dataType : "json",
				url : "<?php echo admin_url('admin-ajax.php'); ?>",
				data : {action: "hwe_get_cities", country_id : selected_country},
				success: function(response) {
					var html = '';
					jQuery.each(response, function(index, element) {
						html += '<option value="'+index+'">'+element+'</option>';
        			});
					
					jQuery('#project_city_select').html(html);
				}
			}); 
			
		});
	});
	
	var hweclose = document.getElementsByClassName("hweclose")[0];
 
	hweclose.onclick = function() {
	  hweMp3PlayerModel.style.display = "none";
	  document.getElementById("audioPlayer").pause();
      document.getElementById("audioPlayer").currentTime = 0;
	}

	window.onclick = function(event) {
	  if (event.target == hweMp3PlayerModel) {
		hweMp3PlayerModel.style.display = "none";
		document.getElementById("audioPlayer").pause();
		document.getElementById("audioPlayer").currentTime = 0;
	  }
	}
	
	function hweSetCookie(cname, cvalue, exdays) {
	  const d = new Date();
	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	  let expires = "expires="+ d.toUTCString();
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	</script>
	<?php
}

add_action("wp_ajax_hwe_get_cities", "hwe_get_cities_cb");

function hwe_get_cities_cb() {
	
	$country_id = $_REQUEST["country_id"];

	$term = get_term_by('term_id', $country_id, 'country');
	$country_slug = $term->slug;

	$term = get_term_by('slug', $country_slug, 'city');

	$terms = get_terms( array(
		'taxonomy'   => 'city',
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC',
		'parent' => $term->term_id
	) );

	$allcity = array();
	foreach($terms as $term){
		$allcity[$term->term_id] = $term->name;
	}

	echo json_encode($allcity);
	die();
}