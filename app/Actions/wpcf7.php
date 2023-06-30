<?php

add_action('wp_footer', function() {
	?>
	<script type="text/javascript">
		document.addEventListener( 'wpcf7mailsent', function( event ) {
			if ('236' == event.detail.contactFormId) {
				jQuery('#wpcf7-f236-p2-o1 .wpcf7-form-control').slideUp('slow'); // hides the form fields
			}
		}, false );
	</script>
	<?php
});

