
@section('content')

@extends('layouts.app')

<div class="card card-default">
    <div class="card-header">Users
    </div>
    <div class="card-body">
@if ($users->count()>0)
            <table class="table">
            <thead>

            <th>image</th>
             <th>Name</th>
             <th>Email</th>
             <th>Make Admin</th>
             <th>Delete</th>
            </thead>

            <tbody>

           @foreach ($users as $user)
           <tr>
               <td>
                   {{-- src="{{ asset('/img/avatar/' . $avatar) }}" --}}

 <img  width="40px" height="40px" class="rounded-circle" src="{{Gravatar::src($user->email ) }}" alt="">

               </td>

               <td>
                   {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if (!$user->isAdmin())
                 <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm" >Make Admin</button>
                    </form>
                    @endif

                </td>
            </tr>



           @endforeach

            </tbody>

        </table>


@else
<h3 class="text-center">NO USERS YET</h3>

@endif

    </div>
</div>


@endsection
