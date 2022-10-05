<template>
    <div class="container">
        <header-component></header-component>
        <error-bar-component></error-bar-component>
        <search-fields-component :fetch="fetchStuff"></search-fields-component>
        <pagination-component :fetch="fetchStuff"></pagination-component>
        <result-list-component></result-list-component>
        <pagination-component :fetch="fetchStuff"></pagination-component>
    </div>
</template>

<script>
    import {store} from "./store";
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            fetchStuff(){
                store.errorMsg='';
                store.isLoading=true;
                axios.get('/api/npi-registry/', {params:store.params})
                     .then(response=>{
                         if(!response.data.Errors){
                             store.lastCount = response.data.result_count;
                             store.results = response.data.results;
                         }else if(response.data.Errors.length > 0){
                             store.errorMsg = response.data.Errors[0].description;
                         }
                         store.isLoading=false;
                     });
            }
        }
    }
</script>
