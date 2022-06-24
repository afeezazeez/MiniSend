<template>
    <div>
        <SearchFilter :errors="errors" @applyFilter="search" @clearFilterErrors='clearErrors'></SearchFilter>
        <div class="emails  card mt-3">
           <Table :emails="emails"></Table>
           <Pagination :pagination="pagination" @fetchEmails="fetchEmails"></Pagination>
        </div>
    </div>
</template>
<script>

import SearchFilter from './SearchFilter'
import Table from './Table'
import Pagination from './Pagination'


 export default {

        data(){
            return {
                 emails:[],
                 searchValue:'',
                 filteredEmails:[],
                 errors:{},
                 pagination: {},
            };
        },
        components:{
            SearchFilter,
            Table,
            Pagination
        },
        mounted(){
            this.fetchEmails()
        },
        methods:{
                clearErrors(){
                    this.errors = {}
                },
                makePagination(meta,links){
                    let pagination = {
                        current_page : meta.current_page,
                        last_page:meta.last_page,
                        next_page_url:links.next,
                        prev_page_url :links.prev,
                        total_result:meta.total
                    }
                    this.pagination = pagination;
                },
                fetchEmails(page_url){
                    let vm = this;
                    page_url = page_url || '/api/emails'
                    axios.get(page_url)
                    .then((response) => {
                        this.emails = response.data.data;
                        vm.makePagination(response.data.meta,response.data.links);
                        //vm.makePagination(response.meta,response.links)

                    })
                    .catch((error) => {
                        console.log(error);
                    });
                },
                search (searchData) {

                    let queryString = "";
                    let isEmpty = true;
                    const payload = {}
                    Object.keys(searchData).forEach((key) => {
                        if (searchData[key] !== "") {
                            isEmpty = false;
                            payload[key] = searchData[key];
                        }
                    });

                    if (!isEmpty) {
                        let vm = this;
                        queryString = '?';
                        const length = Object.keys(payload).length;
                        Object.keys(payload).forEach((key, index)=>{
                            queryString+= `${key}=${payload[key]}`;
                            if (index < length-1) queryString += '&';
                        });
                        axios.get(`api/emails/search/${queryString}`)
                        .then((response) => {
                            this.emails = response.data.data
                              vm.makePagination(response.data.meta,response.data.links);
                        })
                        .catch((error) => {
                            this.errors = error.response.data.data
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
