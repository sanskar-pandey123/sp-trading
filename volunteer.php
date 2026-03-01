<?php
$pageTitle = 'Volunteer - Disaster Relief';
$activePage = 'volunteer';
$alert = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require __DIR__ . '/includes/db.php';
	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$phone = trim($_POST['phone'] ?? '');
	$skills = trim($_POST['skills'] ?? '');
	$availability = trim($_POST['availability'] ?? '');
	$website = trim($_POST['website'] ?? ''); // honeypot

	if ($website !== '') {
		$alert = ['type' => 'error', 'msg' => 'Submission flagged as spam.'];
	} elseif ($name === '' || $email === '' || $phone === '') {
		$alert = ['type' => 'error', 'msg' => 'Please fill in all required fields.'];
	} else {
		$name = mb_substr($name, 0, 120);
		$email = mb_substr($email, 0, 160);
		$phone = mb_substr($phone, 0, 40);
		$skills = mb_substr($skills, 0, 200);
		$availability = mb_substr($availability, 0, 120);
		$stmt = $mysqli->prepare('INSERT INTO volunteers (name, email, phone, skills, availability, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
		if ($stmt) {
			$stmt->bind_param('sssss', $name, $email, $phone, $skills, $availability);
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
	<div class="card reveal" style="margin-bottom:16px">
		<h2><i class="fa-solid fa-handshake-angle"></i> Become a Volunteer</h2>
		<p class="muted">Join our network to support rescue operations, distribute supplies, or provide medical assistance.</p>
	</div>

	<div class="form reveal">
		<div class="gradient-header" style="margin:-8px 0 12px">
			<span class="pill"><i class="fa-solid fa-bolt"></i> High Impact</span>
			<h3 style="margin:8px 0 0"><i class="fa-solid fa-people-carry-box"></i> Volunteer Form</h3>
		</div>
		<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
			<div class="alert alert-success" data-autoclose="1">Thanks for volunteering! We will reach out when help is needed.</div>
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
					<label for="phone">Phone *</label>
					<i class="fa-solid fa-phone"></i>
					<input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($phone ?? '') ?>" required pattern="[\d\s+\-()]{6,}">
				</div>
				<div class="field with-icon">
					<label for="skills">Skills / Role</label>
					<i class="fa-solid fa-screwdriver-wrench"></i>
					<input type="text" id="skills" name="skills" value="<?= htmlspecialchars($skills ?? '') ?>" placeholder="e.g., First aid, Driver, Logistics">
				</div>
				<div class="field with-icon">
					<label for="availability">Availability</label>
					<i class="fa-solid fa-calendar-check"></i>
					<input type="text" id="availability" name="availability" value="<?= htmlspecialchars($availability ?? '') ?>" placeholder="e.g., Weekends, Full-time, Evenings">
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
	<!-- Benefits -->
	<div class="grid" style="margin-top:16px">
		<div class="card reveal" style="grid-column: span 4;">
			<h3><i class="fa-solid fa-medal"></i> Impact</h3>
			<p class="muted">Make a real difference during critical hours.</p>
		</div>
		<div class="card reveal" style="grid-column: span 4;">
			<h3><i class="fa-solid fa-graduation-cap"></i> Training</h3>
			<p class="muted">Access basic first-aid and safety workshops.</p>
		</div>
		<div class="card reveal" style="grid-column: span 4;">
			<h3><i class="fa-solid fa-people-group"></i> Community</h3>
			<p class="muted">Work with a strong network of responders.</p>
		</div>
	</div>
	<!-- Steps -->
	<div class="card reveal section-accent" style="margin-top:16px">
		<h3><i class="fa-solid fa-route"></i> Onboarding Steps</h3>
		<div class="timeline">
			<div class="step reveal"><strong>1. Register</strong> <span class="muted">Share your skills and contact</span></div>
			<div class="step reveal"><strong>2. Orient</strong> <span class="muted">Attend a brief training</span></div>
			<div class="step reveal"><strong>3. Deploy</strong> <span class="muted">Join field or remote support</span></div>
			<div class="step reveal"><strong>4. Reflect</strong> <span class="muted">Post-mission debrief</span></div>
		</div>
	</div>
	<!-- Gallery strip -->
	<div class="card reveal" style="margin-top:16px; padding:0; overflow:hidden">
		<div style="display:flex;gap:8px;overflow:auto;padding:8px">
			<?php
			$pics = [
				'https://images.unsplash.com/photo-1543248939-ff40856f65d4?q=80&w=600&auto=format&fit=crop',
				'https://images.unsplash.com/photo-1520975916090-3105956dac38?q=80&w=600&auto=format&fit=crop',
				'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=600&auto=format&fit=crop'
			];
			foreach ($pics as $s) {
				echo '<img class="reveal" src="'.htmlspecialchars($s).'" alt="volunteers" style="height:110px;border-radius:10px;object-fit:cover">';
			}
			?>
		</div>
	</div>
	<!-- FAQ -->
	<div class="grid" style="margin-top:16px">
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Do I need prior experience? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">No. We guide you with basic safety and roles.</div>
		</div>
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Are volunteers insured? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">Coverage depends on partner org policies. Details shared during orientation.</div>
		</div>
	</div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>


