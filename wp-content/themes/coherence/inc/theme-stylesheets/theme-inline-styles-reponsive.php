<?php
if (!function_exists('coherence_dynamic_styles_reponsive')) {
	function coherence_dynamic_styles_reponsive()
	{
		ob_start();
?>



		@media all and (max-width: 768px) {
		<?php if (0 == coherence_get_option('header_sticky_mobile', 0)) : ?>

			.sticky-active {
			position: relative !important;
			}
		<?php endif; ?>
		<?php coherence_dimention_style(".navbar-area .nav-container .logo a img", "logo_principale_dimention_mobile"); ?>
		<?php if (!empty(coherence_get_option('mobile_logo'))) : ?>

			.navbar-area .nav-container .logo a img{
			content: url("<?php echo coherence_get_option('mobile_logo'); ?>");
			}
		<?php endif; ?>
		<?php if (!empty(coherence_get_option('mobile_search_color'))) : ?>
			svg.fa-search path{
			color: <?php echo coherence_get_option('mobile_search_color'); ?>;
			}
		<?php endif; ?>

		}

		@media all and (min-width: 768px) and (max-width: <?php echo esc_attr(coherence_get_option('side_header_break_point')) - 1; ?>px) {
		<?php if (0 == coherence_get_option('header_sticky_tablet', 0)) : ?>

			.sticky-active {
			position: relative !important;
			}
		<?php endif; ?>

		<?php if (!empty(coherence_get_option('mobile_search_color'))) : ?>
			svg.fa-search path{
			color: <?php echo coherence_get_option('mobile_search_color'); ?>;
			}
		<?php endif; ?>

		}
		@media all and (max-width: <?php echo esc_attr(coherence_get_option('side_header_break_point')) - 1; ?>px) {

		.navbar-area.default {
		padding: 12px 0;
		}

		.single-testimonial-inner{
		margin-top:0;
		}
		.testimonial-nav-slider{
		margin-top:70;
		}
		.testimonial-nav-slider{
		bottom: 0;
		}
		.image-hover-animate img {
		width: 100%;
		}
		.half-bg-right {
		display: none;
		}
		.navbar {
		padding: 0;
		}
		.navbar-top.style-2 {
		display: none;
		}

		.navbar-area-2 .nav-container {
		padding: 10px;
		}
		.navbar-area-2 .nav-container .navbar-collapse .navbar-nav > li:hover,
		.sticky-active.navbar-area-2 {
		background: #fff;
		}
		.navbar-area-2 .nav-container .navbar-collapse .navbar-nav > li {
		padding: 10px 0 !important;
		}
		.navbar-area-2 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
		.navbar-area-2 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:after {
		background: #333333;
		}
		.navbar-area-2 .nav-container .navbar-collapse .navbar-nav > li.menu-item-has-children:after {
		right: -1px;
		}
		.navbar-area-2 .nav-right-part .search-bar-btn {
		color: var(--heading-color);
		}
		.navbar-area-2 .nav-container .navbar-collapse .navbar-nav > li:hover a {
		color: var(--main-color);
		}
		.navbar-area-3 .nav-container {
		border-bottom: 0;
		}
		.navbar-area-3 .nav-container {
		padding: 10px;
		}
		.navbar-area-3 .nav-container .navbar-collapse .navbar-nav > li:hover,
		.sticky-active.navbar-area-3 {
		background: #fff;
		}
		.navbar-area-3 .nav-container .navbar-collapse .navbar-nav > li {
		padding: 10px 0 !important;
		}
		.navbar-area-3 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
		.navbar-area-3 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:after {
		background: #333333;
		}
		.navbar-area-3 .nav-container .navbar-collapse .navbar-nav > li.menu-item-has-children:after {
		right: -1px;
		}
		.navbar-area-3 .nav-right-part .search-bar-btn {
		color: var(--heading-color);
		}
		.td-sidebar,
		.td-service-sidebar {
		margin-top: 100px;
		}
		.navbar-area .nav-container .navbar-collapse .navbar-nav {
		padding-left: 0;
		}
		.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children {
		padding-right: 0;
		}
		.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:after {
		top: 26px;
		}
		.navbar-area .nav-container .navbar-collapse {
		padding: 13px;
		padding-left: 0;
		}
		.navbar-area .nav-container .navbar-collapse .navbar-nav {
		margin: 0;
		}
		.navbar-area:after {
		display: none;
		}

		.navbar-area .nav-container.navbar-bg {
		padding-left: 15px;
		}
		.banner-slider .owl-prev {
		left: 20px;
		}
		.banner-slider .owl-next {
		right: 20px;
		}
		.single-testimonial-inner .details h2 {
		font-size: 30px;
		}
		.single-testimonial-inner .details p {
		font-size: 15px;
		margin-top: 13px;
		}
		.testimonial-slider-bg:before {
		width: 40.5%;
		}
		.testimonial-nav-slider {
		left: 43%;
		}
		.how-it-work-inner .hills-line {
		display: none;
		}
		.banner-mask-bg-wrap .shape-image {
		left: 20px;
		top: -45px;
		}
		.single-project-inner .details-wrap h3 {
		font-size: 24px;
		}
		.breadcrumb-area .page-title {
		font-size: 60px;
		}
		.how-it-work-inner.arrow-line .single-work-inner:after {
		display: none;
		}
		.testimonial-slider-3-thumb .owl-thumb-item {
		height: 50px;
		width: 50px;
		}
		.testimonial-slider-3-thumb .owl-thumb-item {
		position: relative;
		top: 0;
		left: auto;
		right: auto;
		width: 35px;
		height: 35px;
		margin: 0 3px;
		}
		.testimonial-slider-3-thumb {
		text-align: center;
		margin-top: 20px;
		}
		}

		@media all and (max-width: <?php echo esc_attr(coherence_get_option('content_break_point')); ?>px) {
		.elementor-column {
		width: 100% !important;
		}
		.testimonial-slider-bg.pd-top-120.d-bottom-120{
		padding-bottom:100px;
		}
		.breadcrumb-area .page-title {
		font-size: 50px;
		}
		.g-map-inner iframe {
		height: 300px;
		}
		.g-map-contact {
		margin-top: 100px;
		}

		.testimonial-slider-bg:before {
		display: none;
		}
		.testimonial-nav-slider {
		left: 0;
		position: relative;
		margin-top: 20px;
		}
		.project-slider-2 {
		padding: 0 30px;
		}
		.banner-slider .owl-prev,
		.banner-slider .owl-next {
		position: relative;
		left: auto;
		right: auto;
		}
		.banner-slider .owl-nav {
		text-align: center;
		margin-top: -125px;
		padding-bottom: 79px;
		}
		.banner-area-3 .banner-inner {
		padding: 160px 0 170px 0;
		}
		.navbar-top.style-3 {
		padding: 7px 0;
		}
		}
		@media all and (max-width: 575px) {
		.video-play-btn {
		width: 70px;
		height: 70px;
		line-height: 70px;
		}
		.back-to-top {
		right: 15px;
		bottom: 20px;
		}
		.navbar-top .topbar-right li {
		margin-bottom: 4px;
		}
		.navbar-top {
		padding: 7px 0;
		}
		.breadcrumb-area .page-title {
		font-size: 40px;
		}
		.breadcrumb-area {
		padding: 166px 0 90px;
		}
		.breadcrumb-area .page-list li {
		font-size: 15px;
		}
		.single-blog-inner .details h2 {
		font-size: 30px;
		}
		.td-page-navigation .pagination li a {
		height: 45px;
		width: 45px;
		line-height: 45px;
		font-size: 16px;
		}
		.blog-details-page-content blockquote {
		padding: 30px 20px;
		}
		.blog-comment .comment-body {
		padding-left: 0;
		margin-bottom: 40px;
		}
		.blog-comment .comment-body .avatar {
		position: relative;
		margin-bottom: 18px;
		}
		.blog-comment .comment-body .comment-metadata {
		margin-bottom: 6px;
		}
		.blog-comment .reply a {
		margin-top: 12px;
		}
		.td-sidebar .widget {
		padding: 25px;
		}
		.banner-inner .title {
		font-size: 45px;
		}
		.section-title .title {
		font-size: 35px;
		}
		.project-slider-2 {
		padding: 0 15px;
		}
		.single-call-to-action-inner.style-white h2 {
		font-size: 35px;
		}
		.single-exp-inner h2 {
		font-size: 35px;
		}
		.about-mask-bg-wrap-2:after {
		bottom: 8px;
		height: 180px;
		width: 184px;
		}
		.pagination .page-numbers {
		height: 40px;
		width: 40px;
		margin-right: 5px;
		line-height: 40px;
		font-size: 16px;
		}
		.td-search-popup.active .search-form {
		width: 90%;
		}
		}
		@media all and (max-width: 360px) {
		.single-blog-inner.style-3 .details,
		.single-blog-inner .thumb .blog-meta {
		margin: 0 15px;
		}
		.section-title .title {
		font-size: 32px;
		}
		.banner-inner .title {
		font-size: 40px;
		}
		.section-title.p-35 .btn {
		margin-bottom: 10px;
		}
		}
		@media all and (max-width: 320px) {
		.banner-inner .btn {
		margin-bottom: 10px;
		}
		}

		@media only screen and (min-width: 768px) and (max-width: <?php echo esc_attr(coherence_get_option('side_header_break_point')); ?>px) {
		.responsive-mobile-menu {
		display: block;
		width: 100%;
		position: relative;
		}
		<?php coherence_font_style(".navbar-area .nav-container .navbar-collapse .navbar-nav li a", "mobile_menu_typography");
		?>.navbar-collapse {
		<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('mobile_menu_background_color'))); ?>
		}
		.navbar-area .nav-container .navbar-collapse .navbar-nav>li:active{
		<?php echo coherence_check_exist_value("background-color", esc_attr(coherence_get_option('mobile_menu_hover_color'))); ?>
		}
		<?php echo coherence_border_style(".navbar-area .nav-container .navbar-collapse .navbar-nav li", "mobile_menu_border_color"); ?>

		}

		@media all and (max-width:<?php echo esc_attr(coherence_get_option('grid_main_break_point')) - 1; ?>px) {

		.navbar-area-1 .nav-container .navbar-collapse .navbar-nav > li > a {
		position: relative;
		}
		.navbar-area-1 .nav-container .navbar-collapse .navbar-nav > li > a:after {
		content: '';
		position: absolute;
		left: 0;
		bottom: -30px;
		height: 2px;
		width: 0%;
		background: var(--main-color);
		visibility: hidden;
		opacity: 0;
		transition: 0.4s;
		transform: translateY(-50%);
		left: auto;
		right: 0;
		}
		.navbar-area-1 .nav-container .navbar-collapse .navbar-nav > li:hover > a:after {
		visibility: visible;
		opacity: 1;
		width: 100%;
		right: auto;
		left: 0;
		}
		.navbar-area-1 .nav-container .navbar-collapse .navbar-nav li {
		line-height: 80px;
		}
		.navbar-area-1 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:after {
		top: 40px;
		}

		}

<?php
		$output = ob_get_clean();

		return $output;
	} //end  coherence_dynamic_styles_reponsive

} //endif


function coherence_style_method_responsive()
{

	$custom_css = coherence_dynamic_styles_reponsive();

	wp_add_inline_style('coherence-style', $custom_css);
}

add_action('wp_enqueue_scripts', 'coherence_style_method_responsive');
