<template>
    <div>
      <div class="d-flex btns">
              <router-link :to="{name:'emails.send'}" exact>
                 <button class="btn btn-primary">Send Email <i class="fa fa-paper-plane"></i></button>
              </router-link>
            <button @click="clearFilter" class="btn btn-danger">Clear Filter <i class="fa fa-undo"></i></button>


        </div>
      <div class="  card search mt-3">
        <form @submit.prevent="applyFilter" class="mt-4">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                <input type="text" v-model="searchData.sender" class="form-control " placeholder="Sender" :maxlength="225" >
                <p class="text-danger mt-1 error-message">{{sender_error}}</p>
                </div>
                <div class="col-md-3 mb-3">
                <input type="text" v-model="searchData.recipient" class="form-control " placeholder="Recipient" :maxlength="225">
                <p class="text-danger mt-1 error-message">{{recipient_error}}</p>
                </div>
                <div class="col-md-3 mb-3">
                <input type="text" v-model="searchData.subject" class="form-control " placeholder="Subject" :maxlength="225">
                <p class="text-danger mt-1 error-message">{{subject_error}}</p>
                </div>
                <div class="col-md-2 mb-3">
                <select type="text" class="form-control" id="validationDefault05" v-model="searchData.status">
                <option value="">Select status</option>
                    <option value="Posted">Posted</option>
                    <option value="Sent">Sent</option>
                    <option value="Failed">Failed</option>
                </select>
                <p  class="text-danger mt-1 error-message">{{status_error}}</p>
                </div>
                <div class="col-md-1 mb-3">
                <button class="btn btn-primary"  type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
      </div>
    </div>

</template>
<script>
 export default {
    props:{
        errors: Object
    },
     data() {
        return {
            searchData: {
                sender: '',
                recipient: '',
                subject: '',
                status:''
            },
            sender_error: '',
            recipient_error: '',
            subject_error: '',
            status_error:'',


        };
    },

    methods:{
        applyFilter(){
            this.clearErrors()
            if(this.passedValidation(this.searchData)){
                console.log('sent')
                 this.$emit('applyFilter',this.searchData);
            }

        },

        clearFilter(){
            this.searchData.sender= '',
            this.searchData.recipient= '',
            this.searchData.subject= '',
            this.searchData.status= ''
            this.$emit("refresh")

        },
         clearErrors(){
            this.subject_error= '',
            this.sender_error= '',
            this.recipient_error= '',
            this.status_error= ''
        },
        passedValidation(searchData){
            let passed = true;
            if(this.searchData.sender.length>225){
                this.sender_error = 'Sender email cannot be greater than 225 characters'
                passed = false
            }
            if(this.searchData.recipient.length>225){
                this.recipient_error = 'Recipient email cannot be greater than 225 characters'
                passed = false
            }
            if( this.searchData.subject.length > 225){
                this.subject_error = 'Subject cannot be greater than 225 characters.'
                passed = false
            }
            if( !['Posted','Sent','Failed'].includes(this.searchData.status)  && this.searchData.status !=''){
                this.status_error = 'Invalid email status.'
                passed = false
            }
            if( !this.searchData.subject.length && !this.searchData.status && !this.searchData.sender && !this.searchData.recipient){
                passed = false
            }
            // check if no filter is specified

            return passed;
        }
    }
 }
</script>
<style scoped>
    .btns{
        column-gap:20px;
    }
    .search{
        padding-left:13px !important;
    }

</style>
