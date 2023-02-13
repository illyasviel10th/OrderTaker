<script setup>
import axios from 'axios';
import {ref,onMounted,reactive} from 'vue';

let skus = ref([]);

const editing = ref(false);

const addSKU = () =>{
    editing.value = false;
    form.id ='';
    form.Name ='';
    form.Code ='';
    form.UnitPrice =0;
    $("#sku-form").modal('show');
}

const form = reactive({
    id : '',
    Name : '',
    Code : '',
    UnitPrice : 0,

});


const findSKU = async (id) =>{
editing.value = true;
axios.get('/api/sku/'+id)
.then((response)=>{
    form.id = response.data.id;
    form.Name = response.data.Name;
    form.Code = response.data.Code;
    form.UnitPrice = response.data.UnitPrice;
    form.IsActive = response.data.IsActive;
    $("#sku-form").modal('show');
    
   
})


}
const updateSKU = (id) =>{
  axios.put('api/sku/'+id,form)
  .then((response)=>{
    const index = skus.value.findIndex(sku => sku.id === response.data.id);
    skus.value[index] = response.data;
    console.log(skus.value[index])
    console.log(index)
    

  }).catch((error)=>{
    console.log(error);
  }).finally(()=>{
    editing.value= false;
    form.id ='';
    form.Name ='';
    form.Code ='';
    form.UnitPrice =0;
    $("#sku-form").modal('hide');
  })

}

const createSKU = ()=> {
    axios.post('/api/sku',form)
    .then((response)=>{
        skus.value.unshift(response.data);
        form.id ='';
        form.Name ='';
        form.Code ='';
        form.UnitPrice =0;
        $("#sku-form").modal('hide');
    }).catch((error)=>{
    console.log(error);
  });  
}

const getSKU = () =>{
axios.get('/api/sku')
.then((response)=>{
    skus.value = response.data
    console.log(skus.value)
   
})

}

onMounted(()=>{
    getSKU();
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
               
                <div class="col-sm-1 offset-sm-5">
                <button type="button"  @click="addSKU()" class="btn btn-block btn-success float-sm-right">  <i class="nav-icon fa fa-plus"></i> Add</button>
                </div>
            <div class="modal fade" id="sku-form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 v-if="editing" class="modal-title">Edit SKU</h4>
                            <h4 v-else class="modal-title">Add SKU</h4>
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
                                            <label for="lblName">Name</label>
                                            <input v-model="form.Name" type="text" class="form-control" placeholder="Enter Name">
                                             </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblCode">Code</label>
                                            <input v-model="form.Code" type="text" class="form-control" placeholder="Enter Code">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="lblUnit Price">UnitPrice</label>
                                             <input v-model="form.UnitPrice" type="number" class="form-control" placeholder="Enter City">
                                        </div>
                                        </div>
                                    
                                    
                                        <div class="col-sm-6" v-if="editing">
                                            <div class="form-group">
                                            <label for="lblIsActive">Is Active?</label>
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
                            <button v-if="editing" @click="updateSKU(form.id)" type="button" class="btn btn-primary">Update</button>
                            <button v-else @click="createSKU" type="button" class="btn btn-primary">Save</button>
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
        <tr v-for="(sku,index) in skus" :key="sku.id"> 
            <td>{{ index+1 }}</td>
            <td>{{sku.Name}}</td>
            <td>{{sku.Code}}</td>
            <td>{{sku.UnitPrice}} </td>
            <td>{{sku.IsActive ? "TRUE": "FALSE"}}</td>
            <td>{{sku.Image}}</td>
            <td><button @click="findSKU(sku.id)" type="button" class="btn btn-block btn-primary">  <i class="nav-icon fa fa-edit"></i></button></td>
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