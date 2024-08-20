import './bootstrap';

import.meta.glob([
    '../images/**',
])

import Alpine from 'alpinejs'
import 'htmx.org';
 
window.Alpine = Alpine
 
Alpine.start()
