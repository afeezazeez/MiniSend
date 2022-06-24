<template>

    <div class="card search">
        <div class="col-md-6">
            <input type="text" class="form-control border-2 rounded h-10 " placeholder="Search by Sender,Recipient,Subject or Status"  @keyup="onSearch">
        </div>

    </div>
</template>
<script>
 export default {
     methods:{
         onSearch(e){
             this.$emit('search',e.target.value);
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
