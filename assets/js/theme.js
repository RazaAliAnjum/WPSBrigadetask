/**
 * WPBrigade Challenge - Theme JavaScript
 *
 * Implements:
 * 1. Hero Slider
 * 2. Video Popup Modal
 * 3. Sports Carousel
 * 4. Events AJAX Pagination
 * 5. Category Submenu Accordion
 * 6. Match Tabs Switching
 * 7. FAQ Accordions
 * 8. Live Digital Clock
 * 9. Newsletter AJAX Submission
 * 10. Mobile Drawer & Submenus
 * 11. Top Bar Dismissal
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initTopNotification();
		initHeroSlider();
		initVideoModal();
		initSportsCarousel();
		initEventsAjax();
		initCategoryAccordion();
		initTabs();
		initAccordions();
		initLiveClock();
		initNewsletterAjax();
		initMobileMenu();
	});

	/* ==============================================================
	   1. TOP NOTIFICATION BAR DISMISSAL
	   ============================================================== */
	function initTopNotification() {
		var notifBar = document.getElementById('wpbc-top-notification');
		var closeBtn = document.getElementById('wpbc-notif-close');

		if (!notifBar || !closeBtn) return;

		if (sessionStorage.getItem('wpbc_notif_dismissed') === '1') {
			notifBar.style.display = 'none';
		}

		closeBtn.addEventListener('click', function () {
			notifBar.style.display = 'none';
			sessionStorage.setItem('wpbc_notif_dismissed', '1');
		});
	}

	/* ==============================================================
	   2. HERO SLIDER
	   ============================================================== */
	function initHeroSlider() {
		var slider = document.getElementById('wpbc-hero-slider');
		if (!slider) return;

		var slides = slider.querySelectorAll('.hero-slide');
		var dots = slider.querySelectorAll('#wpbc-hero-dots .dot');
		var prevBtn = document.getElementById('wpbc-hero-prev');
		var nextBtn = document.getElementById('wpbc-hero-next');

		if (slides.length <= 1) return;

		var currentIndex = 0;
		var timer = null;
		var intervalTime = 6000;

		function goToSlide(index) {
			if (index < 0) {
				index = slides.length - 1;
			} else if (index >= slides.length) {
				index = 0;
			}

			slides.forEach(function (slide) {
				slide.classList.remove('is-active');
			});
			dots.forEach(function (dot) {
				dot.classList.remove('is-active');
			});

			slides[index].classList.add('is-active');
			if (dots[index]) {
				dots[index].classList.add('is-active');
			}

			currentIndex = index;
		}

		function startAutoPlay() {
			stopAutoPlay();
			timer = setInterval(function () {
				goToSlide(currentIndex + 1);
			}, intervalTime);
		}

		function stopAutoPlay() {
			if (timer) {
				clearInterval(timer);
				timer = null;
			}
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				goToSlide(currentIndex - 1);
				startAutoPlay();
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				goToSlide(currentIndex + 1);
				startAutoPlay();
			});
		}

		dots.forEach(function (dot) {
			dot.addEventListener('click', function () {
				var to = parseInt(this.getAttribute('data-slide-to'), 10);
				goToSlide(to);
				startAutoPlay();
			});
		});

		slider.addEventListener('mouseenter', stopAutoPlay);
		slider.addEventListener('mouseleave', startAutoPlay);

		startAutoPlay();
	}

	/* ==============================================================
	   3. VIDEO POPUP MODAL (Matching Image 5)
	   ============================================================== */
	function initVideoModal() {
		var modal = document.getElementById('wpbc-video-modal');
		var closeBtn = document.getElementById('wpbc-video-close');
		var container = document.getElementById('wpbc-video-container');
		var playBtns = document.querySelectorAll('.slide-video-play-btn');

		if (!modal || !closeBtn || !container) return;

		function openModal(videoUrl) {
			if (!videoUrl) return;

			container.innerHTML = '<iframe src="' + videoUrl + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			modal.style.display = 'flex';
			modal.setAttribute('aria-hidden', 'false');
			document.body.style.overflow = 'hidden';
		}

		function closeModal() {
			modal.style.display = 'none';
			modal.setAttribute('aria-hidden', 'true');
			container.innerHTML = '';
			document.body.style.overflow = '';
		}

		playBtns.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var videoUrl = this.getAttribute('data-video-url');
				openModal(videoUrl);
			});
		});

		closeBtn.addEventListener('click', closeModal);

		modal.addEventListener('click', function (e) {
			if (e.target === modal) {
				closeModal();
			}
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && modal.style.display === 'flex') {
				closeModal();
			}
		});
	}

	/* ==============================================================
	   4. SPORTS CAROUSEL (10 Items)
	   ============================================================== */
	function initSportsCarousel() {
		var trackWrapper = document.getElementById('wpbc-sports-track');
		var prevBtn = document.getElementById('wpbc-sport-prev');
		var nextBtn = document.getElementById('wpbc-sport-next');

		if (!trackWrapper || !prevBtn || !nextBtn) return;

		var track = trackWrapper.querySelector('.sports-track');
		if (!track) return;

		var scrollAmount = 260;

		prevBtn.addEventListener('click', function () {
			trackWrapper.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
		});

		nextBtn.addEventListener('click', function () {
			trackWrapper.scrollBy({ left: scrollAmount, behavior: 'smooth' });
		});
	}

	/* ==============================================================
	   5. EVENTS AJAX PAGINATION (Image 4 Requirement)
	   ============================================================== */
	function initEventsAjax() {
		var prevBtn = document.getElementById('wpbc-events-prev');
		var nextBtn = document.getElementById('wpbc-events-next');
		var listContainer = document.getElementById('wpbc-events-list');

		if (!prevBtn || !nextBtn || !listContainer) return;

		var currentPage = 1;
		var maxPages = 3;

		function loadEvents(page) {
			if (typeof wpbcData === 'undefined') return;

			listContainer.style.opacity = '0.5';

			var formData = new FormData();
			formData.append('action', 'wpbc_load_events');
			formData.append('page', page);
			formData.append('nonce', wpbcData.nonce);

			fetch(wpbcData.ajaxUrl, {
				method: 'POST',
				body: formData
			})
			.then(function (response) {
				return response.json();
			})
			.then(function (res) {
				listContainer.style.opacity = '1';
				if (res.success && res.data.html) {
					listContainer.innerHTML = res.data.html;
					currentPage = page;
					maxPages = res.data.max_pages || 1;

					prevBtn.disabled = currentPage <= 1;
					nextBtn.disabled = currentPage >= maxPages;
				}
			})
			.catch(function () {
				listContainer.style.opacity = '1';
			});
		}

		prevBtn.addEventListener('click', function () {
			if (currentPage > 1) {
				loadEvents(currentPage - 1);
			}
		});

		nextBtn.addEventListener('click', function () {
			loadEvents(currentPage + 1);
		});
	}

	/* ==============================================================
	   6. CATEGORIES ACCORDION (Click to view subcategories)
	   ============================================================== */
	function initCategoryAccordion() {
		var catParents = document.querySelectorAll('.wpbc-cat-accordion .cat-item.has-children');

		catParents.forEach(function (item) {
			var chevronBtn = item.querySelector('.cat-chevron-btn');
			var catLink = item.querySelector('.cat-link');

			if (chevronBtn) {
				chevronBtn.addEventListener('click', function (e) {
					e.preventDefault();
					e.stopPropagation();
					item.classList.toggle('is-expanded');
					var expanded = item.classList.contains('is-expanded');
					chevronBtn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
				});
			}

			if (catLink && catLink.getAttribute('href') === '#') {
				catLink.addEventListener('click', function (e) {
					e.preventDefault();
					item.classList.toggle('is-expanded');
					if (chevronBtn) {
						var isExp = item.classList.contains('is-expanded');
						chevronBtn.setAttribute('aria-expanded', isExp ? 'true' : 'false');
					}
				});
			}
		});
	}

	/* ==============================================================
	   7. MATCH TABS
	   ============================================================== */
	function initTabs() {
		var tabBtns = document.querySelectorAll('.tabs-nav-bar .tab-btn');
		var tabPanes = document.querySelectorAll('.tabs-content-panels .tab-pane');

		if (!tabBtns.length || !tabPanes.length) return;

		tabBtns.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var targetId = this.getAttribute('data-tab-target');

				tabBtns.forEach(function (b) {
					b.classList.remove('is-active');
					b.setAttribute('aria-selected', 'false');
				});

				tabPanes.forEach(function (p) {
					p.classList.remove('is-active');
					p.style.display = 'none';
				});

				this.classList.add('is-active');
				this.setAttribute('aria-selected', 'true');

				var activePane = document.querySelector(targetId);
				if (activePane) {
					activePane.classList.add('is-active');
					activePane.style.display = 'block';
				}
			});
		});
	}

	/* ==============================================================
	   8. ACCORDIONS
	   ============================================================== */
	function initAccordions() {
		var headers = document.querySelectorAll('.accordion-header');

		headers.forEach(function (header) {
			header.addEventListener('click', function () {
				var item = this.closest('.accordion-item');
				var content = item.querySelector('.accordion-content');
				var isOpen = item.classList.contains('is-open');

				if (isOpen) {
					item.classList.remove('is-open');
					this.setAttribute('aria-expanded', 'false');
					content.style.display = 'none';
				} else {
					item.classList.add('is-open');
					this.setAttribute('aria-expanded', 'true');
					content.style.display = 'block';
				}
			});
		});
	}

	/* ==============================================================
	   9. LIVE DIGITAL CLOCK
	   ============================================================== */
	function initLiveClock() {
		var clockEl = document.getElementById('wpbc-live-clock');
		if (!clockEl) return;

		function updateTime() {
			var now = new Date();
			var hours = String(now.getHours()).padStart(2, '0');
			var minutes = String(now.getMinutes()).padStart(2, '0');
			var seconds = String(now.getSeconds()).padStart(2, '0');
			clockEl.textContent = hours + ':' + minutes + ':' + seconds;
		}

		updateTime();
		setInterval(updateTime, 1000);
	}

	/* ==============================================================
	   10. NEWSLETTER AJAX SUBMISSION
	   ============================================================== */
	function initNewsletterAjax() {
		var forms = document.querySelectorAll('.wpbc-newsletter-form');

		forms.forEach(function (form) {
			form.addEventListener('submit', function (e) {
				e.preventDefault();

				var input = form.querySelector('input[type="email"]');
				var respDiv = form.querySelector('.newsletter-response');
				if (!input || !respDiv || typeof wpbcData === 'undefined') return;

				var email = input.value.trim();
				if (!email) return;

				var formData = new FormData();
				formData.append('action', 'wpbc_newsletter_subscribe');
				formData.append('email', email);
				formData.append('nonce', wpbcData.nonce);

				fetch(wpbcData.ajaxUrl, {
					method: 'POST',
					body: formData
				})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					respDiv.style.display = 'block';
					if (res.success) {
						respDiv.style.color = '#70e000';
						respDiv.textContent = res.data.message;
						input.value = '';
					} else {
						respDiv.style.color = '#ff6b6b';
						respDiv.textContent = res.data.message || 'Error occurred';
					}
				})
				.catch(function () {
					respDiv.style.display = 'block';
					respDiv.style.color = '#ff6b6b';
					respDiv.textContent = 'Server communication error.';
				});
			});
		});
	}

	/* ==============================================================
	   11. MOBILE NAVIGATION PANEL (Matching Image 7)
	   ============================================================== */
	function initMobileMenu() {
		var toggleBtn = document.getElementById('wpbc-mobile-menu-toggle');
		var navPanel = document.getElementById('wpbc-mobile-nav-panel');
		var splitBar = document.querySelector('.mobile-secondary-split-bar');

		if (!toggleBtn || !navPanel) return;

		function updatePanelPosition() {
			if (splitBar && splitBar.offsetParent !== null) {
				var rect = splitBar.getBoundingClientRect();
				var topPos = Math.round(rect.bottom);
				navPanel.style.top = topPos + 'px';
				navPanel.style.height = (window.innerHeight - topPos) + 'px';
			} else {
				var header = document.getElementById('masthead');
				if (header) {
					var hRect = header.getBoundingClientRect();
					var hTop = Math.round(hRect.bottom);
					navPanel.style.top = hTop + 'px';
					navPanel.style.height = (window.innerHeight - hTop) + 'px';
				}
			}
		}

		toggleBtn.addEventListener('click', function () {
			var isOpen = navPanel.classList.contains('is-open');
			if (isOpen) {
				navPanel.classList.remove('is-open');
				navPanel.style.display = 'none';
				toggleBtn.setAttribute('aria-expanded', 'false');
				document.body.style.overflow = '';
			} else {
				updatePanelPosition();
				navPanel.classList.add('is-open');
				navPanel.style.display = 'block';
				toggleBtn.setAttribute('aria-expanded', 'true');
				document.body.style.overflow = 'hidden';
			}
		});

		window.addEventListener('resize', function () {
			if (window.innerWidth > 768) {
				navPanel.classList.remove('is-open');
				navPanel.style.display = 'none';
				toggleBtn.setAttribute('aria-expanded', 'false');
				document.body.style.overflow = '';
			} else if (navPanel.classList.contains('is-open')) {
				updatePanelPosition();
			}
		});

		// Submenu accordion toggle in mobile nav panel
		var menuItemsWithChildren = navPanel.querySelectorAll('.menu-item-has-children > a, .menu-item-has-children > .mobile-submenu-toggle');
		menuItemsWithChildren.forEach(function (el) {
			el.addEventListener('click', function (e) {
				var parentLi = this.closest('.menu-item-has-children');
				var subMenu = parentLi.querySelector('.sub-menu');
				if (subMenu) {
					e.preventDefault();
					parentLi.classList.toggle('is-expanded');
				}
			});
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && navPanel.classList.contains('is-open')) {
				navPanel.classList.remove('is-open');
				navPanel.style.display = 'none';
				toggleBtn.setAttribute('aria-expanded', 'false');
				document.body.style.overflow = '';
			}
		});
	}

})();

