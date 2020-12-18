<template>
    <div class="customerListContainer">
        <h2>Lista de Clientes!</h2>
        <!-- Search area and add new button -->
        <input type="text" v-model="txtsearch" name="txtsearch" id="txtsearch">
        <button @click="searchCustomer()">
             <font-awesome-icon icon="search" />
        </button>   
        <button @click="addNewCustomer()">
            Adicionar novo cliente
        </button>
        
        <!--List with all customers, input: items from /customer endpoint
            and also loadItems to be edited when edit button is clicked -->
        <list-view 
            :items="items"
            v-on:reloadList="getList()"
            />

        <!-- Modal dialog that contains the form inside -->
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
            edititem: [],
            txtsearch: ''
        }
    },
    methods: {
        //get List of customers from /customers endpoint
        getList() {
            axios.get('customers')
            .then( response => {
                this.items = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        //start search of customer by name or cpf from /search endpoint
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
        },
        //this function has the intention to fill the form when edit button is clicked
        loadItems(i) {
            this.edititem = i;
            $('#myModal').modal('show')
        },
        //load the modal with form inside to add a new customer
        addNewCustomer() {
            $('#myModal').modal('show')
        }
    },
    //after creation get list of customers
    created() {
        this.getList();
    }    
}
</script>
