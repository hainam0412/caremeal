<?php
require_once(ABSPATH . 'wp-includes/pluggable.php');
$vnexoption = vnex_all_options();
function vnex_admin_scripts() {
	wp_register_script( 'vnex-color-picker', plugins_url('js/color-picker.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'vnex-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_media();
	wp_register_script( 'vnex-media-upload', plugins_url('js/media-upload.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'vnex-media-upload' );
}
function vnex_admin_styles() {
	wp_register_style('vnex-extra', plugins_url('css/extra.min.css', __FILE__ ), array() );
	wp_enqueue_style('vnex-extra');
}
add_action('admin_enqueue_scripts', 'vnex_admin_scripts');
add_action('admin_enqueue_scripts', 'vnex_admin_styles');

if ($vnexoption['vnex_remove_gutenberg']) {
	add_action( 'current_screen', 'this_screen_gutenberg_remove' );
	function this_screen_gutenberg_remove() {
		$current_screen = get_current_screen();
		$vnexoption = vnex_all_options();
		if($vnexoption['vnex_remove_gutenberg'] == 1) {
			add_filter('use_block_editor_for_post_type', '__return_false', 100);
		}
		if(($vnexoption['vnex_remove_gutenberg'] == 2) && $current_screen->id === "post" ) {
			add_filter('use_block_editor_for_post_type', '__return_false', 100);
		}
	}
}

if ($vnexoption['vnex_mce'] == 1) {
	if ($vnexoption['vnex_mce_prismjs']) {
		if ($vnexoption['vnex_mce_prismjs'] == 1) {
			function prims_scripts_enqueue () {
				wp_enqueue_style ('prism-css', plugins_url('tinymce/codesample/css/prism.css', __FILE__ ));
				wp_enqueue_script ('prims-js', plugins_url('tinymce/codesample/js/prism.js', __FILE__ ));
			}
		} elseif ($vnexoption['vnex_mce_prismjs'] == 2) {
			function prims_scripts_enqueue () {
				wp_enqueue_style ('prism-css', plugins_url('tinymce/codesample/css/prism-dark.css', __FILE__ ));
				wp_enqueue_script ('prims-js', plugins_url('tinymce/codesample/js/prism.js', __FILE__ ));
			}
		}
		add_action( 'wp_enqueue_scripts', 'prims_scripts_enqueue' );
		function vnex_mce_load_extra_plugins_prims ( $plugins ) {
			foreach(array('codesample') as $item){
				$plugins[$item] = plugins_url('tinymce/',__FILE__ ) .$item.'/plugin.min.js';
			}
			return $plugins;
		}
		add_filter( 'mce_external_plugins', 'vnex_mce_load_extra_plugins_prims' );
	}
	
	function vnex_mce_load_extra_plugins( $plugins ) {
		foreach(array('searchreplace','table','visualblocks') as $item){
			$plugins[$item] = plugins_url('tinymce/',__FILE__ ) .$item.'/plugin.min.js';
		}
		return $plugins;
	}
	add_filter( 'mce_external_plugins', 'vnex_mce_load_extra_plugins' );
	function vnex_mce_row_first($buttons)
	{
		$remove_first= array(0=>'bold','italic','strikethrough','alignleft','aligncenter','alignright',
						'link','unlink','wp_more','bullist' ,'numlist','blockquote','hr','spellchecker','formatselect');
		$new_buttons=array('styleselect','formatselect','bold','italic','underline','strikethrough','alignleft','aligncenter','alignright','alignjustify','bullist','numlist','outdent','indent','link','unlink','hr','wp_more','wp_page');			
		foreach($buttons as $index=>$item){
			if(in_array($item,$remove_first)){
				unset($buttons[$index]);
			}else{
				$new_buttons[]=$item;
			}
		}
		$new_buttons[] ='wp_help';
		$new_buttons[] ='fullscreen';
		return $new_buttons;
	}
	add_filter("mce_buttons", "vnex_mce_row_first");
	function vnex_mce_row_second($buttons){
		$remove_second= array(0=>'formatselect','strikethrough','undo' ,'redo','outdent','indent','forecolor','wp_help','hr');
		$new_buttons_2=array('fontselect','fontsizeselect','forecolor','backcolor','undo' ,'redo','blockquote','table','codesample','visualblocks','searchreplace');		
		foreach($buttons as $index=>$item){
			if(in_array($item,$remove_second)){
				unset($buttons[$index]);
			}else{
				$new_buttons_2[]=$item;
			}
		}
		return $new_buttons_2;
	}
	add_filter("mce_buttons_2", "vnex_mce_row_second");
	function vnex_text_sizes( $initArray ){
	  $initArray['fontsize_formats'] = "8px 10px 12px 14px 16px 20px 24px 28px 32px 36px 48px 60px 72px 96px";
	  return $initArray;
	}
	add_filter( 'tiny_mce_before_init', 'vnex_text_sizes' );
	function remove_auto_p_tinymce($in) {
		$in['forced_root_block'] = "";
		//$in['force_br_newlines'] = false;
		$in['force_p_newlines'] = true;
	return $in;
	}
	add_filter( 'tiny_mce_before_init', 'remove_auto_p_tinymce' );
} 
if ($vnexoption['vnex_mce'] == 2) {
	
	function vnex_mce_load_extra_plugins( $plugins ) {
		foreach(array('searchreplace','codesample','table','visualblocks') as $item){
			$plugins[$item] = plugins_url('tinymce/',__FILE__ ) .$item.'/plugin.min.js';
		}
		return $plugins;
	}
	add_filter( 'mce_external_plugins', 'vnex_mce_load_extra_plugins' );
	function vnex_mce_row_first($buttons)
	{
		$remove_first= array(0=>'styleselect','bold','italic','strikethrough','alignleft','aligncenter','alignright',
						'link','unlink','wp_more','bullist' ,'numlist','blockquote','hr','spellchecker','formatselect','fullscreen','alignjustify');
		$new_buttons=array('formatselect','bold','italic','underline','strikethrough','alignleft','aligncenter','alignright','alignjustify','bullist','numlist','outdent','indent','link','unlink','hr','wp_more','wp_page');			
		foreach($buttons as $index=>$item){
			if(in_array($item,$remove_first)){
				unset($buttons[$index]);
			}else{
				$new_buttons[]=$item;
			}
		}
		$new_buttons[] ='wp_help';
		$new_buttons[] ='fullscreen';
		return $new_buttons;
	}
	add_filter("mce_buttons", "vnex_mce_row_first");
	function vnex_mce_row_second($buttons){
		$remove_second= array(	0=>'fontsizeselect','formatselect','strikethrough','undo' ,'redo','outdent','indent','forecolor','wp_help','hr','backcolor');
		$new_buttons_2=array('fontselect','fontsizeselect','forecolor','backcolor','undo' ,'redo','blockquote','table','codesample','visualblocks','searchreplace');		
		foreach($buttons as $index=>$item){
			if(in_array($item,$remove_second)){
				unset($buttons[$index]);
			}else{
				$new_buttons_2[]=$item;
			}
		}
		return $new_buttons_2;
	}
	add_filter("mce_buttons_2", "vnex_mce_row_second", 9999);
	function remove_auto_p_tinymce($in) {
		$in['forced_root_block'] = "";
		//$in['force_br_newlines'] = false;
		$in['force_p_newlines'] = true;
	return $in;
	}
	add_filter( 'tiny_mce_before_init', 'remove_auto_p_tinymce' );
}

if ($vnexoption['vnex_disable_emojis'] == 1) {
	function vnex_disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );	
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'vnex_disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'vnex_disable_emojis_remove_dns_prefetch', 10, 2 );
	}
	add_action( 'init', 'vnex_disable_emojis' );
	function vnex_disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		}
		return array();
	}
	function vnex_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
			foreach ( $urls as $key => $url ) {
				if ( strpos( $url, $emoji_svg_url_bit ) !== false ) {
					unset( $urls[$key] );
				}
			}
		}
		return $urls;
	}
}

if ($vnexoption['vnex_post_revisions']) {
    $vnexoption = vnex_all_options();
    if (!defined('WP_POST_REVISIONS'))
        define('WP_POST_REVISIONS', sanitize_text_field($vnexoption['vnex_post_revisions']));
}

if ($vnexoption['vnex_admin_footer']) {
    function vnex_admin_footer_name()
    {
        $vnexoption = vnex_all_options();
        echo '<span id="footer-thankyou"><a href="' . get_bloginfo('wpurl') . '" target="_blank">' .sanitize_text_field($vnexoption['vnex_admin_footer']).'</a></span>';
    }
    add_filter('admin_footer_text', 'vnex_admin_footer_name');
}

if ($vnexoption['vnex_remove_head_link'] == 1) {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
}

if ($vnexoption['vnex_hide_admin_bar'] == 1) {
	add_action('admin_print_scripts-profile.php', 'hide_admin_bar_prefs');
	function hide_admin_bar_prefs() { ?>
	<style type="text/css">
		.show-admin-bar {display: none;} #wpadminbar { display:none; }
	</style>
	<?php
	}
	add_filter('show_admin_bar', '__return_false');
}
elseif ($vnexoption['vnex_hide_admin_bar'] == 2) {
	add_action('init', 'remove_admin_bar');
	function remove_admin_bar() {
	  if (!current_user_can('administrator') && !is_admin()) {
		add_action('admin_print_scripts-profile.php', 'hide_admin_bar_prefs');
		function hide_admin_bar_prefs() { ?>
		<style type="text/css">
			.show-admin-bar {display: none;} #wpadminbar { display:none; }
		</style>
		<?php
		}
		add_filter('show_admin_bar', '__return_false');
	  }
	}
}

if ($vnexoption['vnex_back_access'] == 1) {
	function redirect_non_admin_user(){
		if ( !defined( 'DOING_AJAX' ) && !current_user_can('administrator') ){
			wp_redirect( site_url() );  exit;
		} 
	}
	add_action( 'admin_init', 'redirect_non_admin_user' );
}

if ($vnexoption['vnex_wc_disabled'] == 1) {
	add_filter( 'woocommerce_admin_disabled', '__return_true' );
}

if ($vnexoption['vnex_disable_feed'] == 1) {
    function disable_feeds() {
		wp_redirect( home_url() );
		die;
	}
	// Disable global RSS, RDF & Atom feeds.
	add_action( 'do_feed',      'disable_feeds', -1 );
	add_action( 'do_feed_rdf',  'disable_feeds', -1 );
	add_action( 'do_feed_rss',  'disable_feeds', -1 );
	add_action( 'do_feed_rss2', 'disable_feeds', -1 );
	add_action( 'do_feed_atom', 'disable_feeds', -1 );
	// Disable comment feeds.
	add_action( 'do_feed_rss2_comments', 'disable_feeds', -1 );
	add_action( 'do_feed_atom_comments', 'disable_feeds', -1 );
	// Prevent feed links from being inserted in the <head> of the page.
	add_action( 'feed_links_show_posts_feed',    '__return_false', -1 );
	add_action( 'feed_links_show_comments_feed', '__return_false', -1 );
	remove_action( 'wp_head', 'feed_links',       2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
}

if ($vnexoption['vnex_remove_version'] == 1) {
    function vnex_remove_version()
    {
        return '';
    }
    add_filter('the_generator', 'vnex_remove_version');
	function change_footer_admin () {return ' ';}
	add_filter('admin_footer_text', 'change_footer_admin', 9999);
	function change_footer_version() {return ' ';}
	add_filter( 'update_footer', 'change_footer_version', 9999);
	remove_action('wp_head', 'wp_generator');
	add_filter('the_generator', '__return_empty_string');
	function vnex_remove_version_scripts_styles($src) {
		if (strpos($src, 'ver=')) {
			$src = remove_query_arg('ver', $src);
		}
		return $src;
	}
	add_filter('style_loader_src', 'vnex_remove_version_scripts_styles', 9999);
	add_filter('script_loader_src', 'vnex_remove_version_scripts_styles', 9999);
	add_filter( 'contextual_help', 'vnex_remove_help_tabs', 999, 3 );
	function vnex_remove_help_tabs($vnex_old_help, $screen_id, $screen){
		$screen->remove_help_tabs();
		return $vnex_old_help;
	}
	add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
	function remove_wp_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}
}

if ($vnexoption['vnex_button_post'] == 1) {
    add_action( 'admin_enqueue_scripts', 'vnex_post_button_enqueue_scripts', 20 );
	function vnex_post_button_enqueue_scripts() {
		global $pagenow;
		if ( is_admin() && ($pagenow == 'post.php' || $pagenow == 'post-new.php') ) {
			wp_register_script('post-button', plugin_dir_url( __FILE__ ) . 'js/post-button.js', array( 'jquery' ) );
			wp_enqueue_script('post-button');
		}
	}
}

if ($vnexoption['vnex_donotcopy'] == 1) {
	if ( ! current_user_can( 'manage_options' ) ) {
		function donotcopy_function() {
			wp_register_script( 'donotcopy', plugin_dir_url( __FILE__ ) . 'js/copy.js', array( 'jquery' ) );
			wp_enqueue_script( 'donotcopy' );
		}
		add_action( 'template_redirect', 'donotcopy_function' );
	}
}

if ($vnexoption['vnex_allow_svg'] == 1) {
	function ignore_upload_ext($checked, $file, $filename, $mimes){
		if(!$checked['type']){
			$wp_filetype = wp_check_filetype( $filename, $mimes );
			$ext = $wp_filetype['ext'];
			$type = $wp_filetype['type'];
			$proper_filename = $filename;
			if($type && 0 === strpos($type, 'image/') && $ext !== 'svg'){
				$ext = $type = false;
			}
			$checked = compact('ext','type','proper_filename');
		}
		return $checked;
	}
	add_filter('wp_check_filetype_and_ext', 'ignore_upload_ext', 10, 4);
}

if ($vnexoption['vnex_auto_save_images']) {
	include plugin_dir_path( __FILE__ ) . 'inc/auto-save-images.php';
}

if ($vnexoption['vnex_image_resize']) {
	include plugin_dir_path( __FILE__ ) . 'inc/auto-resize-image.php';
}

if ($vnexoption['vnex_html_custom_css'] || $vnexoption['vnex_html_custom_css_tablet'] || $vnexoption['vnex_html_custom_css_mobile']) {
	include plugin_dir_path( __FILE__ ) . 'inc/custom-css.php';
}

if ($vnexoption['vnex_auto_set_featured_image']) {
	function set_featured_img_content($post_id){
		if(isset($post_id)) {
			$content_post = get_post($post_id);
			$content = $content_post->post_content;
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
			$filename = isset($matches[1][0]) ? $matches[1][0] : false;
			return $filename;
		}
	}
	function set_featured_image_on_save ($post_id){
		$attachments = get_posts(array('numberposts' => '1', 'post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC'));
		if(sizeof($attachments) > 0){
			set_post_thumbnail($post_id, $attachments[0]->ID);
		}else{
			require_once(ABSPATH . 'wp-admin/includes/file.php');
			require_once(ABSPATH . 'wp-admin/includes/media.php');
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$img_featured  = set_featured_img_content ($post_id);
			if ($img_featured){
				$result = media_sideload_image($img_featured, $post_id);
				$attachments = get_posts(array('numberposts' => '1', 'post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC'));
				if(sizeof($attachments) > 0)
					set_post_thumbnail($post_id, $attachments[0]->ID);
			}else{
				return;
			}
		}
	}
	function vnex_auto_set_post_image ( $post_id ) {
		  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			  return;
		$attch_featured = get_post_meta($post_id,"_thumbnail_id",true);
		if (empty($attch_featured)){
			set_featured_image_on_save($post_id);
		}
	}
	add_action( 'save_post', 'vnex_auto_set_post_image' );
}

if ($vnexoption['vnex_admin_slug']) {
	include plugin_dir_path( __FILE__ ) . 'inc/login-slug.php';
}

if ($vnexoption['vnex_remove_dashboard'] == 1) {
	remove_action('welcome_panel', 'wp_welcome_panel');
	function remove_default_dashboard_widgets() {
		remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	} 
	add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets' );
}

if ($vnexoption['vnex_dashboard_notice']) {
	function add_dashboard_widgets(){
		global $wp_meta_boxes;
		wp_add_dashboard_widget('custom_help_widget', __( 'Notice', 'vnex' ), 'custom_dashboard_help');
		}
		function custom_dashboard_help() {
		$vnexoption = vnex_all_options();
		echo stripslashes($vnexoption['vnex_dashboard_notice']);
	}
	add_action('wp_dashboard_setup', 'add_dashboard_widgets');
	function full_dashboard_columns () {
		wp_register_style('dashboard-columns', plugins_url('css/dashboard-columns.css', __FILE__ ), array() );
		wp_enqueue_style('dashboard-columns');
	}
	add_action('admin_head-index.php', 'full_dashboard_columns');
}

if ($vnexoption['vnex_copyright'] == 0) {
	function vnex_adminbar_menu( $meta = true ) {  
		global $wp_admin_bar;  
			if ( !is_user_logged_in() ) { return; }  
			if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }  
			$wp_admin_bar->add_menu( array(   
				'id'     => 'vnex',  
				'title' => __( '❤ Donate WP Extra', 'vnex' ),
				'href' => 'https://www.paypal.me/copvn',
				'meta'  => array( 'target' => '_blank' ) )
			);  
	}  
	add_action( 'admin_bar_menu', 'vnex_adminbar_menu', 150 );
}

if ($vnexoption['vnex_disable_xmlrpc'] == 1) {
	add_filter('xmlrpc_enabled', '__return_false');
}

if ($vnexoption['vnex_auto_update'] == 1) {
	add_filter( 'auto_update_core', '__return_false' );
	add_filter( 'auto_update_translation', '__return_false' );
}
if ($vnexoption['vnex_add_header']) {
	function vnex_add_header_code () {
        $vnexoption = vnex_all_options();
		echo stripslashes($vnexoption['vnex_add_header']);
	}
	add_action('wp_head', 'vnex_add_header_code');
}
if ($vnexoption['vnex_add_footer']) {
	function vnex_add_footer_code () {
        $vnexoption = vnex_all_options();
		echo stripslashes($vnexoption['vnex_add_footer']);
	}
	add_action('wp_footer', 'vnex_add_footer_code');
}

if ($vnexoption['vnex_set_image_meta'] == 1) {
	add_action( 'add_attachment', 'vnex_set_image_meta_image_upload' );
	function vnex_set_image_meta_image_upload( $post_ID ) {
		if ( wp_attachment_is_image( $post_ID ) ) {
		$vnex_image_title = get_post( $post_ID )->post_title;
		$vnex_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',
		$vnex_image_title );
		$vnex_image_title = ucwords( strtolower( $vnex_image_title ) );
		$vnex_my_image_meta = array(
		'ID' => $post_ID,
		'post_title' => $vnex_image_title,
		//'post_excerpt' => $vnex_image_title,
		'post_excerpt' => '',
		//'post_content' => $vnex_image_title,
		'post_content' => '',
		);
		update_post_meta( $post_ID, '_wp_attachment_image_alt',	$vnex_image_title );
		wp_update_post( $vnex_my_image_meta );
		}
	}
}

if ($vnexoption['vnex_smtp']) {
	add_action( 'phpmailer_init', 'vnex_send_smtp_email' );
	function vnex_send_smtp_email( $phpmailer ) {
		$vnexoption = vnex_all_options();
		$phpmailer->isSMTP();
		if ($vnexoption['vnex_smtp'] == 1) {
			$phpmailer->Host       = sanitize_text_field($vnexoption['vnex_smtp_host']);
			$phpmailer->Port       =  sanitize_text_field($vnexoption['vnex_smtp_port']);
			$phpmailer->SMTPSecure = sanitize_text_field($vnexoption['vnex_smtp_ssl']);
			$phpmailer->From = sanitize_text_field($vnexoption['vnex_smtp_from_email']);
		} elseif ($vnexoption['vnex_smtp'] == 2) {
			$phpmailer->Host       = "smtp.gmail.com";
			$phpmailer->Port       =  465;
			$phpmailer->SMTPSecure = "ssl";
			$phpmailer->From = sanitize_text_field($vnexoption['vnex_smtp_from_email']);
		} elseif ($vnexoption['vnex_smtp'] == 3) {
			$phpmailer->Host       = "smtp.yandex.com";
			$phpmailer->Port       =  465;
			$phpmailer->SMTPSecure = "ssl";
			$phpmailer->From = sanitize_text_field($vnexoption['vnex_smtp_username']);
		};
		$phpmailer->SMTPAuth   = true;
		$phpmailer->Username   = sanitize_text_field($vnexoption['vnex_smtp_username']);
		$phpmailer->Password   = base64_decode(sanitize_text_field($vnexoption['vnex_smtp_password']));
		$phpmailer->FromName = sanitize_text_field($vnexoption['vnex_smtp_from_name']);
		$phpmailer->AddReplyTo($phpmailer->From, $phpmailer->FromName);
		if ($vnexoption['vnex_smtp_replyto']) {
		$phpmailer->AddAddress ( sanitize_text_field($vnexoption['vnex_smtp_replyto']), $phpmailer->FromName );
		};
	}
}

if ($vnexoption['vnex_recaptcha'] == 1) {
	add_action('login_form', 'wpcf7_recaptcha_enqueue_scripts');
} 
if ($vnexoption['vnex_recaptcha'] == 2) {
	$vnex_recaptcha_cf7_list = array("comment_form_after_fields", "register_form", "lost_password", "lostpassword_form", "retrieve_password", "resetpass_form");
	foreach($vnex_recaptcha_cf7_list as $vnex_recaptcha_cf7) {
		add_action($vnex_recaptcha_cf7, "wpcf7_recaptcha_enqueue_scripts");
	}
} 
if ($vnexoption['vnex_recaptcha'] == 3) {
	$vnex_recaptcha_cf7_list = array("login_form", "comment_form_after_fields", "register_form", "lost_password", "lostpassword_form", "retrieve_password", "resetpass_form");
	foreach($vnex_recaptcha_cf7_list as $vnex_recaptcha_cf7) {
		add_action($vnex_recaptcha_cf7, "wpcf7_recaptcha_enqueue_scripts");
	}
} 
if ($vnexoption['vnex_recaptcha_badge']) {
	function contactform_dequeue_scripts() {
		$load_scripts = false;
		if( is_singular() ) {
			$post = get_post();
			if( has_shortcode($post->post_content, 'contact-form-7') ) {
				$load_scripts = true;
			}
		}
		if( ! $load_scripts ) {
			wp_dequeue_script( 'contact-form-7' );
		wp_dequeue_script('google-recaptcha');
			wp_dequeue_style( 'contact-form-7' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'contactform_dequeue_scripts', 99 );
}

if ($vnexoption['vnex_page_html'] == 1) {
	add_action('init', 'vnex_html_page_permalink', -1);
	function vnex_nopage_slash($string, $type){
	   global $wp_rewrite;
		if ($wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes==true && $type == 'page'){
			return untrailingslashit($string);
	  }else{
	   return $string;
	  }
	}
	function vnex_html_page_permalink() {
		global $wp_rewrite;
	 if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
			$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	 }
	}
	add_filter('user_trailingslashit', 'vnex_nopage_slash',66,2);
	function active() {
		global $wp_rewrite;
		if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
			$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	 }
	  $wp_rewrite->flush_rules();
	}	
	function deactive() {
		global $wp_rewrite;
		$wp_rewrite->page_structure = str_replace(".html","",$wp_rewrite->page_structure);
		$wp_rewrite->flush_rules();
	}
}

if ($vnexoption['vnex_clone_post'] == 1) {
	function vnex_clone_post_as_draft(){
		global $wpdb;
		if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'vnex_clone_post_as_draft' == $_REQUEST['action'] ) ) ) {
			wp_die( __( 'No post to clone has been supplied!', 'vnex' ) );
		}
		if ( !isset( $_GET['clone_nonce'] ) || !wp_verify_nonce( $_GET['clone_nonce'], basename( __FILE__ ) ) )
			return;
		$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
		$post = get_post( $post_id );
		$current_user = wp_get_current_user();
		$new_post_author = $current_user->ID;
		if (isset( $post ) && $post != null) {
			$args = array(
				'comment_status' => $post->comment_status,
				'ping_status'    => $post->ping_status,
				'post_author'    => $new_post_author,
				'post_content'   => $post->post_content,
				'post_excerpt'   => $post->post_excerpt,
				'post_name'      => $post->post_name,
				'post_parent'    => $post->post_parent,
				'post_password'  => $post->post_password,
				'post_status'    => 'draft',
				'post_title'     => $post->post_title,
				'post_type'      => $post->post_type,
				'to_ping'        => $post->to_ping,
				'menu_order'     => $post->menu_order
			);
			$new_post_id = wp_insert_post( $args );
			$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
			foreach ($taxonomies as $taxonomy) {
				$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
				wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
			}
			$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
			if (count($post_meta_infos)!=0) {
				$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
				foreach ($post_meta_infos as $meta_info) {
					$meta_key = $meta_info->meta_key;
					if( $meta_key == '_wp_old_slug' ) continue;
					$meta_value = addslashes($meta_info->meta_value);
					$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
				}
				$sql_query.= implode(" UNION ALL ", $sql_query_sel);
				$wpdb->query($sql_query);
			}
			wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
			exit;
		} else {
			wp_die( __('Post creation failed, could not find original post: ', 'vnex' ) . $post_id);
		}
	}
	add_action( 'admin_action_vnex_clone_post_as_draft', 'vnex_clone_post_as_draft' );
	function vnex_clone_post_link( $actions, $post ) {
		if (current_user_can('edit_posts')) {
			$actions['clone'] = '<a href="' . wp_nonce_url('admin.php?action=vnex_clone_post_as_draft&post=' . $post->ID, basename(__FILE__), 'clone_nonce' ) . '" title="Clone this item" rel="permalink">Clone</a>';
		}
		return $actions;
	}
	add_filter('post_row_actions', 'vnex_clone_post_link', 10, 2);
	add_filter('page_row_actions', 'vnex_clone_post_link', 10, 2);
}

if ($vnexoption['vnex_disable_comments'] == 1) {
	function vnex_disable_comments_post_types_support() {
		$post_types = get_post_types();
		foreach ($post_types as $post_type) {
			if(post_type_supports($post_type, 'comments')) {
				remove_post_type_support($post_type, 'comments');
				remove_post_type_support($post_type, 'trackbacks');
			}
		}
	}
	add_action('admin_init', 'vnex_disable_comments_post_types_support');
	function vnex_disable_comments_status() {
		return false;
	}
	add_filter('comments_open', 'vnex_disable_comments_status', 20, 2);
	add_filter('pings_open', 'vnex_disable_comments_status', 20, 2);
	function vnex_disable_comments_hide_existing_comments($comments) {
		$comments = array();
		return $comments;
	}
	add_filter('comments_array', 'vnex_disable_comments_hide_existing_comments', 10, 2);
	function vnex_disable_comments_admin_menu() {
		remove_menu_page('edit-comments.php');
	}
	add_action('admin_menu', 'vnex_disable_comments_admin_menu');
	function vnex_disable_comments_admin_menu_redirect() {
		global $pagenow;
		if ($pagenow === 'edit-comments.php') {
			wp_redirect(admin_url()); exit;
		}
	}
	add_action('admin_init', 'vnex_disable_comments_admin_menu_redirect');
	function vnex_disable_comments_dashboard() {
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	}
	add_action('admin_init', 'vnex_disable_comments_dashboard');
	function remove_comments(){
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('comments');
	}
	add_action( 'wp_before_admin_bar_render', 'remove_comments' );
}

if ($vnexoption['vnex_remove_menu_tools'] == 1) {
	add_action( 'admin_init', 'remove_menu_pages_for_all_except_admin' );
		function remove_menu_pages_for_all_except_admin() {
		remove_menu_page( 'themes.php' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'options-general.php' );
	}
    if (!defined('DISALLOW_FILE_EDIT'))
        define('DISALLOW_FILE_EDIT', true);
    if (!defined('DISALLOW_FILE_MODS'))
        define('DISALLOW_FILE_MODS', true);
}

if ($vnexoption['vnex_admin_logo'] || $vnexoption['vnex_admin_background'] || $vnexoption['vnex_admin_background_color']){
	function vnex_2_rgb( $hex, $opacity = 0.3 ) {
		$hex = str_replace( '#', '', $hex );
		if( strlen( $hex ) == 3) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		return "rgba( $r, $g, $b, $opacity )";
	} 
    function vnex_custom_admin_login()
	{
        $vnexoption = vnex_all_options();
		$color = esc_textarea($vnexoption['vnex_admin_background_color']);
		echo '<style>';
		if ($vnexoption['vnex_admin_background']){
			echo 'body.login {-webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important;background-size: cover !important;background-color:'. $color .'!important;background-image: url('.$vnexoption['vnex_admin_background'].');background-position:center center;background-repeat:repeat;}';
		}
		if ($vnexoption['vnex_admin_background_color']){
			$rgb_button = vnex_2_rgb($color);
			echo 'body.login {background: -webkit-linear-gradient(left, '. $color .', '. $rgb_button .'); background: linear-gradient(to right, '. $color .', '. $rgb_button .'); } 
			.login form { background: rgba(255,255,255,0.3) !important;} 
			.login.wp-core-ui .button-primary { background: '. $color .'; border-color: '. $color .'; box-shadow: 0 1px 0 '. $color .';text-shadow: none;}
			.login #backtoblog a, .login #nav a {color: #fff;}';
		}
		if ($vnexoption['vnex_admin_logo']) {
			echo '.login h1 a { background-image: url(' . $vnexoption['vnex_admin_logo'] . ')!important; background-size: contain; width:auto!important;max-width:100%; }';
		};
		echo '</style>';
		
	}
	add_action('login_head', 'vnex_custom_admin_login');
	function vnex_custom_login_logo_url() {
		return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'vnex_custom_login_logo_url' );

	function vnex_custom_login_logo_url_title() {
		return get_bloginfo( 'title' );
	}
	add_filter( 'login_headertext', 'vnex_custom_login_logo_url_title' );
}

if ($vnexoption['vnex_auto_links'] == 1)  {
	function add_nofollow_content($content) {
	$content = preg_replace_callback('/<a[^>]*href=["|\']([^"|\']*)["|\'][^>]*>([^<]*)<\/a>/i',
	function($m) {
		if (strpos($m[1], $_SERVER['HTTP_HOST']) === false && strpos($m[1], "#") === false ) 
				return '<a href="'.$m[1].'" target="_blank">'.$m[2].'</a>';
		else
			return '<a href="'.$m[1].'">'.$m[2].'</a>';
		},
		$content);
		return $content;
	}
	add_filter('the_content', 'add_nofollow_content');
}

if ($vnexoption['vnex_auto_links'] == 2)  {
	function add_nofollow_content($content) {
	$content = preg_replace_callback('/<a[^>]*href=["|\']([^"|\']*)["|\'][^>]*>([^<]*)<\/a>/i',
	function($m) {
		if (strpos($m[1], $_SERVER['HTTP_HOST']) === false && strpos($m[1], "#") === false ) 
				return '<a href="'.$m[1].'" rel="nofollow" target="_blank">'.$m[2].'</a>';
		else
			return '<a href="'.$m[1].'">'.$m[2].'</a>';
		},
		$content);
		return $content;
	}
	add_filter('the_content', 'add_nofollow_content');
}

if ($vnexoption['vnex_shortcode']) {
	function shortcode_myinfo() {
		$vnexoption = vnex_all_options();
		return stripslashes($vnexoption['vnex_shortcode']);
	}
	add_shortcode('signature', 'shortcode_myinfo');
	function vnex_add_mce_button() {
		if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
				   return;
		}
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
		   add_filter( 'mce_external_plugins', 'vnex_add_tinymce_plugin' );
		   add_filter( 'mce_buttons', 'vnex_register_mce_button' );
		}
	}
	add_action('admin_head', 'vnex_add_mce_button');
	function vnex_register_mce_button( $buttons ) {
				array_push( $buttons, 'vnex_mce_button' );
				return $buttons;
	}
	function vnex_add_tinymce_plugin( $plugin_array ) {
			  $plugin_array['vnex_mce_button'] = plugin_dir_url( __FILE__ ) . 'js/mce-signature.js';
			  return $plugin_array;
	}
}

if ($vnexoption['vnex_404_home']) {
	function vnex_redirect_404_to_home() {
		if (is_404()) {
		   wp_redirect(home_url(),301);
		   die();
		}
	}
	add_action('wp', 'vnex_redirect_404_to_home', 1);
}

if ($vnexoption['vnex_clone_widgets']) {
	function vnex_enqueue_clone_widgets_script()
	{
		global $pagenow;
		if ($pagenow != 'widgets.php')
			return;
		wp_register_script( 'vnex_clone_widgets_script', plugins_url('js/clone-widgets.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'vnex_clone_widgets_script' );
	}
	add_filter('admin_head', 'vnex_enqueue_clone_widgets_script');
}

if ($vnexoption['vnex_remove_menu_admin']) {
	function vnex_enqueue_remove_menu_admin_script()
	{
		global $pagenow;
		if ($pagenow != 'nav-menus.php')
			return;
		wp_register_script( 'vnex_remove_menu_admin_script', plugins_url('js/remove-menu-admin.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'vnex_remove_menu_admin_script' );
	}
	add_filter('admin_head', 'vnex_enqueue_remove_menu_admin_script');
}

if ($vnexoption['vnex_remove_category']) {
	add_filter ('pre_post_link', 'filter_category');
	add_filter ('category_link', 'filter_category_link');
	add_filter ('user_trailingslashit', 'vnex_filter_category');
	add_filter( 'rewrite_rules_array','vnex_insert_rewrite_rules' );
	add_filter( 'query_vars','vnex_insert_query_vars' );
	add_action( 'wp_loaded','vnex_flush_rules' );
	add_action('created_category','vnex_flush_rules_cat');
	add_action('edited_category','vnex_flush_rules_cat');
	add_action('delete_category','vnex_flush_rules_cat');
	function vnex_flush_rules(){
		update_option('category_base','');
		$rules = get_option( 'rewrite_rules' );
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
	}
	function vnex_flush_rules_cat(){
		$rules = get_option( 'rewrite_rules' );
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
	function vnex_insert_rewrite_rules( $rules )
	{
	global $wp_rewrite;
		$newrules = array();
		$newrules['(.+?)-cat/?$'] = 'index.php?category_name=$matches[1]';
		$newrules['(.+?)-cat/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
		$categories = get_categories(array('hide_empty'=>false));
		if ($categories)
		{
			foreach ($categories as $key => $val)
			{
				$posts = get_posts (array("name" => $val->slug));		
				if (!$posts)
				{
					$newrules['('.$val->category_nicename.')/?$'] = 'index.php?category_name=$matches[1]';
					$newrules['('.$val->category_nicename.')/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
					$newrules['.+?/('.$val->category_nicename.')/?$'] = 'index.php?category_name=$matches[1]';
					$newrules['.+?/('.$val->category_nicename.')/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
				}
			}
		}
		return $newrules + $rules;
	}
	function vnex_insert_query_vars( $vars )
	{
		array_push($vars, 'id');
		return $vars;
	}
	function filter_category_link ($termlink)
	{
		if (preg_match ("/\?cat=/", $termlink))
			return $termlink;
		$str = explode("/", $termlink);
		$myslug = $slug = $str[count($str)-2];
		$posts = get_posts (array("name" => $slug));		
		preg_match ("/category.*?".$myslug."/", $termlink, $result);
		if ($posts)
			$slug .= "-cat";
		$str = explode("/", $result[0]);
		if (count($str) > 3)
			$link = $str[count($str)-2]."/".$slug ;		
		else
			$link = $slug;
		$termlink = preg_replace ("/category.*?".$myslug."/", $link, $termlink);
		return $termlink;	
	}
	function filter_category ($permalink)
	{
		$permalink = str_replace ("%category%", "%mycategory%", $permalink); 
		return $permalink;
	}
	function vnex_filter_category ($string)
	{
		if (preg_match ("/%mycategory%/", $string))
		{
			$str = explode("/", $string);
			$slug = $str[count($str)-2];
			$posts = get_posts (array("name" => $slug));
			$cats = get_the_category($posts[0]->ID);
			if ( $cats ) {
				usort($cats, '_usort_terms_by_ID'); 
				$category = $cats[0]->slug;
				if ( $parent = $cats[0]->parent )
				{
					$one = 1;
				}
			}
			$string = preg_replace("/%mycategory%/", $category, $string);		
		}
		return $string;	
	}
}






?>