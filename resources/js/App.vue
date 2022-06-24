<template>

<div class="container mt-5">

    <h1>MiniSend</h1>

    <Analytics></Analytics>

    <div class="row mt-5">

        <div class="col-md-8">
           <Emails></Emails>
        </div>

        <div class="col-md-4">
            <ComposeEmail></ComposeEmail>
        </div>

    </div>


</div>

</template>

<script>

    import ComposeEmail from './components/ComposeEmail'
    import Emails from './components/Emails'
    import Analytics from './components/Analytics'

    export default {
        name: "app",
        components:{
            ComposeEmail,
            Emails,
            Analytics
        }
    }
</script>
