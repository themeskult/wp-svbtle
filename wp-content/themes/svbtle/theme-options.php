<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

function theme_options_init(){
	register_setting( 'sample_options', 'svbtle_options' );
}

function theme_options_add_page() {
	add_theme_page( __( 'Svbtle Options', 'wordpress-svbtle' ), __( 'Svbtle Options', 'wordpress-svbtle' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#color_picker_color1').farbtastic('#color1');            
		});
	</script>
	
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Options', 'wordpress-svbtle' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'wordpress-svbtle' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'sample_options' ); ?>
			<?php $options = get_option( 'svbtle_options' ); 
				  if( ! is_null( $options['color'] ) && '' != $options['color'] )
				  	$color = esc_attr( $options['color'] );
				  else
				  	$color = '#ff0000';
			?>

			<table class="form-table">
					<tr>
						<th><?php _e( 'Your name', 'wordpress-svbtle' ); ?></th>
						<td><input class="regular-text" type="text" name="svbtle_options[theme_username]" value="<?php esc_attr_e( $options['theme_username'] ); ?>" /></td>
					</tr>
					<tr>
						<th><?php _e( 'Twitter Username', 'wordpress-svbtle' ); ?></th>
						<td><input class="regular-text" type="text" name="svbtle_options[twitter_username]" value="<?php esc_attr_e( $options['twitter_username'] ); ?>" /></td>
					</tr>
					<tr>
						<th><?php _e( 'Github Username', 'wordpress-svbtle' ); ?></th>
						<td>
							<input class="regular-text" type="text" name="svbtle_options[github_username]" value="<?php esc_attr_e( $options['github_username'] ); ?>" />
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Contact Email', 'wordpress-svbtle' ); ?></th>
						<td>
							<input class="regular-text" type="text" name="svbtle_options[contact_email]" value="<?php esc_attr_e( $options['contact_email'] ); ?>" />
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Show RSS Link', 'wordpress-svbtle' ); ?></th>
						<td>
							<input type="checkbox" name="svbtle_options[rss-link]" value="1"

							<?php if ($options['rss-link'] == 1): ?>
								checked="checked"
							<?php endif ?>
							>
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Blog color', 'wordpress-svbtle' ); ?></th>
						<td>
							<input id="color1" class="regular-text" type="text" name="svbtle_options[color]" value="<?php echo $color; ?>" />
							<div id="color_picker_color1"></div>
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Google Analytics // Typekit', 'wordpress-svbtle' ); ?></th>
						<td>
							<textarea id="svbtle_options[google_analytics]" class="regular-text" cols="50" rows="10" name="svbtle_options[google_analytics]"><?php echo esc_textarea( $options['google_analytics'] ); ?></textarea>
						</td>
					</tr>

			</table>
				
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'wordpress-svbtle' ); ?>" /></p>			
			
		</form>
	</div>
	<?php
}

function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// if ( ! isset( $input['anchor'] ) )
	// 	$input['anchor'] = null;
	// $input['anchor'] = ( $input['anchor'] == 1 ? 1 : 0 );
	// 
	// if ( ! isset( $input['pulse'] ) )
	// 	$input['pulse'] = null;
	// $input['pulse'] = ( $input['pulse'] == 1 ? 1 : 0 );

	$input['color'] = wp_filter_nohtml_kses( $input['color'] );

	/*if ( ! @array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null; */

	$input['google_analytics'] = $input['google_analytics'] ;

	return $input;
}

?>