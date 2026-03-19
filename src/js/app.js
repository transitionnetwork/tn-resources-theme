import '../css/app.css'
import scripts from './main'

document.addEventListener('DOMContentLoaded', () => {
  scripts.init()
  scripts.finalize()
})

window.addEventListener('load', () => {
  scripts.loaded()
})
