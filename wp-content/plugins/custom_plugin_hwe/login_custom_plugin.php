<?php

/* 
    * Plugin Name: Filter Plugin CnEL India
    * Plugin URI: http://cnelindia.com/
    * Description: This is the Custom Plugin.
    * Version: 1.0
    * Author: Bhanu
    * Author URI: http://cnelindia.com/
*/


/////////////////School////////////////////
function njengah_custom_taxonomy_Item_school()  
{
    $labels = array(
        'name'                       => 'School',
        'singular_name'              => 'School',
        'menu_name'                  => 'School',
        'all_items'                  => 'All School',
        'parent_item'                => 'Parent School',
        'parent_item_colon'          => 'Parent School:',
        'new_item_name'              => 'New School Name',
        'add_new_item'               => 'Add School Type',
        'edit_item'                  => 'Edit School',
        'update_item'                => 'Update School',
        'separate_items_with_commas' => 'Separate School with commas',
        'search_items'               => 'Search School',
        'add_or_remove_items'        => 'Add or remove School',
        'choose_from_most_used'      => 'Choose from the most used School',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'school', 'freelancers', $args );
    /*  $terms = get_terms( $args );
    print_r($terms); */ 
}
add_action( 'init', 'njengah_custom_taxonomy_Item_school', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_school' ) )
{
    function workreap_add_custom_filters_freelancers_school(){
		global $wp_query;
		if (is_tax('school')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$school_list = array($sub_cat->slug);
			}
		} else {
			$school_list = !empty( $_GET['school']) ? $_GET['school'] : array();
		}

		$count = !empty($school_list) && is_array($school_list) ? count($school_list) : 0;

		$school= get_terms( 
			array(
				'taxonomy' 		=> 'school',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $school ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('School', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search School', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'school',
										'hide_empty' 		=> false,
										'current_category'	=> $school_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_school,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_school', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_school_list' ) ) {
	function workreap_get_project_school_list($name='school',$selected=''){
		$taxonomy_type	= 'school';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-school-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'school',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_school_list', 'workreap_get_project_school_list', 10,2);
}

///add custom texnomy Artist Type
function njengah_custom_taxonomy_Item_artist_type()  
{
    $labels = array(
        'name'                       => 'Artist Type',
        'singular_name'              => 'Artist Type',
        'menu_name'                  => 'Artist Type',
        'all_items'                  => 'All Artist Type',
        'parent_item'                => 'Parent Artist Type',
        'parent_item_colon'          => 'Parent Artist Type:',
        'new_item_name'              => 'New Artist Type Name',
        'add_new_item'               => 'Add New Artist Type',
        'edit_item'                  => 'Edit Artist Type',
        'update_item'                => 'Update Artist Type',
        'separate_items_with_commas' => 'Separate Artist Type with commas',
        'search_items'               => 'Search Artist Type',
        'add_or_remove_items'        => 'Add or remove Artist Type',
        'choose_from_most_used'      => 'Choose from the most used Artist Type',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'artist_type', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_artist_type', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_artist_type' ) )
{
    function workreap_add_custom_filters_freelancers_artist_type(){
		global $wp_query;
		if (is_tax('artist_type')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$artist_type_list = array($sub_cat->slug);
			}
		} else {
			$artist_type_list = !empty( $_GET['artist_type']) ? $_GET['artist_type'] : array();
		}

		$count = !empty($artist_type_list) && is_array($artist_type_list) ? count($artist_type_list) : 0;

		$artist_type = get_terms( 
			array(
				'taxonomy' 		=> 'artist_type',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $artist_type ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Artist Type', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Artist Type', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'artist_type',
										'hide_empty' 		=> false,
										'current_category'	=> $artist_type_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_artist_type,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_artist_type', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_artist_type_list' ) ) {
	function workreap_get_project_artist_type_list($name='artist_type',$selected=''){
               
		$taxonomy_type	= 'artist_type';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-artist_type-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'artist_type',
								'id'                => 'project_cat_select',
								'selected' 			=>  $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_artist_type_list', 'workreap_get_project_artist_type_list', 10,2);
}
/////////////////////////Music Genre///////////////////////////////////////
///add custom texnomy Music Genre
function njengah_custom_taxonomy_Item_music_genre()  
{
    $labels = array(
        'name'                       => 'Music Genre',
        'singular_name'              => 'Music Genre',
        'menu_name'                  => 'Music Genre',
        'all_items'                  => 'All Music Genre',
        'parent_item'                => 'Parent Music Genre',
        'parent_item_colon'          => 'Parent Music Genre:',
        'new_item_name'              => 'New Music Genre Name',
        'add_new_item'               => 'Add Music Genre Type',
        'edit_item'                  => 'Edit Music Genre',
        'update_item'                => 'Update Music Genre',
        'separate_items_with_commas' => 'Separate Music Genre with commas',
        'search_items'               => 'Search Music Genre',
        'add_or_remove_items'        => 'Add or remove Music Genre',
        'choose_from_most_used'      => 'Choose from the most used Music Genre',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'music_genre', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_music_genre', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_music_genre' ) )
{
    function workreap_add_custom_filters_freelancers_music_genre(){
		global $wp_query;
		if (is_tax('music_genre')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$music_genre_list = array($sub_cat->slug);
			}
		} else {
			$music_genre_list = !empty( $_GET['music_genre']) ? $_GET['music_genre'] : array();
		}

		$count = !empty($music_genre_list) && is_array($music_genre_list) ? count($music_genre_list) : 0;

		$music_genre = get_terms( 
			array(
				'taxonomy' 		=> 'music_genre',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $music_genre ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Music Genre', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Music Genre', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'music_genre',
										'hide_empty' 		=> false,
										'current_category'	=> $music_genre_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_music_genre,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_music_genre', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_music_genre_list' ) ) {
	function workreap_get_project_music_genre_list($name='music_genre',$selected=''){
		$taxonomy_type	= 'music_genre';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-music_genre-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'music_genre',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_music_genre_list', 'workreap_get_project_music_genre_list', 10,2);
}

//////////////////////Number of Members////////////////////
///add custom texnomy Number of Members
function njengah_custom_taxonomy_Item_number_of_members()  
{
    $labels = array(
        'name'                       => 'Number of Members',
        'singular_name'              => 'Number of Members',
        'menu_name'                  => 'Number of Members',
        'all_items'                  => 'All Number of Members',
        'parent_item'                => 'Parent Number of Members',
        'parent_item_colon'          => 'Parent Number of Members:',
        'new_item_name'              => 'New Number of Members Name',
        'add_new_item'               => 'Add Number of Members Type',
        'edit_item'                  => 'Edit Number of Members',
        'update_item'                => 'Update Number of Members',
        'separate_items_with_commas' => 'Separate Number of Members with commas',
        'search_items'               => 'Search Number of Members',
        'add_or_remove_items'        => 'Add or remove Number of Members',
        'choose_from_most_used'      => 'Choose from the most used Number of Members',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'number_of_members', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_number_of_members', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_number_of_members' ) )
{
    function workreap_add_custom_filters_freelancers_number_of_members(){
		global $wp_query;
		if (is_tax('number_of_members')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$number_of_members_list = array($sub_cat->slug);
			}
		} else {
			$number_of_members_list = !empty( $_GET['number_of_members']) ? $_GET['number_of_members'] : array();
		}

		$count = !empty($number_of_members_list) && is_array($number_of_members_list) ? count($number_of_members_list) : 0;

		$number_of_members = get_terms( 
			array(
				'taxonomy' 		=> 'number_of_members',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $number_of_members ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Number of Members', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Number of Members', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'number_of_members',
										'hide_empty' 		=> false,
										'current_category'	=> $number_of_members,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_number_of_members,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_number_of_members', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_number_of_members_list' ) ) {
	function workreap_get_project_number_of_members_list($name='number_of_members',$selected=''){
		$taxonomy_type	= 'number_of_members';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-number_of_members-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'number_of_members',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_number_of_members_list', 'workreap_get_project_number_of_members_list', 10,2);
}
/////////////////////////Instruments Associated with Act///////////////////////////////////////
///add custom texnomy Instruments Associated with Act
function njengah_custom_taxonomy_Item_instruments_associated_with_act()  
{
    $labels = array(
        'name'                       => 'Instruments Associated with Act',
        'singular_name'              => 'Instruments Associated with Act',
        'menu_name'                  => 'Instruments Associated with Act',
        'all_items'                  => 'All Instruments Associated with Act',
        'parent_item'                => 'Parent Instruments Associated with Act',
        'parent_item_colon'          => 'Parent Instruments Associated with Act:',
        'new_item_name'              => 'New Instruments Associated with Act Name',
        'add_new_item'               => 'Add Instruments Associated with Act Type',
        'edit_item'                  => 'Edit Instruments Associated with Act',
        'update_item'                => 'Update Instruments Associated with Act',
        'separate_items_with_commas' => 'Separate Instruments Associated with Act with commas',
        'search_items'               => 'Search Instruments Associated with Act',
        'add_or_remove_items'        => 'Add or remove Instruments Associated with Act',
        'choose_from_most_used'      => 'Choose from the most used Instruments Associated with Act',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'instruments_associated_with_act', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_instruments_associated_with_act', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_instruments_associated_with_act' ) )
{
    function workreap_add_custom_filters_freelancers_instruments_associated_with_act(){
		global $wp_query;
		if (is_tax('instruments_associated_with_act')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$instruments_associated_with_act_list = array($sub_cat->slug);
			}
		} else {
			$instruments_associated_with_act_list = !empty( $_GET['instruments_associated_with_act']) ? $_GET['instruments_associated_with_act'] : array();
		}

		$count = !empty($instruments_associated_with_act_list) && is_array($instruments_associated_with_act_list) ? count($instruments_associated_with_act_list) : 0;

		$instruments_associated_with_act = get_terms( 
			array(
				'taxonomy' 		=> 'instruments_associated_with_act',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $instruments_associated_with_act ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Instruments Associated with Act', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Instruments Associated with Act', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'instruments_associated_with_act',
										'hide_empty' 		=> false,
										'current_category'	=> $instruments_associated_with_act_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_instruments_associated_with_act,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_instruments_associated_with_act', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_instruments_associated_with_act_list' ) ) {
	function workreap_get_project_instruments_associated_with_act_list($name='instruments_associated_with_act',$selected=''){
		$taxonomy_type	= 'instruments_associated_with_act';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-instruments_associated_with_act-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=>'instruments_associated_with_act',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_instruments_associated_with_act_list', 'workreap_get_project_instruments_associated_with_act_list', 10,2);
}
/////////////////////////Age Range///////////////////////////////////////
///add custom texnomy Age Range
function njengah_custom_taxonomy_Item_age_range()  
{
    $labels = array(
        'name'                       => 'Age Range',
        'singular_name'              => 'Age Range',
        'menu_name'                  => 'Age Range',
        'all_items'                  => 'All Age Range',
        'parent_item'                => 'Parent Age Range',
        'parent_item_colon'          => 'Parent Age Range:',
        'new_item_name'              => 'New Age Range Name',
        'add_new_item'               => 'Add Age Range Type',
        'edit_item'                  => 'Edit Age Range',
        'update_item'                => 'Update Age Range',
        'separate_items_with_commas' => 'Separate Age Range with commas',
        'search_items'               => 'Search Age Range',
        'add_or_remove_items'        => 'Add or remove Age Range',
        'choose_from_most_used'      => 'Choose from the most used Age Range',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'age_range', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_age_range', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_age_range' ) )
{
    function workreap_add_custom_filters_freelancers_age_range(){
		global $wp_query;
		if (is_tax('age_range')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$age_range_list = array($sub_cat->slug);
			}
		} else {
			$age_range_list = !empty( $_GET['age_range']) ? $_GET['age_range'] : array();
		}

		$count = !empty($age_range_list) && is_array($age_range_list) ? count($age_range_list) : 0;

		$age_range = get_terms( 
			array(
				'taxonomy' 		=> 'age_range',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $age_range ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Age Range', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Age Range', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'age_range',
										'hide_empty' 		=> false,
										'current_category'	=> $age_range_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_age_range,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_age_range', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_age_range_list' ) ) {
	function workreap_get_project_age_range_list($name='age_range',$selected=''){
		$taxonomy_type	= 'age_range';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-age_range-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=>'age_range',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_age_range_list', 'workreap_get_project_age_range_list', 10,2);
}
/////////////////Years Performing////////////////////
function njengah_custom_taxonomy_Item_years_performing()  
{
    $labels = array(
        'name'                       => 'Years Performing',
        'singular_name'              => 'Years Performing',
        'menu_name'                  => 'Years Performing',
        'all_items'                  => 'All Years Performing',
        'parent_item'                => 'Parent Years Performing',
        'parent_item_colon'          => 'Parent Years Performing:',
        'new_item_name'              => 'New Years Performing Name',
        'add_new_item'               => 'Add Years Performing Type',
        'edit_item'                  => 'Edit Years Performing',
        'update_item'                => 'Update Years Performing',
        'separate_items_with_commas' => 'Separate Years Performing with commas',
        'search_items'               => 'Search Years Performing',
        'add_or_remove_items'        => 'Add or remove Years Performing',
        'choose_from_most_used'      => 'Choose from the most used Years Performing',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'years_performing', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_years_performing', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_years_performing' ) )
{
    function workreap_add_custom_filters_freelancers_years_performing(){
		global $wp_query;
		if (is_tax('years_performing')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$years_performing_list = array($sub_cat->slug);
			}
		} else {
			$years_performing_list = !empty( $_GET['years_performing']) ? $_GET['years_performing'] : array();
		}

		$count = !empty($years_performing_list) && is_array($years_performing_list) ? count($years_performing_list) : 0;

		$years_performing = get_terms( 
			array(
				'taxonomy' 		=> 'years_performing',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $years_performing ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Years Performing', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Years Performing', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'years_performing',
										'hide_empty' 		=> false,
										'current_category'	=> $years_performing_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_years_performing,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_years_performing', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_years_performing_list' ) ) {
	function workreap_get_project_years_performing_list($name='years_performing',$selected=''){
		$taxonomy_type	= 'years_performing';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-years_performing-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'years_performing',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_years_performing_list', 'workreap_get_project_years_performing_list', 10,2);
}

/////////////////Next Gig////////////////////
function njengah_custom_taxonomy_Item_next_gig()  
{
    $labels = array(
        'name'                       => 'Next Gig',
        'singular_name'              => 'Next Gig',
        'menu_name'                  => 'Next Gig',
        'all_items'                  => 'All Next Gig',
        'parent_item'                => 'Parent Next Gig',
        'parent_item_colon'          => 'Parent Next Gig:',
        'new_item_name'              => 'New Next Gig Name',
        'add_new_item'               => 'Add Next Gig Type',
        'edit_item'                  => 'Edit Next Gig',
        'update_item'                => 'Update Next Gig',
        'separate_items_with_commas' => 'Separate Next Gig with commas',
        'search_items'               => 'Search Next Gig',
        'add_or_remove_items'        => 'Add or remove Next Gig',
        'choose_from_most_used'      => 'Choose from the most used Next Gig',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'next_gig', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_next_gig', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_next_gig' ) )
{
    function workreap_add_custom_filters_freelancers_next_gig(){
		global $wp_query;
		if (is_tax('next_gig')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$next_gig_list = array($sub_cat->slug);
			}
		} else {
			$next_gig_list = !empty( $_GET['next_gig']) ? $_GET['next_gig'] : array();
		}

		$count = !empty($next_gig_list) && is_array($next_gig_list) ? count($next_gig_list) : 0;

		$next_gig = get_terms( 
			array(
				'taxonomy' 		=> 'next_gig',
				'hide_empty' 	=> false,
                'order'         => 'DESC',
			) 
		);
		//print_r($next_gig);
        
		if( !empty( $next_gig ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Next Gig', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <!-- <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Next Gig', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'next_gig',
										'hide_empty' 		=> false,
                                        'orderby'       => 'id',
                                        'order'         => 'ASC',
										'current_category'	=> $next_gig_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_next_gig,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_next_gig', 10);
}




/**
 * Get artist_type list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_next_gig_list' ) ) {
	function workreap_get_project_next_gig_list($name='next_gig',$selected=''){
		$taxonomy_type	= 'next_gig';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-next_gig-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'next_gig',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_next_gig_list', 'workreap_get_project_next_gig_list', 10,2);
}

function njengah_custom_taxonomy_Item_country()  
{
    $labels = array(
        'name'                       => 'Country',
        'singular_name'              => 'Country',
        'menu_name'                  => 'Country',
        'all_items'                  => 'All Country',
        'parent_item'                => 'Parent Country',
        'parent_item_colon'          => 'Parent Country:',
        'new_item_name'              => 'New Country Name',
        'add_new_item'               => 'Add Country Type',
        'edit_item'                  => 'Edit Country',
        'update_item'                => 'Update Country',
        'separate_items_with_commas' => 'Separate Country with commas',
        'search_items'               => 'Search Country',
        'add_or_remove_items'        => 'Add or remove Country',
        'choose_from_most_used'      => 'Choose from the most used Country',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'country', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_country', 0 );


if( !function_exists( 'workreap_add_custom_filters_freelancers_country' ) )
{
    function workreap_add_custom_filters_freelancers_country(){
		global $wp_query;
		if (is_tax('country')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$country_list = array($sub_cat->slug);
			}
		} else {
			$country_list = !empty( $_GET['country']) ? $_GET['country'] : array();
		}

		$count = !empty($country_list) && is_array($country_list) ? count($country_list) : 0;

		$country = get_terms( 
			array(
				'taxonomy' 		=> 'country',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $country ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Country', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                   <!--  <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Country', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'country',
										'hide_empty' 		=> false,
										'current_category'	=> $country_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_country,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_country', 10);
}




/**
 * Get city list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_country_list' ) ) {
	function workreap_get_project_country_list($name='country',$selected=''){
		$taxonomy_type	= 'country';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-country-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'country',
								'id'                => 'project_country_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_country_list', 'workreap_get_project_country_list', 10,2);
}

/////////////////City////////////////////
function njengah_custom_taxonomy_Item_city()  
{
    $labels = array(
        'name'                       => 'City',
        'singular_name'              => 'City',
        'menu_name'                  => 'City',
        'all_items'                  => 'All City',
        'parent_item'                => 'Parent City',
        'parent_item_colon'          => 'Parent City:',
        'new_item_name'              => 'New City Name',
        'add_new_item'               => 'Add City Type',
        'edit_item'                  => 'Edit City',
        'update_item'                => 'Update City',
        'separate_items_with_commas' => 'Separate City with commas',
        'search_items'               => 'Search City',
        'add_or_remove_items'        => 'Add or remove City',
        'choose_from_most_used'      => 'Choose from the most used City',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'city', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_city', 0 );

/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_city' ) )
{
    function workreap_add_custom_filters_freelancers_city(){
		global $wp_query;
		if (is_tax('city')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$city_list = array($sub_cat->slug);
			}
		} else {
			$city_list = !empty( $_GET['city']) ? $_GET['city'] : array();
		}

		$count = !empty($city_list) && is_array($city_list) ? count($city_list) : 0;

		$city = get_terms( 
			array(
				'taxonomy' 		=> 'city',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $city ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('City', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                   <!--  <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search City', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'city',
										'hide_empty' 		=> false,
										'current_category'	=> $city_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_city,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_city', 10);
}




/**
 * Get city list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_city_list' ) ) {
	function workreap_get_project_city_list($name='city',$selected=''){
		$taxonomy_type	= 'city';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-city-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'city',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_city_list', 'workreap_get_project_city_list', 10,2);
}
/////////////////Representation////////////////////
function njengah_custom_taxonomy_Item_representation()  
{
    $labels = array(
        'name'                       => 'Representation',
        'singular_name'              => 'Representation',
        'menu_name'                  => 'Representation',
        'all_items'                  => 'All Representation',
        'parent_item'                => 'Parent Representation',
        'parent_item_colon'          => 'Parent Representation:',
        'new_item_name'              => 'New Representation Name',
        'add_new_item'               => 'Add Representation Type',
        'edit_item'                  => 'Edit Representation',
        'update_item'                => 'Update Representation',
        'separate_items_with_commas' => 'Separate Representation with commas',
        'search_items'               => 'Search Representation',
        'add_or_remove_items'        => 'Add or remove Representation',
        'choose_from_most_used'      => 'Choose from the most used Representation',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'representation', 'freelancers', $args );
}
add_action( 'init', 'njengah_custom_taxonomy_Item_representation', 0 );


/**
 * Print categories html
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_add_custom_filters_freelancers_representation' ) )
{
    function workreap_add_custom_filters_freelancers_representation(){
		global $wp_query;
		if (is_tax('representation')) {
			$sub_cat = $wp_query->get_queried_object();
			if (!empty($sub_cat->slug)) {
				$representation_list = array($sub_cat->slug);
			}
		} else {
			$representation_list = !empty( $_GET['representation']) ? $_GET['representation'] : array(); 
		}

		$count = !empty($representation_list) && is_array($representation_list) ? count($representation_list) : 0;

		$representation = get_terms( 
			array(
				'taxonomy' 		=> 'representation',
				'hide_empty' 	=> false,
			) 
		);
		
		if( !empty( $representation ) ){
		ob_start(); 
        ?>
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php esc_html_e('Representation', 'workreap'); ?>:<span>( <em><?php echo esc_html($count); ?></em> <?php esc_html_e('selected', 'workreap'); ?> )</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                   <!--  <fieldset>
                        <div class="form-group">
                            <input type="text" value="" class="form-control wt-filter-field" placeholder="<?php esc_attr_e('Search Representation', 'workreap'); ?>">
                            <a href="#" onclick="event_preventDefault(event);" class="wt-searchgbtn"><i class="fa fa-search"></i></a>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <div class="wt-checkboxholder wt-filterscroll">    
                           <?php 
								wp_list_categories( array(
										'taxonomy' 			=> 'representation',
										'hide_empty' 		=> false,
										'current_category'	=> $representation_list,
										'style' 			=> '',
										'walker' 			=> new Workreap_Walker_Category_representation,
									)
								);
                            ?>          
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();   
        }     
    }
    add_action('workreap_add_custom_filters_freelancers', 'workreap_add_custom_filters_freelancers_representation', 10);
}




/**
 * Get representation list
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
if( !function_exists( 'workreap_get_project_representation_list' ) ) {
	function workreap_get_project_representation_list($name='representation',$selected=''){
		$taxonomy_type	= 'representation';
		
		wp_dropdown_categories( array(
								'taxonomy' 			=> $taxonomy_type,
								'hide_empty' 		=> false,
								'hierarchical' 		=> 1,
								'walker' 			=> new Workreap_Walker_Category_Dropdown,
								'class' 			=> 'item-representation-dp chosen-select',
								'orderby' 			=> 'name',
								'name' 				=> 'representation',
								'id'                => 'project_cat_select',
								'selected' 			=> $selected,
								'required' 			=> 'required',
							)
						);
	}
	add_action('workreap_get_project_representation_list', 'workreap_get_project_representation_list', 10,2);
}
?>
