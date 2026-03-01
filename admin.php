<?php
$pageTitle = 'Admin - Disaster Relief';
$activePage = '';
require __DIR__ . '/includes/db.php';

function fetch_all($mysqli, $sql) {
	$result = $mysqli->query($sql);
	if (!$result) { return []; }
	$rows = [];
	while ($row = $result->fetch_assoc()) { $rows[] = $row; }
	$result->free();
	return $rows;
}

$requests = fetch_all($mysqli, 'SELECT id, name, location, help_type, contact, created_at FROM requests ORDER BY created_at DESC LIMIT 200');
$donations = fetch_all($mysqli, 'SELECT id, name, email, type, created_at FROM donations ORDER BY created_at DESC LIMIT 200');
$volunteers = fetch_all($mysqli, 'SELECT id, name, email, phone, skills, availability, created_at FROM volunteers ORDER BY created_at DESC LIMIT 200');
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<section class="container">
	<div class="card" style="overflow:auto">
		<h2><i class="fa-solid fa-table-list"></i> Help Requests</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th><th>Name</th><th>Location</th><th>Type</th><th>Contact</th><th>Created</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($requests as $r): ?>
					<tr>
						<td><?= (int)$r['id'] ?></td>
						<td><?= htmlspecialchars($r['name']) ?></td>
						<td><?= htmlspecialchars($r['location']) ?></td>
						<td><?= htmlspecialchars($r['help_type']) ?></td>
						<td><?= htmlspecialchars($r['contact']) ?></td>
						<td><?= htmlspecialchars($r['created_at']) ?></td>
					</tr>
				<?php endforeach; ?>
				<?php if (!$requests): ?>
					<tr><td colspan="6" class="muted">No requests yet.</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

	<div class="card" style="overflow:auto; margin-top:16px">
		<h2><i class="fa-solid fa-hand-holding-dollar"></i> Donations</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th><th>Name</th><th>Email</th><th>Type</th><th>Created</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($donations as $d): ?>
					<tr>
						<td><?= (int)$d['id'] ?></td>
						<td><?= htmlspecialchars($d['name']) ?></td>
						<td><?= htmlspecialchars($d['email']) ?></td>
						<td><?= htmlspecialchars($d['type']) ?></td>
						<td><?= htmlspecialchars($d['created_at']) ?></td>
					</tr>
				<?php endforeach; ?>
				<?php if (!$donations): ?>
					<tr><td colspan="5" class="muted">No donations yet.</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

	<div class="card" style="overflow:auto; margin-top:16px">
		<h2><i class="fa-solid fa-user-shield"></i> Volunteers</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Skills</th><th>Availability</th><th>Created</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($volunteers as $v): ?>
					<tr>
						<td><?= (int)$v['id'] ?></td>
						<td><?= htmlspecialchars($v['name']) ?></td>
						<td><?= htmlspecialchars($v['email']) ?></td>
						<td><?= htmlspecialchars($v['phone']) ?></td>
						<td><?= htmlspecialchars($v['skills']) ?></td>
						<td><?= htmlspecialchars($v['availability']) ?></td>
						<td><?= htmlspecialchars($v['created_at']) ?></td>
					</tr>
				<?php endforeach; ?>
				<?php if (!$volunteers): ?>
					<tr><td colspan="7" class="muted">No volunteers yet.</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>


