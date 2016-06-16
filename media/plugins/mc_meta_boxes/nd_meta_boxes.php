<?php

/**
 * Plugin Name: MC Meta Boxes
 * Plugin URI: http://www.newsday.com
 * Description: Custom meta boxes for all CV properties
 * Version: 1.0
 * Author: TC McCarthy, Matthew Cassella
 * License: GPL2
 */
class nd_meta_boxes {

    public $boxes,
            $post_types = array("post", "page", "slide", "poll_gallery"),
            $filters,
            $current_post_type,
            $postmeta,
            $nonce;

    public function __construct() {

        if (isset($_GET["post"]))
            $this->postmeta = (object) get_post_meta($_GET["post"]);

        $this->register_boxes();
        $this->register_filters();

        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'newsday_create_meta_box'));
        add_action('save_post', array($this, 'newsday_save_meta_data'));
    }

    public function enqueue_scripts() {
        $this->nonce = wp_create_nonce(plugin_basename(__FILE__));

        if ($this->is_valid_post_type()) {
            wp_enqueue_style('meta-boxes', plugin_dir_url(__FILE__) . "meta.css");
        }
    }

    public function is_valid_post_type() {
        $this->current_post_type = get_current_screen()->post_type;

        if (in_array($this->current_post_type, $this->post_types))
            return true;


        return false;
    }

    public function register_boxes() {
        $this->boxes = (object) array(
                    //fields
                    'format_settings' => array('name' => 'format_settings', 'type' => 'open', 'title' => __('Format Settings', 'newsday')),
                    'property_select' => array('name' => 'property_select', 'title' => __('Property', 'newsday'), 'desc' => 'Choose the main property.', 'options' => array('Newsday', 'News 12', 'AMNY'), 'type' => 'select'),
                    'project_link' => array('name' => 'project_link', 'title' => __('Project Link', 'newsday'), 'desc' => 'Link to the live project', 'type' => 'text', 'size' => 'large',),
                    'autop' => array('name' => 'autop', 'title' => __('Disable Auto P', 'newsday'), 'desc' => 'Disable auto paragraphs.', 'type' => 'checkbox'),
                    //'just_gage' => array('name' => 'just_gage', 'title' => __('Just Gage JS', 'newsday'), 'desc' => 'Use the JustGage JS to dynamically display round graphs.', 'type' => 'checkbox'),
                    //'swap_leader' => array('name' => 'swap_leader', 'title' => __('Swap Leader Ad', 'newsday'), 'desc' => 'Toggle to swap leader ad to above the slim header', 'type' => 'checkbox'),
                    //'gate_check' => array('name' => 'gate_check', 'title' => __('Gate Check', 'newsday'), 'desc' => 'Toggle to make this page gated (news12 only)', 'type' => 'checkbox'),
                    //'hide_h1' => array('name' => 'hide_h1', 'title' => __('Hide Page Title h1', 'newsday'), 'desc' => 'hide h1 in the main article. used if you have the title in the top content', 'type' => 'checkbox'),
                    'alt_img' => array('name' => 'alt_img', 'title' => __('Alt Image', 'newsday'), 'desc' => 'Alternate image for post landing.', 'type' => 'text', 'size' => 'large',),
                    'subhead' => array('name' => 'subhead', 'title' => __('Subhead', 'newsday'), 'desc' => 'Override subhead under name in header.', 'type' => 'text', 'size' => 'large',),
            'amny_cobrand' => array('name' => 'amny_cobrand', 'title' => __('AMNY Cobrand', 'newsday'), 'desc' => 'Add an AMNY logo to head for dual brand', 'type' => 'checkbox'),
                    'nav_html' => array('name' => 'nav_html', 'title' => __('Project Navigation HTML', 'newsday'), 'desc' => 'HTML to show right below slim nav for project navigation.', 'type' => 'textarea', 'size' => 'large',),
                    'newsday_related_html' => array('name' => 'newsday_related_html', 'title' => __('Related HTML Content', 'newsday'), 'desc' => 'HTML for related content at bottom of the page.', 'size' => 'large', 'type' => 'textarea'),
                    'dev_settings' => array('name' => 'dev_settings', 'type' => 'open', 'title' => __('Developer Settings', 'newsday')),
                    'newsday_top_content' => array('name' => 'newsday_top_content', 'title' => __('HTML Content', 'newsday'), 'desc' => 'Add any content, including shortcodes, that you want to insert in specific places in the template. Mosaic: Include HTML for photos. Parallax: Top content inside main above all other content.', 'size' => 'large', 'type' => 'textarea'),
                    'newsday_lead_content' => array('name' => 'newsday_lead_content', 'title' => __('Lead Content', 'newsday'), 'desc' => 'Add any content, including shortcodes, that you want to insert at the top of the template outside of the main', 'size' => 'large', 'type' => 'textarea'),
                    'newsday_custom_css' => array('name' => 'newsday_custom_css', 'title' => __('Custom CSS', 'newsday'), 'desc' => 'Custom Style block code goes here. Include style tag. Will be placed in header above all content.', 'size' => 'large', 'type' => 'textarea'),
                    'newsday_custom_js' => array('name' => 'newsday_custom_js', 'title' => __('Custom Javascript', 'newsday'), 'desc' => 'Custom Javascript block code goes here. Include script tag. Will be placed in footer below other javascripts.', 'size' => 'large', 'type' => 'textarea'),
                    'newsday_project_tag' => array('name' => 'newsday_project_tag', 'title' => __('Project tag', 'newsday'), 'desc' => 'What is the slug for the project tag? This is used for getting the correct JSON feed.', 'size' => 'large', 'type' => 'text'),
                    'newsday_topic_meta_desc' => array('name' => 'newsday_topic_meta_desc', 'title' => __('Topic page meta description', 'newsday'), 'desc' => 'What should the appear in the meta description of topic pages. Use "%" to insert tags. (Used with the PourOver template)', 'size' => 'large', 'type' => 'text'),
                    'general_settings' => array('name' => 'general_settings', 'type' => 'open', 'title' => __('General Settings', 'newsday')),
                    'newsday_slide_url' => array('name' => 'newsday_slide_url', 'title' => __('Slide URL', 'newsday'), 'desc' => 'Enter the URL you want your slide to link to.', 'type' => 'text'),
                    'newsday_slide_link_type' => array('name' => 'newsday_slide_link_type', 'title' => __('Link Type', 'newsday'), 'desc' => 'Choose how your slide links to the URL you provided to the left  (only applies to slides with an image entered below).', 'options' => array('Page URL', 'Lightbox Image', 'Lightbox Video'), 'type' => 'select'),
                    'newsday_slide_timeout' => array('name' => 'newsday_slide_timeout', 'title' => __('Fade Slider Slide Timeout', 'newsday'), 'std' => '', 'desc' => 'The number of seconds this slide remains in view for (Tip: match the length of your video to the timeout value).', 'type' => 'text_small'),
                    'image_settings' => array('name' => 'image_settings', 'type' => 'open', 'title' => __('Image Settings', 'newsday')),
                    'newsday_slide_image' => array('name' => 'newsday_slide_image', 'title' => __('Image URL', 'newsday'), 'desc' => 'The absolute URL of the image (polopoly or Wordpress)', 'extras' => 'getimage', 'type' => 'text'),
                    'newsday_slide_crop' => array('name' => 'newsday_slide_crop', 'title' => __('Image Crop', 'newsday'), 'desc' => 'Choose how this image is displayed.', 'options' => array('Best Fit', 'Proportional (Borders)', 'None'), 'type' => 'select'),
                    'newsday_slide_crop_position' => array('name' => 'newsday_slide_crop_position', 'title' => __('Image Crop Position', 'newsday'), 'desc' => 'Choose what part of the image is displayed.', 'options' => array('Center', 'Top', 'Bottom'), 'type' => 'select'),
                    'video_settings' => array('name' => 'video_settings', 'type' => 'open', 'title' => __('Video Settings', 'newsday')),
                    'newsday_slide_video' => array('name' => 'newsday_slide_video', 'title' => __('Video URL', 'newsday'), 'desc' => 'Enter your video or audio URL (YouTube/FLV/MP4/M4V/MP3 accepted).', 'extras' => 'getvideo', 'type' => 'text'),
                    'newsday_webm_mp4_slide_video' => array('name' => 'newsday_webm_mp4_slide_video', 'title' => __('HTML5 Video URL (Safari/Chrome)', 'newsday'), 'desc' => 'Enter your HTML5 video URL for Safari/Chrome (WEBM/MP4).', 'extras' => 'getvideo', 'type' => 'text'),
                    'newsday_ogg_slide_video' => array('name' => 'newsday_ogg_slide_video', 'title' => __('HTML5 Video URL (FireFox/Opera)', 'newsday'), 'desc' => 'Enter your HTML5 video URL for FireFox/Opera (OGG/OGV).', 'extras' => 'getvideo', 'type' => 'text'),
                    'newsday_slide_autostart_video' => array('name' => 'newsday_slide_autostart_video', 'title' => __('Autostart Video', 'newsday'), 'desc' => 'Plays the video/audio automatically when the slide comes into view (does not work in Internet Explorer, unless video is displayed in first slide).', 'type' => 'checkbox'),
                    'newsday_slide_video_priority' => array('name' => 'newsday_slide_video_priority', 'title' => __('Video Priority', 'newsday'), 'desc' => 'If you have provided both flash and HTML5 videos, select which one will take priority if the browser can play both.', 'options' => array('Flash', 'HTML5'), 'type' => 'select'),
                    'newsday_slide_video_controls' => array('name' => 'newsday_slide_video_controls', 'title' => __('Video Controls', 'newsday'), 'desc' => 'Choose how to display the video controls (does not apply to Vimeo videos).', 'options' => array('None', 'Bottom', 'Over'), 'type' => 'select'),
                    'caption_settings' => array('name' => 'caption_settings', 'type' => 'open', 'title' => __('Caption Settings', 'newsday')),
                    'newsday_slide_caption_type' => array('name' => 'newsday_slide_caption_type', 'title' => __('Caption Type', 'newsday'), 'desc' => 'The type of caption for your slide.', 'options' => array('None', '-----ACCORDION SLIDER-----', 'Top', 'Bottom', '--------FADE SLIDER--------', 'Left Frame', 'Right Frame', 'Top Left Overlay', 'Top Right Overlay', 'Bottom Left Overlay', 'Bottom Right Overlay'), 'type' => 'select'),
                    'newsday_slide_caption_style' => array('name' => 'newsday_slide_caption_style', 'title' => __('Caption Style', 'newsday'), 'desc' => 'The style of caption for your slide.', 'options' => array('Dark', 'Light'), 'type' => 'select'),
                    'newsday_hide_slide_title' => array('name' => 'newsday_hide_slide_title', 'title' => __('Hide Slider Title', 'newsday'), 'desc' => 'Hide the page title from appearing in the caption.', 'type' => 'checkbox'),
                    'newsday_custom_byline' => array('name' => 'newsday_custom_byline', 'title' => __('Custom Byline', 'newsday'), 'desc' => 'custom byline', 'type' => 'text'),
                    //elements
                    'divider' => array('type' => 'divider'),
                    'clear' => array('type' => 'clear'),
                    'close' => array('type' => 'close'),
        );
    }

    public function newsday_create_meta_box() {
        global $theme_name;

        foreach ($this->post_types as $type) {
            $search = array("/[_]+/", "/[-]+/");
            $replace = array(" ", " ");
            $name = preg_replace($search, $replace, $type) . " Settings";

            add_meta_box("{$type}-meta-boxes", __(ucwords($name)), array($this, 'build_meta_boxes'), $type, 'normal', 'high');
        }
    }

    //filter functions
    public function newsday_post_meta_boxes() {
        $meta_boxes = array(
            $this->boxes->format_settings,
            $this->boxes->property_select,
            $this->boxes->project_link,
            $this->boxes->divider,
            $this->boxes->autop,
            //$this->boxes->just_gage,
            //$this->boxes->swap_leader,
            //$this->boxes->clear,
            //$this->boxes->gate_check,
            //$this->boxes->hide_h1,
            //$this->boxes->amny_cobrand,
            $this->boxes->divider,
            $this->boxes->alt_img,
            $this->boxes->subhead,
            $this->boxes->newsday_custom_byline,
            $this->boxes->divider,
            $this->boxes->nav_html,
            $this->boxes->newsday_related_html,
            $this->boxes->close,
            $this->boxes->clear,
            $this->boxes->dev_settings,
            $this->boxes->newsday_top_content,
            $this->boxes->divider,
            $this->boxes->newsday_lead_content,
            $this->boxes->divider,
            $this->boxes->newsday_custom_css,
            $this->boxes->divider,
            $this->boxes->newsday_custom_js,
            $this->boxes->divider,
            $this->boxes->newsday_project_tag,
            $this->boxes->newsday_topic_meta_desc,
            $this->boxes->close,
            $this->boxes->clear
        );

        return apply_filters('newsday_post_meta_boxes', $meta_boxes);
    }

    public function newsday_page_meta_boxes() {

        $meta_boxes = array(
            $this->boxes->format_settings,
            $this->boxes->property_select,
            $this->boxes->project_link,
            $this->boxes->divider,
            $this->boxes->autop,
            //$this->boxes->just_gage,
            //$this->boxes->swap_leader,
            //$this->boxes->clear,
            //$this->boxes->gate_check,
            //$this->boxes->hide_h1,
            //$this->boxes->amny_cobrand,
            $this->boxes->divider,
            $this->boxes->alt_img,
            $this->boxes->subhead,
            $this->boxes->newsday_custom_byline,
            $this->boxes->divider,
            $this->boxes->nav_html,
            $this->boxes->newsday_related_html,
            $this->boxes->close,
            $this->boxes->clear,
            $this->boxes->dev_settings,
            $this->boxes->newsday_top_content,
            $this->boxes->divider,
            $this->boxes->newsday_lead_content,
            $this->boxes->divider,
            $this->boxes->newsday_custom_css,
            $this->boxes->divider,
            $this->boxes->newsday_custom_js,
            $this->boxes->divider,
            $this->boxes->newsday_project_tag,
            $this->boxes->newsday_topic_meta_desc,
            $this->boxes->close,
            $this->boxes->clear
        );

        return apply_filters('newsday_page_meta_boxes', $meta_boxes);
    }

    public function newsday_slide_meta_boxes() {
        $meta_boxes = array(
            $this->boxes->general_settings,
            $this->boxes->newsday_slide_url,
            $this->boxes->newsday_slide_link_type,
            $this->boxes->newsday_slide_timeout,
            $this->boxes->close,
            $this->boxes->image_settings,
            $this->boxes->newsday_slide_image,
            $this->boxes->newsday_slide_crop,
            $this->boxes->newsday_slide_crop_position,
            $this->boxes->close,
            $this->boxes->video_settings,
            $this->boxes->newsday_slide_video,
            $this->boxes->newsday_webm_mp4_slide_video,
            $this->boxes->newsday_ogg_slide_video,
            $this->boxes->divider,
            $this->boxes->newsday_slide_autostart_video,
            $this->boxes->newsday_slide_video_priority,
            $this->boxes->newsday_slide_video_controls,
            $this->boxes->close,
            $this->boxes->caption_settings,
            $this->boxes->newsday_slide_caption_type,
            $this->boxes->newsday_slide_caption_style,
            $this->boxes->newsday_hide_slide_title,
            $this->boxes->close,
            $this->boxes->clear
        );

        return apply_filters('newsday_slide_meta_boxes', $meta_boxes);
    }

    public function newsday_poll_gallery_meta_boxes() {
        $meta_boxes = array(
            $this->boxes->format_settings,
            $this->boxes->property_select,
            $this->boxes->divider,
            $this->boxes->just_gage,
            $this->boxes->clear,
            $this->boxes->gate_check,
            $this->boxes->hide_h1,
            $this->boxes->divider,
            $this->boxes->newsday_related_html,
            $this->boxes->clear,
            $this->boxes->divider,
            $this->boxes->newsday_lead_content,
            $this->boxes->divider,
            $this->boxes->newsday_custom_css,
            $this->boxes->divider,
            $this->boxes->newsday_custom_js,
            $this->boxes->close,
            $this->boxes->clear
        );

        return apply_filters('newsday_poll_gallery_boxes', $meta_boxes);
    }

    //register filter functions
    public function register_filters() {
        $this->filters = (object) array(
                    "post" => $this->newsday_post_meta_boxes(),
                    "page" => $this->newsday_page_meta_boxes(),
                    "slide" => $this->newsday_slide_meta_boxes(),
                    "poll_gallery" => $this->newsday_poll_gallery_meta_boxes(),
        );
    }

    public function process_boxes() {
        foreach ($this->meta_boxes as $meta) {
            $value = (is_object($this->postmeta) && property_exists($this->postmeta, $meta['name'])) ? $this->postmeta->{$meta['name']}[0] : false;

            if ($meta['type'] == 'text')
                $this->get_meta_text($meta, $value);

            else if ($meta['type'] == 'text_small')
                $this->get_meta_text_small($meta, $value);

            elseif ($meta['type'] == 'textarea')
                $this->get_meta_textarea($meta, $value);

            elseif ($meta['type'] == 'select')
                $this->get_meta_select($meta, $value);

            elseif ($meta['type'] == 'select_sidebar')
                $this->get_meta_select_sidebar($meta, $value);

            elseif ($meta['type'] == 'checkbox')
                $this->get_meta_checkbox($meta, $value);

            elseif ($meta['type'] == 'open')
                $this->get_meta_open($meta, $value);

            elseif ($meta['type'] == 'close')
                $this->get_meta_close($meta, $value);

            elseif ($meta['type'] == 'divider')
                $this->get_meta_divider($meta, $value);

            elseif ($meta['type'] == 'clear')
                $this->get_meta_clear($meta, $value);
        }
    }

    public function build_meta_boxes($post, $metabox) {
        global $post;
        $this->meta_boxes = $this->filters->{$post->post_type};
        $this->process_boxes();
    }

    //field output markup
    public function get_meta_open($args = array(), $value = false) {
        extract($args);

        echo "
			<div class='meta-group'>
			<h3>{$title}</h3>
			<div class='group-desc'>{$desc}</div><div class='clear'></div>
			<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />
		";
    }

    //field output markup
    public function get_meta_close($args = array(), $value = false) {
        extract($args);

        echo "
			</div>
			<div class='clear'></div>
			<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />	
		";
    }

    public function get_meta_divider($args = array(), $value = false) {
        extract($args);

        echo "
			<div class='divider'></div>
			<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />		
		";
    }

    public function get_meta_clear($args = array(), $value = false) {
        extract($args);

        echo "
			<div class='clear'></div>
			<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />		

		";
    }

    public function get_meta_text($args = array(), $value = false) {
        extract($args);
        global $post;

        $html[] = "
			<div class='meta-box'>
				<strong>" . $title . "</strong>
				<br/><input type='text' name='" . $name . "' id='" . $name . "' value='" . esc_html($value) . "' size='30' tabindex='30' 
		";

        if ($extras == 'getimage' || $extras == 'getvideo') {
            $html[] = "class='uploadbutton'";
        }

        $html[] = "/>";

        if ($extras == 'getimage') {
            $html[] = "<a href='media-upload.php?post_id=" . $post->ID . "&amp;type=image&amp;TB_iframe=true&amp;width=640&amp;height=790' id='add_image' class='thickbox button' title='Add an Image' onclick='return false;'>Get Image</a>";
        } elseif ($extras == 'getvideo') {
            $html[] = "<a href='media-upload.php?post_id=" . $post->ID . "&amp;type=video&amp;TB_iframe=true&amp;width=640&amp;height=790' id='add_video' class='thickbox button' title='Add a Video' onclick='return false;'>Get Video</a>";
        }

        $html[] = "<div class='meta-desc'>{$desc}</div>
					<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />
					</div>";

        echo implode(" ", $html);
    }

    public function get_meta_text_small($args = array(), $value = false) {
        extract($args);
        $esc_html = (esc_html($value, 1)) ? esc_html($value, 1) : esc_html($std, 1);

        echo "<div class='meta-box'>
					<strong>{$title}/strong>
					<br/><input type='text' name='{$name}' id='{$name}' value='{$esc_html}' size='30' tabindex='30' class='small-textbox' />
					<div class='meta-desc'>{$desc}</div>
					<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />
				</div>";
    }

    public function get_meta_select_sidebar($args = array(), $value = false) {
        extract($args);
        global $post, $wp_registered_sidebars;
        $sidebars = $wp_registered_sidebars;

        $html[] = "<div class='meta-box'>
						<strong>{$title}</strong><br/>		
						<select name='" . $name . "' id='" . $name . "'>";

        if (is_array($sidebars) && !empty($sidebars)) {
            foreach ($sidebars as $sidebar) {
                $selected = ($value == $sidebar["name"]) ? "selected" : "";
                $html[] = "<option value='" . $sidebar['name'] . "' {$selected}>{$sidebar['name']}</option>";
            }
        }

        $html[] = "</select>
		<div class='meta-desc'>{$desc}</div>
			<input type='hidden' name='{$name}_noncename' id='{$name}_noncename' value='" . $this->nonce . "' />
		</div>";

        echo implode("", $html);
    }

    public function get_meta_select($args = array(), $value = false) {
        extract($args);

        $html[] = "<div class='meta-box'>
					<strong>" . $title . "</strong>
					<br/><select name='" . $name . "' id='" . $name . "'>";

        foreach ($options as $option) {
            $selected = (htmlentities($value, ENT_QUOTES) == $option) ? "selected" : "";
            $html[] = "<option $selected>" . $option . "</option>";
        }

        $html[] = "</select>
					<div class='meta-desc'>" . $desc . "</div>
						<input type='hidden' name='" . $name . "_noncename' id='" . $name . "_noncename' value='" . $value . "' />
					</div>";

        echo implode(" ", $html);
    }

    public function get_meta_textarea($args = array(), $value = false) {
        extract($args);

        $classes = ($size == "large") ? "meta-box-large" : "";

        echo "<div class='meta-box {$classes}'>
				<strong>" . $title . "</strong>
				<br/><textarea name='" . $name . "' id='" . $name . "' cols='60' rows='4' tabindex='30'>" . esc_html($value, 1) . "</textarea>
				<div class='meta-desc'>" . $desc . "</div>
				<input type='hidden' name='" . $name . "_noncename' id='" . $name . "_noncename' value='" . $this->nonce . "' />
			</div>";
    }

    public function get_meta_checkbox($args = array(), $value = false) {
        extract($args);
        $checked = "";

        if (esc_html($value, 1) || $std === 'true') {
            $checked = "checked";
        }

        echo "<div class='meta-box'>
					<strong>" . $title . "</strong>
					<input type='checkbox' name='" . $name . "' id='" . $name . "' value='false' " . $checked . " />
					<div class='meta-desc'>" . $desc . "</div>
					<input type='hidden' name='" . $name . "_noncename' id='" . $name . "_noncename' value='" . $this->nonce . "' /></p>			
				</div>";
    }

    public function newsday_save_meta_data($post_id) {
        global $post;

        if (in_array($post->post_type, $this->post_types)) {
            $meta_boxes = array_merge($this->filters->{$post->post_type});

            foreach ($meta_boxes as $meta_box) {

                if (in_array($post->post_type, $this->post_types) && !current_user_can('edit_page', $post_id))
                    return $post_id;

                $data = $_POST[$meta_box['name']];

                //if the data isn't blank
                if ($data != "") {
                    //we use the update function because it first checks for the records and runs add instead if the check fails. No need for redundant logic
                    update_post_meta($post_id, $meta_box['name'], $data);
                } else {
                    delete_post_meta($post_id, $meta_box['name'], $this->postmeta->{$meta['name']}[0]);
                }
            }
        }
    }

}

$ndMetaBoxes = new nd_meta_boxes();
