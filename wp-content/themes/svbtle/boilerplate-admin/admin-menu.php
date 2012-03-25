<?php

/*
	Begin Boilerplate Admin panel.
*/

/*	Define Boilerplate URI */
	define('BP_THEME_URL', get_template_directory_uri());

/*
	There are essentially 5 sections to this:
	1)	Add "Boilerplate Admin" link to left-nav Admin Menu & callback function for clicking that menu link
	2)	Add Admin Page CSS if on the Admin Page
	3)	Add "Boilerplate Admin" Page options
	4)	Create functions to add above elements to pages
	5)	Add Boilerplate options to page as requested
*/

/*	1)	Add "Boilerplate Admin" link to left-nav Admin Menu & callback function for clicking that menu link */

	//	Add option if in Admin Page
	if ( ! function_exists( 'create_boilerplate_admin_page' ) ):
		function create_boilerplate_admin_page() {
			add_theme_page('Boilerplate Admin', 'Boilerplate Admin', 'administrator', 'boilerplate-admin', 'build_boilerplate_admin_page');
		}
		add_action('admin_menu', 'create_boilerplate_admin_page');
	endif; // create_boilerplate_admin_page

	//	You get this if you click the left-column "Boilerplate Admin" (added above)
	if ( ! function_exists( 'build_boilerplate_admin_page' ) ):
		function build_boilerplate_admin_page() {
		?>
			<div id="boilerplate-options-wrap">
				<div class="icon32" id="icon-tools"><br /></div>
				<h2>Boilerplate Admin</h2>
				<p>So, there's actually a tremendous amount going on here.  If you're not familiar with <a href="http://html5boilerplate.com/">HTML5 Boilerplate</a> or the <a href="http://starkerstheme.com/">Starkers theme</a> (upon which this theme is based) you should check them out.</p>
				<p>Choose below which options you want included in your site.</p>
				<p>The clumsiest part of this plug-in is dealing with the CSS files.  Check the <a href="<?php echo BP_THEME_URL ?>/readme.txt">Read Me file</a> for details on how I suggest handling them.</p>
				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('plugin_options'); /* very last function on this page... */ ?>
					<?php do_settings_sections('boilerplate-admin'); /* let's get started! */?>
					<p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>"></p>
				</form>
			</div>
		<?php
		}
	endif; // build_boilerplate_admin_page

/*	2)	Add Admin Page CSS if on the Admin Page */
	if ( ! function_exists( 'admin_register_head' ) ):
		function admin_register_head() {
			echo '<link rel="stylesheet" href="' .BP_THEME_URL. '/boilerplate-admin/admin-style.css">'.PHP_EOL;
		}
		add_action('admin_head', 'admin_register_head');
	endif; // admin_register_head

/*	3)	Add "Boilerplate Admin" Page options */
	//	Register form elements
	if ( ! function_exists( 'register_and_build_fields' ) ):
		function register_and_build_fields() {
			register_setting('plugin_options', 'plugin_options', 'validate_setting');
			add_settings_section('main_section', '', 'section_cb', 'boilerplate-admin');
			add_settings_field('toolbar', 'IE6 Image Toolbar?:', 'toolbar_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('google_chrome', 'IE-edge / Google Chrome?:', 'google_chrome_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('google_verification', 'Google Verification?:', 'google_verification_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('viewport', '<em><abbr title="iPhone, iTouch, iPad...">iThings</abbr></em> use full zoom?:', 'viewport_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('favicon', 'Got Favicon?:', 'favicon_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('favicon_ithing', 'Got <em><abbr title="iPhone, iTouch, iPad...">iThing</abbr></em> Favicon?', 'favicon_ithing_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('ie_css', 'IE CSS?:', 'ie_css_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('modernizr_js', 'Modernizr JS?:', 'modernizr_js_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('respond_js', 'Respond JS?:', 'respond_js_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('jquery_js', 'jQuery JS?:', 'jquery_js_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('plugins_js', 'jQuery Plug-ins JS?:', 'plugins_js_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('site_js', 'Site-specific JS?:', 'site_js_setting', 'boilerplate-admin', 'main_section');
			add_settings_field('cache_buster', 'Cache-Buster?:', 'cache_buster_setting', 'boilerplate-admin', 'main_section');
		}
		add_action('admin_init', 'register_and_build_fields');
	endif; // register_and_build_fields

	//	Add Admin Page validation
	if ( ! function_exists( 'validate_setting' ) ):
		function validate_setting($plugin_options) {
			$keys = array_keys($_FILES);
			$i = 0;
			foreach ( $_FILES as $image ) {
				// if a files was upload
				if ($image['size']) {
					// if it is an image
					if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
						$override = array('test_form' => false);
						// save the file, and store an array, containing its location in $file
						$file = wp_handle_upload( $image, $override );
						$plugin_options[$keys[$i]] = $file['url'];
					} else {
						// Not an image.
						$options = get_option('plugin_options');
						$plugin_options[$keys[$i]] = $options[$logo];
						// Die and let the user know that they made a mistake.
						wp_die('No image was uploaded.');
					}
				} else { // else, the user didn't upload a file, retain the image that's already on file.
					$options = get_option('plugin_options');
					$plugin_options[$keys[$i]] = $options[$keys[$i]];
				}
				$i++;
			}
			return $plugin_options;
		}
	endif; // validate_setting

	//	Add Admin Page options

	//	in case you need it...
	if ( ! function_exists( 'section_cb' ) ):
		function section_cb() {}
	endif; // section_cb

	//	callback fn for toolbar
	if ( ! function_exists( 'toolbar_setting' ) ):
		function toolbar_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['toolbar']) && $options['toolbar']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[toolbar]" value="true" ' .$checked. '/>';
			echo '<p>Kill the IE6 Image Toolbar that appears when users hover over images on your site.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages:</p>';
			echo '<code>&lt;meta http-equiv="imagetoolbar" content="false"&gt;</code>';
		}
	endif; // toolbar_setting

	//	callback fn for google_chrome
	if ( ! function_exists( 'google_chrome_setting' ) ):
		function google_chrome_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['google_chrome']) && $options['google_chrome']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[google_chrome]" value="true" ' .$checked. '/>';
			echo '<p>Force the most-recent IE rendering engine or users with <a href="http://www.chromium.org/developers/how-tos/chrome-frame-getting-started">Google Chrome Frame</a> installed to see your site using Google Frame.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages:</p>';
			echo '<code>&lt;meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"&gt;</code>';
		}
	endif; // google_chrome_setting

	//	callback fn for google_verification
	if ( ! function_exists( 'google_verification_setting' ) ):
		function google_verification_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['google_verification']) && $options['google_verification'] && $options['google_verification_account'] && $options['google_verification_account'] !== 'XXXXXXXXX...') ? 'checked="checked" ' : '';
			$account = (isset($options['google_verification_account']) && $options['google_verification_account']) ? $options['google_verification_account'] : 'XXXXXXXXX...';
			$msg = ($account === 'XXXXXXXXX...') ? ', where </code>XXXXXXXXX...</code> will be replaced with the code you insert above' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[google_verification]" value="true" ' .$checked. '/>';
			echo '<p>Add <a href="http://www.google.com/support/webmasters/bin/answer.py?answer=35179">Google Verificaton</a> code to the <code>&lt;head&gt;</code> of all your pages.</p>';
			echo '<p>To include Google Verificaton, select this option and include your Verificaton number here:<br />';
			echo '<input type="text" size="40" name="plugin_options[google_verification_account]" value="'.$account.'" onfocus="javascript:if(this.value===\'XXXXXXXXX...\'){this.select();}"></p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages'.$msg.'</p>';
			echo '<code>&lt;meta name="google-site-verification" content="'.$account.'"&gt;</code>';
		}
	endif; // google_verification_setting

	//	callback fn for viewport
	if ( ! function_exists( 'viewport_setting' ) ):
		function viewport_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['viewport']) && $options['viewport']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[viewport]" value="true" ' .$checked. '/>';
			echo '<p>Force <em><abbr title="iPhone, iTouch, iPad...">iThings</abbr></em> to <a href="http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/UsingtheViewport/UsingtheViewport.html#//apple_ref/doc/uid/TP40006509-SW19">show site at full-zoom</a>, instead of trying to show the entire page.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages:</p>';
			echo '<code>&lt;meta name="viewport" content="width=device-width"&gt;</code>';
		}
	endif; // viewport_setting

	//	callback fn for favicon
	if ( ! function_exists( 'favicon_setting' ) ):
		function favicon_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['favicon']) && $options['favicon']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[favicon]" value="true" ' .$checked. '/>';
			echo '<p>If you plan to use a <a href="http://en.wikipedia.org/wiki/Favicon">favicon</a> for your site, place the "favicon.ico" file in the root directory of your site.</p>';
			echo '<p>If the file is in the right location, you don\'t really need to select this option, browsers will automatically look there and no additional code will be added to your pages.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages:</p>';
			echo '<code>&lt;link rel="shortcut icon" href="/favicon.ico"&gt;</code>';
		}
	endif; // favicon_setting

	//	callback fn for favicon_ithing
	if ( ! function_exists( 'favicon_ithing_setting' ) ):
		function favicon_ithing_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['favicon_ithing']) && $options['favicon_ithing']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[favicon_ithing]" value="true" ' .$checked. '/>';
			echo '<p>To allow <em><abbr title="iPhone, iTouch, iPad...">iThing</abbr></em> users to <a href="http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html">add an icon for your site to their Home screen</a>, place the "apple-touch-icon.png" file in the root directory of your site.</p>';
			echo '<p>If the file is in the right location, you don\'t really need to select this option, browsers will automatically look there and no additional code will be added to your pages.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages:</p>';
			echo '<code>&lt;link rel="apple-touch-icon" href="/apple-touch-icon.png"&gt;</code>';
			echo '<code>&lt;link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png"&gt;</code>';
			echo '<code>&lt;link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png"&gt;</code>';
			echo '<code>&lt;link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png"&gt;</code>';
		}
	endif; // favicon_ithing_setting

	//	callback fn for ie_css
	if ( ! function_exists( 'ie_css_setting' ) ):
		function ie_css_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['ie_css']) && $options['ie_css']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[ie_css]" value="true" ' .$checked. '/>';
			echo '<p>If you would like to add a IE-specific CSS file, Boilerplate provides a starter file located in:</p>';
			echo '<code>' .BP_THEME_URL. '/css/ie-starter.css</code>';
			echo '<p><strong>I recommend adding any custom IE-specific CSS to this file and either copying from the starter file or using an <code>@import</code> to add the starter file rather than editing the starter file itself.  This will help to avoid your changes being overwritten during upgrades.</strong></p>';
			echo '<p><strong>And remember</strong>, you don\'t need IE-specific hacks if you activate the IE-Conditional <code>&lt;html&gt;</code> above, because you can target IE specifically by using the IE classes that are being added to <code>&lt;html&gt;</code>.  Sweet!</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages:</p>';
			echo '<code>&lt;!--[if IE ]&gt;&lt;link rel="stylesheet" href="' .BP_THEME_URL. '/css/ie.css"&gt;&lt;![endif]--&gt;</code>';
		}
	endif; // ie_css_setting

	//	callback fn for modernizr_js
	if ( ! function_exists( 'modernizr_js_setting' ) ):
		function modernizr_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['modernizr_js']) && $options['modernizr_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[modernizr_js]" value="true" ' .$checked. '/>';
			echo '<p><a href="http://modernizr.com/">Modernizr</a> is a JS library that appends classes to the <code>&lt;html&gt;</code> that indicate whether the user\'s browser is capable of handling advanced CSS, like "cssreflections" or "no-cssreflections".  It\'s a really handy way to apply varying CSS techniques, depending on the user\'s browser\'s abilities, without resorting to CSS hacks.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages (note the lack of a version, when you\'re ready to upgrade, simply copy/paste the new version into the file below, and your site is ready to go!):</p>';
			echo '<code>&lt;script src="' .BP_THEME_URL. '/js/modernizr.js"&gt;&lt;/script&gt;</code>';
			echo '<p><strong>Note: If you do <em>not</em> include Modernizr, the IEShiv JS <em>will</em> be added to accommodate the HTML5 elements used in Boilerplate in weaker browsers:</strong></p>';
			echo '<code>&lt;!--[if lt IE 9]&gt;</code>';
			echo '<code>	&lt;script src="//html5shiv.googlecode.com/svn/trunk/html5.js" onload="window.ieshiv=true;"&gt;&lt;/script&gt;</code>';
			echo '<code>	&lt;script&gt;!window.ieshiv && document.write(unescape(\'%3Cscript src="' .BP_THEME_URL. '/js/ieshiv.js"%3E%3C/script%3E\'))&lt;/script&gt;</code>';
			echo '<code>&lt;![endif]--&gt;</code>';
		}
	endif; // modernizr_js_setting

	//	callback fn for respond_js
	if ( ! function_exists( 'respond_js_setting' ) ):
		function respond_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['respond_js']) && $options['respond_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[respond_js]" value="true" ' .$checked. '/>';
			echo '<p><a href="http://filamentgroup.com/lab/respondjs_fast_css3_media_queries_for_internet_explorer_6_8_and_more/">Respond.js</a> is a JS library that helps IE<=8 understand <code>@media</code> queries, specifically <code>min-width</code> and <code>max-width</code>, allowing you to more reliably implement <a href="http://www.alistapart.com/articles/responsive-web-design/">responsive design</a> across all browsers.</p>';
			echo '<p>Selecting this option will add the following code to the <code>&lt;head&gt;</code> of your pages (note the lack of a version, when you\'re ready to upgrade, simply copy/paste the new version into the file below, and your site is ready to go!):</p>';
			echo '<code>&lt;script src="' .BP_THEME_URL. '/js/respond.js"&gt;&lt;/script&gt;</code>';
		}
	endif; // respond_js_setting

	//	callback fn for jquery_js
	if ( ! function_exists( 'jquery_js_setting' ) ):
		function jquery_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['jquery_js']) && $options['jquery_js']) ? 'checked="checked" ' : '';
			$version = (isset($options['jquery_version']) && $options['jquery_version'] && $options['jquery_version'] !== '') ? $options['jquery_version'] : '1.7.1';
			$inhead = (isset($options['jquery_head']) && $options['jquery_head']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[jquery_js]" value="true" ' .$checked. '/>';
			echo '<p><a href="http://jquery.com/">jQuery</a> is a JS library that aids greatly in developing high-quality JavaScript quickly and efficiently.</p>';
			echo '<p>Selecting this option will add the following code to your pages just before the <code>&lt;/body&gt;</code>:</p>';
			echo '<code>&lt;script src="//ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js">&lt;/script&gt;</code>';
			echo '<code>&lt;script&gt;!window.jQuery && document.write(unescape(\'%3Cscript src="'.BP_THEME_URL.'/js/jquery.js"%3E%3C/script%3E\'))&lt;/script&gt;</code>';
			echo '<p><input class="check-field" type="checkbox" name="plugin_options[jquery_head]" value="true" ' .$inhead. '/>';
			echo '<strong>Note: <a href="http://developer.yahoo.com/blogs/ydn/posts/2007/07/high_performanc_5/">Best-practices</a> recommend that you load JS as close to the <code>&lt;/body&gt;</code> as possible.  If for some reason you would prefer jQuery and jQuery plug-ins to be in the <code>&lt;head&gt;</code>, please select this option.</strong></p>';
			echo '<p>The above code first tries to download jQuery from Google\'s CDN (which might be available via the user\'s browser cache).  If this is not successful, it uses the theme\'s version.</p>';
			echo '<p><strong>Note: This plug-in tries to keep current with the most recent version of jQuery.  If for some reason you would prefer to use another version, please indicate that version:</strong><br />';
			echo '<input type="text" size="6" name="plugin_options[jquery_version]" value="'.$version.'"> (<a href="http://code.google.com/apis/libraries/devguide.html#jquery">see all versions available via Google\'s CDN</a>)</p>';
		}
	endif; // jquery_js_setting

	//	callback fn for plugins_js
	if ( ! function_exists( 'plugins_js_setting' ) ):
		function plugins_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['plugins_js']) && $options['plugins_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[plugins_js]" value="true" ' .$checked. '/>';
			echo '<p>If you choose to use any <a href="http://plugins.jquery.com/">jQuery plug-ins</a>, I recommend downloading and concatenating them together in a single JS file, as below.  This will <a href="http://developer.yahoo.com/performance/rules.html">reduce your site\'s HTTP Requests</a>, making your site a better experience.</p>';
			echo '<p>Selecting this option will add the following code to your pages just before the <code>&lt;/body&gt;</code>:</p>';
			echo '<code>&lt;script type=\'text/javascript\' src=\'' .BP_THEME_URL. '/js/plug-in.js?ver=x\'&gt;&lt;/script&gt;</code>';
			echo '<p>(The single quotes and no-longer-necessary attributes are from WP, would like to fix that... maybe next update...)</p>';
			echo '<p><strong>Note: If you do <em>not</em> include jQuery, this file will <em>not</em> be added to the page.</strong></p>';
		}
	endif; // plugins_js_setting

	//	callback fn for site_js
	if ( ! function_exists( 'site_js_setting' ) ):
		function site_js_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['site_js']) && $options['site_js']) ? 'checked="checked" ' : '';
			echo '<input class="check-field" type="checkbox" name="plugin_options[site_js]" value="true" ' .$checked. '/>';
			echo '<p>If you would like to add your own site JavaScript file, Boilerplate provides a starter file located in:</p>';
			echo '<code>' .BP_THEME_URL. '/js/script-starter.js</code>';
			echo '<p>Add what you want to that file and select this option.</p>';
			echo '<p>Selecting this option will add the following code to your pages just before the <code>&lt;/body&gt;</code>:</p>';
			echo '<code>&lt;script type=\'text/javascript\' src=\'' .BP_THEME_URL. '/js/script-starter.js?ver=x\'&gt;&lt;/script&gt;</code>';
			echo '<p>(The single quotes and no-longer-necessary attributes are from WP, would like to fix that... maybe next update...)</p>';
		}
	endif; // site_js_setting

	//	callback fn for cache_buster
	if ( ! function_exists( 'cache_buster_setting' ) ):
		function cache_buster_setting() {
			$options = get_option('plugin_options');
			$checked = (isset($options['cache_buster']) && $options['cache_buster']) ? 'checked="checked" ' : '';
			$version = (isset($options['cache_buster_version']) && $options['cache_buster_version']) ? $options['cache_buster_version'] : '1';
			echo '<input class="check-field" type="checkbox" name="plugin_options[cache_buster]" value="true" ' .$checked. '/>';
			echo '<p>To force browsers to fetch a new version of a file, versus one it might already have cached, you can add a "cache buster" to the end of your CSS and JS files.  ';
			echo 'To increment the cache buster version number, type something here:<br />';
			echo '<input type="text" size="4" name="plugin_options[cache_buster_version]" value="'.$version.'"></p>';
			echo '<p>Selecting this option will add the following code to the end of all of your CSS and JS file names on all of your pages:</p>';
			echo '<code>?ver='.$version.'</code>';
		}
	endif; // cache_buster_setting


/*	4)	Create functions to add above elements to pages */

	//	$options['toolbar']
	if ( ! function_exists( 'add_toolbar' ) ):
		function add_toolbar() {
			echo '<meta http-equiv="imagetoolbar" content="false">'.PHP_EOL;
		}
	endif; // add_toolbar

	//	$options['google_chrome']
	if ( ! function_exists( 'add_google_chrome' ) ):
		function add_google_chrome() {
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">'.PHP_EOL;
		}
	endif; // add_google_chrome

	//	$options['google_verification']
	if ( ! function_exists( 'add_google_verification' ) ):
		function add_google_verification() {
			$options = get_option('plugin_options');
			$account = $options['google_verification_account'];
			echo '<meta name="google-site-verification" content="'.$account.'">'.PHP_EOL;
		}
	endif; // add_google_verification

	//	$options['viewport']
	if ( ! function_exists( 'add_viewport' ) ):
		function add_viewport() {
			echo '<meta name="viewport" content="width=device-width">'.PHP_EOL;
		}
	endif; // add_viewport

	//	$options['favicon']
	if ( ! function_exists( 'add_favicon' ) ):
		function add_favicon() {
			echo '<link rel="shortcut icon" href="/favicon.ico">'.PHP_EOL;
		}
	endif; // add_favicon

	//	$options['favicon_ithing']
	if ( ! function_exists( 'add_favicon_ithing' ) ):
		function add_favicon_ithing() {
			echo '<link rel="apple-touch-icon" href="/apple-touch-icon.png">'.PHP_EOL;
			echo '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">'.PHP_EOL;
			echo '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">'.PHP_EOL;
			echo '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">'.PHP_EOL;
		}
	endif; // add_favicon_ithing

	//	$options['ie_css'];
	if ( ! function_exists( 'add_ie_stylesheet' ) ):
		function add_ie_stylesheet() {
			$cache = cache_buster();
			echo '<!--[if IE ]><link rel="stylesheet" href="'.BP_THEME_URL.'/css/ie.css'.$cache.'"><![endif]-->'.PHP_EOL;
		}
	endif; // add_ie_stylesheet

	//	$options['modernizr_js']
	if ( ! function_exists( 'add_modernizr_script' ) ):
		function add_modernizr_script() {
			$cache = cache_buster();
			wp_deregister_script( 'ieshiv' ); // get rid of IEShiv if it somehow got called too (IEShiv is included in Modernizr)
			wp_deregister_script( 'modernizr' ); // get rid of any native Modernizr
			echo '<script src="' .BP_THEME_URL. '/js/modernizr.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_modernizr_script

	//	$options['ieshiv_script']
	if ( ! function_exists( 'add_ieshiv_script' ) ):
		function add_ieshiv_script() {
			$cache = cache_buster();
			echo '<!--[if lt IE 9]>'.PHP_EOL;
			echo '	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js" onload="window.ieshiv=true;"></script>'.PHP_EOL; // try getting from CDN
			echo '	<script>!window.ieshiv && document.write(unescape(\'%3Cscript src="' .BP_THEME_URL. '/js/ieshiv.js'.$cache.'"%3E%3C/script%3E\'))</script>'.PHP_EOL; // fallback to local if CDN fails
			echo '<![endif]-->'.PHP_EOL;
		}
	endif; // add_ieshiv_script

	//	$options['respond_js']
	if ( ! function_exists( 'add_respond_script' ) ):
		function add_respond_script() {
			$cache = cache_buster();
			echo '<script src="' .BP_THEME_URL. '/js/respond.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_respond_script

	//	$options['jquery_js']
	if ( ! function_exists( 'add_jquery_script' ) ):
		function add_jquery_script() {
			$cache = cache_buster();
			$options = get_option('plugin_options');
			$version = ($options['jquery_version']) ? $options['jquery_version'] : '1.7.1';
			wp_deregister_script( 'jquery' ); // get rid of WP's jQuery
			echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js"></script>'.PHP_EOL; // try getting from CDN
			echo '<script>window.jQuery || document.write(unescape(\'%3Cscript src="' .BP_THEME_URL. '/js/jquery.js'.$cache.'"%3E%3C/script%3E\'))</script>'.PHP_EOL; // fallback to local if CDN fails
		}
	endif; // add_jquery_script

	//	$options['plugins_js']
	if ( ! function_exists( 'add_plugin_script' ) ):
		function add_plugin_script() {
			$cache = cache_buster();
			echo '<script src="' .BP_THEME_URL. '/js/plugins.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_plugin_script

	//	$options['site_js']
	if ( ! function_exists( 'add_site_script' ) ):
		function add_site_script() {
			$cache = cache_buster();
			echo '<script src="' .BP_THEME_URL. '/js/script.js'.$cache.'"></script>'.PHP_EOL;
		}
	endif; // add_site_script

	//	$options['cache_buster']
	if ( ! function_exists( 'cache_buster' ) ):
		function cache_buster() {
			$options = get_option('plugin_options');
			return (isset($options['cache_buster']) && $options['cache_buster']) ? '?ver='.$options['cache_buster_version'] : '';
		}
	endif; // cache_buster


/*	5)	Add Boilerplate options to page as requested */
		if (!is_admin() ) {

			// get the options
			$options = get_option('plugin_options');

			// check if each option is set (meaning it exists) and check if it is true (meaning it was checked)
			if (isset($options['toolbar']) && $options['toolbar']) {
				// if yes to both, apply option
				add_action('wp_print_styles', 'add_toolbar');
			}

			if (isset($options['google_chrome']) && $options['google_chrome']) {
				add_action('wp_print_styles', 'add_google_chrome');
			}

			if (isset($options['google_verification']) && $options['google_verification'] && $options['google_verification_account'] && $options['google_verification_account'] !== 'XXXXXXXXX...') {
				add_action('wp_print_styles', 'add_google_verification');
			}

			if (isset($options['viewport']) && $options['viewport']) {
				add_action('wp_print_styles', 'add_viewport');
			}

			if (isset($options['favicon']) && $options['favicon']) {
				add_action('wp_print_styles', 'add_favicon');
			}

			if (isset($options['favicon_ithing']) && $options['favicon_ithing']) {
				add_action('wp_print_styles', 'add_favicon_ithing');
			}

			if (isset($options['modernizr_js']) && $options['modernizr_js']) {
				add_action('wp_print_styles', 'add_modernizr_script');
			} else {
				// if Modernizr isn't selected, add IEShiv inside an IE Conditional Comment
				add_action('wp_print_styles', 'add_ieshiv_script');
			}

			if (isset($options['respond_js']) && $options['respond_js']) {
				add_action('wp_print_styles', 'add_respond_script');
			}

			if (isset($options['ie_css']) && $options['ie_css']) {
				add_action('wp_print_styles', 'add_ie_stylesheet');
			}

			if (isset($options['jquery_js']) && $options['jquery_js'] && isset($options['jquery_version']) && $options['jquery_version'] && $options['jquery_version'] !== '') {
				// check if should be loaded in <head> or at end of <body>
				$hook = (isset($options['jquery_head']) && $options['jquery_head']) ? 'wp_print_styles' : 'wp_footer';
				add_action($hook, 'add_jquery_script');
			}
			// for jQuery plug-ins, make sure jQuery was also set
			if (isset($options['jquery_js']) && $options['jquery_js'] && isset($options['plugins_js']) && $options['plugins_js']) {
				// check if should be loaded in <head> or at end of <body>
				$hook = (isset($options['jquery_head']) && $options['jquery_head']) ? 'wp_print_styles' : 'wp_footer';
				add_action($hook, 'add_plugin_script');
			}

			if (isset($options['site_js']) && $options['site_js']) {
				add_action('wp_footer', 'add_site_script');
			}

		} // if (!is_admin() )

?>
