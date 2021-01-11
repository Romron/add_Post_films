<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>addPostFilms_3.0 DashBoard</title>
	<link href="style_addPF_3.0.css" rel="stylesheet" type="css/text">
</head>
<body>
	

	<div class='wrap wrap_0'>
		<div class='addPF' id='logo'>
			******LOGO*****
		</div>	
		<div id="wrap_column">
			<div class='addPF' id='description'>
				******description*****
			</div>
			<button id="butt_start"><h3>СТАРТ</h3></button>
		</div>
		<div class="wrap wrap_0 wrap_1">
			<h3>Текущее состояние сайта</h3>
			<div class='wrap_4'>
				<h4>Существующие <br> записи</h4>
				<div class='addPF current_state text_format'>
					<?php	
						$arg = array(
							'post_type' => 'any',
							'posts_per_page' => -1
						);
						$arr_posts = get_posts($arg);
						foreach( $arr_posts as $post ){
							setup_postdata( $post );
							?>
							<div id="text_existing_posts">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
							<?php
						}
						wp_reset_postdata();
					?>
				</div>
			</div>
			<div class='wrap_4'>
				<h4>Существующие таксономии</h4>
				<div class='addPF current_state' >
					<?php
						$args = array(
							'public'   => true,
							'_builtin' => false
						);
						$output = 'names';
						$list_taxonomys = get_taxonomies($args,$output);
						echo '<pre>'; print_r($list_taxonomy); echo '</pre>';
						$n = 1;
						foreach ($list_taxonomys as $taxonomy) {
					?>
						<div class="text_taxonomys" id="text_existing_posts">

					<?php		
							echo('<h4>'.$n.'.'.$taxonomy.'</h4><br>');
							$n++;
							$arr_terms = get_terms( $taxonomy, array("hide_empty" => false));
							// echo '<pre>'; print_r($arr_terms); echo '</pre>';
							foreach ($arr_terms as $term) {
								echo('&nbsp;&nbsp;&nbsp;&nbsp;');
								print_r($term->name);
								echo('<br>');
							}
					?>
						</div>
					<?php
						}
					?>
				</div>
			</div>
			<div class='wrap_4'>
				<h4>Существующие <br> картинки</h4>
				<div class='addPF current_state' >
					<?php

						foreach ($arr_posts as $post) {
							$arr_attachments = get_attached_media( '', $post->ID );
							foreach ($arr_attachments as $attachment) {
								$src = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
								if ($src[1] == 150 and $src[2] == 150) {
					?>			
									<img src="<?php echo($src[0]);?>" alt=""><br>
					<?php		
								}else{continue;}
							}
						}

					?>
				</div>
			</div>
		
			<butt class='but_1'>Удалить все <br>записи</butt>
			<butt class='but_1'>Удалить все таксономии</butt>
			<butt class='but_1'>Удалить все картинки</butt>
		</div>
		<div class="wrap wrap_0 wrap_1">	
			<h3>Данные для импорта</h3>
			<div class="wrap wrap_2">
				<div class='form_1'>
					<h5 class='text_in_for_1'>Для импорта выбран файл:</h5>
					<div class='form_1 form_2'></div>
				</div>
				<button class='but_1'>Выбрать другой файл</button>
				<div class='form_1'>
					<h5 class='text_in_for_1'>Тип записи:</h5>
					<div class='form_1 form_2'></div>
				</div>
				<button class='but_1'>Выбрать другой тип записи</button>
			</div>
			<div class='wrap wrap_3'>
				<div class='wrap_4 wrap_5'>
					<h4>Текстовые данные</h4>
					<div class='addPF current_state date_for_import_2'>
							******Текстовые данные*****<br><br>
					</div>
				</div>
				<div class='wrap_4 wrap_5'>
					<h4>Картинки</h4>
					<div class='addPF current_state date_for_import_2'>
						******Картинки*****<br><br>
						Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi, delectus dolores. Asperiores ea facere, rem nesciunt sunt facilis at amet odio rerum cupiditate mollitia alias repudiandae fugiat quam. Voluptatum maiores beatae explicabo ullam id expedita, eaque voluptates fuga dolore animi libero. Hic adipisci veniam ea deserunt ipsam facere aperiam. Molestias laudantium maxime fugiat eaque, rem nisi eius, labore distinctio fugit culpa totam voluptatum atque corporis dignissimos repellendus quo architecto reiciendis consequuntur harum ratione ab iste ducimus quas aspernatur in. Est maiores aut ex, hic veniam rem delectus fugiat commodi nihil. Voluptatum fuga, quia eveniet quidem distinctio cumque dolorum, iure quam? Nisi quasi eaque dolorem odio nesciunt autem ipsum, dicta vero, in modi ipsam, maxime totam, praesentium saepe ex voluptatibus vitae doloremque nihil. Facilis vero officiis necessitatibus repellendus, omnis ducimus, sint iusto quam cum eligendi voluptas ut laudantium voluptatum doloribus nostrum consequuntur modi illum odio fuga dolorum voluptatibus perferendis. Repellendus tenetur ipsum accusantium, explicabo dicta ullam eum inventore suscipit debitis quam aliquid vitae harum aliquam nam reiciendis saepe nesciunt nulla magni natus dolore quo. Deleniti quasi, libero fugiat nobis. Ullam ipsam explicabo cumque facere eligendi amet natus assumenda eum consectetur cupiditate harum deserunt ut facilis incidunt, laudantium vitae dolorum beatae, error. Tenetur distinctio atque possimus deserunt, aliquid iste consequuntur quibusdam molestiae error deleniti quidem itaque reprehenderit expedita quisquam saepe? Minus ipsum ipsa perspiciatis iusto in similique neque consequatur voluptatem provident eius autem vel recusandae quia sed, adipisci quas voluptatibus. Minus saepe necessitatibus illum reiciendis aut iure mollitia, quisquam cupiditate, ipsam, suscipit esse est, obcaecati eligendi tenetur excepturi? Distinctio dignissimos laboriosam possimus saepe voluptatem qui sint velit molestias optio, obcaecati, reiciendis, iste voluptate laborum? Repellat aliquid in obcaecati soluta quam doloribus, est dignissimos alias nobis nisi optio fuga dolores, incidunt fugit eveniet ad consequuntur illum, beatae maxime placeat eaque sapiente iusto?
					</div>

				</div>


			</div>
		</div>	
		<h3>Результат выполнения скрипта</h3>
		<div class='addPF' id='result'>
			
		</div>	
	</div>





<!-- Для LiveReload: -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>












	












 







