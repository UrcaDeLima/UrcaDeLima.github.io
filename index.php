<?php 
	require 'include/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>

	<link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

	<div id="wrapper">
		<?php
			require 'include/header.php';
		?>
		<div id="content">
			<div class="container">
				<div class="row">
					<section class="content__left col-md-8">
						<div class="block">
						<a href="../pages/articles_categories.php">Все записи</a>
						<h3>Новейшее_в_блоге</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">
									<?php
										$line_articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 10");
									?>
									<?php while($art = mysqli_fetch_assoc($line_articles)){ ?>
									<article class="article">
										<div class="article__image" style="background-image: url(static/images/<?php echo $art['image']; ?>);"></div>
										<div class="article__info">
											<a href="pages/articles.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
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
							<h3>Безопасность (Новейшее)</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">
								<?php
									$line_articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie_id` = 3 ORDER BY `id` DESC LIMIT 10");
								?>
								<?php while($art = mysqli_fetch_assoc($line_articles)){ ?>
									<article class="article">
										<div class="article__image" style="background-image: url(static/images/<?php echo $art['image']; ?>);"></div>
										<div class="article__info">
											<a href="pages/articles.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
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
							<h3>Программирование (Новейшее)</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">
								<?php
									$line_articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie_id` = 1 ORDER BY `id` DESC LIMIT 10");
								?>
								<?php while($art = mysqli_fetch_assoc($line_articles)){ ?>
									<article class="article">
										<div class="article__image" style="background-image: url(static/images/<?php echo $art['image']; ?>);"></div>
										<div class="article__info">
											<a href="pages/articles.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
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
					</section>
					<?php require 'include/sidebar.php'; ?>
				</div>
			</div>
		</div>
		<?php require 'include/footer.php'; ?>
	</div>

</body>
</html>