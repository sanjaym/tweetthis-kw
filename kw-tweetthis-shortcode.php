<?php
/*
Plugin Name: Tweetthis-inator from K@W
Original Plugin URI:  
Description: Make your posts more shareable. For our editors to editorialize tweets with a [tweetthis] tag. Add ALT text, Hashtags, and even field for shortened URLS if desired. 
Version: 1.0
Author: Knowledge@Wharton Tech Team 
*/

class KW_tweetthis_shortcode{
	/**
	 * $shortcode_tag 
	 * holds the name of the shortcode tag
	 * @var string
	 */
	#public $shortcode_tag = 'bs3_panel';
	public $shortcode_tag = 'tweetthis';

	/**
	 * __construct 
	 * class constructor will set the needed filter and action hooks
	 * 
	 * @param array $args 
	 */
	function __construct($args = array()){
		//add shortcode
		add_shortcode( $this->shortcode_tag, array( $this, 'shortcode_handler' ) );
		
		if ( is_admin() ){
			add_action('admin_head', array( $this, 'admin_head') );
			add_action( 'admin_enqueue_scripts', array($this , 'admin_enqueue_scripts' ) );
		}
	}

	/**
	 * shortcode_handler
	 * @param  array  $atts shortcode attributes
	 * @param  string $content shortcode content
	 * @return string
	 */

	/**
	 * admin_head
	 * calls your functions into the correct filters
	 * @return void
	 */
	function admin_head() {
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		
		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', array( $this ,'mce_external_plugins' ) );
			add_filter( 'mce_buttons', array($this, 'mce_buttons' ) );
		}
	}

	/**
	 * mce_external_plugins 
	 * Adds our tinymce plugin
	 * @param  array $plugin_array 
	 * @return array
	 */
	function mce_external_plugins( $plugin_array ) {
		$plugin_array[$this->shortcode_tag] = plugins_url( 'js/mce-button.js' , __FILE__ );
		return $plugin_array;
	}

	/**
	 * mce_buttons 
	 * Adds our tinymce button
	 * @param  array $buttons 
	 * @return array
	 */
	function mce_buttons( $buttons ) {
		array_push( $buttons, $this->shortcode_tag );
		return $buttons;
	}

	/**
	 * admin_enqueue_scripts 
	 * Used to enqueue custom styles
	 * @return void
	 */
	function admin_enqueue_scripts(){
		 wp_enqueue_style('KW_tweetthis_shortcode', plugins_url( 'css/mce-button.css' , __FILE__ ) );
	}

}//end class

// initiate class
new KW_tweetthis_shortcode();



// shortcode handler here -- outputs the html link 
class tweetthisText{
 function maketweetthis($atts, $content = "") {
   extract(shortcode_atts(array(
      'alt' => '',
      'hashtag' => '',
      'shorturl' => ''
   ), $atts));
   global $wpdb, $post;

// Allow it to run on CPTs "article" as well as "post" and "page" types... Change as needed
//  if((get_post_type($post) == "article")||(get_post_type($post) == "post")||(get_post_type($post) == "page")  ) 

// I've removed the CPT for now - see example above [SM]
  if((get_post_type($post) == "post")||(get_post_type($post) == "page")  ) 
  {
    $post_id = $post->ID;
    $permalink = get_permalink($post_id);
    $shortlink = '';

    if ($shorturl != ''){
      $shortlink = $shorturl;
    }else{
      $shortlink = wp_get_shortlink();
    }

    $tweetcontent = ucfirst(strip_tags($content));

    if ($alt != '') $tweetcontent = $alt;
    if ($hashtag != '') $tweetcontent .= " " . $hashtag;

    $returntweet = "";
    $returntweet .= "<a href=\"https://twitter.com/intent/tweet?original_referer=".urlencode($permalink)."&url=".urlencode($shortlink)."&source=tweetbutton&text=".rawurlencode(($tweetcontent))."\" class=\"fyc_printfriendly tweetthislink\" target=\"_blank\">$content&thinsp;"	;
    $returntweet .= "</a>";
    $returntweet .= "";
            return $returntweet;
  } else {
    return $content;
  }
     }
} //end class

add_shortcode( 'tweetthis', array('TweetthisText', 'makeTweetthis') );


// Add Quicktag for the HTML editor...
function custom_quicktags(){
	if ( wp_script_is( 'quicktags' ) ) {
?>
	<script type="text/javascript">
	QTags.addButton( 'tweetthisbutton', 'TweetThis!', '[tweetthis alt="" hashtag="" url=""]', '[/tweetthis]', 't', 'tweetthisbutton', 10 );
	</script>
<?php
}

};

// Hook into the 'admin_print_footer_scripts' action
add_action( 'admin_print_footer_scripts', 'custom_quicktags' );

?>