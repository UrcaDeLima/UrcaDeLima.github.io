<?php 
	require 'db.php'; 
	$line_articles_categories = mysqli_query($connection, "SELECT * FROM `articles_categories`");
?>
<header id="header">
    <div class="header__top">
		<div class="container">
			<div class="header__top__logo">
				<h1><?php echo $config['title']; ?></h1>
			</div>
			<nav class="header__top__menu">
				<ul>
					<li><a href="/">Главная</a></li>
					<li><a href="../pages/about_me.php">Обо мне</a></li>
					<li><a href="#">Я Вконтакте</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="header__bottom">
        <div class="container">
			<nav>
				<ul>
					<?php
						while($categories = mysqli_fetch_assoc($line_articles_categories)){
					?>
							<li><a href="../pages/articles_categories.php?id=<?php echo $categories['id']; ?>"><?php echo $categories['title']; ?></a></li>
					<?php
						}
					?>
				</ul>
			</nav>
        </div>
    </div>
</header>