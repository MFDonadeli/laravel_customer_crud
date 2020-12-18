<template>
    <div>
        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th></th>
                <th></th>
            </tr>

            <tbody v-for="(item, index) in items" :key="index">
                <list-item 
                    :item="item"
                    class="item"
                    v-on:itemchanged="$emit('reloadList')"
                    v-on:editthisitem="setDataEdit(item)"
                />  
            </tbody>
        </table>
    </div>
</template>

<script>
import listItem from './listItem'

export default {
    props: ['items'],
    components: {
        listItem
    },
    methods: {
        setDataEdit(item) {
            console.log(item);
            this.$emit('modaledit', item)
        }
    }
}
</script>