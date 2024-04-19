<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function kkw_register_main_options_metabox() {
	$prefix = 'kkw_';

	/**
	 * 1 - Registers options page "Base options".
	 */
	$args = array(
		'id'           => 'kkw_options_header',
		'title'        => esc_html__( 'KKW Theme Configuration', 'kk_writer_theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'kkw_options',
		'tab_group'    => 'kkw_options',
		'tab_title'    => __( 'Base options', 'kk_writer_theme' ),
		'capability'   => 'manage_options',
		// 'parent_slug'  => 'themes.php',
		'position'     => 3, // Menu position. Only applicable if 'parent_slug' is left empty.
		'icon_url'     => 'dashicons-admin-tools', // Menu icon. Only applicable if 'parent_slug' is left empty.
	);
	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		$args['display_cb'] = 'kkw_options_display_with_tabs';
	}
	$base_options = new_cmb2_box( $args );

	$base_options->add_field(
		array(
			'id'   => $prefix . 'baseoptions_info',
			'name' => __( 'Site configuration', 'kk_writer_theme' ),
			'desc' => __( 'Section to configure base options.' , 'kk_writer_theme' ),
			'type' => 'title',
		)
	);

	$base_options->add_field(
		array(
			'id'         => $prefix . 'site_title',
			'name'       => __( 'Site title', 'kk_writer_theme' ) . '&nbsp;*',
			'desc'       => __( 'The title of the site.' , 'kk_writer_theme' ),
			'type'       => 'text',
			'attributes' => array(
				'required'   => 'required',
			),
		)
	);

	$base_options->add_field(
		array(
			'id'         => $prefix . 'site_tagline',
			'name'       => __( 'Tagline', 'kk_writer_theme' ) . '&nbsp;*',
			'desc'       => __( 'The tagline of the site.' , 'kk_writer_theme' ),
			'type'       => 'text',
			'attributes' => array(
				'required' => 'required',
			),
		)
	);

	$base_options->add_field(
		array(
			'id'         => $prefix . 'site_network_name',
			'name'       => __( 'Network name', 'kk_writer_theme' ),
			'desc'       => __( 'The name of the network the site is part of.' , 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	$base_options->add_field(
		array(
			'id'         => $prefix . 'site_network_url',
			'name'       => __( 'Network url', 'kk_writer_theme' ),
			'desc'       => __( 'The url of the network the site is part of.' , 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	$base_options->add_field(
		array(
			'id'         => $prefix . 'site_logo',
			'name'       => __( 'Logo header', 'kk_writer_theme' ),
			'desc'       => __( 'The logo of the site, please load an SVG image.' , 'kk_writer_theme' ),
			'type'       => 'file',
			'query_args' => array(
				'type' => array(
					'image',
				),
			),
		)
	);

	$base_options->add_field(
		array(
			'id' => $prefix . 'footer_logo_visible',
			'name' => __( 'Footer logo visible', 'kk_writer_theme' ),
			'desc' => __( 'Yes if the logo needs to be shown in the footer.', 'kk_writer_theme' ),
			'type' => 'radio_inline',
			'default' => 'false',
			'options' => array(
					'true' => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
			),
		)
	);

	$base_options->add_field(
		array(
			'id'         => $prefix . 'footer_logo',
			'name'       => __( 'Logo footer', 'kk_writer_theme' ),
			'desc'       => __( 'Choose the the footer logo. If it is not present, but the display of the logo in the footer is enabled, the header logo is shown with inverted colors. It is recommended to upload an image in SVG format.' , 'kk_writer_theme' ),
			'type'       => 'file',
			'query_args' => array(
				'type' => array(
					'image',
				),
			),
		)
	);


/**
 * 2 - Registers options page "Home Messages".
 */
	$args = array(
		'id'           => 'kkw_options_messages',
		'title'        => esc_html__( 'Messages', 'kk_writer_theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'kkw_home_messages',
		'capability'   => 'manage_options',
		'parent_slug'  => 'kkw_options',
		'tab_group'    => 'kkw_options',
		'tab_title'    => __( 'HP messages', 'kk_writer_theme' ),
	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = 'kkw_options_display_with_tabs';
	}

	$messages_options = new_cmb2_box( $args );

	$messages_options->add_field( array(
			'id' => $prefix . 'messages_info',
			'name'        => __( 'Home page messages', 'kk_writer_theme' ),
			'desc' => __( 'Add messages that will be displayed on the homepage.' , 'kk_writer_theme' ),
			'type' => 'title',
	) );

	$messages_group_id = $messages_options->add_field( array(
			'id'           => $prefix . 'messages',
			'type'        => 'group',
			'desc' => __( 'Each message is constructed with a short description (max 140 characters) and expiry date (optional).' , 'kk_writer_theme' ),
			'repeatable'  => true,
			'options'     => array(
					'group_title'   => __( 'Message', 'kk_writer_theme' ) . '&nbsp{#}',
					'add_button'    => __( 'Add a mesage', 'kk_writer_theme' ),
					'remove_button' => __( 'Delete the message', 'kk_writer_theme' ),
					'sortable'      => true, // Allow changing the order of repeated groups.
			),
	) );

	$messages_options->add_group_field( $messages_group_id, array(
			'name'    =>  __( 'Choose the color', 'kk_writer_theme' ),
			'id'      => $prefix . 'message_color',
			'type'    => 'radio_inline',
			'options' => array(
					'danger' => '<span class="radio-color red"></span>' . __( 'Danger', 'kk_writer_theme' ),
					'success' => '<span class="radio-color green"></span>' . __( 'Success', 'kk_writer_theme' ),
					'warning' => '<span class="radio-color brown"></span>' . __( 'Warning', 'kk_writer_theme' ),
					'info'    => '<span class="radio-color gray"></span>' . __( 'Info', 'kk_writer_theme' ),
			),
			'default' => 'info',
	) );

	$messages_options->add_group_field( $messages_group_id, array(
			'name' => __( 'Show the icon', 'kk_writer_theme' ),
			'id'   => $prefix . 'message_icon',
			'type' => 'checkbox',
	) );

	$messages_options->add_group_field( $messages_group_id, array(
			'id'              => $prefix . 'message_date',
			'name'            => __( 'Data fine', 'kk_writer_theme' ),
			'type'            => 'text_date',
			'date_format'     => 'd-m-Y',
			'data-datepicker' => json_encode( array(
					'yearRange' => '-100:+0',
			) ),
	) );

	$messages_options->add_group_field( $messages_group_id, array(
			'id' => $prefix . 'message_text',
			'name'        => __( 'Text', 'kk_writer_theme' ),
			'desc' => __( 'Max 140 characters' , 'kk_writer_theme' ),
			'type' => 'textarea_small',
			'attributes'    => array(
					'rows'  => 3,
					'maxlength'  => '140',
			),
	) );

	$messages_options->add_group_field( $messages_group_id, array(
			'id' => $prefix . 'message_link',
			'name'        => __( 'Link', 'kk_writer_theme' ),
			'desc' => __( 'Link to an in-depth page also external to the site.' , 'kk_writer_theme' ),
			'type' => 'text_url',
	) );


	/**
	 * 3 - Registers options page "Home Page Layout".
	 */

	$args = array(
			'id'           => 'kkw_options_home',
			'title'        => esc_html__( 'Home Page Layout', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'kkw_homepage',
			'capability'   => 'manage_options',
			'parent_slug'  => 'kkw_options',
			'tab_group'    => 'kkw_options',
			'tab_title'    => __( 'HP layout', 'kk_writer_theme' ),	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = 'kkw_options_display_with_tabs';
	}

	$home_options = new_cmb2_box( $args );

	/**
	 * 4 - Registers options page "Site Contacts".
	 */

	 $args = array(
		'id'           => 'kkw_options_contacts',
		'title'        => esc_html__( 'Contacts', 'kk_writer_theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'kkw_site_contacts',
		'capability'   => 'manage_options',
		'parent_slug'  => 'kkw_options',
		'tab_group'    => 'kkw_options',
		'tab_title'    => __( 'Site contacts', 'kk_writer_theme' ),	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = 'kkw_options_display_with_tabs';
	}

	$contacts_options = new_cmb2_box( $args );

	$contacts_options->add_field( array(
		'id' => $prefix . 'social_info',
		'name'        => __( 'Contacts', 'kk_writer_theme' ),
		'desc' => __( 'The contact shown in the footer.' , 'kk_writer_theme' ),
		'type' => 'title',
	) );

	$contacts_options->add_field(
		array(
			'id'         => $prefix . 'site_city',
			'name'       => __( 'City', 'kk_writer_theme' ),
			'desc'       => __( 'The city of the site.' , 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	$contacts_options->add_field(
		array(
			'id'         => $prefix . 'site_address',
			'name'       => __( 'Address', 'kk_writer_theme' ),
			'desc'       => __( "The address of the site." , 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	$contacts_options->add_field(
		array(
			'id'         => $prefix . 'email_laboratorio',
			'name'       => __( 'Email', 'kk_writer_theme' ),
			'desc'       => __( 'The email of the site.' , 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	$contacts_options->add_field(
		array(
			'id'         => $prefix . 'site_telephone',
			'name'       => __( 'Phone number', 'kk_writer_theme' ),
			'desc'       => __( 'The phone number of the site.' , 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	/**
	* 5 - Registers options page "Social media".
	*/
	$args = array(
			'id'           => 'kkw_options_socials',
			'title'        => esc_html__( 'Social Media', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'kkw_socials',
			'capability'    => 'manage_options',
			'parent_slug'  => 'kkw_options',
			'tab_group'    => 'kkw_options',
			'tab_title'    => __( 'Social Media', 'kk_writer_theme' ),
	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = 'kkw_options_display_with_tabs';
	}

	$social_options = new_cmb2_box( $args );

	$social_options->add_field(
		array(
			'id' => $prefix . 'social_info',
			'name'        => __( 'Social media', 'kk_writer_theme' ),
			'desc' => __( 'Insert here the links to your social media.' , 'kk_writer_theme' ),
			'type' => 'title',
		)
	);

	$social_options->add_field(
		array(
			'id' => $prefix . 'show_socials',
			'name' => __( 'Show social media icons', 'kk_writer_theme' ),
			'desc' => __( 'Enable the display of social media in the header and footer of the page.', 'kk_writer_theme' ),
			'type' => 'radio_inline',
			'default' => 'false',
			'options' => array(
					'true' => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
			),
			'attributes' => array(
					'data-conditional-value' => "false",
			),
		)
	);

	$social_options->add_field( array(
			'id' => $prefix . 'facebook',
			'name' => 'Facebook',
			'type' => 'text_url',
	) );

	$social_options->add_field( array(
			'id' => $prefix . 'youtube',
			'name' => 'Youtube',
			'type' => 'text_url',
	) );
	
	$social_options->add_field( array(
			'id' => $prefix . 'instagram',
			'name' => 'Instagram',
			'type' => 'text_url',
	) );

	$social_options->add_field( array(
			'id' => $prefix . 'twitter',
			'name' => 'Twitter',
			'type' => 'text_url',
	) );

	$social_options->add_field( array(
		'id' => $prefix . 'ics',
		'name' => 'X',
		'type' => 'text_url',
	) );

	$social_options->add_field( array(
			'id' => $prefix . 'linkedin',
			'name' => 'Linkedin',
			'type' => 'text_url',
	) );

	$social_options->add_field( array(
		'id' => $prefix . 'github',
		'name' => 'GitHub',
		'type' => 'text_url',
	) );

	$social_options->add_field( array(
		'id' => $prefix . 'pinterest',
		'name' => 'Pinterest',
		'type' => 'text_url',
	) );


	/**
	* 6 - Registers options page "Advanced settings".
	*/

	$args = array(
		'id'           => 'kkw_options_advanced',
		'title'        => esc_html__( 'Advanced', 'kk_writer_theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'kkw_Advanced',
		'tab_title'    => __( 'Advanced', 'kk_writer_theme' ),
		'parent_slug'  => 'kkw_options',
		'tab_group'    => 'kkw_options',
				'capability'    => 'manage_options',
	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		$args['display_cb'] = 'kkw_options_display_with_tabs';
	}

	$advanced_options = new_cmb2_box( $args );

	$advanced_options->add_field(
		array(
				'id' => $prefix . 'advanced_info',
				'name'        => __( 'Advanced configurations', 'kk_writer_theme' ),
				'desc' => __( 'Section to configure advanced settings.' , 'kk_writer_theme' ),
				'type' => 'title',
		)
	);
	
	$advanced_options->add_field(
		array(
			'id'   => $prefix . 'newsletter',
			'name' => __( 'Newsletter', 'kk_writer_theme' ),
			'type' => 'title',
		)
	);
	
	$advanced_options->add_field(
		array(
			'id'      => $prefix . 'newsletter_enabled',
			'name'    => __( 'Newsletter', 'kk_writer_theme' ),
			'type'    => 'radio_inline',
			'default' => 'false',
			'options' => array(
					'true'  => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
			),
		)
	);

	$advanced_options->add_field(
		array(
			'id'               => $prefix . 'newsletter_manager',
			'name'             => __( 'Newsletter manager', 'kk_writer_theme' ),
			'desc'             => __( 'Selection of the program used to manage the newsletter of the site.' , 'kk_writer_theme' ),
			'type'             => 'select',
			'default'          => 'default',
			'show_option_none' => false,
			'options'          => array(
				'brevo' => __( 'Brevo', 'kk_writer_theme' ),
			),
		)
	);

	$advanced_options->add_field(
		array(
			'id'         => $prefix . 'newsletter_api_token',
			'name'       => __( 'API token', 'kk_writer_theme' ),
			'type'       => 'text',
		)
	);

	$advanced_options->add_field(
		array(
			'id'              => $prefix . 'newsletter_list_id',
			'name'            => __( 'List ID', 'kk_writer_theme' ),
			'desc'            => __( 'ID of the list associated to the site.' , 'kk_writer_theme' ),
			'type'            => 'text_small',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		)
	);

	$advanced_options->add_field(
		array(
			'id'              => $prefix . 'newsletter_template_id',
			'name'            => __( 'Template ID', 'kk_writer_theme' ),
			'desc'            => __( 'Template ID of the page that manages the double OptIn' , 'kk_writer_theme' ),
			'type'            => 'text_small',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		)
	);

	$advanced_options->add_field(
		array(
			'id'   => $prefix . 'login',
			'name' => __( 'Login', 'kk_writer_theme' ),
			'type' => 'title',
		)
	);

	$advanced_options->add_field(
		array(
			'id'      => $prefix . 'login_button_visible',
			'name'    => __( 'Login visible', 'kk_writer_theme' ),
			'type'    => 'radio_inline',
			'default' => 'true',
			'options' => array(
					'true'  => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
			),
		)
	);

	$advanced_options->add_field(
		array(
			'id'   => $prefix . 'multilingua',
			'name' => __( 'Multilanguage', 'kk_writer_theme' ),
			'type' => 'title',
		)
	);

	$advanced_options->add_field(
		array(
			'id'      => $prefix . 'selettore_lingua_visible',
			'name'    => __( 'Enable language selector', 'kk_writer_theme' ),
			'type'    => 'radio_inline',
			'default' => 'true',
			'options' => array(
					'true'  => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
			),
		)
	);

	$advanced_options->add_field(
		array(
			'id'   => $prefix . 'analytics',
			'name' => __( 'Web Analytics Code', 'kk_writer_theme' ),
			'type' => 'title',
		)
	);

	$advanced_options->add_field(
		array(
			'id'   => $prefix . 'analytics_code',
			'name' => 'Code',
			'desc' => __( 'Enter the analytics code.', 'kk_writer_theme' ),
			'type' => 'textarea_code',
			'attributes'    => array(
					'rows'  => 10,
					'maxlength'  => '1000',
			),
		)
	);

	$advanced_options->add_field(
		array(
			'id'   => $prefix . 'restapi',
			'name' => __( 'REST API', 'kk_writer_theme' ),
			'type' => 'title',
		)
	);

	$advanced_options->add_field(
		array(
			'id'      => $prefix . 'rest_api_enabled',
			'name'    => __( 'Enable the REST API', 'kk_writer_theme' ),
			'type'    => 'radio_inline',
			'default' => 'false',
			'options' => array(
					'true'  => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
			),
		)
	);
}
add_action( 'cmb2_admin_init', 'kkw_register_main_options_metabox' );


/**
	* A CMB2 options-page display callback override which adds tab navigation among
	* CMB2 options pages which share this same display callback.
	*
	* @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	*/
function kkw_options_display_with_tabs( $cmb_options ) {
	$tabs = kkw_options_page_tabs( $cmb_options );
	?>
	<div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
		<?php if ( get_admin_page_title() ) : ?>
			<h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
		<?php endif; ?>
				<div class="cmb2-options-box">
						<div class="nav-tab-wrapper">
								<?php foreach ( $tabs as $option_key => $tab_title ) : ?>
										<a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
								<?php endforeach; ?>
						</div>
						<form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
								<fieldset class="form-content">
										<input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
										<?php $cmb_options->options_page_metabox(); ?>
								</fieldset>

								<fieldset class="form-footer">
										<div class="submit-box"><?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb', false ); ?></div>
								</fieldset>
						</form>
						<div class="clear-form"></div>
				</div>
	</div>
	<?php
}

/**
	* Gets navigation tabs array for CMB2 options pages which share the given
	* display_cb param.
	*
	* @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	*
	* @return array Array of tab information.
	*/
function kkw_options_page_tabs( $cmb_options ) {
	$tab_group = $cmb_options->cmb->prop( 'tab_group' );
	$tabs      = array();
	foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
		if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
			$tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
				? $cmb->prop( 'tab_title' )
				: $cmb->prop( 'title' );
		}
	}
	return $tabs;
}

function kkw_options_assets() {
		$current_screen = get_current_screen();
		if(strpos($current_screen->id, 'configurazione_page_') !== false || $current_screen->id === 'toplevel_page_kkw_options') {
				wp_enqueue_style( 'kkw_options_dialog', get_stylesheet_directory_uri() . '/admin/css/jquery-ui.css' );
				wp_enqueue_script( 'kkw_options_dialog', get_stylesheet_directory_uri() . '/admin/js/options.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog' ), '1.0', true );
		}
}
add_action( 'admin_enqueue_scripts', 'kkw_options_assets' );
