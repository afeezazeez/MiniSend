<template>

<div class="container mt-4">

    <Analytics></Analytics>
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
        name: "Home",
        components:{
            ComposeEmail,
            Emails,
            Analytics,

        }
    }
</script>
