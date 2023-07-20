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



