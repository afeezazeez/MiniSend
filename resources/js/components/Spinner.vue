<template>

    <div class="d-flex justify-content-center spinner mb-3 mt-3">
        <b-spinner label="Loading...">Loading....</b-spinner>
        <span><strong>{{ text }}</strong></span>
    </div>

</template>

<script>


export default {
    props: {
        text: String
    }
}
</script>
<style scoped>

</style>
