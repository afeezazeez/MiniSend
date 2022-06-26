<template>
    <div class="container mt-4">
        <div >
            <h4 >Emails sent to {{email}}</h4>
            <SearchFilter  ref="searchFilter" @applyFilter="search" @refresh="fetchRecipientEmails" class="mt-3"></SearchFilter>
            <div class="emails mt-3" v-if="!isLoading">
                <Table :emails="emails"></Table>
                <Pagination :pagination="pagination" @fetchEmails="fetchEmails"></Pagination>
            </div>
            <Spinner v-else  :text="'Loading Emails...'"></Spinner>
        </div>

    </div>
</template>
<script>

import SearchFilter from './SearchFilter'
import Table from './Table'
import Pagination from './Pagination'
import { makePagination } from '../utils';
import Spinner from './Spinner'




 export default {

        data(){
            return {
                emails:[],
                errors:{},
                pagination: {},
                email:this.$route.params.email,
                isLoading:true,
            };
        },
        components:{
            SearchFilter,
            Table,
            Pagination,
            Spinner
        },
        mounted(){
            this.fetchRecipientEmails()
        },
        methods:{
            clearFilter(){

                this.fetchRecipientEmails()
            },
            errorAlert(error) {
                this.$swal({
                type: 'error',
                title: 'Failed!',
                text: error
                });
            },
            fetchEmails(page_url){
                 this.isLoading=true
                page_url = page_url || '/'
                axios.get(page_url)
                .then((response) => {
                    console.log(response.data.data)
                    this.emails = response.data.data;
                    this.pagination = makePagination(response.data.current_page,response.data.last_page,response.data.prev_page_url,response.data.next_page_url,response.data.total)
                    this.isLoading=false
                })
                .catch((error) => {
                   this.errorAlert(error.response.data.message)
                   this.isLoading=false
                });

            },
            fetchRecipientEmails() {
                axios.get(`/recipient/${this.email}`)
                .then((response) => {
                        this.emails = response.data.data
                        this.pagination = makePagination(response.data.current_page,response.data.last_page,response.data.prev_page_url,response.data.next_page_url,response.data.total)
                         this.isLoading = false
                })
                .catch((error) => {
                    this.errorAlert(error.response.data.message)
                     this.isLoading=false
                });
            },
            search (searchData) {
                    this.isLoading=true
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
                        axios.get(`/recipient/search/${this.email}/${queryString}`)
                        .then((response) => {
                            this.emails = response.data.data
                            this.pagination = makePagination(response.data.current_page,response.data.last_page,response.data.prev_page_url,response.data.next_page_url,response.data.total)
                            this.isLoading=false
                        })
                        .catch((error) => {
                            this.$refs.searchFilter.clearFilter()
                            this.errorAlert(error.response.data.message)
                            this.isLoading=false
                        });

                    }


            }

        },
    }
</script>
<style scoped>
 .spinner{
        column-gap: 10px;
    }
</style>
