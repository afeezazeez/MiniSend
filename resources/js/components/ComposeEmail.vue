<template>
   <form id="contact-form" method="post" enctype="multipart/form-data" class="card">
        <div class="controls">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_name">From Email *</label>
                        <input id="from_email" type="text" name="from_email" class="form-control" placeholder="Enter from email address *" required="required" :maxlength="225" >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_lastname">To Email *</label>
                        <input id="to_email" type="text" name="to_email" class="form-control" placeholder="Enter to email address *" required="required" :maxlength="225" >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form_email">Subject*</label>
                        <input id="subject" type="email"  name="subject" class="form-control" placeholder="Enter subject *" required="required" :maxlength="225">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

                <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form_email">Attachments*</label>
                        <input id="attachments" type="file" name="attachments" class="form-control" required="required" multiple>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form_message">Message *</label>
                        <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <input type="submit" class="btn btn-success btn-send" value="Send email">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="text-muted">
                        <strong>*</strong> These fields are required. Contact form template by.</p>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
</script>

<style scoped>
    .card{
        padding:20px;
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
</style>

