/* Reset the form in the SEARCH page */
function resetForm($idForm, $idReset) {
	var form = document.getElementById($idForm);
	var reset = document.getElementById($idReset);
	reset.value = "yes";
	form.submit();
}


/* Reload and order the books in the SECTION page */
document.addEventListener('DOMContentLoaded', function() {
	const dropdown = document.getElementById('kkw_order_selector');
	if (dropdown) {
		const dropdownItems = dropdown.querySelectorAll('.dropdown-item');
		dropdownItems.forEach(item => {
			item.addEventListener('click', function(event) {
				event.preventDefault();
				const sortOrder = this.getAttribute('data-sort-order');
				const sortItem = this.getAttribute('data-sort-field');
				const currentUrl = new URL(window.location.href);
				currentUrl.searchParams.set('sort_order', sortOrder);
				currentUrl.searchParams.set('sort_field', sortItem);
				window.location.href = currentUrl.toString();
			});
		});
	}
});

/* Lightbox options */
lightbox.option({
	// 'resizeDuration': 200,
	'wrapAround': true,
	'showImageNumberLabel': true,
});

/* Select active link in navbars */
let links = document.querySelectorAll('#kkw_lateral_menu .nav-link');
for(let i=0; i<links.length; i++){
links[i].addEventListener('click',
	function() {
		// console.log(wpMenuTabs);
		for(let j=0; j<links.length; j++) {
			links[j].classList.remove('active');
		}
		this.classList.add('active');
		// Code added to manage book tabs.
		// let wpMenuTabs = ["#nav-info", "#nav-reviews", "#nav-excerpts", "#nav-excerpts"];
		let anchor = this.getAttribute("href");
		if (wpMenuTabs.includes(anchor)) {
			document.querySelectorAll('#nav-tab .nav-link.active').forEach(tab => {
				tab.classList.remove('active');
				tab.setAttribute('aria-selected', 'false');
			});
			document.querySelectorAll('#nav-tabContent .tab-pane').forEach(tab => {
				tab.classList.remove('active');
				tab.classList.remove('show');
			});
			let selector = '#nav-tab button[data-bs-target="' + anchor + '"]'
			const btn = document.querySelector(selector);
			let instance = null;
			if (btn) instance = new bootstrap.Tab(btn);
			if (instance) instance.show();
		}
	}
	);
}

let bookTabs = document.querySelectorAll('#kkw_book_tabs .nav-link');
for(let i=0; i<bookTabs.length; i++){
	bookTabs[i].addEventListener('click',
		function() {
			// let wpMenuTabs = ["#nav-info", "#nav-reviews", "#nav-excerpts", "#nav-excerpts"];
			// console.log(wpMenuTabs);
			let anchor = this.getAttribute("data-bs-target");
			if (wpMenuTabs.includes(anchor)) {
				const menuItems = document.querySelectorAll('#kkw_lateral_menu .nav-link');
				menuItems.forEach(item => {
					item.classList.remove('active');
				});
				const activeItem = document.querySelector(`#kkw_lateral_menu .nav-link[href="${anchor}"]`);
				if (activeItem) {
					activeItem.classList.add('active');
				}
			}
		}
	);
}
