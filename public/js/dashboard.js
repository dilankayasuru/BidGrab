document.addEventListener('DOMContentLoaded', () => {
    // Get the current URL path and split it into segments
    let urlTabs = new URL(location.href).pathname.substring(1).split('/');

    // Select all elements with the class 'dashboardMenuItem'
    const dashboardMenuItems = document.querySelectorAll(".dashboardMenuItem");

    // Iterate over each dashboard menu item
    dashboardMenuItems.forEach(item => {
        // If the item's ID is included in the URL path segments
        if (urlTabs.includes(item.id)) {
            // Add the classes 'bg-white-15' and 'shadow-md' to the item
            item.classList.add('bg-white-15', 'shadow-md');
        }
    });
});