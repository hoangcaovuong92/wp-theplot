<?php
/**
 * The template for displaying Content.
 *
 * @package WordPress
 * @subpackage Goodly
 * @since WD_Responsive
 */
?>
<?php
	 $tvlgiao_wpdance_wd_data = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("wd_data");
?>
<ul class="list-posts list-posts-sidebar">
	<?php	
	$count=0;
	if(have_posts()) : while(have_posts()) : the_post();$count++;
			if($count == 1) 
				$_sub_class =  " first";
			if($count == $wp_query->post_count) 
				$_sub_class = " last";
				
		$_post_config = get_post_meta($post->ID,TVLGiao_Wpdance_THEME_SLUG.'custom_post_config',true);
		if( strlen($_post_config) > 0 ){
			$_post_config = unserialize($_post_config);
		}
		?>
		<li <?php post_class("home-features-item". esc_attr($_sub_class));?>>
			<div class="item-content">
			<?php if( has_post_thumbnail($post->ID) ) : ?>
			<div class="post-info-thumbnail">				
				<div class="thumbnail-content">																									
					<div class="entry-date body_color">
						<p class="month"><?php echo get_the_date('M') ?></p>
						<p class="day"><?php echo get_the_date('d') ?></p>
					</div>
				</div>
			</div>
			<?php endif;?>
			<div class="post-info-content">
				<?php if(isset($_post_config['post_type'])):?>
							<?php 
								switch($_post_config['post_type']){
									case 'video':
									if(strlen(trim($_post_config['video_url'])) > 0){
										$video_url = trim($_post_config['video_url']);
											if (!empty($video_url)) {											
												echo tvlgiao_wpdance_wd_get_embbed_video( $video_url, 1200,485 );
											}
										}
										break;
									case 'audio':
										if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
										{											
											if (isset($_post_config['audio_soundcloud'])) {
												$audio_url = trim($_post_config['audio_soundcloud']);
										echo do_shortcode( '[soundcloud url='.$audio_url.' height ="166" width="100%" ]' );
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
											<div class="images">
												<a class="thumb-images" href="<?php the_permalink() ; ?>">
													<?php echo wp_get_attachment_image( $id, '' ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} ?>
						<?php if ( has_post_thumbnail($post->ID) && $_post_config['post_type']=='0' && $gallery_ids == ''  ) { ?>		
						<a class="thumbnail effect_color effect_color_1" href="<?php the_permalink() ; ?>">
					<?php 
							the_post_thumbnail('tvlgiao_wpdance_blog_thumb',array('class' => 'thumbnail-blog')); 								
					?>								
					</a>
						<?php } ?>
				<div class="post-title">
					<h2 class="heading-title"><a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a></h2>
					<?php  if( !has_post_thumbnail($post->ID)) :?>
							<div class="post-icon-box">
							<?php if(is_sticky()): ?>
							<div class="sticky-post"><i class="fa fa-thumb-tack"></i></div>
							<?php endif;?>							
							</div>
					
					<?php endif;?>
					<?php edit_post_link( esc_html__( 'Edit', 'wpnoone' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
					
				</div>	
				<div class="author">
					<?php esc_html_e('Post by','wpnoone')?><?php the_author_posts_link(); ?>
				</div>
				<div class="post-info-meta">
					<?php if( $tvlgiao_wpdance_wd_data['wd_blog_comment_number'] == 1 ) : ?>	
						<div class="comments-count"><i class="fa fa-comments"></i><?php $comments_count = wp_count_comments($post->ID);
						if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . esc_html__('Comment', 'wpnoone');
						else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpnoone');?></div>
					<?php endif;?>
					<?php if( $tvlgiao_wpdance_wd_data['wd_blog_time'] == 1 ) : ?>	
						<div class="entry-date"><?php echo get_the_date('F d, Y'); ?></div>
					<?php endif;?>
					

				</div>
				<?php if( $tvlgiao_wpdance_wd_data['wd_blog_excerpt'] == 1 ) : 
					$words_limit = ($tvlgiao_wpdance_wd_data['wd_blog_excerpt_words_limit']!=='' && is_numeric($tvlgiao_wpdance_wd_data['wd_blog_excerpt_words_limit']))? absint($tvlgiao_wpdance_wd_data['wd_blog_excerpt_words_limit']): 60;
				?>
					<div class="short-content"><?php tvlgiao_wpdance_the_excerpt_max_words($words_limit,$post); ?></div>
				<?php endif; ?>
				<?php if( $tvlgiao_wpdance_wd_data['wd_blog_readmore'] == 1 ) : ?>
					<div class="read-more"><a class="button" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read more','wpnoone'); ?></a></div>
				<?php endif; ?>					
				
				<?php wp_link_pages(); ?>
				</div>
			</div><!-- end post ... -->
		</li>
	<?php						
	endwhile;
	else : echo "<div class=\"alpha omega\"><div class=\"alert alert-error alpha omega\">Sorry. There are no posts to display</div></div>";
	endif;	
	?>	
</ul>