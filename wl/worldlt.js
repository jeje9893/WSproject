document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.querySelector("table tbody");
    const nameHeader = document.querySelector("thead th:nth-child(2)");

    const nameSortBtn = document.createElement("button");
    nameSortBtn.textContent = "▼";

    const populationSortBtn = document.createElement("button");
    populationSortBtn.textContent = "▲";

    nameSortBtn.addEventListener("click", function () {
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const nameA = a.cells[1].textContent.trim();
            const nameB = b.cells[1].textContent.trim();
            return nameA.localeCompare(nameB, "ko"); 
        });

        updateTable(rows);

        nameSortBtn.classList.add("active");
        populationSortBtn.classList.remove("active");
    });

    populationSortBtn.addEventListener("click", function () {
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const populationA = parseInt(a.cells[2].textContent.replace(/[^0-9]/g, ""), 10);
            const populationB = parseInt(b.cells[2].textContent.replace(/[^0-9]/g, ""), 10);
            return populationB - populationA;
        });

        updateTable(rows);

        populationSortBtn.classList.add("active");
        nameSortBtn.classList.remove("active");
    });

    function updateTable(rows) {
        tableBody.innerHTML = ""; 
        rows.forEach(row => tableBody.appendChild(row)); 
    }

    nameHeader.appendChild(nameSortBtn);
    nameHeader.appendChild(populationSortBtn);
});
