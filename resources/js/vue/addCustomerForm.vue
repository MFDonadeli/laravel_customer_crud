<template>
    <div class="addCustomerForm">
        <p><input type="text" v-model="item.name" placeholder="Digite o nome completo" name="name" id="name"></p>
        <p><input type="text" v-model="item.cpf" placeholder="Digite o cpf" name="cpf" id="cpf"></p>
        <p><input type="date" v-model="item.birthdate" name="birthdate" id="birthdate"></p>
        <p><input type="tel" v-model="item.phone" placeholder="Digite o telefone" name="phone" id="phone"></p>
        <button 
            @click="addItem()"
            :class="[ item.name ? 'active' : 'inactive']">Add Customer</button>
    </div>
</template>

<script>
export default {
    props: ['edititem'],
    data: function () {
        return {
            item: {
                name: ''
            }
        }
    },
    watch: { 
      	edititem: function(newVal, oldVal) { // watch it
          this.item.id = newVal.id
          this.item.name = newVal.name
          this.item.cpf = newVal.cpf
          this.item.birthdate = newVal.birthdate
          this.item.phone = newVal.phone
        }
      },
    methods: {
        //Add or update the customer
        addItem() {
            if( this.item.name == '' ) {
                return;
            }
            
            const json_item = JSON.stringify(this.item);
            console.log(json_item);

            //if it has customer id, so it means that is update, so we send put to endpoint /customer
            if(this.item.id) {
                axios.put('customers/'+this.item.id, {
                    item: json_item
                })
                .catch( error => {
                    console.log(error);
                })
            }
            else {
                axios.post('customers', {
                    item: json_item
                })
                .then( response => {
                    if( response.status == 200 ) {
                        this.item.name = "";
                        this.item.cpf = "";
                        this.item.phone = "";
                        this.item.birthdate = "";
                    }
                })
                .catch( error => {
                    console.log(error);
                })
            }
            
        }
    },

}
</script>