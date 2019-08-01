@extends('layouts.app');


@section('content')

  <div class="card card-default">
      <div class="card-header">
          {{isset($post) ? 'Update Posts':'Create Post'}}</div>
      <div class="card-body">

           @include('partial.errors')
          <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @if(isset($post))
            @method('PUT')
            @endif
           <div class="form-group">
            <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : ''}}">
        </div>
            <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id=description" cols="5" rows="5" class="form-control">{{isset($post)?$post->description:""}}</textarea>
        </div>

            <div class="form-group">
            <label for="content">Content</label>
 <input id="content" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
  <trix-editor input="content" name="content"></trix-editor>
        </div>
          <div class="form-group">
            <label for="publishe_at">Publishe_at</label>
        <input type="text" class="form-control" name="publishe_at" id="publishe_at" value="{{isset($post)?$post->published_at:''}}">
        </div>
        @if(isset($post))
            <div class="form-group">
                <img src="{{asset("/storage/".$post->image)}}" alt="" style="width:100%">
            </div>
        @endif
                <div class="form-group">
            <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image" value="{{isset($post)?$post->image:""}}">
        </div>
        <div class="form-group">

            <label for="category">Category</label>
            <select name="category" id="category" class="form-group">

            $@foreach ($categories as $category)
                <option value="{{$category->id}}"
                    @if (isset($post))

                    @if ($category->id == $post->category_id)
                    selected
                    @endif
                    @endif
                    >
                {{$category->name}}
                </option>
            @endforeach

            </select>
        </div>

        @if ($tags->count()>0)
        <div class="form-group">
       <label for="tags">Tags</label>
      <select name="tags[]" id="tags"  class="form-control  tags-selector " multiple>
      @foreach ($tags as $tag)
            <option value="{{$tag->id}}"
                @if (isset($post))
                @if ($post->hasTag($tag->id))
                    selected
                @endif

                @endif



                >{{$tag->name}}</option>
        @endforeach
</select>
        </div>
@endif



        <div class="form-group">
            <button class="btn btn-success">
                {{isset($post)?'Update':'Create'}}
            </button>
        </div>


        </form>
        </div>
      </div>
      </div>
  </div>

@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>




<script>
flatpickr("#publishe_at",{
    enableTime:true
})

$(document).ready(function() {
    $('.tags-selector').select2();
})

</script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

@endsection


