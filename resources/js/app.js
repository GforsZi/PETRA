import 'bootstrap/dist/css/bootstrap.min.css'
import * as bootstrap from 'bootstrap'
import AOS from 'aos'
import 'aos/dist/aos.css'
import Alpine from 'alpinejs'

window.Alpine = Alpine
window.bootstrap = bootstrap

Alpine.start()

AOS.init()

document.addEventListener('DOMContentLoaded', () => {
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map((popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl))
})
