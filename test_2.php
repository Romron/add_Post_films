<!DOCTYPE html>
<html>
<head>
	<title>Существующие картинки</title>
	<meta charset="utf-8">
</head>
<body>

</body>
</html>



<?php
require_once("function_addPF_3.0.php");
set_time_limit(0);

echo('<h1> Существующие картинки: </h1><br>');



$arg = array(
	'post_type' => 'any',
	'posts_per_page' => -1
);
$arr_posts = get_posts($arg);
foreach( $arr_posts as $post ){
	setup_postdata( $post );
	?>
		<a href="<?php the_permalink(); ?>">
			<?php 
				$post_id = get_the_ID();
				echo($post_id.'.&nbsp;');
				the_title(); 
			?>
				
		</a><br>
	<?php

$arr_attachments = get_attached_media( '', $post_id );
echo '<pre>'; print_r($attachments); echo '</pre>';
foreach ($arr_attachments as $attachment) {
	// echo '<pre>'; print_r($attachment); echo '</pre>';

	$src = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
	echo '<pre>'; print_r($src); echo '</pre>';
?>
	<!-- <img src="<?php echo($src[0]);?>" alt=""><br> -->
<?php



}


}
wp_reset_postdata();












?>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

