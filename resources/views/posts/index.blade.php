@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="{{route('posts.create')}}" class="btn btn-success">Add Posts</a>

</div>

<div class="card card-default">
    <div class="card-header">Posts
    </div>
    <div class="card-body">
@if ($posts->count()>0)
            <table class="table">
            <thead>

             <th>Image</th>
             <th>Title</th>
             <th>Category</th>
             <th>Edit</th>
             <th>Delete</th>
            </thead>

            <tbody>

           @foreach ($posts as $post)
           <tr>
               <td>
                <img src="{{asset("/storage/".$post->image)}}" width="60px" hight="60px" alt="$post->title">
                </td>


               <td>
                   {{$post->title}}
                </td>
                <td>
                    <a href="{{route("categories.edit",$post->category->id)}}">{{$post->category->name}}</a>

                </td>

                @if ($post->trashed())
   <td>
       <form action="{{route('restore-posts',$post->id)}}" method="POST">

        @csrf

        @method('PUT')


                    <button class="btn btn-primary btn-sm"  type="submit">Restore</button>
               </form>
                </td>
                @else
   <td>

       <form action="{{route('posts.edit',$post->id)}}">
                    <button class="btn btn-danger btn-sm" >Edit</button>
               </form>

                </td>
                @endif

                <td>
                    <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger btn-sm" > {{$post->trashed()?'Delete':'Trash'}} </button>
                    </form>
                </td>
            </tr>



           @endforeach

            </tbody>

        </table>


@else
<h3 class="text-center">NO POSTS YET</h3>

@endif

    </div>
</div>


@endsection
