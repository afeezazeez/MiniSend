<template>
    <div class="emails">
        <h4>All Emails</h4>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>S/N</th>
                <th>From Email</th>
                <th>To Email</th>
                <th>Date Sent</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(email,index) in emails" v-bind:key="email.id">
                <td>{{index+1}}</td>
                <td>
                    <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <p class="fw-bold mb-1">{{email.from_email}}</p>
                    </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{email.to_email}}</p>

                </td>
                <td>
                    <p class="fw-normal mb-1">{{email.sent_at}}</p>
                </td>
                <td>Senior</td>
                <td>
                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                    </button>
                </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
 export default {

        data(){
            return {
                 emails:[]
            };
        },
        created(){
            this.fetchEmails()
        },
        methods:{
            fetchEmails(){
                axios.get('/api/emails')
                .then((response) => {
                    this.emails = response.data.data;
                      console.log(this.emails);
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>
