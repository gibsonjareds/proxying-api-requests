<template>
    <section class="row justify-content-center">
        <ul class="col-md-8">
            <li v-for="result in store.results">
                {{ formatName(result) }}
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
        },
        methods:{
            formatName(result){
                let basic = result.basic;
                let name = ' ';
                name += basic.name_prefix && basic.name_prefix !== '--' ? basic.name_prefix : '';
                name += ' ';
                name+=  basic.first_name;
                name+= ' ';
                name+= basic.middle_name ?? '';
                name+= ' ';
                name += basic.last_name;
                name += ' ';
                name+= basic.name_suffix  && basic.name_suffix !== '--'? basic.name_suffix :'';
                return name.toUpperCase()
            }
        }
    }
</script>
