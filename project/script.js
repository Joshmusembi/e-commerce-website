document.getElementById('menu-btn').onclick = () => {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.style.display = (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') ? 'block' : 'none';
};

document.getElementById('search-btn').onclick = () => {
    const searchForm = document.querySelector('.search-form');
    searchForm.style.display = (searchForm.style.display === 'none' || searchForm.style.display === '') ? 'block' : 'none';
};

document.getElementById('cart-btn').onclick = () => {
    const shoppingCart = document.querySelector('.shopping-cart');
    const loginForm = document.querySelector('.login-form');

    // Hide the login form if it is open
    if (loginForm.style.display === 'block') {
        loginForm.style.display = 'none';
    }

    // Toggle shopping cart visibility
    shoppingCart.style.display = (shoppingCart.style.display === 'none' || shoppingCart.style.display === '') ? 'block' : 'none';
};

document.getElementById('login-btn').onclick = () => {
    const loginForm = document.querySelector('.login-form');
    loginForm.style.display = (loginForm.style.display === 'none' || loginForm.style.display === '') ? 'block' : 'none';

    // Hide the shopping cart if it is open
    const shoppingCart = document.querySelector('.shopping-cart');
    if (shoppingCart.style.display === 'block') {
        shoppingCart.style.display = 'none';
    }
};

document.querySelectorAll('.fa-trash').forEach(item => {
    item.onclick = () => {
        item.parentElement.remove();
        updateTotal();
    };
});

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.shopping-cart .box').forEach(item => {
        let price = parseFloat(item.querySelector('.price').textContent.replace('$', ''));
        total += price;
    });
    document.querySelector('.total').textContent = `Total: $${total.toFixed(2)}`;
}
var swiper = new Swiper(".review-slider", 
    {
    loop: true,
    spaceBetween: 20,
    autoplay: {
        delay: 7500,
        disableOnInteraction : false,

    },
    centeredSlides: true,
    breakpoints: {
        0: {
            sildesPerView: 1,
        },
        768: {
            sildesPerView: 2,
        },
        1020: {
            sildesPerView: 3,},},});

            document.getElementById('cart-btn').addEventListener('click', function() {
                window.location.href = 'cart.php';
            });

