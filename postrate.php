<?php 
/*
   Plugin Name: Post Rate
   Description: Dieses Plugin wird unter jedem einzelnen Artikel fünf Sterne einfügen. Besucher Ihrer Internetseite können die Artikel darüber bewerten.
   Author: Danijar Hafner
   Author URI: http://danijar.org/
   Version: 2.0.0
*/

// number of stars
define(MAX, 5);

/********************************************************************************
 * Register Actions
 ********************************************************************************/

add_action('wp_enqueue_scripts',		  'register_jquery');
register_activation_hook(__FILE__,        'activate');
//register_deactivation_hook(__FILE__,      'deactivate'); // this is a comment line to not remove all ratings by disabling the plugin
add_action('publish_post',                'add_ranking');
add_action('wp_print_styles',             'rate_styles');
add_filter('the_content',                 'html_output_rating');
add_action('wp_ajax_rating',              'ajax_rating');
add_action('wp_ajax_nopriv_rating',       'ajax_rating');
add_action('wp_footer',                   'rating_javascript');
add_action('wp_head',                     'add_ajaxurl_to_front', 1);
add_action('wp_head',                     'add_postid_to_front', 1);

/********************************************************************************
 * Plugin Functions
 ********************************************************************************/

function register_jquery() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	wp_enqueue_script('jquery');
}

function activate(){
	// update old posts
	$posts = get_posts(array('numberposts' => 0));
	foreach($posts as $post){
		add_ranking($post->ID);
	}
}

// move into settings page
function deactivate(){
	$posts = get_posts(array('numberposts' => 0));
	foreach($posts as $post){
		delete_post_meta($post->ID, 'ranking');
		delete_post_meta($post->ID, 'rankers');
	}
}

/********************************************************************************
 * Input Functions
 ********************************************************************************/

function get_input_rating($rate, $request_id = 0){
	$id = (int) $request_id > 0 ? $request_id : get_the_id();

	// upcoming feature check users by ip address
	if(false)
	return false;

	if($rate > MAX) $rate = MAX;
	if($rate < 1) $rate = 1;

	update_post_meta($id, 'rating', get_post_meta($id, 'rating', true) + $rate);
	update_post_meta($id, 'raters', get_post_meta($id, 'raters', true) + 1);

	return true;
}

function input_rating($rate, $id = 0){
	if(get_input_rating($rate, $id))
		return 'Ihre Meinung wurde gespeichert.';
	else
		return 'Es gab einen Fehler. Jeder darf nur eine Meinung ('.$rate.') abgeben.';
}

/********************************************************************************
 * Output Functions
 ********************************************************************************/

function get_output_rating($request_id = 0){
	$id = (int) $request_id > 0 ? $request_id : get_the_id();
	$rating = get_post_meta($id, 'rating', true);
	$raters = get_post_meta($id, 'raters', true);

	$output = '';

	$output .= '<p class="ratingbox" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
	$output .= 'Ich bitte Sie um eine Bewertung dieses Artikels<br />';
	$output .= '<span class="rating">';

	$rating_left = ($raters > 0) ? $rating / $raters : 0;
	for($i = 0; $i < MAX; $i++){
		$output .= '<span><a id="'.($i+1).'" class="star ';

		if($rating_left>0.74){
			$output .= 'a';
			$rating_left -= 1.0;
		}
		else if($rating_left>0.24){
			$output .= 'h';
			$rating_left -= 0.5;
		}

		$output .= '"><i class="l"></i><i class="r"></i></a>';
	}
	for($i = 0; $i < MAX; $i++) $output .= '</span>';
	
	$output .= '</span><br />';
	if($raters > 0) $output .= 'Bewertung <span itemprop="ratingValue">'.round($rating/$raters, 1).'</span> Sterne aus <span itemprop="reviewCount">'.$raters.'</span> Meinungen';
	else            $output .= 'Es gibt noch keine Bewertungen';
	$output .= '</p>';

	return $output;
}

function output_rating($request_id = 0){
	echo get_output_rating($request_id);
}

/********************************************************************************
 * AJAX Functions
 ********************************************************************************/

function ajax_rating(){
	$message = input_rating($_POST['stars'], $_POST['postid']);
	output_rating($_POST['postid'], $message);
	die;
}

function rating_javascript() { ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.star').click(function(){

			var stars = $(this).attr('id');

			if(stars > <?php echo MAX ?>) stars = <?php echo MAX ?>;
			if(stars < 1) stars = 1;

			var data = { action: 'rating', stars: stars, postid: postid };
			jQuery.post(ajaxurl, data, function(response) {
				$('.ratingbox').replaceWith(response);
			});
		});
	});
	</script>
<?php }

/********************************************************************************
 * Frontend Functions
 ********************************************************************************/

function html_output_rating($content) {
	if(is_single() && !is_page())
		$content .= get_output_rating();

	return $content;
}

function add_ajaxurl_to_front(){ ?>
	<script type="text/javascript">
		//<![CDATA[
		ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
		//]]>
	</script>
<?php }

function add_postid_to_front(){ ?>
	<script type="text/javascript">
		//<![CDATA[
		postid = <?php echo get_the_id(); ?>;
		//]]>
	</script>
<?php }

function rate_styles() {
	wp_enqueue_style('rate', plugins_url('/style.css', __FILE__ ));	
}

/********************************************************************************
 * Helper Functions
 ********************************************************************************/

function add_ranking($id) {
	add_post_meta($id, 'rating', 0, true);
	add_post_meta($id, 'raters', 0, true);
}

?>