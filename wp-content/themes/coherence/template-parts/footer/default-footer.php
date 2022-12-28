<?php
/*
* @package coherence
* since 1.0.0
*/
if (1 == coherence_get_option('footer_widgets', 0)) :
	$coherence_copyright = !empty(coherence_get_option('copyright_text')) ?  coherence_get_option('copyright_text') : esc_html__('Copyright &copy;2022 Coherence', 'coherence');

?>

	<footer class="default-footer footer-bottom text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12 align-self-center">
					<p><?php echo esc_html($coherence_copyright); ?></p>
				</div>
			</div>
		</div>
	</footer>

<?php endif; ?>