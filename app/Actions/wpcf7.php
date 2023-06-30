<?php

add_action('wp_footer', function() {
	?>
	<script type="text/javascript">
		document.addEventListener( 'wpcf7mailsent', function( event ) {
			if ('236' == event.detail.contactFormId) {
				document.getElementById('wpcf7-f236-p2-o1').style.display = 'none';
			}
		}, false );
	</script>
	<?php
});

