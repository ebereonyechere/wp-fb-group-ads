<?php settings_errors();

?>

<div class="wrap">
    <form action="options.php" method="post">
		<?php
		settings_fields( 'general' );
		do_settings_sections( 'general' );
		submit_button( 'Save Settings' );
		?>
    </form>

</div>
