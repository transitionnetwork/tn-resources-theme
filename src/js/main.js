import Alert from './modules/alert'
import Menu from './modules/menu'
import Accordion from './modules/accordion'
import saveUserLocation from './modules/save-user-location'
import setLinkTarget from './modules/set-link-target'

export default {
  init () {
    if (document.getElementById('tofino-notification')) {
      Alert()
    }

    if (document.getElementById('menu-primary-navigation')) {
      Menu()
    }

    if (document.getElementsByClassName('accordion')) {
      Accordion()
    }

    if (document.getElementsByClassName('child-links-blank')) {
      setLinkTarget()
    }

    if (document.getElementById('save-user-location')) {
      saveUserLocation()
    }
  },
  finalize () {},
  loaded () {},
}
