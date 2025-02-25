const setLinkTarget = () => {
  let contents = document.getElementsByClassName('child-links-blank')
  contents = Array.from(contents);

  let links

  contents.forEach(content => {
    links = content.getElementsByTagName('a')
    
    if(links.length) {
      links = Array.from(links);
      links.forEach(link => {
        link.setAttribute('target', '_blank')
      })
    }
  })
};

export default setLinkTarget;
