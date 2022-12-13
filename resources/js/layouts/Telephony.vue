<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn btn-primary" v-if="!$root.registered">Register</div>

                <div v-if="$root.registered" id="makecallcard" class="row">
                    <div class="btn btn-danger" v-if="$root.activeCall  != null &&  $root.activeCall.state === 'early'" v-on:click="$root.hangup()">Calling: </div>
                    <div class="btn btn-danger" v-else-if="$root.activeCall  != null && $root.activeCall.state === 'active'" v-on:click="$root.hangup()">Hang up</div>
                    <div v-else>
                        <VDropdown>
                            <i class="fa fa-phone primary" ></i>
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
        fireCall(){
            this.$root.makeCall(this.callnumber);
        }
    }
}
</script>

