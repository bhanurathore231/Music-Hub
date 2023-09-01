<?php
/**
 *
 * The template part for displaying social profile 
 *
 * @package   Workreap
 * @author    Amentotech
 * @link      http://amentotech.com/
 * @since 1.0
 */

global $current_user;
$user_identity 	 	= $current_user->ID;
$linked_profile  	= workreap_get_linked_profile_id($user_identity);
$user_type			= apply_filters('workreap_get_user_type', $user_identity );
$facebook_follower=get_user_meta($user_identity, 'facebook_followers', true);
$instagram_follower=get_user_meta($user_identity, 'instagram_followers', true);
$sound_cloud_follower=get_user_meta($user_identity, 'sound_cloud_followers', true);
$tik_tok_follower=get_user_meta($user_identity, 'tik_tok_followers', true);
$spotify_follower=get_user_meta($user_identity, 'spotify_followers', true);


?>

<div class="wt-yourdetails wt-tabsinfo">
	<div class="wt-tabscontenttitle">
		<h2><?php esc_html_e('Please Enter Numbers of Followers Manually', 'workreap'); ?></h2>
	</div>
	<div class="wt-formtheme wt-userform">
	<fieldset>	
			<div class="form-group form-group-half toolip-wrapo">
				<label>Facebook Followers</label>
				<input type="text" name="basics[facebook_followers]" class="form-control" value="<?php echo esc_attr( $facebook_follower);?>" placeholder="Facebook Followers">
			</div>
			<div class="form-group form-group-half toolip-wrapo">
			<label>Instagram Followers</label>
				<input type="text" name="basics[instagram_followers]" class="form-control" value="<?php echo esc_attr( $instagram_follower);?>" placeholder="Instagram Followers">
			</div>
			<div class="form-group form-group-half toolip-wrapo">
			<label>Spotify Followers</label>
				<input type="text" name="basics[spotify_followers]" class="form-control" value="<?php echo esc_attr( $spotify_follower);?>" placeholder="Spotify Followers">	
			</div>
			<div class="form-group form-group-half toolip-wrapo">
			<label>Sound Cloud Followers</label>
				<input type="text" name="basics[sound_cloud_followers]" class="form-control count_tagline" value="<?php echo esc_attr( $sound_cloud_follower);?>" placeholder="Sound Cloud Followers">
			</div>
			<div class="form-group toolip-wrapo">
			<label>Tik Tok Followers</label>
				<input type="text" name="basics[tik_tok_followers]" class="form-control count_tagline" value="<?php echo esc_attr( $tik_tok_follower);?>" placeholder="Tik Tok Followers">
			</div>

		</fieldset>
	</div>
</div>
