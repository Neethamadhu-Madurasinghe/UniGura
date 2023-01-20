// Profile icon click function

const profilePictureUI = document.querySelector('.profile-picture');
const profileMenu = document.querySelector('.profile-menu');
const bodyUI = document.getElementsByTagName('body')[0];

profilePictureUI.addEventListener('click', function (e) {
  profileMenu.classList.toggle('profile-menu-hidden');
}) 

bodyUI.addEventListener('click', function (e) {
  const targetClassList = Array.from(e.target.classList);
  if(!(
    targetClassList.includes('profile-menu') || 
    targetClassList.includes('profile-picture') || 
    targetClassList.includes('profile-picture-img')) ) {
    profileMenu.classList.add('profile-menu-hidden');
  }
})

