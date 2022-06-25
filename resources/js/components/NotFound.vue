<template>
    <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
       <div class="text-3xl text-center text-gray-700">Page Not Found! <br>404 ERROR!<br>
             <router-link :to="{name:'home'}" exact>
                <button class="btn btn-info btn-send"><i class="fas fa-home"></i></button>
             </router-link>
       </div>
    </div>
</template>
<script>
export default {

}
</script>
