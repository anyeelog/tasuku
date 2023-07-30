const mobileMenuBtn = document.querySelector('#mobile-menu');
const mobileCloseMenuBtn = document.querySelector('#mobile-menu-close');
const sidebarMobile = document.querySelector('.sidebar-mobile');

if(mobileMenuBtn) {
  mobileMenuBtn.addEventListener('click', function() {
    sidebarMobile.classList.toggle('show');
  });
  mobileCloseMenuBtn.addEventListener('click', function() {
    sidebarMobile.classList.toggle('show');
  });
}
