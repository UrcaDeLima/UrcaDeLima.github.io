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
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			}
			$line_articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = $id");
			$articles = array();
			while($art = mysqli_fetch_assoc($line_articles)){
				$articles[] = $art;
			}
			mysqli_query($connection, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = $id");
		?>
		<div id="content">
			<div class="container">
				<div class="row">
					<section class="content__left col-md-8">
						<div class="block">
							<a><?php foreach($articles as $art) echo $art['views'];
								echo ' просмотров';?>
							</a>
							<h3><?php foreach($articles as $art) echo $art['title'];?></h3>
							<div class="block__content">
							<img src="../static/images/<?php foreach($articles as $art) echo $art['image'];?>" style = "max-width: 100%;">

								<div class="full-text">
									<?php 
										echo '<br>';
										foreach($articles as $art){
											echo $art['text'];
										}
									?>
								</div>
							</div>
						</div>
						
						<div class="block">
							<a href="#comment-add-form">Добавить свой</a>
							<h3>Комментарии к статье</h3>
							<div class="block__content">
								<div class="articles articles__vertical">
									<?php
										if(isset($_GET['id'])){
											$id = $_GET['id'];
										}
										$line_comments = mysqli_query($connection, "SELECT * FROM `comments` WHERE `articles_id` = $id ORDER BY `id` DESC LIMIT 5");
									?>
									
									<?php while($comments = mysqli_fetch_assoc($line_comments)){ ?>
									<article class="article">
										<div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=125);"></div>
										<div class="article__info">
											<a href="#"><?php echo $comments['author']; ?></a>
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
												<small><?php //echo (int) getdate(); ?>10 минут назад</small>
											</div>
											<div class="article__info__preview"><?php echo $comments['text']; ?></div>
										</div>
									</article>
									<?php } ?>

								</div>
							</div>
						</div>

						<div class="block" id="comment-add-form">
							<h3>Добавить комментарий</h3>
							<div class="block__content">
								<form class="form" method = "POST" action = "articles.php?id=<?php echo $id; ?>">
									<?php if(isset($_POST['do_post'])){
										mysqli_query($connection, "INSERT INTO `comments` (`author`, `nickname`, `text`, `articles_id`) VALUE('".$_POST['name']."', '".$_POST['nickname']."', '".$_POST['text']."', '".$id."')");
									} ?>
									<div class="form__group">
										<div class="row">
											<div class="col-md-6">
												<input type="text" class="form__control" required="" name="name" placeholder="Имя">
											</div>
											<div class="col-md-6">
												<input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм">
											</div>
										</div>
									</div>
									<div class="form__group">
										<textarea name="text" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
									</div>
									<div class="form__group">
										<input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
									</div>
								</form>
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