// Profile icon click function

const dashboardProfilePictureUI = document.querySelector('.profile-picture');
const profileMenu = document.querySelector('.profile-menu');
const _bodyUI = document.getElementsByTagName('body')[0];
const notificationIconUI = document.querySelector('.notification-dropdown');
const notificationListUI = document.querySelector('.notification-list');

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


