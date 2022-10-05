<template>
    <div class="container">
        <header-component></header-component>
        <error-bar-component></error-bar-component>
        <search-fields-component></search-fields-component>
        <result-list-component></result-list-component>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
