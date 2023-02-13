<script setup>
import axios from 'axios';
import {ref, onMounted, reactive} from 'vue';
// var req = axios.get('/api/customer')
// .then(response => this.data = response.data);
// req.then(x => console.log("Done!"));
let purchaseorder = ref([]);
// const getPurchaseOrder = () =>{
// axios.get('/api/purchaseorder')
// .then((response)=>{
//     purchaseorder.value = response.data
//     console.log(purchaseorder.value)
    
   
// })

// }

const getPurchaseOrder = async () =>{
axios.get('/api/purchaseorder')
.then((response)=>{
    purchaseorder.value = response.data
    console.log(purchaseorder.value)
    
});
}
onMounted(()=>{
    getPurchaseOrder();
});


</script>


<template>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item">Purchase Order</li>
                <li class="breadcrumb-item active">Home</li>
                </ol>
                </div>
                <div class="col-sm-1 offset-sm-5">
                    <router-link to="/createorder" class="btn btn-block btn-success float-sm-right">  <i class="nav-icon fa fa-plus"></i> Create</router-link>
                
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
<div class="card-header">
<h3 class="card-title">Purchase Orders</h3>
</div>

<div class="card-body">
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Customer</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Amount Due</th>
          
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(orders,index) in purchaseorder" :key="orders.id"> 
            <td>{{index + 1}}</td>
            <td>{{orders.fullname}}</td>
            <td>{{orders.DateOfDelivery}}</td>
            <td>{{orders.Status}} </td>
            <td>{{orders.AmountDue}}</td>
          
            <td><button type="button" class="btn btn-block btn-primary">  <i class="nav-icon fa fa-edit"></i>Edit</button></td>
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