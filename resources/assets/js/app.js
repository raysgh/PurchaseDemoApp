import './bootstrap';

Vue.component('pu-supplier', require('./components/PuSupplier'));
Vue.component('pu-order', require('./components/PuOrder'));
Vue.component('pu-order-line', require('./components/PuOrderLine'));

Vue.component('pu-create-order', require('./components/PuCreateOrder'));
Vue.component('pu-edit-order', require('./components/PuEditOrder'));

Vue.component('pu-dashboard', require('./components/PuDashboard'));
Vue.component('pu-level', require('./components/PuLevel'));
Vue.component('pu-settings', require('./components/PuSettings'));
Vue.component('pu-setting-row', require('./components/PuSettingRow'));

Vue.component('pu-up', require('./components/icons/PuUp'));
Vue.component('pu-down', require('./components/icons/PuDown'));
Vue.component('pu-cart-full', require('./components/icons/PuCartFull'));
Vue.component('pu-cart-empty', require('./components/icons/PuCartEmpty'));
Vue.component('pu-on', require('./components/icons/PuOn'));
Vue.component('pu-off', require('./components/icons/PuOff'));

new Vue({
    el: '#app',
});
