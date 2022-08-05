@extends('admin-layout')
{{--    <body>--}}



@section('admin-main')
    <h2>Министерства в резерве</h2>
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

          @foreach($dep as $ab)
              <tr>
                  <td>  {{$ab->name}}</td>
                  <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd-{{$ab->id}}" aria-expanded="false" aria-controls="collapseAdd{{$ab->id}}">
                        Изменить
                    </button>
                    <div class="collapse" id="collapseAdd-{{$ab->id}}">
                        <div class="card card-body">
                            <form action="{{ route('departments.update', $ab->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUt')
                                @csrf
                                <input type="text"  name="name" placeholder="Введите наименование">
                                <input type="submit" value="ok">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{route('departments.destroy', $ab->id)}}" method="post" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Удалить" >
                    </form>
                </td>
            </tr>
        @endforeach
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


