// Profile icon click function

const dashboardProfilePictureUI = document.querySelector('.profile-picture');
const profileMenu = document.querySelector('.profile-menu');
const _bodyUI = document.getElementsByTagName('body')[0];
const notificationIconUI = document.querySelector('.notification-dropdown');
const notificationListUI = document.querySelector('.notification-list');
const notificationCardListUI = document.getElementById('notification-card-list');
const notificationCountUI = document.querySelector('.notification-span');

dashboardProfilePictureUI.addEventListener('click', function (e) {
  profileMenu.classList.toggle('profile-menu-hidden');
})

notificationIconUI.addEventListener('click', function (e) {
  notificationListUI.style.display = 'block';
})

_bodyUI.addEventListener('click', function (e) {
  const targetClassList = Array.from(e.target.classList);
  if(!(
    targetClassList.includes('profile-menu') || 
    targetClassList.includes('profile-picture') || 
    targetClassList.includes('profile-picture-img')) ) {
    profileMenu.classList.add('profile-menu-hidden');
  }

  if(!(
      targetClassList.includes('notification-card') ||
      targetClassList.includes('notification-list') ||
      targetClassList.includes('notification-span') ||
      targetClassList.includes('notification-dropdown') ||
      targetClassList.includes('notification-bell-icon')
  )) {
    notificationListUI.style.display = 'none';
  }
});


// Get notifications and show !
async function getNotifications() {
    notificationCardListUI.innerHTML = '';
    const respond = await fetch('http://localhost/unigura/api/student/notification')
    const result = await respond.json();

   if(respond.status === 200) {

       if(result.notifications.length < 10) {
           notificationCountUI.textContent = `0${result.notifications.length}`;
       }else {
           notificationCountUI.textContent = `${result.notifications.length}`;
       }

       if(result.notifications.length > 0) {
           result.notifications.forEach(notification => {
               notificationCardListUI.innerHTML += `
                    <li data-id="${notification.id}">
                       <a href="${notification.link}">
                         <div class="notification-card">
                           <h3>${notification.title}</h3>
                           <p class="description">${notification.description}</p>
                           <p class="time">2 hourse ago</p>
                         </div>
                       </a>
                    </li>
               `
           });
       }else {
           notificationListUI.innerHTML += '<p class="no-notification-message">No Notifications</p>'
       }
   }else if(respond.state === 401) {
       window.location('/login');
   }
}

getNotifications();