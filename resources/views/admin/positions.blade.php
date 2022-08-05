@extends('admin-layout')
{{--    <body>--}}



@section('admin-main')
    @if($errors->any())
        <script>alert( '{{$errors->first()}}')</script>
    @endif
    {{--    {{$ab->name}}--}}
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Действия</th>

        </tr>
        </thead>
        <tbody>
        @foreach($position as $ab)
            <tr>
                <td> {{$ab->name}}  </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd-{{$ab->id}}" aria-expanded="false" aria-controls="collapseAdd{{$ab->id}}">
                        Изменить
                    </button>
                    <div class="collapse" id="collapseAdd-{{$ab->id}}">
                        <div class="card card-body">
                            <form action="{{ route('position.update', $ab->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUt')
                                @csrf
                                <input type="text"  name="name" placeholder="Введите стационарный номер">
                                <input type="submit" value="ok">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{route('position.destroy', $ab->id)}}" method="post" enctype="multipart/form-data">
                        @method('Delete')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Удалить">
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
            <form action="{{ route('position.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text"  name="name" placeholder="Введите должность">
                <input type="submit" value="ok">
            </form>
        </div>
    </div>
@endsection


