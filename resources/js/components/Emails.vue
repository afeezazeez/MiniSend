<template>
    <div>
        <SearchFilter :errors="errors" @applyFilter="search"></SearchFilter>
        <div class="emails  card mt-3">
           <Table :emails="emails"></Table>
        </div>
    </div>
</template>
<script>

import SearchFilter from './SearchFilter'
import Table from './Table'


 export default {

        data(){
            return {
                 emails:[],
                 searchValue:'',
                 filteredEmails:[],
                 errors:[]
            };
        },
        components:{
            SearchFilter,
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
            search (searchData) {

                if ( !(Object.values(searchData).every(value => !value)) ) {
                     axios.post('/api/emails/search',searchData)
                    .then((response) => {
                        this.emails = response.data.data
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }

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
