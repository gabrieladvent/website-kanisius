$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

// console.clear();
// ('use strict');


// // Drag and drop - single or multiple image files
// // https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
// // https://codepen.io/joezimjs/pen/yPWQbd?editors=1000
(function () {

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
    return {input: input, gallery: gallery};
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


  // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
  // Double checks the input "accept" attribute
  const isImageFile = file => 
    [ 'image/png'].includes(file.type);


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



// file excel
document.addEventListener("DOMContentLoaded", function () {
    const dropZone = document.querySelector('.upload_dropZone');
    const uploadInput = document.getElementById('upload_excel');
    const gallery = document.querySelector('.upload_gallery');

    dropZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
      dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropZone.classList.remove('dragover');
      const files = e.dataTransfer.files;
      uploadInput.files = files; // Assign files to the input element
      handleFiles(files);
    });

    uploadInput.addEventListener('change', (e) => {
      const files = e.target.files;
      handleFiles(files);
    });

    function handleFiles(files) {
      for (const file of files) {
        const fileNameElement = document.createElement('div');
        // fileNameElement.textContent = file.name;
        gallery.appendChild(fileNameElement);
      }
    }
  });
  
//   document.addEventListener("DOMContentIMG", function () {
//     const gambar = document.querySelector('.upload_gambar');
//     const uploadGambar = document.getElementById('.upload_image_background');
//     const img = document.querySelector('.upload_img');

//     gambar.addEventListener('dragover', (e) => {
//       e.preventDefault();
//       gambar.classList.add('dragover');
//     });

//     gambar.addEventListener('dragleave', () => {
//         gambar.classList.remove('dragover');
//     });

//     gambar.addEventListener('drop', (e) => {
//       e.preventDefault();
//       gambar.classList.remove('dragover');
//       const files = e.dataTransfer.files;
//       uploadGambar.files = files; // Assign files to the input element
//       handleFiles(files);
//     });

//     uploadGambar.addEventListener('change', (e) => {
//       const files = e.target.files;
//       handleFiles(files);
//     });

//     function handleFiles(files) {
//       for (const file of files) {
//         const fileNameElement = document.createElement('div');
//         // fileNameElement.textContent = file.name;
//         img.appendChild(fileNameElement);
//       }
//     }
//   });




// script untuk time pada portal 
const Years = document.getElementById("Years");
const Days = document.getElementById("Days");
const Hours = document.getElementById("Hours");
const Minutes = document.getElementById("Minutes");
const Seconds = document.getElementById("Seconds");
const countdownContainer = document.getElementById("countdown-container");
const expiredMessage = document.getElementById("expired-message");

const inputButton = document.getElementById("select-button");
inputButton.addEventListener("click", pressButton);

function pressButton() {
    console.log("button pressed");
};

const inputEvent = document.getElementById("file_name");
const logEvent = document.getElementById("span-event");
inputEvent.addEventListener("input", changeEvent);

function changeEvent(e) {
    logEvent.innerHTML = e.target.value;
};

const inputDateTime = document.getElementById("upload_end");
const logDateTime = document.getElementById("span-datetime");
inputDateTime.addEventListener("input", changeDateTime);

function changeDateTime(dt) {
    logDateTime.innerHTML = dt.target.value;
};

/* open func */
var timer = setInterval(function() {

    var eventHappening = inputEvent.value;

    var countdownDate = new Date(Date.parse(inputDateTime.value));
    var countdownTime = countdownDate.getTime();

    // logDateTime.innerHTML = `on ${countdownDate.toDateString()} at ${countdownDate.toLocaleTimeString()}`;

    var currentDate = new Date();
    var currentTime = currentDate.getTime();

    var diff = countdownTime - currentTime;

    if (diff <= 0) {
        clearInterval(timer);
        Years.innerHTML = "0";
        Days.innerHTML = "0";
        Hours.innerHTML = "0";
        Minutes.innerHTML = "0";
        Seconds.innerHTML = "0";
        countdownContainer.style.display = "none";
        expiredMessage.style.display = "block";
    } else {
        var years = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));
        var days = Math.floor((diff % (1000 * 60 * 60 * 24 * 365)) / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((diff % (1000 * 60)) / 1000);

        Years.innerHTML = `${years}`;
        Days.innerHTML = `${days}`;
        Hours.innerHTML = `${hours}`;
        Minutes.innerHTML = `${minutes}`;
        Seconds.innerHTML = `${seconds}`;

        console.log("");
        console.log(years + " Year(s), " + days + " Day(s), " + hours + " Hour(s), " + minutes +
            " Minute(s), and " + seconds + " Second(s)");
        console.log("remaining until " + eventHappening + " on " + countdownDate.toDateString() + " at " +
            countdownDate.toLocaleTimeString());
    }

    /* close func */
}, 1000);