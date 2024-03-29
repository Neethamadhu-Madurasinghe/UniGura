// Profile icon click function

const dashboardProfilePictureUI = document.querySelector('.profile-picture');
const profileMenu = document.querySelector('.profile-menu');
const _bodyUI = document.getElementsByTagName('body')[0];
const notificationIconUI = document.querySelector('.notification-dropdown');
const notificationListUI = document.querySelector('.notification-list');
let notificationCardListUI = document.getElementById('notification-card-list');
const notificationCountUI = document.querySelector('.notification-span');
const unSeenMessageCountUI = document.querySelector('.message-span');

let fetchedNotifications = []
let isNotificationMenuOpen = false;

dashboardProfilePictureUI.addEventListener('click', function (e) {
  profileMenu.classList.toggle('profile-menu-hidden');
})

notificationIconUI.addEventListener('click', function (e) {
  notificationListUI.style.display = 'block';
  isNotificationMenuOpen = true;
  markNotificationsAsSeen();
})

_bodyUI.addEventListener('click', function (e) {
  const targetClassList = Array.from(e.target.classList);
  if(!(
    targetClassList.includes('profile-menu') || 
    targetClassList.includes('profile-picture') || 
    targetClassList.includes('profile-picture-img')) )
  {
    profileMenu.classList.add('profile-menu-hidden');
  }

  if(!(
      targetClassList.includes('notification-card') ||
      targetClassList.includes('notification-list') ||
      targetClassList.includes('notification-span') ||
      targetClassList.includes('notification-dropdown') ||
      targetClassList.includes('notification-bell-icon')
  ))
  {
      if(isNotificationMenuOpen === true) {
          notificationListUI.style.display = 'none';
          getNotifications();
          isNotificationMenuOpen = false;
      }
  }
});


// Get notifications and show !
async function getNotifications() {
    notificationListUI.innerHTML = ''
    const respond = await fetch('http://localhost/unigura/api/student/notification')
    const result = await respond.json();

   if(respond.status === 200) {

       fetchedNotifications = result.notifications.filter(notification => {
           return notification.is_seen == 0;
       })

       notificationCountUI.classList.remove('no-notification');
        if(fetchedNotifications.length == 0) {
            notificationCountUI.classList.add('no-notification');
        }else if(fetchedNotifications.length < 10) {
           notificationCountUI.textContent = `0${fetchedNotifications.length}`;
       }else if(fetchedNotifications.length < 100) {
           notificationCountUI.textContent = `${fetchedNotifications.length}`;
       }else {
           notificationCountUI.textContent = "99+";
       }

       if(result.notifications.length > 0) {
           notificationCardListUI = document.createElement('ul');
           notificationCardListUI.id = 'notification-card-list';

           result.notifications.forEach(notification => {
               notificationCardListUI.innerHTML += `
                    <li data-id="${notification.id}" id="notification-${notification.id}">
                       <a href="${notification.link ? notification.link : "#"}" onclick="deleteNotification(${notification.id})">
                         <div class="notification-card ${notification.is_seen === 1 ? 'notification-read' : ''}">
                           <h3>${notification.title}</h3>
                           <p class="description">${notification.description ? notification.description : ""}</p>
                           <p class="time">${getAgeOfTimeString(notification.created_at)}</p>
                         </div>
                       </a>
                    </li>
               `
           });

           notificationListUI.appendChild(notificationCardListUI);
       }else {
           notificationListUI.innerHTML += '<p class="no-notification-message">No Notifications</p>'
       }
   }else if(respond.state === 401) {
       window.location('/login');
   }
}

// Once user clicked on the notification, mark it as read

async function markNotificationsAsSeen() {
    const unreadNotificationIds = fetchedNotifications.map(fetchedNotification => fetchedNotification.id);

    if(unreadNotificationIds.length === 0) {
        return;
    }
    const response = await fetch('http://localhost/unigura/api/student/mark-seen', {
        method: 'POST',
        credentials: "include",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({notification_ids: unreadNotificationIds})
    });

    const put = await response.text();
    console.log(put)
}

// Get the number of unseen messages
async function getUnseenMessageCount() {
    unSeenMessageCountUI.textContent = "00"
    const respond = await fetch('http://localhost/unigura/api/chat/unseen-messages')
    const result = await respond.json();

    if(respond.status === 200) {

        unSeenMessageCountUI.classList.remove('no-notification');
        if(result.unseen_messages === 0) {
            unSeenMessageCountUI.textContent = "00"
            unSeenMessageCountUI.classList.add('no-notification');
        }else if(result.unseen_messages < 10) {
            unSeenMessageCountUI.textContent = `0${result.unseen_messages}`;
        }else if(result.unseen_messages < 100) {
            unSeenMessageCountUI.textContent = `${result.unseen_messages}`;
        }else {
            unSeenMessageCountUI.textContent = "99+";
        }

    }else if(respond.state === 401) {
        window.location('/login');
    }
}

// Delete a notification
async function deleteNotification(id) {
    unSeenMessageCountUI.textContent = "00"
    const respond = await fetch('http://localhost/unigura/api/delete-notification', {
        method: 'POST',
        credentials: "include",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({id})
    });
    const result = await respond.json();

    if(respond.status === 200) {
    //    Remove that notification from the UI
        const notificationUI = document.getElementById('notification-' + id);
        notificationCardListUI.removeChild(notificationUI);

    }else if(respond.state === 401) {
        window.location('/login');
    }
}


getNotifications();
getUnseenMessageCount();


// Helper function to calculate the age of the notification
function getAgeOfTimeString(timeString) {
    const now = new Date();
    const time = new Date(timeString);

    const diffMs = now - time;
    const diffSec = Math.floor(diffMs / 1000);
    const diffMin = Math.floor(diffSec / 60);
    const diffHrs = Math.floor(diffMin / 60);
    const diffDays = Math.floor(diffHrs / 24);
    const diffWeeks = Math.floor(diffDays / 7);

    if (diffSec < 5) {
        return "Just now";
    } else if (diffSec < 60) {
        return "Less than a minute ago";
    } else if (diffMin < 60) {
        const plural = diffMin > 1 ? "s" : "";
        return diffMin + " minute" + plural + " ago";
    } else if (diffHrs < 24) {
        const plural = diffHrs > 1 ? "s" : "";
        return diffHrs + " hour" + plural + " ago";
    } else if (diffDays < 7) {
        const plural = diffDays > 1 ? "s" : "";
        return diffDays + " day" + plural + " ago";
    } else if (diffWeeks === 1) {
        return "A week ago";
    } else if (diffWeeks > 1) {
        return "More than a week ago";
    } else {
        return "Invalid time";
    }
}
