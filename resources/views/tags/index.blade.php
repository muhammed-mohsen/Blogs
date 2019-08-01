@extends('layouts.app')

@section('content')
<div class="card card-default">
<div class="d-flex justify-content-end mb-2">
<a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>

</div>

<div class="card-header">Tags</div>
<div class="card-body">
  @if ($tags->count()>0)


    <table class="table">
<thead>
    <th>Name</th>
    <th>Post Count</th>
    <th>Edit</th>
    <th>Delete</th>
</thead>
<tbody>
@foreach ($tags as $tag)
    <tr>
       <td>{{$tag->name}}</td>
       <td>{{$tag->posts->count()}}</td>
       <td>
           <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary">Edit</a>
       </td>
       <td>
           <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
           {{-- <a href="{{route('tags.destroy',$tag->id)}}" class="btn btn-danger">delete</a> --}}
       </td>
    </tr>
@endforeach

</tbody>
</table>

 @else
<h3 class="text-center"> NO tags YET</h3>
  @endif

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form action="" method="POST" id="deletetagForm">
    @csrf

    @method('DELETE')
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
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

    var form= document.getElementById('deletetagForm')
   form.action = '/tags/'+id

    // console.log('deleting',form)
    $('#deleteModal').modal('show')


}


</script>
@endsection
