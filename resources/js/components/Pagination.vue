<template>
    <div class="mt-3 pagination" v-if="pagination.total_result">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchEmails(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a>
                </li>
                <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchEmails(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
 export default {
     props:{
        pagination: Object
    },
    methods:{
        fetchEmails(page_url){
            this.$emit('fetchEmails',page_url)
        }
    }

}
</script>

<style scoped>
    .pagination{
        justify-content: right;
    }
</style>
