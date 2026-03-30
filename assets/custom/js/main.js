/* Reset the form in the SEARCH page */
function resetForm(idForm, idReset) {
	var form = document.getElementById(idForm);
	var reset = document.getElementById(idReset);
	if (!form || !reset) {
		return;
	}
	reset.value = 'yes';
	form.submit();
}

/* Reload and order the books in the SECTION page */
document.addEventListener('DOMContentLoaded', function () {
	var dropdown = document.getElementById('kkw_order_selector');
	if (!dropdown) {
		return;
	}

	var dropdownItems = dropdown.querySelectorAll('.dropdown-item');
	dropdownItems.forEach(function (item) {
		item.addEventListener('click', function (event) {
			event.preventDefault();
			var sortOrder = this.getAttribute('data-sort-order');
			var sortItem = this.getAttribute('data-sort-field');
			var currentUrl = new URL(window.location.href);
			currentUrl.searchParams.set('sort_order', sortOrder);
			currentUrl.searchParams.set('sort_field', sortItem);
			window.location.href = currentUrl.toString();
		});
	});
});

/* Lightbox options */
if (typeof lightbox !== 'undefined' && typeof lightbox.option === 'function') {
	lightbox.option({
		'wrapAround': true,
		'showImageNumberLabel': true,
	});
}

function kkwGetMenuTabs() {
	if (Array.isArray(window.wpMenuTabs)) {
		return window.wpMenuTabs;
	}
	return [];
}

function kkwSetCurrentSidebarLink(links, activeLink) {
	links.forEach(function (link) {
		link.classList.remove('active');
		link.removeAttribute('aria-current');
	});

	if (!activeLink || activeLink.classList.contains('disabled')) {
		return;
	}

	activeLink.classList.add('active');
	activeLink.setAttribute('aria-current', 'location');
}

function kkwSyncBookTabsFromSidebar(anchor) {
	var menuTabs = kkwGetMenuTabs();
	if (!menuTabs.includes(anchor)) {
		return;
	}

	document.querySelectorAll('#nav-tab .nav-link.active').forEach(function (tab) {
		tab.classList.remove('active');
		tab.setAttribute('aria-selected', 'false');
	});

	document.querySelectorAll('#nav-tabContent .tab-pane').forEach(function (tabPane) {
		tabPane.classList.remove('active');
		tabPane.classList.remove('show');
	});

	var selector = '#nav-tab button[data-bs-target="' + anchor + '"]';
	var button = document.querySelector(selector);
	if (!button || typeof bootstrap === 'undefined' || !bootstrap.Tab) {
		return;
	}

	var tabInstance = new bootstrap.Tab(button);
	tabInstance.show();
}

function kkwInitSidebarMenus() {
	var menus = document.querySelectorAll('.kkw_lateral_menu');
	menus.forEach(function (menu) {
		var links = Array.from(menu.querySelectorAll('.nav-link[href^="#"]:not(.disabled)'));
		if (!links.length) {
			return;
		}

		var initialLink = links.find(function (link) {
			return link.classList.contains('active');
		}) || links[0];

		if (window.location.hash) {
			var hashLink = links.find(function (link) {
				return link.getAttribute('href') === window.location.hash;
			});
			if (hashLink) {
				initialLink = hashLink;
			}
		}

		kkwSetCurrentSidebarLink(links, initialLink);

		links.forEach(function (link) {
			link.addEventListener('click', function () {
				var anchor = this.getAttribute('href');
				kkwSetCurrentSidebarLink(links, this);
				kkwSyncBookTabsFromSidebar(anchor);
			});
		});

		var targets = links.map(function (link) {
			var anchor = link.getAttribute('href');
			if (!anchor || anchor.charAt(0) !== '#') {
				return null;
			}
			return document.getElementById(anchor.substring(1));
		}).filter(Boolean);

		if ('IntersectionObserver' in window && targets.length) {
			var entriesById = new Map();
			var observer = new IntersectionObserver(
				function (entries) {
					entries.forEach(function (entry) {
						entriesById.set(entry.target.id, entry);
					});

					var visibleEntries = Array.from(entriesById.values()).filter(function (entry) {
						return entry.isIntersecting;
					});
					if (!visibleEntries.length) {
						return;
					}

					visibleEntries.sort(function (a, b) {
						return Math.abs(a.boundingClientRect.top) - Math.abs(b.boundingClientRect.top);
					});

					var currentId = visibleEntries[0].target.id;
					var currentLink = links.find(function (link) {
						return link.getAttribute('href') === '#' + currentId;
					});
					if (currentLink) {
						kkwSetCurrentSidebarLink(links, currentLink);
					}
				},
				{
					root: null,
					rootMargin: '-10% 0px -55% 0px',
					threshold: [0.1, 0.35, 0.6],
				}
			);

			targets.forEach(function (target) {
				observer.observe(target);
			});
		}

		window.addEventListener('hashchange', function () {
			var hashLink = links.find(function (link) {
				return link.getAttribute('href') === window.location.hash;
			});
			if (hashLink) {
				kkwSetCurrentSidebarLink(links, hashLink);
			}
		});
	});
}

function kkwInitBookTabsSync() {
	var menuTabs = kkwGetMenuTabs();
	var bookTabs = document.querySelectorAll('#kkw_book_tabs .nav-link');
	if (!bookTabs.length) {
		return;
	}

	bookTabs.forEach(function (tab) {
		tab.addEventListener('click', function () {
			var anchor = this.getAttribute('data-bs-target');
			if (!menuTabs.includes(anchor)) {
				return;
			}

			var menuItems = Array.from(document.querySelectorAll('#kkw_lateral_menu .nav-link[href^="#"]:not(.disabled)'));
			var activeItem = document.querySelector('#kkw_lateral_menu .nav-link[href="' + anchor + '"]');
			kkwSetCurrentSidebarLink(menuItems, activeItem);
		});
	});
}

kkwInitSidebarMenus();
kkwInitBookTabsSync();

// Toggle of the icon of the book.
document.addEventListener('DOMContentLoaded', function () {
	var frontCover = document.getElementById('front_cover');
	var backCover = document.getElementById('back_cover');
	var currentCover = document.getElementById('current_cover');
	var currentCoverLink = document.getElementById('current_cover_link');

	if (frontCover && currentCover && currentCoverLink) {
		frontCover.addEventListener('click', function (event) {
			event.preventDefault();
			var newSrc = this.getAttribute('data-img-src');
			currentCover.src = newSrc;
			currentCoverLink.href = newSrc;
		});
	}

	if (backCover && currentCover && currentCoverLink) {
		backCover.addEventListener('click', function (event) {
			event.preventDefault();
			var newSrc = this.getAttribute('data-img-src');
			currentCover.src = newSrc;
			currentCoverLink.href = newSrc;
		});
	}
});
