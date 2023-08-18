function updateNamaSekolahOptions() {
    var tingkatanSelect = document.getElementById("tingkatan");
    var namaSekolahSelect = document.getElementById("namaSekolah");
    var selectedTingkatan = tingkatanSelect.value;

    // Semua opsi dinonaktifkan terlebih dahulu
    var options = namaSekolahSelect.options;
    for (var i = 0; i < options.length; i++) {
        options[i].style.display = "none";
    }

    // Aktifkan opsi sesuai dengan tingkatan yang dipilih
    var selectedOptions = document.querySelectorAll(".option-" + selectedTingkatan.toLowerCase());
    for (var i = 0; i < selectedOptions.length; i++) {
        selectedOptions[i].style.display = "block";
    }

    // Aktifkan dropdown namaSekolah jika ada opsi yang aktif
    namaSekolahSelect.disabled = selectedOptions.length === 0;
}

 // Get the form container element
 const formContainer = document.getElementById("formContainer");
                
 // Get the radio buttons for Penghasilan and Agama
 const radioPenghasilan = document.getElementById("penghasilan");
 const radioAgama = document.getElementById("agama");
 const radioKps = document.getElementById("kps");
 const radioJk = document.getElementById('jk')

 // Function to disable all dropdowns
 function disableAllDropdowns() {
     const dropdowns = formContainer.querySelectorAll('select');
     dropdowns.forEach(dropdown => {
         dropdown.disabled = true;
     });
 }

 // Function to enable specific dropdowns
 function enableDropdowns() {
     const selectedRadio = document.querySelector('input[name="laporanType"]:checked');
     if (selectedRadio.id === 'penghasilan') {
         // Enable the desired dropdowns
         document.getElementById('tingkatan').disabled = false;
         document.getElementById('namaSekolah').disabled = false;
         document.getElementById('kategori').disabled = false;
         // Add other dropdowns here that you want to enable
     } else if (selectedRadio.id === 'agama') {
         // Enable other dropdowns based on Agama selection, if necessary
         document.getElementById('tingkatan').disabled = false;
         document.getElementById('namaSekolah').disabled = false;
         document.getElementById('kategori').disabled = false;
     } else if (selectedRadio.id === 'kps'){
         document.getElementById('tingkatan').disabled = false;
         document.getElementById('namaSekolah').disabled = false;
         document.getElementById('kategori').disabled = true;
     } else if (selectedRadio.id === 'jk'){
         document.getElementById('tingkatan').disabled = false;
         document.getElementById('namaSekolah').disabled = false;
         document.getElementById('kategori').disabled = true;
     }
 }
 // Function to disable "Spesifik kelas" radio buttons
 function disableSpesifikKelas() {
 const spesifikKelasRadios = formContainer.querySelectorAll('input[name="detailKelas"]');
 spesifikKelasRadios.forEach(radio => {
     radio.disabled = true;
 });
 }

 // Initially, disable "Spesifik kelas" radio buttons
 disableSpesifikKelas();

 // Initially, disable all dropdowns
 disableAllDropdowns();

 // Add event listeners to detect radio button changes
 radioPenghasilan.addEventListener("change", function() {
     disableAllDropdowns();
     enableDropdowns();
     disableSpesifikKelas();
 });

 radioAgama.addEventListener("change", function() {
     disableAllDropdowns();
     enableDropdowns();
     disableSpesifikKelas();
 });

 radioKps.addEventListener("change", function() {
     disableAllDropdowns();
     enableDropdowns();
     disableSpesifikKelas();
 });
 
 radioJk.addEventListener("change", function() {
     disableAllDropdowns();
     enableDropdowns();
     disableSpesifikKelas();
 });

 // Add event listener to detect "tingkatan" dropdown changes
 document.getElementById('tingkatan').addEventListener('change', function() {
     const selectedTingkatan = this.value;
     // Enable the "kelasTK" dropdown when "tingkatan" is set to "TK"
     document.getElementById('kelasTK').disabled = (selectedTingkatan !== 'TK');
     document.getElementById('kelasSD').disabled = (selectedTingkatan !== 'SD');
     document.getElementById('kelasSMP').disabled = (selectedTingkatan !== 'SMP');

     // Enable "Spesifik kelas" radio buttons only if "tingkatan" is not "TK"
     const spesifikKelasRadios = formContainer.querySelectorAll('input[name="detailKelas"]');
     spesifikKelasRadios.forEach(radio => {
         radio.disabled = (selectedTingkatan === 'TK');
     });
 });

 