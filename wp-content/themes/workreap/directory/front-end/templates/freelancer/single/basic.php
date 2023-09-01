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

$post_id 		= $post->ID;
$cr_video_limit	= 4;
$videos 		= fw_get_db_post_option($post_id, 'videos', true);
$images	=  fw_get_db_post_option($post_id, 'images_gallery',$default_value = null);
$title	= get_the_title($post_id);
$cr_project_limit	= 6;
$projects 		= fw_get_db_post_option($post_id, 'projects', true);
$user_id					= workreap_get_linked_profile_id( $post_id, 'post' );
$args = array(
    'post_type' => 'event_listing',
    'post_status' => array('publish'),
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'asc',
    'date_query'     => array(
            'column'  => 'post_date',  // Use 'post_date' for local time
            'groupby' => 'date',  // Group by day
        ),
        'author'         => $user_id,
    );
$query = new WP_Query($args);	

if (function_exists('fw_get_db_post_option')) {

	$tag_line			= fw_get_db_post_option($post_id, 'tag_line', true);

	$freelancer_stats 	= fw_get_db_settings_option('freelancer_stats');

	$application_access = fw_get_db_settings_option('application_access');

	$hide_freelancer_earning = fw_get_db_settings_option('hide_freelancer_earning');

} else {

	$tag_line			= "";

	$freelancer_stats	= "show";

}



$application_access	= !empty( $application_access ) ? $application_access : '';

$hide_freelancer_earning		= !empty($hide_freelancer_earning) ? $hide_freelancer_earning : 'no';



$basic_content	= 'withoutstats';

if( isset( $freelancer_stats ) && $freelancer_stats === 'show' ){

	$basic_content	= 'withstats';

}



$content					= get_the_content();


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




$freelancer_title 		= workreap_get_username('',$post_id); 





$login_page	= '';

if (!empty($login_register['enable']['login_page'][0]) && !empty($login_register['enable']['login_signup_type']) && $login_register['enable']['login_signup_type'] == 'pages' ) {

	$login_page = get_the_permalink($login_register['enable']['login_page'][0]);

}



?>

<div class="container profile-page">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">

            <div class="wt-userprofileholder">

                <?php do_action('workreap_featured_freelancer_tag',$user_id);?>

                <div class="col-12 col-sm-12 col-md-12 col-lg-3 float-left user-pic">

                    <div class="row">

                        <div class="wt-userprofile show-img">

                            <figure>

                                <img class="profile-img-freelancer custom-class-profile" src="<?php echo esc_url( $freelancer_avatar );?>"
                                    alt="<?php esc_attr_e('freelancer','workreap');?>">

                                <?php echo do_action('workreap_print_user_status',$user_id);?>

                            </figure>

                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-9 float-left <?php echo esc_attr( $basic_content );?>">

                    <div class="row">

                        <div class="wt-profile-content-holder hide-earning">

                            <div class="wt-proposalhead wt-userdetails">
                                <div class="wt-title toolip-wrapo" style="padding-bottom: 30px;">
                                    
                                    <?php do_action('workreap_get_verification_check',$post_id);?>

                                    <div class="wt-sinle-pmeta">

                                        <?php do_action('workreap_freelancer_get_reviews',$post_id,'v1');?>

                                        <span
                                            class="wtmember-since"><?php esc_html_e('Joined','workreap');?>&nbsp;<?php echo get_the_date( get_option('date_format') );?></span>

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

                                                    <i class="wt-icon <?php echo esc_attr( $icon );?>"
                                                        style="color:<?php echo esc_attr( $color );?>"></i>

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
                                <?php if( !empty( $tag_line ) ){?><h2><?php echo esc_html(stripslashes($tag_line));?>
                                </h2><?php } ?>
                                <div class="wt-description">

                                    <?php the_content();?>
                                    <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>

                                    
                                </div>
                                    </div>
                                </div>

                            </div>

                            <?php
							$site_url = get_site_url();
							?>

                        </div>
                        <div class="container-fluid">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="image-tab" data-toggle="tab"
                                                        href="#image" role="tab" aria-controls="intro"
                                                        aria-selected="true">Images</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="songs-tab" data-toggle="tab" href="#songs"
                                                        role="tab" aria-controls="songs" aria-selected="false">Songs
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos"
                                                        role="tab" aria-controls="videos"
                                                        aria-selected="false">Videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="filters-tab" data-toggle="tab"
                                                        href="#filters" role="tab" aria-controls="filters"
                                                        aria-selected="false">Filters</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="social-tab" data-toggle="tab" href="#social"
                                                        role="tab" aria-controls="social" aria-selected="false">Social
                                                        Media Stats</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="gigs-tab" data-toggle="tab" href="#gigs"
                                                        role="tab" aria-controls="gigs" aria-selected="false">Upcoming
                                                        Gigs</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="image" role="tabpanel"
                                                    aria-labelledby="image-tab">
                                                    <div class="wt-craftedprojects wt-profile-gallery profile-view">
                                                        <div class="wt-projects wt-haslayout">
                                                            <?php 
                                                foreach( $images as $key => $gallery_image ){ 
                                                    $gallery_thumnail_image_url 	= !empty( $gallery_image['attachment_id'] ) ? wp_get_attachment_image_src( $gallery_image['attachment_id'], 'workreap_freelancer', true ) : '';
                                                    $gallery_image_url 				= !empty( $gallery_image['url'] ) ? $gallery_image['url'] : '';
                                                    
                                            ?>
                                                            <div class="wt-project wt-crprojects view-profile">
                                                                <?php if( !empty($gallery_thumnail_image_url[0]) ){?>
                                                                <a class="wt-venobox" data-gall="gall"
                                                                    href="<?php echo esc_url($gallery_image_url); ?>">
                                                                    <figure><img
                                                                            src="<?php echo esc_url( $gallery_thumnail_image_url[0] );?>"
                                                                            alt="<?php echo esc_attr($title);?>">
                                                                    </figure>
                                                                </a>
                                                                <?php }?>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                                        <?php 
                                    $script	= "jQuery('.wt-venobox').venobox();";
                                    wp_add_inline_script( 'venobox', $script, 'after' );
                                    ?>
                                                </div>
                                                <div class="tab-pane fade" id="songs" role="tabpanel"
                                                    aria-labelledby="songs-tab">
                                                    <?php if( !empty( $projects ) && is_array( $projects ) ){?>

                                                    <div class="wt-craftedprojects">

                                                        <div class="wt-projects wt-haslayout">

                                                            <?php 

							$total_projects	= !empty($projects) ? count(array_filter($projects))  : 0;

							$count_itme		= 0;

							foreach( $projects as $key => $item ){ 

								$count_itme ++;

								$title		= !empty($item['title']) ? $item['title'] : "";

								$link		= !empty($item['link']) ? $item['link'] : "";

								$image_url	= !empty($item['image']['url']) ? $item['image']['url'] : $project_placeholder;



								$filetype   = !empty( $image_url ) ? wp_check_filetype( $image_url ) : '';

								$extension  = !empty( $filetype['ext'] ) ? $filetype['ext'] : '';	

								if( !empty($extension) && $extension === 'pdf' ){

									$defult_pdf_image	= get_template_directory_uri() . '/images/pdf.jpg';

								}



								$item_show	= !empty($count_itme) && intval($count_itme) > $cr_project_limit ? 'd-none' : "";

							?>

                                                            <div
                                                                class="wt-project wt-crprojects view-profile<?php echo do_shortcode( $item_show );?>">

                                                                <?php if( !empty($extension) && $extension === 'pdf' && !empty($item['image']['url']) ){ ?>

                                                                <figure>

                                                                    <a href="<?php echo esc_url($image_url) ?>"
                                                                        download><img
                                                                            src="<?php echo esc_url( $defult_pdf_image );?>"
                                                                            alt="<?php echo esc_attr($title);?>"></a>

                                                                </figure>

                                                                <?php } else if( !empty( $image_url) ){?>

                                                                <figure>
                                                                    <a data-url="<?php echo esc_url($link);?>"
                                                                        class="hwe_open_audio_model"
                                                                        href="javascript:void(0);">
                                                                        <img src="<?php echo esc_url( $image_url );?>"
                                                                            alt="<?php echo esc_attr($title);?>">
                                                                    </a>

                                                                </figure>

                                                                <?php }?>

                                                                <?php if( !empty( $title ) ) { ?>

                                                                <div class="wt-projectcontent">

                                                                    <a class="hwe_open_audio_model"
                                                                        data-url="<?php echo esc_url($link);?>"
                                                                        href="<?php echo esc_url($link);?>">
                                                                        <h3><?php echo esc_html(stripslashes($title));?>
                                                                        </h3>
                                                                    </a>

                                                                </div>

                                                                <?php } ?>

                                                            </div>

                                                            <?php 

								            } 

                                                if( intval($total_projects) > $cr_project_limit ){?>

                                                                            <div class="wt-btnarea">

                                                                                <a href="#" onclick="event_preventDefault(event);"
                                                                                    class="wt-btn wt-loadmore-crprojects"><?php esc_html_e('Load More','workreap');?></a>

                                                                            </div>

                                                                            <?php }?>

                                                                        </div>

                                                                    </div>

                                                                    <?php

                                    }?>
                                                </div>
                                                <div class="tab-pane fade" id="videos" role="tabpanel"
                                                    aria-labelledby="videos-tab">
                                                    <div class="wt-videos wt-craftedprojects profile-view">
                                                        <div class="wt-videos-wrap">
                                                            <?php 
                                            $total_videos	= !empty($videos) ? count(array_filter($videos)) : 0;
                                            $count_item		= 0;
                                            foreach( $videos as $key => $media ){
                                                if( !empty( $media ) ){
                                                    $count_item ++;
                                                    $item_show	= !empty($count_item) && intval($count_item) > $cr_video_limit ? 'd-none' : "";
                                                ?>
                                                                                        <div
                                                                                            class="wt-video-list <?php echo do_shortcode( $item_show );?>">
                                                                                            <?php
                                                        $media_url  = parse_url($media);
                                                        $height 	= 210;
                                                        $width 		= 370;

                                                        $url = parse_url($media);
                                                        if ( isset( $url['host'] ) && ( $url['host'] == 'vimeo.com' || $url['host'] == 'player.vimeo.com' ) ) {
                                                            echo '<div class="sp-videos-frame">';
                                                            $content_exp = explode("/", $media);
                                                            $content_vimo = array_pop($content_exp);
                                                            echo '<iframe width="' . intval($width) . '" height="' . intval($height) . '" src="https://player.vimeo.com/video/' . $content_vimo . '" 
                                                                    ></iframe>';
                                                            echo '</div>';
                                                        } elseif ( isset( $url['host'] ) && $url['host'] == 'soundcloud.com') {
                                                            $video = wp_oembed_get($media, array('height' => intval($height)));
                                                            $search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="no"', 'scrolling="no"');
                                                            echo '<div class="audio">';
                                                            $video = str_replace($search, '', $video);
                                                            echo str_replace('&', '&amp;', $video);
                                                            echo '</div>';
                                                        } else {
                                                            echo '<div class="sp-videos-frame">';
                                                            echo do_shortcode('[video width="' . intval($width) . '" height="' . intval($height) . '" src="' . esc_url($media) . '"][/video]');
                                                            echo '</div>';
                                                        }
                                                    ?>
                                                            </div>
                                                            <?php }} 
			                        if( intval($total_videos) > $cr_video_limit ){?>
                                                            <div class="wt-btnarea">
                                                                <a href="#" onclick="event_preventDefault(event);"
                                                                    class="wt-btn wt-loadmore-videos"><?php esc_html_e('Load More','workreap');?></a>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="filters" role="tabpanel"
                                                    aria-labelledby="filters-tab">
                                                    <div class="all-filters-view-hwe profile-view">
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
                                                </div>
                                                <div class="tab-pane fade" id="social" role="tabpanel"
                                                    aria-labelledby="social-tab">
                                                    <div class="all-filters-view-hwe profile-view">
                                                        <div class="row">
                                                            <div class="col">
                                                                <?php
										echo "Facebook Followers: <b>".get_user_meta($user_id, 'facebook_followers', true)."</b>";
									?>
                                                            </div>
                                                            <div class="col">
                                                                <?php	
										echo "Instagram Followers: <b>".get_user_meta($user_id, 'instagram_followers', true)."</b>";		
									?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <?php
									echo "Spotify Followers: <b>".get_user_meta($user_id, 'spotify_followers', true)."</b>";
									?>
                                                            </div>
                                                            <div class="col">
                                                                <?php	
										echo "SoundCloud Followers: <b>".get_user_meta($user_id, 'sound_cloud_followers', true)."</b>";			
									?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <?php
									echo "TikTok Followers: <b>".get_user_meta($user_id, 'tik_tok_followers', true)."</b>";
									?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="gigs" role="tabpanel" aria-labelledby="gigs-tab">
                                                <div class="all-events col-12 d-flex">
                                                    <?php 
                                                    foreach($query->posts as $querypost){
                                                    $event_link=$querypost->guid;    
                                                    $event_id = $querypost->ID;
                                                    $event_location = get_post_meta($event_id, '_event_location', true);
                                                    $event_venue_website_address=get_post_meta($event_id, '_venue_website_address', true);
                                                    $event_description=get_post_meta($event_id, '_event_description', true);
                                                    $venue_name = get_post_meta($event_id, '_venue_name', true);
                                                    $event_url=get_post_meta($event_id, '_event_video_url', true);
                                                    $event_start_date = get_post_meta($event_id, '_event_start_date', true);?>
                                                    <div
                                                        class="wpem-event-box-col wpem-col wpem-col-12 wpem-col-md-6 wpem-col-lg-3">
                                                        <div class="wpem-event-layout-wrapper profile-view">
                                                            <div class="wpem-event-banner profile-view">
                                                                <div class="wpem-event-banner-img profile-view"
                                                                    style="background-image: url(<?php echo esc_attr($freelancer_avatar) ?>);height: 230px;">
                                                                    <div class="wpem-event-date profile-view">
                                                                        <div class="wpem-event-date-type profile-view">
                                                                            <?php
                                                                            if (!empty($event_start_date)) {
                                                                            ?>
                                                                            <div class="wpem-from-date profile-view">
                                                                                <div class="wpem-date profile-view">
                                                                                    <?php echo  date_i18n('d', strtotime($event_start_date)); ?>
                                                                                </div>
                                                                                <div class="wpem-month profile-view">
                                                                                    <?php echo date_i18n('M', strtotime($event_start_date)); ?>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpem-event-infomation profile-view">
                                                                <div class="wpem-event-details profile-view">
                                                                    <div
                                                                        class="wpem-event-date-time-second profile-view">
                                                                        <h5 class="wpem-heading-text"
                                                                        style="padding-left: 10px !important; padding-top: 5px !important;">
                                                                        Date & Time: <span style="font-weight: bold;"> <?php 
                                                                        $timezone = new DateTimeZone('Asia/Kolkata'); // India timezone
                                                                        $dateTime = new DateTime($event_start_date, $timezone);
                                                                        $formattedDateTime = $dateTime->format('d M h:i A');
                                                                        echo $formattedDateTime; ?> 
                                                                        </span>
                                                                    </h5>
                                                                    </div>

                                                                    <div class="wpem-event-location profile-view">
                                                                        <h5 class="wpem-heading-text"
                                                                        style="padding-left: 10px !important; padding-top: 5px !important;">
                                                                        Location: <span style="font-weight: bold;"> <?php echo $event_location; ?> 
                                                                        </span>
                                                                    </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="view-profile-event-tab profile-view">
                                                                    <h5 class="wpem-heading-text"
                                                                        style="padding-left: 10px !important; padding-top: 5px !important;">
                                                                        Venue Name:<span style="font-weight: bold;"><?php echo $venue_name?></span></h5>
                                                                    <h5 class="wpem-heading-text"
                                                                        style="padding-left: 10px !important; padding-top: 5px !important;">
                                                                        Online Event URL: <a
                                                                            class="event-artist-profile"
                                                                            href="<?php echo $event_url; ?>"><?php echo $event_url; ?></a>
                                                                    </h5>
                                                                    <h5 class="wpem-heading-text"
                                                                        style="padding-left: 10px !important; padding-top: 5px !important;">
                                                                        Description: <span style="font-weight: bold;"><?php echo $event_description; ?></span>
                                                                    </h5>
                                                                    <h5 class="wpem-heading-text"
                                                                        style="padding-left: 10px !important; padding-top: 5px !important;">
                                                                        Venue Website: <a class="event-artist-profile"
                                                                            href="<?php echo $event_venue_website_address; ?>"><?php echo $event_venue_website_address; ?></a>
                                                                    </h5>
                                                                    
                                                                </div>
                                                                <a href="<?php echo $event_link ?>" class="wt-btn change-password view-artist-profile" style="padding: 0px 8px;font-size: 11px;margin: 0 8px 13px 8px;line-height: 3;height: 35px;">View Event</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <?php 
                                                    
                                                } ?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                                </div>
                    <div class="back-button-div d-flex" style="width: 100%;">
                                <div class="col-6">
                                </div>
                    <div class="col-6 d-flex justify-content-end">
                        <div class="wt-description d-flex justify-content-end" style="width:33%;margin-left: 20%;">

                            <?php if( is_user_logged_in() ) {?>

                            <a class="wt-btn wt-send-offers msg-btn-profile" href="#" onclick="event_preventDefault(event);">

                                <?php esc_html_e('Send Message','workreap');?>

                            </a>

                            <?php } else {?>

                            <a class="wt-btn wt-loginfor-offer msg-btn-profile" data-url="<?php echo esc_url($login_page);?>"
                                href="#" onclick="event_preventDefault(event);">

                                <?php esc_html_e('Send Message','workreap');?>

                            </a>

                            <?php } ?>

                        </div>
                            <div class="d-flex justify-content-end" style="width:33%;">
                                    <?php do_action('workreap_save_freelancer_html', $user_id);?>
                               
                            </div> 
                            <div style="width:33%;padding-left: 5px;">
                                <a href="" class="wt-btn wt-send-offers msg-btn-profile" onclick="window.history.back(); return false;">Back To Search</a>
                            </div> 
                        </div> 
                        </div> 
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>