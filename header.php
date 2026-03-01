<?php
if (!isset($pageTitle)) { $pageTitle = 'Disaster Relief Assistance Portal'; }
if (!isset($activePage)) { $activePage = ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars($pageTitle) ?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/disaster-project/assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 64 64%22><text y=%2250%22 x=%2210%22 font-size=%2250%22>🛟</text></svg>">
</head>
<body>
	<header class="navbar">
		<div class="container nav-inner">
			<a class="brand" href="index.php"><i class="fa-solid fa-life-ring"></i> Disaster Relief</a>
			<input type="checkbox" id="nav-toggle" />
			<label for="nav-toggle" class="burger"><span></span><span></span><span></span></label>
			<nav>
				<ul>
					<li><a class="<?= $activePage==='home' ? 'active' : '' ?>" href="index.php">Home</a></li>
					<li><a class="<?= $activePage==='request' ? 'active' : '' ?>" href="request_help.php">Request Help</a></li>
					<li><a class="<?= $activePage==='donate' ? 'active' : '' ?>" href="donate.php">Donate</a></li>
					<li><a class="<?= $activePage==='volunteer' ? 'active' : '' ?>" href="volunteer.php">Volunteer</a></li>
					<li><a class="<?= $activePage==='contact' ? 'active' : '' ?>" href="contact.php">Contact Us</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<main class="page-content">
	<script src="/disaster-project/assets/js/app.js" defer></script>


