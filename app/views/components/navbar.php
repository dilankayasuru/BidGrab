<nav class="navbar">
    <div class="logo">
        <a href="/bidgrab/public/">BidGarb</a>
    </div>
    <ul>
        <li><a href="/bidgrab/public/" class="nav-links">Home</a></li>
        <li><a href="/bidgrab/public/products" class="nav-links">Products</a></li>
        <li><a href="/bidgrab/public/categories" class="nav-links">Categories</a></li>
        <li><a href="/bidgrab/public/contact" class="nav-links">Contact</a></li>
    </ul>
    <?php if (isset($_SESSION["user"])) : ?>
        <?php require_once "userMenu.php"; ?>
    <?php else: ?>
        <?php require_once "signInBtn.php"; ?>
    <?php endif; ?>

</nav>

<div class="mobile-nav md:block hidden">
    <div class="mobile-nav-top bg-blue p-2 shadow-blue-500 shadow-lg fixed z-20 w-full transition-all duration-500 -top-full">
        <?php require "search.php"; ?>
    </div>
    <nav class="px-4 fixed bottom-0 bg-white w-full z-20 shadow-[0_-5px_15px_rgb(0,0,0,0.15)]">
        <ul class="flex justify-around gap-4 items-center mobile-nav-list">
            <li class="py-4"><a href="./">
                    <div class="flex-col flex justify-center items-center gap-2">
                        <i class="fa-solid fa-house text-gray text-2xl"></i>
                        <p class="text-gray">Home</p>
                    </div>
                </a></li>
            <li><a href="products">
                    <div class="flex-col flex justify-center items-center gap-2">
                        <i class="fa-solid fa-box text-gray text-2xl"></i>
                        <p class="text-gray">Products</p>
                    </div>
                </a></li>
            <li><a href="#categories">
                    <div class="flex-col flex justify-center items-center gap-2">
                        <i class="fa-solid fa-list text-gray text-2xl"></i>
                        <p class="text-gray">Categories</p>
                    </div>
                </a></li>
            <li><a href="#user">
                    <div class="flex-col flex justify-center items-center gap-2">
                        <i class="fa-solid fa-user text-gray text-2xl"></i>
                        <p class="text-gray">Profile</p>
                    </div>
                </a></li>
        </ul>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Select all navigation links
        const navLinks = document.querySelectorAll('.nav-links');
        // Select all mobile nav links
        const mobileNavLinks = document.querySelector('.mobile-nav-list').children;

        // Loop through each navigation link
        navLinks.forEach(link => {
            // Check if the link matches the current page link
            if (link.href.split('?')[0] === window.location.href.split('?')[0]) {
                // Add 'active' class to the matching link
                link.classList.add('active')
            } else {
                // Remove 'active' class from non-matching links
                link.classList.remove('active')
            }
        })
        Array.from(mobileNavLinks).forEach(link => {
            if (link.childNodes[0].href === window.location.href.split('?')[0]) {
                link.childNodes[0].classList.add('active-mobile-nav');
            } else {
                link.classList.remove('active-mobile-nav');
            }
        })
    })

    document.addEventListener('DOMContentLoaded', (e) => {
        // Select the hero section element
        const hero = document.querySelector('.hero') || document.querySelector('.products-hero');
        // Select the mobile navigation top element
        const mobileNavTop = document.querySelector('.mobile-nav-top');

        // Add a scroll event listener to the document
        e.target.addEventListener('scroll', (e) => {
            // Check if the scroll position is less than or equal to the height of the hero section
            if (window.scrollY <= hero.offsetHeight) {
                // Hide the mobile navigation top element
                mobileNavTop.classList.remove('top-0');
                mobileNavTop.classList.add('-top-full');
            } else {
                // Show the mobile navigation top element
                mobileNavTop.classList.remove('-top-full');
                mobileNavTop.classList.add('top-0');
            }
        });
    });

</script>