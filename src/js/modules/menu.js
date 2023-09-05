// Scroll lock
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';

const Menu = () => {
  // Menu Toggle
  const buttons = document.querySelectorAll('.js-menu-toggle'),
    menu = document.getElementById('main-menu'),
    icons = document.querySelectorAll('.toggle-icons');

  buttons.forEach(el => {
    el.addEventListener('click', () => {
      // Toggle the hide class
      menu.classList.toggle('hidden');
      
      icons.forEach(el => {
        el.classList.toggle('hidden')
      })

      if (menu.classList.contains('hidden')) {
        enableBodyScroll(menu);
      } else {
        disableBodyScroll(menu);
      }
    });
  });

  const enquireButton = document.querySelectorAll('.enquire-button a');
  enquireButton.forEach(el => {
    el.addEventListener('click', () => {
      menu.classList.add('hidden');
      enableBodyScroll(menu);
    })
  })

  // Close menu on ESC key
  document.onkeydown = e => {
    if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
      menu.classList.add('hidden');

      disableBodyScroll(menu);
    }
  };
};

export default Menu;
