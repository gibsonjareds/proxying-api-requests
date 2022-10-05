<template>
    <section class="row justify-content-center search-fields">
        <div class="col-md-8 accordion open card" id="accordionForm">
            <div class="accordion-item">
                <h3 class="accordion-header" id="formCollapse">
                    <button class="text-body accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#searchForm" aria-controls="searchForm">
                        Search Registry
                    </button>
                </h3>
                <form class="accordion-collapse fields-form row g-3 collapse show" aria-labeledby="formCollapse" data-bs-parent="#accordionForm" id="searchForm" action="" v-on:submit.prevent="search">
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name</label>
                            <input v-model="store.first_name" type="text" name="first_name" id="first_name" class="form-control" placeholder="John" />
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input v-model="store.last_name" type="text" name="last_name" id="last_name" class="form-control" placeholder="Doe" />
                        </div>
                        <div class="col-md-4">
                            <label for="number" class="form-label">NPI Number</label>
                            <input v-model="store.number" type="number" name="number" id="number" class="form-control" placeholder="0123456789" max="9999999999" />
                        </div>
                        <div class="col-md-12">
                            <label for="taxonomy_description" class="form-label">Taxonomy Description</label>
                            <input v-model="store.taxonomy_description" type="text" name="taxonomy_description" id="taxonomy_description" placeholder="Internal Medicine" class="form-control" form-control/>
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input v-model="store.city" type="text" name="city" id="city" class="form-control" placeholder="New York" />
                        </div>
                        <div class="col-md-2">
                            <label for="state" class="form-label">State</label>
                            <input v-model="store.state" type="text" name="state" id="state" class="form-control" placeholder="NY">
                        </div>
                        <div class="col-md-4">
                            <label for="postal_code" class="form-label">Zip Code</label>
                            <input v-model="store.postal_code" type="text" name="postal_code" id="postal_code" class="form-control" placeholder="11201">
                        </div>
                        <input type="hidden" name="page" id="page" v-model="store.page">
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
    import {store} from "../store";
    export default {
        data() {
            return {
                store: store.params
            }
        },
        methods:{
            search: (e) =>{
                e.preventDefault();
                store.errorMsg='';
                axios.get('/api/npi-registry/', {params:store.params})
                .then(response=>{
                    if(!response.data.Errors){
                        store.lastCount = response.data.result_count;
                        store.results = [...store.results, ...response.data.results];
                    }else if(response.data.Errors.length > 0){
                        store.errorMsg = response.data.Errors[0].description;
                    }
                    console.log(store);
                });
                return false;
            }
        }
    }
</script>
