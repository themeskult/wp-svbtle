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
		<?php screen_icon(); echo "<h2> Svbtle v4.1.7" . __( ' Options', 'wordpress-svbtle' ) . "</h2>"; ?>

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

						<th>For updates follow:</th>
						<td>
									<p>

				<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fthemeskult&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=116081631857494" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>

				<a href="https://twitter.com/ThemesKult" class="twitter-follow-button" data-show-count="false">Follow @ThemesKult</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<br />
				or visit <a href="http://themeskult.com" target="_blank">Themes Kult</a>

		</p>
						</td>
					</tr>
					<tr>
						<th><?php _e( 'Your name', 'wordpress-svbtle' ); ?></th>
						<td><input class="regular-text" type="text" name="svbtle_options[theme_username]" value="<?php esc_attr_e( $options['theme_username'] ); ?>" /></td>
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