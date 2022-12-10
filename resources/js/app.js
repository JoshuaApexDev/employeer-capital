/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import {Inviter, Registerer, SessionState, UserAgent} from "sip.js";

require('./bootstrap');
import Telephony from "./layouts/Telephony";
import HotDial from "./layouts/HotDial";
import FloatingVue from "floating-vue";
import 'floating-vue/dist/style.css'

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
        sip_server: 'wss://pbx1.apexcallcenters.xyz:8089/ws',
        UA: null,
        registered: false,
        on_call: false,
        device: null,
        inviter: null,
        audio_interface: document.getElementById('audio-interface'),
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
            const uri = UserAgent.makeURI('sip:' + this.user.sip_extension + '@pbx1.apexcallcenters.xyz');
            const transportOptions = {
                server: this.sip_server
            };

            const userAgentOptions = {
                authorizationPassword: this.user.sip_password,
                authorizationUser: this.user.sip_extension,
                password: this.user.sip_password,
                transportOptions,
                uri
            };

            this.UA = new UserAgent(userAgentOptions);
            const registerer = new Registerer(this.UA);
            this.UA.start().then(() => {
                registerer.register().then(() => {
                    this.registered = true;
                });
            });
        },
        makeCall(number) {
            let target = UserAgent.makeURI('sip:' + number + '@pbx1.apexcallcenters.xyz');
            this.buildInviter(target);
            this.on_call = true;
            this.inviter.stateChange.addListener((newState) => {
                switch (newState) {
                    case SessionState.Establishing:
                        // Session is establishing
                        break;
                    case SessionState.Established:
                        this.inviter.sessionDescriptionHandler.peerConnection.getReceivers().forEach((receiver) => {
                            if (receiver.track) {
                                this.audio_interface.srcObject = new MediaStream([receiver.track]);
                            }
                        });
                        break;
                    case SessionState.Terminated:
                        // Session is terminated
                        this.audio_interface.srcObject = null;
                        this.on_call = false;
                        break;
                    default:
                        break;
                }
            });

            this.inviter.invite();
        },
        hangup() {
            switch (this.inviter.state) {
                case SessionState.Established:
                    this.inviter.bye();
                    break;
                case SessionState.Establishing:
                    this.inviter.cancel();
                    break;
                default:
                    break;
            }
            this.on_call = false;
        },
        buildInviter(target) {
            this.inviter = new Inviter(this.UA, target, {
                sessionDescriptionHandlerOptions: {
                    constraints: {audio: true, video: false},
                }
            });
        }
    }
});
