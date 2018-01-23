<?php
/**
 * Created by PhpStorm.
 * User: azeem
 * Date: 1/23/2018
 * Time: 2:37 AM
 */

class CareerPressView {
    static $paged;
    function __construct() {
        $this->paged = 1;
	    add_action('wp_ajax_nopriv_careerpress_loadmore', array($this,'careerpress_loadmore')); //For Non-Logged in Users (Non-Privileges)
	    add_action('wp_ajax_blog_careerpress_loadmore', array($this,'careerpress_loadmore'));//For Logged in Users

    }

    function careerpress_loadmore(){
        echo json_encode('check');
    }
	function get_posts() {
		$dir = plugin_dir_url( __FILE__ ) . '/assets/career-press.js';
		$count_posts = wp_count_posts('careers');
		//echo $dir;
        $counter = $count_posts->publish;
        //echo $counter;
		echo '<script src="' . $dir . '"></script>';
		echo '<div class="careerpress-wrapper">';
		//$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$args = array( 'post_type' => 'careers', 'posts_per_page' => 10, 'paged' => $this->paged );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) :
			$loop->the_post();
			$title   = get_the_title();
			$content = wp_trim_words( get_the_content(), 39, '...' );;
			$link = get_the_permalink();

			$this->post_structure( $title, $content, $link );
			$counter--;
		endwhile;
		echo '</div>';
		if($counter > 0){
			$this->loadmore_btn();
        }

	}

	function post_structure( $title, $content, $link ) {
		?>
        <div class="cp-post-wrapper">
            <div class="cp-block">
                <a href="<?php echo $link ?>">
                    <div class="cp-title">
                        <h2><?php echo $title; ?></h2>
                        <span></span>
                    </div>
                    <div class="cp-description">
                        <p><?php echo $content; ?></p>
                    </div>
                </a>
            </div>
        </div>
		<?php
	}

	function loadmore_btn() {
        $this->paged += 1;
		?>
        <div class="career-press-btn">
            <form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" id="form">
                <input type="hidden" name="next" value="<?php echo $this->paged?>">
                <input type="hidden" name="action" value="careerpress_loadmore">
	            <?php wp_nonce_field('careerpress_loadmore', 'careerpress-posts-loadmore'); ?>
                <button type="submit" class=""  >Load More</button>
            </form>

        </div>
		<?php
	}

}

$careerPressView = new CareerPressView();