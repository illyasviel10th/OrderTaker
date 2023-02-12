<script setup>
import axios from 'axios';
import {ref, onMounted, reactive} from 'vue';
// var req = axios.get('/api/customer')
// .then(response => this.data = response.data);
// req.then(x => console.log("Done!"));
let customers = ref([]);
const editing = ref(false);
const formValues = ref();



const addCustomer = () =>{
    editing.value = false;
    form.id ='';
    form.FirstName ='';
    form.LastName ='';
    form.MobileNumber ='';
    form.City ='';
    form.IsActive='';
    $("#customer-form").modal('show');
}

const form = reactive({
    id : '',
    FirstName : '',
    LastName : '',
    MobileNumber : '',
    City : '',

});


const findCustomer = async (id) =>{
editing.value = true;
axios.get('/api/customer/'+id)
.then((response)=>{
    form.id = response.data.id;
    form.FirstName = response.data.FirstName;
    form.LastName = response.data.LastName;
    form.MobileNumber = response.data.MobileNumber;
    form.City = response.data.City;
    form.IsActive = response.data.IsActive;
    $("#customer-form").modal('show');
    
   
})


}
const updateCustomer = (id) =>{
  axios.put('api/customer/'+id,form)
  .then((response)=>{
    const index = customers.value.findIndex(customer => customer.id === response.data.id);
    customers.value[index] = response.data;
    console.log(customers.value[index])
    console.log(index)
    

  }).catch((error)=>{
    console.log(error);
  }).finally(()=>{
    editing.value= false;
    form.id ='';
    form.FirstName ='';
    form.LastName ='';
    form.MobileNumber ='';
    form.City ='';
    $("#customer-form").modal('hide');
  })

}

const createCustomer = ()=> {
    form.FullName = form.FirstName + ' ' + form.LastName;
    axios.post('/api/customer',form)
    .then((response)=>{
        customers.value.unshift(response.data);
        form.id ='';
        form.FirstName ='';
        form.LastName ='';
        form.MobileNumber ='';
        form.City ='';
        $("#customer-form").modal('hide');
    }).catch((error)=>{
    console.log(error);
  });  
}

const getCustomers = async () =>{
axios.get('/api/customer')
.then((response)=>{
    customers.value = response.data
    
});
}


onMounted(()=>{
    getCustomers();
});



// onMounted(() => {
//     getCustomers();
//     // console.log('mounted')
// });
</script>

<template>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Customer</li>
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
            <div class="col-sm-1 offset-sm-5">
                <button type="button"  @click="addCustomer()" class="btn btn-block btn-success float-sm-right">  <i class="nav-icon fa fa-plus"></i> Add</button>
            
            </div>
            <div class="modal fade" id="customer-form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 v-if="editing" class="modal-title">Edit Customer</h4>
                            <h4 v-else class="modal-title">Add Customer</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblFirstName">First Name</label>
                                            <!-- <input v-if="editing" v-model="selected.value.FirstName"  type="text" class="form-control" placeholder="Enter First Name"> -->
                                            <input v-model="form.FirstName" type="text" class="form-control" placeholder="Enter First Name">
                                             </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblLastName">Last Name</label>
                                            <!-- <input v-if="editing" v-model="selected.value.LastName"  type="text" class="form-control" placeholder="Enter Last Name"> -->
                                            <input v-model="form.LastName" type="text" class="form-control" placeholder="Enter Last name">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblMobileNumber">Mobile No.</label>
                                            <!-- <input v-if="editing" v-model="selected.value.MobileNumber"  type="number" class="form-control" placeholder="Enter Mobile No."> -->
                                            <input v-model="form.MobileNumber"  type="number" class="form-control"  placeholder="Enter mobile number">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblCity">City</label>
                                            <!-- <input v-if="editing" v-model="selected.value.City"  type="text" class="form-control" placeholder="Enter City"> -->
                                            <input v-model="form.City" type="text" class="form-control" placeholder="Enter City">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="editing">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblIsActive">Is Active?</label>
                                            <!-- <input v-if="editing" v-model="selected.value.MobileNumber"  type="number" class="form-control" placeholder="Enter Mobile No."> -->
                                            <select class="form-control" v-model="form.IsActive">
                                                <option value="1">TRUE</option>
                                                <option value="0">FALSE</option>
                                            </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button v-if="editing" @click="updateCustomer(form.id)" type="button" class="btn btn-primary">Update</button>
                            <button v-else @click="createCustomer" type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h3 class="card-title">Customers</h3>
</div>

<div class="card-body">
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Fullname</th>
            <th>Mobile No.</th>
            <th>City</th>
            <th>Is Active?</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for='(customer,index) in customers' :key='customer.id'> 
            
            <td>{{index + 1}}</td>
            <td>{{customer.FirstName}} {{ customer.LastName }}</td>
            <td>{{customer.MobileNumber}}</td>
            <td>{{customer.City}} </td>
            <td>{{ customer.IsActive ? "Yes" : "No" }}</td>
            <td><button @click.prevent="findCustomer(customer.id)" type="button" class="btn btn-block btn-primary">  <i class="nav-icon fa fa-edit"></i></button></td>
        </tr>

    </tbody>
</table>
</div>

<div class="card-footer clearfix">
<ul class="pagination pagination-sm m-0 float-right">
<li class="page-item"><a class="page-link" href="#">«</a></li>
<li class="page-item"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item"><a class="page-link" href="#">»</a></li>
</ul>
</div>
</div>
</div>
    </div>
    
    
    </template>