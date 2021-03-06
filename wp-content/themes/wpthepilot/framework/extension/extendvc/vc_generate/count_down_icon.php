<?php
  if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Specific Product

// **********************************************************************//
global $VISUAL_COMPOSER_EXTENSIONS;
$specipic_product_params = array(
	"name"                      => esc_html__( "TS Counter No Icon", "wpnoone" ),
            "base"                      => "Counter_militonre",
            "icon" 	                    => "icon-wpb-ts_vcsc_icon_counter",
            "class"                     => "",
            "category"                  => esc_html__( "VC Extensions", "wpnoone" ),
            "description"               => esc_html__("Place an icon counter element", "wpnoone"),
            "admin_enqueue_js"			=> "",
            "admin_enqueue_css"			=> "",
            "params"                    => array(				
               				
				array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__("Style", 'wpnoone'),
						"admin_label" => true,
						"param_name" => "style",
						"value" => array(
							"Style 1" => 'style1',
							"Style 2" => 'style2',
							"Style 3" => 'style3'
						),
						"description" => '',
					),
                // Main Counter Settings
				array(
					"type"              => "seperator",
					"heading"           => esc_html__( "", "wpnoone" ),
					"param_name"        => "seperator_3",
					"value"				=> "",
					"seperator"			=> "Counter Values",
					"description"       => esc_html__( "", "wpnoone" ),
					"group" 			=> "Value Settings",
				),
				array(
					"type"				=> "switch_button",
					"heading"           => esc_html__( "Trigger on Viewport", "wpnoone" ),
					"param_name"        => "counter_viewport",
					"value"             => "true",
					"on"				=> esc_html__( 'Yes', "wpnoone" ),
					"off"				=> esc_html__( 'No', "wpnoone" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => esc_html__( "Switch the toggle to trigger the counter on viewport or on pageload.", "wpnoone" ),
                    "dependency"        => "",
					"group" 			=> "Value Settings",
				),
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__( "Counter Start Number", "wpnoone" ),
                    "param_name"        => "counter_value_start",
                    "value"             => 0,
                    "admin_label"       => true,
                    "description"       => esc_html__( "Enter the number to start counting from.", "wpnoone" ),
					"group" 			=> "Value Settings",
                ),				
				array(
					"type"				=> "switch_button",
					"heading"           => esc_html__( "Use Shortcode for Counter End Number", "wpnoone" ),
					"param_name"        => "counter_value_by_shortcode",
					"value"             => "false",
					"on"				=> esc_html__( 'Yes', "wpnoone" ),
					"off"				=> esc_html__( 'No', "wpnoone" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => esc_html__( "Switch the toggle if you want to use a shortcode to generate the end value for the counter.", "wpnoone" ),
                    "dependency"        => "",
					"group" 			=> "Value Settings",
				),				
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__( "Counter End Number", "wpnoone" ),
                    "param_name"        => "counter_value_end",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => esc_html__( "Enter the number to count up to.", "wpnoone" ),
					"dependency"        => array( 'element' => "counter_value_by_shortcode", 'value' => 'false' ),
					"group" 			=> "Value Settings",
                ),
				array(
					"type"              => "textarea_raw_html",
					"heading"           => esc_html__( "Counter End Number", "wpnoone" ),
					"param_name"        => "counter_value_end_shortcode",
					"value"             => base64_encode(""),
					"description"       => esc_html__( "Enter the shortcode that will dynamically generate the counter end value.", "wpnoone" ),
					"dependency"        => array( 'element' => "counter_value_by_shortcode", 'value' => 'true' ),
					"group" 			=> "Value Settings",
				),
				array(
					"type"              => "nouislider",
					"heading"           => esc_html__( "Counter Number Font Size", "wpnoone" ),
					"param_name"        => "counter_value_size",
					"value"             => "30",
					"min"               => "12",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => esc_html__( "Select the font size for the counter number.", "wpnoone" ),
					"dependency"        => "",
					"group" 			=> "Value Settings",
				),
				array(
					"type"              => "colorpicker",
					"heading"           => esc_html__( "Counter Number Font Color", "wpnoone" ),
					"param_name"        => "counter_value_color",
					"value"             => "#000000",
					"description"       => esc_html__( "Define the font color for counter number.", "wpnoone" ),
					"dependency"        => "",
					"group" 			=> "Value Settings",
				),
				array(
					"type"				=> "switch_button",
					"heading"           => esc_html__( "Format Finished Number", "wpnoone" ),
					"param_name"        => "counter_value_format",
					"value"             => "false",
					"on"				=> esc_html__( 'Yes', "wpnoone" ),
					"off"				=> esc_html__( 'No', "wpnoone" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => esc_html__( "Switch the toggle to add some formatting to the number once the count has finished.", "wpnoone" ),
                    "dependency"        => "",
					"group" 			=> "Value Settings",
				),
				array(
					"type"				=> "switch_button",
					"heading"           => esc_html__( "Add '+' Sign to Number", "wpnoone" ),
					"param_name"        => "counter_value_plus",
					"value"             => "false",
					"on"				=> esc_html__( 'Yes', "wpnoone" ),
					"off"				=> esc_html__( 'No', "wpnoone" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => esc_html__( "Switch the toggle to either show or hide a '+' sign after the number once the count has finished.", "wpnoone" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' ),
					"group" 			=> "Value Settings",
				),
                array(
                    "type"              => "dropdown",
                    "heading"           => esc_html__( "Thousand Seperator", "wpnoone" ),
                    "param_name"        => "counter_value_seperator",
                    "width"             => 150,
                    "value"             => array(
                        esc_html__( 'None', "wpnoone" )         => "",
                        esc_html__( 'Comma', "wpnoone" )        => ",",
                        esc_html__( 'Dot', "wpnoone" )          => ".",
                        esc_html__( 'Space', "wpnoone" )        => " ",
                    ),
                    "description"       => esc_html__( "Select a character to seperate thousands in the end number.", "wpnoone" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' ),
					"group" 			=> "Value Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__( "Character(s) before Number", "wpnoone" ),
                    "param_name"        => "counter_value_before",
                    "value"             => "",
                    "description"       => esc_html__( "Enter any character to be shown before the nunber (i.e. $).", "wpnoone" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' ),
					"group" 			=> "Value Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__( "Character(s) after Number", "wpnoone" ),
                    "param_name"        => "counter_value_after",
                    "value"             => "",
                    "description"       => esc_html__( "Enter any character to be shown after the nunber (i.e. %).", "wpnoone" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' ),
					"group" 			=> "Value Settings",
                ),
				array(
					"type"				=> "switch_button",
					"heading"           => esc_html__( "Seperator Line", "wpnoone" ),
					"param_name"        => "counter_seperator",
					"value"             => "false",
					"on"				=> esc_html__( 'Yes', "wpnoone" ),
					"off"				=> esc_html__( 'No', "wpnoone" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => esc_html__( "Switch the toggle to either show or hide a seperator.", "wpnoone" ),
                    "dependency"		=> "",
					"group" 			=> "Value Settings",
				),
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__( "Counter Note", "wpnoone" ),
                    "param_name"        => "counter_note",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => esc_html__( "Enter a note about what you are counting.", "wpnoone" ),
					"group" 			=> "Value Settings",
                ),
				array(
					"type"              => "nouislider",
					"heading"           => esc_html__( "Counter Note Font Size", "wpnoone" ),
					"param_name"        => "counter_note_size",
					"value"             => "15",
					"min"               => "12",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => esc_html__( "Select the font size for the counter note.", "wpnoone" ),
					"dependency"        => "",
					"group" 			=> "Value Settings",
				),
				array(
					"type"              => "colorpicker",
					"heading"           => esc_html__( "Counter Note Font Color", "wpnoone" ),
					"param_name"        => "counter_note_color",
					"value"             => "#000000",
					"description"       => esc_html__( "Define the font color for counter note.", "wpnoone" ),
					"dependency"        => "",
					"group" 			=> "Value Settings",
				),
				array(
					"type"              => "nouislider",
					"heading"           => esc_html__( "Counter Speed", "wpnoone" ),
					"param_name"        => "counter_speed",
					"value"             => "2000",
					"min"               => "500",
					"max"               => "10000",
					"step"              => "100",
					"unit"              => 'ms',
					"description"       => esc_html__( "Select the speed in ms for the counter to finish.", "wpnoone" ),
					"dependency"        => "",
					"group" 			=> "Value Settings",
				),
				// Counter Tooltip
				array(
					"type"				=> "seperator",
					"heading"			=> esc_html__( "", "wpnoone" ),
					"param_name"		=> "seperator_4",
					"value"				=> "",
					"seperator"			=> "Icon Tooltip",
					"description"		=> esc_html__( "", "wpnoone" ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"              => "switch_button",
					"heading"           => esc_html__( "Use HTML Tooltip", "wpnoone" ),
					"param_name"        => "tooltip_html",
					"value"             => "false",
					"on"				=> esc_html__( 'Yes', "wpnoone" ),
					"off"				=> esc_html__( 'No', "wpnoone" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"		=> esc_html__( "Switch the toggle if you want to apply a tooltip with HTML code to the element.", "wpnoone" ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"				=> "textarea",
					"class"				=> "",
					"heading"			=> esc_html__( "Tooltip Content", "wpnoone" ),
					"param_name"		=> "tooltip_content",
					"value"				=> "",
					"description"		=> esc_html__( "Enter the tooltip content here (do not use quotation marks).", "wpnoone" ),
					"dependency"		=> array( 'element' => "tooltip_html", 'value' => 'false' ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"              => "textarea_raw_html",
					"heading"           => esc_html__( "Tooltip Content", "wpnoone" ),
					"param_name"        => "tooltip_encoded",
					"value"             => base64_encode(""),
					"description"      	 => esc_html__( "Enter the tooltip content here (HTML code can be used).", "wpnoone" ),
					"dependency"           => array( 'element' => "tooltip_html", 'value' => "true" ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> esc_html__( "Tooltip Position", "wpnoone" ),
					"param_name"		=> "tooltip_position",
					"value"					=> array(
						__( "Top", "wpnoone" )                            => "ts-simptip-position-top",
						__( "Bottom", "wpnoone" )                         => "ts-simptip-position-bottom",
					),
					"description"		=> esc_html__( "Select the tooltip position in relation to the image.", "wpnoone" ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> esc_html__( "Tooltip Style", "wpnoone" ),
					"param_name"		=> "tooltip_style",
					"value"             => array(
						esc_html__( "Black", "wpnoone" )                          => "",
						esc_html__( "Gray", "wpnoone" )                           => "ts-simptip-style-gray",
						esc_html__( "Green", "wpnoone" )                          => "ts-simptip-style-green",
						esc_html__( "Blue", "wpnoone" )                           => "ts-simptip-style-blue",
						esc_html__( "Red", "wpnoone" )                            => "ts-simptip-style-red",
						esc_html__( "Orange", "wpnoone" )                         => "ts-simptip-style-orange",
						esc_html__( "Yellow", "wpnoone" )                         => "ts-simptip-style-yellow",
						esc_html__( "Purple", "wpnoone" )                         => "ts-simptip-style-purple",
						esc_html__( "Pink", "wpnoone" )                           => "ts-simptip-style-pink",
						esc_html__( "White", "wpnoone" )                          => "ts-simptip-style-white"
					),
					"description"		=> esc_html__( "Select the tooltip style.", "wpnoone" ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"				=> "nouislider",
					"heading"			=> esc_html__( "Tooltip X-Offset", "wpnoone" ),
					"param_name"		=> "tooltipster_offsetx",
					"value"				=> "0",
					"min"				=> "-100",
					"max"				=> "100",
					"step"				=> "1",
					"unit"				=> 'px',
					"description"		=> esc_html__( "Define an optional X-Offset for the tooltip position.", "wpnoone" ),
					"group" 			=> "Tooltip Settings",
				),
				array(
					"type"				=> "nouislider",
					"heading"			=> esc_html__( "Tooltip Y-Offset", "wpnoone" ),
					"param_name"		=> "tooltipster_offsety",
					"value"				=> "0",
					"min"				=> "-100",
					"max"				=> "100",
					"step"				=> "1",
					"unit"				=> 'px',
					"description"		=> esc_html__( "Define an optional Y-Offset for the tooltip position.", "wpnoone" ),
					"group" 			=> "Tooltip Settings",
				),
				// Link Settings
				array(
					"type"              => "seperator",
					"heading"           =>esc_html__( "", "wpnoone" ),
					"param_name"        => "seperator_5",
					"value"				=> "",
					"seperator"			=> "Link Settings",
					"description"       => esc_html__( "", "wpnoone" ),
					"group" 			=> "Link Settings",
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> esc_html__( "Link Holder", "wpnoone" ),
					"param_name"		=> "link_counter",
					"value"             => array(
						esc_html__( "No Link", "wpnoone" )                          	=> "",
						esc_html__( "Link On Icon / Image", "wpnoone" )				=> "icon",
						esc_html__( "Link On Content", "wpnoone" )					=> "content",
						esc_html__( "Link On Button", "wpnoone" )						=> "flat",
						esc_html__( "Link On Full Element", "wpnoone" )				=> "element",
					),
					"description"		=> esc_html__( "Select where the link should be attached to.", "wpnoone" ),
					"group" 			=> "Link Settings",
				),
				array(
					"type" 				=> "vc_link",
					"heading" 			=> esc_html__("Link + Title", "wpnoone"),
					"param_name" 		=> "link_data",
					"description" 		=> esc_html__("Provide a link to another site/page for the Icon Counter.", "wpnoone"),
					"dependency"        => array( 'element' => "link_counter", 'value' => array('icon', 'content', 'flat', 'element') ),
					"group"				=> "Link Settings",
				),
                array(
                    "type"				=> "dropdown",
                    "heading"			=> esc_html__( "Button Color Style", "wpnoone" ),
                    "param_name"		=> "link_buttonstyle",
                    "width"				=> 300,
					"value"				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Default_Colors,
                    "description"		=> esc_html__( "Select the general color style for button.", "wpnoone" ),
					"dependency"		=> array( 'element' => "link_counter", 'value' => array('flat') ),
					"group"				=> "Link Settings",
                ),
                array(
                    "type"				=> "dropdown",
                    "heading"			=> esc_html__( "Button Hover Style", "wpnoone" ),
                    "param_name"		=> "link_buttonhover",
                    "width"				=> 300,
					"value"				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Flat_Button_Hover_Colors,
                    "description"		=> esc_html__( "Select the general hover style for button.", "wpnoone" ),
					"dependency"		=> array( 'element' => "link_counter", 'value' => array('flat') ),
					"group"				=> "Link Settings",
                ),
                array(
                    "type"				=> "textfield",
                    "heading"			=> esc_html__( "Button Text", "wpnoone" ),
                    "param_name"		=> "link_buttontext",
                    "value"				=> "Learn More",
                    "description"		=> esc_html__( "Enter the text for the button.", "wpnoone" ),
					"dependency"		=> array( 'element' => "link_counter", 'value' => array('flat') ),
					"group"				=> "Link Settings",
                ),
                array(
                    "type"				=> "nouislider",
                    "heading"			=> esc_html__( "Button Text Size", "wpnoone" ),
                    "param_name"		=> "link_buttonsize",
                    "value"				=> "16",
                    "min"				=> "12",
                    "max"				=> "20",
                    "step"				=> "1",
                    "unit"				=> 'px',
                    "description"		=> esc_html__( "Select the font size for the trigger button.", "wpnoone" ),
					"dependency"		=> array( 'element' => "link_counter", 'value' => array('flat') ),
					"group"				=> "Link Settings",
                ),				
                // Animation
				array(
					"type"              => "seperator",
					"heading"           => esc_html__( "", "wpnoone" ),
					"param_name"        => "seperator_6",
					"value"				=> "",
					"seperator"			=> "Icon / Image Animation",
					"description"       => esc_html__( "", "wpnoone" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"				=> "css3animations",
					"class"				=> "",
					"heading"			=> esc_html__("Icon / Image Animation", "wpnoone"),
					"param_name"		=> "animation_icon",
					"standard"			=> "false",
					"prefix"			=> "",
					"connector"			=> "css3animations_in",
					"noneselect"		=> "true",
					"default"			=> "",
					"value"				=> "",
					"admin_label"		=> false,
					"description"		=> esc_html__("Select the animation for the icon / image.", "wpnoone"),
					"group" 			=> "Other Settings",
				),
				array(
					"type"				=> "hidden_input",
					"heading"			=> esc_html__( "Icon / Image Animation", "wpnoone" ),
					"param_name"		=> "css3animations_in",
					"value"				=> "",
					"admin_label"		=> true,
					"description"		=> esc_html__( "", "wpnoone" ),
					"group" 			=> "Other Settings",
				),
				// Other Icon Settings
				array(
					"type"              => "seperator",
					"heading"           => esc_html__( "", "wpnoone" ),
					"param_name"        => "seperator_7",
					"value"				=> "",
					"seperator"			=> "Other Settings",
					"description"       => esc_html__( "", "wpnoone" ),
					"group" 			=> "Other Settings",
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => esc_html__( "Margin: Top", "wpnoone" ),
                    "param_name"        => "margin_top",
                    "value"             => "0",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => esc_html__( "Select the top margin for the element.", "wpnoone" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => esc_html__( "Margin: Bottom", "wpnoone" ),
                    "param_name"        => "margin_bottom",
                    "value"             => "0",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => esc_html__( "Select the bottom margin for the element.", "wpnoone" ),
					"group" 			=> "Other Settings",
                ),
				array(
					"type"              => "textfield",
					"heading"           => esc_html__( "Define ID Name", "wpnoone" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => esc_html__( "Enter an unique ID for the element.", "wpnoone" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => esc_html__( "Extra Class Name", "wpnoone" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => esc_html__( "Enter a class name for the element.", "wpnoone" ),
					"group" 			=> "Other Settings",
				),
				// Load Custom CSS/JS File
				array(
					"type"				=> "load_file",
					"heading"			=> esc_html__( "", "wpnoone" ),
					"value"				=> "",
					"param_name"		=> "el_file1",
					"file_type"			=> "js",
					"file_path"			=> "js/ts-visual-composer-extend-element.min.js",
					"description"		=> esc_html__( "", "wpnoone" )
				),
				array(
					"type"				=> "load_file",
					"heading"			=> esc_html__( "", "wpnoone" ),
					"value"				=> "",
					"param_name"		=> "el_file2",
					"file_type"			=> "css",
					"file_id"			=> "ts-extend-animations",
					"file_path"			=> "css/ts-visual-composer-extend-animations.min.css",
					"description"		=> esc_html__( "", "wpnoone" )
				),
				
	)
);
vc_map( $specipic_product_params );
 
?>
