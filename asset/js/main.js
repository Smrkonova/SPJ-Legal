// Load header
fetch('/./shared/header.html')
    .then(res => res.text())
    .then(data => {
        document.getElementById('header').innerHTML = data;

        // Get the header and navbar toggler button
        const header = document.querySelector("header.header");
        const navbarToggler = document.querySelector(".navbar-toggler");

        // Scroll event listener
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });

        // Navbar toggler click event listener
        navbarToggler.addEventListener("click", () => {
            header.classList.toggle("scrolled");
        });

        // Initialize scroll state
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        }

        // Add modal functionality
        initDisclaimerModal();
    })
    .catch(error => console.error('Error loading header:', error));

function initDisclaimerModal() {
    // Check if user has already agreed
    if (localStorage.getItem('disclaimerAgreed') !== 'true') {
        document.getElementById('disclaimerModal').style.display = 'flex';

        // Disable body scroll when modal is open
        document.body.style.overflow = 'hidden';
    }

    // When user clicks "I Agree"
    document.getElementById('agreeButton').onclick = function () {
        // Store agreement in localStorage
        localStorage.setItem('disclaimerAgreed', 'true');
        // Hide modal
        document.getElementById('disclaimerModal').style.display = 'none';
        // Restore body scroll
        document.body.style.overflow = 'auto';
    };

    // Prevent closing by clicking outside
    document.getElementById('disclaimerModal').onclick = function (e) {
        if (e.target === this) {
            return false;
        }
    };
}
// Load footer
fetch('/./shared/footer.html')
    .then(res => res.text())
    .then(data => document.getElementById('footer').innerHTML = data);
// Load contact
fetch('/./shared/contact-us.html')
    .then(res => res.text())
    .then(data => document.getElementById('contact').innerHTML = data);