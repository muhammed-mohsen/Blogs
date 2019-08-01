       @if ($errors->any())
        <div class="alert alert-danger">
        @foreach($errors->all() as $item)

                <li class="list-group-item text-danger">
                    {{$item}}
                </li>

        @endforeach
        </div>
       @endif
