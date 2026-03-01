document.addEventListener('DOMContentLoaded', () => {
	// Auto-dismiss alerts with data-autoclose
	document.querySelectorAll('.alert[data-autoclose="1"]').forEach((el) => {
		setTimeout(() => {
			el.remove();
		}, 5500);
	});
	// Reveal on scroll
	const observer = new IntersectionObserver((entries) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				entry.target.classList.add('visible');
				observer.unobserve(entry.target);
			}
		});
	}, { threshold: 0.15 });
	document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
	// Counter up numbers
	document.querySelectorAll('[data-countto]').forEach((el) => {
		const end = parseInt(el.getAttribute('data-countto') || '0', 10);
		let start = 0;
		const duration = 1200;
		const startTime = performance.now();
		function tick(now) {
			const progress = Math.min((now - startTime) / duration, 1);
			const value = Math.floor(start + (end - start) * progress);
			el.textContent = value.toString();
			if (progress < 1) requestAnimationFrame(tick);
		}
		requestAnimationFrame(tick);
	});
	// FAQ toggle
	document.querySelectorAll('.faq-item .faq-q').forEach((btn) => {
		btn.addEventListener('click', () => {
			btn.closest('.faq-item')?.classList.toggle('open');
		});
	});
});


