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
let links = document.querySelectorAll('.nav-link');
for(let i=0; i<links.length; i++){
links[i].addEventListener('click', function() {
	for(let j=0; j<links.length; j++)
		links[j].classList.remove('active');
	this.classList.add('active');
});
}