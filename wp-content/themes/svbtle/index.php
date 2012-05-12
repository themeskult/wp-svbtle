<?php 

get_header();

?>

<div class="entry-meta">
	<?php echo date('M d, Y'); ?>
</div><!-- .entry-meta -->

<?php

get_template_part( 'loop', 'index' );

get_footer(); 

?>