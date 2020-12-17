<template>
    <tr class="item">
        <td> {{item.name}} </td>
        <td> {{item.cpf}} </td>
        <td> {{item.birthdate}} </td>
        <td> {{item.phone}} </td>
        <button data-toggle="modal" data-target="#myModal" @click="editItem(item.id)">
            <font-awesome-icon icon="edit" />
        </button>
        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="trash" />
        </button>
    </tr>
</template>

<script>
import modal from './modal'

export default {
    props: ['item'],
    components: {
        modal
    },
    methods: {
        editItem(id) {
            axios.get('customers/' + this.item.id)
            .then( response => {
                console.log(response)
            })
            .catch( error => {
                console.log(error);
            })
            console.log('edit' + id);
        },
        removeItem() {
            axios.delete('customers/' + this.item.id)
            .then( response => {
                if( response.status == 200 ) {
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                console.log(error);
            })
        }
    }
}
</script>