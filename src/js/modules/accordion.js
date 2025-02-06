const Accordion = () => {
  var headerElement = document.querySelectorAll('.accordion-header');

  headerElement.forEach(el => {
    el.addEventListener('click', () => {
      const sibling = el.nextElementSibling;
      sibling.classList.toggle('h-auto');
      sibling.classList.toggle('h-0');
      el.classList.toggle('rotated');
    });
  });

}

export default Accordion;
