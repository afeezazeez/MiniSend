<template>

    <div class="">

        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>Email ID</th>
                <th>Sender</th>
                <th>Recipient</th>
                <th>Subject</th
                <th>Date Sent</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody v-if="emails.length">
                <tr v-for="(email,index) in emails" v-bind:key="email.id">
                <td>{{email.id}}</td>
                <td>
                    <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <p class="fw-bold mb-1">{{email.from_email}}</p>
                    </div>
                    </div>
                </td>
                <td>
                    <router-link :to="{name:'recipient.emails',params:{email:email.to_email} }" exact class="link2">{{email.to_email}}</router-link>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{email.subject}}</p>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{email.created_at}}</p>
                </td>
                <td v-if="email.status == 'Sent'">
                    <span class="badge badge-success rounded-pill d-inline">Sent</span>
                </td>
                 <td v-else-if="email.status == 'Posted'">
                    <span class="badge badge-warning rounded-pill d-inline">Posted</span>
                </td>
                 <td v-else>
                    <span class="badge badge-danger rounded-pill d-inline">Failed</span>
                </td>

                <td>
                    <router-link :to="{name:'email.show',params:{id:email.id} }" exact class="view-link"><i class="fa fa-eye"></i></router-link>
                </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="6">No emails found.</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>

export default {
    props:{
        emails: Array
    },


}

</script>

<style scoped>
    .view-link{
        color:black;
        text-decoration:none;
    }
    .link2{
        text-decoration:none;
    }
</style>

