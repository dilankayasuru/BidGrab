function removeImage() {
    let idNo = event.target.id.split('-')[1];
    const auctionImage = document.getElementById(`auction-image-preview-${idNo}`);

    const oldImages = document.querySelectorAll('.oldImages');
    if (oldImages) {
        oldImages.forEach(image => {
            image.value = image.value === auctionImage.src.split('/').pop() ? '' : image.value;
        })
    }

    auctionImage.src = "/bidgrab/public/images/placeholder.png";
    document.getElementById(`auction-image-input-${idNo}`).value = '';

    event.target.classList.remove('visible');
    event.target.classList.add('invisible');
}

function loadProductImage() {
    const file = event.target.files;
    let idNo = event.target.id.split('-')[3];
    const imageRemoveCross = document.getElementById(`image-${idNo}`);

    imageRemoveCross.classList.add('visible');
    imageRemoveCross.classList.remove('invisible');

    if (file) {
        const fileReader = new FileReader();
        const auctionImage = document.getElementById(`auction-image-preview-${idNo}`);

        fileReader.onload = function (event) {
            auctionImage.setAttribute('src', event.target.result);
        }
        fileReader.readAsDataURL(file[0]);
    }
}

function clearImages() {
    const oldImages = document.querySelectorAll('.oldImages');
    if (oldImages) {
        oldImages.forEach(image => {
            image.value = '';
        })
    }
    window.location.replace("/bidgrab/public/dashboard/auction-edit?id=<?=$product['auction_id']?>");
}

function loadProductImageEdit() {
    const previewImages = document.querySelectorAll('.previewImage');
    const oldImages = document.querySelectorAll('.oldImages');
    let imageIndex = event.target.id.split('-')[3];
    let imageSrc = document.getElementById(`auction-image-preview-${imageIndex}`).src;
    let imageChanged = imageSrc.split('/').pop();

    oldImages.forEach(image => {
        image.value = image.value === imageChanged ? '' : image.value;
    })
    loadProductImage()
}

function clearProfileImage() {
    document.getElementById('profile-image-preview').src = "/bidgrab/public/images/profile.png"
}

function openOrderManage(event, orderData) {
    document.querySelector('.manageOrderContainer').classList.remove('hidden');
    document.querySelector('.manageOrderContainer').classList.add('flex');
    const orderManageSeller = document.getElementById('orderManageSeller');
    const orderManageBuyer = document.getElementById('orderManageBuyer');
    const orderManagePrice = document.getElementById('orderManagePrice');
    const orderManageTracking = document.getElementById('orderManageTracking');
    const orderId = document.getElementById('order_manage_id');

    orderId.value = parseInt(orderData.orderId);
    orderManageSeller.innerText = orderData.seller;
    orderManageBuyer.innerText = orderData.buyer;
    orderManagePrice.innerText = `Rs. ${orderData.price}`;
    orderManageTracking.innerText = orderData.tracking;
}

function closeOrderManage() {
    document.querySelector('.manageOrderContainer').classList.remove('flex');
    document.querySelector('.manageOrderContainer').classList.add('hidden');
    const orderForm = document.getElementById("manageOrderForm");
}

function controlMainSearch() {
    const searchQuery = document.getElementById('searchQuery');
    location.href = `/bidgrab/public/products?search=${searchQuery.value}`;
}

function initSearch() {
    document.getElementById('searchQuery').value = event.currentTarget.value;
}