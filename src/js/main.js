// Import Alert
import Alert from './modules/alert';

// Menu
import Menu from './modules/menu';

import Accordion from './modules/accordion';

//Geolocation
import getLocalResources from './modules/get-local-resources';

import saveUserLocation from './modules/save-user-location';

import setLinkTarget from './modules/set-link-target';

// Import Font loader
import WebFont from 'webfontloader';

export default {
  init () {
    // JavaScript to be fired on all pages

    // Load Fonts
    WebFont.load({
      classes: false,
      events: false,
      google: {
        families: ['Roboto:wght@300;400;700'],
        display: 'swap',
        version: 2,
      },
    });

    // Alert
    if (document.getElementById('tofino-notification')) {
      Alert();
    }

    // Menu
    if (document.getElementById('menu-primary-navigation')) {
      Menu();
    }

    // Accordion
    if (document.getElementsByClassName('accordion')) {
      Accordion();
    }

    // Set Link Target
    if (document.getElementsByClassName('child-links-blank')) {
      setLinkTarget();
    }

    if (document.getElementById('geolocated-content')) {
      getLocalResources();
    }
    
    if (document.getElementById('save-user-location')) {
      saveUserLocation();
    }
  },
  finalize () {
    // JavaScript to be fired after init
  },
  loaded () {
    // Javascript to be fired once fully loaded
  },
};
