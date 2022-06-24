<template>
    <div>
        <SearchInput @search="onSearch"></SearchInput>
        <div class="emails  card mt-3">
           <Table :emails="emails"></Table>
        </div>
    </div>
</template>
<script>

import SearchInput from './SearchInput'
import Table from './Table'


 export default {

        data(){
            return {
                 emails:[],
                 searchValue:''
            };
        },
        components:{
            SearchInput,
            Table
        },
        mounted(){
            this.fetchEmails()
        },
        methods:{
            fetchEmails(){
                axios.get('/api/emails')
                .then((response) => {
                    this.emails = response.data.data;

                })
                .catch((error) => {
                    console.log(error);
                });
            },
            onSearch (value) {
                this.searchValue=value
            },

        },
    }
</script>
<style scoped>
    .card{
        padding:20px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
</style>
