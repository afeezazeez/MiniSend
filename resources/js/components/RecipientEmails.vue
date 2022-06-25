<template>
    <div class="container mt-4">
        <h4 >Emails sent to {{email}}</h4>
        <SearchFilter :errors="errors" @applyFilter="search" @clearFilter='clearFilter' class="mt-3"></SearchFilter>
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
import CONFIG from '../config.js';


 export default {

        data(){
            return {
                baseURL: CONFIG.API_URL_ROOT,
                emails:[],
                errors:{},
                pagination: {},
                email:this.$route.params.email,
            };
        },
        components:{
            SearchFilter,
            Table,
            Pagination
        },
        mounted(){
            this.fetchRecipientEmails()
        },
        methods:{
            clearFilter(){
                this.errors = {}
                this.fetchRecipientEmails()
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
                page_url = page_url || this.baseURL
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
             fetchRecipientEmails() {
                let vm = this;
                axios.get(`${this.baseURL}/recipient/${this.email}`)
                .then((response) => {
                        this.emails = response.data.data
                        vm.makePagination(response.data.meta,response.data.links);

                })
                .catch((error) => {
                    this.errors = error.response.data.data
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
                        axios.get(`${this.baseURL}/recipient/${this.email}/${queryString}`)
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
