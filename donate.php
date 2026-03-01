<?php
$pageTitle = 'Donate - Disaster Relief';
$activePage = 'donate';
$alert = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require __DIR__ . '/includes/db.php';
	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$type = trim($_POST['type'] ?? '');
	$message = trim($_POST['message'] ?? '');
	$website = trim($_POST['website'] ?? ''); // honeypot

	if ($website !== '') {
		$alert = ['type' => 'error', 'msg' => 'Submission flagged as spam.'];
	} elseif ($name === '' || $email === '' || $type === '') {
		$alert = ['type' => 'error', 'msg' => 'Please fill in all required fields.'];
	} else {
		$name = mb_substr($name, 0, 120);
		$email = mb_substr($email, 0, 160);
		$type = mb_substr($type, 0, 20);
		$message = mb_substr($message, 0, 2000);
		$stmt = $mysqli->prepare('INSERT INTO donations (name, email, type, message, created_at) VALUES (?, ?, ?, ?, NOW())');
		if ($stmt) {
			$stmt->bind_param('ssss', $name, $email, $type, $message);
			if ($stmt->execute()) {
				header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?success=1');
				exit;
			} else {
				$alert = ['type' => 'error', 'msg' => 'Failed to submit. Please try again.'];
			}
			$stmt->close();
		} else {
			$alert = ['type' => 'error', 'msg' => 'System error. Please try later.'];
		}
	}
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<section class="container">
	<div class="card reveal section-accent" style="margin-bottom:16px">
		<h2><i class="fa-solid fa-heart-circle-plus"></i> Your Donations Make a Difference</h2>
		<p class="muted">Funds and supplies help deliver food, water, medical aid, and shelter to affected families.</p>
	</div>

	<div class="two-col">
		<div class="col">
			<div class="form reveal">
				<div class="gradient-header" style="margin:-8px 0 12px">
					<span class="pill"><i class="fa-solid fa-seedling"></i> 100% Impact</span>
					<h3 style="margin:8px 0 0"><i class="fa-solid fa-donate"></i> Donate</h3>
				</div>
		<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
			<div class="alert alert-success" data-autoclose="1">Thank you for your donation. We appreciate your support!</div>
		<?php elseif ($alert): ?>
			<div class="alert alert-<?= $alert['type'] === 'success' ? 'success' : 'error' ?>"><?= htmlspecialchars($alert['msg']) ?></div>
		<?php endif; ?>
		<form method="post" action="">
			<div class="input-row">
				<div class="field with-icon">
					<label for="name">Name *</label>
					<i class="fa-solid fa-user"></i>
					<input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
				</div>
				<div class="field with-icon">
					<label for="email">Email *</label>
					<i class="fa-solid fa-envelope"></i>
					<input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
				</div>
				<div class="field with-icon">
					<label for="type">Donation Type *</label>
					<i class="fa-solid fa-gift"></i>
					<select id="type" name="type" required>
					<?php
					$dtypes = ['Money','Food','Clothes','Medicines'];
					$current = $type ?? '';
					foreach ($dtypes as $opt) {
						$sel = $current === $opt ? 'selected' : '';
						echo '<option ' . $sel . '>' . htmlspecialchars($opt) . '</option>';
					}
					?>
					</select>
				</div>
				<div class="field with-icon" style="grid-column: span 12;">
					<label for="message">Message</label>
					<i class="fa-solid fa-message"></i>
					<textarea id="message" name="message" placeholder="Optional note..."><?= htmlspecialchars($message ?? '') ?></textarea>
				</div>
			</div>
			<div class="field" style="display:none">
				<label for="website">Website</label>
				<input type="text" id="website" name="website" value="">
			</div>
			<div class="actions">
				<button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
			</div>
		</form>
			</div>
		</div>
		<div class="col">
			<div class="card reveal card-em">
				<h3><i class="fa-solid fa-box-open"></i> Where your support goes</h3>
				<ul>
					<li>Emergency food and water kits</li>
					<li>Medical supplies and hygiene packs</li>
					<li>Temporary shelter and blankets</li>
					<li>Fuel and logistics for field teams</li>
				</ul>
				<div class="gallery" style="margin-top:10px">
					<div class="img"><img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=600&auto=format&fit=crop" alt=""></div>
					<div class="img"><img src="https://images.unsplash.com/photo-1520975916090-3105956dac38?q=80&w=600&auto=format&fit=crop" alt=""></div>
					<div class="img"><img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=600&auto=format&fit=crop" alt=""></div>
					<div class="img"><img src="https://images.unsplash.com/photo-1543248939-ff40856f65d4?q=80&w=600&auto=format&fit=crop" alt=""></div>
				</div>
			</div>
			<div class="card reveal section-accent" style="margin-top:12px">
				<h3><i class="fa-solid fa-shield-heart"></i> Transparency</h3>
				<p class="muted">We record donations and publish periodic impact reports.</p>
			</div>
		</div>
	</div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>


