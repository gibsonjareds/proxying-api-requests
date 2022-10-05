<template>
    <section v-if="store.params.page > 1 || store.results.length >= 50" class="row justify-content-center">
        <div class="row col-md-8 justify-content-space-between">
            <div class="col-4 d-grid">
                <button class="btn btn-outline-primary" @click="previous" :disabled="shouldDisablePrev()">Previous</button>
            </div>
            <div class="col-4 d-grid">
                <button class="btn btn-outline-primary" @click="next" :disabled="shouldDisableNext()">Next</button>
            </div>
        </div>
    </section>
</template>
<script>
    import {store} from "../store";
    export default {
        props:["fetch"],
        data(){
            return {
                store
            }
        },
        methods:{
            shouldDisablePrev(){
                return store.params.page <= 1 || store.isLoading;
            },
            shouldDisableNext(){
                return store.results.length < 50 || store.isLoading;
            },
            next(){
                store.params.page++;
                this.fetch();
            },
            previous(){
                if(store.params.page <= 1){
                    store.params.page = 1
                }else{
                    store.params.page--;
                    this.fetch();
                }
            }

        }
    }
</script>
