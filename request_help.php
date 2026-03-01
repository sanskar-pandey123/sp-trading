<?php
$pageTitle = 'Request Help - Disaster Relief';
$activePage = 'request';
$alert = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require __DIR__ . '/includes/db.php';
	$name = trim($_POST['name'] ?? '');
	$location = trim($_POST['location'] ?? '');
	$help_type = trim($_POST['help_type'] ?? '');
	$description = trim($_POST['description'] ?? '');
	$contact = trim($_POST['contact'] ?? '');
	$website = trim($_POST['website'] ?? ''); // honeypot

	// honeypot trip
	if ($website !== '') {
		$alert = ['type' => 'error', 'msg' => 'Submission flagged as spam.'];
	} elseif ($name === '' || $location === '' || $help_type === '' || $contact === '') {
		$alert = ['type' => 'error', 'msg' => 'Please fill in all required fields.'];
	} else {
		// Trim lengths
		$name = mb_substr($name, 0, 120);
		$location = mb_substr($location, 0, 200);
		$help_type = mb_substr($help_type, 0, 20);
		$description = mb_substr($description, 0, 2000);
		$contact = mb_substr($contact, 0, 60);
		$stmt = $mysqli->prepare('INSERT INTO requests (name, location, help_type, description, contact, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
		if ($stmt) {
			$stmt->bind_param('sssss', $name, $location, $help_type, $description, $contact);
			if ($stmt->execute()) {
				header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?success=1');
				exit;
			} else {
				$alert = ['type' => 'error', 'msg' => 'Failed to submit request. Please try again.'];
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
	<div class="form">
		<h2><i class="fa-solid fa-hand-holding-heart"></i> Request Help</h2>
		<p class="muted">Provide details so volunteers can reach you quickly.</p>
		<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
			<div class="alert alert-success" data-autoclose="1">Your request has been submitted successfully. Stay safe!</div>
		<?php elseif ($alert): ?>
			<div class="alert alert-<?= $alert['type'] === 'success' ? 'success' : 'error' ?>"><?= htmlspecialchars($alert['msg']) ?></div>
		<?php endif; ?>
		<form method="post" action="">
			<div class="field">
				<label for="name">Full Name *</label>
				<input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
			</div>
			<div class="field">
				<label for="location">Location (City, Area) *</label>
				<input type="text" id="location" name="location" value="<?= htmlspecialchars($location ?? '') ?>" required>
			</div>
			<div class="field">
				<label for="help_type">Type of Help Needed *</label>
				<select id="help_type" name="help_type" required>
					<?php
					$options = ['Rescue','Food','Medical','Shelter','Others'];
					$current = $help_type ?? '';
					foreach ($options as $opt) {
						$sel = $current === $opt ? 'selected' : '';
						echo '<option ' . $sel . '>' . htmlspecialchars($opt) . '</option>';
					}
					?>
				</select>
			</div>
			<div class="field">
				<label for="description">Description</label>
				<textarea id="description" name="description" placeholder="Mention number of people, landmarks, urgent needs..."><?= htmlspecialchars($description ?? '') ?></textarea>
			</div>
			<div class="field">
				<label for="contact">Contact Number *</label>
				<input type="tel" id="contact" name="contact" value="<?= htmlspecialchars($contact ?? '') ?>" required pattern="[\d\s+\-()]{6,}">
			</div>
			<div class="field" style="display:none">
				<label for="website">Website</label>
				<input type="text" id="website" name="website" value="">
			</div>
			<div class="actions">
				<button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Submit Request</button>
			</div>
		</form>
	</div>
	<p class="muted" style="margin-top:10px">Fields marked * are required.</p>
	<div class="card reveal" style="margin-top:16px">
		<h3><i class="fa-solid fa-triangle-exclamation"></i> Safety Tips</h3>
		<ul>
			<li>Keep your phone charged and stay in a safe location if possible.</li>
			<li>Share accurate landmarks to help responders find you faster.</li>
		</ul>
	</div>
	<!-- Extra info panels -->
	<div class="grid" style="margin-top:16px">
		<div class="card reveal" style="grid-column: span 6;">
			<h3><i class="fa-solid fa-map-location-dot"></i> Share Precise Location</h3>
			<p class="muted">Mention nearby landmarks, building color, or GPS coordinates if possible.</p>
		</div>
		<div class="card reveal" style="grid-column: span 6;">
			<h3><i class="fa-solid fa-people-group"></i> Number of People</h3>
			<p class="muted">Let us know how many are with you, including any elderly or children.</p>
		</div>
	</div>
	<!-- Timeline -->
	<div class="card reveal" style="margin-top:16px">
		<h3><i class="fa-solid fa-route"></i> What happens next</h3>
		<div class="timeline">
			<div class="step reveal"><strong>1. Verify</strong> <span class="muted">We review your request</span></div>
			<div class="step reveal"><strong>2. Assign</strong> <span class="muted">Nearest volunteers notified</span></div>
			<div class="step reveal"><strong>3. Reach</strong> <span class="muted">Responder contacts you</span></div>
			<div class="step reveal"><strong>4. Support</strong> <span class="muted">Follow-up until safe</span></div>
		</div>
	</div>
	<!-- Mini gallery strip -->
	<div class="card reveal" style="margin-top:16px; padding:0; overflow:hidden">
		<div style="display:flex;gap:8px;overflow:auto;padding:8px">
			<?php
			$pics = [
				'dis-1.jpeg',
					'dis-3.jpeg',
					'dis-2.jpeg',
					'dis-4.jpeg'
			];
			foreach ($pics as $s) {
				echo '<img class="reveal" src="'.htmlspecialchars($s).'" alt="relief" style="height:110px;border-radius:10px;object-fit:cover">';
			}
			?>
		</div>
	</div>
	<!-- FAQ -->
	<div class="grid" style="margin-top:16px">
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Will my data be public? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">No, only responders see your contact details.</div>
		</div>
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Can I edit a request? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">Submit a new one with updated details. We’ll link them.</div>
		</div>
	</div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>


