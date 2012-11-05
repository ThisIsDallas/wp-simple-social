<?php 
/*
Plugin Name: WP Simple Social
Plugin URI: http://dallasbass.com/wp-simple-social
Description: A simple social plugin. Upload a image, write a paragraph, or add social icons.
Version: 2.0
Author: Dallas Bass
Author URI: http://dallasbass.com
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'db_wpss_register_widgets' );

//register our widget
function db_wpss_register_widgets() {
    register_widget( 'db_wpss_my_info' );
}

//Load necessary image upload scripts
function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', WP_PLUGIN_URL.'/wp-simple-social/wp-simple-social-image.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}

add_Action('admin_enqueue_scripts', 'my_admin_scripts');
 
function my_admin_styles() {
	wp_enqueue_style('thickbox');
}
 
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');


//Load the stylesheet
function db_wpss_styles() {
        wp_enqueue_style( 'wp-simple-social-style', plugin_dir_url( __FILE__ ) . 'styles.css', array(), '0.1', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'db_wpss_styles' );


//Load the farbtastic color picker

function sample_load_color_picker_script() {
	wp_enqueue_script('farbtastic');
}
function sample_load_color_picker_style() {
	wp_enqueue_style('farbtastic');	
}
add_action('admin_print_scripts-widgets.php', 'sample_load_color_picker_script');
add_action('admin_print_styles-widgets.php', 'sample_load_color_picker_style');

// Let's Localize 
function db_wpss_localize() {
    load_plugin_textdomain('wpsslocalize', false, dirname(plugin_basename(__FILE__)) . '/lang/');
} 
add_action('after_theme_setup', 'db_wpss_localize');


//db_wpss_my_info class
class db_wpss_my_info extends WP_Widget {

    //process the new widget
    function db_wpss_my_info() {
        $widget_ops = array( 
			'classname' => 'db_wpss_widget_class', 
			'description' => 'Clean Minimal Social Widget' 
			); 
        $this->WP_Widget( 'db_wpss_my_info', 'WP Simple Social', $widget_ops );
    }
    
  //build the widget settings form
    function form($instance) {
        $defaults = array( 
        	'profimg' => '', 
        	'profimgshape' => 'square',
        	'profimgtrans' => '', 
        	'bio' => 'Enter a short bio',
        	'iconshape' => 'square',
        	'iconsize' => '', 
        	'iconbgcolor' => '',
        	'iconcolor' => '',
        	'icontrans' => 'yes', 
        	'amazon' => 'Add your Amazon store link', 
        	'blogger' => 'Add your Blogger URL', 
        	'delicious' => 'Add your Delicious username', 
        	'deviantart' => 'Add your Deviant Art username', 
        	'dribbble' => 'Add your Dribbble username', 
        	'facebook' => 'Add your Facebook username', 
        	'flickr' => 'Add your Flickr username', 
        	'forrst' => 'Add your Forrst username', 
        	'github' => 'Add your Github username', 
        	'googleplus' => 'Add your Google Plus URL', 
        	'lastfm' => 'Add your LastFM username', 
        	'picassa' => 'Add your picassa username', 
        	'pinterest' => 'Add your Pinterest username', 
        	'reddit' => 'Add your Reddit username', 
        	'rss' => 'Add your RSS feed URL', 
        	'skype' => 'Add your Skype username', 
        	'soundcloud' => 'Add your Sound Cloud username', 
        	'tumblr' => 'Add your Tumblr URL',
        	'twitter' => 'Add your Twitter username', 
        	'vimeo' => 'Add your Vimeo username', 
        	'wordpress' => 'Add your WordPress URL', 
        	'android' => '',
        	'androidurl' => '', 
        	'apple' => '', 
        	'appleurl' => '',
        	'chrome' => '',
        	'chromeurl' => '', 
        	'css' => '',
        	'cssurl' => '', 
        	'html' => '',
        	'htmlurl' => '',
        	'ie' => '',
        	'ieurl' => '', 
        	'opera' => '',
        	'operaurl' => '', 
        	'windows' => '',
        	'windowsurl' => '',
        ); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $profimg = esc_attr($instance['profimg']);
        $profimgshape = esc_attr($instance['profimgshape']);
        $profimgtrans = esc_attr($instance['profimgtrans']);
        $bio = esc_attr($instance['bio']);
        $iconshape = esc_attr($instance['iconshape']);
        $iconsize = esc_attr($instance['iconsize']);
        $iconbgcolor = esc_attr($instance['iconbgcolor']);
        $iconcolor = esc_attr($instance['iconcolor']);
        $icontrans = esc_attr($instance['icontrans']);
        $amazon = esc_attr($instance['amazon']);
        $blogger = esc_attr($instance['blogger']);
        $delicious = esc_attr($instance['delicious']);
        $deviantart = esc_attr($instance['deviantart']);
        $dribbble = esc_attr($instance['dribbble']);
        $facebook = esc_attr($instance['facebook']);
        $flickr = esc_attr($instance['flickr']);
        $forrst = esc_attr($instance['forrst']);
        $github = esc_attr($instance['github']);
        $googleplus = esc_attr($instance['googleplus']);
        $lastfm = esc_attr($instance['lastfm']);
        $picassa = esc_attr($instance['picassa']);
        $pinterest = esc_attr($instance['pinterest']);
        $reddit = esc_attr($instance['reddit']);
        $rss = esc_attr($instance['rss']);
        $skype = esc_attr($instance['skype']);
        $soundcloud = esc_attr($instance['soundcloud']);
        $tumblr = esc_attr($instance['tumblr']);
        $twitter = esc_attr($instance['twitter']);
        $vimeo = esc_attr($instance['vimeo']);
        $wordpress = esc_attr($instance['wordpress']);
        $android = esc_attr($instance['android']);
        $androidurl = esc_url($instance['androidurl']);
        $apple = esc_attr($instance['apple']);
        $appleurl = esc_url($instance['appleurl']);
        $chrome = esc_attr($instance['chrome']);
        $chromeurl = esc_url($instance['chromeurl']);
        $css = esc_attr($instance['css']);
        $cssurl = esc_url($instance['cssurl']);
        $html = esc_attr($instance['html']);
        $htmlurl = esc_url($instance['htmlurl']);
        $ie = esc_attr($instance['ie']);
        $ieurl = esc_url($instance['ieurl']);
        $opera = esc_attr($instance['opera']);
        $operaurl = esc_url($instance['operaurl']);
        $windows = esc_attr($instance['windows']);
        $windowsurl = esc_url($instance['windowsurl']);
        ?>
        
    	<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function()
			{
				// colorpicker field
				jQuery('.cw-color-picker').each(function(){
					var $this = jQuery(this),
						id = $this.attr('rel');

					$this.farbtastic('#' + id);
				});
			});
		//]]>   
	  </script>
	  
<!-- Display the profile image priorities -->

	<p><?php _e('Image:', 'wpsslocalize'); ?><input class="upload_image widefat" type="text" size="72" name="<?php echo $this->get_field_name( 'profimg' ); ?>" value="<?php echo esc_attr( $profimg ); ?>" />
	<input class="upload_image_button" type="button" value="Upload Image" /></p>
	
	<p>
		<label for="<?php echo $this->get_field_id('profimgshape'); ?>"><?php _e('Select Your Image Shape', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('profimgshape'); ?>" id="<?php echo $this->get_field_id('profimgshape'); ?>" class="widefat">
			<?php
			$options = array('circle', 'square');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $profimgshape == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('profimgtrans'); ?>"><?php _e('Add Transperancy?:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('profimgtrans'); ?>" id="<?php echo $this->get_field_id('profimgtrans'); ?>" class="widefat">
			<?php
			$options = array('Display Transparent Image', 'Do Not Display Transparent Image');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $profimgtrans == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>

	<p><?php _e('Preview:', 'wpsslocalize'); ?><img class="db_wpss_preview" src="<?php echo esc_attr( $profimg ); ?>" width="100%" /></p>

<!-- Profile picture priorities end -->

<!-- Begin bio section -->
	
	<p><?php _e('Bio:', 'wpsslocalize'); ?> <textarea class="widefat" name="<?php echo $this->get_field_name( 'bio' ); ?>" / ><?php echo esc_attr( $bio ); ?></textarea></p>

<!-- End bio section -->

<!-- Display the icon priorities -->

	<p>
		<label for="<?php echo $this->get_field_id('iconshape'); ?>"><?php _e('Select Your Icon Shape', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('iconshape'); ?>" id="<?php echo $this->get_field_id('iconshape'); ?>" class="widefat">
			<?php
			$options = array('circle', 'square');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $iconshape == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('iconsize'); ?>"><?php _e('Select Your Icon Size', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('iconsize'); ?>" id="<?php echo $this->get_field_id('iconsize'); ?>" class="widefat">
			<?php
			$options = array('Small', 'Medium', 'Large',);
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $iconsize == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('icontrans'); ?>"><?php _e('Add Transperancy?:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('icontrans'); ?>" id="<?php echo $this->get_field_id('icontrans'); ?>" class="widefat">
			<?php
			$options = array('Display Transparent Image', 'Do Not Display Transperant Image');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $icontrans == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>

	<label for="<?php echo $this->get_field_id('iconbgcolor'); ?>"><?php _e('Icon Background Color:', 'wpsslocalize'); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id('iconbgcolor'); ?>" name="<?php echo $this->get_field_name('iconbgcolor'); ?>" type="text" value="<?php if($iconbgcolor) { echo $iconbgcolor; } else { echo '#fff'; } ?>" />
	<div class="cw-color-picker" rel="<?php echo $this->get_field_id('iconbgcolor'); ?>"></div>
	
	<label for="<?php echo $this->get_field_id('iconcolor'); ?>"><?php _e('Icon Color:', 'wpsslocalize'); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id('iconcolor'); ?>" name="<?php echo $this->get_field_name('iconcolor'); ?>" type="text" value="<?php if($iconcolor) { echo $iconcolor; } else { echo '#fff'; } ?>" />
	<div class="cw-color-picker" rel="<?php echo $this->get_field_id('iconcolor'); ?>"></div>
	
<!-- End icon priorities -->

<!-- Begin icon selection section -->

	<p>Amazon: <input class="widefat" name="<?php echo $this->get_field_name( 'amazon' ); ?>"  type="text" value="<?php echo esc_attr( $amazon ); ?>" /></p>
	
	<p>Blogger: <input class="widefat" name="<?php echo $this->get_field_name( 'blogger' ); ?>"  type="text" value="<?php echo esc_attr( $blogger ); ?>" /></p>
	
	<p>Delicious: <input class="widefat" name="<?php echo $this->get_field_name( 'delicious' ); ?>"  type="text" value="<?php echo esc_attr( $delicious ); ?>" /></p>
	
	<p>Deviant Art: <input class="widefat" name="<?php echo $this->get_field_name( 'deviantart' ); ?>"  type="text" value="<?php echo esc_attr( $deviantart ); ?>" /></p>
	
	<p>Dribbble: <input class="widefat" name="<?php echo $this->get_field_name( 'dribbble' ); ?>"  type="text" value="<?php echo esc_attr( $dribbble ); ?>" /></p>
	
	<p>Facebook: <input class="widefat" name="<?php echo $this->get_field_name( 'facebook' ); ?>"  type="text" value="<?php echo esc_attr( $facebook ); ?>" /></p>   
	        
	<p>Flickr: <input class="widefat" name="<?php echo $this->get_field_name( 'flickr' ); ?>"  type="text" value="<?php echo esc_attr( $flickr ); ?>" /></p>
	
	<p>Forrst: <input class="widefat" name="<?php echo $this->get_field_name( 'forrst' ); ?>"  type="text" value="<?php echo esc_attr( $forrst ); ?>" /></p>
	
	<p>github: <input class="widefat" name="<?php echo $this->get_field_name( 'github' ); ?>"  type="text" value="<?php echo esc_attr( $github ); ?>" /></p>           
	
	<p>Google Plus: <input class="widefat" name="<?php echo $this->get_field_name( 'googleplus' ); ?>"  type="text" value="<?php echo esc_attr( $googleplus ); ?>" /></p>
	
	<p>Last FM: <input class="widefat" name="<?php echo $this->get_field_name( 'lastfm' ); ?>"  type="text" value="<?php echo esc_attr( $lastfm ); ?>" /></p>
	
	<p>Picassa: <input class="widefat" name="<?php echo $this->get_field_name( 'picassa' ); ?>"  type="text" value="<?php echo esc_attr( $picassa ); ?>" /></p>
	
	<p>Pinterest: <input class="widefat" name="<?php echo $this->get_field_name( 'pinterest' ); ?>"  type="text" value="<?php echo esc_attr( $pinterest ); ?>" /></p>
	
	<p>Reddit: <input class="widefat" name="<?php echo $this->get_field_name( 'reddit' ); ?>"  type="text" value="<?php echo esc_attr( $reddit ); ?>" /></p>
	
	<p>RSS: <input class="widefat" name="<?php echo $this->get_field_name( 'rss' ); ?>"  type="text" value="<?php echo esc_attr( $rss ); ?>" /></p>      
	     
	<p>Skype: <input class="widefat" name="<?php echo $this->get_field_name( 'skype' ); ?>"  type="text" value="<?php echo esc_attr( $skype ); ?>" /></p>
	
	<p>Sound Cloud: <input class="widefat" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>"  type="text" value="<?php echo esc_attr( $soundcloud ); ?>" /></p>
	
	<p>Tumblr: <input class="widefat" name="<?php echo $this->get_field_name( 'tumblr' ); ?>"  type="text" value="<?php echo esc_attr( $tumblr ); ?>" /></p>
	
	<p>Twitter: <input class="widefat" name="<?php echo $this->get_field_name( 'twitter' ); ?>"  type="text" value="<?php echo esc_attr( $twitter ); ?>" /></p>
	
	<p>Vimeo: <input class="widefat" name="<?php echo $this->get_field_name( 'vimeo' ); ?>"  type="text" value="<?php echo esc_attr( $vimeo ); ?>" /></p>
	
	<p>WordPress: <input class="widefat" name="<?php echo $this->get_field_name( 'wordpress' ); ?>"  type="text" value="<?php echo esc_attr( $wordpress ); ?>" /></p>

	<p>
		<label for="<?php echo $this->get_field_id('android'); ?>">Android <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('android'); ?>" id="<?php echo $this->get_field_id('android'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $android == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
		
	<p>Android<?php _e('Icon Link:', 'wpsslocalize'); ?>
		<input class="widefat" name="<?php echo $this->get_field_name( 'androidurl' ); ?>"  type="text" value="<?php echo esc_attr( $androidurl ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('apple'); ?>">Apple <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('apple'); ?>" id="<?php echo $this->get_field_id('apple'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $apple == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>          
	
	<p>Apple <?php _e('Icon Link:', 'wpsslocalize'); ?><input class="widefat" name="<?php echo $this->get_field_name( 'appleurl' ); ?>"  type="text" value="<?php echo esc_attr( $appleurl ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('chrome'); ?>">Chrome <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('chrome'); ?>" id="<?php echo $this->get_field_id('chrome'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $chrome == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
	
	<p>Chrome <?php _e('Icon Link:', 'wpsslocalize'); ?><input class="widefat" name="<?php echo $this->get_field_name( 'chromeurl' ); ?>"  type="text" value="<?php echo esc_attr( $chromeurl ); ?>" /></p>      
	
	<p>
		<label for="<?php echo $this->get_field_id('css'); ?>">CSS3 <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('css'); ?>" id="<?php echo $this->get_field_id('css'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $css == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
	
	<p>CSS3 <?php _e('Icon Link:', 'wpsslocalize'); ?> <input class="widefat" name="<?php echo $this->get_field_name( 'cssurl' ); ?>"  type="text" value="<?php echo esc_attr( $cssurl ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('html'); ?>">HTML5 <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('html'); ?>" id="<?php echo $this->get_field_id('html'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $html == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
		
	<p>HTML5 <?php _e('Icon Link:', 'wpsslocalize'); ?> <input class="widefat" name="<?php echo $this->get_field_name( 'htmlurl' ); ?>"  type="text" value="<?php echo esc_attr( $htmlurl ); ?>" /></p>
	
	<p>
		<label for="<?php echo $this->get_field_id('ie'); ?>">Internet Explorer <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('ie'); ?>" id="<?php echo $this->get_field_id('ie'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $ie == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
		
	<p>Internet Explorer <?php _e('Icon Link:', 'wpsslocalize'); ?> <input class="widefat" name="<?php echo $this->get_field_name( 'ieurl' ); ?>"  type="text" value="<?php echo esc_attr( $ieurl ); ?>" />
	</p>
	           
	<p>
		<label for="<?php echo $this->get_field_id('opera'); ?>">Opera <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('opera'); ?>" id="<?php echo $this->get_field_id('opera'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $opera == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
	
	<p>Opera <?php _e('Icon Link:', 'wpsslocalize'); ?> <input class="widefat" name="<?php echo $this->get_field_name( 'operaurl' ); ?>"  type="text" value="<?php echo esc_attr( $operaurl ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id('windows'); ?>">Windows <?php _e('Icon:', 'wpsslocalize'); ?></label>
		<select name="<?php echo $this->get_field_name('windows'); ?>" id="<?php echo $this->get_field_id('windows'); ?>" class="widefat">
			<?php
			$options = array('Display', 'Do Not Display');
			foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $windows == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
	</p>
	
	<p>Windows <?php _e('Icon Link:', 'wpsslocalize'); ?> <input class="widefat" name="<?php echo $this->get_field_name( 'windowsurl' ); ?>"  type="text" value="<?php echo esc_attr( $windowsurl ); ?>" />
	</p>
         
<!-- End icon selection -->            
		    
<?php
    }
 
    //save the widget settings
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['profimg'] = strip_tags( $new_instance['profimg'] );
        $instance['profimgshape'] = strip_tags( $new_instance['profimgshape'] );
        $instance['profimgtrans'] = strip_tags( $new_instance['profimgtrans'] );
        $instance['bio'] = strip_tags( $new_instance['bio'] );
        $instance['iconshape'] = strip_tags( $new_instance['iconshape'] );
        $instance['iconsize'] = strip_tags( $new_instance['iconsize'] );
        $instance['iconbgcolor'] = strip_tags( $new_instance['iconbgcolor'] );
        $instance['iconcolor'] = strip_tags( $new_instance['iconcolor'] );
        $instance['icontrans'] = strip_tags( $new_instance['icontrans'] );
        $instance['amazon'] = strip_tags( $new_instance['amazon'] );
        $instance['blogger'] = strip_tags( $new_instance['blogger'] );
        $instance['delicious'] = strip_tags( $new_instance['delicious'] );
        $instance['deviantart'] = strip_tags($new_instance['deviantart']);
        $instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
        $instance['facebook'] = strip_tags( $new_instance['facebook'] );
        $instance['flickr'] = strip_tags($new_instance['flickr']);
        $instance['forrst'] = strip_tags( $new_instance['forrst'] );
        $instance['github'] = strip_tags( $new_instance['github'] );
        $instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
        $instance['lastfm'] = strip_tags( $new_instance['lastfm'] );
        $instance['picassa'] = strip_tags( $new_instance['picassa'] );
        $instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
        $instance['reddit'] = strip_tags( $new_instance['reddit'] );
        $instance['rss'] = strip_tags( $new_instance['rss'] );
        $instance['skype'] = strip_tags( $new_instance['skype'] );
        $instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
        $instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
        $instance['twitter'] = strip_tags( $new_instance['twitter'] );
        $instance['vimeo'] = strip_tags($new_instance['vimeo']);
        $instance['wordpress'] = strip_tags( $new_instance['wordpress'] );
        $instance['android'] = strip_tags( $new_instance['android'] );
        $instance['androidurl'] = strip_tags($new_instance['androidurl']);
        $instance['apple'] = strip_tags( $new_instance['apple'] );
        $instance['appleurl'] = strip_tags( $new_instance['appleurl'] );
        $instance['chrome'] = strip_tags( $new_instance['chrome'] );
        $instance['chromeurl'] = strip_tags( $new_instance['chromeurl'] );
        $instance['css'] = strip_tags( $new_instance['css'] );
        $instance['cssurl'] = strip_tags( $new_instance['cssurl'] );
        $instance['html'] = strip_tags( $new_instance['html'] );
        $instance['htmlurl'] = strip_tags( $new_instance['htmlurl'] );
        $instance['ie'] = strip_tags( $new_instance['html'] );
        $instance['ieurl'] = strip_tags( $new_instance['ieurl'] );
        $instance['opera'] = strip_tags( $new_instance['opera'] );
        $instance['operaurl'] = strip_tags( $new_instance['operaurl'] );
        $instance['windows'] = strip_tags( $new_instance['windows'] );
        $instance['windowsurl'] = strip_tags( $new_instance['windowsurl'] );

 
        return $instance;
    }
 
//Display the widget

    function widget($args, $instance) {
        extract($args);
 
        echo $before_widget;
      
        $profimg = empty( $instance['profimg'] ) ? '' : $instance['profimg'];
        $profimgshape = empty( $instance['profimgshape'] ) ? '' : $instance['profimgshape'];
        $profimgtrans = empty( $instance['profimgtrans'] ) ? '' : $instance['profimgtrans']; 
        $bio = empty( $instance['bio'] ) ? '' : $instance['bio']; 
        $iconshape = empty( $instance['iconshape'] ) ? '' : $instance['iconshape']; 
        $iconsize = empty( $instance['iconsize'] ) ? '' : $instance['iconsize'];
        $iconbgcolor = empty( $instance['iconbgcolor'] ) ? '' : $instance['iconbgcolor'];
        $iconcolor = empty( $instance['iconcolor'] ) ? '' : $instance['iconcolor'];
        $icontrans = empty( $instance['icontrans'] ) ? '' : $instance['icontrans'];
        $amazon = empty( $instance['amazon'] ) ? '' : $instance['amazon'];
        $blogger = empty( $instance['blogger'] ) ? '' : $instance['blogger'];
        $delicious = empty( $instance['delicious'] ) ? '' : $instance['delicious']; 
        $deviantart = empty( $instance['deviantart'] ) ? '' : $instance['deviantart'];
        $dribbble = empty( $instance['dribbble'] ) ? '' : $instance['dribbble'];
        $facebook = empty( $instance['facebook'] ) ? '' : $instance['facebook'];
        $flickr = empty( $instance['flickr'] ) ? '' : $instance['flickr'];
        $forrst = empty( $instance['forrst'] ) ? '' : $instance['forrst']; 
        $github = empty( $instance['github'] ) ? '' : $instance['github'];
        $googleplus = empty( $instance['googleplus'] ) ? '' : $instance['googleplus'];
        $lastfm = empty( $instance['lastfm'] ) ? '' : $instance['lastfm']; 
        $picassa = empty( $instance['picassa'] ) ? '' : $instance['picassa'];
        $pinterest = empty( $instance['pinterest'] ) ? '' : $instance['pinterest']; 
        $reddit = empty( $instance['reddit'] ) ? '' : $instance['reddit'];
        $rss = empty( $instance['rss'] ) ? '' : $instance['rss'];
        $skype = empty( $instance['skype'] ) ? '' : $instance['skype']; 
        $soundcloud = empty( $instance['soundcloud'] ) ? '' : $instance['soundcloud'];
        $tumblr = empty( $instance['tumblr'] ) ? '' : $instance['iconsize']; 
        $twitter = empty( $instance['twitter'] ) ? '' : $instance['twitter'];
        $vimeo = empty( $instance['vimeo'] ) ? '' : $instance['vimeo'];
        $wordpress = empty( $instance['wordpress'] ) ? '' : $instance['wordpress']; 
        $android = empty( $instance['android'] ) ? '' : $instance['android'];
        $androidurl = empty( $instance['androidurl'] ) ? '' : $instance['androidurl']; 
        $apple = empty( $instance['apple'] ) ? '' : $instance['apple'];
        $appleurl = empty( $instance['appleurl'] ) ? '' : $instance['appleurl'];
        $chrome = empty( $instance['chrome'] ) ? '' : $instance['chrome']; 
        $chromeurl = empty( $instance['chromeurl'] ) ? '' : $instance['chromeurl'];
        $css = empty( $instance['css'] ) ? '' : $instance['css']; 
        $cssurl = empty( $instance['cssurl'] ) ? '' : $instance['cssurl'];
        $html = empty( $instance['html'] ) ? '' : $instance['html'];
        $htmlurl = empty( $instance['htmlurl'] ) ? '' : $instance['htmlurl'];
        $ie = empty( $instance['ie'] ) ? '' : $instance['ie']; 
        $ieurl = empty( $instance['ieurl'] ) ? '' : $instance['ieurl']; 
        $opera = empty( $instance['opera'] ) ? '' : $instance['opera']; 
        $operaurl = empty( $instance['operaurl'] ) ? '' : $instance['operaurl']; 
        $windows = empty( $instance['windows'] ) ? '' : $instance['windows'];   
        $windowsurl = empty( $instance['windowsurl'] ) ? '' : $instance['windowsurl']; 
        
        if ( $profimgshape == 'circle' ) {
			echo '<style>';
			echo '.db_wpss_widget_class img {border-radius:50%};';
			echo '</style>';
		} else {
			echo '';
		}

		if ( $profimgtrans == 'Display Transparent Image' ) {
			echo '<style>';
			echo '.db_wpss_widget_class img {opacity:.5}';
			echo '.db_wpss_widget_class img:hover {opacity:1}';
			echo '</style>';			
		} else {
			echo '';
		}

		if ( $icontrans == 'Display Transparent Image' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {opacity:.5}';
			echo '.db_wpss_widget_class span:hover {opacity:1}';
			echo '</style>';			
		} else {
			echo '';
		}
        

		if ( $iconshape == 'circle' && $iconsize == 'Small' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {border-radius:50%; font-size:1em; padding:6px; line-height:2.6em;};';
			echo '</style>';			
		} elseif ( $iconshape == 'circle' && $iconsize == 'Medium' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {border-radius:50%; font-size:2em; padding:9px; line-height:2.1em;};';
			echo '</style>';
		} elseif ( $iconshape == 'circle' && $iconsize == 'Large' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {border-radius:50%; font-size:3em; padding:11px; line-height:1.9em;};';
			echo '</style>';
		} elseif ($iconshape == 'square' && $iconsize == 'Small' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {font-size:1em; padding:6px; line-height:2.7em;};';
			echo '</style>';			
		} elseif ($iconshape == 'square' && $iconsize == 'Medium' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {font-size:2em; padding:6px; line-height:1.9em;};';
			echo '</style>';
		} elseif ($iconshape == 'square' && $iconsize == 'Large' ) {
			echo '<style>';
			echo '.db_wpss_widget_class span {font-size:3em; padding:6px; line-height:1.7em;};';
			echo '</style>';
		} else {
			echo '';
		}


		echo '<img src="' . $profimg . '" title="WP-Simple-Social Profile Image" />';
        echo '<p>' . $bio .'</p>';

		echo '<ul>';
        
        if(!empty($amazon)) {
			echo '<li><a href="http://www.amazon.com/shops/' . $amazon . '"><span class="icon-amazon" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
        } else {
	       echo '';

        }
        if (!empty($blogger)) {
	        echo '<li><a href="' . $blogger . '"><span class="icon-blogger" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
        } else {
	        echo '';
        }
        if (!empty($delicious)) {
        	echo '<li><a href="http://delicious.com/' . $delicious . '"><span class="icon-delicious" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
        } else {
	        echo '';
        }
        if (!empty($deviantart)) {
        	echo '<li><a href="http://' . $deviantart .'.deviantart.com/"><span class="icon-deviantart" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
        } else {
	        echo '';
        } 
        if (!empty($dribbble)) {
			echo '<li><a href="http://dribbble.com/' . $dribbble . '"><span class="icon-dribbble" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
		} else {
			echo '';
		}
		if (!empty($facebook)) {
			echo '<li><a href="http://facebook.com/"><span class="icon-facebook" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
		} else {
			echo '';
		}
		if (!empty($flickr)) {
			echo '<li><a href="http://flickr.com/photos/' . $flickr . '"><span class="icon-flickr" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
		} else {
			echo '';
		}
		if (!empty($forrst)) {
			echo '<li><a href="http://forrst.com/people/' . $people . '"><span class="icon-forrst" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
		} else {
			echo '';
		}
		if (!empty($github)) {
			echo '<li><a href="http://github.com/' . $github . '"><span class="icon-github" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}

		if (!empty($googleplus)) {
			echo '<li><a href="' . $googleplus . '"><span class="icon-google-plus" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($lastfm)) {
			echo '<li><a href="http://last.fm/user/' . $lastfm . '"><span class="icon-lastfm" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($picassa)) {
			echo '<li><a href="' . $picassa . '"><span class="icon-picassa" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($pinterest)) {
			echo '<li><a href="http://pinterest.com/' . $pinterest . '"><span class="icon-pinterest1" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}

		if (!empty($reddit)) {
			echo '<li><a href="http://reddit.com/u/' . $reddit . '"><span class="icon-reddit" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($rss)) {
			echo '<li><a href="' . $rss . '"><span class="icon-feed" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($skype)) {
			echo '<li><a href="skype' . $skype . '?call"><span class="icon-skype" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($soundcloud)) {
			echo '<li><a href="http://www.soundcloud.com/' . $soundcloud . '"><span class="icon-soundcloud" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($tumblr)) {
			echo '<li><a href="' . $tumblr . '"><span class="icon-tumblr" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}

		if (!empty($twitter)) {
			echo '<li><a href="http://twitter.com/' . $twitter . '"><span class="icon-twitter" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($vimeo)) {
			echo '<li><a href="http://vimeo.com/' . $vimeo . '"><span class="icon-vimeo" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
		if (!empty($wordpress)) {
			echo '<li><a href="' . $wordpress . '"><span class="icon-wordpress" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>'; 
		} else {
			echo '';
		}
if ( $android == 'Display' ) {
			if (!empty($androidurl)) {
				echo '<li><a href="' . $androidurl . '"><span class="icon-android" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-android" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}
if ( $apple == 'Display' ) {
			if (!empty($appleurl)) {
				echo '<li><a href="' . $appleurl . '"><span class="icon-apple" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-apple" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

if ( $chrome == 'Display' ) {
			if (!empty($chromeurl)) {
				echo '<li><a href="' . $chromeurl . '"><span class="icon-chrome" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-chrome" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

if ( $css == 'Display' ) {
			if (!empty($cssurl)) {
				echo '<li><a href="' . $cssurl . '"><span class="icon-css3" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-css3" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

		if ( $html == 'Display' ) {
			if (!empty($htmlurl)) {
				echo '<li><a href="' . $htmlurl . '"><span class="icon-html5" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-html5" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

		if ( $ie == 'Display' ) {
			if (!empty($ieurl)) {
				echo '<li><a href="' . $ieurl . '"><span class="icon-IE" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-IE" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

		if ( $opera == 'Display' ) {
			if (!empty($operaurl)) {
				echo '<li><a href="' . $operaurl . '"><span class="icon-opera" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-opera" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

		if ( $windows == 'Display' ) {
			if (!empty($windowsurl)) {
				echo '<li><a href="' . $windowsurl . '"><span class="icon-windows" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span></a>';
				} else {
					echo '<li><span class="icon-windows" style="background-color:' . $iconbgcolor . '; color:' . $iconcolor . '"></span>';
				} 
		} else {
			echo '';
		}

		echo '</ul>';      
   }
}
?>