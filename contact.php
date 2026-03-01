<?php
$pageTitle = 'Contact Us - Disaster Relief';
$activePage = 'contact';
$alert = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$message = trim($_POST['message'] ?? '');
	$website = trim($_POST['website'] ?? ''); // honeypot
	if ($website !== '') {
		$alert = ['type' => 'error', 'msg' => 'Submission flagged as spam.'];
	} elseif ($name === '' || $email === '' || $message === '') {
		$alert = ['type' => 'error', 'msg' => 'Please fill in all fields.'];
	} else {
		$alert = ['type' => 'success', 'msg' => 'Thanks for contacting us. We will get back to you soon.'];
		$name = $email = $message = '';
	}
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<section class="container">
	<div class="grid">
		<div class="form reveal" style="grid-column: span 7;">
			<div class="gradient-header" style="margin:-8px 0 12px">
				<span class="pill"><i class="fa-solid fa-message"></i> We respond fast</span>
				<h2 style="margin:8px 0 0"><i class="fa-solid fa-envelope"></i> Contact Us</h2>
			</div>
			<?php if ($alert): ?>
				<div class="alert alert-<?= $alert['type'] === 'success' ? 'success' : 'error' ?>"><?= htmlspecialchars($alert['msg']) ?></div>
			<?php endif; ?>
			<form method="post" action="">
				<div class="input-row">
					<div class="field with-icon">
						<label for="name">Name</label>
						<i class="fa-solid fa-user"></i>
						<input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
					</div>
					<div class="field with-icon">
						<label for="email">Email</label>
						<i class="fa-solid fa-envelope"></i>
						<input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
					</div>
					<div class="field with-icon" style="grid-column: span 12;">
						<label for="message">Message</label>
						<i class="fa-solid fa-message"></i>
						<textarea id="message" name="message" required><?= htmlspecialchars($message ?? '') ?></textarea>
					</div>
				</div>
				<div class="field" style="display:none">
					<label for="website">Website</label>
					<input type="text" id="website" name="website" value="">
				</div>
				<div class="actions">
					<button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Send</button>
				</div>
			</form>
		</div>
		<div class="card reveal section-accent" style="grid-column: span 5;">
			<h3><i class="fa-solid fa-phone-volume"></i> Emergency Contacts</h3>
			<ul>
				<li><strong>24x7 Helpline:</strong> +91-112 / +91-108</li>
				<li><strong>Relief Coordination:</strong> +91-90000 00000</li>
				<li><strong>Email:</strong> help@disasterrelief.local</li>
				<li><strong>Address:</strong> Disaster Relief HQ, City Center, 1st Floor</li>
			</ul>
			<p class="muted">If you are in immediate danger, call your local emergency number.</p>
		</div>
	</div>
	<div class="card reveal" style="margin-top:16px; padding:0; overflow:hidden">
		<div style="position:relative;padding-top:56.25%">
			<iframe style="position:absolute;inset:0;border:0;width:100%;height:100%" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Safety Tips" allowfullscreen></iframe>
		</div>
	</div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>


