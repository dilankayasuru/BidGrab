// Function to remove an image from the auction image preview
function removeImage() {
    // Extract the image ID number from the event target's ID
    let idNo = event.target.id.split('-')[1];
    // Get the auction image element by its ID
    const auctionImage = document.getElementById(`auction-image-preview-${idNo}`);

    // Get all elements with the class 'oldImages'
    const oldImages = document.querySelectorAll('.oldImages');
    if (oldImages) {
        // Iterate over each old image element
        oldImages.forEach(image => {
            // Clear the value if it matches the auction image source
            image.value = image.value === auctionImage.src.split('/').pop() ? '' : image.value;
        });
    }

    // Set the auction image source to a placeholder image
    auctionImage.src = "/bidgrab/public/images/placeholder.png";
    // Clear the value of the corresponding file input
    document.getElementById(`auction-image-input-${idNo}`).value = '';

    // Hide the remove image button
    event.target.classList.remove('visible');
    event.target.classList.add('invisible');
}

// Function to load a product image into the auction image preview
function loadProductImage() {
    // Get the selected file from the event target
    const file = event.target.files;
    // Extract the image ID number from the event target's ID
    let idNo = event.target.id.split('-')[3];
    // Get the remove image button element by its ID
    const imageRemoveCross = document.getElementById(`image-${idNo}`);

    // Show the remove image button
    imageRemoveCross.classList.add('visible');
    imageRemoveCross.classList.remove('invisible');

    if (file) {
        // Create a new FileReader object
        const fileReader = new FileReader();
        // Get the auction image element by its ID
        const auctionImage = document.getElementById(`auction-image-preview-${idNo}`);

        // Set the onload event handler for the FileReader
        fileReader.onload = function (event) {
            // Set the auction image source to the loaded file data
            auctionImage.setAttribute('src', event.target.result);
        };
        // Read the selected file as a data URL
        fileReader.readAsDataURL(file[0]);
    }
}

// Function to clear all old images and redirect to the auction edit page
function clearImages() {
    // Get all elements with the class 'oldImages'
    const oldImages = document.querySelectorAll('.oldImages');
    if (oldImages) {
        // Iterate over each old image element and clear its value
        oldImages.forEach(image => {
            image.value = '';
        });
    }
    // Redirect to the auction edit page
    window.location.replace("/bidgrab/public/dashboard/auction-edit?id=<?=$product['auction_id']?>");
}

// Function to load a product image for editing
function loadProductImageEdit() {
    // Get all elements with the class 'previewImage'
    const previewImages = document.querySelectorAll('.previewImage');
    // Get all elements with the class 'oldImages'
    const oldImages = document.querySelectorAll('.oldImages');
    // Extract the image ID number from the event target's ID
    let imageIndex = event.target.id.split('-')[3];
    // Get the source of the auction image by its ID
    let imageSrc = document.getElementById(`auction-image-preview-${imageIndex}`).src;
    // Get the file name of the auction image
    let imageChanged = imageSrc.split('/').pop();

    // Iterate over each old image element
    oldImages.forEach(image => {
        // Clear the value if it matches the changed image file name
        image.value = image.value === imageChanged ? '' : image.value;
    });
    // Load the product image
    loadProductImage();
}

// Function to clear the profile image preview
function clearProfileImage() {
    // Set the profile image source to the default profile image
    document.getElementById('profile-image-preview').src = "/bidgrab/public/images/profile.png";
}

// Function to open the order management modal with order data
function openOrderManage(event, orderData) {
    // Show the order management container
    document.querySelector('.manageOrderContainer').classList.remove('hidden');
    document.querySelector('.manageOrderContainer').classList.add('flex');
    // Get the order management elements by their IDs
    const orderManageSeller = document.getElementById('orderManageSeller');
    const orderManageBuyer = document.getElementById('orderManageBuyer');
    const orderManagePrice = document.getElementById('orderManagePrice');
    const orderManageTracking = document.getElementById('orderManageTracking');
    const orderId = document.getElementById('order_manage_id');

    // Set the order management elements with the provided order data
    orderId.value = parseInt(orderData.orderId);
    orderManageSeller.innerText = orderData.seller;
    orderManageBuyer.innerText = orderData.buyer;
    orderManagePrice.innerText = `Rs. ${orderData.price}`;
    orderManageTracking.innerText = orderData.tracking;
}

// Function to close the order management modal
function closeOrderManage() {
    // Hide the order management container
    document.querySelector('.manageOrderContainer').classList.remove('flex');
    document.querySelector('.manageOrderContainer').classList.add('hidden');
    // Get the order management form by its ID
    const orderForm = document.getElementById("manageOrderForm");
}

// Function to control the main search functionality
function controlMainSearch() {
    // Get the search query input element by its ID
    const searchQuery = document.getElementById('searchQuery');
    // Redirect to the search results page with the search query
    location.href = `/bidgrab/public/products?search=${searchQuery.value}`;
}

// Function to initialize the search input with the current value
function initSearch() {
    // Set the search query input value to the current event target's value
    document.getElementById('searchQuery').value = event.currentTarget.value;
}

function gotocategory(id) {
    location.href = `/bidgrab/public/products?category=${id}`;
}

function validateRegistrationPassword() {
    const warning = document.getElementById('strongPwdWarning');
    const confirmPWD = document.getElementById('confirmPassword');
    const confirmPwdWarning = document.getElementById('confirmPasswordWarning');
    const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;

    if (!pattern.test(event.target.value)) {
        warning.classList.remove('hidden');
        warning.classList.remove('invisible');
        event.target.classList.remove('border-blue-500');
        event.target.classList.remove('border-green');
        warning.classList.add('block');
        event.target.classList.add('border-red');
    } else {
        warning.classList.remove('block');
        warning.classList.add('hidden');
        warning.classList.add('invisible');
        event.target.classList.remove('border-red');
        event.target.classList.add('border-green');
    }

    if (event.target.value !== confirmPWD.value) {
        confirmPwdWarning.classList.remove('hidden');
        confirmPwdWarning.classList.remove('invisible');
        confirmPWD.classList.remove('border-blue-500');
        confirmPWD.classList.remove('border-green');
        confirmPwdWarning.classList.add('block');
        confirmPWD.classList.add('border-red');
    } else {
        confirmPwdWarning.classList.remove('block');
        confirmPwdWarning.classList.add('hidden');
        confirmPwdWarning.classList.add('invisible');
        confirmPWD.classList.remove('border-red');
        confirmPWD.classList.add('border-green');
    }
}

function validateConfirmPassword() {
    const warning = document.getElementById('confirmPasswordWarning');
    const password = document.getElementById('password');
    if (event.target.value !== password.value) {
        warning.classList.remove('hidden');
        warning.classList.remove('invisible');
        event.target.classList.remove('border-blue-500');
        event.target.classList.remove('border-green');
        warning.classList.add('block');
        event.target.classList.add('border-red');
    } else {
        warning.classList.remove('block');
        warning.classList.add('hidden');
        warning.classList.add('invisible');
        event.target.classList.remove('border-red');
        event.target.classList.add('border-green');
    }
}

function validateRegistrationForm() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    return password.value === confirmPassword.value;
}

function showWarning(targetElement, warningElement) {
    targetElement.classList.remove('border-blue-500');
    targetElement.classList.remove('border-green');
    targetElement.classList.add('border-red');
    warningElement.classList.remove('hidden');
    warningElement.classList.remove('invisible');
    warningElement.classList.add('block');
}

function hideWarning(targetElement, warningElement) {
    targetElement.classList.remove('border-red');
    targetElement.classList.add('border-green');
    warningElement.classList.add('hidden');
    warningElement.classList.add('invisible');
    warningElement.classList.remove('block');
}

function validateNewPwd() {

    const confirmPWD = document.getElementById('confirmPassword');
    const newPwdWarning = document.getElementById('newPwdWarning');
    const confirmPwdWarning = document.getElementById('confirmPwdWarning');

    const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;

    if (!pattern.test(event.target.value)) {
        showWarning(event.target, newPwdWarning);
    } else {
        hideWarning(event.target, newPwdWarning);
    }

    if (event.target.value !== confirmPWD.value) {
        showWarning(confirmPWD, confirmPwdWarning);
    } else {
        hideWarning(confirmPWD, confirmPwdWarning);
    }
}

function validateConfirmPwd() {
    const newPwd = document.getElementById('newPassword');
    const confirmPwdWarning = document.getElementById('confirmPwdWarning');

    if (event.target.value !== newPwd.value) {
        showWarning(event.target, confirmPwdWarning);
    } else {
        hideWarning(event.target, confirmPwdWarning);
    }
}

function validateChangePasswordFormSubmit() {
    const currentPassword = document.getElementById('currentPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;

    if (newPassword.value !== confirmPassword.value) {
        return false;
    }

    if (currentPassword.value.trim() === '' || newPassword.value.trim() === '' || confirmPassword.value.trim() === '') {
        return false;
    }

    return pattern.test(newPassword.value);
}

function validateCategoryAdd() {

    return true;
}