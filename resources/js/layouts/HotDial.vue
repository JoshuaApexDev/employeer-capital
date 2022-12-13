<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div id="makecallcard" class="row">
                    <div v-if="activeCall == null" class="btn btn-primary" v-on:click="makeCall(callnumber)">Call</div>
                    <div class="btn btn-danger" v-else-if="activeCall.state == 'active'" v-on:click="hangup()">Hang up</div>
                    <div v-else-if="activeCall.state == 'destroy'" class="btn btn-primary" v-on:click="makeCall(callnumber)">Call</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import {UserAgent, Registerer, Inviter, SessionState} from "sip.js";

export default {
    props: ['callnumber'],
    name: "HotDial",
    data() {
    },
    methods: {
        makeCall() {
            this.$root.makeCall(this.callnumber);
        }
    },
}
</script>

<style scoped>

</style>
