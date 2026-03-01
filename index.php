<?php
$pageTitle = 'Disaster Relief Assistance Portal';
$activePage = 'home';
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php
require_once __DIR__ . '/includes/db.php';
$counts = ['requests'=>0,'donations'=>0,'volunteers'=>0];
if ($mysqli) {
	$q1 = $mysqli->query('SELECT COUNT(*) c FROM requests'); $counts['requests'] = $q1 ? (int)$q1->fetch_assoc()['c'] : 0; if ($q1) $q1->free();
	$q2 = $mysqli->query('SELECT COUNT(*) c FROM donations'); $counts['donations'] = $q2 ? (int)$q2->fetch_assoc()['c'] : 0; if ($q2) $q2->free();
	$q3 = $mysqli->query('SELECT COUNT(*) c FROM volunteers'); $counts['volunteers'] = $q3 ? (int)$q3->fetch_assoc()['c'] : 0; if ($q3) $q3->free();
}
?>

<section class="container">
	<div class="hero">
		<div class="content">
			<div class="badge reveal"><i class="fa-solid fa-sparkles"></i> Fast & Coordinated Response</div>
			<h1 class="reveal" style="transition-delay:.1s">Get Help Fast in Disasters</h1>
			<p class="reveal" style="transition-delay:.2s">Connect with volunteers and organizations for urgent rescue, food, medical aid, and shelter.</p>
			<div class="btn-row">
				<a class="btn btn-primary pulse" href="request_help.php"><i class="fa-solid fa-hand-holding-heart"></i> Request Help</a>
				<a class="btn btn-secondary float" href="volunteer.php"><i class="fa-solid fa-people-carry-box"></i> Offer Help</a>
			</div>
		</div>
	</div>
</section>

<section class="container" style="margin-top:22px">
	<div class="grid">
		<div class="card reveal" style="grid-column: span 4;">
			<h3><i class="fa-solid fa-location-crosshairs"></i> Share Location & Needs</h3>
			<p class="muted">Submit a quick request with your location and the type of help you need.</p>
		</div>
		<div class="card reveal" style="grid-column: span 4;">
			<h3><i class="fa-solid fa-users"></i> Matched Support</h3>
			<p class="muted">Volunteers and relief groups see your request and respond faster.</p>
		</div>
		<div class="card reveal" style="grid-column: span 4;">
			<h3><i class="fa-solid fa-bolt"></i> Rapid Response</h3>
			<p class="muted">We prioritize clear communication to speed up relief efforts.</p>
		</div>
	</div>
</section>

<section class="container" style="margin-top:22px">
	<div class="grid">
		<div class="card reveal" style="grid-column: span 4; text-align:center">
			<h3><i class="fa-solid fa-siren"></i> Total Requests</h3>
			<p class="num" data-countto="<?= (int)$counts['requests'] ?>" style="font-size:28px;font-weight:700;color:var(--blue-700)"><?= (int)$counts['requests'] ?></p>
		</div>
		<div class="card reveal" style="grid-column: span 4; text-align:center">
			<h3><i class="fa-solid fa-hand-holding-dollar"></i> Total Donations</h3>
			<p class="num" data-countto="<?= (int)$counts['donations'] ?>" style="font-size:28px;font-weight:700;color:var(--blue-700)"><?= (int)$counts['donations'] ?></p>
		</div>
		<div class="card reveal" style="grid-column: span 4; text-align:center">
			<h3><i class="fa-solid fa-people-line"></i> Active Volunteers</h3>
			<p class="num" data-countto="<?= (int)$counts['volunteers'] ?>" style="font-size:28px;font-weight:700;color:var(--blue-700)"><?= (int)$counts['volunteers'] ?></p>
		</div>
	</div>
</section>

<!-- Scrolling news marquee -->
<section class="container" style="margin-top:22px">
	<div class="marquee reveal">
		<div class="marquee-track">
			<span><i class="fa-solid fa-newspaper"></i> Flood warnings issued in coastal region</span>
			<span><i class="fa-solid fa-newspaper"></i> Relief camps open at City Stadium</span>
			<span><i class="fa-solid fa-newspaper"></i> Volunteers needed for food distribution</span>
			<span><i class="fa-solid fa-newspaper"></i> Medical supplies dispatched to Zone 3</span>
			<span><i class="fa-solid fa-newspaper"></i> Emergency helpline active 24x7</span>
			<!-- duplicate for seamless loop -->
			<span><i class="fa-solid fa-newspaper"></i> Flood warnings issued in coastal region</span>
			<span><i class="fa-solid fa-newspaper"></i> Relief camps open at City Stadium</span>
			<span><i class="fa-solid fa-newspaper"></i> Volunteers needed for food distribution</span>
			<span><i class="fa-solid fa-newspaper"></i> Medical supplies dispatched to Zone 3</span>
			<span><i class="fa-solid fa-newspaper"></i> Emergency helpline active 24x7</span>
		</div>
	</div>
</section>

<!-- Image gallery -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-images"></i> Recent Relief Efforts</h2>
	<div class="gallery">
		<?php
		$imgs = [
			'https://images.unsplash.com/photo-1506812574058-fc75fa93fead?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1530041539828-114de6693900?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1559070209-9f5c6ac91b92?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1543248939-ff40856f65d4?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1520975916090-3105956dac38?q=80&w=800&auto=format&fit=crop',
			'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=800&auto=format&fit=crop'
		];
		foreach ($imgs as $src) {
			echo '<div class="img reveal"><img src="' . htmlspecialchars($src) . '" alt="Relief image"></div>';
		}
		?>
	</div>
</section>

<!-- How it works timeline -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-route"></i> How It Works</h2>
	<div class="timeline">
		<div class="step reveal"><strong>1. Submit Request</strong><br><span class="muted">Fill details and location</span></div>
		<div class="step reveal"><strong>2. Verify & Prioritize</strong><br><span class="muted">We prioritize emergencies</span></div>
		<div class="step reveal"><strong>3. Dispatch Volunteers</strong><br><span class="muted">Nearest team notified</span></div>
		<div class="step reveal"><strong>4. Follow-up</strong><br><span class="muted">We ensure needs are met</span></div>
	</div>
</section>

<!-- News/Blogs -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-newspaper"></i> Updates & Blogs</h2>
	<div class="grid">
		<?php
		$posts = [
			['title'=>'Coastal Flood Relief: Day 3','img'=>'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=800&auto=format&fit=crop','excerpt'=>'Teams reached 120+ families with food and medicine.','link'=>'#'],
			['title'=>'How to Prepare a Go-Bag','img'=>'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800&auto=format&fit=crop','excerpt'=>'Checklist for essentials during emergencies.','link'=>'#'],
			['title'=>'Volunteer Spotlight: Asha','img'=>'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=800&auto=format&fit=crop','excerpt'=>'Leading logistics across three districts.','link'=>'#'],
		];
		foreach ($posts as $p) {
			echo '<div class="card reveal" style="grid-column: span 4;">';
			echo '<img src="'.htmlspecialchars($p['img']).'" alt="Post" style="width:100%;height:160px;object-fit:cover;border-radius:8px">';
			echo '<h3 style="margin-top:10px">'.htmlspecialchars($p['title']).'</h3>';
			echo '<p class="muted">'.htmlspecialchars($p['excerpt']).'</p>';
			echo '<a class="btn" style="padding:8px 12px;background:var(--blue-50);color:var(--blue-700)" href="'.htmlspecialchars($p['link']).'"><i class="fa-solid fa-book-open"></i> Read</a>';
			echo '</div>';
		}
		?>
	</div>
</section>

<!-- Testimonials -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-quote-left"></i> Voices from the Ground</h2>
	<div class="grid">
		<div class="card testimonial reveal" style="grid-column: span 6;">
			<p>"Within hours of submitting our request, volunteers reached our building with water and medicines."</p>
			<p class="muted">— Meera, Coastal Block</p>
		</div>
		<div class="card testimonial reveal" style="grid-column: span 6;">
			<p>"Coordinated and compassionate. The platform streamlined our team’s efforts during the flood."</p>
			<p class="muted">— Raj, Volunteer Lead</p>
		</div>
	</div>
</section>

<!-- FAQ -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-circle-question"></i> FAQs</h2>
	<div class="grid">
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Is my phone number shared publicly? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">No. It is only shared with verified responders for coordination.</div>
		</div>
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">How fast will I get help? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">It depends on severity and proximity of volunteers. We prioritize emergencies.</div>
		</div>
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Can I donate supplies instead of money? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">Yes. Choose Food, Clothes, or Medicines on the Donate page.</div>
		</div>
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">How can I join as a volunteer? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">Fill out the form on the Volunteer page. We’ll contact you.</div>
		</div>
	</div>
</section>

<!-- Partners -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-handshake"></i> Partners</h2>
	<div class="partners">
		<?php
		$logos = [
			'https://dummyimage.com/180x60/ffffff/555&text=Relief+Org',
			'https://dummyimage.com/180x60/ffffff/555&text=Food+Bank',
			'https://dummyimage.com/180x60/ffffff/555&text=Med+Aid',
			'https://dummyimage.com/180x60/ffffff/555&text=Rescue+Team',
			'https://dummyimage.com/180x60/ffffff/555&text=Shelter+Net',
			'https://dummyimage.com/180x60/ffffff/555&text=City+Admin',
		];
		foreach ($logos as $logo) {
			echo '<div class="logo reveal"><img src="'.htmlspecialchars($logo).'" alt="partner logo"></div>';
		}
		?>
	</div>
</section>

<!-- Big CTA -->
<section class="container" style="margin-top:22px">
	<div class="cta reveal">
		<div class="text">
			<h2>Every minute matters during disasters</h2>
			<p>Raise a request or pledge your support today. Together, we can save lives.</p>
		</div>
		<div class="actions">
			<a class="btn btn-primary" href="request_help.php"><i class="fa-solid fa-bell"></i> Get Help</a>
			<a class="btn btn-secondary" href="donate.php"><i class="fa-solid fa-gift"></i> Donate</a>
		</div>
	</div>
</section>

<!-- Recent Requests (preview) -->
<?php
$recentRequests = [];
if ($mysqli) {
	$res = $mysqli->query("SELECT name, location, help_type, created_at FROM requests ORDER BY created_at DESC LIMIT 5");
	if ($res) {
		while ($row = $res->fetch_assoc()) { $recentRequests[] = $row; }
		$res->free();
	}
}
?>
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-clock-rotate-left"></i> Recent Help Requests</h2>
	<div class="grid">
		<?php if ($recentRequests): ?>
			<?php foreach ($recentRequests as $r): ?>
				<div class="card reveal" style="grid-column: span 4;">
					<h3><i class="fa-solid fa-person-circle-exclamation"></i> <?= htmlspecialchars($r['help_type']) ?></h3>
					<p class="muted"><?= htmlspecialchars($r['name']) ?> · <?= htmlspecialchars($r['location']) ?></p>
					<p class="muted"><i class="fa-regular fa-clock"></i> <?= htmlspecialchars($r['created_at']) ?></p>
					<a class="btn" href="request_help.php" style="padding:8px 12px;background:var(--blue-50);color:var(--blue-700)">Assist</a>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="card reveal" style="grid-column: span 12;">
				<p class="muted">No requests yet. Be the first to raise a request if you need help.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- Emergency Tips -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-lightbulb"></i> Emergency Tips</h2>
	<div class="grid">
		<div class="card reveal" style="grid-column: span 3;">
			<h3><i class="fa-solid fa-kit-medical"></i> First Aid</h3>
			<p class="muted">Keep a kit with bandages, antiseptic, pain relievers, and clean water.</p>
		</div>
		<div class="card reveal" style="grid-column: span 3;">
			<h3><i class="fa-solid fa-screwdriver-wrench"></i> Utilities</h3>
			<p class="muted">Know how to turn off gas, water, and electricity if needed.</p>
		</div>
		<div class="card reveal" style="grid-column: span 3;">
			<h3><i class="fa-solid fa-map-location-dot"></i> Evacuation</h3>
			<p class="muted">Plan safe routes and meeting points for your family.</p>
		</div>
		<div class="card reveal" style="grid-column: span 3;">
			<h3><i class="fa-solid fa-mobile-screen-button"></i> Communication</h3>
			<p class="muted">Keep phones charged and share your location with responders.</p>
		</div>
	</div>
</section>

<!-- Donation Tiers -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-seedling"></i> Donation Tiers</h2>
	<div class="grid">
		<div class="card reveal" style="grid-column: span 4;">
			<h3>Supporter</h3>
			<p class="muted">Fund a day's ration for a family.</p>
			<a class="btn" href="donate.php" style="padding:8px 12px;background:var(--blue-50);color:var(--blue-700)"><i class="fa-solid fa-heart"></i> Donate</a>
		</div>
		<div class="card reveal" style="grid-column: span 4;">
			<h3>Sustainer</h3>
			<p class="muted">Sponsor a relief kit with essentials.</p>
			<a class="btn" href="donate.php" style="padding:8px 12px;background:var(--blue-50);color:var(--blue-700)"><i class="fa-solid fa-box-open"></i> Donate</a>
		</div>
		<div class="card reveal" style="grid-column: span 4;">
			<h3>Champion</h3>
			<p class="muted">Back a full rescue operation day.</p>
			<a class="btn" href="donate.php" style="padding:8px 12px;background:var(--blue-50);color:var(--blue-700)"><i class="fa-solid fa-life-ring"></i> Donate</a>
		</div>
	</div>
</section>

<!-- Map Placeholder -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-map"></i> Response Coverage</h2>
	<div class="card reveal" style="height:260px;background:url('https://images.unsplash.com/photo-1526779259212-939e64788e3c?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; display:flex; align-items:flex-end;">
		<p style="background:rgba(0,0,0,.55);color:#fff;padding:8px 12px;border-radius:6px;margin:12px">Live map integration coming soon</p>
	</div>
</section>

<!-- Team -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-people-group"></i> Coordination Team</h2>
	<div class="grid">
		<?php
		$team = [
			['name'=>'Aman Gupta','role'=>'Operations Lead','img'=>'https://dummyimage.com/200x200/ffffff/888&text=AG'],
			['name'=>'Sara Khan','role'=>'Medical Coordinator','img'=>'https://dummyimage.com/200x200/ffffff/888&text=SK'],
			['name'=>'Vikram Desai','role'=>'Logistics','img'=>'https://dummyimage.com/200x200/ffffff/888&text=VD'],
			['name'=>'Priya Nair','role'=>'Volunteer Liaison','img'=>'https://dummyimage.com/200x200/ffffff/888&text=PN'],
		];
		foreach ($team as $t) {
			echo '<div class="card reveal" style="grid-column: span 3; text-align:center">';
			echo '<img src="'.htmlspecialchars($t['img']).'" alt="team" style="width:100%;height:160px;object-fit:cover;border-radius:8px">';
			echo '<h3 style="margin:10px 0 0">'.htmlspecialchars($t['name']).'</h3>';
			echo '<p class="muted">'.htmlspecialchars($t['role']).'</p>';
			echo '</div>';
		}
		?>
	</div>
</section>

<!-- Media Embed -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-brands fa-youtube"></i> In the Media</h2>
	<div class="card reveal" style="overflow:hidden">
		<div style="position:relative;padding-top:56.25%">
			<iframe style="position:absolute;inset:0;border:0;width:100%;height:100%" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Relief Efforts" allowfullscreen></iframe>
		</div>
	</div>
</section>

<!-- Newsletter -->
<section class="container" style="margin-top:22px">
	<div class="card reveal" style="display:flex;gap:12px;align-items:center;justify-content:space-between;flex-wrap:wrap">
		<div>
			<h3><i class="fa-solid fa-envelope-open-text"></i> Subscribe for Updates</h3>
			<p class="muted">Get the latest relief news and volunteering opportunities.</p>
		</div>
		<form onsubmit="event.preventDefault(); alert('Subscribed!');" style="display:flex;gap:8px;align-items:center">
			<input type="email" placeholder="Your email" required style="padding:10px 12px;border:1px solid var(--slate-200);border-radius:8px">
			<button class="btn-submit" type="submit">Subscribe</button>
		</form>
	</div>
</section>

<!-- Extended FAQs -->
<section class="container" style="margin-top:22px">
	<h2 class="reveal"><i class="fa-solid fa-circle-question"></i> More FAQs</h2>
	<div class="grid">
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Do you verify donors? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">We maintain transparent records and vet partner organizations.</div>
		</div>
		<div class="faq-item reveal" style="grid-column: span 6;">
			<button class="faq-q">Can I update my request? <i class="fa-solid fa-chevron-down"></i></button>
			<div class="faq-a">For now, submit a new request referencing the previous one.</div>
		</div>
	</div>
</section>

<!-- Image strip -->
<section class="container" style="margin-top:22px">
	<div class="grid">
		<div class="card reveal" style="grid-column: span 12; padding:0; overflow:hidden">
			<div style="display:flex;gap:8px;overflow:auto;padding:8px">
				<?php
				$strip = [
					'dis-1.jpeg',
					'dis-3.jpeg',
					'dis-2.jpeg',
					'dis-4.jpeg',
					'https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?q=80&w=600&auto=format&fit=crop',
					'https://marvel-b1-cdn.bc0a.com/f00000000210829/www.lionsclubs.org/sites/default/files/styles/full_width_image_tablet/public/2018-07/lions-5.10-disaster-relief-wood-pile-tornado-clean-up.jpg?itok=Dw0EW5hQ'
				];
				foreach ($strip as $s) {
					echo '<img class="reveal" src="'.htmlspecialchars($s).'" alt="relief" style="height:120px;border-radius:10px;object-fit:cover">';
				}
				?>
			</div>
		</div>
	</div>
</section>



<?php include __DIR__ . '/includes/footer.php'; ?>


