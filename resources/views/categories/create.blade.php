@extends('layouts.app')

@section('content')
<div class="card card-default">
 <div class="card-header">
     {{isset($category)?'Edit Category':'Create Category'}}</div>
   <div class="card-body">
     @include('partial.errors')
       <form action="{{isset($category)?route('categories.update',$category->id):route('categories.store')}}" method="POST">
           @csrf
           @if (isset($category))
             @method('PUT')
           @endif
        <div class="form-group">

               <label for="name">Name</label>
              <input type="text" id="name" class="form-control" name="name" value="{{isset($category)?$category->name:''}}">
           </div>

             <button class="btn btn-success"> {{isset($category)?'update Category':'Create Category'}}</div>
</button>

       </form>
   </div>
</div>



@endsection




