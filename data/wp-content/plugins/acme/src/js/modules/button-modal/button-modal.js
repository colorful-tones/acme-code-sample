(function () {
	'use strict';

	/**
	 * Traps focus within a modal element.
	 *
	 * @param {HTMLElement} element - The modal element to trap focus within.
	 * @return {Function} Function to remove the event listener and release the trap.
	 */
	function trapFocus(element) {
		const focusableEls = element.querySelectorAll(
			'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([disabled]):not([tabindex="-1"])'
		);
		const firstFocusableEl = focusableEls[0];
		const lastFocusableEl = focusableEls[focusableEls.length - 1];

		function handleKeyDown(e) {
			const isTabPressed = e.key === 'Tab';

			if (!isTabPressed) {
				return;
			}

			if (e.shiftKey) {
				// Shift + Tab
				// eslint-disable-next-line @wordpress/no-global-active-element
				if (document.activeElement === firstFocusableEl) {
					lastFocusableEl.focus();
					e.preventDefault();
				}
			} else {
				// Tab
				// eslint-disable-next-line no-lonely-if, @wordpress/no-global-active-element
				if (document.activeElement === lastFocusableEl) {
					firstFocusableEl.focus();
					e.preventDefault();
				}
			}
		}

		element.addEventListener('keydown', handleKeyDown);

		if (firstFocusableEl) {
			firstFocusableEl.focus();
		}

		return () => {
			element.removeEventListener('keydown', handleKeyDown);
		};
	}

	/**
	 * Prevents background scrolling when modal is open.
	 */
	function preventBackgroundScroll() {
		const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
		document.body.style.overflow = 'hidden';
		document.body.style.paddingRight = `${scrollbarWidth}px`;
	}

	/**
	 * Restores background scrolling when modal is closed.
	 */
	function restoreBackgroundScroll() {
		document.body.style.overflow = '';
		document.body.style.paddingRight = '';
	}

	// Handle opening modals
	document.addEventListener('click', event => {
		const button = event.target.closest('a[href^="#modal-"], button[data-open-modal]');
		if (!button) {
			return;
		}

		event.preventDefault();
		const modalId = button.getAttribute('href')
			? button.getAttribute('href').substring(1)
			: button.getAttribute('data-open-modal');
		const modal = document.getElementById(modalId);
		if (modal) {
			modal._acmeTrigger = button;
			modal.showModal();
			document.body.classList.add('acme-js-modal--active');
			preventBackgroundScroll();
			modal._acmeReleaseTrap = trapFocus(modal);
		}
	});

	// Handle closing modals via close button
	document.addEventListener('click', event => {
		const closeButton = event.target.closest('.acme-modal__close, [data-close-modal]');
		if (!closeButton) {
			return;
		}

		const modal = closeButton.closest('.acme-modal');
		if (modal) {
			modal.close();
		}
	});

	// Handle clicking backdrop to close modal
	document.addEventListener('click', event => {
		if (event.target.tagName === 'DIALOG' && event.target.classList.contains('acme-modal')) {
			const rect = event.target.getBoundingClientRect();
			const isInDialog =
				rect.top <= event.clientY &&
				event.clientY <= rect.top + rect.height &&
				rect.left <= event.clientX &&
				event.clientX <= rect.left + rect.width;
			if (!isInDialog) {
				event.target.close();
			}
		}
	});

	// Single close handler for all close paths (button, backdrop, ESC).
	// Centralising here ensures the trap is always released and focus always returns.
	document.addEventListener(
		'close',
		event => {
			if (event.target.classList && event.target.classList.contains('acme-modal')) {
				event.target._acmeReleaseTrap?.();
				document.body.classList.remove('acme-js-modal--active');
				restoreBackgroundScroll();
				event.target._acmeTrigger?.focus();
				delete event.target._acmeTrigger;
				delete event.target._acmeReleaseTrap;
			}
		},
		true
	);
})();
