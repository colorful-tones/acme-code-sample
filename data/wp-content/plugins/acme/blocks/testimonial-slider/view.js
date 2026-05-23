document.addEventListener('DOMContentLoaded', () => {
	const sliders = document.querySelectorAll('.wp-block-acme-testimonial-slider');

	if (sliders.length === 0) {
		return;
	}

	sliders.forEach(slider => {
		const slides = slider.querySelectorAll('.testimonial-slide');
		const count = slides.length;

		if (count === 0) {
			return;
		}

		const track = slider.querySelector('.testimonial-track');
		const prevBtn = slider.querySelector('.testimonial-nav-prev');
		const nextBtn = slider.querySelector('.testimonial-nav-next');
		const dots = slider.querySelectorAll('.testimonial-dot');

		const autoPlay = slider.dataset.autoplay === 'true';
		const interval = (parseInt(slider.dataset.interval, 10) || 4) * 1000;

		let current = 0;
		let timer = null;
		let isPaused = false;

		function goTo(index, announce = false) {
			if (index < 0) {
				index = count - 1;
			} else if (index >= count) {
				index = 0;
			}

			current = index;
			track.setAttribute('aria-live', announce ? 'polite' : 'off');
			track.style.transform = 'translateX(-' + current * 100 + '%)';

			slides.forEach((slide, i) => {
				const hidden = i !== current;
				slide.setAttribute('aria-hidden', hidden ? 'true' : 'false');
				if (hidden) {
					slide.setAttribute('inert', '');
				} else {
					slide.removeAttribute('inert');
				}
			});

			dots.forEach((dot, i) => {
				dot.classList.toggle('is-active', i === current);
				dot.setAttribute('aria-selected', i === current ? 'true' : 'false');
			});
		}

		function next(announce = false) {
			goTo(current + 1, announce);
		}

		function prev(announce = false) {
			goTo(current - 1, announce);
		}

		function startAutoPlay() {
			if (autoPlay && !isPaused) {
				stopAutoPlay();
				timer = setInterval(next, interval);
			}
		}

		function stopAutoPlay() {
			if (timer) {
				clearInterval(timer);
				timer = null;
			}
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', () => {
				prev(true);
				stopAutoPlay();
				startAutoPlay();
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', () => {
				next(true);
				stopAutoPlay();
				startAutoPlay();
			});
		}

		dots.forEach(dot => {
			dot.addEventListener('click', () => {
				const index = parseInt(dot.dataset.index, 10);
				goTo(index, true);
				stopAutoPlay();
				startAutoPlay();
			});
		});

		slider.addEventListener('mouseenter', () => {
			isPaused = true;
			stopAutoPlay();
		});

		slider.addEventListener('mouseleave', () => {
			isPaused = false;
			startAutoPlay();
		});

		slider.addEventListener('focusin', () => {
			isPaused = true;
			stopAutoPlay();
		});

		slider.addEventListener('focusout', e => {
			if (!slider.contains(e.relatedTarget)) {
				isPaused = false;
				startAutoPlay();
			}
		});

		slider.addEventListener('keydown', e => {
			if (e.key === 'ArrowLeft') {
				e.preventDefault();
				prev(true);
				stopAutoPlay();
				startAutoPlay();
			} else if (e.key === 'ArrowRight') {
				e.preventDefault();
				next(true);
				stopAutoPlay();
				startAutoPlay();
			}
		});

		let touchStartX = 0;
		let touchEndX = 0;

		slider.addEventListener(
			'touchstart',
			e => {
				touchStartX = e.changedTouches[0].screenX;
			},
			{ passive: true }
		);

		slider.addEventListener(
			'touchend',
			e => {
				touchEndX = e.changedTouches[0].screenX;
				const diff = touchStartX - touchEndX;
				if (Math.abs(diff) > 50) {
					if (diff > 0) {
						next(true);
					} else {
						prev(true);
					}
					stopAutoPlay();
					startAutoPlay();
				}
			},
			{ passive: true }
		);

		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

		function handleReducedMotion() {
			if (prefersReducedMotion.matches) {
				track.classList.add('no-transition');
				stopAutoPlay();
			} else {
				track.classList.remove('no-transition');
				startAutoPlay();
			}
		}

		handleReducedMotion();

		if (prefersReducedMotion.addEventListener) {
			prefersReducedMotion.addEventListener('change', handleReducedMotion);
		}

		goTo(0);
		if (!prefersReducedMotion.matches) {
			startAutoPlay();
		}
	});
});
