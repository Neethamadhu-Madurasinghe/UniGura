const paymentTableUI = document.getElementById('payment-table');
const paginationUI = document.getElementById("pagination");
let currentPage = 1;
let itemsPerPage = 10

// If there is data for payment then show it
if(payments.length !== 0) {
    const upperLimit = payments.length >= itemsPerPage ? itemsPerPage : payments.length;
    displayData(payments, 0, upperLimit);
    displayPagination(payments, itemsPerPage);

//    Format data to be shown in the chart
    let paymentsCopy = JSON.parse(JSON.stringify(payments));

    // Filter out only payments in this year
    paymentsCopy = paymentsCopy.filter(payment => {
        const dateString = payment.timestamp;
        const date = new Date(dateString);
        const currentYear = new Date().getFullYear();
        return date.getFullYear() === currentYear;
    });

    //    get total of each month
    let totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    paymentsCopy.forEach(payment => {
        const date = new Date(payment.timestamp);
        totals[date.getMonth()] += payment['amount'];
        return payment;
    });

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];


//    Render the chart
    console.log(paymentsCopy);
    const ctx = document.getElementById('payment-chart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthNames,
            datasets: [{
                label: 'Payments in this year',
                data: totals,
                borderWidth: 1,
                backgroundColor: 'rgba(247, 113, 26, 0.8)' // Set the background color to orange
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: false,
        }
    });

}

function displayData(data, startIndex, endIndex) {
    paymentTableUI.innerHTML = "";
    // Header is needed for each page
    const tableHeaderRow = document.createElement('tr');
    tableHeaderRow.classList.add('top-table-row');
    tableHeaderRow.innerHTML = `
        <th>Tutor</th><th>Subject</th><th>Module</th><th>Amount</th><th>Date and Time</th>
    `;
    const container = document.getElementById("data-container");
    paymentTableUI.appendChild(tableHeaderRow);

    for (let i = startIndex; i < endIndex; i++) {
        const payment = data[i];

        const tableRow = document.createElement('tr');
        tableRow.innerHTML = `
            <td>${payment.tutor_name}</td>
            <td>${payment.subject_name}</td>
            <td>${payment.module_name}</td>
            <td>${payment.amount}</td>
            <td>${payment.timestamp}</td>
        `;
        paymentTableUI.appendChild(tableRow);
    }

}

function displayPagination(data, itemsPerPage) {
    const numPages = Math.ceil(data.length / itemsPerPage);

    paginationUI.innerHTML = "";
    for (let i = 1; i <= numPages; i++) {
        const button = document.createElement("button");
        button.textContent = i;
        button.classList.add("pagination-button");
        if (i === currentPage) {
            button.classList.add("active");
        }
        button.addEventListener("click", () => {
            currentPage = i;
            let upperBound = i * itemsPerPage > data.length ? data.length : i * itemsPerPage;
            displayData(data, (i - 1) * itemsPerPage, upperBound);
            displayPagination(data, itemsPerPage);
        });
        paginationUI.appendChild(button);
    }
}

