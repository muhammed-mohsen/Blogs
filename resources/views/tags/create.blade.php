@extends('layouts.app')

@section('content')
<div class="card card-default">
 <div class="card-header">
     {{isset($tag)?'Edit tag':'Create Tag'}}</div>
   <div class="card-body">
@include('partial.errors')
       <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store')}}" method="POST">
           @csrf
           @if (isset($tag))
             @method('PUT')
           @endif
        <div class="form-group">

               <label for="name">Name</label>
              <input type="text" id="name" class="form-control" name="name" value="{{isset($tag)?$tag->name:''}}">
           </div>

             <button class="btn btn-success"> {{isset($tag)?'update Tag':'Create Tag'}}</div>
</button>

       </form>
   </div>
</div>



@endsection




