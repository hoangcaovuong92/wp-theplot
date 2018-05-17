<?php
    global $VISUAL_COMPOSER_EXTENSIONS;
	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      			=> __( "TS Image Magnify", "ts_visual_composer_extend" ),
		"base"                      			=> "TS_VCSC_Image_Magnify",
		"icon" 	                    			=> "ts-composer-element-icon-image-magnify",
		"class"                     			=> "",
		"category"                  			=> __( "VC Extensions", "ts_visual_composer_extend" ),
		"description"               			=> __("Place an image with magnify effect", "ts_visual_composer_extend"),
		"admin_enqueue_js"        				=> "",
		"admin_enqueue_css"       				=> "",
		"params"                    			=> array(
			// Image Settings
			array(
				"type"              			=> "seperator",
				"param_name"        			=> "seperator_1",
				"seperator"         			=> "Image Settings",
			),
			array(
				"type"                  		=> "dropdown",
				"heading"               		=> __( "Layout", "ts_visual_composer_extend" ),
				"param_name"            		=> "layout",
				"width"                 		=> 300,
				"value"                 		=> array (
					__( "Loupe Layout", "ts_visual_composer_extend" )					=> "loupe",
					__( "Zoom Buttons", "ts_visual_composer_extend" )					=> "buttons",
				),
				"admin_label"           		=> true,
				"description"           		=> __( "Select the general layout for the magnify effect.", "ts_visual_composer_extend" ),
				"dependency"        			=> ""
			),
			array(
				"type"                  		=> "attach_image",
				"holder" 						=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
				"heading"               		=> __( "Image", "ts_visual_composer_extend" ),
				"param_name"            		=> "image",
				"class"							=> "ts_vcsc_holder_image",
				"value"                 		=> "",
				"admin_label"           		=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
				"description"           		=> __( "Select the image you want to use for the magnify effect.", "ts_visual_composer_extend" ),
				"dependency"            		=> "",
			),			
			array(
				"type"                  		=> "dropdown",
				"heading"              	 		=> __( "Preview Image Size", "ts_visual_composer_extend" ),
				"param_name"            		=> "image_thumb",
				"width"                 		=> 150,
				"value"                 		=> array(
					__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
					__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
					__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
				),
				"description"           		=> __( "Select which image size based on WordPress settings should be used for the preview image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"                  		=> "dropdown",
				"heading"               		=> __( "Zoom Image Size", "ts_visual_composer_extend" ),
				"param_name"            		=> "image_zoom",
				"width"                 		=> 150,
				"value"                 		=> array(
					__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
					__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
					__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
				),
				"admin_label"           		=> true,
				"description"           		=> __( "Select which image size based on WordPress settings should be used for the zoomed image.", "ts_visual_composer_extend" ),
				"dependency"            		=> "",
			),
			array(
				"type"              			=> "dropdown",
				"heading"           			=> __( "Background Style", "ts_visual_composer_extend" ),
				"param_name"        			=> "background_type",
				"width"             			=> 300,
				"value"             			=> array(
					__( "Solid Color", "ts_visual_composer_extend" )				=> "color",
					__( "Background Pattern", "ts_visual_composer_extend" )			=> "pattern",
					__( "Custom Image", "ts_visual_composer_extend" )				=> "image",
				),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
				"description"       			=> __( "Select the background type for the zoom container.", "ts_visual_composer_extend" )
			),
			array(
				"type"              			=> "colorpicker",
				"heading"           			=> __( "Background Color", "ts_visual_composer_extend" ),
				"param_name"        			=> "background_color",
				"value"             			=> "#ffffff",
				"description"       			=> __( "Select the background color for the zoom container.", "ts_visual_composer_extend" ),
				"dependency"        			=> array( 'element' => "background_type", 'value' => 'color' )
			),
			array(
				"type"              			=> "background",
				"heading"           			=> __( "Background Pattern", "ts_visual_composer_extend" ),
				"param_name"        			=> "background_pattern",
				"height"             			=> 200,
				"pattern"             			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Background_List,
				"value"							=> "",
				"encoding"          			=> "false",
				"description"       			=> __( "Select the background pattern for the zoom container.", "ts_visual_composer_extend" ),
				"dependency"        			=> array( 'element' => "background_type", 'value' => 'pattern' )
			),
			array(
				"type"              			=> "attach_image",
				"heading"           			=> __( "Background Image", "ts_visual_composer_extend" ),
				"param_name"        			=> "background_image",
				"value"             			=> "false",
				"description"       			=> __( "Select an image or pattern to be used as background for the icon box.", "ts_visual_composer_extend" ),
				"dependency"        			=> array( 'element' => "background_type", 'value' => 'image' )
			),
			array(
				"type"							=> "dropdown",
				"heading"						=> __( "Background Size", "ts_visual_composer_extend" ),
				"param_name"					=> "background_size",
				"width"							=> 150,
				"value"							=> array(
					__( "Cover", "ts_visual_composer_extend" ) 			=> "cover",
					__( "150%", "ts_visual_composer_extend" )			=> "150%",
					__( "200%", "ts_visual_composer_extend" )			=> "200%",
					__( "Contain", "ts_visual_composer_extend" ) 		=> "contain",
					__( "Initial", "ts_visual_composer_extend" ) 		=> "initial",
					__( "Auto", "ts_visual_composer_extend" ) 			=> "auto",
				),
				"description"					=> __( "Select how the custom background image should be sized.", "ts_visual_composer_extend" ),
				"dependency"        			=> array( 'element' => "background_type", 'value' => 'image' )
			),
			array(
				"type"							=> "dropdown",
				"heading"						=> __( "Background Repeat", "ts_visual_composer_extend" ),
				"param_name"					=> "background_repeat",
				"width"							=> 150,
				"value"							=> array(
					__( "No Repeat", "ts_visual_composer_extend" )		=> "no-repeat",
					__( "Repeat X + Y", "ts_visual_composer_extend" )	=> "repeat",
					__( "Repeat X", "ts_visual_composer_extend" )		=> "repeat-x",
					__( "Repeat Y", "ts_visual_composer_extend" )		=> "repeat-y"
				),
				"description"					=> __( "Select if and how the background image should be repeated.", "ts_visual_composer_extend" ),
				"dependency"        			=> array( 'element' => "background_type", 'value' => 'image' )
			),
			array(
				"type"                  		=> "dropdown",
				"heading"              	 		=> __( "Controls Position", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_controls",
				"width"                 		=> 150,
				"value"                 		=> array(
					__( 'Bottom', "ts_visual_composer_extend" )						=> "bottom",
					__( 'Top', "ts_visual_composer_extend" )						=> "top",
					__( 'Left', "ts_visual_composer_extend" )						=> "left",
					__( 'Right', "ts_visual_composer_extend" )						=> "right",
				),
				"description"           		=> __( "Select where the control buttons should be positioned.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
			),
			array(
				"type"                  		=> "dropdown",
				"heading"              	 		=> __( "Preview Image Effect", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_effect",
				"width"                 		=> 150,
				"value"                 		=> array(
					__( 'None', "ts_visual_composer_extend" )						=> "none",
					__( 'Grayscale', "ts_visual_composer_extend" )					=> "grayscale",
					__( 'Sepia', "ts_visual_composer_extend" )						=> "sepia",
					__( 'Whitewash', "ts_visual_composer_extend" )					=> "whitewash",
					__( 'Small Blur', "ts_visual_composer_extend" )					=> "blursmall",
					__( 'Medium Blur', "ts_visual_composer_extend" )				=> "blurmedium",
					__( 'Large Blur', "ts_visual_composer_extend" )					=> "blurstrong",
				),
				"description"           		=> __( "Select what CSS3 effect should be applied to the preview image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Allow Zoom Scale Bar", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_range",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to provide a range / scale control to change the zoom factor.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),	
			array(
				"type"              			=> "switch_button",
				"heading"			    		=> __( "Add Custom ALT Attribute", "ts_visual_composer_extend" ),
				"param_name"		    		=> "attribute_alt",
				"value"				    		=> "false",
				"description"		    		=> __( "Switch the toggle if you want add a custom ALT attribute value, otherwise file name will be set.", "ts_visual_composer_extend" )
			),
			array(
				"type"                  		=> "textfield",
				"heading"               		=> __( "Enter ALT Attribute", "ts_visual_composer_extend" ),
				"param_name"            		=> "attribute_alt_value",
				"value"                 		=> "",
				"description"           		=> __( "Enter a custom value for the ALT attribute for this image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "attribute_alt", 'value' => 'true' )
			),
			// Loupe Settings
			array(
				"type"              			=> "seperator",
				"param_name"        			=> "seperator_2",
				"seperator"         			=> "Loupe Settings",
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Initial Zoom Level", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_level",
				"value"                 		=> "200",
				"min"                   		=> "100",
				"max"                   		=> "1000",
				"step"                  		=> "1",
				"unit"                  		=> '%',
				"description"           		=> __( "Define the initial zoom level to be used on hover.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Max. Loupe Size", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_size",
				"value"                 		=> "100",
				"min"                   		=> "50",
				"max"                   		=> "250",
				"step"                  		=> "10",
				"unit"                  		=> 'px',
				"description"           		=> __( "Define the maximum size of the loupe (will be resized to 50% of image height, if necessary).", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),				
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Horizontal Position", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_x",
				"value"                 		=> "50",
				"min"                   		=> "0",
				"max"                   		=> "100",
				"step"                  		=> "1",
				"unit"                  		=> '%',
				"description"           		=> __( "Select the initial x-position (horizontal) for the loupe (based on loupe center).", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Vertical Position", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_y",
				"value"                 		=> "50",
				"min"                   		=> "0",
				"max"                   		=> "100",
				"step"                  		=> "1",
				"unit"                  		=> '%',
				"description"           		=> __( "Select the initial y-position (vertical) for the loupe (based on loupe center).", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),				
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Move on Drag", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_drag",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to move the loupe only via drag; otherwise via hover.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),				
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Show as Circle", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_circle",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to show the loupe as circle or square.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Reflections", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_reflect",
				"value"				    		=> "false",
				"description"       			=> __( "Switch the toggle if you want to add a reflection effect to the loupe.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Show Shadow", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_shadow",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to add a shadow effect to the loupe.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Show Border", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_border",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to add a border effect to the loupe.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			/*array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Always Show Loupe", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_show",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to always show the loupe over the image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),*/
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Allow Outside", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_outside",
				"value"				    		=> "false",
				"description"       			=> __( "Switch the toggle if you want to allow the loupe to be moved outside of the image frame.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),				

			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Allow Mousewheel", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_mouse",
				"value"				    		=> "false",
				"description"       			=> __( "Switch the toggle if you want to allow the mousewheel to increase / decrease the zoom factor; will disable page scroll while hovering over image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Mousewheel Factor", "ts_visual_composer_extend" ),
				"param_name"            		=> "zoom_wheel",
				"value"                 		=> "10",
				"min"                   		=> "10",
				"max"                   		=> "100",
				"step"                  		=> "10",
				"unit"                  		=> '%',
				"description"           		=> __( "Define the factor by which the mousewheel should increase / decrease the zoom factor.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "zoom_mouse", 'value' => 'true' )
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Allow Pinch Zoom", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_pinch",
				"value"				    		=> "false",
				"description"       			=> __( "Switch the toggle if you want to allow for pinch zooming of the loupe on touch devices.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'loupe' ),
			),
			// Controlbar Settings
			array(
				"type"              			=> "seperator",
				"param_name"        			=> "seperator_3",
				"seperator"         			=> "Controlbar Settings",
				"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Show Reset Button", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_reset",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to show a reset button in the control bar.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
			),				
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Show Zoom Level", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_scale",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to show the zoom scale in the control bar.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Show Rotate Button", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_rotate",
				"value"				    		=> "false",
				"description"       			=> __( "Switch the toggle if you want to show a rotate button in the control bar.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "layout", 'value' => 'buttons' ),
			),
			// Lightbox Settings
			array(
				"type"                  		=> "seperator",
				"param_name"            		=> "seperator_4",
				"seperator"                 	=> "Lightbox Settings",
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"             	 			=> "switch_button",
				"heading"			    		=> __( "Allow Lightbox", "ts_visual_composer_extend" ),
				"param_name"		    		=> "zoom_lightbox",
				"value"				    		=> "true",
				"description"       			=> __( "Switch the toggle if you want to open the full size image in a lightbox upon click.", "ts_visual_composer_extend" ),
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"                  		=> "textfield",
				"heading"               		=> __( "Enter TITLE Attribute", "ts_visual_composer_extend" ),
				"param_name"            		=> "attribute_title",
				"value"                 		=> "",
				"description"           		=> __( "Enter a title for the lightbox image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"              			=> "switch_button",
				"heading"			    		=> __( "Create AutoGroup", "ts_visual_composer_extend" ),
				"param_name"		    		=> "lightbox_group",
				"value"				    		=> "true",
				"description"		    		=> __( "Switch the toggle if you want the plugin to group this image with all other non-gallery images on the page.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"                  		=> "textfield",
				"heading"               		=> __( "Group Name", "ts_visual_composer_extend" ),
				"param_name"            		=> "lightbox_group_name",
				"value"                 		=> "",
				"description"           		=> __( "Enter a custom group name to manually build group with other non-gallery items.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "lightbox_group", 'value' => 'false' ),
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"                  		=> "dropdown",
				"heading"               		=> __( "Transition Effect", "ts_visual_composer_extend" ),
				"param_name"           		 	=> "lightbox_effect",
				"width"                 		=> 150,
				"value"                 		=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Animations,
				"default" 						=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Default_Animation,
				"std" 							=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Default_Animation,
				"admin_label"           		=> true,
				"description"           		=> __( "Select the transition effect to be used for the image in the lightbox.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"                  		=> "dropdown",
				"heading"               		=> __( "Backlight Effect", "ts_visual_composer_extend" ),
				"param_name"            		=> "lightbox_backlight",
				"width"                 		=> 150,
				"value"                 		=> array(
					__( 'Auto Color', "ts_visual_composer_extend" )       											=> "auto",
					__( 'Custom Color', "ts_visual_composer_extend" )     											=> "custom",
					__( 'Transparent Backlight', "ts_visual_composer_extend" )     	=> "hideit",
				),
				"admin_label"           		=> true,
				"description"           		=> __( "Select the backlight effect for the image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "zoom_lightbox", 'value' => 'true' ),
				"group" 						=> "Lightbox Settings",
			),
			array(
				"type"                  		=> "colorpicker",
				"heading"               		=> __( "Custom Backlight Color", "ts_visual_composer_extend" ),
				"param_name"            		=> "lightbox_backlight_color",
				"value"                 		=> "#ffffff",
				"description"           		=> __( "Define the backlight color for the lightbox image.", "ts_visual_composer_extend" ),
				"dependency"            		=> array( 'element' => "lightbox_backlight", 'value' => 'custom' ),
				"group" 						=> "Lightbox Settings",
			),
			// Other Settings
			array(
				"type"                  		=> "seperator",
				"param_name"            		=> "seperator_5",
				"seperator"                 	=> "Other Settings",
				"group" 						=> "Other Settings",
			),
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Margin: Top", "ts_visual_composer_extend" ),
				"param_name"            		=> "margin_top",
				"value"                 		=> "0",
				"min"                   		=> "0",
				"max"                   		=> "200",
				"step"                  		=> "1",
				"unit"                  		=> 'px',
				"description"           		=> __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
				"group" 						=> "Other Settings",
			),
			array(
				"type"                  		=> "nouislider",
				"heading"               		=> __( "Margin: Bottom", "ts_visual_composer_extend" ),
				"param_name"            		=> "margin_bottom",
				"value"                 			=> "0",
				"min"                   		=> "0",
				"max"                   		=> "200",
				"step"                  		=> "1",
				"unit"                  		=> 'px',
				"description"           		=> __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
				"group" 						=> "Other Settings",
			),
			array(
				"type"                  		=> "textfield",
				"heading"               		=> __( "Define ID Name", "ts_visual_composer_extend" ),
				"param_name"            		=> "el_id",
				"value"                 		=> "",
				"description"           		=> __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
				"group" 						=> "Other Settings",
			),
			array(
				"type"                  		=> "tag_editor",
				"heading"           			=> __( "Extra Class Names", "ts_visual_composer_extend" ),
				"param_name"            		=> "el_class",
				"value"                 		=> "",
				"description"      				=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
				"group" 						=> "Other Settings",
			),
		)
	);
	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	}
?>