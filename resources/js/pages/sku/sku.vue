<script setup>
import axios from 'axios';
import {ref,onMounted} from 'vue';

let sku = ref([]);
const getSku = () =>{
axios.get('/api/sku')
.then((response)=>{
    sku.value = response.data
    console.log(sku.value)
   
})

}
onMounted(()=>{
    getSku();
});

</script>

<template>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item">SKU</li>
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
<h3 class="card-title">SKU</h3>
</div>

<div class="card-body">
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Unit Price</th>
            <th>Is Active?</th>
            <th>Image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(s,index) in sku" :key="s.id"> 
            <td>{{ index+1 }}</td>
            <td>{{s.Name}}</td>
            <td>{{s.Code}}</td>
            <td>{{s.UnitPrice}} </td>
            <td>{{s.IsActive ? "Yes": "No"}}</td>
            <td>{{s.Image}}</td>
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