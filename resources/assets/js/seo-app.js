import Vue from 'vue'
import axios from 'axios';
import store from './store'
import App from './components/App.vue'
import boostrap from 'bootstrap'

new Vue({
    el: '#seo',
    store,
    render: h => h(App)
})

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': '' // Jobber.csrfToken
}