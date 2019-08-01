@extends('layouts.app')

@section('content')
<div class="card card-default">
<div class="d-flex justify-content-end mb-2">
<a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>

</div>

<div class="card-header">Categories</div>
<div class="card-body">
  @if ($categories->count()>0)


    <table class="table">
<thead>
    <th>Name</th>
    <th>Post Count</th>
</thead>
<tbody>
@foreach ($categories as $category)
    <tr>
       <td>{{$category->name}}</td>
       <td>{{$category->posts->count()}}</td>
       <td>
           <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
       </td>
       <td>
           <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
           {{-- <a href="{{route('categories.destroy',$category->id)}}" class="btn btn-danger">delete</a> --}}
       </td>
    </tr>
@endforeach

</tbody>
</table>

 @else
<h3 class="text-center"> NO CATEGORIES YET</h3>
  @endif

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form action="" method="POST" id="deleteCategoryForm">
    @csrf

    @method('DELETE')
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Do you want delete this ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
    </div>

    </div>
  </div>
</div>
</form>
  </div>
</div>
@endsection
@section('scripts')

<script>
function handleDelete(id)
{

    var form= document.getElementById('deleteCategoryForm')
   form.action = '/categories/'+id

    // console.log('deleting',form)
    $('#deleteModal').modal('show')


}


</script>
@endsection
