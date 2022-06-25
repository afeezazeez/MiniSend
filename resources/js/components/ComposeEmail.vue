<template>
    <div>
        <form id="contact-form" method="post" enctype="multipart/form-data" class="card"  @submit.prevent="sendEmail">
            <div class="controls">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_email">From Email *</label>
                            <input id="from_email" type="email"
                                class="form-control" placeholder="Enter from email address *"
                                :maxlength="225"
                                v-model="formData.from_email"
                                value="ddd"
                            >
                            <div class="help-block with-errors">
                                <p v-if="errors.from_email" class="text-danger mt-1 error-message">{{errors.from_email[0]}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="to_email">To Email *</label>
                            <input id="to_email" type="email"
                                class="form-control" placeholder="Enter to email address *"
                                :maxlength="225"
                                v-model="formData.to_email"
                            >
                            <div class="help-block with-errors">
                                <p v-if="errors.to_email" class="text-danger mt-1 error-message">{{errors.to_email[0]}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_email">Subject*</label>
                            <input id="subject" type="text"  name="subject"
                                class="form-control" placeholder="Enter subject *"
                                :maxlength="225"
                                v-model="formData.subject"
                                >
                            <div class="help-block with-errors">
                                <p v-if="errors.subject" class="text-danger mt-1 error-message">{{errors.subject[0]}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_email">Attachments*</label>
                            <p>Only jpeg, png, jpg,pdf,docx formats are allowed and max upload is 20mb</p>
                            <input id="attachments" type="file"
                                name="attachments" class="form-control"  multiple
                                ref="attachments"
                                @change="handleFileObject()"
                            >
                            <div class="help-block with-errors">
                                 <p v-if="errors['files.0']" class="text-danger mt-1 error-message">One or more invalid file was selected</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control"
                                placeholder="Message for me *" rows="4"
                                data-error="Please, leave us a message."
                                v-model="formData.html_content"
                            >
                            </textarea>
                            <div class="help-block with-errors">
                                <p v-if="errors.html_content" class="text-danger mt-1 error-message">{{errors.html_content[0]}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <input type="submit" class="btn btn-success btn-send" value="Send email">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-muted">
                            <strong>*</strong> These fields are required.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
 export default {
    props:{
        errors: Object
    },
     data() {
        return {
            formData: {
                from_email: '',
                to_email: '',
                subject: '',
                html_content:'',
                files:null
            },
        };
    },

    methods:{
        sendEmail(){
           this.$emit('sendEmail',this.formData);
        },
        clearForm(){
            this.formData.from_email= '',
            this.formData.to_email= '',
            this.formData.subject= '',
            this.formData.html_content= ''
            this.$refs.attachments.value = ''
        },
        handleFileObject() {
            this.formData.files = this.$refs.attachments.files;
        }

    }
 }
</script>

<style scoped>
    .card{
        padding:20px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
</style>

