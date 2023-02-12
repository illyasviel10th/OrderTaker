<script setup>
import axios from 'axios';
import {ref,onMounted} from 'vue';
// var req = axios.get('/api/customer')
// .then(response => this.data = response.data);
// req.then(x => console.log("Done!"));
let customers = ref([]);
const getCustomers = () =>{
axios.get('/api/customer')
.then((response)=>{
    customers.value = response.data
    
   
})

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
                <div class="col-sm-6">
                   
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
            <td>{{ customer.isActive }}</td>
            <td><button type="button" class="btn btn-block btn-primary">  <i class="nav-icon fa fa-edit"></i></button></td>
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