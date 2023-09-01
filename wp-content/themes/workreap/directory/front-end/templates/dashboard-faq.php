<?php
/**
 *
 * The template part for displaying the dashboard menu
 *
 * @package   Workreap
 * @author    Amentotech
 * @link      http://amentotech.com/
 * @since 1.0
 */
global $current_user, $wp_roles, $userdata, $post;
$user_identity 	 = $current_user->ID;
$linked_profile  = workreap_get_linked_profile_id($user_identity);
$post_id 		 = $linked_profile;
$document_name   = '';
$banner_image 	= array();

if( has_post_thumbnail($post_id) ){
	$attachment_id 			= get_post_thumbnail_id($post_id);
	$image_url 				= !empty( $attachment_id ) ? wp_get_attachment_image_src( $attachment_id, 'workreap_freelancer', true ) : '';
	$file_size 				= !empty( get_attached_file($attachment_id) ) ? filesize(get_attached_file($attachment_id)) : '';	
	$document_name   		= !empty( $attachment_id ) ? esc_html( get_the_title( $attachment_id )) : '';
}

$rand 			= rand(9999, 999);

?>
<div class="wt-profilephoto wt-tabsinfo wt-profile-avatar">
	<div class="wt-tabscontenttitle">
		<h2><?php esc_html_e('Upload Main Profile Image', 'workreap'); ?></h2>
	</div>
	<div class="wt-profilephotocontent">		
		<div class="wt-formtheme wt-formprojectinfo wt-formcategory" id="wt-img-<?php echo esc_attr( $rand ); ?>">
			<fieldset>
				<div class="form-group form-group-label" id="wt-image-container-<?php echo esc_attr( $rand ); ?>">
					<div class="wt-labelgroup"  id="image-drag-<?php echo esc_attr( $rand ); ?>">
						<label for="file" class="wt-image-file">
							<span class="wt-btn" id="image-btn-<?php echo esc_attr( $rand ); ?>"><?php esc_html_e('Select File', 'workreap'); ?></span>								
						</label>
						<span><?php esc_html_e('Drop files here to upload', 'workreap'); ?></span>
						<em class="wt-fileuploading"><?php esc_html_e('Uploading', 'workreap'); ?><i class="fa fa-spinner fa-spin"></i></em>
					</div>
				</div>
				<div class="form-group uploaded-placeholder">
					<?php if( !empty( $image_url[0] ) ){ ?>
						<ul class="wt-attachfile wt-attachfilevtwo">						
							<li class="wt-uploadingholder wt-companyimg-user">
								<div class="wt-uploadingbox">
									<figure><img class="img-thumb" src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>
									<div class="wt-uploadingbar">
										<span class="uploadprogressbar"></span>
										<?php if(!empty($document_name)){?><span><?php echo esc_html( $document_name ); ?></span><?php }?>
										<em><?php esc_html_e('File size:', 'workreap'); ?> <?php echo esc_html( size_format($file_size, 2) ); ?><a href="#" onclick="event_preventDefault(event);" class="wt-remove-image lnr lnr-cross"></a></em>
									</div>	
									<input type="hidden" name="basics[avatar][attachment_id]" value="<?php echo esc_attr( $attachment_id ); ?>">	
								</div>
							</li>						
						</ul>						
					<?php } ?>
				</div>		
			</fieldset>
		</div>
	</div>
</div>

<?php
	$inline_script = 'jQuery(document).on("ready", function() { init_image_uploader_v2("' . esc_js( $rand ). '", "profile"); });';
	wp_add_inline_script( 'workreap-user-dashboard', $inline_script, 'after' );
?>
<script type="text/template" id="tmpl-load-default-image">
	<ul class="wt-attachfile wt-attachfilevtwo">
		<li class="award-new-item wt-uploadingholder wt-doc-parent" id="thumb-{{data.id}}">
			<div class="wt-uploadingbox">
				<figure><img class="img-thumb" src="<?php echo esc_url( get_template_directory_uri());?>/images/profile.jpg" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>
				<div class="wt-uploadingbar wt-uploading">
					<span class="uploadprogressbar" style="width:{{data.percentage}}%"></span>
					<span>{{data.name}}</span>
					<em><?php esc_html_e('File size:', 'workreap'); ?> {{data.size}}<a href="#" onclick="event_preventDefault(event);" class="wt-remove-image lnr lnr-cross"></a></em>	
				</div>	
			</div>
		</li>
	</ul>	
</script>
<script type="text/template" id="tmpl-load-profile-image">
	<div class="wt-uploadingbox">
		<figure><img class="img-thumb" src="{{data.url}}" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>
		<div class="wt-uploadingbar">
			<span class="uploadprogressbar"></span>
			<span>{{data.name}}</span>
			<em><?php esc_html_e('File size:', 'workreap'); ?> {{data.size}}<a href="#" onclick="event_preventDefault(event);" class="wt-remove-image lnr lnr-cross"></a></em>
			<input type="hidden" name="basics[avatar]" value="{{data.url}}">	
		</div>	
	</div>	
</script>

<?php

if( apply_filters('workreap_is_feature_allowed', 'wt_banner', $user_identity) === true ){

	$banner_image 	= array();

	if (function_exists('fw_get_db_post_option')) {

		$banner_image       = fw_get_db_post_option($post_id, 'banner_image', true);	

	}



	//Banner image
 
	$banner_file_size 		= !empty( $banner_image['attachment_id']) ? filesize(get_attached_file($banner_image['attachment_id'])) : '';	

	$banner_document_name	= !empty( $banner_image['attachment_id'] ) ? esc_html( get_the_title( $banner_image['attachment_id'] ) ) : '';

	$banner_filetype        = !empty( $banner_image['attachment_id'] ) ? wp_check_filetype( $banner_image['url'] ) : '';

	$banner_extension  		= !empty( $banner_filetype['ext'] ) ? $banner_filetype['ext'] : '';

	$banner_image_url 		= !empty( $banner_image['attachment_id'] ) ? wp_get_attachment_image_src( $banner_image['attachment_id'], 'workreap_freelancer', true ) : '';



	$banner_rand	= rand(999, 99999);



	?>

	 <div class="wt-profilephoto wt-tabsinfo wt-profile-banner">

		<div class="wt-tabscontenttitle">

			<h2><?php esc_html_e('Upload Background Image', 'workreap'); ?></h2>

		</div>

		<div class="wt-profilephotocontent">		

			<div class="wt-formtheme wt-formprojectinfo wt-formcategory" id="wt-img-<?php echo esc_attr( $banner_rand ); ?>">

				<fieldset>

					<div class="form-group form-group-label" id="wt-image-container-<?php echo esc_attr( $banner_rand ); ?>">

						<div class="wt-labelgroup"  id="image-drag-<?php echo esc_attr( $banner_rand ); ?>">

							<label for="file" class="wt-image-file">

								<span class="wt-btn" id="image-btn-<?php echo esc_attr( $banner_rand ); ?>"><?php esc_html_e('Select File', 'workreap'); ?></span>								

							</label>

							<span><?php esc_html_e('Drop files here to upload', 'workreap'); ?></span>

							<em class="wt-fileuploading"><?php esc_html_e('Uploading', 'workreap'); ?><i class="fa fa-spinner fa-spin"></i></em>

						</div>

					</div>

					<div class="form-group uploaded-placeholder">

						<?php if( !empty( $banner_image_url[0] ) ){ ?>

							<ul class="wt-attachfile wt-attachfilevtwo">						

								<li class="wt-uploadingholder wt-companyimg-user">

									<div class="wt-uploadingbox">

										<figure><img class="img-thumb" src="<?php echo esc_url( $banner_image_url[0] ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>

										<div class="wt-uploadingbar">

											<span class="uploadprogressbar"></span>

											<span><?php echo esc_html( $banner_document_name ); ?></span>

											<em><?php esc_html_e('File size:', 'workreap'); ?> <?php echo esc_html( size_format($banner_file_size, 2) ); ?><a href="#" onclick="event_preventDefault(event);" class="wt-remove-image lnr lnr-cross"></a></em>

										</div>	

										<input type="hidden" name="basics[banner][attachment_id]" value="<?php echo esc_attr( $banner_image['attachment_id'] ); ?>">	

										<input type="hidden" name="basics[banner][url]" value="<?php echo esc_url( $banner_image['url'] ); ?>">	

									</div>

								</li>						

							</ul>						

						<?php } ?>

					</div>		

				</fieldset>

			</div>

		</div>

	</div> 

	<?php

		$inline_script_v = 'jQuery(document).on("ready", function() { init_image_uploader_v2("' . esc_js( $banner_rand ). '", "banner"); });';

		wp_add_inline_script( 'workreap-user-dashboard', $inline_script_v, 'after' );

	?>

	<script type="text/template" id="tmpl-load-default-image">

		<ul class="wt-attachfile wt-attachfilevtwo">

			<li class="award-new-item wt-uploadingholder wt-doc-parent" id="thumb-{{data.id}}">

				<div class="wt-uploadingbox">

					<figure><img class="img-thumb" src="<?php echo esc_url( get_template_directory_uri());?>/images/profile.jpg" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>

					<div class="wt-uploadingbar wt-uploading">

						<span class="uploadprogressbar" style="width:{{data.percentage}}%"></span>

						<span>{{data.name}}</span>

						<em><?php esc_html_e('File size:', 'workreap'); ?> {{data.size}}<a href="#" onclick="event_preventDefault(event);" class="wt-remove-image lnr lnr-cross"></a></em>	

					</div>	

				</div>

			</li>

		</ul>	

	</script>

	<script type="text/template" id="tmpl-load-banner-image">

		<div class="wt-uploadingbox">

			<figure><img class="img-thumb" src="{{data.url}}" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>

			<div class="wt-uploadingbar">

				<span class="uploadprogressbar"></span>

				<span>{{data.name}}</span>

				<em><?php esc_html_e('File size:', 'workreap'); ?> {{data.size}}<a href="#" onclick="event_preventDefault(event);" class="wt-remove-image lnr lnr-cross"></a></em>

				<input type="hidden" name="basics[banner]" value="{{data.url}}">	

			</div>	

		</div>	

	</script>

	

<?php } 
 
if (function_exists('fw_get_db_post_option')) {
	$freelancer_gallery       = fw_get_db_post_option($post_id, 'images_gallery',$default_value = null);	
}

$banner_rand	= rand(9999, 999);
?>
<div class="wt-profilephoto wt-tabsinfo wt-profile-gallery">
	<div class="wt-tabscontenttitle">
		<h2><?php esc_html_e('Gallery Photo', 'workreap'); ?></h2>
	</div>
	<div class="wt-profilephotocontent">		
		<div class="wt-formtheme wt-formprojectinfo wt-formcategory" id="wt-img-<?php echo esc_attr( $banner_rand ); ?>">
			<fieldset>
				<div class="form-group form-group-label" id="wt-image-container-<?php echo esc_attr( $banner_rand ); ?>">
					<div class="wt-labelgroup"  id="image-drag-<?php echo esc_attr( $banner_rand ); ?>">
						<label for="file" class="wt-image-file">
							<span class="wt-btn" id="image-btn-<?php echo esc_attr( $banner_rand ); ?>"><?php esc_html_e('Select File', 'workreap'); ?></span>								
						</label>
						<span><?php esc_html_e('Drop files here to upload', 'workreap'); ?></span>
						<em class="wt-fileuploading"><?php esc_html_e('Uploading', 'workreap'); ?><i class="fa fa-spinner fa-spin"></i></em>
					</div>
				</div>
				<div class="form-group uploaded-placeholder">
					
					<ul class="wt-attachfile wt-attachfilevtwo wt-galler-images">	
						<?php if( !empty( $freelancer_gallery ) ){ 
							foreach($freelancer_gallery as $key => $gallery_image ) {
								$banner_file_size 		= !empty( $gallery_image['attachment_id']) ? filesize(get_attached_file($gallery_image['attachment_id'])) : '';	
								$banner_document_name	= !empty( $gallery_image['attachment_id'] ) ? esc_html( get_the_title( $gallery_image['attachment_id'] ) ) : '';
								$banner_filetype        = !empty( $gallery_image['attachment_id'] ) ? wp_check_filetype( $gallery_image['url'] ) : '';
								$banner_extension  		= !empty( $banner_filetype['ext'] ) ? $banner_filetype['ext'] : '';
								$gallery_image_url 		= !empty( $gallery_image['attachment_id'] ) ? wp_get_attachment_image_src( $gallery_image['attachment_id'], 'workreap_freelancer', true ) : '';
							?>
							<li class="wt-uploadingholder wt-companyimg-user">
								<div class="wt-uploadingbox">
									<figure><img class="img-thumb" src="<?php echo esc_url( $gallery_image_url[0] ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>
									<div class="wt-uploadingbar">
										<span class="uploadprogressbar"></span>
										<span><?php echo esc_html( $banner_document_name ); ?></span>
										<em><?php esc_html_e('File size:', 'workreap'); ?> <?php echo esc_html( size_format($banner_file_size, 2) ); ?><a href="#" onclick="event_preventDefault(event);" class="wt-remove-gallery-image lnr lnr-cross"></a></em>
									</div>	
									<input type="hidden" name="basics[images_gallery][<?php echo intval($key);?>][attachment_id]" value="<?php echo esc_attr( $gallery_image['attachment_id'] ); ?>">	
									<input type="hidden" name="basics[images_gallery][<?php echo intval($key);?>][url]" value="<?php echo esc_url( $gallery_image['url'] ); ?>">	
								</div>
							</li>	
						<?php }} ?>					
					</ul>						
				</div>		
			</fieldset>
		</div>
	</div>
</div>
<?php
	$inline_script_v = 'jQuery(document).on("ready", function() { init_image_uploader_gallery("' . esc_js( $banner_rand ). '", "gallery"); });';
	wp_add_inline_script( 'workreap-user-dashboard', $inline_script_v, 'after' );
?>
<script type="text/template" id="tmpl-load-gallery-image">
	<li class="wt-uploadingholder wt-companyimg-user" id="thumb-{{data.id}}">
		<div class="wt-uploadingbox">
			<figure><img class="img-thumb" src="<?php echo esc_url( get_template_directory_uri());?>/images/profile.jpg" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>
			<div class="wt-uploadingbar wt-uploading">
				<span class="uploadprogressbar" style="width:{{data.percentage}}%"></span>
				<span>{{data.name}}</span>
				<em><?php esc_html_e('File size:', 'workreap'); ?> {{data.size}}<a href="#" onclick="event_preventDefault(event);" class="wt-remove-gallery-image lnr lnr-cross"></a></em>	
			</div>	
		</div>
	</li>
</script>
<script type="text/template" id="tmpl-load-append-gallery-image">
	<div class="wt-uploadingbox">
		<figure><img class="img-thumb" src="{{data.url}}" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"></figure>
		<div class="wt-uploadingbar">
			<span class="uploadprogressbar"></span>
			<span>{{data.name}}</span>
			<em><?php esc_html_e('File size:', 'workreap'); ?> {{data.size}}<a href="#" onclick="event_preventDefault(event);" class="wt-remove-gallery-image lnr lnr-cross"></a></em>
			<input type="hidden" name="basics[images_gallery_new][]" value="{{data.url}}">	
		</div>	
	</div>	
</script>