<?php
add_action('widgets_init', 'social_links_load_widgets');

function social_links_load_widgets()
{
	register_widget('Social_Links_Widget');
}

class Social_Links_Widget extends WP_Widget {

	function Social_Links_Widget()
	{
		$widget_ops = array('classname' => 'social_links', 'description' => '');

		$control_ops = array('id_base' => 'social_links-widget');

		$this->WP_Widget('social_links-widget', 'Avada: Social Links', $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}

		$color_scheme ='';
		if ($instance['color_scheme'] == 'Dark') {
			$color_scheme = 'social-networks-light';
		}

		?>
		<ul class="social-networks <?php echo $color_scheme; ?> clearfix">
			<?php if($instance['rss_link']): ?>
			<li class="rss">
				<a class="rss" href="<?php echo $instance['rss_link']; ?>" target="<?php echo $instance['linktarget']; ?>">RSS</a>
				<div class="popup">
					<div class="holder">
						<p>RSS</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['fb_link']): ?>
			<li class="facebook">
				<a class="facebook" href="<?php echo $instance['fb_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Facebook</a>
				<div class="popup">
					<div class="holder">
						<p>Facebook</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['twitter_link']): ?>
			<li class="twitter">
				<a class="twitter" href="<?php echo $instance['twitter_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Twitter</a>
				<div class="popup">
					<div class="holder">
						<p>Twitter</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['dribbble_link']): ?>
			<li class="dribbble">
				<a class="dribbble" href="<?php echo $instance['dribbble_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Dribble</a>
				<div class="popup">
					<div class="holder">
						<p>Dribbble</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['google_link']): ?>
			<li class="google">
				<a class="google" href="<?php echo $instance['google_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Google</a>
				<div class="popup">
					<div class="holder">
						<p>Google +1</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['linkedin_link']): ?>
			<li class="linkedin">
				<a class="linkedin" href="<?php echo $instance['linkedin_link']; ?>" target="<?php echo $instance['linktarget']; ?>">LinkedIn</a>
				<div class="popup">
					<div class="holder">
						<p>LinkedIn</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['blogger_link']): ?>
			<li class="blogger">
				<a class="blogger" href="<?php echo $instance['blogger_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Blogger</a>
				<div class="popup">
					<div class="holder">
						<p>Blogger</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['tumblr_link']): ?>
			<li class="tumblr">
				<a class="tumblr" href="<?php echo $instance['tumblr_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Tumblr</a>
				<div class="popup">
					<div class="holder">
						<p>Tumblr</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['reddit_link']): ?>
			<li class="reddit">
				<a class="reddit" href="<?php echo $instance['reddit_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Reddit</a>
				<div class="popup">
					<div class="holder">
						<p>Reddit</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['yahoo_link']): ?>
			<li class="yahoo">
				<a class="yahoo" href="<?php echo $instance['yahoo_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Yahoo</a>
				<div class="popup">
					<div class="holder">
						<p>Yahoo</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['deviantart_link']): ?>
			<li class="deviantart">
				<a class="deviantart" href="<?php echo $instance['deviantart_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Deviantart</a>
				<div class="popup">
					<div class="holder">
						<p>DeviantArt</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['vimeo_link']): ?>
			<li class="vimeo">
				<a class="vimeo" href="<?php echo $instance['vimeo_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Vimeo</a>
				<div class="popup">
					<div class="holder">
						<p>Vimeo</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['youtube_link']): ?>
			<li class="youtube">
				<a class="youtube" href="<?php echo $instance['youtube_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Youtube</a>
				<div class="popup">
					<div class="holder">
						<p>Youtube</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['pinterest_link']): ?>
			<li class="pinterest">
				<a class="pinterest" href="<?php echo $instance['pinterest_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Pinterest</a>
				<div class="popup">
					<div class="holder">
						<p>Pinterest</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['digg_link']): ?>
			<li class="digg">
				<a class="digg" href="<?php echo $instance['digg_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Digg</a>
				<div class="popup">
					<div class="holder">
						<p>Digg</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['forrst_link']): ?>
			<li class="forrst">
				<a class="forrst" href="<?php echo $instance['forrst_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Forrst</a>
				<div class="popup">
					<div class="holder">
						<p>Forrst</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['myspace_link']): ?>
			<li class="myspace">
				<a class="myspace" href="<?php echo $instance['myspace_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Myspace</a>
				<div class="popup">
					<div class="holder">
						<p>Myspace</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['skype_link']): ?>
			<li class="skype">
				<a class="skype" href="<?php echo $instance['skype_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Skype</a>
				<div class="popup">
					<div class="holder">
						<p>Skype</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if($instance['flickr_link']): ?>
			<li class="flickr">
				<a class="flickr" href="<?php echo $instance['flickr_link']; ?>" target="<?php echo $instance['linktarget']; ?>">Flickr</a>
				<div class="popup">
					<div class="holder">
						<p>Flickr</p>
					</div>
				</div>
			</li>
			<?php endif; ?>
		</ul>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['linktarget'] = $new_instance['linktarget'];
		$instance['rss_link'] = $new_instance['rss_link'];
		$instance['fb_link'] = $new_instance['fb_link'];
		$instance['twitter_link'] = $new_instance['twitter_link'];
		$instance['dribbble_link'] = $new_instance['dribbble_link'];
		$instance['google_link'] = $new_instance['google_link'];
		$instance['linkedin_link'] = $new_instance['linkedin_link'];
		$instance['blogger_link'] = $new_instance['blogger_link'];
		$instance['tumblr_link'] = $new_instance['tumblr_link'];
		$instance['reddit_link'] = $new_instance['reddit_link'];
		$instance['yahoo_link'] = $new_instance['yahoo_link'];
		$instance['deviantart_link'] = $new_instance['deviantart_link'];
		$instance['vimeo_link'] = $new_instance['vimeo_link'];
		$instance['youtube_link'] = $new_instance['youtube_link'];
		$instance['pinterest_link'] = $new_instance['pinterest_link'];
		$instance['digg_link'] = $new_instance['digg_link'];
		$instance['flickr_link'] = $new_instance['flickr_link'];
		$instance['forrst_link'] = $new_instance['forrst_link'];
		$instance['myspace_link'] = $new_instance['myspace_link'];
		$instance['skype_link'] = $new_instance['skype_link'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Get Social');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color_scheme'); ?>">Color Scheme:</label>
			<select id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>" class="widefat" style="width:100%;">
				<option <?php if ('Light' == $instance['color_scheme']) echo 'selected="selected"'; ?>>Light</option>
				<option <?php if ('Dark' == $instance['color_scheme']) echo 'selected="selected"'; ?>>Dark</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linktarget'); ?>">Link Target:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('linktarget'); ?>" name="<?php echo $this->get_field_name('linktarget'); ?>" value="<?php echo $instance['linktarget']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('rss_link'); ?>">RSS Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('rss_link'); ?>" name="<?php echo $this->get_field_name('rss_link'); ?>" value="<?php echo $instance['rss_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fb_link'); ?>">Facebook Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('fb_link'); ?>" name="<?php echo $this->get_field_name('fb_link'); ?>" value="<?php echo $instance['fb_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_link'); ?>">Twitter Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" value="<?php echo $instance['twitter_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('dribbble_link'); ?>">Dribbble Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('dribbble_link'); ?>" name="<?php echo $this->get_field_name('dribbble_link'); ?>" value="<?php echo $instance['dribbble_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('google_link'); ?>">Google+ Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('google_link'); ?>" name="<?php echo $this->get_field_name('google_link'); ?>" value="<?php echo $instance['google_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin_link'); ?>">LinkedIn Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" value="<?php echo $instance['linkedin_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('blogger_link'); ?>">Blogger Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('blogger_link'); ?>" name="<?php echo $this->get_field_name('blogger_link'); ?>" value="<?php echo $instance['blogger_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tumblr_link'); ?>">Tumblr Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('tumblr_link'); ?>" name="<?php echo $this->get_field_name('tumblr_link'); ?>" value="<?php echo $instance['tumblr_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('reddit_link'); ?>">Reddit Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('reddit_link'); ?>" name="<?php echo $this->get_field_name('reddit_link'); ?>" value="<?php echo $instance['reddit_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('yahoo_link'); ?>">Yahoo Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('yahoo_link'); ?>" name="<?php echo $this->get_field_name('yahoo_link'); ?>" value="<?php echo $instance['yahoo_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('deviantart_link'); ?>">Deviantart Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('deviantart_link'); ?>" name="<?php echo $this->get_field_name('deviantart_link'); ?>" value="<?php echo $instance['deviantart_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('vimeo_link'); ?>">Vimeo Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('vimeo_link'); ?>" name="<?php echo $this->get_field_name('vimeo_link'); ?>" value="<?php echo $instance['vimeo_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('youtube_link'); ?>">Youtube Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('youtube_link'); ?>" name="<?php echo $this->get_field_name('youtube_link'); ?>" value="<?php echo $instance['youtube_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('pinterest_link'); ?>">Pinterest Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('pinterest_link'); ?>" name="<?php echo $this->get_field_name('pinterest_link'); ?>" value="<?php echo $instance['pinterest_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('digg_link'); ?>">Digg Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('digg_link'); ?>" name="<?php echo $this->get_field_name('digg_link'); ?>" value="<?php echo $instance['digg_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr_link'); ?>">Flickr Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('flickr_link'); ?>" name="<?php echo $this->get_field_name('flickr_link'); ?>" value="<?php echo $instance['flickr_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('forrst_link'); ?>">Forrst Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('forrst_link'); ?>" name="<?php echo $this->get_field_name('forrst_link'); ?>" value="<?php echo $instance['forrst_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('myspace_link'); ?>">Myspace Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('myspace_link'); ?>" name="<?php echo $this->get_field_name('myspace_link'); ?>" value="<?php echo $instance['myspace_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('skype_link'); ?>">Skype Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('skype_link'); ?>" name="<?php echo $this->get_field_name('skype_link'); ?>" value="<?php echo $instance['skype_link']; ?>" />
		</p>
	<?php
	}
}
?>