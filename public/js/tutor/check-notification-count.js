function checkNotifications() {
    fetch('http://localhost/unigura/tutor/notifications/getcount')
        .then(response => response.text())
        .then(data => {
           const object = JSON.parse(data);
            let count = object.count;
            if (count > 0) {
                // Display a notification indicator or message
                document.querySelector('.notification-count').classList.add('noti-color');
                document.querySelector('.notification-count').innerHTML = count;
            }
        })
        .catch(error => console.error(error));
}

checkNotifications()
setInterval(checkNotifications, 30000);