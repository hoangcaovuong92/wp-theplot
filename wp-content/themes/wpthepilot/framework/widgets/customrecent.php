<?php 
if(!class_exists('WP_Widget_Customrecent')){
	class WP_Widget_Customrecent extends WP_Widget {
    	function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Recent Posts','wpdance'),
				'desc' 		=> esc_html__('This widget show recent post in each category you selec.','wpdance'),
				'slug' 	  	=> 'customrecent',
				'class' 	=> 'widget_customrecent',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}
	  
		function widget($args, $instance){
			/*global $wpdb;*/ /* call global for use in function*/
			
			$cache = wp_cache_get('customrecent', 'widget');			
			
			if ( ! is_array( $cache ) )
				$cache = array();

			if ( isset( $cache[$args['widget_id']] ) ) {
				echo wp_kses_post($cache[$args['widget_id']]);
				return;
			}

			ob_start();			
			
			extract($args); // gives us the default settings of widgets
			
			$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Recent','wpnoone') : $instance['title']);
			
			$link = empty( $instance['link'] ) ? '#' : esc_url($instance['link']);
			$link = ( isset($link) && strlen($link) > 0 ) ? $link : "#" ;
			$show_image = ( isset($instance['show_image']) && strcmp(esc_attr($instance['show_image']), 'yes') == 0)? 1: 0;
			
			$_limit = absint($instance['limit']) == 0 ? 5 : absint($instance['limit']);
			$show_date = (isset($instance['show_date']) && $instance['show_date'] == 'on')?1:0;
			$show_author = (isset($instance['show_author'])&& $instance['show_author'] == 'on')?1:0;
			$show_desc = (isset($instance['show_desc'])&& $instance['show_desc'] == 'on')?1:0;
			
			echo wp_kses_post($before_widget); // echos the container for the widget || obtained from $args
			if($title){
				echo wp_kses_post($before_title . $title . $after_title);
			}
			
			 $args = array(
                    'showposts' => $_limit,
                    'post_type' => 'post',
                    'ignore_sticky_posts' => 1
                );
                $the_query = new WP_Query( $args );	
			
			$num_count = $the_query->post_count;						
			if($the_query->have_posts())	{
				$id_widget = 'recent-'.rand(0,1000);
				echo '<ul class="recentposts" id="'.$id_widget.'">';
				$i = 0;
				while($the_query->have_posts()) {$the_query->the_post();global $post;
					?>
					<li class="item<?php if($i == 0) echo ' first';?><?php if(++$i == $num_count) echo ' last';?>">
						<div class="media">	
							<?php if( $show_image ){ ?>
								<div class="post_thumbnail image">
									<a class="wd-effect-blog" href="<?php esc_url(the_permalink()); ?>">
									<?php if(has_post_thumbnail()){ ?>
										<?php the_post_thumbnail('tvlgiao_wpdance_blog_thumb');?>	
									<?php } else { ?>	
										<img alt="<?php esc_attr(the_title()); ?>" height="120" width="120" title="<?php esc_attr(the_title());?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/no-image-blog.gif"/>
									<?php } ?>
										<div class="effect_hover_image"></div>
									</a>
								</div>
							<?php } ?>
							<div class="detail">
								<div class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpnoone' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
										<?php echo esc_attr(get_the_title()); ?>
									</a>
									<?php if($show_desc) { ?>
									<p class="entry-desc">
									<?php echo tvlgiao_wpdance_the_excerpt_max_words(4,$the_query->post);?>
								    </p>
									<?php } ?>
								</div>
								<?php if($show_date) { ?>
								<p class="entry-meta">
									<?php echo get_the_date('F d, Y') ?>
								</p>
								<?php } ?>
								<?php if($show_author) { ?>
								<div class="author"><i class="fa fa-user"></i><?php esc_html_e('','wpnoone');?> <?php the_author_posts_link();?></div>
								<?php } ?>
							</div><!-- .detail -->
						</div>
					</li>
				
					
				<?php }
				echo '</ul>';
			}
			wp_reset_postdata();
			
			echo wp_kses_post($after_widget); // close the container || obtained from $args
			$content = ob_get_clean();

			if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

			echo wp_kses_post($content);

			wp_cache_set('customrecent', $cache, 'widget');			
			
		}

		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		
		function form($instance) {        

			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'From Our Blog','link'=>'#', 'show_image' => 'yes','limit'=>4,'show_date'=>1 ,'show_author'=>1,'show_desc'=>1) );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$link = esc_url( $instance['link'] );
			$show_image = esc_attr( $instance['show_image'] );
			$show_date = esc_attr($instance['show_date'] );
			$show_author = esc_attr($instance['show_author']);
			$show_desc   = esc_attr($instance['show_desc'])
			?>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title','wpnoone' ); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p><label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e( 'Title Link','wpnoone' ); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>

			<p><label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>"><?php esc_html_e( 'Show Image','wpnoone' ); ?> : </label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('show_image')); ?>" name="<?php echo esc_attr($this->get_field_name('show_image')); ?>">
				<option value="yes" <?php echo strcmp('yes', esc_attr($show_image)) == 0? "selected": ''?>>Yes</option>
				<option value="no" <?php echo strcmp('no', esc_attr($show_image)) == 0? "selected": ''?>>No</option>
			</select></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_html_e( 'Limit','wpnoone' ); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="number" min="2" max="10" value="<?php echo esc_attr($limit); ?>" /></p>
			<p>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" type="checkbox" <?php echo checked( $instance[ 'show_date' ], 'on' ); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e( 'Show date time','wpnoone' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_author')); ?>" name="<?php echo esc_attr($this->get_field_name('show_author')); ?>" type="checkbox" <?php checked( $instance[ 'show_author' ], 'on' ); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e( 'Show author','wpnoone' ); ?></label>
			</p>
			<p>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_desc')); ?>" name="<?php echo esc_attr($this->get_field_name('show_desc')); ?>" type="checkbox" <?php checked( $instance[ 'show_desc' ], 'on' ); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_desc')); ?>"><?php esc_html_e( 'Show Description','wpnoone' ); ?></label>
			</p>
			
	<?php
		   
		}
	}
}
?>