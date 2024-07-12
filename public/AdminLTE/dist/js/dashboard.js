$(document).ready(function() {
    $('#example1').DataTable({
        searching: true,
        ordering: true,
        paging: true
    });
});
$(document).ready(function() {
    $('#example2').DataTable({
        searching: true,
        ordering: true,
        paging: true
    });
});



function updateDateTime() {
    var now = new Date();

    // Format tanggal
    var optionsDate = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    var formattedDate = now.toLocaleDateString('id-ID', optionsDate);

    // Format waktu
    var optionsTime = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };
    var formattedTime = now.toLocaleTimeString('id-ID', optionsTime);

    // Update elemen HTML
    document.getElementById('date').innerText = formattedDate;
    document.getElementById('time').innerText = formattedTime;
}

setInterval(updateDateTime, 1000); // Update every second
updateDateTime();

document.addEventListener('DOMContentLoaded', function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            document.getElementById('statusForm').submit();
        });
    });
});


$(document).ready(function() {
    // Select input dengan class 'harga'
    $('.harga').on('input', function() {
        // Hilangkan semua karakter selain digit
        var nilai = $(this).val().replace(/\D/g, '');
        // Format nilai dengan menggunakan toLocaleString() untuk format IDR
        $(this).val((parseInt(nilai)).toLocaleString('id-ID'));
    });
});