import Alpine from '@alpinejs/csp'
import Nprogress from 'nprogress'
import persist from '@alpinejs/persist'
import './algolia'

Alpine.plugin(persist)

window.Alpine = Alpine
window.Nprogress = Nprogress

Alpine.start()
