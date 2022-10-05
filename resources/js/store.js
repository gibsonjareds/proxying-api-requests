import {reactive} from 'vue';

export const store = reactive({
    params:{
        page:1,
        first_name:'',
        last_name:'',
        number:'',
        taxonomy_description:'',
        city:'',
        state:'',
        postal_code:''
    },
    results:[],
    last_count:50,
    errorMsg:''
});
