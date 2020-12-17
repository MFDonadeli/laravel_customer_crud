<template>
    <div class="customerListContainer">
        <h2>Lista de Clientes!</h2>
        <input type="text" v-model="txtsearch" name="txtsearch" id="txtsearch">
        <button @click="searchCustomer()">
             <font-awesome-icon icon="search" />
        </button>
        <button data-toggle="modal" data-target="#myModal">
            Adicionar novo cliente
        </button>
        <list-view 
            :items="items"
            v-on:reloadList="getList()" />

        <div id="myModal" class="modal fade" role="dialog">
            <modal></modal>
        </div>
    </div>
</template>

<script>
import listView from './listView'
import modal from './modal'

export default {
    components: {
        listView,
        modal
    },
    data: function () {
        return {
            items: [],
            txtsearch: ''
        }
    },
    methods: {
        getList() {
            axios.get('customers')
            .then( response => {
                this.items = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        searchCustomer() {
            axios.post('search', {
                name: this.txtsearch
            })
            .then( response => {
                this.items = response.data
            })
            .catch( error => {
                console.log( error );
            })
        }
    },
    created() {
        this.getList();
    } 
}
</script>