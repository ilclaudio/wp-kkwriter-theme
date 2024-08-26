<?php
/**
 * KK Writer Theme: Options Manager definition.
 *
 * @package KK_Writer_Theme
 */

define( 'KKW_SEARCHABLE_POST_TYPES', array( KKW_DEFAULT_POST, KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ) );

/**
 * The Activation manager.
 */
class KKW_ThemeOptionsManager
{

	/**
	 * 1 - Registers options page "Base options".
	 *
	 * @return boolean
	 */
	public function add_opt_base_option( $option_key, $tab_group, $capability )
	{
		$result = true;
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'KKW Theme', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_group'    => $tab_group,
			// 'parent_slug'  => $parent_slug,
			'tab_title'    => __( 'Base options', 'kk_writer_theme' ),
			'capability'   => $capability,
			'position'     => 3, // Menu position. Only applicable if 'parent_slug' is left empty.
			'icon_url'     => 'dashicons-admin-tools', // Menu icon. Only applicable if 'parent_slug' is left empty.
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 	$args['display_cb'] = 'kkw_options_display_with_tabs';
		// }
		$base_options = new_cmb2_box( $args );

		$base_options->add_field(
			array(
				'id'   => 'baseoptions_info',
				'name' => __( 'Site configuration', 'kk_writer_theme' ),
				'desc' => __( 'Section to configure base options.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_title',
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
				'id'         => 'site_tagline',
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
				'id'         => 'site_network_name',
				'name'       => __( 'Network name', 'kk_writer_theme' ),
				'desc'       => __( 'The name of the network the site is part of.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_network_url',
				'name'       => __( 'Network url', 'kk_writer_theme' ),
				'desc'       => __( 'The url of the network the site is part of.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_logo',
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
				'id' => 'footer_logo_visible',
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
				'id'         => 'footer_logo',
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
		return $result;
	}

	/**
	 * 2 - Registers options page "Home Messages".
	 *
	 * @return boolean
	 */
	public function add_opt_home_messages( $option_key, $tab_group, $capability )
	{
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Messages', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			// 'parent_slug'  => $parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'HP messages', 'kk_writer_theme' ),
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = 'kkw_options_display_with_tabs';
		// }
		$messages_options = new_cmb2_box( $args );

		$messages_options->add_field(
			array(
				'id' => 'messages_info',
				'name'        => __( 'Home page messages', 'kk_writer_theme' ),
				'desc' => __( 'Add messages that will be displayed on the homepage.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$messages_group_id = $messages_options->add_field(
			array(
				'id'           => 'messages',
				'type'        => 'group',
				'desc' => __( 'Each message is constructed with a short description (max 140 characters) and expiry date (optional).' , 'kk_writer_theme' ),
				'repeatable'  => true,
				'options'     => array(
						'group_title'   => __( 'Message', 'kk_writer_theme' ) . '&nbsp{#}',
						'add_button'    => __( 'Add a mesage', 'kk_writer_theme' ),
						'remove_button' => __( 'Delete the message', 'kk_writer_theme' ),
						'sortable'      => true, // Allow changing the order of repeated groups.
				),
			)
		);
		$messages_options->add_group_field(
			$messages_group_id,
			array(
				'name'    =>  __( 'Choose the color', 'kk_writer_theme' ),
				'id'      => 'message_color',
				'type'    => 'radio_inline',
				'options' => array(
						'danger' => '<span class="radio-color red"></span>' . __( 'Danger', 'kk_writer_theme' ),
						'success' => '<span class="radio-color green"></span>' . __( 'Success', 'kk_writer_theme' ),
						'warning' => '<span class="radio-color brown"></span>' . __( 'Warning', 'kk_writer_theme' ),
						'info'    => '<span class="radio-color gray"></span>' . __( 'Info', 'kk_writer_theme' ),
				),
				'default' => 'info',
			)
		);
		$messages_options->add_group_field(
			$messages_group_id,
			array(
				'name' => __( 'Show the icon', 'kk_writer_theme' ),
				'id'   => 'message_icon',
				'type' => 'checkbox',
			)
		);
		$messages_options->add_group_field(
			$messages_group_id,
			array(
				'id'              => 'message_date',
				'name'            => __( 'End date', 'kk_writer_theme' ),
				'type'            => 'text_date',
				'date_format'     => 'd-m-Y',
				'data-datepicker' => json_encode( array(
						'yearRange' => '-100:+0',
				) ),
			)
		);
		$messages_options->add_group_field(
			$messages_group_id,
			array(
				'id' => 'message_text',
				'name'        => __( 'Text', 'kk_writer_theme' ),
				'desc' => __( 'Max 140 characters' , 'kk_writer_theme' ),
				'type' => 'textarea_small',
				'attributes'    => array(
						'rows'  => 3,
						'maxlength'  => '140',
				),
			)
		);
		$messages_options->add_group_field(
			$messages_group_id,
			array(
				'id' => 'message_link',
				'name'        => __( 'Link', 'kk_writer_theme' ),
				'desc' => __( 'Link to an in-depth page also external to the site.' , 'kk_writer_theme' ),
				'type' => 'text_url',
			)
		);
	}

	/**
	 * 3 - Registers options page "Home Page Layout".
	 *
	 * @return boolean
	 */
	public function add_opt_hp_layout( $option_key, $tab_group, $capability )
	{
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Home Page Layout', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			// 'parent_slug'  => $parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'HP layout', 'kk_writer_theme' ),
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = 'kkw_options_display_with_tabs';
		// }
		$home_options = new_cmb2_box( $args );

		// CAROUSEL Section (Home Page)
		$home_options->add_field(
			array(
				'id'   => 'home_carousel',
				'name' => __( 'Carousel section', 'kk_writer_theme' ),
				'desc' => __( 'Configure here the carousel section.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);

		$home_options->add_field(
			array(
				'id' => 'home_carousel_before_featured_enabled',
				'name' => __( 'Show carousel before featured content', 'kk_writer_theme' ),
				'desc' => __( 'If yes, the carousel is shown before the featured content section.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true' => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_carousel_visible',
				'name' => __( 'Show the Carousel section', 'kk_writer_theme' ),
				'desc' => __( 'Show the main carousel in the Home Page.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_carousel_auto_on',
				'name' => __( 'Automatic selection enabled', 'kk_writer_theme' ),
				'desc' => __( 'If yes, the contents of the Home Page carousel are chosen automatically.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true' => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'name'    => __( 'Choose contents', 'kk_writer_theme' ),
				'desc'    => __( 'Choose the contents to show in the Home Page carousel.', 'kk_writer_theme' ),
				'id'      => 'carousel_content',
				'type'    => 'custom_attached_posts',
				'column'  => true,
				'options' => array(
						'show_thumbnails' => false, // Show thumbnails on the left.
						'filter_boxes'    => true, // Show a text box for filtering the results.
						'query_args'      => array(
								'posts_per_page' => -1,
								'post_type'      => KKW_SEARCHABLE_POST_TYPES,
						), // override the get_posts args.
					)
				)
		);

		// FEATURED CONTENT Section (Home Page).
		$home_options->add_field(
			array(
				'id' => 'home_featured_content',
				'name'        => __( 'Featured content section', 'kk_writer_theme' ),
				'desc' => __( 'Manage the featured content in the Home Page.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_featured_content_visible',
				'name' => __( 'Show featured content', 'kk_writer_theme' ),
				'desc' => __( 'Show featured content section in the Home Page.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true' => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_featured_content_auto_on',
				'name' => __( 'Automatic selection enabled', 'kk_writer_theme' ),
				'desc' => __( 'If yes, the featured contents of the Home Page are chosen automatically.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true' => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
	
		// Featured content: BOX 1.
		$featured_content_group_id = $home_options->add_field(
			array(
				'id'          => 'featured_content_1',
				'type'       => 'group',
				'repeatable' => false,
				'options'    => array(
					'group_title' => __( 'Box 1 - Featured content', 'kk_writer_theme' ),
					'closed'      => true
					,
				)
			)
		);
		$home_options->add_group_field(
			$featured_content_group_id,
			array(
				'id'              => 'box_content',
				'name'            => __( 'Content to show' ),
				'type'            => 'post_search_text',
				'post_type'       => KKW_SEARCHABLE_POST_TYPES,
				'select_type'     => 'radio', // checkbox, radio.
				'select_behavior' => 'add', //add, replace.
			)
		);
		$home_options->add_group_field(
			$featured_content_group_id,
			array(
				'id'               => 'box_image_side',
				'name'             => __( 'Thumbnail side', 'kk_writer_theme' ),
				'desc'             => __( 'On which side the thumbnail wil be shown.' , 'kk_writer_theme' ),
				'type'             => 'select',
				'default'          => 'left',
				'show_option_none' => false,
				'options'          => array(
					'right' => __( 'Right', 'kk_writer_theme' ),
					'left'  => __( 'Left', 'kk_writer_theme' ),
				),
			)
		);
		// Featured content: BOX 2.
		$featured_content_group_id = $home_options->add_field(
			array(
				'id'          => 'featured_content_2',
				'type'       => 'group',
				'repeatable' => false,
				'options'    => array(
					'group_title' => __( 'Box 2 - Featured content', 'kk_writer_theme' ),
					'closed'      => true
					,
				)
			)
		);
		$home_options->add_group_field(
			$featured_content_group_id,
			array(
				'id'              => 'box_content',
				'name'            => __( 'Content to show' ),
				'type'            => 'post_search_text',
				'post_type'       => KKW_SEARCHABLE_POST_TYPES,
				'select_type'     => 'radio', // checkbox, radio.
				'select_behavior' => 'add', //add, replace.
			)
		);
		$home_options->add_group_field(
			$featured_content_group_id,
			array(
				'id'               => 'box_image_side',
				'name'             => __( 'Thumbnail side', 'kk_writer_theme' ),
				'desc'             => __( 'On which side the thumbnail wil be shown.' , 'kk_writer_theme' ),
				'type'             => 'select',
				'default'          => 'left',
				'show_option_none' => false,
				'options'          => array(
					'right' => __( 'Right', 'kk_writer_theme' ),
					'left'  => __( 'Left', 'kk_writer_theme' ),
				),
			)
		);
			// Featured content: BOX 3.
			$featured_content_group_id = $home_options->add_field(
				array(
					'id'          => 'featured_content_3',
					'type'       => 'group',
					'repeatable' => false,
					'options'    => array(
						'group_title' => __( 'Box 3 - Featured content', 'kk_writer_theme' ),
						'closed'      => true
						,
					)
				)
			);
			$home_options->add_group_field(
				$featured_content_group_id,
				array(
					'id'              => 'box_content',
					'name'            => __( 'Content to show' ),
					'type'            => 'post_search_text',
					'post_type'       => KKW_SEARCHABLE_POST_TYPES,
					'select_type'     => 'radio', // checkbox, radio.
					'select_behavior' => 'add', //add, replace.
				)
			);
			$home_options->add_group_field(
				$featured_content_group_id,
				array(
					'id'               => 'box_image_side',
					'name'             => __( 'Thumbnail side', 'kk_writer_theme' ),
					'desc'             => __( 'On which side the thumbnail wil be shown.' , 'kk_writer_theme' ),
					'type'             => 'select',
					'default'          => 'left',
					'show_option_none' => false,
					'options'          => array(
						'right' => __( 'Right', 'kk_writer_theme' ),
						'left'  => __( 'Left', 'kk_writer_theme' ),
					),
				)
			);


		// BLOG Section (Home Page)
		$home_options->add_field(
			array(
				'id'   => 'home_blog',
				'name' => __( 'Blog section', 'kk_writer_theme' ),
				'desc' => __( 'Configure here the blog section.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_blog_section_visible',
				'name' => __( 'Show blog section', 'kk_writer_theme' ),
				'desc' => __( 'Show blog section in the Home Page.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'false',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id' => 'blog_section_after_featured_enabled',
				'name' => __( 'Show blog section after featured content', 'kk_writer_theme' ),
				'desc' => __( 'If yes, the blog section is shown after the featured content section.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);

	}

	/**
	 * 4 - Registers options page "Site Contacts".
	 *
	 * @return boolean
	 */
	public function add_opt_site_contacts( $option_key, $tab_group, $capability )
	{
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Contacts', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			// 'parent_slug'  => $parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Site contacts', 'kk_writer_theme' ),	
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = 'kkw_options_display_with_tabs';
		// }
		$contacts_options = new_cmb2_box( $args );

		$contacts_options->add_field(
			array(
			'id' => 'social_info',
			'name'        => __( 'Contacts', 'kk_writer_theme' ),
			'desc' => __( 'The contact shown in the footer.' , 'kk_writer_theme' ),
			'type' => 'title',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_city',
				'name'       => __( 'City', 'kk_writer_theme' ),
				'desc'       => __( 'The city of the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_address',
				'name'       => __( 'Address', 'kk_writer_theme' ),
				'desc'       => __( "The address of the site." , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_email',
				'name'       => __( 'E-mail', 'kk_writer_theme' ),
				'desc'       => __( 'The e-mail of the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_telephone',
				'name'       => __( 'Phone number', 'kk_writer_theme' ),
				'desc'       => __( 'The phone number of the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);

		$contacts_options->add_field(
			array(
				'id'   => 'smtp',
				'name' => __( 'SMTP', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		
		$contacts_options->add_field(
			array(
				'id'         => 'smtp_sender_name',
				'name'       => __( 'SMTP sender name', 'kk_writer_theme' ),
				'desc'       => __( 'The name that must appear on the e-mails sent by the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);

		$contacts_options->add_field(
			array(
				'id'         => 'smtp_sender_email',
				'name'       => __( 'SMTP sender email', 'kk_writer_theme' ),
				'desc'       => __( 'The provider e-mail that must be used as sender.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);

	}

	/**
	 * 5 - Registers options page "Social media".
	 *
	 * @return boolean
	 */
	public function add_opt_social_media( $option_key, $tab_group, $capability )
	{
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Social media', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			// 'parent_slug'  => $parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Social media', 'kk_writer_theme' ),
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = 'kkw_options_display_with_tabs';
		// }
		$social_options = new_cmb2_box( $args );

		$social_options->add_field(
			array(
				'id' => 'social_info',
				'name'        => __( 'Social media', 'kk_writer_theme' ),
				'desc' => __( 'Insert here the links to your social media.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$social_options->add_field(
			array(
				'id' => 'show_socials',
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
		$social_options->add_field(
			array(
				'id'   => 'facebook',
				'name' => 'Facebook',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'youtube',
				'name' => 'Youtube',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'instagram',
				'name' => 'Instagram',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'pinterest',
			'name' => 'Pinterest',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'twitter',
				'name' => 'Twitter',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'ics',
			'name' => 'X',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'linkedin',
				'name' => 'Linkedin',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'titok',
			'name' => 'TikTok',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'github',
			'name' => 'GitHub',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'gitlab',
			'name' => 'GitLab',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'iris',
			'name' => 'Iris',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'googlescholar',
			'name' => 'Google Scholar',
			'type' => 'text_url',
			)
		);
	}

	/**
	 * 6 - Registers options page "Advanced settings".
	 *
	 * @return boolean
	 */
	public function add_opt_advanced_settings( $option_key, $tab_group, $capability )
	{
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Advanced', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_title'    => __( 'Advanced', 'kk_writer_theme' ),
			// 'parent_slug'  => $parent_slug,
			'tab_group'    => $tab_group,
			'capability'   => $capability,
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 	$args['display_cb'] = 'kkw_options_display_with_tabs';
		// }
		$advanced_options = new_cmb2_box( $args );
	
		$advanced_options->add_field(
			array(
					'id'   => 'advanced_info',
					'name' => __( 'Advanced configurations', 'kk_writer_theme' ),
					'desc' => __( 'Section to configure advanced settings.' , 'kk_writer_theme' ),
					'type' => 'title',
			)
		);
		
		$advanced_options->add_field(
			array(
				'id'   => 'newsletter',
				'name' => __( 'Newsletter', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		
		$advanced_options->add_field(
			array(
				'id'      => 'newsletter_enabled',
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
				'id'               => 'newsletter_manager',
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
				'id'         => 'newsletter_api_token',
				'name'       => __( 'API token', 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'              => 'newsletter_list_id',
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
				'id'              => 'newsletter_template_id',
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
				'id'   => 'login',
				'name' => __( 'Login', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'      => 'login_button_visible',
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
				'id'   => 'multilingua',
				'name' => __( 'Multilanguage', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'      => 'language_selector_visible',
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
				'id'   => 'analytics',
				'name' => __( 'Web Analytics Code', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'   => 'analytics_code',
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
				'id'   => 'restapi',
				'name' => __( 'REST API', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'      => 'rest_api_enabled',
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

}
