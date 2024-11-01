<?php
/*  Copyright 2011  JAN HEUNINCK  (email : jan@janheuninck.be)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
	Plugin Name: TF Button
	Description: Add the Twitter Follow Button to your website to increase engagement and create a lasting connection with your audience.
	Author: Jan Heuninck
	Version: 0.3
	Author URI: http://www.janheuninck.be
*/

class TF_Button_Widget extends WP_Widget
{
	function TF_Button_Widget()
	{
		// Call parent constructor
        parent::WP_Widget(false, $name = 'Twitter Follow Button');
    }
	
	function widget($args, $instance)
	{
        extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);

		// Get button details
		$username 	= $instance['username'];
		$show_count = $instance['show_count'];
		$button 	= $instance['button'];
		$text_color = $instance['text_color'];
		$link_color = $instance['link_color'];
		$language 	= $instance['language'];
		$width 		= $instance['width'];
		$align 		= $instance['align'];
		
		echo $before_widget;
		
		if ($title)
		{
			echo $before_title . $title . $after_title;
		}
		
		// Build twitter follow button
		$output = "<a href=\"http://twitter.com/%username%\"
					class=\"twitter-follow-button\"
					data-show-count=\"%show_count%\"
					data-button=\"%button%\"
					data-text-color=\"%text_color%\"
					data-link-color=\"%link_color%\"
					data-lang=\"%language%\"
					data-width=\"%width%\"
					data-align=\"%align%\"
					>Follow @%username%</a><script src=\"http://platform.twitter.com/widgets.js\" type=\"text/javascript\"></script>";
		
		$output = str_replace('%username%', $username, $output);
		$output = str_replace('%show_count%', $show_count, $output);
		$output = str_replace('%button%', $button, $output);
		$output = str_replace('%text_color%', $text_color, $output);
		$output = str_replace('%link_color%', $link_color, $output);
		$output = str_replace('%language%', $language, $output);
		$output = str_replace('%width%', $width, $output);
		$output = str_replace('%align%', $align, $output);
		
		// Echo output
		echo $output;
		
		echo $after_widget;
    }
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		// Update values
		$instance['title'] 		= strip_tags(stripslashes($new_instance['title']));
		$instance['username'] 	= (!empty($new_instance['username']) ? strip_tags(stripslashes($new_instance['username'])) : strip_tags(stripslashes($old_instance['username'])));
		$instance['show_count'] = (!empty($new_instance['show_count']) ? strip_tags(stripslashes($new_instance['show_count'])) : strip_tags(stripslashes($old_instance['show_count'])));
		$instance['button'] 	= (!empty($new_instance['button']) ? strip_tags(stripslashes($new_instance['button'])) : strip_tags(stripslashes($old_instance['button'])));
		$instance['text_color'] = (!empty($new_instance['text_color']) ? strip_tags(stripslashes($new_instance['text_color'])) : strip_tags(stripslashes($old_instance['text_color'])));
		$instance['link_color'] = (!empty($new_instance['link_color']) ? strip_tags(stripslashes($new_instance['link_color'])) : strip_tags(stripslashes($old_instance['link_color'])));
		$instance['language'] 	= (!empty($new_instance['language']) ? strip_tags(stripslashes($new_instance['language'])) : strip_tags(stripslashes($old_instance['language'])));
		$instance['width'] 		= (!empty($new_instance['width']) ? strip_tags(stripslashes($new_instance['width'])) : strip_tags(stripslashes($old_instance['width'])));
		$instance['align'] 		= (!empty($new_instance['align']) ? strip_tags(stripslashes($new_instance['align'])) : strip_tags(stripslashes($old_instance['align'])));
		
		return $instance;
    }
	
	function form($instance)
	{
		// Defaults
		$instance = wp_parse_args( (array) $instance, array('username' => 'janheuninck', 'show_count' => 'true', 'button' => 'white', 'text_color' => '000000', 'link_color' => '186487', 'language' => 'en', 'width' => '300px', 'align' => 'left'));
		
		// Get values
		$title 		= esc_attr($instance['title']);
		$username 	= esc_attr($instance['username']);
		$show_count = esc_attr($instance['show_count']);
		$button 	= esc_attr($instance['button']);
		$text_color = esc_attr($instance['text_color']);
		$link_color = esc_attr($instance['link_color']);
		$language 	= esc_attr($instance['language']);
		$width 		= esc_attr($instance['width']);
		$align 		= esc_attr($instance['align']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'tf-button'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', 'tf-button'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_count_yes'); ?>"><?php _e('Show count', 'tf-button'); ?>:</label><br />
			<input type="radio" id="<?php echo $this->get_field_name('show_count_yes'); ?>" name="<?php echo $this->get_field_name('show_count'); ?>" value="true"<?php checked('true', $show_count); ?>/>
			<label><?php _e('Yes', 'tf-button'); ?></label>
			<input type="radio" id="<?php echo $this->get_field_name('show_count_no'); ?>" name="<?php echo $this->get_field_name('show_count'); ?>" value="false"<?php checked('false', $show_count); ?>/>
			<label><?php _e('No', 'tf-button'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_white'); ?>"><?php _e('Button', 'tf-button'); ?>:</label><br />
			<input type="radio" id="<?php echo $this->get_field_name('button_white'); ?>" name="<?php echo $this->get_field_name('button'); ?>" value="white"<?php checked('white', $button); ?>/>
			<label><?php _e('White', 'tf-button'); ?></label>
			<input type="radio" id="<?php echo $this->get_field_name('button_grey'); ?>" name="<?php echo $this->get_field_name('button'); ?>" value="grey"<?php checked('grey', $button); ?>/>
			<label><?php _e('Grey', 'tf-button'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('text_color'); ?>"><?php _e('Text color', 'tf-button'); ?>:</label>
			 #<input id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="text" value="<?php echo $text_color; ?>" size="6" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('link_color'); ?>"><?php _e('Link color', 'tf-button'); ?>:</label>
			#<input id="<?php echo $this->get_field_id('link_color'); ?>" name="<?php echo $this->get_field_name('link_color'); ?>" type="text" value="<?php echo $link_color; ?>" size="6" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('language'); ?>"><?php _e('Language', 'tf-button'); ?>:</label>
			<select id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>">
				<option value="en"<?php selected('en', $language); ?>><?php _e('English', 'tf-button'); ?></option>
				<option value="fr"<?php selected('fr', $language); ?>><?php _e('French', 'tf-button'); ?></option>
				<option value="de"<?php selected('de', $language); ?>><?php _e('German', 'tf-button'); ?></option>
				<option value="it"<?php selected('it', $language); ?>><?php _e('Italian', 'tf-button'); ?></option>
				<option value="ja"<?php selected('ja', $language); ?>><?php _e('Japanese', 'tf-button'); ?></option>
				<option value="ko"<?php selected('ko', $language); ?>><?php _e('Korean', 'tf-button'); ?></option>
				<option value="ru"<?php selected('ru', $language); ?>><?php _e('Russian', 'tf-button'); ?></option>
				<option value="es"<?php selected('es', $language); ?>><?php _e('Spanish', 'tf-button'); ?></option>
				<option value="tr"<?php selected('tr', $language); ?>><?php _e('Turkish', 'tf-button'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width', 'tf-button'); ?>:</label>
			<input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" size="4" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('align'); ?>"><?php _e('Align', 'tf-button'); ?>:</label><br />
			<input type="radio" id="<?php echo $this->get_field_name('align_left'); ?>" name="<?php echo $this->get_field_name('align'); ?>" value="left"<?php checked('left', $align); ?>/>
			<label><?php _e('Left', 'tf-button'); ?></label>
			<input type="radio" id="<?php echo $this->get_field_name('align_right'); ?>" name="<?php echo $this->get_field_name('align'); ?>" value="right"<?php checked('right', $align); ?>/>
			<label><?php _e('Right', 'tf-button'); ?></label>
		</p>
		<?php
    }
}

// Register TF_Button_Widget widget
add_action('widgets_init', create_function('', 'return register_widget("TF_Button_Widget");'));

// Load translations
load_plugin_textdomain('tf-button', false, dirname(plugin_basename( __FILE__ )) . '/languages/');

?>