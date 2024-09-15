document.addEventListener("DOMContentLoaded", () => {
    // Get the sort button element
    const sortBtn = document.getElementById("sort-btn");
    // Get the sort menu element
    const sortMenu = document.getElementById("sort-menu");
    // Get all sort menu items
    const menuItems = document.querySelectorAll('.sort-menu-item');
    // Get the element to display the selected sort option
    const selectedSortHtml = document.getElementById('selected-sort');
    // Track the state of the sort menu (opened or closed)
    let opened = false;

    // Set the default sort option text
    selectedSortHtml.innerText = "Default";

    // Add click event listener to the sort button
    sortBtn.addEventListener('click', () => {
        // Toggle the visibility of the sort menu
        if (opened) {
            sortMenu.classList.add('hidden');
            opened = false;
        } else {
            sortMenu.classList.remove('hidden');
            opened = true;
        }
    });

    // Add click event listeners to each sort menu item
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            // Hide the sort menu when an item is clicked
            sortMenu.classList.add('hidden');
            opened = false;
            // Update the displayed sort option text
            selectedSortHtml.innerText = item.innerText.trim();
        });
    });
})
