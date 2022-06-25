<template>
    <div>
     <SearchFilter  SearchFilter :errors="errors" @applyFilter="search" @clearFilter='clearFilter'></SearchFilter>
        <div class="emails  card mt-3">
           <Table  :emails="emails"></Table>
           <Pagination :pagination="pagination" @fetchEmails="fetchEmails"></Pagination>
        </div>
    </div>
</template>
<script>

import SearchFilter from './SearchFilter'
import Table from './Table'
import Pagination from './Pagination'

import { makePagination } from '../utils';


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
                clearFilter(){
                    this.errors = {}
                    this.fetchEmails()
                },

                fetchEmails(page_url){
                    page_url = page_url || '/'
                    axios.get(page_url)
                    .then((response) => {
                        this.emails = response.data.data;
                        this.pagination = makePagination(response.data.meta,response.data.links)
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
                        queryString = '?';
                        const length = Object.keys(payload).length;
                        Object.keys(payload).forEach((key, index)=>{
                            queryString+= `${key}=${payload[key]}`;
                            if (index < length-1) queryString += '&';
                        });
                        axios.get(`/search/${queryString}`)
                        .then((response) => {
                              this.emails = response.data.data
                              this.pagination = makePagination(response.data.meta,response.data.links)
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
