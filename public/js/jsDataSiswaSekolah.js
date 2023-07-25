document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.querySelector('.search-input');
    var searchPlaceholder = document.querySelector('.search-placeholder');
    var tableRows = document.querySelectorAll('.table-group-divider tr');

    searchInput.addEventListener('input', function() {
        var searchQuery = this.value.toLowerCase();

        var found = false;
        tableRows.forEach(function(row) {
            var rowData = row.textContent.toLowerCase();

            if (rowData.includes(searchQuery)) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        searchPlaceholder.style.display = found ? 'none' : 'table-row';
    });
});

// pop up

// Menambahkan penanganan acara klik pada tombol filter
var filterBtn = document.querySelector('.btn.btn-primary');
filterBtn.addEventListener('click', function() {
  var filterPopup = document.getElementById('filterPopup');
  filterPopup.style.display = 'block';
});

// Menambahkan penanganan acara klik pada tombol close di pop-up
var closeBtn = document.getElementById('closeBtn');
closeBtn.addEventListener('click', function() {
  closePopup();
});

// Menambahkan penanganan acara klik pada tombol apply di pop-up
var applyBtn = document.getElementById('applyBtn');
applyBtn.addEventListener('click', function() {
  applyFilter();
  closePopup();
});

// Menangani klik di luar area pop-up untuk menutupnya
window.addEventListener('click', function(event) {
  var filterPopup = document.getElementById('filterPopup');
  if (event.target == filterPopup) {
    closePopup();
  }
});

function applyFilter() {
  var checkedOptions = document.querySelectorAll('.form-check-input:checked');
  var selectedGenders = Array.from(checkedOptions).map(function(option) {
    return option.value;
  });

  var rows = document.querySelectorAll('.table tbody tr');
  Array.from(rows).forEach(function(row) {
    var gender = row.cells[3].textContent;
    if (selectedGenders.includes(gender)) {
      row.style.display = 'table-row';
    } else {
      row.style.display = 'none';
    }
  });
}

function closePopup() {
  var filterPopup = document.getElementById('filterPopup');
  filterPopup.style.display = 'none';
}

$(document).ready(function (){
  $('#example').DataTable();
});

// from submit file
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

// add code js
  const dropZone = document.querySelector('.upload_dropZone');
  const fileInput = document.querySelector('#upload_image_background');

  dropZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropZone.classList.add('dragover');
  });

  dropZone.addEventListener('dragleave', (e) => {
      e.preventDefault();
      dropZone.classList.remove('dragover');
  });

  dropZone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropZone.classList.remove('dragover');
      const files = e.dataTransfer.files;
      fileInput.files = files;
  });



<<<<<<< HEAD
=======

  // Drag and drop - single or multiple image files
  // https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
  // https://codepen.io/joezimjs/pen/yPWQbd?editors=1000
  (function() {

      'use strict';

      // Four objects of interest: drop zones, input elements, gallery elements, and the files.
      // dataRefs = {files: [image files], input: element ref, gallery: element ref}

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
          return {
              input: input,
              gallery: gallery
          };
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
          ;
          ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
              zone.addEventListener(event, preventDefaults, false);
              document.body.addEventListener(event, preventDefaults, false);
          });

          // Highlighting drop area when item is dragged over it
          ;
          ['dragenter', 'dragover'].forEach(event => {
              zone.addEventListener(event, highlight, false);
          });;
          ['dragleave', 'drop'].forEach(event => {
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


      // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
      // Double checks the input "accept" attribute
      const isImageFile = file => ['image/png'].includes(file.type);


      function previewFiles(dataRefs) {
          if (!dataRefs.gallery) return;
          for (const file of dataRefs.files) {
              let reader = new FileReader();
              reader.readAsDataURL(file);
              reader.onloadend = function() {
                  let img = document.createElement('img');
                  img.className = 'upload_img mt-2';
                  img.setAttribute('alt', file.name);
                  img.src = reader.result;
                  dataRefs.gallery.appendChild(img);
              }
          }
      }

      // Based on: https://flaviocopes.com/how-to-upload-files-fetch/
      const imageUpload = dataRefs => {

          // Multiple source routes, so double check validity
          if (!dataRefs.files || !dataRefs.input) return;

          const url = dataRefs.input.getAttribute('data-post-url');
          if (!url) return;

          const name = dataRefs.input.getAttribute('data-post-name');
          if (!name) return;

          const formData = new FormData();
          formData.append(name, dataRefs.files);

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


      // Handle both selected and dropped files
      const handleFiles = dataRefs => {

          let files = [...dataRefs.files];

          // Remove unaccepted file types
          files = files.filter(item => {
              if (!isImageFile(item)) {
                  console.log('Not an image, ', item.type);
              }
              return isImageFile(item) ? item : null;
          });

          if (!files.length) return;
          dataRefs.files = files;

          previewFiles(dataRefs);
          imageUpload(dataRefs);
      }

  })();

//   JS untuk edit profile operato sekolah
document.addEventListener("DOMContentLoaded", function() {
    // Pastikan checkbox bernilai false secara default (input dinonaktifkan)
    document.getElementById('edit-checkbox').checked = false;
    toggleInputs(); // Panggil fungsi toggleInputs untuk mengatur status input secara awal
});

function toggleInputs() {
    var editCheckbox = document.getElementById('edit-checkbox');
    var nomorIDInput = document.getElementById('name');
    var passwordInput = document.getElementById('exampleInputPassword1');
    var confirmPasswordInput = document.getElementById('password-confirm');
    var updateBtn = document.getElementById('update-btn');

    if (editCheckbox.checked) {
        // Jika checkbox bernilai true, maka aktifkan input dan tombol
        nomorIDInput.disabled = false;
        passwordInput.disabled = false;
        confirmPasswordInput.disabled = false;
        updateBtn.disabled = false;
    } else {
        // Jika checkbox bernilai false, maka nonaktifkan input dan tombol
        nomorIDInput.disabled = true;
        passwordInput.disabled = true;
        confirmPasswordInput.disabled = true;
        updateBtn.disabled = true;
    }
}
>>>>>>> 143e9533db34bde961644e44b39b02aa3c183c16
