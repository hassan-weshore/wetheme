<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coherence
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-blog-inner ">

		<?php coherence_post_thumbnail(); ?>

		<div class="details">

			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<ul class="blog-meta">
				<li><?php coherence_posted_by(); ?></li>
				<li><?php coherence_posted_on(); ?></li>

				<li><i aria-hidden="true" class=" icomoon-chat-2"></i><?php comments_popup_link(); ?></li>
			</ul>

			<p><?php coherence_excerpt(); ?></p>

			<a class="read-more-text" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More', 'coherence'); ?><i class="fa fa-caret-right"></i></a>

		</div>

	</div>
</article>