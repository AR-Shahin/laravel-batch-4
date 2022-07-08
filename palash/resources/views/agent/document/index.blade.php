
@extends('layouts.agent_master')
@section('title', 'Document')
@section('master_content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="text-info">Manage Document</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Document</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                <tbody id="tbody"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h2 class="text-info">Add Document</h2>
            </div>
            <div class="card-body">
                <form id="adddocumentForm">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter document Name">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea  class="form-control" id="description"  id="" cols="30" rows="10"></textarea>
                        <span class="text-danger" id="descriptionError"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Document</label>
                        <input type="file" class="form-control" id="image">
                        <span class="text-danger" id="imageError"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block">Add New Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit document</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="editForm">

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- View Modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="viewData">

        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')

<script>
    function getAllData(){
        axios.get("{{ route('agent.document.get-all-data') }}")
        .then((res) => {

            table_data_row(res.data)

        })
    }
    getAllData();

    function table_data_row(items) {
        let loop =  items.map((item,index) => {
            return `
            <tr>
                <td>${++index}</td>
                <td>${item.name}</td>

                <td><img src="{{ asset('${item.image}') }}" width="80px"></td>
                <td>  <a href="{{ asset('${item.image}') }}">Document</a></td>
                <td class="text-center">
                    <a href="" class="btn btn-sm btn-success" data-id="${item.id}" data-toggle="modal" data-target="#viewModal" id="viewRow"><i class="fa fa-eye"></i></a>
                    <a href="" class="btn btn-sm btn-info" data-id="${item.id}" data-toggle="modal" data-target="#editModal" id="editRow"><i class="fa fa-edit"></i></a>
                    <a href="" id="deleteRow" class="btn btn-sm btn-danger" data-id="${item.id}"><i class="fa fa-trash-alt"></i></a>
                </td>
            </tr>
            `
        });
        loop = loop.join("")
        const tbody = $$('#tbody')
        tbody.innerHTML = loop

 }

 // store
 $('body').on('submit','#adddocumentForm',function(e){
    e.preventDefault();
    let name = $('#name');
    let nameError = $('#nameError');

    let description = $('#description');
    let descriptionError = $('#descriptionError');

    let image = $('#image');
    let imageError = $('#imageError');
    nameError.text('');
    imageError.text('');
    if(name.val() === ''){
        nameError.text('Field Must not be Empty!')
        return null;
    }

    if(description.val() === ''){
        descriptionError.text('Field Must not be Empty!')
        return null;
    }

    const data = new FormData();
    data.append('name',name.val());
    data.append('description',description.val());
    data.append('image', document.getElementById('image').files[0]);
    const config = { headers: { 'Content-Type': 'multipart/form-data' } };
    //  console.log(image.files[0]);
    //  return
    axios.post("{{ route('agent.document.store') }}",data)
    .then((res) => {
        getAllData();
        setSuccessMessage();
        name.val('');
        name.val('');
        description.val(null)
    })
    .catch((err)=>{
       if(err.response.data.errors.name){
           nameError.text(err.response.data.errors.name[0])
       }
       if(err.response.data.errors.description){
            descriptionError.text(err.response.data.errors.description[0])
       }
       if(err.response.data.errors.image){
           imageError.text(err.response.data.errors.image[0])
       }
    })
 })


 // delete

$('body').on('click','#deleteRow',function(e){
    e.preventDefault()
    let id = $(this).attr('data-id');
    const url = `${window.location.origin}/agent/document/delete/${id}`;
    log(url)
    console.log(url);
    deleteDataWithAlert(url,getAllData);
})


// view
$('body').on('click','#viewRow',function(){
    let id = $(this).data('id');
    let url = `${window.location.origin}/agent/document/${id}`
    log(url)
    axios.get(url)
    .then(res=> {
        let {data:document} = res
        log(res)
        let viewData = $$('#viewData');
        viewData.innerHTML = `
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>${document.name}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src="{{ asset('${document.image}') }}" width="100px" alt=""></td>
            </tr>
            <tr>
                <th>Document</th>
                <td> <a href="{{ asset('${document.image}') }}">Document</a></td>
            </tr>
        </table>
        `
    });
});

// edit
$('body').on('click','#editRow',function(){
    let id = $(this).data('id');
    let url = `${base_url_admin}/document/${id}`;
    axios.get(url).then(res => {
        let {data} = res;
        let form = $$('#editForm');
        form.innerHTML = `<div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="edit_name" value="${data.name}">
                <input type="hidden" id="edit_id" value="${data.id}">
                <span class="text-danger" id="editNameError"></span>
            </div>
            <div class="form-group">
                <label for=""> Image</label>
                <input name="image" type="file" class="form-control" id="editImage">
                <span class="text-danger" id="imageEditError"></span> <br>
                <img src="{{ asset('${data.image}') }}" alt="" width="100px" class="mt-3">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Update</button>
            </div>
            `
    }).catch(err => {
        console.log(err);
    })
})

// update
$('body').on('submit','#editForm',function(e){
    e.preventDefault()
    let id = $('#edit_id').val();
    let url = `${base_url_admin}/document/${id}`;
    let editImage = $('#editImage');
    let editName = $('#edit_name')

    let editNameError = $('#editNameError')
    let imageEditError = $('#imageEditError')
    editNameError.val("")
    imageEditError.val("")
    if(editImage.val()){
        const data = new FormData();
        data.append('name',editName.val());
        data.append('image', document.getElementById('editImage').files[0]);
        // log(data.get('image'))
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };

        axios.post(url,data).then(res => {
            getAllData();
            setSuccessMessage('Data Update Successfully!')
            $('#editModal').modal('toggle')
        }).catch(err => {
            if(err.response.data.errors.image){
            imageEditError.text(err.response.data.errors.image[0])
       }
        })
    }else{
        sendUpdateAjaxRequest(url,{name: editName.val()}).then(res => {
            getAllData();
            setSuccessMessage('Data Update Successfully!')
            $('#editModal').modal('toggle')
        }).catch(err => {
            if(err.response.data.errors.name){
                editNameError.text(err.response.data.errors.name[0])
       }
        })
    }
})
const sendUpdateAjaxRequest = (url,data) => {

    return axios.post(url,data);
}
</script>
@endpush
