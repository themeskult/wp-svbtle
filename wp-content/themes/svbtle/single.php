<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

<header id="begin">
  <time datetime="<?php echo date('Y-m-d'); ?>" id="top_time"><?php the_time('F d, Y'); ?></time>

  <style type='text/css'>
    #also-read-title {
      font-weight: 600;
      color: #777;
      padding: 20px 40px;
      margin: 0px;
      font-style: italic;
      border-top: 1px solid #E2E2E2;
      max-width: none;
      font-size: 18px;
    }
    #also-read-items {
      margin: 0px;
    }
    #also-read-items li {
      position: relative;
      margin: 0px;
      border-top: 1px solid #E2E2E2;
      color: #777;
    }
    #also-read-items a {
      display: block;
      padding-top: 20px;
      padding-bottom: 20px;
      color: inherit;
    }
    #also-read-items a:visited {
      color: #333;
      text-decoration: none;
      outline: 0;
    }
    #also-read-items h3 {
      margin: 0px;
      font-size: 16px;
      line-height: 18px;
      padding-left: 90px;
      color: inherit;
      font-weight: 600;
    }
    #also-read-items .link_kudo {
      padding: 0px;
      border: 3px solid #777;
      width: 30px;
      border-radius: 35px;
      margin: 0px;
      text-align: center;
      line-height: 31px;
      font-weight: 700;
      color: inherit;
      position: absolute;
      left: 40px;
      top: 50%;
      margin-top: -18px;
      font-size: 13px;
      letter-spacing: 0px;
    }
  </style>
</header>

<?php get_template_part( 'loop', 'index' ); ?>

<?php
$posts=$wpdb->get_results($wpdb->prepare(
 "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = %s AND post_id <> %d " .
 "ORDER BY CHAR_LENGTH(meta_value) DESC, meta_value DESC LIMIT 5",
 '_wp-svbtle-kudos', get_the_ID()
));
?>

<div>
  <h2 id='also-read-title'>Also read...</h2>
  <ul id='also-read-items'>
  <?php for($i=0; $i<count($posts); $i++): ?>
    <li>
      <a href="<?php echo get_permalink($posts[$i]->post_id); ?>">
        <h3><?php echo get_the_title($posts[$i]->post_id); ?></h3>
        <p class="link_kudo"><?php echo $posts[$i]->meta_value; ?></p>
      </a>
    </li>
  <?php endfor; ?>
  </ul>
</div>

<?php comments_template(); ?>

<nav class="pagination">
  <span class="prev">
    <a href="<?php echo home_url( '/' ); ?>" class="back_to_blog">←&nbsp;&nbsp;&nbsp;read more</a>
  </span>
</nav>

<?php get_footer(); ?>

<script type="text/javascript">
  <?php
    $options = get_option ( 'svbtle_options' );
    if( isset( $options['color'] ) && '' != $options['color'] )
      $color = $options['color'];
    else
      $color = "#ff0000";
  ?>

  jQuery(document).ready(function($) {
    $("#also-read-items li").hover(
      function() {
        $(this).css('color', 'white');
        $(this).css('background-color', '<?php echo $color ?>');
        $(this).find('.link_kudo').css('border', '3px solid white');
      },
      function() {
        $(this).css('color', '#777');
        $(this).css('background-color', 'white');
        $(this).find('.link_kudo').css('border', '3px solid #777');
      }
    );
  });
</script>
