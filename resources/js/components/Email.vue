<template>

<div class="container mt-4">

    <h5>Email Information</h5>



    <div class="card col-md-9">
        <div class="row email-row">
            <div class="col-md-4">
                <h6>Sender</h6>
                <p>{{email.from_email}}</p>
            </div>
            <div class="col-md-4">
                <h6>Recipient</h6>
                <p>{{email.from_email}}</p>
            </div>

            <div class="col-md-4">
                <h6>Status</h6>
                <p>
                    <span  v-if="email.status == 'Sent'" class="badge badge-success rounded-pill d-inline">{{email.status}}</span>
                    <span  v-else-if="email.status == 'Posted'" class="badge badge-warning rounded-pill d-inline">{{email.status}}</span>
                    <span  v-else="email.status == 'Failed'" class="badge badge-danger rounded-pill d-inline">{{email.status}}</span>
                </p>

            </div>

        </div>

        <div class="row email-row">
            <div class="col-md-12">
                <h6>Subject</h6>
                <hr>
                <p>{{email.subject}}</p>
            </div>
        </div>

         <div class="row email-row">
            <div class="col-md-12">
                <h6>Body (Text)</h6>
                <hr>
                <p><i>{{email.text_content}}</i></p>
            </div>
        </div>

         <div class="row email-row">
            <div class="col-md-12">
                <h6>Body (HTML)</h6>
                <hr>
                <p v-html="email.html_content"></p>
            </div>
        </div>

         <div class="row email-row">
            <div class="col-md-12">
                <h5>Attachments</h5>
                <hr>
                <ul v-if="filesCount" id="example-1">
                    <li v-for="attachment in email.attachments" :key="attachment.id">
                        <a href="#" @click="downloadWithAxios(attachment.filepath,attachment.filename)">
                            {{ attachment.filename }}
                        </a>
                    </li>
                </ul>
                <p v-else>Oops ! Email has no attachment</p>
            </div>
        </div>

    </div>

</div>

</template>

<script>

    import CONFIG from '../config.js';

    export default {
          data(){
            return {
                 baseURL: CONFIG.API_URL_ROOT,
                 email:[],
                 id:this.$route.params.id,
                filesCount:0
            };
        },
        mounted(){
            this.fetchEmail()
        },
        methods:{
            fetchEmail(){
                axios.get(`${this.baseURL}/${this.id}`)
                .then((response) => {
                    console.log(response.data.data)
                    this.email = response.data.data;
                    this.filesCount = Object.keys(this.email.attachments).length
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            forceFileDownload(response, title) {
                const url = window.URL.createObjectURL(new Blob([response.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', title)
                document.body.appendChild(link)
                link.click()
            },
            downloadWithAxios(url, filename) {
                axios({
                    method: 'get',
                    url,
                    responseType: 'arraybuffer',
                })
                .then((response) => {
                    console.log(response.data)
                    this.forceFileDownload(response, filename)
                })
                .catch(() => console.log('error occured'))
            }
        }
    }
</script>
<style scoped>
    .card{
        padding-left:40px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .email-row{
        padding:20px;
    }
</style>
