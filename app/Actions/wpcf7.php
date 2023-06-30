<?php

add_action('wp_footer', function() {
	?>
	<script type="text/javascript">
		document.addEventListener( 'wpcf7mailsent', function( event ) {
			if ('236' == event.detail.contactFormId) {
				const formFields = document.querySelectorAll('#wpcf7-f236-p2-o1 form p');
				formFields.forEach(fields => {
					fields.style.display = 'none';
				});
			}
		}, false );
	</script>
	<?php
});

