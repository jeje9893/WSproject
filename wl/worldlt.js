document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.querySelector("table tbody");
    const nameHeader = document.querySelector("thead th:nth-child(2)");
    const populationHeader = document.querySelector("thead th:nth-child(3)");

    const namebutton = document.createElement("button");
    namebutton.textContent = "▲";
    const namedesbutton = document.createElement("button");
    namedesbutton.textContent = "▼";

    const pbutton = document.createElement("button");
    pbutton.textContent = "▲";
    const pdesbutton = document.createElement("button");
    pdesbutton.textContent = "▼";

    namebutton.addEventListener("click", function () {
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const nameA = a.cells[1].textContent.trim();
            const nameB = b.cells[1].textContent.trim();
            return nameA.localeCompare(nameB, "ko");
        });

        updateTable(rows);
    });

    namedesbutton.addEventListener("click", function () {
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const nameA = a.cells[1].textContent.trim();
            const nameB = b.cells[1].textContent.trim();
            return nameB.localeCompare(nameA, "ko");
        });

        updateTable(rows);
    });

    pbutton.addEventListener("click", function () {
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const populationA = parseInt(a.cells[2].textContent.replace(/[^0-9]/g, ""), 10);
            const populationB = parseInt(b.cells[2].textContent.replace(/[^0-9]/g, ""), 10);
            return populationA - populationB;
        });

        updateTable(rows);
    });

    pdesbutton.addEventListener("click", function () {
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const populationA = parseInt(a.cells[2].textContent.replace(/[^0-9]/g, ""), 10);
            const populationB = parseInt(b.cells[2].textContent.replace(/[^0-9]/g, ""), 10);
            return populationB - populationA;
        });

        updateTable(rows);
    });

    // 테이블 갱신
    function updateTable(rows) {
        tableBody.innerHTML = "";
        rows.forEach(row => tableBody.appendChild(row));
    }

    // 버튼 추가
    nameHeader.appendChild(namebutton);
    nameHeader.appendChild(namedesbutton);
    populationHeader.appendChild(pbutton);
    populationHeader.appendChild(pdesbutton);
});
