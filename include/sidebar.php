<section class="content__right col-md-4">

	<div class="block">
		<h3>Топ читаемых статей</h3>
		<div class="block__content">
			<div class="articles articles__vertical">
				<?php
					$line_articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 5");
				?>
				<?php while($art = mysqli_fetch_assoc($line_articles)){ ?>
				  <article class="article">
					<div class="article__image" style="background-image: url(../static/images/<?php echo $art['image']; ?>);"></div>
					<div class="article__info">
					  <a href="../pages/articles.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
					  <div class="article__info__meta">
						<?php 
							$art_cat = false;
							foreach($line_articles_categories as $categories){
								if($categories['id'] == $art['categorie_id']){
									$art_cat = $categories;
									break;
								}
							} 
						?>
						<small>Категория: <a href="../pages/articles_categories.php?id=<?php echo $categories['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
					  </div>
					  <div class="article__info__preview"><?php echo mb_substr(strip_tags($art['text']), 0, 100, 'utf-8') . '...'; ?></div>
					</div>
				  </article>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="block">
		<h3>Комментарии</h3>
		<div class="block__content">
			<div class="articles articles__vertical">
				<?php
					$line_comments = mysqli_query($connection, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5");
					//https://www.gravatar.com/avatar/<?php echo md5($comments['email']); ... ?s = 125
				?>
				<?php while($comments = mysqli_fetch_assoc($line_comments)){ ?>
				  <article class="article">
					<div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=125);"></div>
					<div class="article__info">
						<a href="../pages/articles.php?id=<?php echo $comments['articles_id']; ?>"><?php echo $comments['author']; ?></a>
						<div class="article__info__meta">
							<?php 
								$com = false;
								foreach($line_articles_categories as $categories){
									if($categories['id'] == $com['categorie_id']){
										$art_cat = $categories;
										break;
									}
								} 
							?>
						</div>
						<div class="article__info__preview"><?php echo mb_substr(strip_tags($comments['text']), 0, 100, 'utf-8') . '...'; ?></div>
					</div>
				</article>
				<?php } ?>
			</div>
		</div>
	</div>
</section>