@extends('admin-layout')

@section('admin-main')
    @if($errors->any())
        <script>alert( '{{$errors->first()}}')</script>
    @endif
    <table class="table">
        <tr>
            <th>Номер</th>
            <th>Министерство</th>
            <th>Действия</th>
        </tr>

        @foreach($tel as $tel)
<tr>
    <td>
            {{$tel->name}}
    </td>
    <td>
       {{$tel->departments->name}}
    </td>
    <td>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd-{{$tel->id}}" aria-expanded="false" aria-controls="collapseAdd{{$tel->id}}">
            Изменить
        </button>
                <div class="collapse" id="collapseAdd-{{$tel->id}}">
                    <div class="card card-body">
                        <form action="{{ route('static-tel.edit', $tel->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div style="margin-bottom: 20px;">
                                <select id="positions" name="dep_id" class="form-control">
                                    <option value="">--- Выберите Министерство  ---</option>
                                    @foreach ($departments as $dep)
                                        {{--                    <option value="{{$dep->id}}">{{$dep->name}}</option>--}}
                                        <option value="{{ $dep->id }}" {{ ( $dep->id ==$tel->departments_id ) ? 'selected' : '' }}> {{ $dep->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text"  name="tel" placeholder="Введите стационарный номер">
                            <input type="submit" value="ok">
                        </form>
                    </div>
                </div>
    </td>
    <td>
        <form action="{{route('staticTel.destroy', $tel->id)}}" method="post" enctype="multipart/form-data">
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
            <form action="{{ route('static-tel.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text"  name="tel" placeholder="Введите стационарный номер">
                <div style="margin-bottom: 20px;">
                    <select id="positions" name="dep_id" class="form-control">
                        <p></p>
                        <option value="">--- Выберите Министерство  ---</option>
                        @foreach ($departments as $dep)
                            <option value="{{$dep->id}}">{{$dep->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="ok">
            </form>
        </div>
    </div>
@endsection

