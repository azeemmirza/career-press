<?php
/**
 * Created by PhpStorm.
 * User: azeem
 * Date: 1/23/2018
 * Time: 2:37 AM
 */

class CareerPressView {

	function get_posts(){
				echo '<div class="careerpress-wrapper">';
               $args = array( 'post_type' => 'careers', 'posts_per_page' => 10 );
               $loop = new WP_Query( $args );
               while ( $loop->have_posts() ) :
	               $loop->the_post();
	               $title = get_the_title();
	               $content = wp_trim_words( get_the_content(), 39, '...' );;
	               $link = get_the_permalink();

	               $this->post_structure($title, $content, $link);
               endwhile;
               echo '</div>';
               $this->loadmore_btn();
	}

	function post_structure($title, $content, $link){?>
		<div>
			<div>
				<a href="<?php echo $link ?>">
					<div>
						<h2><?php echo $title; ?></h2>
						<span></span>
					</div>
					<div>
						<p><?php echo $content; ?></p>
					</div>
				</a>
			</div>
		</div>
	<?php
	}

	function loadmore_btn(){?>
		<div>
			<button class="">Load More</button>
		</div>
	<?php
	}

}

$careerPressView = new CareerPressView();