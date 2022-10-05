<template>
    <section class="row justify-content-center">
        <ul class="col-md-8 result-list" v-if="!store.isLoading">
            <li class="d-grid gap-2" v-for="result in store.results">
                 <result-details-component :result="result"></result-details-component>
            </li>
            <li v-if="store.params.page > 1 && store.results.length === 0">
                No more results found.
            </li>
        </ul>
        <div v-else class="col-1">
            <div class="spinner-border" role="status">
                 <div class="visually-hidden">
                     Loading Results...
                 </div>
            </div>
        </div>
    </section>
</template>
<script>
    import {store} from "../store";

    export default {
        data(){
            return {
                store
            }
        }
    }
</script>
