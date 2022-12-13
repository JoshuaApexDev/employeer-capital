<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div id="makecallcard" class="row">
                    <div class="btn btn-danger" v-if="activeCall != null && activeCall.state == 'active'" v-on:click="hangup()">Hang up</div>
                    <div v-else class="btn btn-primary" v-on:click="makeCall(callnumber)">Call</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import {UserAgent, Registerer, Inviter, SessionState} from "sip.js";

export default {
    name: "HotDial",
    methods: {
        makeCall() {
            this.$root.makeCall(this.callnumber);
        }
    },
}
</script>

<style scoped>

</style>
