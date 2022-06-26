<template>
    <div>
     <SearchFilter ref="searchFilter"  @applyFilter="search" ></SearchFilter>
        <div class="emails mt-2" >
           <Table :emails="emails"></Table>
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
                    this.fetchEmails()
                },

                errorAlert(error) {
                      this.$swal({
                        type: 'error',
                        title: 'Failed!',
                        text: error
                    });
                },



                fetchEmails(page_url){
                    page_url = page_url || '/'
                    axios.get(page_url)
                    .then((response) => {
                        console.log(response)
                        this.emails = response.data.data;
                        this.pagination = makePagination(response.data.current_page,response.data.last_page,response.data.prev_page_url,response.data.next_page_url,response.data.total)
                    })
                    .catch((error) => {
                        this.errorAlert(error.response.data.message)
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
                              this.pagination = makePagination(response.data.current_page,response.data.last_page,response.data.prev_page_url,response.data.next_page_url,response.data.total)
                        })
                        .catch((error) => {
                           this.$refs.searchFilter.clearFilter()
                           this.errorAlert(error.response.data.message)
                        });

                    }

                },


        },
    }
</script>
<style scoped>

</style>
