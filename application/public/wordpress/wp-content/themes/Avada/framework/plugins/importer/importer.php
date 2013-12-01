<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
// ThemeFusion Demo Data Importer

// Hook importer into admin init
add_action( 'admin_init', 'fusion_importer' );
function fusion_importer() {
	global $wpdb;

	if ( current_user_can( 'manage_options' ) && isset( $_GET['import_data_content'] ) ) {
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

		if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
			$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			include $wp_importer;
		}

		if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
			$wp_import = get_template_directory() . '/framework/plugins/importer/wordpress-importer.php';
			include $wp_import;
		}

		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class

			$importer = new WP_Import();

			/* First Import Posts, Pages, Portfolio Content, FAQ, Images, Menus */
			$theme_xml = get_template_directory() . '/framework/plugins/importer/data/avada.xml.gz';
			$importer->fetch_attachments = true;
			ob_start();
			$importer->import($theme_xml);
			ob_end_clean();

			/* Import Woocommerce if WooCommerce Exists */
			if( class_exists('Woocommerce') ) {
				$importer = new WP_Import();
				$theme_xml = get_template_directory() . '/framework/plugins/importer/data/wooproducts.xml.gz';
				$importer->fetch_attachments = true;
				ob_start();
				$importer->import($theme_xml);
				ob_end_clean();

				// Set pages
				$woopages = array(
					'woocommerce_shop_page_id' => 'Shop',
					'woocommerce_cart_page_id' => 'Cart',
					'woocommerce_checkout_page_id' => 'Checkout',
					'woocommerce_pay_page_id' => 'Checkout &#8594; Pay',
					'woocommerce_thanks_page_id' => 'Order Received',
					'woocommerce_myaccount_page_id' => 'My Account',
					'woocommerce_edit_address_page_id' => 'Edit My Address',
					'woocommerce_view_order_page_id' => 'View Order',
					'woocommerce_change_password_page_id' => 'Change Password',
					'woocommerce_logout_page_id' => 'Logout',
					'woocommerce_lost_password_page_id' => 'Lost Password'
				);
				foreach($woopages as $woo_page_name => $woo_page_title) {
					$woopage = get_page_by_title( $woo_page_title );
					if($woopage->ID) {
						update_option($woo_page_name, $woopage->ID); // Front Page
					}
				}

				// We no longer need to install pages
				delete_option( '_wc_needs_pages' );
				delete_transient( '_wc_activation_redirect' );

				// Flush rules after install
				flush_rewrite_rules();
			}

			// Set imported menus to registered theme locations
			$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
			$menus = wp_get_nav_menus(); // registered menus

			if($menus) {
				foreach($menus as $menu) { // assign menus to theme locations
					if( $menu->name == 'Main' ) {
						$locations['main_navigation'] = $menu->term_id;
					} else if( $menu->name == '404' ) {
						$locations['404_pages'] = $menu->term_id;
					} else if( $menu->name == 'Top' ) {
						$locations['top_navigation'] = $menu->term_id;
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations

			// Import Theme Options
			$theme_options_txt = get_template_directory_uri() . '/framework/plugins/importer/data/theme_options.txt'; // theme options data file
			$theme_options_txt = wp_remote_get( $theme_options_txt );
			$data = unserialize( base64_decode( $theme_options_txt['body'])  );
			update_option( OPTIONS, $data ); // update theme options

			// Add sidebar widget areas
			$sidebars = array(
				'ContactSidebar' => 'Contact Sidebar',
				'FAQ' => 'FAQ',
				'HomepageSidebar' => 'Home Page Sidebar',
				'Portfolio' => 'Portfolio'
			);
			update_option( 'sbg_sidebars', $sidebars );

			foreach( $sidebars as $sidebar ) {
				$sidebar_class = avada_name_to_class( $sidebar );
				register_sidebar(array(
					'name'=>$sidebar,
					'id' => 'avada-custom-sidebar-' . strtolower( $sidebar_class ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="heading"><h3>',
					'after_title' => '</h3></div>',
				));
			}

			// Add data to widgets
			$widgets_json = get_template_directory_uri() . '/framework/plugins/importer/data/widget_data.json'; // widgets data file
			$widgets_json = wp_remote_get( $widgets_json );
			$widget_data = $widgets_json['body'];
			$import_widgets = fusion_import_widget_data( $widget_data );

			// Import Layerslider
			if( function_exists( 'layerslider_import_sample_slider' ) ) { // if layerslider is activated
				$ls_txt = get_template_directory_uri() . '/framework/plugins/importer/data/layerslider.txt'; // layerslider data file
				$ls_txt = wp_remote_get( $ls_txt );
				$data = json_decode( base64_decode( $ls_txt['body'] ), true  );
				avada_import_sample_slider( $data ); // update theme options

				// Get all sliders
				// Table name
				$table_name = $wpdb->prefix . "layerslider";

				// Get sliders
				$sliders = $wpdb->get_results( "SELECT * FROM $table_name
													WHERE flag_hidden = '0' AND flag_deleted = '0'
													ORDER BY date_c ASC" );

				if(!empty($sliders)):
				foreach($sliders as $key => $item):
					$slides[$item->id] = $item->name;
				endforeach;
				endif;

				if($slides){
					foreach($slides as $key => $val){
						$slides_array[$val] = $key;
					}
				}

				// Assign LayerSlider
				$lspage = get_page_by_title( 'Layer Slider' );
				if($lspage->ID && $slides_array['Avada Full Width']) {
					update_post_meta($lspage->ID, 'pyre_slider', $slides_array['Avada Full Width']);
				}
			}

			// Import Revslider
			if( class_exists('UniteFunctionsRev') ) { // if revslider is activated
				$rev_directory = get_template_directory() . '/framework/plugins/importer/data/revsliders/'; // layerslider data dir

				foreach( glob( $rev_directory . '*.txt' ) as $filename ) { // get all files from revsliders data dir
					$filename = basename($filename);
					$rev_files[] = get_template_directory_uri() . '/framework/plugins/importer/data/revsliders/' . $filename ;
				}

				foreach( $rev_files as $rev_file ) { // finally import rev slider data files
					$get_file = wp_remote_get( $rev_file );
					$arrSlider = unserialize( $get_file['body'] );

					$sliderParams = $arrSlider["params"];

					if(isset($sliderParams["background_image"])) {
						$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath($sliderParams["background_image"]);
					}

					$json_params = json_encode($sliderParams);

					$arrInsert = array();
					$arrInsert["params"] = $json_params;
					$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
					$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");

					$wpdb->insert(GlobalsRevSlider::$table_sliders, $arrInsert);
					$sliderID = mysql_insert_id();

					//create all slides
					$arrSlides = $arrSlider["slides"];
					foreach($arrSlides as $slide){
						
						$params = $slide["params"];
						$layers = $slide["layers"];
						
						//convert params images:
						if(isset($params["image"])) {
							$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
						}
						
						//convert layers images:
						foreach($layers as $key=>$layer){					
							if(isset($layer["image_url"])){
								$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
								$layers[$key] = $layer;
							}
						}
						
						//create new slide
						$arrCreate = array();
						$arrCreate["slider_id"] = $sliderID;
						$arrCreate["slide_order"] = $slide["slide_order"];				
						$arrCreate["layers"] = json_encode($layers);
						$arrCreate["params"] = json_encode($params);

						$wpdb->insert(GlobalsRevSlider::$table_slides,$arrCreate);				
					}
				}
			}

			// Set reading options
			$homepage = get_page_by_title( 'Home Version 13' );
			$posts_page = get_page_by_title( 'Blog Large' );
			if($homepage->ID && $posts_page->ID) {
				update_option('show_on_front', 'page');
				update_option('page_on_front', $homepage->ID); // Front Page
				update_option('page_for_posts', $posts_page->ID); // Blog Page
			}

			// finally redirect to success page
			wp_redirect( admin_url( 'themes.php?page=optionsframework&imported=success#of-option-generaloptions' ) );
		}
	}
}

// Parsing Widgets Function
// Thanks to http://wordpress.org/plugins/widget-settings-importexport/
function fusion_import_widget_data( $widget_data ) {
	$json_data = $widget_data;
	$json_data = json_decode( $json_data, true );

	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];

	foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
		$widgets[ $widget_data_title ] = '';
		foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
			if( is_int( $widget_data_key ) ) {
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}
	unset($widgets[""]);

	foreach ( $sidebar_data as $title => $sidebar ) {
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}

	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}

	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

	fusion_parse_import_data( $sidebar_data );
}

function fusion_parse_import_data( $import_array ) {
	global $wp_registered_sidebars;
	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];
	$current_sidebars = get_option( 'sidebars_widgets' );
	$new_widgets = array( );

	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = fusion_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = $current_widget_data['_multiwidget'];
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}

			endif;
		endforeach;
	endforeach;

	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}

	return false;
}

function fusion_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}

if( function_exists( 'layerslider_import_sample_slider' ) ) {
	function avada_import_sample_slider( $layerslider_data ) {
		// Base64 encoded, serialized slider export code
		$sample_slider = $layerslider_data;

		// Iterate over the sliders
		foreach($sample_slider as $sliderkey => $slider) {

			// Iterate over the layers
			foreach($sample_slider[$sliderkey]['layers'] as $layerkey => $layer) {

				// Change background images if any
				if(!empty($sample_slider[$sliderkey]['layers'][$layerkey]['properties']['background'])) {
					$sample_slider[$sliderkey]['layers'][$layerkey]['properties']['background'] = $GLOBALS['lsPluginPath'].'sampleslider/'.basename($layer['properties']['background']);
				}

				// Change thumbnail images if any
				if(!empty($sample_slider[$sliderkey]['layers'][$layerkey]['properties']['thumbnail'])) {
					$sample_slider[$sliderkey]['layers'][$layerkey]['properties']['thumbnail'] = $GLOBALS['lsPluginPath'].'sampleslider/'.basename($layer['properties']['thumbnail']);
				}

				// Iterate over the sublayers
				if(isset($layer['sublayers']) && !empty($layer['sublayers'])) {
					foreach($layer['sublayers'] as $sublayerkey => $sublayer) {

						// Only IMG sublayers
						if($sublayer['type'] == 'img') {
							$sample_slider[$sliderkey]['layers'][$layerkey]['sublayers'][$sublayerkey]['image'] = $GLOBALS['lsPluginPath'].'sampleslider/'.basename($sublayer['image']);
						}
					}
				}
			}
		}

		// Get WPDB Object
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . "layerslider";

		// Append duplicate
		foreach($sample_slider as $key => $val) {

			// Insert the duplicate
			$wpdb->query(
				$wpdb->prepare("INSERT INTO $table_name
									(name, data, date_c, date_m)
								VALUES (%s, %s, %d, %d)",
								$val['properties']['title'],
								json_encode($val),
								time(),
								time()
				)
			);
		}
	}
}

// Rename sidebar
function avada_name_to_class($name){
	$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
	return $class;
}