<template>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" @click="$emit('reloadList')">&times;</button>
                <h4 class="modal-title">Cadastrar Novo Cliente</h4>
            </div>
            <div class="modal-body">
                Item: {{item}}
                <addCustomerForm>
                </addCustomerForm>
            </div>
        </div>

    </div>
</template>

<script>
import addCustomerForm from './addCustomerForm'

export default {
    model: {
        prop: 'props',
        event: 'modalopen'
    },
    props: ['item'],
    components: {
        addCustomerForm
    } 
}
</script>