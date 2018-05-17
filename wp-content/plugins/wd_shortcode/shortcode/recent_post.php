<?php 
if(!function_exists ('wd_recent_blogs_functions')){
	function wd_recent_blogs_functions($atts,$content = false){
		extract(shortcode_atts(array(
			'category'		=>	''
			,'columns'		=> 2
			,'number_posts'	=> 4
			,'show_type' 	=> 'list-posts'
			,'text_position' => 'left'
			,'show_type_isotope' => 1
			,'title'		=> 'yes'
			,'thumbnail'	=> 'yes'
			,'meta'			=> 'yes'
			,'excerpt'		=> 'yes'
			,'read_more'	=> 'yes'
			,'view_more'	=> 'yes'
			,'thumb_auto'	=> 'no'
			,'view_more_link'	=> ''
			,'excerpt_words'=> 10
		),$atts));

		wp_reset_query();	

		$args = array(
				'post_type' 			=> 'post'
				,'ignore_sticky_posts' 	=> 1
				,'showposts' 			=> $number_posts
		);	
		if( strlen($category) > 0 ){
			$args = array(
				'post_type' 			=> 'post'
				,'ignore_sticky_posts' 	=> 1
				,'showposts' 			=> $number_posts
				,'category_name' 		=> $category
			);	
		}		
		$title 		= strcmp('yes',$title) == 0 ? 1 : 0;
		$show_type_isotope 	= strcmp('yes',$show_type_isotope) == 0 ? 1 : 0;
		$thumbnail 	= strcmp('yes',$thumbnail) == 0 ? 1 : 0;
		$meta 		= strcmp('yes',$meta) == 0 ? 1 : 0;
		$excerpt 	= strcmp('yes',$excerpt) == 0 ? 1 : 0;
		$read_more 	= strcmp('yes',$read_more) == 0 ? 1 : 0;
		$view_more 	= strcmp('yes',$view_more) == 0 ? 1 : 0;
		
		//$span_class = "col-sm-".(24/$columns);
		
		$span_class = "col-lg-".(24/$columns);
		$span_class .= ' col-md-'.(24/round( $columns * 992 / 992));
		$span_class .= ' col-sm-'.(24/round( $columns * 992 / 992));
		$span_class .= ' col-xs-24';
		$span_class .= ' col-mb-24';
		
		$num_count = count(query_posts($args));	
		if( have_posts() ) :
			$id_widget = 'recent-blogs-shortcode'.rand(0,1000);
			ob_start();
			
			if($show_type !== "widget"){
				echo '<div id="'. $id_widget .'" class="shortcode-recent-blogs display-flex '.$show_type.' columns-'.$columns.'">';
				$i = 0;
				while(have_posts()) {
					the_post();
					global $post;
					
					$_post_config = get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'custom_post_config',true);
					if( strlen($_post_config) > 0 ){
						$_post_config = unserialize($_post_config);
					}
					
					?>
					<div class="item <?php echo $span_class ?><?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>">
					
						<div class="item-content">
							<div class="post-info-thumbnail display-flex <?php if(!$thumbnail) echo "hidden-element"?>">
								<div class="post-icon-box">
									<?php if(isset($_post_config['post_type'])):									
										switch($_post_config['post_type']){
											case 'video':
												if(strlen(trim($_post_config['video_url'])) > 0){
												$video_url = trim($_post_config['video_url']);
													if (!empty($video_url)) {
														echo tvlgiao_wpdance_wd_get_embbed_video( $video_url, 1200, 255 );
													}
												}
												break;
											case 'audio':
										if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
										{											
											if (isset($_post_config['audio_soundcloud'])) {
												$audio_url = trim($_post_config['audio_soundcloud']);
										echo do_shortcode( '[soundcloud url='.$audio_url.' height ="220" width="100%" ]' );
											}
											else {
										
												if (strlen(trim($_post_config['audio_mp3'])) > 0) {
													$audio_url = trim($_post_config['audio_mp3']);
													$attr = array(
														'src'      => $audio_url,
														'loop'     => '',
														'autoplay' => '',
														'preload' => 'none'
														);
													echo wp_audio_shortcode( $attr );
												}
											}
										}
												break;
											case 'shortcode':
												?><div class="sticky-post shortcode"><i class="fa fa-cog"></i></div><?php 
												break;
										}
									?>
									<?php endif;?>
								</div>
								<?php $gallery_ids = get_post_meta($post->ID, TVLGiao_Wpdance_THEME_SLUG.'post_gallery', true);
								if( $gallery_ids != '' ){
									$gallery_ids = explode(',', $gallery_ids);
								}
								if( is_array($gallery_ids) ){
									if( has_post_thumbnail() ){
										array_unshift($gallery_ids, get_post_thumbnail_id());
									}
									?>
									<div class="images blog-image-slider loading">
										<?php foreach( $gallery_ids as $id ): ?>
											<div class="image">
												<a class="thumb-image" href="<?php the_permalink() ; ?>">
													<?php echo wp_get_attachment_image( $id, 'tvlgiao_wpdance_blog_shortcode' ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} ?>
								<?php  if(has_post_thumbnail($post->ID) && $_post_config['post_type']=='0' && $gallery_ids == '') :?>
								<a class="thumbnail effect_color" href="<?php the_permalink(); ?>">
									<?php 
										if($show_type == 'list-posts') $post_thumbnail_type = "tvlgiao_wpdance_blog_shortcode";
										else {
											$post_thumbnail_type = strcmp(trim($thumb_auto),'yes') == 0? "tvlgiao_wpdance_blog_shortcode_auto": "tvlgiao_wpdance_blog_shortcode";
										}
										the_post_thumbnail( $post_thumbnail_type,array('class' => 'thumbnail-effect-1') );
									?>
									<!--div class="effect_hover_image"></div-->
								</a>
								<?php endif;?>
								<div class="entry-date body_color">
									<p class="month"><?php echo get_the_date('M') ?></p>
									<p class="day"><?php echo get_the_date('d') ?></p>
								</div>
							</div>
							<div class="meta-post post-info-content <?php if(!$thumbnail) echo ' noimage';?>">
								<h3 class="heading-title <?php if(!$title) echo 'hidden-element'; ?>"><a href="<?php echo get_permalink($post->ID); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post->ID));?>" ><?php echo get_the_title($post->ID); ?></a></h3>
								<div class="author">
									<?php _e('Post by','wpdance')?><?php the_author_posts_link(); ?>
								</div>
								
								<p class="excerpt <?php if(!$excerpt) echo 'hidden-element'; ?>"><?php tvlgiao_wpdance_the_excerpt_max_words($excerpt_words); ?></p>
								
								<?php if($read_more):?>
									<a class="button" href="<?php the_permalink(); ?>"><?php _e("Read more", "wpdance");?></a>
								<?php endif;?>
								
							</div>	
						</div>
					</div>
					
					
			<?php
					$i++;
					
				}
				echo '</div>';
				?>
				
				<?php if($view_more && $view_more_link!==''):?>
					<p style="text-align:center"><a class="button" href="<?php echo esc_url($view_more_link);?>"><?php esc_attr_e("View more post", "wpdance");?></a></p>
				<?php endif;?>
				
				<?php 
				
			} else {
				echo '<div class="shortcode-recent-blogs display-vertical '.$show_type.' columns-'.$columns.'">';
				$i=0;
				while(have_posts()) {
					the_post();
					global $post;
					
					$_post_config = get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'custom_post_config',true);
					if( strlen($_post_config) > 0 ){
						$_post_config = unserialize($_post_config);
					}
					
					?>
					<div class="item <?php echo $span_class ?> <?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>">
					
						<div class="item-content <?php echo $text_position ?>">
							<div class="post-info-thumbnail display-flex <?php if(!$thumbnail) echo "hidden-element"?>">								
									<?php if(isset($_post_config['post_type'])):									
										switch($_post_config['post_type']){
											case 'video':
												if(strlen(trim($_post_config['video_url'])) > 0){
												$video_url = trim($_post_config['video_url']);
													if (!empty($video_url)) {														
														echo tvlgiao_wpdance_wd_get_embbed_video( $video_url, 600, 255 );
													}
												}
												break;
											case 'audio':
										if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
										{											
											if (isset($_post_config['audio_soundcloud'])) {
												$audio_url = trim($_post_config['audio_soundcloud']);
										echo do_shortcode( '[soundcloud url='.$audio_url.' height ="220" width="100%" ]' );
											}
											else {
										
												if (strlen(trim($_post_config['audio_mp3'])) > 0) {
													$audio_url = trim($_post_config['audio_mp3']);
													$attr = array(
														'src'      => $audio_url,
														'loop'     => '',
														'autoplay' => '',
														'preload' => 'none'
														);
													echo wp_audio_shortcode( $attr );
												}
											}
										}
												break;											
										}
									?>
									<?php endif;?>
								<?php $gallery_ids = get_post_meta($post->ID, TVLGiao_Wpdance_THEME_SLUG.'post_gallery', true);
								if( $gallery_ids != '' ){
									$gallery_ids = explode(',', $gallery_ids);
								}
								if( is_array($gallery_ids) ){
									if( has_post_thumbnail() ){
										array_unshift($gallery_ids, get_post_thumbnail_id());
									}
									?>
									<div class="images blog-image-slider loading">
										<?php foreach( $gallery_ids as $id ): ?>
											<div class="image">
												<a class="thumb-image" href="<?php the_permalink() ; ?>">
													<?php echo wp_get_attachment_image( $id, array(360,230),true ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} ?>
								<?php  if(has_post_thumbnail($post->ID) && $_post_config['post_type']=='0' && $gallery_ids == '') :?>
								<a class="thumbnail effect_color" href="<?php the_permalink(); ?>">
									<?php 
										
									
											$post_thumbnail_type = "tvlgiao_wpdance_related_thumb";
										the_post_thumbnail( $post_thumbnail_type, array( 'class' => 'alignleft' ) );

									?>
								<div class="entry-date body_color">
									<p class="month"><?php echo get_the_date('M') ?></p>
									<p class="day"><?php echo get_the_date('d') ?></p>
								</div>
								</a>
								<?php endif;?>								
							</div>
							<div class="meta-post post-info-content <?php if(!$thumbnail) echo ' noimage';?>">
								<h3 class="heading-title <?php if(!$title) echo 'hidden-element'; ?>"><a href="<?php echo get_permalink($post->ID); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post->ID));?>" ><?php echo get_the_title($post->ID); ?></a></h3>
								<div class="author">
									<?php _e('Post by','wpdance')?><?php the_author_posts_link(); ?>
								</div>
								
								<p class="excerpt <?php if(!$excerpt) echo 'hidden-element'; ?>"><?php tvlgiao_wpdance_the_excerpt_max_words(15); ?></p>																								
							</div>	
						</div>
					</div>
					
					
			<?php
					$i++;
				}
				echo '</div>';
			}
			?>
			
			<?php
			$ret_html = ob_get_contents();
			ob_end_clean();
			//ob_end_flush();
		endif;
		wp_reset_query();
		return $ret_html;
	}
} 
add_shortcode('wd_recent_blogs','wd_recent_blogs_functions');

 



 
//add_shortcode('recent_works_blog','recent_works_function');

?>