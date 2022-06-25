<template>
    <div class="container mt-4">
        <div class="col-md-8">
          <h4>Compose Email</h4>
            <ComposeEmail ref="composeEmail" @sendEmail="sendEmail"></ComposeEmail>
        </div>
    </div>
</template>
<script>


import ComposeEmail from './ComposeEmail';


 export default {

        data(){
            return {

            };
        },
        components:{
            ComposeEmail,
        },
        methods:{
            sendEmail(form_data){
                let formData = new FormData()
                formData.append('from_email',form_data.from_email)
                formData.append('to_email',form_data.to_email)
                formData.append('subject', form_data.subject)
                formData.append('html_content', form_data.html_content)
                if(form_data.files && form_data.files.length){
                    let files = form_data.files;
                     for (var index = 0; index < files.length; index++) {
                    formData.append("files[]", files[index]);
                }
                }
                axios.post('/',formData)
                .then((response) => {
                    this.successAlert()
                    this.errors = {}
                    this.$refs.composeEmail.clearForm()

                })
                .catch((error) => {
                   this.errorAlert(error.response.data.message)
                });
            },
            successAlert() {
                this.$swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Email sent successfully'
                });
            },
            errorAlert(error) {
                this.$refs.composeEmail.clearForm()
                this.$swal({
                    type: 'error',
                    title: 'Failed!',
                    text: error
                });
            }
        },
}
</script>
<style scoped>

</style>
