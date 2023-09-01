<?php
global $post;
$post_id=$post->ID;
$start_date = get_event_start_date();
$start_time = get_event_start_time();
$end_date   = get_event_end_date();
$end_time   = get_event_end_time();
$event_type = get_event_type();
$event_venue = get_post_meta($post_id, '_venue_name', true);
$event_url = get_post_meta($post_id, '_event_video_url', true);
$event_description = get_post_meta($post_id, '_event_description', true);
$event_venue_website_address = get_post_meta($post_id, '_venue_website_address', true);
if (is_array($event_type) && isset($event_type[0]))
    $event_type = $event_type[0]->slug;

$thumbnail  = get_event_thumbnail($post, 'full');
$event_id = get_the_ID(); // Get the current event ID
$author_id = get_post_field( 'post_author', $event_id );
  
$user_info = get_user_by( 'ID', $author_id );
$user_id = $user_info->data->ID;
$user_avatar = get_avatar_url($user_id);
$display_name=$user_info->user_login;
$nicename = $user_info->user_nicename;
?>

<div class="wpem-event-box-col wpem-col wpem-col-12 wpem-col-md-6 wpem-col-lg-<?php echo esc_attr(apply_filters('event_manager_event_wpem_column', '4')); ?>">
    <!----- wpem-col-lg-4 value can be change by admin settings ------->
    <div class="wpem-event-layout-wrapper">
        <div <?php event_listing_class(''); ?>>
            <!--<a href="<?php display_event_permalink(); ?>" class="wpem-event-action-url event-style-color <?php echo esc_attr($event_type); ?>">
			-->
                <div class="wpem-event-banner">
                    <div class="wpem-event-banner-img" style="background-image: url(<?php echo esc_attr($user_avatar) ?>)">

                        <!-- Hide in list View // Show in Box View -->
                        <?php do_action('event_already_registered_title'); ?>
                        <div class="wpem-event-date">
                            <div class="wpem-event-date-type">
                                <?php
                                if (!empty($start_date)) {
                                ?>
                                    <div class="wpem-from-date">
                                        <div class="wpem-date"><?php echo  date_i18n('d', strtotime($start_date)); ?></div>
                                        <div class="wpem-month"><?php echo date_i18n('M', strtotime($start_date)); ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Hide in list View // Show in Box View -->
                    </div>
                </div>

                <div class="wpem-event-infomation">
                    <div class="wpem-event-date">
                        <div class="wpem-event-date-type">
                            <?php
                            if (!empty($start_date)) {
                            ?>
                                <div class="wpem-from-date">
                                    <div class="wpem-date"><?php echo  date_i18n('d', strtotime($start_date)); ?></div>
                                    <div class="wpem-month"><?php echo  date_i18n('M', strtotime($start_date)); ?></div>
                                </div>
                            <?php } ?>

                            <?php
                            //if ($start_date != $end_date && !empty($end_date)) {
                            ?>
                                <!-- <div class="wpem-to-date">
                                    <div class="wpem-date-separator">-</div>
                                    <div class="wpem-date"><?php //echo  date_i18n('d', strtotime($end_date)); ?></div>
                                    <div class="wpem-month"><?php //echo date_i18n('M', strtotime($end_date)); ?></div>
                                </div> -->
                            <?php //} ?>
                        </div>
                    </div>

                    <div class="wpem-event-details">
                        <?php do_action('wpem_event_listing_event_detail_start', $post->ID); ?>

                        <div class="wpem-event-date-time">
                            <span class="wpem-event-date-time-text">
                                <?php display_event_start_date(); ?>
                                <?php
                                if (!empty($start_time)) {
                                    display_date_time_separator();
                                }
                                ?>
                                <?php display_event_start_time(); ?>
                                <?php
                                /* if (!empty($end_date) || !empty($end_time)) {
                                ?> - <?php } */ ?>

                                <?php
/*                                 if (isset($start_date) && isset($end_date) && $start_date != $end_date) {
                                    display_event_end_date();
                                } */
                                ?>
                                <?php
 /*                                if (!empty($end_date)) {
                                    display_date_time_separator();
                                } */
                                ?>
                                <?php //display_event_end_time(); ?>
                            </span>
                        </div>

                        <div class="wpem-event-location">
                            <span class="wpem-event-location-text">
                                <?php
                                if (get_event_location() == 'Online Event' || get_event_location() == '') : echo esc_attr('Online Event', 'wp-event-manager');
                                else : display_event_location(false);
                                endif;
                                ?>
                            </span>
                        </div>

                        <?php
                        if (get_option('event_manager_enable_event_types') && get_event_type()) {
                        ?>
                            <div class="wpem-event-type"><?php display_event_type(); ?></div>
                        <?php } ?>

                        <?php do_action('event_already_registered_title'); ?>

                        <!-- Show in list View // Hide in Box View -->
                        <?php
                        if (get_event_ticket_option()) {
                        ?>
                            <div class="wpem-event-ticket-type" class="wpem-event-ticket-type-text">
                                <span class="wpem-event-ticket-type-text"><?php display_event_ticket_option(); ?></span>
                            </div>
                        <?php } ?>
                        <!-- Show in list View // Hide in Box View -->
                        <?php do_action('wpem_event_listing_event_detail_end', $post->ID); ?>
                    </div>
                    <div class=view-profile-event-tab>
                        <h5 class="wpem-heading-text" style="padding-left: 10px !important; padding-top: 5px !important;">Artist Name: <a class="event-artist-profile" href="<?php echo get_site_url();?>/freelancer/<?php echo $nicename; ?>"><?php echo $display_name; ?></a></h5>
                        <h5 class="wpem-heading-text" style="padding-left: 10px !important; padding-top: 5px !important;">Venue Name:<?php echo $event_venue?></h5>
                        <h5 class="wpem-heading-text" style="padding-left: 10px !important; padding-top: 5px !important;">Online Event URL: <a class="event-artist-profile" href="<?php echo $event_url; ?>"><?php echo $event_url; ?></a></h5>
                        <h5 class="wpem-heading-text" style="padding-left: 10px !important; padding-top: 5px !important;">Description: <?php echo $event_description; ?></h5>
                        <h5 class="wpem-heading-text" style="padding-left: 10px !important; padding-top: 5px !important;">Venue Website: <a class="event-artist-profile" href="<?php echo $event_venue_website_address; ?>"><?php echo $event_venue_website_address; ?></a></h5>
						
                    </div>
                </div>
				<a href="<?php echo get_site_url();?>/freelancer/<?php echo $nicename; ?>" class="wt-btn change-password view-artist-profile" style="padding: 0px 8px;font-size: 11px;margin: 0 8px 13px 8px;line-height: 3;height: 35px;">View Artist Profile</a>
            <!-- 
			</a>
            -->
        </div>
        
    </div>
  
</div>