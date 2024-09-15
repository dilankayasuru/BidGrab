document.addEventListener('DOMContentLoaded', () => {
    let urlTabs = new URL(location.href).pathname.substring(1).split('/');

    const dashboardMenuItems = document.querySelectorAll(".dashboardMenuItem");
    dashboardMenuItems.forEach(item => {
        if (urlTabs.includes(item.id)) {
            item.classList.add('bg-white-15', 'shadow-md');
        }
    })
})
