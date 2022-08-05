@extends('admin-layout')

@section('admin-main')
    @if($errors->any())
        <script>alert( '{{$errors->first()}}')</script>
    @endif
    <table class="table">
        <tr>
            <th>Номер</th>
            <th scope="col">Действия</th>
        </tr>

        @foreach($tel as $tel)
            <tr>
                <td>
                    {{$tel->name}}
                </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd-{{$tel->id}}" aria-expanded="false" aria-controls="collapseAdd{{$tel->id}}">
                        Изменить
                    </button>
                    <div class="collapse" id="collapseAdd-{{$tel->id}}">
                        <div class="card card-body">
                            <form action="{{ route('mobile-tel.edit', $tel->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text"  name="tel" placeholder="Введите стационарный номер">
                                <input type="submit" value="ok">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{route('mobileTel.destroy', $tel->id)}}" method="post" enctype="multipart/form-data">
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
            <form action="{{ route('mobile-tel.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text"  name="tel" placeholder="Введите стационарный номер">
                <input type="submit" value="ok">
            </form>
        </div>
    </div>
@endsection

