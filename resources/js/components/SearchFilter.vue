<template>

    <div class="card search">
        <div class="row">

        <div class="col-md-11">
            <form @submit.prevent="applyFilter" >
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" v-model="searchData.sender" class="form-control " placeholder="Sender">
                        <p v-if="sender" class="text-danger mt-1">{{sender}}</p>
                    </div>

                    <div class="col-md-3">
                        <input type="text" v-model="searchData.recipient" class="form-control " placeholder="Recipient">
                    </div>

                    <div class="col-md-3">
                        <input type="text" v-model="searchData.subject" class="form-control " placeholder="Subject">
                    </div>

                    <div class="col-md-2">
                        <select  class="form-control" v-model="searchData.status">
                            <option value="">Select status</option>
                            <option value="Posted">Posted</option>
                            <option value="Sent">Sent</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success btn-send"><i class="fa fa-search"></i></button>
                    </div>

                </div>
            </form>
        </div>

        <div class="col-md-1">
             <button @click="clearFilter"  class="btn btn-danger btn-send"><i class="fas fa-undo"></i></button>
        </div>

        </div>

    </div>
</template>
<script>
 export default {
      props:{
        sender: String
    },
     data() {
        return {
            searchData: {
                sender: '',
                recipient: '',
                subject: '',
                status:'',
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

        }
    }
 }
</script>
<style scoped>
    .search{
        padding:20px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
</style>
