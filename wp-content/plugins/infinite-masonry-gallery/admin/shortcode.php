<?php

//TODO(alex): refactor this shit"

function codeneric_img_shortcode_gallery( $atts ){
	$att = shortcode_atts( array(
		'id' => 0
	), $atts );

	$temp_post = get_post();
	$id = isset($att['id']) && $att['id'] !== 0 ? $att['id'] : $temp_post->ID;
	ob_start();

	do_action('codeneric_img_shortcode_enqueue_scripts', $id); // enqueue the srtyle

	?>
	<div data-id="<?php echo $id; ?>" class="codeneric-img-public-container"></div>
	<?php
	

	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'cc_img_gallery', 'codeneric_img_shortcode_gallery' );
