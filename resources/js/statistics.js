/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

//region [IMPORTS]
import {VuejsDatatableFactory} from 'vuejs-datatable';
//endregion [IMPORTS]


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('datatable-component', require('./components/DataTableComponent.vue').default);
Vue.component('chart-wrap-component', require('./components/charts/ChartWrapComponent').default);
Vue.component('doughnut-chart-component', require('./components/charts/DoughnutChartComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VuejsDatatableFactory);
Vue.prototype.$eventBus = new Vue();

const app = new Vue({
    el: '#app',

    data: {
        isFetching: true,
        requests: [],
        browsers: {today: [], all: []},
        devices: {today: [], all: []},
        platforms: {today: [], all: []},
    },

    methods: {
        fetchUserAgents() {
            this.isFetching = true;

            axios({
                method: 'get',
                url: '/statistics/user-agents',
            }).then(response => {
                this.browsers.today = _.get(response, 'data.today.browsers', []);
                this.browsers.all = _.get(response, 'data.all.browsers', []);
                this.devices.today = _.get(response, 'data.today.devices', []);
                this.devices.all = _.get(response, 'data.all.devices', []);
                this.platforms.today = _.get(response, 'data.today.platforms', []);
                this.platforms.all = _.get(response, 'data.all.platforms', []);

                setTimeout(() => {
                    this.$eventBus.$emit('redraw_chart');
                }, 500);

                this.isFetching = false;
            })
        },
    },

    created() {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },

    mounted() {
        this.fetchUserAgents();
    },
});
