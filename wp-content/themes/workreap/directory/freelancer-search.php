<?php

/**

 *

 * Template Name: Search Freelancer

 *

 * @package   Workreap

 * @author    Amentotech

 * @link      http://amentotech.com/

 * @since 1.0

 */

get_header();

global $paged, $wp_query,$post,$current_user;


$pg_page    = get_query_var('page') ? get_query_var('page') : 1; //rewrite the global var

$pg_paged   = get_query_var('paged') ? get_query_var('paged') : 1; //rewrite the global var

//paged works on single pages, page - works on homepage

$paged = max($pg_page, $pg_paged);



do_action('workreap_restict_user_view_search'); //check user restriction



//multiselect_freelancertype

$freelancer_price_option	= '';

$freelancertype				= '';

$freelancers_search_restrict	= array();

if (function_exists('fw_get_db_settings_option')) {

	$freelancers_per_page 			= fw_get_db_settings_option('freelancers_per_page');

	$freelancer_avatar_search 		= fw_get_db_settings_option('freelancer_avatar_search');

	$freelancertype	= fw_get_db_settings_option('multiselect_freelancertype', $default_value = null);

	$frc_remove_freelancer_type	 = fw_get_db_settings_option('frc_remove_freelancer_type', $default_value = 'no');

	$frc_remove_languages		 = fw_get_db_settings_option('frc_remove_languages', $default_value = 'no');

	$frc_english_level			 = fw_get_db_settings_option('frc_english_level', $default_value = 'no');

	$hide_profiles				 = fw_get_db_settings_option('hide_profiles', $default_value = 'no');

	$freelancer_price_option	= fw_get_db_settings_option('freelancer_price_option', $default_value = null);

	$freelancers_search_restrict 	= fw_get_db_settings_option('freelancers_search_restrict');
}



$show_posts = !empty($freelancers_per_page) ? $freelancers_per_page : get_option('posts_per_page');



if (!empty($freelancers_search_restrict['gadget']) && $freelancers_search_restrict['gadget'] == 'disable' && !empty($freelancers_search_restrict['disable']['search_numbers']) && !is_user_logged_in()) {

	$show_posts	= intval($freelancers_search_restrict['disable']['search_numbers']);
}

//Search parameters

$keyword 		= !empty($_GET['keyword']) ? $_GET['keyword'] : '';

$sortby 		= !empty($_GET['sortby']) ? $_GET['sortby'] : '';

$invited 		= !empty($_GET['invite']) ? $_GET['invite'] : '';

$rating 		= !empty($_GET['rating']) ? $_GET['rating'] : 'DESC';

$languages 		= !empty($_GET['language']) ? $_GET['language'] : array();

$locations 	 	= !empty($_GET['location']) ? $_GET['location'] : array();

$schools 	   = !empty($_GET['school']) ? $_GET['school'] : array();

$artist_types 	= !empty($_GET['artist_type']) ? $_GET['artist_type'] : array();

$music_genres 	= !empty($_GET['music_genre']) ? $_GET['music_genre'] : array();

$number_of_members 	= !empty($_GET['number_of_members']) ? $_GET['number_of_members'] : array();

$instruments_associated_with_acts = !empty($_GET['instruments_associated_with_act']) ? $_GET['instruments_associated_with_act'] : array();

$age_ranges 	 	= !empty($_GET['age_range']) ? $_GET['age_range'] : array();

$years_performings 	= !empty($_GET['years_performing']) ? $_GET['years_performing'] : array();

$next_gigs 	        = !empty($_GET['next_gig']) ? $_GET['next_gig'] : array();

$citys 	        = !empty($_GET['city']) ? $_GET['city'] : array();

$countries 	        = !empty($_GET['country']) ? $_GET['country'] : array();

$representations   = !empty($_GET['representation']) ? $_GET['representation'] : array();

$skills			= !empty($_GET['skills']) ? $_GET['skills'] : array();

$duration 		= !empty($_GET['duration']) ? $_GET['duration'] : '';

$type 			= !empty($_GET['type']) ? $_GET['type'] : array();

$english_level  = !empty($_GET['english_level']) ? $_GET['english_level'] : array();

$hourly_rate    = !empty($_GET['hourly_rate']) ? explode('-', $_GET['hourly_rate']) : '';

$specialization			= !empty($_GET['specialization']) ? $_GET['specialization'] : array();

$industrial_experience	= !empty($_GET['industrial_experience']) ? $_GET['industrial_experience'] : array();





$clearall	= false;

if (
	!empty($keyword)

	|| !empty($sortby)

	|| !empty($invited)

	|| !empty($languages)

	|| !empty($locations)

	|| !empty($schools)

	|| !empty($artist_types)

	|| !empty($music_genres)

	|| !empty($number_of_members)

	|| !empty($instruments_associated_with_acts)

	|| !empty($age_ranges)

	|| !empty($years_performings)

	|| !empty($next_gigs)

	|| !empty($citys)
	
	|| !empty($countries)

	|| !empty($representations)

	|| !empty($skills)

	|| !empty($duration)

	|| !empty($type)

	|| !empty($english_level)

	|| !empty($hourly_rate)

	|| !empty($specialization)

	|| !empty($industrial_experience)
) {

	$clearall	= true;
}

$hourly_rate_start = 0;

$hourly_rate_end   = 1000;



//taxonomy page search

if (is_tax('freelancer_type')) {

	$type = $wp_query->get_queried_object();

	if (!empty($type->slug)) {

		$type = array($type->slug);
	}
}


if (!empty($hourly_rate)) {

	$hourly_rate_start = isset($hourly_rate[0]) ? intval($hourly_rate[0]) : 0;

	$hourly_rate_end   = !empty($hourly_rate[1]) ? intval($hourly_rate[1]) : 1000;
}



$tax_query_args  = array();

$meta_query_args = array();

//School @Bhanu
if (is_tax('schools') && empty($schools)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$schools = array($cat->slug);
	}
}

//artist types @Bhanu
if (is_tax('artist_types') && empty($artist_types)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$artist_types = array($cat->slug);
	}
}
//music genre @Bhanu
if (is_tax('music_genres') && empty($music_genres)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$music_genres = array($cat->slug);
	}
}
//Number of members @bhanu
if (is_tax('number_of_members') && empty($number_of_members)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$number_of_members = array($cat->slug);
	}
}
//instruments associated with act  @Bhanu
if (is_tax('instruments_associated_with_acts') && empty($instruments_associated_with_acts)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$instruments_associated_with_acts = array($cat->slug);
	}
}
//age range @bhanu
if (is_tax('age_ranges') && empty($age_ranges)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$age_ranges = array($cat->slug);
	}
}
//Years Performing
if (is_tax('years_performings') && empty($years_performings)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$years_performings = array($cat->slug);
	}
}
//Next Gig @Bhanu

if (is_tax('next_gigs') && empty($next_gigs)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$next_gigs = array($cat->slug);
	}
}
$next_gigs = array($cat->slug);
//City
if (is_tax('citys') && empty($citys)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$citys = array($cat->slug);
	}
}

if (is_tax('country') && empty($countries)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$countries = array($cat->slug);
	}
}



//representation
if (is_tax('representations') && empty($representations)) {

	$cat = $wp_query->get_queried_object();

	if (!empty($cat->slug)) {

		$representations = array($cat->slug);
	}
}
//Languages

if (!empty($languages[0]) && is_array($languages)) {

	$query_relation = array('relation' => 'OR',);

	$lang_args  	= array();



	foreach ($languages as $key => $lang) {

		$lang_args[] = array(

			'taxonomy' => 'languages',

			'field'    => 'slug',

			'terms'    => $lang,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $lang_args);
}

//Locations

if (!empty($locations[0]) && is_array($locations)) {

	$query_relation = array('relation' => 'OR',);

	$location_args  = array();



	foreach ($locations as $key => $loc) {

		$location_args[] = array(

			'taxonomy' => 'locations',

			'field'    => 'slug',

			'terms'    => $loc,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $location_args);
}
//School @Bhanu

if (!empty($schools[0]) && is_array($schools)) {

	$query_relation = array('relation' => 'OR',);

	$schools_args  = array();



	foreach ($schools as $key => $cat) {
		if ($keyword == $cat) {
		}
		$schools_args[] = array(

			'taxonomy' => 'school',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $schools_args);
}
//Artist Type

if (!empty($artist_types[0]) && is_array($artist_types)) {

	$query_relation = array('relation' => 'OR',);

	$artist_types_args  = array();



	foreach ($artist_types as $key => $cat) {

		$artist_types_args[] = array(

			'taxonomy' => 'artist_type',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $artist_types_args);
}
//Music Genre @bhanu

if (!empty($music_genres[0]) && is_array($music_genres)) {

	$query_relation = array('relation' => 'OR',);

	$music_genres_args  = array();



	foreach ($music_genres as $key => $cat) {

		$music_genres_args[] = array(

			'taxonomy' => 'music_genre',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $music_genres_args);
}
//No of Members @bhanu

if (!empty($number_of_members[0]) && is_array($number_of_members)) {

	$query_relation = array('relation' => 'OR',);

	$number_of_members_args  = array();



	foreach ($number_of_members as $key => $cat) {

		$number_of_members_args[] = array(

			'taxonomy' => 'number_of_members',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $number_of_members_args);
}

//Instruments_associated_with_act  @Bhanu

if (!empty($instruments_associated_with_acts[0]) && is_array($instruments_associated_with_acts)) {

	$query_relation = array('relation' => 'OR',);

	$instruments_associated_with_acts_args  = array();



	foreach ($instruments_associated_with_acts as $key => $cat) {

		$instruments_associated_with_acts_args[] = array(

			'taxonomy' => 'instruments_associated_with_act',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $instruments_associated_with_acts_args);
}
//Age Range @Bhanu

if (!empty($age_ranges[0]) && is_array($age_ranges)) {

	$query_relation = array('relation' => 'OR',);

	$age_ranges_args  = array();



	foreach ($age_ranges as $key => $cat) {

		$age_ranges_args[] = array(

			'taxonomy' => 'age_range',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $age_ranges_args);
}

//Years performing @Bhanu
if (!empty($years_performings[0]) && is_array($years_performings)) {

	$query_relation = array('relation' => 'OR',);

	$years_performings_args  = array();



	foreach ($years_performings as $key => $cat) {

		$years_performings_args[] = array(

			'taxonomy' => 'years_performing',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $years_performings_args);
}
//Next Gig
if (!empty($next_gigs[0]) && is_array($next_gigs)) {

	$query_relation = array('relation' => 'OR',);

	$next_gigs_args  = array();

	foreach ($next_gigs as $key => $cat) {

		$next_gigs_args[] = array(

			'taxonomy' => 'next_gig',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}

	$tax_query_args[] = array_merge($query_relation, $next_gig_args);
}
//City

if (!empty($citys[0]) && is_array($citys)) {

	$query_relation = array('relation' => 'OR',);

	$citys_args  = array();



	foreach ($citys as $key => $cat) {

		$citys_args[] = array(

			'taxonomy' => 'city',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $citys_args);
}

//Country

if (!empty($countries[0]) && is_array($countries)) {

	$query_relation = array('relation' => 'OR',);

	$countries_args  = array();



	foreach ($countries as $key => $cat) {

		$countries_args[] = array(

			'taxonomy' => 'country',

			'field'    => 'slug',

			'terms'    => $cat,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $countries_args);
}


//skills

if (!empty($skills[0]) && is_array($skills)) {

	$query_relation = array('relation' => 'OR',);

	$skills_args  = array();



	foreach ($skills as $key => $skill) {

		$skills_args[] = array(

			'taxonomy' => 'skills',

			'field'    => 'slug',

			'terms'    => $skill,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $skills_args);
}



//specialization

if (!empty($specialization[0]) && is_array($specialization)) {

	$query_relation = array('relation' => 'OR',);

	$specialization_args  = array();



	foreach ($specialization as $key => $skill) {

		$specialization_args[] = array(

			'taxonomy' => 'wt-specialization',

			'field'    => 'slug',

			'terms'    => $skill,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $specialization_args);
}



//industrial_experience

if (!empty($industrial_experience[0]) && is_array($industrial_experience)) {

	$query_relation = array('relation' => 'OR',);

	$industrial_experience_args  = array();



	foreach ($industrial_experience as $key => $skill) {

		$industrial_experience_args[] = array(

			'taxonomy' => 'wt-industrial-experience',

			'field'    => 'slug',

			'terms'    => $skill,

		);
	}



	$tax_query_args[] = array_merge($query_relation, $industrial_experience_args);
}

//Freelancer type 

if (!empty($freelancertype) && $freelancertype === 'enable' && !empty($type)) {

	$optin_select	= 'multiselect';

	if (!empty($type) && !empty($type[0]) && is_array($type)) {



		$query_relation = array('relation' => 'OR',);

		$sub_types_args = array();

		foreach ($type as $key => $value) {

			$sub_types_args[] = array(

				'key' 		=> '_freelancer_type',

				'value' 	=> strval($value),

				'compare' 	=> 'LIKE'

			);
		}

		$meta_query_args[] = array_merge($query_relation, $sub_types_args);
	}
} else if (!empty($type)) {

	foreach ($type as $key => $item) {

		$meta_query_args[] = array(

			'key' 		=> '_freelancer_type',

			'value' 	=> strval($item),

			'compare' 	=> 'LIKE'

		);
	}
}



//English Level

if (!empty($english_level)) {

	$meta_query_args[] = array(

		'key' 			=> '_english_level',

		'value' 		=> $english_level,

		'compare' 		=> 'IN'

	);
}



//Hourly Rate

if (!empty($hourly_rate)) {



	$price_range 		= array($hourly_rate_start, $hourly_rate_end);

	$price_args 		= array();



	if (!empty($freelancer_price_option) && $freelancer_price_option === 'enable') {

		$query_relation = array('relation' => 'OR',);

		$price_args[]  = array(

			'key' 			=> '_perhour_rate',

			'value' 		=> $price_range,

			'type'    		=> 'NUMERIC',

			'compare' 		=> 'BETWEEN'

		);



		$price_args[] = array(

			'key'     => '_max_price',

			'value'   => $price_range,

			'type'    => 'NUMERIC',

			'compare' => 'BETWEEN',

		);

		$meta_query_args[] = array_merge($query_relation, $price_args);
	} else {

		$meta_query_args[]  = array(

			'key' 			=> '_perhour_rate',

			'value' 		=> $price_range,

			'type'    		=> 'NUMERIC',

			'compare' 		=> 'BETWEEN'

		);
	}
}



//Profile strength

if (!empty($hide_profiles['gadget']) && $hide_profiles['gadget'] === 'yes') {

	if (!empty($hide_profiles['yes']['define_percentage'])) {

		$meta_query_args[] = array(

			'key' 			=> '_profile_health_filter',

			'value' 		=> intval($hide_profiles['yes']['define_percentage']),

			'compare' 		=> '>=',

			'type'			=> 'NUMERIC'

		);
	}
}



$meta_query_args[] = array(

	'key' 			=> '_profile_blocked',

	'value' 		=> 'off',

	'compare' 		=> '='

);



$meta_query_args[] = array(

	'key' 			=> '_is_verified',

	'value' 		=> 'yes',

	'compare' 		=> '='

);



$query_args = array(

	'posts_per_page' 	  => $show_posts,

	'post_type' 	 	  => 'freelancers',

	'paged' 		 	  => $paged,

	'post_status' 	 	  => 'publish',

	'ignore_sticky_posts' => 1

);





//order by pro member

$query_args['meta_key'] = '_featured_timestamp';



//keyword search

if (!empty($keyword)) {

	add_filter('posts_where', 'workreap_advance_search_where_freelancers');

	add_filter('posts_join', 'workreap_advance_search_join');

	add_filter('posts_groupby', 'workreap_advance_search_groupby');
}



//order by pro member

if (!empty($sortby)) {

	$query_args['orderby']['title']	 = $sortby;
}





// defult order

if (empty($sortby) && empty($rating) && empty($invited)) {

	$query_args['orderby']['meta_value']	 = 'DESC';

	$query_args['ID']['meta_value']	 		 = 'DESC';
}



// order by rating

if (!empty($rating)) {



	$query_relation = array('relation' => 'OR',);

	$rating_args['rating_filter_case']  = array(

		'key' 		=> 'rating_filter',

		'compare' 	=> 'EXISTS',

	);

	$meta_query_args[] = array_merge($query_relation, $rating_args);

	$query_args['orderby']['meta_value']	 		 = 'DESC';

	$query_args['orderby']['rating_filter_case']	 = $rating;
}



// order by invited

if (!empty($invited)) {

	$query_relation = array('relation' => 'OR',);

	$invited_args['invitation_case']  = array(

		'key' 		=> '_invitation_count',

		'compare' 	=> 'EXISTS',

	);

	$meta_query_args[] = array_merge($query_relation, $invited_args);

	$query_args['orderby']['invitation_case']	 	= $invited;

	$query_args['orderby']['meta_value']	 = 'DESC';
}



if (!empty($freelancer_avatar_search) && $freelancer_avatar_search === 'enable') {

	$meta_query_args[] = array(

		'key' 			=> '_have_avatar',

		'value' 		=> 1,

		'compare' 		=> '='

	);
}



//Taxonomy Query

if (!empty($tax_query_args)) {

	$query_relation = array('relation' => 'AND',);

	$query_args['tax_query'] = array_merge($query_relation, $tax_query_args);
}



//Meta Query

if (!empty($meta_query_args)) {

	$query_relation = array('relation' => 'AND',);

	$meta_query_args = array_merge($query_relation, $meta_query_args);

	$query_args['meta_query'] = $meta_query_args;
}



//search page URL

$action_url		= '#';

if (function_exists('workreap_get_search_page_uri')) {

	$action_url		= workreap_get_search_page_uri('freelancer');
}

?>

<?php if (have_posts() && is_page()) { ?>

	<div class="wt-haslayout wt-haslayout page-data">

		<?php

		while (have_posts()) : the_post();

			the_content();

			wp_link_pages(array(

				'before'      => '<div class="wt-paginationvtwo"><nav class="wt-pagination"><ul>',

				'after'       => '</ul></nav></div>',

			));

		endwhile;

		wp_reset_postdata();

		?>

	</div>

<?php } ?>

<div class="search-result-template wt-haslayout">

	<div class="wt-haslayout wt-freelancer-search wt-main-section">

		<div class="container">

			<div class="row">

				<div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">

					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">

						<aside id="wt-sidebar" class="wt-sidebar">

							<div class="mmobile-floating-apply">

								<span><?php esc_html_e('Apply Filters', 'workreap'); ?></span>

								<i class="fa fa-filter"></i>

							</div>

							<div class="floating-mobile-filter">

								<div class="wt-filter-scroll wt-collapse-filter">

									<a class="wt-mobile-close" href="#" onclick="event_preventDefault(event);"><i class="lnr lnr-cross"></i></a>

									<?php if (!empty($clearall)) {
										do_action('workreap_clear_all_filters');
									} ?>

									<form method="get" name="serach-projects" id="wt-search-form" class="search-freelancersformff" action="<?php echo esc_url($action_url); ?>">

										<h2 class="filter-byhead"><?php esc_html_e('Filter Artists by', 'workreap'); ?></h2>



										<?php do_action('workreap_keyword_search', 'dnone-search-filter'); ?>

										<?php if (!empty($frc_remove_freelancer_type) && $frc_remove_freelancer_type === 'no') {
											if (apply_filters('workreap_filter_settings', 'freelancer', 'type') === 'enable') {
												do_action('workreap_print_project_freelancer_type', esc_html__('Freelancer type', 'workreap'));
											}
										} ?>

										<?php if (apply_filters('workreap_filter_settings', 'freelancer', 'rate') === 'enable') {
											do_action('workreap_print_hourly_rate');
										} ?>

										<?php if (apply_filters('workreap_filter_settings', 'freelancer', 'industrial_exprience') === 'enable') {
											do_action('workreap_print_freelancer_industrial_exprience');
										} ?>

										<?php if (apply_filters('workreap_filter_settings', 'freelancer', 'specializations') === 'enable') {
											do_action('workreap_print_freelancer_specialization');
										} ?>

										<?php if (apply_filters('workreap_filter_settings', 'freelancer', 'skills') === 'enable') {
											do_action('workreap_filter_skills');
										} ?>

										<?php if (!empty($frc_english_level) && $frc_english_level === 'no') {
											if (apply_filters('workreap_filter_settings', 'freelancer', 'english') === 'enable') {
												do_action('workreap_print_freelancer_english_level');
											}
										} ?>

										<?php if (apply_filters('workreap_filter_settings', 'freelancer', 'locations') === 'enable') {
											do_action('workreap_print_locations');
										} ?>

										<?php if (!empty($frc_remove_languages) && $frc_remove_languages === 'no') {
											if (apply_filters('workreap_filter_settings', 'freelancer', 'languages') === 'enable') {
												do_action('workreap_print_languages');
											}
										} ?>

										<?php do_action('workreap_add_custom_filters_freelancers'); ?>

										<div class="wt-widget wt-effectiveholder">

											<div class="wt-widgetcontent">

												<div class="wt-applyfilters">

													<span><?php esc_html_e('Click “Apply Filter” to apply latest changes made by you.', 'workreap'); ?></span>

													<input type="submit" class="wt-btn" value="<?php esc_attr_e('Apply Filters', 'workreap'); ?>">

												</div>

											</div>

											<input type="hidden" name="sortby" class="wt-order-freelancer" value="<?php echo esc_attr($sortby); ?>">

											<input type="hidden" name="rating" class="wt-order-rating" value="<?php echo esc_attr($rating); ?>">

										</div>

									</form>

								</div>

							</div>

						</aside>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">

						<div class="wt-userlistingholder wt-userlisting wt-haslayout">

							<!-- <ul class="wt-filterholder-three wt-filtertag">

								<?php //do_action('workreap_freelancer_sort_title', $sortby); ?>

								<?php //do_action('workreap_freelancer_sort_rating', $rating); ?>

								<?php //do_action('workreap_freelancer_short_invite', $invited); ?>

							</ul> -->

							<?php

							$freelancer_data = new WP_Query($query_args);

							$total_posts  = $freelancer_data->found_posts;

							if ($freelancer_data->have_posts()) {

								while ($freelancer_data->have_posts()) {

									$freelancer_data->the_post();

									global $post;

									$linked_profile 		= $post->ID;

									$author_id 				= workreap_get_linked_profile_id($linked_profile, 'post');

									$freelancer_title 		= workreap_get_username('', $linked_profile);



									$tagline				= workreap_get_tagline($linked_profile);



									$freelancer_avatar = apply_filters(

										'workreap_freelancer_avatar_fallback',
										workreap_get_freelancer_avatar(array('width' => 150, 'height' => 150), $post->ID),
										array('width' => 150, 'height' => 150)

									);



									$class	= apply_filters('workreap_featured_freelancer_tag', $author_id, 'yes');

									$class	= !empty($class) ? $class : '';

							?>

									<div class="wt-userlistinghold <?php echo esc_attr($class); ?> toolip-wrapo">

										<?php do_action('workreap_featured_freelancer_tag', $author_id); ?>

										<figure class="wt-userlistingimg">

											<a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($freelancer_avatar); ?>" alt="<?php echo esc_attr($tagline); ?>"></a>

											<?php echo do_action('workreap_print_user_status', $author_id); ?>

											<?php do_action('workreap_profile_strength_html', $post->ID, true); ?>

										</figure>

										<div class="wt-userlistingcontent">

											<div class="wt-contenthead">

												<div class="wt-title">

													<?php do_action('workreap_get_verification_check', $linked_profile, $freelancer_title); ?>

													<h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo workreap_get_tagline($linked_profile); ?></a></h2>

												</div>
											
											</div>
										</div>
										<!-- Custom Code for show Resuls on Search -->
										<!-- <div class="custom-div-for-search-result"> -->
										<?php 
										/* foreach($_GET['school'] as $show_result_school){
											echo '<b>School Name:</b><div class="show-result-search-page">'.$show_result_school.'</div>';
										}
										foreach($_GET['artist_type'] as $show_result_artist_type){
											echo '<b>Artist Type:</b><div class="show-result-search-page">'.$show_result_artist_type.'</div>';
										}
										foreach($_GET['music_genre'] as $show_result_music_genre){
											echo '<b>Music Genre:</b><div class="show-result-search-page">'.$show_result_music_genre.'</div>';
										}
										foreach($_GET['number_of_members'] as $show_result_number_of_members){
											echo '<b>Number Of Members:</b><div class="show-result-search-page">'.$show_result_number_of_members.'</div>';
										}
										foreach($_GET['instruments_associated_with_act'] as $show_result_instruments_associated_with_act){
											echo '<b>Instruments Associated With Act:</b><div class="show-result-search-page">'.$show_result_instruments_associated_with_act.'</div>';
										}
										foreach($_GET['age_range'] as $show_result_age_range){
											echo '<b>Age Range:</b><div class="show-result-search-page">'.$show_result_age_range.'</div>';
										}
										foreach($_GET['years_performing'] as $show_result_years_performing){
											echo '<b>Years Performing:</b><div class="show-result-search-page">'.$show_result_years_performing.'</div>';
										}
										foreach($_GET['next_gig'] as $show_result_next_gig){
											echo '<b>Next Gig:</b><div class="show-result-search-page">'.$show_result_next_gig.'</div>';
										}
										foreach($_GET['city'] as $show_result_city){
											echo '<b>City:</b><div class="show-result-search-page">'.$show_result_city.'</div>';
										}
										foreach($_GET['representation'] as $show_result_representation){
											echo '<b>Representation:</b><div class="show-result-search-page">'.$show_result_representation.'</div>';
										} */
										  ?>
										<!-- </div> -->

										<div class="wt-description">

											<p><?php echo wp_trim_words(do_shortcode(get_the_excerpt()), 25); ?></p>

										</div>
										<div class="custom-div-for-search-result" style="width: 100%;">
										<div class="all-filters-view-hwe" style="font-size: 14px;width: 100%;">
								<div class="row">
										<div class="col">	
									<?php 
									$post_id 		= $post->ID;
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
										
										<?php do_action('workreap_print_freelancer_skills', $post->ID, '', 6); ?>
										
											<!-- End -->
										<a class="wt-btn view-profile-btn" style="float: right;" href="<?php echo esc_url(get_the_permalink()); ?>">View Profile</a>

									</div>

								<?php }
								wp_reset_postdata(); ?>

								<?php } else {

								do_action('workreap_empty_records_html', 'wt-empty-person', esc_html__('No Artist found.', 'workreap'));
							}



							if (
								!empty($freelancers_search_restrict['gadget'])

								&& $freelancers_search_restrict['gadget'] == 'disable'

								&& !empty($freelancers_search_restrict['disable']['search_numbers'])

								&& !is_user_logged_in()
							) {

								do_action('workreap_signup_popup_search_results', $freelancers_search_restrict['disable']);
							} else {

								if (!empty($total_posts) && $total_posts > $show_posts) { ?>

									<?php workreap_prepare_pagination($total_posts, $show_posts); ?>

								<?php } ?>

							<?php } ?>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
<?php
get_footer();
