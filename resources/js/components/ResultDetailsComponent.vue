<template>
    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" :data-bs-target="appendNumber('#modal', result.number)">
            {{ formatName(result) }}
    </button>
    <div class="modal" :id="getId(result.number)" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h6>{{formatName(result)}}</h6>
                        <h6>Gender: {{result.basic.gender}}</h6>
                        <span>NPI: {{result.number}}</span>
                        <span>Last Updated: {{result.basic.last_updated}}</span>
                        <span>Certification Date: {{result.basic.last_updated !== result.basic.enumerated_at ? result.basic.last_updated : "-"}}</span>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="key in Object.keys(formattedResult)">
                                <th>{{key}}</th>
                                <td style="white-space:pre;">{{formattedResult[key]}}</td>
                            </tr>
                            <tr>
                                <th>Taxonomy</th>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <th scope="col">
                                                Primary Taxonomy
                                            </th>
                                            <th scope="col">
                                                Selected Taxonomy
                                            </th>
                                            <th scope="col">
                                                State
                                            </th>
                                            <th scope="col">
                                                License Number
                                            </th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="tax in result.taxonomies" >
                                                <td>{{tax.primary ? "Yes": "No"}}</td>
                                                <td>{{tax.code + " - " +tax.desc}}{{tax.taxonomy_group.length > 0 ? " (" + tax.taxonomy_group+ ")":""}}</td>
                                                <td>{{tax.state}}</td>
                                                <td>{{tax.license}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {store} from "../store";

    export default {
        props:["result"],
        data(){
            return{
                store,
                formattedResult: this.formatResult(this.result)
            };
        },
        methods:{
            getId(number){
                return `modal${number}`
            },
            formatResult(result){
                let formattedResult = {};
                formattedResult["NPI"] = result.number;
                formattedResult["Enumeration Date"] = result.basic.enumeration_date;
                formattedResult["NPI Type"] = result.enumeration_type;
                formattedResult["Sole Proprietor"] = result.basic.sole_proprietor;
                formattedResult["Status"] = result.basic.status;
                formattedResult["Mailing Address"] = this.getAddress(result.addresses,'MAILING', 'DOM');
                formattedResult["Primary Practice Address"] = this.getAddress(result.addresses, 'LOCATION', 'DOM');

                return formattedResult;
            },
            getAddress(addresses, purpose, address_type){
                let address = addresses.filter(addr => addr.address_purpose === purpose && addr.address_type === address_type)[0] ?? null;
                let addressStr = '';
                if (address){
                    addressStr += address.address_1 + " " + address.address_2 + "\n";
                    addressStr += address.city + ", " + address.state + " " + address.postal_code.substring(0,5) +"-"+ address.postal_code.substring(5) +"\n";
                    addressStr += address.country_name + "\n\n";

                    addressStr += "Phone: " + (address.phone_number ?? "-") + " | Fax: " + (address.fax_number ?? "-");
                }
                return addressStr;
            },
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
            },
            appendNumber(prop, number){
                return[
                    `${prop}${number}`
                ]
            }
        }
    }
</script>
