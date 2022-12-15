<template>
    <div>
        <div class="row" style="min-width: 300px; margin-right: 15px">
            <div class="col-8">
                <div class="row h-100 justify-content-center align-content-center">
                    my number: {{ $root.user.sip_caller_id }}
                </div>
            </div>
            <div class="col-4">
                <div class="btn btn-primary" v-if="!$root.registered">Register</div>

                <div v-if="$root.registered" id="makecallcard" class="row">
                    <div v-if="$root.activeCall  != null &&  $root.activeCall.state != 'active' && $root.activeCall.state != 'destroy' && $root.activeCall.state != 'early'">
                        <div v-if="$root.activeCall.direction != 'outbound'">
                            <div class="btn btn-warning" v-on:click="$root.answer()">{{ $root.activeCall.state }}: {{$root.activeCall.options.remoteCallerNumber}}</div>
                        </div>
                        <div v-else>
                            <div class="btn btn-danger" v-on:click="$root.hangup()">{{ $root.activeCall.state }}: {{$root.activeCall.destinationNumber}}</div>
                        </div>
                    </div>

                    <div class="btn btn-danger"
                         v-else-if="$root.activeCall  != null && $root.activeCall.state === 'active' ||$root.activeCall  != null && $root.activeCall.state === 'early'"
                         v-on:click="$root.hangup()">Hang up
                    </div>
                    <div v-else>
                        <VDropdown>
                            <div class="btn btn-outline-primary">Make Call</div>
                            <template #popper>
                                <input type="text" class="form-control" id="callnumber" v-model="callnumber"
                                       placeholder="Enter number">
                                <div class="btn btn-primary" v-on:click="$root.makeCall(callnumber)">Call</div>
                            </template>
                        </VDropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Telephony",
    data() {
        return {
            callnumber: null,
        };
    },
    methods: {
        fireCall() {
            this.$root.makeCall(this.callnumber);
        }
    }
}
</script>

