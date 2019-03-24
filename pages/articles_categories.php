<?php require "../include/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>

	<!-- Bootstrap Grid -->
	<link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

	<div id="wrapper">
		<?php
			require "../include/header.php";
		?>
		<div id="content">
			<div class="container">
				<div class="row">
					<section class="content__left col-md-8">
						
						<div class="block">
						<h3>Все_статьи</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">
									<?php
										$per_page = 4;
										$page = 1;
										if(isset($_GET['page'])){
											$page = (int) $_GET['page'];
										}
										if(isset($_GET['id'])){
											$id = $_GET['id'];
											$total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles` WHERE `categorie_id` = $id");
										}else{
											$total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles`");
										}
										$total_count = mysqli_fetch_assoc($total_count_q);
										$total_count = $total_count['total_count'];
										
										$total_pages = ceil($total_count / $per_page);
										if($page <= 1 || $page > $total_pages){
											$page = 1;
										}
										$offset = ($per_page * $page) - $per_page;
										if(isset($_GET['id'])){
											$line_articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie_id` = $id ORDER BY `id` DESC LIMIT $offset, $per_page");
										}else{
											$line_articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $offset, $per_page");
										}
										$articles_exist = true;
										if(mysqli_num_rows($line_articles) <= 0){
											echo 'Статей нет!';
											$articles_exist = false;
										}
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
												<small>Категория: <a href="articles_categories.php?id=<?php echo $categories['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
											</div>
											<div class="article__info__preview"><?php echo mb_substr(strip_tags($art['text']), 0, 100, 'utf-8') . '...'; ?></div>
										</div>
									</article>
									<?php } ?>
								</div>
								<?php
									if($articles_exist == true){
										echo '<div class = "paginator">';
										if($page > 1){
											echo '<a href = "/pages/articles_categories.php?page='.($page - 1).'">&laquo; Прошлая</a>	';
										}
										if($page < $total_pages){
											echo '<a href = "/pages/articles_categories.php?page='.($page + 1).'">Следующая &raquo;</a>';
										}
										echo '</div>';
									}
								?>
							</div>
						</div>
						
					</section>
					<?php require '../include/sidebar.php'; ?>
				</div>
			</div>
		</div>
    </div>

    <?php require '../include/footer.php'; ?>

</body>
</html>