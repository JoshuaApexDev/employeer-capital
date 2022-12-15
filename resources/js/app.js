/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import {Invitation, Inviter, Referral, Registerer, Session, SessionState, UserAgent} from "sip.js";

require('./bootstrap');
import Telephony from "./layouts/Telephony";
import HotDial from "./layouts/HotDial";
import FloatingVue from "floating-vue";
import 'floating-vue/dist/style.css'
import {InvitationAcceptOptions} from "sip.js";
import {TelnyxRTC} from "@telnyx/webrtc";
import {env} from "floating-vue/.eslintrc";

window.Vue = require('vue').default;
Vue.use(FloatingVue);

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
Vue.component('telephony', Telephony);
Vue.component('hot-dial', HotDial);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        user: JSON.parse(localStorage.user),
        client: null,
        registered: false,
        device: null,
        inviter: null,
        audio_interface: document.getElementById('audio-interface'),
        activeCall: null,
    },
    beforeDestroy() {
        alert('destroyed');
    },
    mounted() {
        this.register();
        this.audio_interface = document.getElementById('audio-interface');
    },
    methods: {
        register() {
            this.client = new TelnyxRTC({
                login: this.user.sip_extension,
                password: this.user.sip_password,
            });
            this.client.connect().then((status)=>{
                this.client.remoteElement = this.audio_interface;
            })
            this.client
                .on('telnyx.ready', () => {
                    console.log('telnyx.ready');
                    this.registered = true;
                })
                .on('telnyx.error', () => console.log('error'))
                // Events are fired on both session and call updates
                // ex: when the session has been established
                // ex: when there's an incoming call
                .on('telnyx.notification', (notification) => {
                    if (notification.type === 'callUpdate') {
                        this.activeCall = notification.call;
                        console.log('telnyx.notification', this.activeCall.state);

                        if(this.activeCall.state === 'ringing' && this.activeCall.direction != 'outbound'){
                            $('#incoming-call-modal').modal('show');
                        }
                    }
                });
        },

        answer() {
            this.activeCall.answer();
            $('#incoming-call-modal').modal('hide');
            $('#incoming-call-data').modal('show');
            var lead_info_form = document.getElementById('lead-info-form');
            var lead_info = [];
            var key = '$2y$10$PHSqCSRCTAFEQ.5uezFBuesZZwEKmuGoo7826tpuX3oRKwkSfcyhO';
            var url = '/api/get/lead/?key=' + key + '&phone=1' + this.activeCall.options.remoteCallerNumber + '&user_id=' + this.user.id;
            axios.get(url).then((response) => {
                lead_info = response.data;
                Object.keys(lead_info).forEach(function (key) {
                    var input = lead_info_form.elements[key];
                    if (input) {
                        input.value = lead_info[key];
                    }
                });
                lead_info_form.action = '/admin/crm-customers/' + lead_info.id;
            });
        },
        makeCall(number) {
            this.client.newCall({
                destinationNumber: number,
                callerNumber: this.user.sip_extension,
            })
        },
        hangup() {
            this.activeCall.hangup();
            this.activeCall = null;
        },
    }
});
