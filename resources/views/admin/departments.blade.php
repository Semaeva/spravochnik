@extends('admin-layout')
{{--    <body>--}}



@section('admin-main')
    <h2>Министерства </h2>
    @if($errors->any())
        <script>alert( '{{$errors->first()}}')</script>
    @endif
    <nav class="navbar navbar-light bg-light">
        <form class="container-fluid justify-content-start">
            <a class="btn btn-outline-success me-2" href="{{route('departments.index')}}">Активные</a>
            <a class="btn btn-outline-success me-2" href="{{route('inActive')}}">Неактивные</a>
        </form>
    </nav>
    {{--    {{$ab->name}}--}}
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Действия</th>

        </tr>
        </thead>
        <tbody>
        @foreach($ids  as $ab)
            {{--            @foreach($ab->departments as $u)--}}
            {{--    {{$u->name}}--}}
            {{--@endforeach--}}
            <tr>

                <td>  {{$ab->departments->name}} </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd-{{$ab->departments->id}}" aria-expanded="false" aria-controls="collapseAdd{{$ab->departments->id}}">
                        Изменить
                    </button>
                    <div class="collapse" id="collapseAdd-{{$ab->departments->id}}">
                        <div class="card card-body">
                            <form action="{{ route('departments.update', $ab->departments->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUt')
                                @csrf
                                <input type="text"  name="name" placeholder="Введите наименование">
                                <input type="submit" value="ok">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{route('departments.destroy', $ab->departments->id)}}" method="delete" enctype="multipart/form-data">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Удалить"  disabled>
                    </form>
                </td>
            </tr>
        @endforeach
        {{--        @endforeach--}}
    </table>

    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd" aria-expanded="false" aria-controls="collapseAdd">
        Добавить
    </button>
    <div class="collapse" id="collapseAdd">
        <div class="card card-body">
            <form action="{{ route('departments.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text"  name="name" placeholder="Введите наименование">
                <input type="submit" value="ok">
            </form>
        </div>
    </div>
@endsection


