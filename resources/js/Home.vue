<template>

<div class="container mt-4">

    <Analytics v-if="Object.keys(analytics).length > 0" :analytics="analytics"></Analytics>
    <div class="row mt-3">
        <div class="col-md-12">
            <Emails></Emails>
        </div>
    </div>

</div>

</template>

<script>

    import ComposeEmail from './components/ComposeEmail'
    import Emails from './components/Emails'
    import Analytics from './components/Analytics'

    export default {
          data(){
            return {
                 analytics:{}
            };
        },
        name: "Home",
        components:{
            Emails,
            Analytics,

        },
          mounted(){
            this.fetchAnalytics()
        },
        methods:{
            fetchAnalytics(){
                axios.get('/analytics')
                .then((response) => {
                    this.analytics = response.data.data;
                })
                .catch((error) => {
                    this.errorAlert(error.response.data.message);
                });
            },
             errorAlert(error) {
                this.$swal({
                    type: 'error',
                    title: 'Failed!',
                    text: error
                });
            },

        }
    }
</script>

