<template>
    <div class="container mt-4">
        <div class="col-md-8">
          <h4>Compose Email</h4>
            <ComposeEmail></ComposeEmail>
        </div>
    </div>
</template>
<script>

import CONFIG from '../config.js';
import ComposeEmail from './ComposeEmail';

 export default {

        data(){
            return {
                 baseURL: CONFIG.API_URL_ROOT,
                 errors:{},
            };
        },
        components:{
            ComposeEmail,
        },
        methods:{
            clearFilter(){
                this.errors = {}
            },
        },
    }
</script>
<style scoped>

</style>
