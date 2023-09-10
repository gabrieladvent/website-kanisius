// Fungsi-fungsi yang digunakan untuk menangani drag and drop
function preventDefaults(event) {
    event.preventDefault();
    event.stopPropagation();
}

function highlight(event) {
    event.target.classList.add("highlight");
}

function unhighlight(event) {
    event.target.classList.remove("highlight");
}

function getInputAndGalleryRefs(element) {
    const zone = element.closest(".upload_dropZone") || false;
    const gallery = zone.querySelector(".upload_gallery") || false;
    const input = zone.querySelector('input[type="file"]') || false;
    return {
        input: input,
        gallery: gallery
    };
}

// Handle dropped files
function handleDrop(event) {
    const dataRefs = getInputAndGalleryRefs(event.target);
    dataRefs.files = event.dataTransfer.files;
    handleFiles(dataRefs);
}

// Fungsi yang mengatur event listeners untuk dropzone
function eventHandlers(zone) {
    const dataRefs = getInputAndGalleryRefs(zone);
    if (!dataRefs.input) return;

    ["dragenter", "dragover", "dragleave", "drop"].forEach((event) => {
        zone.addEventListener(event, preventDefaults, false);
        document.body.addEventListener(event, preventDefaults, false);
    });

    ["dragenter", "dragover"].forEach((event) => {
        zone.addEventListener(event, highlight, false);
    });
    ["dragleave", "drop"].forEach((event) => {
        zone.addEventListener(event, unhighlight, false);
    });

    zone.addEventListener("drop", handleDrop, false);

    dataRefs.input.addEventListener(
        "change",
        (event) => {
            dataRefs.files = event.target.files;
            handleFiles(dataRefs);
        },
        false
    );
}

// Inisialisasi semua dropzones
const dropZones = document.querySelectorAll(".upload_dropZone");
for (const zone of dropZones) {
    eventHandlers(zone);
}

// Fungsi untuk mengecek apakah file adalah gambar (png)
function isImageFile(file) {
    return ["image/png"].includes(file.type);
}

// Fungsi untuk menampilkan gambar yang di-upload
function previewFiles(dataRefs) {
    if (!dataRefs.gallery) return;
    for (const file of dataRefs.files) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function() {
            let img = document.createElement("img");
            img.className = "upload_gallery";
            img.setAttribute("alt", file.name);
            img.src = reader.result;
            dataRefs.gallery.appendChild(img);
        };
    }
}

// Fungsi untuk mengunggah gambar
function imageUpload(dataRefs) {
    if (!dataRefs.files || !dataRefs.input) return;

    const url = dataRefs.input.getAttribute("data-post-url");
    if (!url) return;

    const name = dataRefs.input.getAttribute("data-post-name");
    if (!name) return;

    const formData = new FormData();
    formData.append(name, dataRefs.files[0]);

    fetch(url, {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        console.log("posted: ", data);
        if (data.success === true) {
            previewFiles(dataRefs);
        } else {
            console.log("URL: ", url, "  name: ", name);
        }
    })
    .catch((error) => {
        console.error("errored: ", error);
    });
}

// Handle both selected and dropped files
function handleFiles(dataRefs) {
    let files = [...dataRefs.files];
    files = files.filter((item) => isImageFile(item));

    if (!files.length) return;
    dataRefs.files = files;

    previewFiles(dataRefs);
    imageUpload(dataRefs);
}

// Fungsi untuk mengaktifkan/menonaktifkan input form
function toggleInputs() {
    const inputs = document.querySelectorAll("input[type='text'], input[type='password'], input[type='file']");
    const checkbox = document.getElementById("edit-checkbox");
    inputs.forEach((input) => {
        input.disabled = !checkbox.checked;
    });
}
