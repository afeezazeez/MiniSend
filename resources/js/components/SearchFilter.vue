<template>

    <div class="card search">
        <div class="row">

        <div class="col-md-11">
            <form @submit.prevent="applyFilter" >
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" v-model="searchData.sender" class="form-control " placeholder="Sender" :maxlength="225">
                        <p v-if="errors.sender" class="text-danger mt-1 error-message">{{errors.sender[0]}}</p>
                    </div>

                    <div class="col-md-3">
                        <input type="text" v-model="searchData.recipient" class="form-control " placeholder="Recipient" :maxlength="225">
                        <p v-if="errors.recipient" class="text-danger mt-1 error-message">{{errors.sender[0]}}</p>
                    </div>

                    <div class="col-md-3">
                        <input type="text" v-model="searchData.subject" class="form-control " placeholder="Subject" :maxlength="225">
                        <p v-if="errors.subject" class="text-danger mt-1 error-message">{{errors.subject[0]}}</p>
                    </div>

                    <div class="col-md-2">
                        <select  class="form-control" v-model="searchData.status">
                            <option value="">Select status</option>
                            <option value="Posted">Posted</option>
                            <option value="Sent">Sent</option>
                            <option value="Failed">Failed</option>
                        </select>
                         <p v-if="errors.status" class="text-danger mt-1 error-message">{{errors.status[0]}}</p>
                    </div>

                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success btn-send"><i class="fa fa-search"></i></button>
                    </div>

                </div>
            </form>
        </div>

        <div class="col-md-1 d-flex action">
             <button @click="clearFilter"  class="btn btn-danger btn-send"><i class="fas fa-undo"></i></button>
              <router-link :to="{name:'emails.send'}" exact>
                <button class="btn btn-info btn-send"><i class="fas fa-paper-plane"></i></button>
             </router-link>
        </div>

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

        };
    },

    methods:{
        applyFilter(){
           this.$emit('applyFilter',this.searchData);
        },
        clearFilter(){
            this.searchData.sender= '',
            this.searchData.recipient= '',
            this.searchData.subject= '',
            this.searchData.status= ''
            this.$emit('clearFilter')
        }
    }
 }
</script>
<style scoped>
    .search{
        padding:20px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .error-message{
        font-size:12px;
    }
    .action{
        column-gap:20px;
        margin-left:-30px
    }
</style>
