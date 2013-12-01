<!DOCTYPE html>
<html xmlns="http<?php echo (is_ssl())? 's' : ''; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>

	<?php global $data; ?>

	<?php $theme_info = wp_get_theme(); ?>
	<!-- <?php echo $theme_info->get( 'Name' ) . " v" . $theme_info->get( 'Version' ); ?> -->

	<?php if($data['google_body'] && $data['google_body'] != 'Select Font'): ?>
	<?php $gfont[urlencode($data['google_body'])] = '"' . urlencode($data['google_body']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($data['google_nav'] && $data['google_nav'] != 'Select Font' && $data['google_nav'] != $data['google_body']): ?>
	<?php $gfont[urlencode($data['google_nav'])] = '"' . urlencode($data['google_nav']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($data['google_headings'] && $data['google_headings'] != 'Select Font' && $data['google_headings'] != $data['google_body'] && $data['google_headings'] != $data['google_nav']): ?>
	<?php $gfont[urlencode($data['google_headings'])] = '"' . urlencode($data['google_headings']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($data['google_footer_headings'] && $data['google_footer_headings'] != 'Select Font' && $data['google_footer_headings'] != $data['google_body'] && $data['google_footer_headings'] != $data['google_nav'] && $data['google_footer_headings'] != $data['google_headings']): ?>
	<?php $gfont[urlencode($data['google_footer_headings'])] = '"' . urlencode($data['google_footer_headings']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($gfont): ?>
	<?php
	if(is_array($gfont) && !empty($gfont)) {
		$gfonts = implode($gfont, ', ');
	}
	?>
	<?php endif; ?>
	<script type="text/javascript">
	WebFontConfig = {
		<?php if(!empty($gfonts)): ?>google: { families: [ <?php echo $gfonts; ?> ] },<?php endif; ?>
		custom: { families: ['FontAwesome'], urls: ['<?php bloginfo('template_directory'); ?>/fonts/fontawesome.css'] }
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})();
	</script>

	<?php
	wp_deregister_style( 'style-css' );
	wp_register_style( 'style-css', get_stylesheet_uri() );
	wp_enqueue_style( 'style-css' );
	?>
	<!--[if lte IE 8]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" />
	<![endif]-->

	<!--[if IE]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
	<![endif]-->

	<?php global $data,$woocommerce; ?>

	<?php
	if(is_page('header-2')) {
		$data['header_right_content'] = 'Social Links';
		if($data['scheme_type'] == 'Dark') {
			$data['header_top_bg_color'] = '#29292a';
			$data['header_icons_color'] = 'Light';
			$data['snav_color'] = '#ffffff';
			$data['header_top_first_border_color'] = '#3e3e3e';
		} else {
			$data['header_top_bg_color'] = '#ffffff';
			$data['header_icons_color'] = 'Dark';
			$data['snav_color'] = '#747474';
			$data['header_top_first_border_color'] = '#efefef';
		}
	} elseif(is_page('header-3')) {
		$data['header_right_content'] = 'Social Links';
	} elseif(is_page('header-4')) {
		$data['header_left_content'] = 'Social Links';
		$data['header_right_content'] = 'Navigation';
	} elseif(is_page('header-5')) {
		$data['header_right_content'] = 'Social Links';
	}
	?>
	<?php if($data['responsive']): ?>
	<?php $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	if(!$isiPad || !$data['ipad_potrait']): ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php endif; ?>
	<?php
	wp_deregister_style( 'media-css' );
	wp_register_style( 'media-css', get_bloginfo('template_directory').'/css/media.css', array(), null, 'all');
	wp_enqueue_style( 'media-css' );
	?>
		<?php if(!$data['ipad_potrait']): ?>
		<?php
		wp_deregister_style( 'ipad-css' );
		wp_register_style( 'ipad-css', get_bloginfo('template_directory').'/css/ipad.css', array(), null, 'all');
		wp_enqueue_style( 'ipad-css' );
		?>
		<?php else: ?>
		<style type="text/css">
		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
			#wrapper .ei-slider{width:100% !important;}
			body #header.sticky-header,body #header.sticky-header.sticky{display:none !important;}
		}
		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape){
			#wrapper .ei-slider{width:100% !important;}
			body #header.sticky-header,body #header.sticky-header.sticky{display:none !important;}
		}
		</style>
		<?php endif; ?>
	<?php else: ?>
		<style type="text/css">
		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px){
			#wrapper .ei-slider{width:100% !important;}
			body #header.sticky-header,body #header.sticky-header.sticky{display:none !important;}
		}
		</style>
		<?php $isiPhone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
		if($isiPhone):
		?>
		<style type="text/css">
		@media only screen and (min-device-width : 320px) and (max-device-width : 480px){
			#wrapper .ei-slider{width:100% !important;}
			body #header.sticky-header,body #header.sticky-header.sticky{display:none !important;}
		}
		</style>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(!$data['use_animate_css']): ?>
	<?php if(wp_is_mobile()): ?>
	<?php if(!$data['disable_mobile_animate_css']):
	    wp_deregister_style( 'animate-css' );
	    wp_register_style( 'animate-css', get_bloginfo('template_directory').'/css/animate-custom.css', array(), null, 'all');
		wp_enqueue_style( 'animate-css' );
	?>
	<style type="text/css">
	.animated { visibility:hidden; !important;}
	</style>
	<?php else: ?>
	<style type="text/css">
	.animated { visibility:visible; !important;}
	</style>
	<?php endif; ?>
	<?php else:
	    wp_deregister_style( 'animate-css' );
	    wp_register_style( 'animate-css', get_bloginfo('template_directory').'/css/animate-custom.css', array(), null, 'all');
		wp_enqueue_style( 'animate-css' );
	?>
	<style type="text/css">
	.animated { visibility:hidden; !important;}
	</style>
	<?php endif; ?>
	<?php else: ?>
	<style type="text/css">
	.animated { visibility:visible; !important;}
	</style>
	<?php endif; ?>

	<!--[if lt IE 10]>
	<style type="text/css">
	.animated { visibility:visible; !important;}
	</style>
	<![endif]-->

	<?php if(wp_is_mobile()): ?>
	<?php if(!$data['status_totop_mobile']): ?>
	<style type="text/css">
	#toTop {display: none !important;}
	</style>
	<?php else: ?>
	<style type="text/css">
	#toTop {bottom: 30px !important; border-radius: 4px !important; height: 48px; padding-top:0; line-height:48px; z-index: 10000;}
	#toTop:hover {background-color: #333333 !important;}
	</style>
	<?php endif; ?>
	<?php endif; ?>

	<?php if(wp_is_mobile() && $data['mobile_slidingbar_widgets']): ?>
	<style type="text/css">
	#slidingbar-area{display:none !important;}
	</style>
	<?php endif; ?>

	<?php if(wp_is_mobile()): ?>
	<style type="text/css">
	body #header.sticky-header,body #header.sticky-header.sticky{display:none !important;}
	</style>
	<?php endif; ?>

	<?php if($data['favicon']): ?>
	<link rel="shortcut icon" href="<?php echo $data['favicon']; ?>" type="image/x-icon" />
	<?php endif; ?>

	<?php if($data['iphone_icon']): ?>
	<!-- For iPhone -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $data['iphone_icon']; ?>">
	<?php endif; ?>

	<?php if($data['iphone_icon_retina']): ?>
	<!-- For iPhone 4 Retina display -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $data['iphone_icon_retina']; ?>">
	<?php endif; ?>

	<?php if($data['ipad_icon']): ?>
	<!-- For iPad -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $data['ipad_icon']; ?>">
	<?php endif; ?>

	<?php if($data['ipad_icon_retina']): ?>
	<!-- For iPad Retina display -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $data['ipad_icon_retina']; ?>">
	<?php endif; ?>

	<?php wp_head(); ?>

	<?php
	if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
		(get_option('page_for_posts') && is_archive() && !is_post_type_archive())) {
		$c_pageID = get_option('page_for_posts');
	} else {
		$c_pageID = $post->ID;

		if(class_exists('Woocommerce')) {
			if(is_shop()) {
				$c_pageID = get_option('woocommerce_shop_page_id');
			}
		}
	}
	?>

	<!--[if lte IE 8]>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	var imgs, i, w;
	var imgs = document.getElementsByTagName( 'img' );
	for( i = 0; i < imgs.length; i++ ) {
	    w = imgs[i].getAttribute( 'width' );
	    imgs[i].removeAttribute( 'width' );
	    imgs[i].removeAttribute( 'height' );
	}
	});
	</script>
	<![endif]-->
	<script type="text/javascript">
	/*@cc_on
	  @if (@_jscript_version == 10)
	    document.write('<style type="text/css">.search input{padding-left:5px;}header .tagline{margin-top:3px !important;}</style>');
	  @end
	@*/
	function insertParam(url, parameterName, parameterValue, atStart){
	    replaceDuplicates = true;
	    if(url.indexOf('#') > 0){
	        var cl = url.indexOf('#');
	        urlhash = url.substring(url.indexOf('#'),url.length);
	    } else {
	        urlhash = '';
	        cl = url.length;
	    }
	    sourceUrl = url.substring(0,cl);

	    var urlParts = sourceUrl.split("?");
	    var newQueryString = "";

	    if (urlParts.length > 1)
	    {
	        var parameters = urlParts[1].split("&");
	        for (var i=0; (i < parameters.length); i++)
	        {
	            var parameterParts = parameters[i].split("=");
	            if (!(replaceDuplicates && parameterParts[0] == parameterName))
	            {
	                if (newQueryString == "")
	                    newQueryString = "?";
	                else
	                    newQueryString += "&";
	                newQueryString += parameterParts[0] + "=" + (parameterParts[1]?parameterParts[1]:'');
	            }
	        }
	    }
	    if (newQueryString == "")
	        newQueryString = "?";

	    if(atStart){
	        newQueryString = '?'+ parameterName + "=" + parameterValue + (newQueryString.length>1?'&'+newQueryString.substring(1):'');
	    } else {
	        if (newQueryString !== "" && newQueryString != '?')
	            newQueryString += "&";
	        newQueryString += parameterName + "=" + (parameterValue?parameterValue:'');
	    }
	    return urlParts[0] + newQueryString + urlhash;
	};

	function ytVidId(url) {
	  var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	  return (url.match(p)) ? RegExp.$1 : false;
	  //return (url.match(p)) ? true : false;
	}

	jQuery(document).ready(function() {
		jQuery('.portfolio-wrapper').hide();
	});
	jQuery(window).load(function() {
		if(jQuery('#sidebar').is(':visible')) {
			jQuery('.post-content div.portfolio').each(function() {
				var columns = jQuery(this).data('columns');
				jQuery(this).addClass('portfolio-'+columns+'-sidebar');
			});
		}
		jQuery('.full-video, .video-shortcode, .wooslider .slide-content').fitVids();

		if(jQuery().isotope) {
			  // modified Isotope methods for gutters in masonry
			  jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
			    var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
			        containerWidth = this.element.width();

			    this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
			                  // or use the size of the first item
			                  this.$filteredAtoms.outerWidth(true) ||
			                  // if there's no items, use size of container
			                  containerWidth;

			    this.masonry.columnWidth += gutter;

			    this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
			    this.masonry.cols = Math.max( this.masonry.cols, 1 );
			  };

			  jQuery.Isotope.prototype._masonryReset = function() {
			    // layout-specific props
			    this.masonry = {};
			    // FIXME shouldn't have to call this again
			    this._getMasonryGutterColumns();
			    var i = this.masonry.cols;
			    this.masonry.colYs = [];
			    while (i--) {
			      this.masonry.colYs.push( 0 );
			    }
			  };

			  jQuery.Isotope.prototype._masonryResizeChanged = function() {
			    var prevSegments = this.masonry.cols;
			    // update cols/rows
			    this._getMasonryGutterColumns();
			    // return if updated cols/rows is not equal to previous
			    return ( this.masonry.cols !== prevSegments );
			  };

			imagesLoaded(jQuery('.portfolio-one .portfolio-wrapper'), function() {
				jQuery('.portfolio-wrapper').fadeIn();
				jQuery('.portfolio-one .portfolio-wrapper').isotope({
					// options
					itemSelector: '.portfolio-item',
					layoutMode: 'straightDown',
					transformsEnabled: false
				});
			});

			imagesLoaded(jQuery('.portfolio-two .portfolio-wrapper, .portfolio-three .portfolio-wrapper, .portfolio-four .portfolio-wrapper'),function() {
				jQuery('.portfolio-wrapper').fadeIn();
				jQuery('.portfolio-two .portfolio-wrapper, .portfolio-three .portfolio-wrapper, .portfolio-four .portfolio-wrapper').isotope({
					// options
					itemSelector: '.portfolio-item',
					layoutMode: 'fitRows',
					transformsEnabled: false
				});
			});

			var masonryContainer = jQuery('.portfolio-masonry .portfolio-wrapper');
			imagesLoaded(masonryContainer, function() {
				jQuery('.portfolio-wrapper').fadeIn();
				var gridTwo = masonryContainer.parent().hasClass('portfolio-grid-2');
				var columns;
				if(gridTwo) {
					columns = 2;
				} else {
					columns = 3;
				}
				masonryContainer.isotope({
					// options
					itemSelector: '.portfolio-item',
					layoutMode: 'masonry',
					transformsEnabled: false,
					masonry: { columnWidth: masonryContainer.width() / columns }
				});
			});
		}

		if(jQuery().flexslider) {
			var WooThumbWidth = 100;
			if(jQuery('body.woocommerce #sidebar').is(':visible')) {
				wooThumbWidth = 100;
			} else {
				wooThumbWidth = 118;
			}

			jQuery('.woocommerce .images #carousel').flexslider({
				animation: 'slide',
				controlNav: false,
				directionNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: wooThumbWidth,
				itemMargin: 9,
				touch: false,
				useCSS: false,
				asNavFor: '.woocommerce .images #slider'
			});

			jQuery('.woocommerce .images #slider').flexslider({
				animation: 'slide',
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				smoothHeight: true,
				touch: true,
				useCSS: false,
				sync: '.woocommerce .images #carousel'
			});

			var iframes = jQuery('iframe');
			var avada_ytplayer;

			jQuery.each(iframes, function(i, v) {
				var src = jQuery(this).attr('src');
				if(src) {
					<?php if(!$data['status_vimeo']): ?>
					if(src.indexOf('vimeo') >= 1) {
						jQuery(this).attr('id', 'player_'+(i+1));
						var new_src = insertParam(src, 'api', '1', false);
						var new_src_2 = insertParam(new_src, 'player_id', 'player_'+(i+1), false);

						jQuery(this).attr('src', new_src_2);
					}
					<?php endif; ?>
					<?php if(!$data['status_yt']): ?>
					if(ytVidId(src)) {
						jQuery(this).parent().wrap('<span class="play3" />');
						window.yt_vid_exists = true;
					}
					<?php endif; ?>
				}
			});

			<?php if(!$data['status_yt']): ?>
			if(window.yt_vid_exists == true) {
				var tag = document.createElement('script');
				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

				function getFrameID(id){
				    var elem = document.getElementById(id);
				    if (elem) {
				        if(/^iframe$/i.test(elem.tagName)) return id; //Frame, OK
				        // else: Look for frame
				        var elems = elem.getElementsByTagName("iframe");
				        if (!elems.length) return null; //No iframe found, FAILURE
				        for (var i=0; i<elems.length; i++) {
				           if (/^https?:\/\/(?:www\.)?youtube(?:-nocookie)?\.com(\/|$)/i.test(elems[i].src)) break;
				        }
				        elem = elems[i]; //The only, or the best iFrame
				        if (elem.id) return elem.id; //Existing ID, return it
				        // else: Create a new ID
				        do { //Keep postfixing `-frame` until the ID is unique
				            id += "-frame";
				        } while (document.getElementById(id));
				        elem.id = id;
				        return id;
				    }
				    // If no element, return null.
				    return null;
				}

				// Define YT_ready function.
				var YT_ready = (function() {
				    var onReady_funcs = [], api_isReady = false;
				    /* @param func function     Function to execute on ready
				     * @param func Boolean      If true, all qeued functions are executed
				     * @param b_before Boolean  If true, the func will added to the first
				                                 position in the queue*/
				    return function(func, b_before) {
				        if (func === true) {
				            api_isReady = true;
				            while (onReady_funcs.length) {
				                // Removes the first func from the array, and execute func
				                onReady_funcs.shift()();
				            }
				        } else if (typeof func == "function") {
				            if (api_isReady) func();
				            else onReady_funcs[b_before?"unshift":"push"](func);
				        }
				    }
				})();
				// This function will be called when the API is fully loaded
				function onYouTubePlayerAPIReady() {YT_ready(true)}
			}
			<?php endif; ?>

			<?php if(!$data['status_vimeo']): ?>
			function ready(player_id) {
			    var froogaloop = $f(player_id);

			    froogaloop.addEvent('play', function(data) {
			    	jQuery('#'+player_id).parents('li').parent().parent().flexslider("pause");
			    });

			    froogaloop.addEvent('pause', function(data) {
			        jQuery('#'+player_id).parents('li').parent().parent().flexslider("play");
			    });
			}

			var vimeoPlayers = jQuery('.flexslider').find('iframe'), player;

			for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
		        player = vimeoPlayers[i];
		        $f(player).addEvent('ready', ready);
			}

			function addEvent(element, eventName, callback) {
			    if (element.addEventListener) {
			        element.addEventListener(eventName, callback, false)
			    } else {
			        element.attachEvent(eventName, callback, false);
			    }
			}
			<?php endif; ?>

			jQuery('.tfs-slider').flexslider({
				animation: "<?php if($data['tfs_animation']) { echo $data['tfs_animation']; } else { echo 'fade'; } ?>",
				slideshow: <?php if($data['tfs_autoplay']) { echo 'true'; } else { echo 'false'; } ?>,
				slideshowSpeed: <?php if($data['tfs_slideshow_speed']) { echo $data['tfs_slideshow_speed']; } else { echo '7000'; } ?>,
				animationSpeed: <?php if($data['tfs_animation_speed']) { echo $data['tfs_animation_speed']; } else { echo '600'; } ?>,
				smoothHeight: true,
				pauseOnHover: false,
				useCSS: false,
				video: true,
				start: function(slider) {
			        if(typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>
			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
				},
			    before: function(slider) {
			        if(slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			        	<?php if(!$data['status_vimeo']): ?>
			           $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
			           <?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>

			           /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
			           playVideoAndPauseOthers(slider);
			       }
			    },
			   	after: function(slider) {
			        if(slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
			    }
			});

			<?php //var_dump($c_pageID); ?>
            jQuery('.grid-layout .flexslider').flexslider({
                slideshow: <?php if($data["slideshow_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
                slideshowSpeed: <?php if($data['slideshow_speed']) { echo $data['slideshow_speed']; } else { echo '7000'; } ?>,
                video: true,
                smoothHeight: false,
                pauseOnHover: false,
                useCSS: false,
                <?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) == 'auto' && get_post_meta($c_pageID, 'pyre_width', true) == 'half'): ?>smoothHeight: true,<?php endif; ?>
                start: function(slider) {
                    if (typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                        <?php if($data['pagination_video_slide']): ?>
                        jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                        <?php else: ?>
                        jQuery(slider).find('.flex-control-nav').hide();
                        <?php endif; ?>

                        <?php if(!$data['status_yt']): ?>
                        YT_ready(function() {
                            new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                                events: {
                                    'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                                }
                            });
                        });
                        <?php endif; ?>
                    } else {
                        <?php if($data['pagination_video_slide']): ?>
                        jQuery(slider).find('.flex-control-nav').css('bottom', '0');
                        <?php else: ?>
                        jQuery(slider).find('.flex-control-nav').show();
                        <?php endif; ?>
                    }
                },
                before: function(slider) {
                    if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                        <?php if(!$data['status_vimeo']): ?>$f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');<?php endif; ?>
                        <?php if(!$data['status_yt']): ?>
                        YT_ready(function() {
                            new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                                events: {
                                    'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                                }
                            });
                        });
                        <?php endif; ?>

                        /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
                        playVideoAndPauseOthers(slider);
                    }
                },
                after: function(slider) {
                    if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                        <?php if($data['pagination_video_slide']): ?>
                        jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                        <?php else: ?>
                        jQuery(slider).find('.flex-control-nav').hide();
                        <?php endif; ?>
                        <?php if(!$data['status_yt']): ?>
                        YT_ready(function() {
                            new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                                events: {
                                    'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                                }
                            });
                        });
                        <?php endif; ?>
                    } else {
                        <?php if($data['pagination_video_slide']): ?>
                        jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
                        <?php else: ?>
                        jQuery(slider).find('.flex-control-nav').show();
                        <?php endif; ?>
                    }
                }
            });
			jQuery('.flexslider').flexslider({
				slideshow: <?php if($data["slideshow_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
				slideshowSpeed: <?php if($data['slideshow_speed']) { echo $data['slideshow_speed']; } else { echo '7000'; } ?>,
				video: true,
				smoothHeight: <?php if($data["slideshow_smooth_height"]) { echo 'true'; } else { echo 'false'; } ?>,
				pauseOnHover: false,
				useCSS: false,
				<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) == 'auto' && get_post_meta($c_pageID, 'pyre_width', true) == 'half'): ?>smoothHeight: true,<?php endif; ?>
				start: function(slider) {
			        if (typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
				},
			    before: function(slider) {
			        if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if(!$data['status_vimeo']): ?>$f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');<?php endif; ?>
			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>

			           /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
			           playVideoAndPauseOthers(slider);
			       }
			    },
			   	after: function(slider) {
			        if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>
			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
			    }
			});

			function playVideoAndPauseOthers(slider) {
				jQuery(slider).find('iframe').each(function(i) {
					var func = 'stopVideo';
					this.contentWindow.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
				});
			}

			/* ------------------ PREV & NEXT BUTTON FOR FLEXSLIDER (YOUTUBE) ------------------ */
			jQuery('.flex-next, .flex-prev').click(function() {
				playVideoAndPauseOthers(jQuery(this).parents('.flexslider, .tfs-slider'));
			});

			function onPlayerStateChange(frame, slider) {
				return function(event) {
			        if(event.data == YT.PlayerState.PLAYING) {
			            jQuery(slider).flexslider("pause");
			        }
			        if(event.data == YT.PlayerState.PAUSED) {
			        	jQuery(slider).flexslider("play");
			        }
		    	}
			}
		}

		if(jQuery().isotope) {
			var gridwidth = (jQuery('.grid-layout').width() / 2) - 22;
			jQuery('.grid-layout .post').css('width', gridwidth);
			jQuery('.grid-layout').isotope({
				layoutMode: 'masonry',
				itemSelector: '.post',
				transformsEnabled: false,
				masonry: {
					columnWidth: gridwidth,
					gutterWidth: 40
				},
			});

			var gridwidth = (jQuery('.grid-full-layout').width() / 3) - 30;
			jQuery('.grid-full-layout .post').css('width', gridwidth);
			jQuery('.grid-full-layout').isotope({
				layoutMode: 'masonry',
				itemSelector: '.post',
				transformsEnabled: false,
				masonry: {
					columnWidth: gridwidth,
					gutterWidth: 40
				},
			});
		}

		jQuery('.rev_slider_wrapper').each(function() {
			if(jQuery(this).length >=1 && jQuery(this).find('.tp-bannershadow').length == 0) {
				jQuery('<div class="shadow-left">').appendTo(this);
				jQuery('<div class="shadow-right">').appendTo(this);

				jQuery(this).addClass('avada-skin-rev');
			}
		});

		jQuery('.tparrows').each(function() {
			if(jQuery(this).css('visibility') == 'hidden') {
				jQuery(this).remove();
			}
		});
	});
	jQuery(document).ready(function() {
		function onAfter(curr, next, opts, fwd) {
		  var $ht = jQuery(this).height();

		  //set the container's height to that of the current slide
		  jQuery(this).parent().css('height', $ht);
		}
		if(jQuery().cycle) {
		    jQuery('.reviews').cycle({
				fx: 'fade',
				after: onAfter,
				<?php if($data['testimonials_speed']): ?>
				timeout: <?php echo $data['testimonials_speed']; ?>
				<?php endif; ?>
			});
		}
	});
	jQuery(window).load(function($) {
		jQuery('.header-social .menu > li').height(jQuery('.header-social').height());
		jQuery('.header-social .menu > li').css('line-height', jQuery('.header-social').height()+'px');
		jQuery('.header-social .menu > li.cart').css('line-height', jQuery('.header-social').height()+'px');


		if(jQuery().prettyPhoto) {
			var ppArgs = {
				<?php if($data["lightbox_animation_speed"]): ?>
				animation_speed: '<?php echo strtolower($data["lightbox_animation_speed"]); ?>',
				<?php endif; ?>
				overlay_gallery: <?php if($data["lightbox_gallery"]) { echo 'true'; } else { echo 'false'; } ?>,
				autoplay_slideshow: <?php if($data["lightbox_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
				<?php if($data["lightbox_slideshow_speed"]): ?>
				slideshow: <?php echo $data['lightbox_slideshow_speed']; ?>,
				<?php endif; ?>
				<?php if($data["lightbox_opacity"]): ?>
				opacity: <?php echo $data['lightbox_opacity']; ?>,
				<?php endif; ?>
				show_title: <?php if($data["lightbox_title"]) { echo 'true'; } else { echo 'false'; } ?>,
				show_desc: <?php if($data["lightbox_desc"]) { echo 'true'; } else { echo 'false'; } ?>,
				<?php if(!$data["lightbox_social"]) { echo 'social_tools: "",'; } ?>
			};

			jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs);

			<?php if($data['lightbox_post_images']): ?>
			jQuery('.single-post .post-content a').has('img').prettyPhoto(ppArgs);
			<?php endif; ?>

			jQuery('.lightbox-enabled a').has('img').prettyPhoto(ppArgs);

			var mediaQuery = 'desk';

			if (Modernizr.mq('only screen and (max-width: 600px)') || Modernizr.mq('only screen and (max-height: 520px)')) {

				mediaQuery = 'mobile';
				jQuery("a[rel^='prettyPhoto']").unbind('click');
				<?php if($data['lightbox_post_images']): ?>
				jQuery('.single-post .post-content a').has('img').unbind('click');
				<?php endif; ?>
				jQuery('.lightbox-enabled a').has('img').unbind('click');
			}

			// Disables prettyPhoto if screen small
			jQuery(window).on('resize', function() {
				if ((Modernizr.mq('only screen and (max-width: 600px)') || Modernizr.mq('only screen and (max-height: 520px)')) && mediaQuery == 'desk') {
					jQuery("a[rel^='prettyPhoto']").unbind('click.prettyphoto');
					<?php if($data['lightbox_post_images']): ?>
					jQuery('.single-post .post-content a').has('img').unbind('click.prettyphoto');
					<?php endif; ?>
					jQuery('.lightbox-enabled a').has('img').unbind('click.prettyphoto');
					mediaQuery = 'mobile';
				} else if (!Modernizr.mq('only screen and (max-width: 600px)') && !Modernizr.mq('only screen and (max-height: 520px)') && mediaQuery == 'mobile') {
					jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs);
					<?php if($data['lightbox_post_images']): ?>
					jQuery('.single-post .post-content a').has('img').prettyPhoto(ppArgs);
					<?php endif; ?>
					jQuery('.lightbox-enabled a').has('img').prettyPhoto(ppArgs);
					mediaQuery = 'desk';
				}
			});
		}
		<?php if($data['sidenav_behavior'] == 'Click'): ?>
		jQuery('.side-nav li a').live('click', function(e) {
			if(jQuery(this).find('.arrow').length >= 1) {
				if(jQuery(this).parent().find('> .children').length >= 1 && !$(this).parent().find('> .children').is(':visible')) {
					jQuery(this).parent().find('> .children').stop(true, true).slideDown('slow');
				} else {
					jQuery(this).parent().find('> .children').stop(true, true).slideUp('slow');
				}
			}

			if(jQuery(this).find('.arrow').length >= 1) {
				return false;
			}
		});
		<?php else: ?>
		jQuery('.side-nav li').hoverIntent({
		over: function() {
			if(jQuery(this).find('> .children').length >= 1) {
				jQuery(this).find('> .children').stop(true, true).slideDown('slow');
			}
		},
		out: function() {
			if(jQuery(this).find('.current_page_item').length == 0 && jQuery(this).hasClass('current_page_item') == false) {
				jQuery(this).find('.children').stop(true, true).slideUp('slow');
			}
		},
		timeout: 500
		});
		<?php endif; ?>

		if(jQuery().eislideshow) {
	        jQuery('#ei-slider').eislideshow({
	        	<?php if($data["tfes_animation"]): ?>
	        	animation: '<?php echo $data["tfes_animation"]; ?>',
	        	<?php endif; ?>
	        	autoplay: <?php if($data["tfes_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
	        	<?php if($data["tfes_interval"]): ?>
	        	slideshow_interval: <?php echo $data['tfes_interval']; ?>,
	        	<?php endif; ?>
	        	<?php if($data["tfes_speed"]): ?>
	        	speed: <?php echo $data['tfes_speed']; ?>,
	        	<?php endif; ?>
	        	<?php if($data["tfes_width"]): ?>
	        	thumbMaxWidth: <?php echo $data['tfes_width']; ?>
	        	<?php endif; ?>
	        });
    	}

        var retina = window.devicePixelRatio > 1 ? true : false;

        <?php if($data['custom_icon_image_retina']): ?>
        if(retina) {
        	jQuery('.social-networks li.custom').each(function() {
        		jQuery(this).find('img').attr('src', '<?php echo $data["custom_icon_image_retina"]; ?>');
	        	jQuery(this).find('img').attr('width', '<?php echo $data["retina_icon_width"]; ?>');
	        	jQuery(this).find('img').attr('height', '<?php echo $data["retina_icon_height"]; ?>');
        	})
        }
        <?php endif; ?>

        /* wpml flag in center */
		var wpml_flag = jQuery('ul#nav > li > a > .iclflag');
		var wpml_h = wpml_flag.height();
		wpml_flag.css('margin-top', +wpml_h / - 2 + "px");

		var wpml_flag = jQuery('.top-menu > ul > li > a > .iclflag');
		var wpml_h = wpml_flag.height();
		wpml_flag.css('margin-top', +wpml_h / - 2 + "px");

		<?php if($data['blog_pagination_type'] == 'Infinite Scroll' || is_page_template('demo-gridblog.php')  || is_page_template('demo-timelineblog.php')): ?>
		jQuery('#posts-container').infinitescroll({
		    navSelector  : "div.pagination",
		                   // selector for the paged navigation (it will be hidden)
		    nextSelector : "a.pagination-next",
		                   // selector for the NEXT link (to page 2)
		    itemSelector : "div.post",
		                   // selector for all items you'll retrieve
		    errorCallback: function() {
		    	jQuery('#posts-container').isotope('reLayout');
		    }
		}, function(posts) {
			if(jQuery().isotope) {
				//jQuery(posts).css('position', 'relative').css('top', 'auto').css('left', 'auto');

				jQuery(posts).hide();
				imagesLoaded(posts, function() {
					jQuery(posts).fadeIn();
					jQuery('#posts-container').isotope('appended', jQuery(posts));
					jQuery('#posts-container').isotope('reLayout');
				});

				var gridwidth = (jQuery('.grid-layout').width() / 2) - 22;
				jQuery('.grid-layout .post').css('width', gridwidth);

				var gridwidth = (jQuery('.grid-full-layout').width() / 3) - 30;
				jQuery('.grid-full-layout .post').css('width', gridwidth);

				jQuery('#posts-container').isotope('reLayout');
			}

			jQuery('.flexslider').flexslider({
				slideshow: <?php if($data["slideshow_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
				slideshowSpeed: <?php if($data['slideshow_speed']) { echo $data['slideshow_speed']; } else { echo '7000'; } ?>,
				video: true,
				pauseOnHover: false,
				useCSS: false,
				start: function(slider) {
			        if (typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
				},
			    before: function(slider) {
			        if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if(!$data['status_vimeo']): ?>$f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');<?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>

			           /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
			           playVideoAndPauseOthers(slider);
			       }
			    },
			   	after: function(slider) {
			        if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>
			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
			    }
			});
			if(jQuery().prettyPhoto) { jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs); }
			jQuery(posts).each(function() {
				jQuery(this).find('.full-video, .video-shortcode, .wooslider .slide-content').fitVids();
			});

			if(jQuery().isotope) {
				jQuery('#posts-container').isotope('reLayout');
			}
		});
		<?php endif; ?>

		jQuery('#posts-container-infinite').infinitescroll({
		    navSelector  : "div.pagination",
		                   // selector for the paged navigation (it will be hidden)
		    nextSelector : "a.pagination-next",
		                   // selector for the NEXT link (to page 2)
		    itemSelector : "div.post",
		                   // selector for all items you'll retrieve
		    errorCallback: function() {
		    	jQuery('#posts-container').isotope('reLayout');
		    }
		}, function(posts) {
			if(jQuery().isotope) {
				//jQuery(posts).css('top', 'auto').css('left', 'auto');

				jQuery(posts).hide();
				imagesLoaded(posts, function() {
					jQuery(posts).fadeIn();
					jQuery('#posts-container-infinite').isotope('appended', jQuery(posts));
					jQuery('#posts-container-infinite').isotope('reLayout');
				});

				var gridwidth = (jQuery('.grid-layout').width() / 2) - 22;
				jQuery('.grid-layout .post').css('width', gridwidth);

				var gridwidth = (jQuery('.grid-full-layout').width() / 3) - 30;
				jQuery('.grid-full-layout .post').css('width', gridwidth);

				jQuery('#posts-container-infinite').isotope('reLayout');
			}

			jQuery('.flexslider').flexslider({
				slideshow: <?php if($data["slideshow_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
				slideshowSpeed: <?php if($data['slideshow_speed']) { echo $data['slideshow_speed']; } else { echo '7000'; } ?>,
				video: true,
				pauseOnHover: false,
				useCSS: false,
				start: function(slider) {
			        if (typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
				},
			    before: function(slider) {
			        if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if(!$data['status_vimeo']): ?>$f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');<?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>

			           /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
			           playVideoAndPauseOthers(slider);
			       }
			    },
			   	after: function(slider) {
			        if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').hide();
			           <?php endif; ?>

			           <?php if(!$data['status_yt']): ?>
						YT_ready(function() {
							new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
								events: {
									'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
								}
							});
						});
						<?php endif; ?>
			       } else {
			           <?php if($data['pagination_video_slide']): ?>
			           jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
			           <?php else: ?>
			           jQuery(slider).find('.flex-control-nav').show();
			           <?php endif; ?>
			       }
			    }
			});
			if(jQuery().prettyPhoto) { jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs); }
			jQuery(posts).each(function() {
				jQuery(this).find('.full-video, .video-shortcode, .wooslider .slide-content').fitVids();
			});

			if(jQuery().isotope) {
				jQuery('#posts-container-infinite').isotope('reLayout');
			}
		});

		<?php if($data['grid_pagination_type'] == 'Infinite Scroll'): ?>
		jQuery('.portfolio-masonry .portfolio-wrapper').infinitescroll({
		   	//behavior: 'local',
		    //binder: jQuery('.portfolio-infinite .portfolio-wrapper'),
		    navSelector  : "div.pagination",
		                   // selector for the paged navigation (it will be hidden)
		    nextSelector : "a.pagination-next",
		                   // selector for the NEXT link (to page 2)
		    itemSelector : "div.portfolio-item",
		                   // selector for all items you'll retrieve
		    errorCallback: function() {
		    	//jQuery('.portfolio-masonry .portfolio-wrapper').isotope('reLayout');
		    },
		    contentSelector: jQuery('.portfolio-masonry .portfolio-wrapper'),
		}, function(posts) {
			if(jQuery().isotope) {
				//jQuery(posts).css('position', 'relative').css('top', 'auto').css('left', 'auto');

				jQuery(posts).hide();

				imagesLoaded(jQuery(posts), function() {
					jQuery(posts).fadeIn();

					jQuery('.portfolio-masonry .portfolio-wrapper').isotope('appended', jQuery(posts));

					if(jQuery().prettyPhoto) { jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs); }

					jQuery(posts).each(function() {
						jQuery(this).find('.full-video, .video-shortcode, .wooslider .slide-content').fitVids();
					});

					jQuery('.portfolio-masonry .portfolio-wrapper').isotope('reLayout');
				});

				//});

				/*var gridwidth = (jQuery('.grid-layout').width() / 2) - 22;
				jQuery('.grid-layout .post').css('width', gridwidth);

				var gridwidth = (jQuery('.grid-full-layout').width() / 3) - 30;
				jQuery('.grid-full-layout .post').css('width', gridwidth);*/

				//jQuery('.portfolio-masonry .portfolio-wrapper').isotope('reLayout');
			}
		});
		<?php endif; ?>
	});
	</script>

	<style type="text/css">
	<?php if($data['primary_color']): ?>
	a:hover{
		color:<?php echo $data['primary_color']; ?>;
	}
	#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
	.footer-area ul li a:hover,
	#slidingbar-area ul li a:hover,
	.portfolio-tabs li.active a, .faq-tabs li.active a,
	.project-content .project-info .project-info-box a:hover,
	.about-author .title a,
	span.dropcap,.footer-area a:hover,#slidingbar-area a:hover,.copyright a:hover,
	#sidebar .widget_categories li a:hover,
	#main .post h2 a:hover,
	#sidebar .widget li a:hover,
	#nav ul a:hover,
	.date-and-formats .format-box i,
	h5.toggle:hover a,
	.tooltip-shortcode,.content-box-percentage,
	.more a:hover:after,.read-more:hover:after,.pagination-prev:hover:before,.pagination-next:hover:after,.bbp-topic-pagination .prev:hover:before,.bbp-topic-pagination .next:hover:after,
	.single-navigation a[rel=prev]:hover:before,.single-navigation a[rel=next]:hover:after,
	#sidebar .widget_nav_menu li a:hover:before,#sidebar .widget_categories li a:hover:before,
	#sidebar .widget .recentcomments:hover:before,#sidebar .widget_recent_entries li a:hover:before,
	#sidebar .widget_archive li a:hover:before,#sidebar .widget_pages li a:hover:before,
	#sidebar .widget_links li a:hover:before,.side-nav .arrow:hover:after,.woocommerce-tabs .tabs a:hover .arrow:after,
	.star-rating:before,.star-rating span:before,.price ins .amount,
	.price > .amount,.woocommerce-pagination .prev:hover,.woocommerce-pagination .next:hover,.woocommerce-pagination .prev:hover:before,.woocommerce-pagination .next:hover:after,
	.woocommerce-tabs .tabs li.active a,.woocommerce-tabs .tabs li.active a .arrow:after,
	#wrapper .cart-checkout a:hover,#wrapper .cart-checkout a:hover:before,
	.widget_shopping_cart_content .total .amount,.widget_layered_nav li a:hover:before,
	.widget_product_categories li a:hover:before,#header .my-account-link-active:after,.woocommerce-side-nav li.active a,.woocommerce-side-nav li.active a:after,.my_account_orders .order-number a,.shop_table .product-subtotal .amount,
	.cart_totals .total .amount,form.checkout .shop_table tfoot .total .amount,#final-order-details .mini-order-details tr:last-child .amount,.rtl .more a:hover:before,.rtl .read-more:hover:before,#header .my-cart-link-active:after,#wrapper #sidebar .current_page_item > a,#wrapper #sidebar .current-menu-item a,#wrapper #sidebar .current_page_item a:before,#wrapper #sidebar .current-menu-item a:before,#wrapper .footer-area .current_page_item a,#wrapper .footer-area .current-menu-item a,#wrapper .footer-area .current_page_item a:before,#wrapper .footer-area .current-menu-item a:before,#wrapper #slidingbar-area .current_page_item a,#wrapper #slidingbar-area .current-menu-item a,#wrapper #slidingbar-area .current_page_item a:before,#wrapper #slidingbar-area .current-menu-item a:before,.side-nav ul > li.current_page_item > a,.side-nav li.current_page_ancestor > a,
	.gform_wrapper span.ginput_total,.gform_wrapper span.ginput_product_price,.ginput_shipping_price,
	.bbp-topics-front ul.super-sticky a:hover, .bbp-topics ul.super-sticky a:hover, .bbp-topics ul.sticky a:hover, .bbp-forum-content ul.sticky a:hover{
		color:<?php echo $data['primary_color']; ?> !important;
	}
	.star-rating:before,.star-rating span:before {
		color:<?php echo $data['primary_color']; ?> !important;
	}
	.tagcloud a:hover,#slidingbar-area .tagcloud a:hover,.footer-area .tagcloud a:hover{ color: #FFFFFF !important; text-shadow: none !important; -moz-text-shadow: none !important; -webkit-text-shadow: none !important; }
	#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
	#nav ul ul,#nav li.current-menu-ancestor a,
	.reading-box,
	.portfolio-tabs li.active a, .faq-tabs li.active a,
	.tab-holder .tabs li.active a,
	.post-content blockquote,
	.progress-bar-content,
	.pagination .current,
	.bbp-topic-pagination .current,
	.pagination a.inactive:hover,
	#nav ul a:hover,.woocommerce-pagination .current,
	.tagcloud a:hover,#header .my-account-link:hover:after,body #header .my-account-link-active:after,
	#bbpress-forums div.bbp-topic-tags a:hover{
		border-color:<?php echo $data['primary_color']; ?> !important;
	}
	#nav li.current-menu-ancestor a {
		color: <?php echo $data['primary_color']; ?> !important;
	}
	.side-nav li.current_page_item a{
		border-right-color:<?php echo $data['primary_color']; ?> !important;
	}
	.rtl .side-nav li.current_page_item a{
		border-left-color:<?php echo $data['primary_color']; ?> !important;
	}
	.header-v2 .header-social, .header-v3 .header-social, .header-v4 .header-social,.header-v5 .header-social,.header-v2{
		border-top-color:<?php echo $data['primary_color']; ?> !important;
	}
	h5.toggle.active span.arrow,
	.post-content ul.circle-yes li:before,
	.progress-bar-content,
	.pagination .current,
	.bbp-topic-pagination .current,
	.header-v3 .header-social,.header-v4 .header-social,.header-v5 .header-social,
	.date-and-formats .date-box,.table-2 table thead,
	.onsale,.woocommerce-pagination .current,
	.woocommerce .social-share li a:hover i,
	.price_slider_wrapper .ui-slider .ui-slider-range,
	.tagcloud a:hover,.cart-loading,
	#toTop:hover,
	#bbpress-forums div.bbp-topic-tags a:hover,
	.main-nav-search-form input[type="submit"]:hover, .search-page-search-form input[type="submit"]:hover,
	ul.arrow li:before{
		background-color:<?php echo $data['primary_color']; ?> !important;
	}
	<?php if(wp_is_mobile()): ?>
	<?php if($data['status_totop_mobile']): ?>
	<style type="text/css">
	#toTop:hover {background-color: #333333 !important;}
	</style>
	<?php endif; ?>
	<?php endif; ?>
	.bbp-topics-front ul.super-sticky, .bbp-topics ul.super-sticky, .bbp-topics ul.sticky, .bbp-forum-content ul.sticky	{
		background-color: #ffffe8 !important;
		opacity: 1;
	}
	<?php endif; ?>

	<?php if($data['slidingbar_top_border']): ?>
	#slidingbar-area { border-bottom: 3px solid #363839; }
	.sb_toggle { bottom: -43px; }
	<?php endif; ?>

	<?php if($data['slidingbar_bg_color']):
	if($data['slidingbar_bg_color_transparency']) {
		$slidingbar_opacity = '0.95';
	} else {
		$slidingbar_opacity = '1';
	}
	$rgb = avada_hex2rgb($data['slidingbar_bg_color']);
	$rgba= "rgba(".$rgb[0].','.$rgb[1].','.$rgb[2].','.$slidingbar_opacity.')';
	?>
	#slidingbar {
		background-color:<?php echo $rgb ?> !important;
		background-color:<?php echo $rgba ?> !important;
	}
	.sb_toggle {
		border-color: transparent <?php echo $rgb ?> transparent transparent !important;
		border-color: transparent <?php echo $rgba ?> transparent transparent !important;
	}
	<?php if($data['slidingbar_top_border']): ?>
	#slidingbar-area {
		border-bottom: 3px solid <?php echo $rgb ?> !important;
		border-bottom: 3px solid <?php echo $rgba ?> !important;
	}
	.sb_toggle { bottom: -43px; }
	<?php endif; ?>
	<?php endif; ?>

	<?php if(!$data['main_nav_icon_circle']): ?>
		#header .my-cart-link:after, #header a.search-link:after,
		#small-nav .my-cart-link:after, #small-nav a.search-link:after{ border: none !important; }

	<?php endif; ?>

	<?php if($data['header_bg_color']): ?>
	<?php
	$header_bg_color_hex = avada_hex2rgb($data['header_bg_color']);
	?>
	#header,#small-nav,#header .login-box,#header .cart-contents,#small-nav .login-box,#small-nav .cart-contents{
		background-color:<?php echo $data['header_bg_color']; ?> !important;
	}
	body #header.sticky-header .sticky-shadow{background:rgba(<?php echo $header_bg_color_hex[0]; ?>, <?php echo $header_bg_color_hex[1]; ?>, <?php echo $header_bg_color_hex[2]; ?>, 0.97) !important;}
	.no-rgba body #header.sticky-header .sticky-shadow{background:<?php echo $data['header_bg_color']; ?>; filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0.97); opacity: 0.97;}
	#nav ul a{
		border-color:<?php echo $data['header_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['content_bg_color']): ?>
	#main,#wrapper{
		background-color:<?php echo $data['content_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['footer_bg_color']): ?>
	.footer-area{
		background-color:<?php echo $data['footer_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['footer_border_color']): ?>
	.footer-area{
		border-color:<?php echo $data['footer_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['copyright_bg_color']): ?>
	#footer{
		background-color:<?php echo $data['copyright_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['copyright_border_color']): ?>
	#footer{
		border-color:<?php echo $data['copyright_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['pricing_box_color']): ?>
	.sep-boxed-pricing ul li.title-row{
		background-color:<?php echo $data['pricing_box_color']; ?> !important;
		border-color:<?php echo $data['pricing_box_color']; ?> !important;
	}
	.pricing-row .exact_price, .pricing-row sup{
		color:<?php echo $data['pricing_box_color']; ?> !important;
	}
	<?php endif; ?>
	<?php if($data['image_gradient_top_color'] && $data['image_gradient_bottom_color']): ?>
	<?php
	$imgr_gtop = avada_hex2rgb($data['image_gradient_top_color']);
	$imgr_gbot = avada_hex2rgb($data['image_gradient_bottom_color']);
	if($data['image_rollover_opacity']) {
		$opacity = $data['image_rollover_opacity'];
	} else{
		$opacity = '1';
	}
	$imgr_gtop_string = 'rgba('.$imgr_gtop[0].','.$imgr_gtop[1].','.$imgr_gtop[2].','.$opacity.')';
	$imgr_gbot_string = 'rgba('.$imgr_gbot[0].','.$imgr_gbot[1].','.$imgr_gbot[2].','.$opacity.')';
	?>
	.image .image-extras{
		background-image: linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -o-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -moz-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -webkit-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -ms-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);

		background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, <?php echo $imgr_gtop_string; ?>),
			color-stop(1, <?php echo $imgr_gbot_string; ?>)
		);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['image_gradient_top_color']; ?>', endColorstr='<?php echo $data['image_gradient_bottom_color']; ?>')
				progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
	}
	.no-cssgradients .image .image-extras{
		background:<?php echo $data['image_gradient_top_color']; ?>;
	}
	.image:hover .image-extras {
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['image_gradient_top_color']; ?>', endColorstr='<?php echo $data['image_gradient_bottom_color']; ?>')
	 			progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
	 }
	<?php endif; ?>
	<?php if($data['button_gradient_top_color'] && $data['button_gradient_bottom_color'] && $data['button_gradient_text_color']): ?>
	#main .portfolio-one .button,
	#main .comment-submit,
	#reviews input#submit,
	.comment-form input[type="submit"],
	.wpcf7-form input[type="submit"],
	.bbp-submit-wrapper button,
	.button.default,
	.price_slider_amount button,
	.gform_wrapper .gform_button{
		background: <?php echo $data['button_gradient_bottom_color']; ?>;

		color: <?php echo $data['button_gradient_text_color']; ?> !important;
		background-image: linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
		background-image: -o-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
		background-image: -moz-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
		background-image: -webkit-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);
		background-image: -ms-linear-gradient(top, <?php echo $data['button_gradient_top_color']; ?> 0%, <?php echo $data['button_gradient_bottom_color']; ?> 100%);

		background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, <?php echo $data['button_gradient_top_color']; ?>),
			color-stop(1, <?php echo $data['button_gradient_bottom_color']; ?>)
		);
		border:1px solid <?php echo $data['button_gradient_bottom_color']; ?>;

		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['button_gradient_top_color']; ?>', endColorstr='<?php echo $data['button_gradient_bottom_color']; ?>');
	}
	.no-cssgradients #main .portfolio-one .button,
	.no-cssgradients #main .comment-submit,
	.no-cssgradients #reviews input#submit,
	.no-cssgradients .comment-form input[type="submit"],
	.no-cssgradients .wpcf7-form input[type="submit"],
	.no-cssgradients .bbp-submit-wrapper button,
	.no-cssgradients .button.default,
	.no-cssgradients .price_slider_amount button,
	.no-cssgradients .gform_wrapper .gform_button{
		background:<?php echo $data['button_gradient_top_color']; ?>;
	}
	#main .portfolio-one .button:hover,
	#main .comment-submit:hover,
	#reviews input#submit:hover,
	.comment-form input[type="submit"]:hover,
	.wpcf7-form input[type="submit"]:hover,
	.bbp-submit-wrapper button:hover,
	.button.default:hover,
	.price_slider_amount button:hover,
	.gform_wrapper .gform_button:hover{
		background: <?php echo $data['button_gradient_top_color']; ?>;
		color: <?php echo $data['button_gradient_text_color']; ?> !important;
		background-image: linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
		background-image: -o-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
		background-image: -moz-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
		background-image: -webkit-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);
		background-image: -ms-linear-gradient(top, <?php echo $data['button_gradient_bottom_color']; ?> 0%, <?php echo $data['button_gradient_top_color']; ?> 100%);

		background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, <?php echo $data['button_gradient_bottom_color']; ?>),
			color-stop(1, <?php echo $data['button_gradient_top_color']; ?>)
		);
		border:1px solid <?php echo $data['button_gradient_bottom_color']; ?>;

		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $data['button_gradient_bottom_color']; ?>', endColorstr='<?php echo $data['button_gradient_top_color']; ?>');
	}
	.no-cssgradients #main .portfolio-one .button:hover,
	.no-cssgradients #main .comment-submit:hover,
	.no-cssgradients #reviews input#submit:hover,
	.no-cssgradients .comment-form input[type="submit"]:hover,
	.no-cssgradients .wpcf7-form input[type="submit"]:hover,
	.no-cssgradients .bbp-submit-wrapper button:hover,
	.no-cssgradients .button.default,
	.no-cssgradients .price_slider_amount button:hover,
	.no-cssgradients .gform_wrapper .gform_button{
		background:<?php echo $data['button_gradient_bottom_color']; ?>;
	}
	<?php endif; ?>

	<?php if($data['layout'] == 'Boxed' || get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'boxed'): ?>
	body{
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $data['bg_color']; ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php elseif($data['bg_image']): ?>
		background-image:url(<?php echo $data['bg_image']; ?>);
		background-repeat:<?php echo $data['bg_repeat']; ?>;
			<?php if($data['bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if($data['bg_pattern_option'] && $data['bg_pattern'] && !(get_post_meta($c_pageID, 'pyre_page_bg_color', true) || get_post_meta($c_pageID, 'pyre_page_bg', true))): ?>
		background-image:url("<?php echo get_bloginfo('template_directory') . '/images/patterns/' . $data['bg_pattern'] . '.png'; ?>");
		background-repeat:repeat;
		<?php endif; ?>
	}
	#wrapper{
		background:#fff;
		width:1000px;
		margin:0 auto;
	}
	.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_custom_subheader', true) != ''): ?>
	.page-title ul {line-height: 40px;}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true)): ?>
	.page-title-container{
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true); ?>) !important;
	}
	<?php elseif($data['page_title_bg']): ?>
	.page-title-container{
		background-image:url(<?php echo $data['page_title_bg']; ?>) !important;
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true)): ?>
	.page-title-container{
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true); ?>;
	}
	<?php elseif($data['page_title_bg_color']): ?>
	.page-title-container{
		background-color:<?php echo $data['page_title_bg_color']; ?>;
	}
	<?php endif; ?>

	<?php if($data['page_title_border_color']): ?>
	.page-title-container{border-color:<?php echo $data['page_title_border_color']; ?> !important;}
	<?php endif; ?>

	#header{
		<?php if($data['header_bg_image']): ?>
		background-image:url(<?php echo $data['header_bg_image']; ?>);
		background-repeat:<?php echo $data['header_bg_repeat']; ?>;
			<?php if($data['header_bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}

	#header{
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_header_bg_color', true); ?> !important;
		<?php endif; ?>
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_header_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_header_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_header_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}

	#main{
		<?php if($data['content_bg_image'] && !get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): ?>
		background-image:url(<?php echo $data['content_bg_image']; ?>);
		background-repeat:<?php echo $data['content_bg_repeat']; ?>;
			<?php if($data['content_bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}

	#main{
		<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true); ?> !important;
		<?php endif; ?>
		<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}

	.footer-area{
		<?php if($data['footerw_bg_image']): ?>
		background-image:url(<?php echo $data['footerw_bg_image']; ?>);
		background-repeat:<?php echo $data['footerw_bg_repeat']; ?>;
			<?php if($data['footerw_bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}

	.page-title-container{
		<?php if($data['page_title_bg_full']): ?>
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_full', true) == 'yes'): ?>
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		<?php elseif(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_full', true) == 'no'): ?>
		-webkit-background-size: auto;
		-moz-background-size: auto;
		-o-background-size: auto;
		background-size: auto;
		<?php endif; ?>

		<?php if($data['page_title_bg_parallax']): ?>
		background-attachment: fixed;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_title_bg_parallax', true) == 'yes'): ?>
		background-attachment: fixed;
		<?php elseif(get_post_meta($c_pageID, 'pyre_page_title_bg_parallax', true) == 'no'): ?>
		background-attachment: scroll;
		<?php endif; ?>

	}

	<?php if($data['icon_circle_color']): ?>
	.fontawesome-icon.circle-yes{
		background-color:<?php echo $data['icon_circle_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['icon_border_color']): ?>
	.fontawesome-icon.circle-yes{
		border-color:<?php echo $data['icon_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['icon_color']): ?>
	.fontawesome-icon{
		color:<?php echo $data['icon_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['title_border_color']): ?>
	.title-sep,.product .product-border{
		border-color:<?php echo $data['title_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['testimonial_bg_color']): ?>
	.review blockquote q,.post-content blockquote,form.checkout .payment_methods .payment_box{
		background-color:<?php echo $data['testimonial_bg_color']; ?> !important;
	}
	.review blockquote div:after{
		border-top-color:<?php echo $data['testimonial_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['testimonial_text_color']): ?>
	.review blockquote q,.post-content blockquote{
		color:<?php echo $data['testimonial_text_color']; ?> !important;
	}
	<?php endif; ?>

	<?php
	if(
		$data['custom_font_woff'] && $data['custom_font_ttf'] &&
		$data['custom_font_svg'] && $data['custom_font_eot']
	):
	?>
	@font-face {
		font-family: 'MuseoSlab500Regular';
		src: url('<?php echo $data['custom_font_eot']; ?>');
		src:
			url('<?php echo $data['custom_font_eot']; ?>?#iefix') format('eot'),
			url('<?php echo $data['custom_font_woff']; ?>') format('woff'),
			url('<?php echo $data['custom_font_ttf']; ?>') format('truetype'),
			url('<?php echo $data['custom_font_svg']; ?>#MuseoSlab500Regular') format('svg');
	    font-weight: 400;
	    font-style: normal;
	}
	<?php $custom_font = true; endif; ?>

	<?php
	if($data['google_body'] != 'Select Font') {
		$font = '"'.$data['google_body'].'", Arial, Helvetica, sans-serif !important';
	} elseif($data['standard_body'] != 'Select Font') {
		$font = $data['standard_body'].' !important';
	}
	?>

	body,#nav ul li ul li a,
	.more,
	.avada-container h3,
	.meta .date,
	.review blockquote q,
	.review blockquote div strong,
	.image .image-extras .image-extras-content h4,
	.image .image-extras .image-extras-content h4 a,
	.project-content .project-info h4,
	.post-content blockquote,
	.button.large,
	.button.small,
	.ei-title h3,.cart-contents,
	.comment-form input[type="submit"],
	.wpcf7-form input[type="submit"],
	.gform_wrapper .gform_button,
	.woocommerce-success-message .button,
	.page-title h3{
		font-family:<?php echo $font; ?>;
	}
	.avada-container h3,
	.review blockquote div strong,
	.footer-area  h3,
	#slidingbar-area  h3,
	.button.large,
	.button.small,
	.comment-form input[type="submit"],
	.wpcf7-form input[type="submit"],
	.gform_wrapper .gform_button{
		font-weight:bold;
	}
	.meta .date,
	.review blockquote q,
	.post-content blockquote{
		font-style:italic;
	}

	<?php
	if(!$custom_font && $data['google_nav'] != 'Select Font') {
		$nav_font = '"'.$data['google_nav'].'", Arial, Helvetica, sans-serif !important';
	} elseif(!$custom_font && $data['standard_nav'] != 'Select Font') {
		$nav_font = $data['standard_nav'].' !important';
	}
	if(isset($nav_font)):
	?>

	#nav,
	.side-nav li a{
		font-family:<?php echo $nav_font; ?>;
	}
	<?php endif; ?>

	<?php
	if(!$custom_font && $data['google_headings'] != 'Select Font') {
		$headings_font = '"'.$data['google_headings'].'", Arial, Helvetica, sans-serif !important';
	} elseif(!$custom_font && $data['standard_headings'] != 'Select Font') {
		$headings_font = $data['standard_headings'].' !important';
	}
	if(isset($headings_font)):
	?>

	#main .reading-box h2,
	#main h2,
	.page-title h1,
	.image .image-extras .image-extras-content h3,
	#main .post h2,
	#sidebar .widget h3,
	.tab-holder .tabs li a,
	.share-box h4,
	.project-content h3,
	.author .author_title,
	h5.toggle a,
	.full-boxed-pricing ul li.title-row,
	.full-boxed-pricing ul li.pricing-row,
	.sep-boxed-pricing ul li.title-row,
	.sep-boxed-pricing ul li.pricing-row,
	.person-author-wrapper,
	.post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6,
	.ei-title h2, #header .tagline,
	table th,.project-content .project-info h4,
	.woocommerce-success-message .msg,.product-title{
		font-family:<?php echo $headings_font; ?>;
	}
	<?php endif; ?>

	<?php
	if($data['google_footer_headings'] != 'Select Font') {
		$font = '"'.$data['google_footer_headings'].'", Arial, Helvetica, sans-serif !important';
	} elseif($data['standard_footer_headings'] != 'Select Font') {
		$font = $data['standard_footer_headings'].' !important';
	}
	?>

	.footer-area  h3,#slidingbar-area  h3{
		font-family:<?php echo $font; ?>;
	}

	<?php if($data['body_font_size']): ?>
	body,#sidebar .slide-excerpt h2, .footer-area .slide-excerpt h2,#slidingbar-area .slide-excerpt h2{
		font-size:<?php echo $data['body_font_size']; ?>px;
		<?php
		$line_height = round((1.5 * $data['body_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px;
	}
	.project-content .project-info h4,.gform_wrapper label,.gform_wrapper .gfield_description{
		font-size:<?php echo $data['body_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['body_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['body_font_lh']): ?>
	body,#sidebar .slide-excerpt h2, .footer-area .slide-excerpt h2,#slidingbar-area .slide-excerpt h2{
		line-height:<?php echo $data['body_font_lh']; ?>px !important;
	}
	.project-content .project-info h4{
		line-height:<?php echo $data['body_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['nav_font_size']): ?>
	#nav{font-size:<?php echo $data['nav_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['snav_font_size']): ?>
	.header-social *{font-size:<?php echo $data['snav_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['breadcrumbs_font_size']): ?>
	.page-title ul li,page-title ul li a{font-size:<?php echo $data['breadcrumbs_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['side_nav_font_size']): ?>
	.side-nav li a{font-size:<?php echo $data['side_nav_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['sidew_font_size']): ?>
	#sidebar .widget h3{font-size:<?php echo $data['sidew_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['slidingbar_font_size']): ?>
	#slidingbar-area h3{font-size:<?php echo $data['slidingbar_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['footw_font_size']): ?>
	.footer-area h3{font-size:<?php echo $data['footw_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['copyright_font_size']): ?>
	.copyright{font-size:<?php echo $data['copyright_font_size']; ?>px !important;}
	<?php endif; ?>

	<?php if($data['responsive']): ?>
	#header .avada-row, #main .avada-row, .footer-area .avada-row,#slidingbar-area .avada-row, #footer .avada-row{ max-width:940px; }
	<?php endif; ?>

	<?php if($data['h1_font_size']): ?>
	.post-content h1{
		font-size:<?php echo $data['h1_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['h1_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h1_font_lh']): ?>
	.post-content h1{
		line-height:<?php echo $data['h1_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h2_font_size']): ?>
	.post-content h2,.title h2,#main .post-content .title h2,.page-title h1,#main .post h2 a{
		font-size:<?php echo $data['h2_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['h2_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h2_font_lh']): ?>
	.post-content h2,.title h2,#main .post-content .title h2,.page-title h1,#main .post h2 a{
		line-height:<?php echo $data['h2_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h3_font_size']): ?>
	.post-content h3,.project-content h3,#header .tagline,.product-title{
		font-size:<?php echo $data['h3_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['h3_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h3_font_lh']): ?>
	.post-content h3,.project-content h3,#header .tagline,.product-title{
		line-height:<?php echo $data['h3_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h4_font_size']): ?>
	.post-content h4{
		font-size:<?php echo $data['h4_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['h4_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	h5.toggle a,.tab-holder .tabs li a,.share-box h4,.person-author-wrapper{
		font-size:<?php echo $data['h4_font_size']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h4_font_lh']): ?>
	.post-content h4{
		line-height:<?php echo $data['h4_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h5_font_size']): ?>
	.post-content h5{
		font-size:<?php echo $data['h5_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['h5_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h5_font_lh']): ?>
	.post-content h5{
		line-height:<?php echo $data['h5_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h6_font_size']): ?>
	.post-content h6{
		font-size:<?php echo $data['h6_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['h6_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['h6_font_lh']): ?>
	.post-content h6{
		line-height:<?php echo $data['h6_font_lh']; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['es_title_font_size']): ?>
	.ei-title h2{
		font-size:<?php echo $data['es_title_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['es_title_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['es_caption_font_size']): ?>
	.ei-title h3{
		font-size:<?php echo $data['es_caption_font_size']; ?>px !important;
		<?php
		$line_height = round((1.5 * $data['es_caption_font_size']));
		?>
		line-height:<?php echo $line_height; ?>px !important;
	}
	<?php endif; ?>

	<?php if($data['body_text_color']): ?>
	body,.post .post-content,.post-content blockquote,.tab-holder .news-list li .post-holder .meta,#sidebar #jtwt,.meta,.review blockquote div,.search input,.project-content .project-info h4,.title-row,.simple-products-slider .price .amount,.quantity .qty,.quantity .minus,.quantity .plus{color:<?php echo $data['body_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['h1_color']): ?>
	.post-content h1,.title h1,.woocommerce-success-message .msg{
		color:<?php echo $data['h1_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['h2_color']): ?>
	.post-content h2,.title h2,.woocommerce-tabs h2{
		color:<?php echo $data['h2_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['h3_color']): ?>
	.post-content h3,#sidebar .widget h3,.project-content h3,.title h3,#header .tagline,.person-author-wrapper span,.product-title{
		color:<?php echo $data['h3_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['h4_color']): ?>
	.post-content h4,.project-content .project-info h4,.share-box h4,.title h4,.tab-holder .tabs li a{
		color:<?php echo $data['h4_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['h5_color']): ?>
	.post-content h5,h5.toggle a,.title h5{
		color:<?php echo $data['h5_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['h6_color']): ?>
	.post-content h6,.title h6{
		color:<?php echo $data['h6_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['page_title_color']): ?>
	.page-title h1{
		color:<?php echo $data['page_title_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['headings_color']): ?>
	/*.post-content h1, .post-content h2, .post-content h3,
	.post-content h4, .post-content h5, .post-content h6,
	#sidebar .widget h3,h5.toggle a,
	.page-title h1,.full-boxed-pricing ul li.title-row,
	.project-content .project-info h4,.project-content h3,.share-box h4,.title h2,.person-author-wrapper,#sidebar .tab-holder .tabs li a,#header .tagline,
	.table-1 table th{
		color:<?php echo $data['headings_color']; ?> !important;
	}*/
	<?php endif; ?>

	<?php if($data['sep_pricing_box_heading_color']): ?>
	.sep-boxed-pricing ul li.title-row{
		color:<?php echo $data['sep_pricing_box_heading_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['full_boxed_pricing_box_heading_color']): ?>
	.full-boxed-pricing ul li.title-row{
		color:<?php echo $data['full_boxed_pricing_box_heading_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['link_color']): ?>
	body a{color:<?php echo $data['link_color']; ?>;}
	.project-content .project-info .project-info-box a,#sidebar .widget li a, #sidebar .widget .recentcomments, #sidebar .widget_categories li, #main .post h2 a,
	.shop_attributes tr th,.image-extras a,.products-slider .price .amount,z.my_account_orders thead tr th,.shop_table thead tr th,.cart_totals table th,form.checkout .shop_table tfoot th,form.checkout .payment_methods label,#final-order-details .mini-order-details th,#main .product .product_title{color:<?php echo $data['link_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['breadcrumbs_text_color']): ?>
	.page-title ul li,.page-title ul li a{color:<?php echo $data['breadcrumbs_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['slidingbar_headings_color']): ?>
	#slidingbar-area h3{color:<?php echo $data['slidingbar_headings_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['slidingbar_text_color']): ?>
	#slidingbar-area,#slidingbar-area #jtwt,#slidingbar-area #jtwt .jtwt_tweet{color:<?php echo $data['slidingbar_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['slidingbar_link_color']): ?>
	#slidingbar-area a{color:<?php echo $data['slidingbar_link_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['footer_headings_color']): ?>
	.footer-area h3{color:<?php echo $data['footer_headings_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['footer_text_color']): ?>
	.footer-area,.footer-area #jtwt,.footer-area #jtwt .jtwt_tweet,.copyright{color:<?php echo $data['footer_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['footer_link_color']): ?>
	.footer-area a,.copyright a{color:<?php echo $data['footer_link_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['menu_first_color']): ?>
	#nav ul a,.side-nav li a,#header .cart-content a,#header .cart-content a:hover,#small-nav .cart-content a,#small-nav .cart-content a:hover,#wrapper .header-social .top-menu .cart > a,#wrapper .header-social .top-menu .cart > a > .amount{color:<?php echo $data['menu_first_color']; ?> !important;}
	#header .my-account-link:after{border-color:<?php echo $data['menu_first_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['menu_hover_first_color']): ?>
	#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
	#nav ul ul,#nav li.current-menu-ancestor a,	#nav ul li a:hover{color:<?php echo $data['menu_hover_first_color']; ?> !important;border-color:<?php echo $data['menu_hover_first_color']; ?> !important;}
	#nav ul ul{border-color:<?php echo $data['menu_hover_first_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['menu_sub_bg_color']): ?>
	#nav ul ul{background-color:<?php echo $data['menu_sub_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($data['menu_sub_color']): ?>
	#wrapper #nav ul li ul li a,.side-nav li li a,.side-nav li.current_page_item li a{color:<?php echo $data['menu_sub_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['es_title_color']): ?>
	.ei-title h2{color:<?php echo $data['es_title_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['es_caption_color']): ?>
	.ei-title h3{color:<?php echo $data['es_caption_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['snav_color']): ?>
	#wrapper .header-social *{color:<?php echo $data['snav_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['sep_color']): ?>
	.sep-single{background-color:<?php echo $data['sep_color']; ?> !important;}
	.sep-double,.sep-dashed,.sep-dotted,.search-page-search-form{border-color:<?php echo $data['sep_color']; ?> !important;}
	.ls-avada, .avada-skin-rev,.clients-carousel .es-carousel li img,h5.toggle a,.progress-bar,
	#small-nav,.portfolio-tabs,.faq-tabs,.single-navigation,.project-content .project-info .project-info-box,
	.post .meta-info,.grid-layout .post,.grid-layout .post .content-sep,
	.grid-layout .post .flexslider,.timeline-layout .post,.timeline-layout .post .content-sep,
	.timeline-layout .post .flexslider,h3.timeline-title,.timeline-arrow,
	.counter-box-wrapper,.table-2 table thead,.table-2 tr td,
	#sidebar .widget li a,#sidebar .widget .recentcomments,#sidebar .widget_categories li,
	.tab-holder,.commentlist .the-comment,
	.side-nav,#wrapper .side-nav li a,.rtl .side-nav,h5.toggle.active + .toggle-content,
	#wrapper .side-nav li.current_page_item li a,.tabs-vertical .tabset,
	.tabs-vertical .tabs-container .tab_content,.page-title-container,.pagination a.inactive,.woocommerce-pagination .page-numbers,.bbp-topic-pagination .page-numbers,.rtl .woocommerce .social-share li,.author .author_social{border-color:<?php echo $data['sep_color']; ?>;}
	.side-nav li a,.product_list_widget li,.widget_layered_nav li,.price_slider_wrapper,.tagcloud a,#header .cart-content a,#header .cart-content a:hover,#header .login-box,#header .cart-contents,#small-nav .login-box,#small-nav .cart-contents,#small-nav .cart-content a,#small-nav .cart-content a:hover,
	#customer_login_box,.myaccount_user,.myaccount_user_container span,
	.woocommerce-side-nav li a,.woocommerce-content-box,.woocommerce-content-box h2,.my_account_orders tr,.woocommerce .address h4,.shop_table tr,.cart_totals .total,.chzn-container-single .chzn-single,.chzn-container-single .chzn-single div,.chzn-drop,form.checkout .shop_table tfoot,.input-radio,#final-order-details .mini-order-details tr:last-child,p.order-info,.cart-content a img,.panel.entry-content,.woocommerce-tabs .tabs li a,.woocommerce .social-share,.woocommerce .social-share li,.quantity,.quantity .minus, .quantity .qty,.shop_attributes tr,.woocommerce-success-message{border-color:<?php echo $data['sep_color']; ?> !important;}
	.price_slider_wrapper .ui-widget-content{background-color:<?php echo $data['sep_color']; ?>;}
	.gform_wrapper .gsection{border-bottom:1px dotted <?php echo $data['sep_color']; ?>;}
	<?php endif; ?>

	<?php if($data['qty_bg_color']): ?>
	.quantity .minus,.quantity .plus{background-color:<?php echo $data['qty_bg_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['qty_bg_hover_color']): ?>
	.quantity .minus:hover,.quantity .plus:hover{background-color:<?php echo $data['qty_bg_hover_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['slidingbar_divider_color']): ?>
	#slidingbar-area .widget_categories li a, #slidingbar-area li.recentcomments, #slidingbar-area ul li a, #slidingbar-area .product_list_widget li {border-bottom: 1px solid <?php echo $data['slidingbar_divider_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['footer_divider_color']): ?>
	.footer-area .widget_categories li a, .footer-area li.recentcomments, .footer-area ul li a, .footer-area .product_list_widget li {border-bottom: 1px solid <?php echo $data['footer_divider_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['form_bg_color']): ?>
	input#s,#comment-input input,#comment-textarea textarea,.comment-form-comment textarea,.input-text,.wpcf7-form .wpcf7-text,.wpcf7-form .wpcf7-quiz,.wpcf7-form .wpcf7-number,.wpcf7-form textarea,.wpcf7-form .wpcf7-select,.wpcf7-select-parent .select-arrow,.wpcf7-captchar,.wpcf7-form .wpcf7-date,.gform_wrapper .gfield input[type=text],.gform_wrapper .gfield textarea,.gform_wrapper .gfield select,#bbpress-forums #bbp-search-form #bbp_search,.bbp-reply-form input#bbp_topic_tags,.bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select,#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,.main-nav-search-form input,.search-page-search-form input,.chzn-container-single .chzn-single,.chzn-container .chzn-drop{background-color:<?php echo $data['form_bg_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['form_text_color']): ?>
	input#s,input#s .placeholder,#comment-input input,#comment-textarea textarea,#comment-input .placeholder,#comment-textarea .placeholder,.comment-form-comment textarea,.input-text,.wpcf7-form .wpcf7-text,.wpcf7-form .wpcf7-quiz,.wpcf7-form .wpcf7-number,.wpcf7-form textarea,.wpcf7-form .wpcf7-select,.wpcf7-select-parent .select-arrow,.wpcf7-captchar,.wpcf7-form .wpcf7-date,.gform_wrapper .gfield input[type=text],.gform_wrapper .gfield textarea,.gform_wrapper .gfield select,#bbpress-forums #bbp-search-form #bbp_search,.bbp-reply-form input#bbp_topic_tags,.bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select,#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,.chzn-container-single .chzn-single,.chzn-container .chzn-drop{color:<?php echo $data['form_text_color']; ?> !important;}
	input#s::-webkit-input-placeholder,#comment-input input::-webkit-input-placeholder,#comment-textarea textarea::-webkit-input-placeholder,.comment-form-comment textarea::-webkit-input-placeholder,.input-text::-webkit-input-placeholder{color:<?php echo $data['form_text_color']; ?> !important;}
	input#s:-moz-placeholder,#comment-input input:-moz-placeholder,#comment-textarea textarea:-moz-placeholder,.comment-form-comment textarea:-moz-placeholder,.input-text:-moz-placeholder{color:<?php echo $data['form_text_color']; ?> !important;}
	input#s:-ms-input-placeholder,#comment-input input:-ms-input-placeholder,#comment-textarea textarea:-moz-placeholder,.comment-form-comment textarea:-ms-input-placeholder,.input-text:-ms-input-placeholder,.main-nav-search-form input,.search-page-search-form input{color:<?php echo $data['form_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['form_border_color']): ?>
	input#s,#comment-input input,#comment-textarea textarea,.comment-form-comment textarea,.input-text,.wpcf7-form .wpcf7-text,.wpcf7-form .wpcf7-quiz,.wpcf7-form .wpcf7-number,.wpcf7-form textarea,.wpcf7-form .wpcf7-select,.wpcf7-select-parent .select-arrow,.wpcf7-captchar,.wpcf7-form .wpcf7-date,.gform_wrapper .gfield input[type=text],.gform_wrapper .gfield textarea,.gform_wrapper .gfield_select[multiple=multiple],.gform_wrapper .gfield select,.select-arrow,
	#bbpress-forums #bbp-search-form #bbp_search,.bbp-reply-form input#bbp_topic_tags,.bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select,#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,#wp-bbp_topic_content-editor-container,#wp-bbp_reply_content-editor-container,.main-nav-search-form input,.search-page-search-form input,.chzn-container-single .chzn-single,.chzn-container .chzn-drop{border-color:<?php echo $data['form_border_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['menu_sub_sep_color']): ?>
	#wrapper #nav ul li ul li a{border-bottom:1px solid <?php echo $data['menu_sub_sep_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['menu_bg_hover_color']): ?>
	#wrapper #nav ul li ul li a:hover, #wrapper #nav ul li ul li.current-menu-item a,#header .cart-content a:hover,#small-nav .cart-content a:hover{background-color:<?php echo $data['menu_bg_hover_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['tagline_font_color']): ?>
	#header .tagline{
		color:<?php echo $data['tagline_font_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['tagline_font_size']): ?>
	#header .tagline{
		font-size:<?php echo $data['tagline_font_size']; ?>px !important;
		line-height:30px !important;
	}
	<?php endif; ?>

	<?php if($data['page_title_font_size']): ?>
	.page-title h1{
		font-size:<?php echo $data['page_title_font_size']; ?>px !important;
		line-height:normal !important;
	}
	<?php endif; ?>

	<?php if($data['page_title_subheader_font_size']): ?>
		.page-title h3{;
			font-size:<?php echo $data['page_title_subheader_font_size']; ?>px !important;
			line-height: <?php echo intval($data['page_title_subheader_font_size']) + 12;?>px !important;
		}
	<?php endif; ?>

	<?php if($data['header_border_color']): ?>
	.header-social,#header,.header-v4 #small-nav,.header-v5 #small-nav{
		border-bottom-color:<?php echo $data['header_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['dropdown_menu_width']): ?>
	#nav ul ul{
		width:<?php echo $data['dropdown_menu_width']; ?> !important;
	}
	#nav ul ul li:hover ul{
		left:<?php echo $data['dropdown_menu_width']; ?> !important;
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_height', true)): ?>
	.page-title-container{
		height:<?php echo get_post_meta($c_pageID, 'pyre_page_title_height', true); ?> !important;
	}
	<?php elseif($data['page_title_height']): ?>
	.page-title-container{
		height:<?php echo $data['page_title_height']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['sidebar_bg_color']): ?>
	#main #sidebar{
		background-color:<?php echo $data['sidebar_bg_color']; ?>;
	}
	<?php endif; ?>

	<?php if($data['content_width']): ?>
	#main #content{
		width:<?php echo $data['content_width']; ?>%;
	}
	<?php endif; ?>

	<?php if($data['sidebar_width']): ?>
	#main #sidebar{
		width:<?php echo $data['sidebar_width']; ?>%;
	}
	<?php endif; ?>

	<?php if($data['sidebar_padding']): ?>
	#main #sidebar{
		padding-left:<?php echo $data['sidebar_padding']; ?>%;
		padding-right:<?php echo $data['sidebar_padding']; ?>%;
	}
	<?php endif; ?>

	<?php if($data['header_top_bg_color']): ?>
	#wrapper .header-social{
		background-color:<?php echo $data['header_top_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['header_top_first_border_color']): ?>
	#wrapper .header-social .menu > li{
		border-color:<?php echo $data['header_top_first_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['header_top_sub_bg_color']): ?>
	#wrapper .header-social .menu .sub-menu,#wrapper .header-social .login-box,#wrapper .header-social .cart-contents,.main-nav-search-form{
		background-color:<?php echo $data['header_top_sub_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['header_top_menu_sub_color']): ?>
	#wrapper .header-social .menu .sub-menu li, #wrapper .header-social .menu .sub-menu li a,#wrapper .header-social .login-box *,#wrapper .header-social .cart-contents *{
		color:<?php echo $data['header_top_menu_sub_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['header_top_menu_bg_hover_color']): ?>
	#wrapper .header-social .menu .sub-menu li a:hover{
		background-color:<?php echo $data['header_top_menu_bg_hover_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['header_top_menu_sub_hover_color']): ?>
	#wrapper .header-social .menu .sub-menu li a:hover{
		color:<?php echo $data['header_top_menu_sub_hover_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['header_top_menu_sub_sep_color']): ?>
	#wrapper .header-social .menu .sub-menu,#wrapper .header-social .menu .sub-menu li,.top-menu .cart-content a,#wrapper .header-social .login-box,#wrapper .header-social .cart-contents,.main-nav-search-form{
		border-color:<?php echo $data['header_top_menu_sub_sep_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['woo_cart_bg_color']): ?>
	#header .cart-checkout,.top-menu .cart,.top-menu .cart-content a:hover,.top-menu .cart-checkout,#small-nav .cart-checkout{
		background-color:<?php echo $data['woo_cart_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($data['accordian_inactive_color']): ?>
	h5.toggle span.arrow{background-color:<?php echo $data['accordian_inactive_color']; ?>;}
	<?php endif; ?>

	<?php if($data['counter_filled_color']): ?>
	.progress-bar-content{background-color:<?php echo $data['counter_filled_color']; ?> !important;border-color:<?php echo $data['counter_filled_color']; ?> !important;}
	.content-box-percentage{color:<?php echo $data['counter_filled_color']; ?> !important;}
	<?php endif; ?>

	<?php if($data['counter_unfilled_color']): ?>
	.progress-bar{background-color:<?php echo $data['counter_unfilled_color']; ?>;border-color:<?php echo $data['counter_unfilled_color']; ?>;}
	<?php endif; ?>

	<?php if($data['dates_box_color']): ?>
	.date-and-formats .format-box{background-color:<?php echo $data['dates_box_color']; ?>;}
	<?php endif; ?>

	<?php if($data['carousel_nav_color']): ?>
	.es-nav-prev,.es-nav-next{background-color:<?php echo $data['carousel_nav_color']; ?>;}
	<?php endif; ?>

	<?php if($data['carousel_hover_color']): ?>
	.es-nav-prev:hover,.es-nav-next:hover{background-color:<?php echo $data['carousel_hover_color']; ?>;}
	<?php endif; ?>

	<?php if($data['content_box_bg_color']): ?>
	.content-boxes .col{background-color:<?php echo $data['content_box_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($data['tabs_bg_color'] && $data['tabs_inactive_color']): ?>
	#sidebar .tab-holder,#sidebar .tab-holder .news-list li{border-color:<?php echo $data['tabs_inactive_color']; ?> !important;}
	.pyre_tabs .tabs-container{background-color:<?php echo $data['tabs_bg_color']; ?> !important;}
	body #sidebar .tab-hold .tabs li{border-right:1px solid <?php echo $data['tabs_bg_color']; ?> !important;}
	body #sidebar .tab-hold .tabs li a{background:<?php echo $data['tabs_inactive_color']; ?> !important;border-bottom:0 !important;color:<?php echo $data[body_text_color]; ?> !important;}
	body #sidebar .tab-hold .tabs li a:hover{background:<?php echo $data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
	body #sidebar .tab-hold .tabs li.active a{background:<?php echo $data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
	body #sidebar .tab-hold .tabs li.active a{border-top-color:<?php echo $data[primary_color]; ?>!important;}
	<?php endif; ?>

	<?php if($data['social_bg_color']): ?>
	.share-box{background-color:<?php echo $data['social_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($data['timeline_bg_color']): ?>
	.grid-layout .post,.timeline-layout .post{background-color:<?php echo $data['timeline_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($data['timeline_color']): ?>
	.grid-layout .post .flexslider,.timeline-layout .post,.timeline-layout .post .content-sep,
	.timeline-layout .post .flexslider,h3.timeline-title,.grid-layout .post,.grid-layout .post .content-sep,.products li,.product-details-container,.product-buttons,.product-buttons-container{border-color:<?php echo $data['timeline_color']; ?> !important;}
	.align-left .timeline-arrow:before,.align-left .timeline-arrow:after{border-left-color:<?php echo $data['timeline_color']; ?> !important;}
	.align-right .timeline-arrow:before,.align-right .timeline-arrow:after{border-right-color:<?php echo $data['timeline_color']; ?> !important;}
	.timeline-circle,.timeline-title{background-color:<?php echo $data['timeline_color']; ?> !important;}
	.timeline-icon{color:<?php echo $data['timeline_color']; ?>;}
	<?php endif; ?>

	<?php if($data['bbp_forum_header_bg']): ?>
		#bbpress-forums li.bbp-header,
		#bbpress-forums div.bbp-reply-header,#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,div.bbp-template-notice, div.indicator-hint{ background:<?php echo $data['bbp_forum_header_bg']; ?> !important; }
		#bbpress-forums .bbp-replies div.even { background: transparent !important; }
	<?php endif; ?>

	<?php if($data['bbp_forum_border_color']): ?>
		#bbpress-forums ul.bbp-lead-topic, #bbpress-forums ul.bbp-topics, #bbpress-forums ul.bbp-forums, #bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results,
		#bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic,
		#bbpress-forums div.bbp-reply-content,#bbpress-forums div.bbp-reply-header,
		#bbpress-forums div.bbp-reply-author .bbp-reply-post-date,
		#bbpress-forums div.bbp-topic-tags a,#bbpress-forums #bbp-single-user-details,div.bbp-template-notice, div.indicator-hint
		.bbp-arrow{ border-color:<?php echo $data['bbp_forum_border_color']; ?> !important; }
	<?php endif; ?>

	<?php
	$avada_color_scheme = 'light';
	if($data['scheme_type'] == 'Dark'): $avada_color_scheme = 'dark'; ?>
	<?php if($data['header_border_color']): ?>
	.header-v4 #small-nav,.header-v5 #small-nav{
		border-bottom-color:<?php echo $data['header_border_color']; ?> !important;
	}
	<?php endif; ?>
	body #header.sticky-header .sticky-shadow { -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.42);-mozbox-shadow: 0 1px 3px rgba(0, 0, 0, 0.42);box-shadow: 0 1px 3px rgba(0, 0, 0, 0.42);	}
	.products-slider .price .amount,.simple-products-slider .price .amount{color:#333333 !important;}
	.meta li{border-color:<?php echo $data['body_text_color']; ?>;}
	.error-image{background-image:url(<?php echo get_template_directory_uri(); ?>/images/404_image_dark.png);}
	.error_page .oops {color: #2F2F30 !important;}
	.review blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark.png);}
	.review.male blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark.png);}
	.review.female blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user-girl_dark.png);}
	.timeline-layout{background-image:url(<?php echo get_template_directory_uri(); ?>/images/timeline_line_dark.png);}
	.side-nav li a{background-image:url(<?php echo get_template_directory_uri(); ?>/images/side_nav_bg_dark.png);}
	@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi) {
		.error-image{background-image:url(<?php echo get_template_directory_uri(); ?>/images/404_image_dark@2x.png) !important;}
		.review blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark@2x.png) !important;}
		.review.male blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user_dark@2x.png) !important;}
		.review.female blockquote div .company-name{background-image:url(<?php echo get_template_directory_uri(); ?>/images/ico-user-girl_dark@2x.png) !important;}
		.side-nav li a{background-image:url(<?php echo get_template_directory_uri(); ?>/images/side_nav_bg_dark@2x.png) !important;}
	}
	.bbp-arrow { background-color:<?php echo $data['content_bg_color']; ?> !important; }
	#toTop { background-color: #111111; }
	<?php endif; ?>

	<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_width', true)): ?>
	<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) != 'auto' && get_post_meta($c_pageID, 'pyre_width', true) != 'half'): ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow {max-width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
	<?php else: ?>
	.post-slideshow .flex-control-nav{position:relative;text-align:left;margin-top:10px;}
	<?php endif; ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow img{max-width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
		<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) == 'auto'): ?>
		#post-<?php echo $c_pageID; ?> .post-slideshow img{width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?> !important;}
		<?php endif; ?>
	<?php endif; ?>

	<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_height', true)): ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow, #post-<?php echo $c_pageID; ?> .post-slideshow img{height:<?php echo get_post_meta($c_pageID, 'pyre_fimg_height', true); ?> !important;}
	<?php endif; ?>

	<?php if(!$data['flexslider_circles']): ?>
	.main-flex .flex-control-nav{display:none !important;}
	<?php endif; ?>

	<?php if(!$data['breadcrumb_mobile']): ?>
	@media only screen and (max-width: 940px){
		.breadcrumbs{display:none !important;}
	}
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
		.breadcrumbs{display:none !important;}
	}
	<?php endif; ?>

	<?php if(!$data['image_rollover']): ?>
	.image-extras{display:none !important;}
	<?php endif; ?>

	<?php if($data['nav_height']): ?>
	#nav > li > a,#nav li.current-menu-ancestor a{height:<?php echo $data['nav_height']; ?>px;line-height:<?php echo $data['nav_height']; ?>px;}
	#nav > li > a,#nav li.current-menu-ancestor a{height:<?php echo $data['nav_height']; ?>px;line-height:<?php echo $data['nav_height']; ?>px;}
	#nav ul ul{top:<?php echo $data['nav_height']+3; ?>px;}

	<?php if(is_page('header-4') || is_page('header-5')) { ?>
	#nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}
	#nav > li > a,#nav li.current-menu-ancestor a{height:40px;line-height:40px;}

	#nav ul ul{top:43px;}
	<?php } ?>
	.sticky-header #nav > li > a.my-cart-link, .sticky-header #nav li.current-menu-ancestor a.my-cart-link {height:63px;line-height:63px;}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true)): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
		.page-title-container {
			background-image: url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true); ?>) !important;
			-webkit-background-size:cover;
			   -moz-background-size:cover;
			     -o-background-size:cover;
			        background-size:cover;
		}
	}
	<?php elseif($data['page_title_bg_retina']): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
		.page-title-container {
			background-image: url(<?php echo $data['page_title_bg_retina']; ?>) !important;
			-webkit-background-size:cover;
			   -moz-background-size:cover;
			     -o-background-size:cover;
			        background-size:cover;
		}
	}
	<?php endif; ?>

	<?php if($data['tfes_slider_width']): ?>
	.ei-slider{width:<?php echo $data['tfes_slider_width']; ?> !important;}
	<?php endif; ?>

	<?php if($data['tfes_slider_height']): ?>
	.ei-slider{height:<?php echo $data['tfes_slider_height']; ?> !important;}
	<?php endif; ?>

	<?php if($data['button_text_shadow']): ?>
	.button,.gform_wrapper .gform_button{text-shadow:none !important;}
	<?php endif; ?>

	<?php if($data['slidingbar_text_shadow']): ?>
	#slidingbar-area a{text-shadow:none !important;}
	<?php endif; ?>

	<?php if($data['footer_text_shadow']): ?>
	.footer-area a,.copyright{text-shadow:none !important;}
	<?php endif; ?>

	<?php if($data['tagline_bg']): ?>
	.reading-box{background-color:<?php echo $data['tagline_bg']; ?> !important;}
	<?php endif; ?>

	.isotope .isotope-item {
	  -webkit-transition-property: top, left, opacity;
	     -moz-transition-property: top, left, opacity;
	      -ms-transition-property: top, left, opacity;
	       -o-transition-property: top, left, opacity;
	          transition-property: top, left, opacity;
	}

	<?php if($data['link_image_rollover']): ?>.image-extras .link-icon{display:none !important;}<?php endif; ?>
	<?php if($data['zoom_image_rollover']): ?>.image-extras .gallery-icon{display:none !important;}<?php endif; ?>
	<?php if($data['title_image_rollover']): ?>.image-extras h3{display:none !important;}<?php endif; ?>
	<?php if($data['cats_image_rollover']): ?>.image-extras h4{display:none !important;}<?php endif; ?>

	<?php if($data['header_layout'] == 'v4' || $data['header_layout'] == 'v5'): ?>
	.header-v4 #small-nav,.header-v5 #small-nav{background-color:<?php echo $data['menu_h45_bg_color']; ?> !important;}
	<?php endif; ?>

    <?php if($data['logo_alignment'] == 'Center' && $data['header_layout'] == 'v5'): ?>
    <?php elseif($data['logo_alignment'] == 'Right'): ?>
    #header .logo{float:right;}
    #header #nav{float:left;}
    #header .search,#header .tagline{float:left !important;}
    .header-v5 #header .logo{float:right !important;}
    #header-banner{float:left;}
    <?php else: ?>
    .header-v5 #header .logo{float:left !important;}
    <?php endif; ?>

	<?php echo $data['custom_css']; ?>

	<?php if($data['logo_retina']): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi) {
		#header .normal_logo{display:none !important;}
		#header .retina_logo{display:inline !important;}
	}
	<?php endif; ?>

	<?php if(!is_user_logged_in()): ?>
	.bbp_reply_admin_links .admin_links_sep, .bbp-admin-links .admin_links_sep{
		display: none;
	}
	<?php endif; ?>
	</style>

	<?php echo $data['google_analytics']; ?>

	<?php echo $data['space_head']; ?>

	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.js"></script>
	<![endif]-->
</head>
<?php
	$body_class = '';
	$wrapper_class = '';
	if(is_page_template('blank.php')):
	$body_class = 'body_blank';
	$wrapper_class = ' class="wrapper_blank"';
endif; ?>

<body <?php body_class(array($avada_color_scheme,$body_class)); ?>>
	<div id="wrapper" <?php echo $wrapper_class; ?>>
	<?php if($data['slidingbar_widgets'] && !is_page_template('blank.php')): ?>
	<?php get_template_part('slidingbar'); ?>
	<?php endif; ?>
		<?php if(!is_page_template('blank.php')): ?>
		<div class="header-wrapper">
			<?php
			if($data['header_layout']) {
				if(is_page('header-2')) {
					get_template_part('framework/headers/header-v2');
				} elseif(is_page('header-3')) {
					get_template_part('framework/headers/header-v3');
				} elseif(is_page('header-4')) {
					get_template_part('framework/headers/header-v4');
				} elseif(is_page('header-5')) {
					get_template_part('framework/headers/header-v5');
				} else {
					get_template_part('framework/headers/header-'.$data['header_layout']);
				}
			} else {
				if(is_page('header-2')) {
					get_template_part('framework/headers/header-v2');
				} elseif(is_page('header-3')) {
					get_template_part('framework/headers/header-v3');
				} elseif(is_page('header-4')) {
					get_template_part('framework/headers/header-v4');
				} elseif(is_page('header-5')) {
					get_template_part('framework/headers/header-v5');
				} else {
					get_template_part('framework/headers/header-'.$data['header_layout']);
				}
			}
			?>
		</div>
		<?php
		// sticky header
		get_template_part('framework/headers/sticky-header');
		?>
	<?php endif; ?>
	<div id="sliders-container">
	<?php if(!is_search()): ?>
	<?php wp_reset_query(); ?>
	<?php
	// Layer Slider
	if(!is_home() && !is_front_page() && !is_archive()) {
		$slider_page_id = $post->ID;
	}
	if(!is_home() && is_front_page()) {
		$slider_page_id = $post->ID;
	}
	if(is_home() && !is_front_page()){
		$slider_page_id = get_option('page_for_posts');
	}
	if(class_exists('Woocommerce')) {
		if(is_shop()) {
			$slider_page_id = get_option('woocommerce_shop_page_id');
		}
	}
	if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'layer' && (get_post_meta($slider_page_id, 'pyre_slider', true) || get_post_meta($slider_page_id, 'pyre_slider', true) != 0)): ?>
	<?php
	// Get slider
	$ls_table_name = $wpdb->prefix . "layerslider";
	$ls_id = get_post_meta($slider_page_id, 'pyre_slider', true);
	$ls_slider = $wpdb->get_row("SELECT * FROM $ls_table_name WHERE id = ".(int)$ls_id." ORDER BY date_c DESC LIMIT 1" , ARRAY_A);
	$ls_slider = json_decode($ls_slider['data'], true);
	?>
	<style type="text/css">
	#layerslider-container{max-width:<?php echo $ls_slider['properties']['width'] ?>;}
	</style>
	<div id="layerslider-container">
		<div id="layerslider-wrapper">
		<?php if($ls_slider['properties']['skin'] == 'avada'): ?>
		<div class="ls-shadow-top"></div>
		<?php endif; ?>
		<?php echo do_shortcode('[layerslider id="'.get_post_meta($slider_page_id, 'pyre_slider', true).'"]'); ?>
		<?php if($ls_slider['properties']['skin'] == 'avada'): ?>
		<div class="ls-shadow-bottom"></div>
		<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php
	// Flex Slider
	if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'flex' && (get_post_meta($slider_page_id, 'pyre_wooslider', true) || get_post_meta($slider_page_id, 'pyre_wooslider', true) != 0)) {
		echo do_shortcode('[wooslider slide_page="'.get_post_meta($slider_page_id, 'pyre_wooslider', true).'" slider_type="slides" limit="'.$data['flexslider_number'].'"]');
	}
	?>
	<?php
	if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'rev' && get_post_meta($slider_page_id, 'pyre_revslider', true) && !$data['status_revslider'] && function_exists('putRevSlider')) {
		putRevSlider(get_post_meta($slider_page_id, 'pyre_revslider', true));
	}
	?>
	<?php
	if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'flex2' && get_post_meta($slider_page_id, 'pyre_flexslider', true)) {
		include_once(get_template_directory().'/flexslider.php');
	}
	?>
	<?php
	// ThemeFusion Elastic Slider
	if(get_post_meta($slider_page_id, 'pyre_slider_type', true) == 'elastic' && (get_post_meta($slider_page_id, 'pyre_elasticslider', true) || get_post_meta($slider_page_id, 'pyre_elasticslider', true) != 0)) {
		include_once(get_template_directory().'/elastic-slider.php');
	}
	?>
	<?php endif; ?>
	</div>
	<?php if(get_post_meta($slider_page_id, 'pyre_fallback', true)): ?>
	<style type="text/css">
	@media only screen and (max-width: 940px){
		#sliders-container{display:none;}
		#fallback-slide{display:block;}
	}
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
		#sliders-container{display:none;}
		#fallback-slide{display:block;}
	}
	</style>
	<div id="fallback-slide">
		<img src="<?php echo get_post_meta($slider_page_id, 'pyre_fallback', true); ?>" alt="" />
	</div>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<?php if($data['page_title_bar']): ?>
	<?php if(((is_page() || is_single() || is_singular('avada_portfolio')) && get_post_meta($c_pageID, 'pyre_page_title', true) == 'yes') && !is_woocommerce() && !is_bbpress()) : ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
				<div class="page-title-captions">
					<?php if(get_post_meta($c_pageID, 'pyre_page_title_text', true) != 'no'): ?>
					<h1 class="entry-title">
					<?php if(get_post_meta($c_pageID, 'pyre_page_title_custom_text', true) != ''): ?>
					<?php echo get_post_meta($c_pageID, 'pyre_page_title_custom_text', true); ?>
					<?php else: ?>
					<?php the_title(); ?>
					<?php endif; ?>
					</h1>
					<?php if(get_post_meta($c_pageID, 'pyre_page_title_custom_subheader', true) != ''): ?>
					<h3>
					<?php echo get_post_meta($c_pageID, 'pyre_page_title_custom_subheader', true); ?>
					</h3>
					<?php endif; ?>
					<?php endif; ?>
				</div>
					<?php if($data['breadcrumb']): ?>
					<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
					<?php themefusion_breadcrumb(); ?>
					<?php else: ?>
					<?php get_search_form(); ?>
					<?php endif; ?>
					<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(is_home() && !is_front_page() && get_post_meta($slider_page_id, 'pyre_page_title', true) == 'yes'): ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<?php if(get_post_meta($c_pageID, 'pyre_page_title_text', true) != 'no'): ?>
			<h1 class="entry-title"><?php echo $data['blog_title']; ?></h1>
			<?php endif; ?>
			</div>
			<?php if($data['breadcrumb']): ?>
			<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
			<?php themefusion_breadcrumb(); ?>
			<?php else: ?>
			<?php get_search_form(); ?>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(is_search()): ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<h1 class="entry-title"><?php echo __('Search results for:', 'Avada'); ?> <?php echo get_search_query(); ?></h1>
			</div>
			<?php if($data['breadcrumb']): ?>
			<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
			<?php themefusion_breadcrumb(); ?>
			<?php else: ?>
			<?php get_search_form(); ?>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(is_404()): ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<h1 class="entry-title"><?php echo __('Error 404 Page', 'Avada'); ?></h1>
			</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(is_archive() && !is_woocommerce() && !is_bbpress()): ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<h1 class="entry-title">
				<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: %s', 'Avada' ), '<span>' . get_the_date() . '</span>' ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: %s', 'Avada' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Avada' ) ) . '</span>' ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'Avada' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'Avada' ) ) . '</span>' ); ?>
				<?php elseif ( is_author() ) : ?>
					<?php
					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
					?>
					<?php echo $curauth->nickname; ?>
				<?php else : ?>
					<?php single_cat_title(); ?>
				<?php endif; ?>
			</h1>
			</div>
			<?php if($data['breadcrumb']): ?>
			<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
			<?php themefusion_breadcrumb(); ?>
			<?php else: ?>
			<?php get_search_form(); ?>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php
	if(class_exists('Woocommerce')):
	if($woocommerce->version && is_woocommerce() && ((is_product() && get_post_meta($c_pageID, 'pyre_page_title', true) == 'yes') || (is_shop() && get_post_meta($c_pageID, 'pyre_page_title', true) == 'yes')) && !is_search()):
	?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<?php if(get_post_meta($c_pageID, 'pyre_page_title_text', true) != 'no'): ?>
			<h1 class="entry-title">
				<?php
				if(is_product()) {
					if(get_post_meta($c_pageID, 'pyre_page_title_text', true) != 'no'):
					the_title();
					endif;
				} else {
					woocommerce_page_title();
				}
				?>
			</h1>
			</div>
			<?php endif; ?>
			<?php if($data['breadcrumb']): ?>
			<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
			<?php woocommerce_breadcrumb(array(
				'wrap_before' => '<ul class="breadcrumbs">',
				'wrap_after' => '</ul>',
				'before' => '<li>',
				'after' => '</li>',
				'delimiter' => ''
			)); ?>
			<?php else: ?>
			<?php get_search_form(); ?>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(is_tax('product_cat') || is_tax('product_tag')): ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<h1 class="entry-title">
				<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: %s', 'Avada' ), '<span>' . get_the_date() . '</span>' ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: %s', 'Avada' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Avada' ) ) . '</span>' ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'Avada' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'Avada' ) ) . '</span>' ); ?>
				<?php elseif ( is_author() ) : ?>
					<?php
					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
					?>
					<?php echo $curauth->nickname; ?>
				<?php else : ?>
					<?php single_cat_title(); ?>
				<?php endif; ?>
			</h1>
			</div>
			<?php if($data['breadcrumb']): ?>
			<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
			<?php themefusion_breadcrumb(); ?>
			<?php else: ?>
			<?php get_search_form(); ?>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; // end class check if for woocommerce ?>
	<?php
	if( class_exists('bbPress')):
	if(is_bbpress()): ?>
	<div class="page-title-container">
		<div class="page-title">
			<div class="page-title-wrapper">
			<div class="page-title-captions">
			<?php if(get_post_meta($c_pageID, 'pyre_page_title_text', true) != 'no'): ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>
			</div>
			<?php if($data['breadcrumb']): ?>
			<?php if($data['page_title_bar_bs'] == 'Breadcrumbs'): ?>
			<?php bbp_breadcrumb( array ( 'before' => '<ul class="breadcrumbs">', 'after' => '</ul>', 'sep' => '', 'crumb_before' => '<li>', 'crumb_after' => '</li>', 'home_text' => __('Home', 'Avada')) ); ?>
			<?php else: ?>
			<?php get_search_form(); ?>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
	<?php if(is_page_template('contact.php') && $data['recaptcha_public'] && $data['recaptcha_private']): ?>
	<script type="text/javascript">
	 var RecaptchaOptions = {
	    theme : '<?php echo $data['recaptcha_color_scheme']; ?>'
	 };
 	</script>
 	<?php endif; ?>
	<?php if(is_page_template('contact.php') && $data['gmap_address'] && !$data['status_gmap']): ?>
	<style type="text/css">
	#gmap{
		width:<?php echo $data['gmap_width']; ?>;
		margin:0 auto;
		<?php if($data['gmap_width'] != '100%'): ?>
		margin-top:55px;
		<?php endif; ?>

		<?php if($data['gmap_height']): ?>
		height:<?php echo $data['gmap_height']; ?>;
		<?php else: ?>
		height:415px;
		<?php endif; ?>
	}
	</style>
	<?php
	$addresses = explode('|', $data['gmap_address']);
	$markers = '';
	if($data['map_popup']) {
		$map_popup = "false";
	} else {
		$map_popup = "true";
	}
	foreach($addresses as $address_string) {
		$markers .= "{
			address: '{$address_string}',
			html: {
				content: '{$address_string}',
				popup: {$map_popup}
			}
		},";
	}
	?>
	<script type='text/javascript'>
	jQuery(document).ready(function($) {
		jQuery('#gmap').goMap({
			address: '<?php echo $addresses[0]; ?>',
			maptype: '<?php echo $data['gmap_type']; ?>',
			zoom: <?php echo $data['map_zoom_level']; ?>,
			scrollwheel: <?php if($data['map_scrollwheel']): ?>false<?php else: ?>true<?php endif; ?>,
			scaleControl: <?php if($data['map_scale']): ?>false<?php else: ?>true<?php endif; ?>,
			navigationControl: <?php if($data['map_zoomcontrol']): ?>false<?php else: ?>true<?php endif; ?>,
	        <?php if(!$data['map_pin']): ?>markers: [<?php echo $markers; ?>],<?php endif; ?>
		});
	});
	</script>
	<div class="gmap" id="gmap">
	</div>
	<?php endif; ?>
	<?php if(is_page_template('contact-2.php') && $data['gmap_address'] && !$data['status_gmap']): ?>
	<style type="text/css">
	#gmap{
		width:940px;
		margin:0 auto;
		margin-top:55px;

		height:415px;
	}
	</style>
	<?php
	$addresses = explode('|', $data['gmap_address']);
	$markers = '';
	if($data['map_popup']) {
		$map_popup = "false";
	} else {
		$map_popup = "true";
	}
	foreach($addresses as $address_string) {
		if(!$data['map_pin']) {
			$markers .= "{
				address: '{$address_string}',
				html: {
					content: '{$address_string}',
					popup: {$map_popup}
				}
			},";
		} else {
			$markers .= "{
				address: '{$address_string}'
			},";
		}
	}
	?>
	<script type='text/javascript'>
	jQuery(document).ready(function($) {
		jQuery('#gmap').goMap({
			address: '<?php echo $addresses[0]; ?>',
			maptype: '<?php echo $data['gmap_type']; ?>',
			zoom: <?php echo $data['map_zoom_level']; ?>,
			scrollwheel: <?php if($data['map_scrollwheel']): ?>false<?php else: ?>true<?php endif; ?>,
			scaleControl: <?php if($data['map_scale']): ?>false<?php else: ?>true<?php endif; ?>,
			navigationControl: <?php if($data['map_zoomcontrol']): ?>false<?php else: ?>true<?php endif; ?>,
			<?php if(!$data['map_pin']): ?>markers: [<?php echo $markers; ?>],<?php endif; ?>
		});
	});
	</script>
	<div class="gmap" id="gmap">
	</div>
	<?php endif; ?>
	<?php
	$main_css = '';
	$row_css = '';
	$main_class = '';
	if(is_page_template('100-width.php') || is_page_template('blank.php') ||get_post_meta($slider_page_id, 'pyre_portfolio_width_100', true) == 'yes') {
		$main_css = 'padding-left:0px;padding-right:0px;';
		$row_css = 'max-width:100%;';
		$main_class = 'width-100';
	}
	?>
	<div id="main" class="<?php echo $main_class; ?>" style="overflow:hidden !important;<?php echo $main_css; ?>">
		<div class="avada-row" style="<?php echo $row_css; ?>">
			<?php wp_reset_query(); ?>