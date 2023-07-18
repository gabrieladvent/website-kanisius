$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});




console.clear();
('use strict');

(function () {
    'use strict';

    const preventDefaults = event => {
        event.preventDefault();
        event.stopPropagation();
    };

    const highlight = event =>
        event.target.classList.add('highlight');

    const unhighlight = event =>
        event.target.classList.remove('highlight');

    const getInputAndGalleryRefs = element => {
        const zone = element.closest('.upload_dropZone') || false;
        const gallery = zone.querySelector('.upload_gallery') || false;
        const input = zone.querySelector('input[type="file"]') || false;
        return { input: input, gallery: gallery };
    }

    const handleDrop = event => {
        const dataRefs = getInputAndGalleryRefs(event.target);
        dataRefs.files = event.dataTransfer.files;
        handleFiles(dataRefs);
    }

    const eventHandlers = zone => {
        const dataRefs = getInputAndGalleryRefs(zone);
        if (!dataRefs.input) return;

        // Prevent default drag behaviors
        ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
            zone.addEventListener(event, preventDefaults, false);
            document.body.addEventListener(event, preventDefaults, false);
        });

        // Highlighting drop area when item is dragged over it
        ;['dragenter', 'dragover'].forEach(event => {
            zone.addEventListener(event, highlight, false);
        });
        ;['dragleave', 'drop'].forEach(event => {
            zone.addEventListener(event, unhighlight, false);
        });

        // Handle dropped files
        zone.addEventListener('drop', handleDrop, false);

        // Handle browse selected files
        dataRefs.input.addEventListener('change', event => {
            dataRefs.files = event.target.files;
            handleFiles(dataRefs);
        }, false);
    }

    // Initialise ALL dropzones
    const dropZones = document.querySelectorAll('.upload_dropZone');
    for (const zone of dropZones) {
        eventHandlers(zone);
    }

    // Check if the file is an Excel file
    const isExcelFile = file =>
        ['.xls', '.xlsx', '.csv'].includes(file.name.toLowerCase().substring(file.name.lastIndexOf('.')));

    // Check if the file size is within the limit
    const isFileSizeValid = file => file.size <= 20 * 1024 * 1024; // 20MB in bytes

    function previewFiles(dataRefs) {
        if (!dataRefs.gallery) return;
        for (const file of dataRefs.files) {
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function () {
                let img = document.createElement('img');
                img.className = 'upload_image mt-2';
                img.setAttribute('alt', file.name);
                img.src = reader.result;
                dataRefs.gallery.appendChild(img);
            }
        }
    }

    // Upload the Excel file
    const excelUpload = dataRefs => {
        if (!dataRefs.files || !dataRefs.input) return;

        const url = dataRefs.input.getAttribute('data-post-url');
        if (!url) return;

        const name = dataRefs.input.getAttribute('data-post-name');
        if (!name) return;

        const formData = new FormData();
        for (const file of dataRefs.files) {
            formData.append(name, file);
        }

        fetch(url, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('posted: ', data);
                if (data.success === true) {
                    previewFiles(dataRefs);
                } else {
                    console.log('URL: ', url, '  name: ', name)
                }
            })
            .catch(error => {
                console.error('errored: ', error);
            });
    }

    const handleFiles = dataRefs => {
        let files = [...dataRefs.files];

        // Remove unaccepted file types or files exceeding the size limit
        files = files.filter(item => {
            if (!isExcelFile(item)) {
                console.log('Not an Excel file: ', item.type);
            } else if (!isFileSizeValid(item)) {
                console.log('File size exceeds the limit: ', item.size);
            }
            return isExcelFile(item) && isFileSizeValid(item) ? item : null;
        });

        if (!files.length) return;
        dataRefs.files = files;

        previewFiles(dataRefs);
        excelUpload(dataRefs);
    }
})();


