"use strict";

// pagination start
document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;
    const table = document.getElementById("dataTable");
    const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    const pagination = document.querySelector(".pagination");

    let currentPage = 1;

    function displayPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        // Tampilkan hanya baris yang sesuai dengan halaman
        for (let i = 0; i < totalRows; i++) {
            rows[i].style.display = i >= start && i < end ? "" : "none";
        }

        // Atur ulang data tombol pagination
        const pageItems = pagination.querySelectorAll(".page-item");
        pageItems.forEach((item, index) => {
            item.classList.toggle("active", index === page);
        });

        // Nonaktifkan tombol Prev jika di halaman pertama
        const prevButton = pagination.querySelector(".prev");
        prevButton.classList.toggle("disabled", page === 1);

        // Nonaktifkan tombol Next jika di halaman terakhir
        const nextButton = pagination.querySelector(".next");
        nextButton.classList.toggle("disabled", page === totalPages);
    }

    function setupPagination() {
        // Tambahkan tombol Prev
        pagination.innerHTML = `
            <li class="page-item prev disabled">
                <a class="page-link" href="#">&laquo;</a>
            </li>
        `;

        // Tambahkan tombol untuk setiap halaman
        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `
                <li class="page-item"><a class="page-link" href="#">${i}</a></li>
            `;
        }

        // Tambahkan tombol Next
        pagination.innerHTML += `
            <li class="page-item next">
                <a class="page-link" href="#">&raquo;</a>
            </li>
        `;

        // Tambahkan event listener ke tombol
        const pageItems = pagination.querySelectorAll(".page-item");
        pageItems.forEach((item, index) => {
            item.addEventListener("click", function (e) {
                e.preventDefault();
                if (item.classList.contains("disabled")) return;

                if (index === 0) {
                    // Tombol Prev
                    displayPage(--currentPage);
                } else if (index === totalPages + 1) {
                    // Tombol Next
                    displayPage(++currentPage);
                } else {
                    // Tombol halaman
                    currentPage = index;
                    displayPage(currentPage);
                }
            });
        });
    }

    setupPagination();
    displayPage(currentPage);
});
// pagination end


