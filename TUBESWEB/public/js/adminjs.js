$(document).ready(function () {
    $("#data").DataTable({
        lengthMenu: [
            [10, 20, 30, -1],
            ["10", "20", "30", "All"],
        ],
        order: [[0, "desc"]],
        responsive: true,
        pagingType: "full_numbers",
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ hingga _END_ dari total _TOTAL_ data",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Berikutnya",
                previous: "Sebelumnya",
            },
        },
    });
});
