<nav class="navbar">
    <div class="logo">
        <a href="#home">BidGarb</a>
    </div>
    <ul>
        <li><a href="home.php" class="nav-links">Home</a></li>
        <li><a href="products.php" class="nav-links">Products</a></li>
        <li><a href="#categories" class="nav-links">Categories</a></li>
        <li><a href="#contact" class="nav-links">Contact</a></li>
    </ul>
    <?php require_once "signInBtn.php"; ?>
</nav>

<script>
    const url = new URL(window.location.href);
    const currentLocation = url.pathname.split('/').pop().split('.')[0];
    const navLinks = document.querySelectorAll('.nav-links');

    navLinks.forEach(link => {
        if (link.innerText.toLowerCase() === currentLocation.toLowerCase()) {
            link.classList.add('active')
        }
        else {
            link.classList.remove('active')
        }
    })

</script>