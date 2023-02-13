<script setup>
import axios from 'axios';
import {ref, onMounted, reactive} from 'vue';


computed :{

}

let total = ref(0);
let customers = ref([]);
// let quantity = ref([]);
let skus = ref([]);
let table= ref([]);

let Subtotal = [];
let quantity = [];

const addtoOrders = (id) =>{
   
    let item = skus.value.find(item => item.id === id);
    item.quantity = 0;
    skus.value = skus.value.filter(p => p.id !== id);
    table.value.push(item)
    console.log(table.value)
    
}
let getTotal =() =>{
   const reduced = Object.values(table.value).reduce((t, {Subtotal}) => t + Subtotal, 0)
   total.value = reduced;
   console.log(reduced)
}
const removeOrders = (id) =>{
   
   let item = table.value.find(item => item.id === id);
   table.value = table.value.filter(p => p.id !== id);
   skus.value.push(item)
   console.log(skus.value)
}


const getCustomers = async () =>{
axios.get('/api/customer')
.then((response)=>{
    customers.value = response.data
    
});
}



const getSKU = () =>{
axios.get('/api/sku')
.then((response)=>{
    skus.value = response.data
   
   
})

}

const addItem = () =>{
    $("#add-item").modal('show');
}
const form = reactive({
    CustomerID : '',
    DateOfDelivery : '',
    Status : '',
    AmountDue : '',
    purchaseItems: {

    }
    

});
const createPO = ()=> {
    form.AmountDue = total;
    form.purchaseItems = table.value;
    axios.post('/api/purchaseorder',form)
    .then((response)=>{
       
        form.DateOfDelivery ='';
        form.AmountDue ='';
     
      
    }).catch((error)=>{
    console.log(error);
    window.alert(error);
  });  
}

onMounted(()=>{
    getCustomers();
    getSKU();

});

</script>
<template>

<div class="content-header">
    <div class="container-fluid">
        <!-- <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item">Order Taking</li>
                <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
            <div class="col-sm-1 offset-sm-5">
            </div>
        </div> -->
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order Taking</h3>
            </div>

<div class="card-body">
    <form>
        <div class="row ">
            <div class="col-sm-6 ">
                <div class="form-group">
                    <label for="lblCustomer">Customer</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <select v-model="form.CustomerID" class="form-control">
                   <option v-for="(customer,index) in customers" :key="customer.id" :value="customer.id">
                    {{ customer.FullName }}
                    </option> 
                </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="lblDeliveryDate">Delivery Date</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input v-model="form.DateOfDelivery" type="date" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="lblDeliveryDate">Status</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <select v-model="form.Status" class="form-control">
                   <option value="New">New</option> 
                   <option value="Completed">Completed</option> 
                   <option value="Cancelled">Cancelled</option> 
                </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button type="button" @click="addItem()" class="btn btn-block btn-success float-sm-right">  <i class="nav-icon fa fa-plus"></i> Add Item</button>
                <div class="modal fade modal-lg" id="add-item">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                           
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm mt-3">
            <thead>
            <tr>
            <th style="width: 10px">#</th>
            <th>SKU</th>
          
            <th>Price</th>
        
          
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(sku,index) in skus" :index="sku.id"> 
            <td >{{index + 1}}</td>
            <td>{{sku.Name}}</td>
          
            <td>{{sku.Price}}</td>
           
          
            <td><button @click="addtoOrders(sku.id)" type="button" class="btn btn-block btn-primary">  <i class="nav-icon fa fa-plus"></i></button></td>
        </tr>

    </tbody>
   
</table>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered mt-3">
            <thead>
            <tr>
            <th style="width: 10px">#</th>
            <th>SKU</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>  
          
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-if="table.length ==0">
            <td colspan="6">No items yet</td>
        </tr>
        <tr v-for="(tbl,index) in table" :key="tbl.id">
            <td>{{ index + 1 }}</td>
            <td>{{ tbl.Name }}</td>
            <td><input @change="getTotal(tbl.Subtotal)" v-model="tbl.quantity" class="form-control qty" type="number"></td>
            <td>{{tbl.UnitPrice}}</td>
           <td>{{ tbl.Subtotal = tbl.quantity * tbl.UnitPrice }}</td>
          
            <td><button @click="removeOrders(tbl.id)" type="button" class="btn btn-block btn-danger">  <i class="nav-icon fa fa-trash"></i></button></td>
        </tr>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">Total Amount</td>
            <td colspan="2"><input type="number" v-model="total" disabled></td>
        </tr>
    </tfoot>
</table>
        </div>
       
      
       
    </form>

</div>
<div class="card-footer">
    <button @click="createPO" type="button" class="btn btn-primary ">Submit</button>
</div>


</div>
        </div>
    </div>
    
    
    </template>