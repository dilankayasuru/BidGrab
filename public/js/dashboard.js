document.addEventListener('DOMContentLoaded', () => {
    let urlTabs = new URL(location.href).pathname.substring(1).split('/');

    const dashboardMenuItems = document.querySelectorAll(".dashboardMenuItem");
    dashboardMenuItems.forEach(item => {
        if (urlTabs.includes(item.id)) {
            item.classList.add('bg-white-15', 'shadow-md');
        }
    })
})
function clearImages() {
    window.location.replace("/bidgrab/public/dashboard/category-edit?id=<?=$category['category_id']?>");
}
