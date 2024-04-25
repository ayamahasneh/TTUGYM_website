document.addEventListener("DOMContentLoaded", function() {
    const createAccountLink = document.getElementById("createAccountLink");
    const createAccountLinkTop = document.getElementById("createAccountLinkTop");
    const loginForm = document.getElementById("loginForm");
    const createAccountForm = document.getElementById("createAccountForm");

    createAccountLink.addEventListener("click", function(event) {
        event.preventDefault();
        loginForm.style.display = "none";
        createAccountForm.style.display = "block";
    });

    createAccountLinkTop.addEventListener("click", function() {
        loginForm.style.display = "none";
        createAccountForm.style.display = "block";
    });


const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('ol');

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});
document.getElementById('menu-toggle').addEventListener('click', function() {
    var navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('menu-open');
});

});
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    const searchableContent = [
        
        'About Us',
        'Features',
        'Competition',
        'Contact',
    ];

    searchButton.addEventListener('click', function () {
        performSearch();
    });

    searchInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            performSearch();
        }
    });

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase();
        const searchResults = searchableContent.filter(content =>
            content.toLowerCase().includes(searchTerm)
        );
        console.log(searchResults);
    }
});
