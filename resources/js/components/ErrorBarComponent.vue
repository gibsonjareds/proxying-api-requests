<template>
    <section class="row">
        <div v-if="store.errorMsg.length" class="text-bg-danger col-12">{{ store.errorMsg }}</div>
    </section>
</template>
<script>
    import {store} from "../store";
    export default {
        data() {
            return {
               store
            }
        }
    }
</script>
