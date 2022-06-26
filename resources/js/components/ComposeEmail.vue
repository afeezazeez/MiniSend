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
                                required="required"

                            >
                            <div class="help-block with-errors">
                                <p class="text-danger mt-1 error-message">{{from_email_error}}</p>
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
                                required="required"
                            >
                            <div class="help-block with-errors">
                                <p class="text-danger mt-1 error-message">{{to_email_error}}</p>
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
                                required="required"
                                >
                            <div class="help-block with-errors">
                                <p class="text-danger mt-1 error-message">{{subject_error}}</p>
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
                                 <p class="text-danger mt-1 error-message">{{attachments_error}}</p>
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
                                required="required"
                            >
                            </textarea>
                            <div class="help-block with-errors">
                                <p class="text-danger mt-1 error-message">{{html_content_error}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" :disabled="isSubmit" class="btn btn-success btn-send">{{btnText}}</button>
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

import CONFIG from '../config.js';
import { extensionIsValid } from '../utils';


 export default {

     data() {
        return {
            formData: {
                from_email: '',
                to_email: '',
                subject: '',
                html_content:'',
                files:null
            },
            from_email_error: '',
            to_email_error: '',
            subject_error: '',
            html_content_error: '',
            attachments_error: '',
            isSubmit:false,
            btnText:'Send Email'

        };
    },

    methods:{
        sendEmail(){
            this.isSubmit=true
            this.btnText = 'Sending Email';
            this.clearErrors()
            if(this.passedValidation(this.formData)){
                this.$emit('sendEmail',this.formData);
            }
        },
        clearForm(){
            this.isSubmit=false
            this.btnText = 'Send Email';
            this.formData.from_email= '',
            this.formData.to_email= '',
            this.formData.subject= '',
            this.formData.html_content= ''
            this.$refs.attachments.value = ''
        },
        clearErrors(){
            this.from_email_error= '',
            this.to_email_error= '',
            this.subject_error= '',
            this.html_content_error= '',
            this.attachments_error= ''
        },
        handleFileObject() {
            this.formData.files = this.$refs.attachments.files;
        },
        passedValidation(formData){
            let passed = true;
            if(!this.formData.from_email){
                this.from_email_error = 'The from email field is required'
                passed = false
            }
            if(!this.formData.to_email){
                this.to_email_error = 'The to email field is required'
                passed = false
            }
            if( this.formData.from_email.length > 225  || this.formData.to_email.length > 225){
                this.to_email_error = 'The to email and from email cannot be greater than 225 characters.'
                passed = false
            }
            if( (this.formData.from_email != '')  && this.formData.to_email === this.formData.from_email){
                this.to_email_error = 'The to email and from email must be different.'
                passed = false
            }
            if(!this.formData.subject){
                this.subject_error = 'The subject field is required'
                passed = false
            }
            if(!this.formData.subject.length > 225){
                this.subject_error = 'The subject cannot be greater than 225 characters'
                passed = false
            }
             if(!this.formData.html_content){
                this.html_content_error = 'The html content field is required'
                passed = false
            }

            let files =  this.formData.files
            if(files){
                for (let i=0; i<files.length; i++) {
                    let file = files[i]
                    if(!extensionIsValid(file.name)){
                        this.attachments_error = 'One or more files have invalid format'
                        passed = false
                    }
                    if(file.size > 5000000){
                        this.attachments_error = 'One or more files have size greater than 5mb'
                        passed = false
                    }
                }
            }
            if(!passed){
                  this.isSubmit=false
                  this.btnText = 'Send Email';
            }
            return passed;
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

