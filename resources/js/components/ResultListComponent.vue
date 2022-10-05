<template>
    <section class="row justify-content-center">
        <ul class="col-md-8 result-list" >
            <li class="d-grid gap-2" v-for="result in store.results">
                 <result-details-component :result="result"></result-details-component>
            </li>
        </ul>
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
