<div class="row blog">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
			<h1><?= $page_content['header']; ?></h1>
			<h3><?= $page_content['sub_header']; ?></h3>

			<form action="#" method="POST" id="blog_search" class="blog_search" onsubmit="return false;">
				<input type="text" name="search_key" placeholder="Что Вы хотите найти?" />
				<button type="button" onclick="ajax.blog_search();">Найти</button>
			</form>
			<div class="clear"></div>

			<div class="cont_db">
				<?= $page_content['details']; ?>
			</div>
		</div>
		<p class="response"><span></span></p>
		<div id="blog_scope">
			
			<div class="clear"></div>
			<?php foreach ($blog_posts as $post): ?>
				<?php 
					$date_str = $post['dateCreate'];
					$post_create_unix = strtotime($date_str);
					$date_str = explode('-', $date_str);
					$now = strtotime(date("Y-m-d"));
				?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 blog_post itbp">
					<a href="<?= $post['alias']; ?>">
						<?php if (isset($post['filename']) && $post['filename'] != ""): ?>
							<div class="img_wr">
								<div class="hover <?php echo ($post['is_video'] == 1 ? 'video' : '');?>">
									<p><span>Узнать больше</span></p>
								</div>
								<img src="<?= BANNER_PATH.$post['filename']; ?>" alt="Post" />
							</div>
						<?php endif ?>
						<div class="wrap">
							<span class="new">
								<?php 
									if (($now - $post_create_unix) < 8600) {
										echo "New";
									}else{
										echo "";
									}
								?>
							</span>
							<p class="post_name"><?php 
							if (strlen($post['name']) > 100) {
								echo implode(array_slice(explode('<br>',wordwrap(strip_tags($post['name']),100,'<br>',false)),0,1))."...";
							}else{
								echo $post['name'];
							}
							?></p>
							<p class="text"><?= implode(array_slice(explode('<br>',wordwrap(strip_tags($post['content']),250,'<br>',false)),0,1));?>...</p>
							<p class="date"><span><?= $date_array[$date_str[1]];?></span> <?= $date_str[0];?></p>


							
						</div>
					</a>
				</div>
			<?php endforeach ?>
			<div class="clear"></div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
				<span class="alig mb60">
					<ul class="pag">
						<?php if ($num_pages > 1): ?>
							<?php 
								for ($i=1; $i < $num_pages+1; $i++) { 
									?>
										<li><a href="?page=<?php echo $i; ?>" class="<?php echo ($cur_page == $i  ? 'active' : ''); ?>"><?php echo $i; ?></a></li>
									<?php
								}
							?>
						<?php endif ?> 
					</ul>
				</span>
				<div class="clear"></div>
			</div>
		</div>

	</div>
</div>


