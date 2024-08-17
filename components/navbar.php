<nav class="navbar">
    <div class="logo">
        <a href="home.php">BidGarb</a>
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
    // Get the current URL
    const url = new URL(window.location.href);
    // Extract the current page name from the URL
    const currentLocation = url.pathname.split('/').pop().split('.')[0];
    // Select all navigation links
    const navLinks = document.querySelectorAll('.nav-links');

    // Loop through each navigation link
    navLinks.forEach(link => {
        // Check if the link text matches the current page name
        if (link.innerText.toLowerCase() === currentLocation.toLowerCase()) {
            // Add 'active' class to the matching link
            link.classList.add('active')
        } else {
            // Remove 'active' class from non-matching links
            link.classList.remove('active')
        }
    })
</script>