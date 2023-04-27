let isMobileMenuShown = false;

function toggleMobileMenu() {
	let nav = document.querySelector("header nav");
	isMobileMenuShown = !isMobileMenuShown;
	nav.style.display = isMobileMenuShown ? "inline-block" : "none";
}
