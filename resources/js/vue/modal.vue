<template>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" @click="reloadList()">&times;</button>
                <h4 class="modal-title">Cadastrar Novo Cliente</h4>
            </div>
            <div class="modal-body">
                <addCustomerForm :edititem="edititem">
                </addCustomerForm>
            </div>
        </div>

    </div>
</template>

<script>
import addCustomerForm from './addCustomerForm'

export default {
    model: {
        prop: 'props'
    },
    props: ['edititem'],
    components: {
        addCustomerForm
    },
    methods: {
        reloadList() {
            this.$emit('reloadList')
        }
    }
}
</script>