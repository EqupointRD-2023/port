document.querySelector('#data-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const startDate = document.querySelector('#start-date').value;
    const endDate = document.querySelector('#end-date').value;

    const xhr = new XMLHttpRequest();
    xhr.open(
        "GET",
        "/device-stock-search?start_date=" + startDate + "&end_date=" + endDate,
        true
    );

    xhr.onload = function() {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            const tableBody = document.querySelector('#data-table tbody');
            tableBody.innerHTML = '';

            data.forEach(function(row) {
                const tr = document.createElement('tr');
                const dateCell = document.createElement('td');
                dateCell.textContent = row.email;
                const valueCell = document.createElement('td');
                valueCell.textContent = row.name;

                tr.appendChild(dateCell);
                tr.appendChild(valueCell);

                tableBody.appendChild(tr);
            });
        } else {
            console.error(xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error(xhr.statusText);
    };

    xhr.send();
});
