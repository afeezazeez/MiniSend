<template>

    <div class="container mt-4">
        <div v-if="Object.keys(email).length > 0">
            <h3 class="text-center">Mail Information</h3>
            <div class="card col-md-8 email">


                <div class="row ">
                    <div class="col-md-8">
                        <h3 class="mt-4">{{ email.subject }}</h3>
                        <h6 class="mt-3">From : {{ email.from_email }}rffrfrfrfrf</h6>
                        <h6 class="mt-3">To : {{ email.to_email }}</h6>
                        <h6 class="mt-3">Date : {{ email.sent_at }}</h6>
                    </div>

                </div>

                <hr>

                <div class="row email-row body-row">
                    <div class="col-md-8  email-row">
                        <p v-html="email.html_content"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5>Attachments (Click files to download)</h5>
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

                <div class="row email-row mt-1" v-if="email.failed_reason">
                    <div class="col-md-12">
                        <span class="info" @click="showFResponse = !showFResponse">{{
                                !showFResponse ? 'Show failure response' : 'Hide response'
                            }}</span>
                        <div v-if="showFResponse">
                            <hr>
                            <p>{{ email.failed_reason }}</p>
                        </div>
                    </div>
                </div>

                <div class="row email-row mt-1">
                    <div class="col-md-12">
                        <span class="content" @click="showTContent = !showTContent">{{
                                !showTContent ? 'Show email as text ' : 'Hide text'
                            }}</span>
                        <div v-if="showTContent">
                            <hr>
                            <p>{{ email.text_content }}</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>

</template>

<script>


export default {
    data() {
        return {
            email: [],
            id: this.$route.params.id,
            filesCount: 0,
            showFResponse: false,
            showTContent: false
        };
    },
    mounted() {
        this.fetchEmail()
    },
    methods: {
        fetchEmail() {
            axios.get(`/${this.id}`)
                .then((response) => {
                    this.email = response.data.data;
                    this.filesCount = Object.keys(this.email.attachments).length
                })
                .catch((error) => {
                    this.errorAlert(error.response.data.message);
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

                    this.forceFileDownload(response, filename)
                })
                .catch(() => console.log('error occured'))
        },
        errorAlert(error) {
            this.$swal({
                type: 'error',
                title: 'Failed!',
                text: error
            })
                .then(function () {
                    window.location = "/";
                });
        }

    }
}
</script>
<style scoped>
.card {
    padding-left: 40px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.email-row {
    padding: 20px;
}

.body-row {
    display: flex;

}

.email {

    margin: 0 auto;
}

.info {
    color: red;
    text-decoration: underline;
    cursor: pointer;
}

.content {
    color: blue;
    text-decoration: underline;
    cursor: pointer;
}
</style>
