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
