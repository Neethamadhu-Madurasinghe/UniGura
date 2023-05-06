const bellIconSelect = false;

const data = {};

fetch('http://localhost/Unigura/admin/notificationCount', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
})
    .then(response => response.json())
    .then(data => {
        console.log(data);

        if (document.getElementById("notificationCount") !== null) {
            // icon_button_badge.textContent = 0;
            // bellIconSelect = true;

            const clearData = {};

            fetch('http://localhost/Unigura/admin/notification/clearNotification', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(clearData)
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }


        else {
            const icon_button_badge = document.querySelector('.icon-button-badge');
            icon_button_badge.textContent = data['notificationCount'];
        }
    })
    .catch(error => {
        console.error(error);
    });
