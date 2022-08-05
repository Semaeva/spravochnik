@extends('admin-layout')


@section('admin-main')

    @if($errors->any())

        <script>
             alert( '{{$errors->first()}}');

        </script>
    @endif
        <h2>{{$department->name}}</h2>
        <p hidden id="department_id">{{$department->id}}</p>
    <table class="table table-bordered" >
        <tr style="background-color: #443ea2; color: #fff">
        <th>Должность</th>
        <th>ФИО</th>
        <th>Стац номер</th>
        <th>Мобил номер</th>
        <th>Действия</th>
    </tr>

    @foreach($ids as $i)

        <tr class="float-child">
            <td>
                <h5 class="my" >{{$i->positions->name}}</h5>
                <p class="pos-id" hidden >{{$i->positions->id}}</p>

                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAddPos-{{$i->positions->id}}" aria-expanded="false" aria-controls="collapseAddPos-{{$i->positions->id}}">
                    Редактировать
                </button>
                </p>
                <div class="collapse" id="collapseAddPos-{{$i->positions->id}}">
                    <div class="card card-body">
                        <form action="{{ route('positions.change', $i->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div style="margin-bottom: 20px;">
                                <input type="text" value="{{$i->positions->id}}" hidden name="pos_id">
{{--                                @foreach($i->positions->staticTel as $t)--}}
{{--                                <input type="text" value="{{$t->id}}" hidden name="old_tel[]">--}}
{{--                                @endforeach--}}

                                <select id="positions" name="positions" class="form-control">
                                    <option value="">--- Выберите Должность  ---</option>
                                    @foreach ($positions as $item)
                                        <option value="{{ $item->id }}" {{ ( $item->id ==$i->positions->id ) ? 'selected' : '' }}> {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="ok">
                        </form>
                    </div>
                </div>
                    </div>
                </div>
            </td>
            <td>
             <h5>   {{$i->abonents->name}}</h5>
                <p class="abonent-id" hidden >{{$i->abonents->id}}</p>

                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd2-{{$i->abonents->id}}" aria-expanded="false" aria-controls="collapseAdd2-{{$i->abonents->id}}">
                                                Редактировать
                                            </button>
                                            </p>
                                            <div class="collapse" id="collapseAdd2-{{$i->abonents->id}}">
                                                <div class="card card-body">
{{--                                                    <form action="{{ route('abonents.change', $i->id) }}" method="post" enctype="multipart/form-data">@csrf--}}
                                                    <form action="{{ route('abonents.confirm', ['ids'=>$i->id, 'dep_id'=> $department->id]) }}" method="post" enctype="multipart/form-data">@csrf
                                                        <div style="margin-bottom: 20px;">
                                                            <select id="positions" name="abonents" class="form-control">
                                                                <option value="">--- Выберите ФИО  ---</option>
                                                                @foreach ($abonents as $item)
                                                                    <option value="{{ $item->id }}" {{ ( $item->id ==$i->abonents->id ) ? 'selected' : '' }}> {{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input type="submit" value="ok">
                                                    </form>
                                            </td>


    <td>

        <p></p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAddStat-{{$i->abonents->id}}" aria-expanded="false" aria-controls="collapseAddStat-{{$i->abonents->id}}">
            Добавить
        </button>

        <div class="collapse" id="collapseAddStat-{{$i->abonents->id}}">
            <div class="card card-body">
                <form action="{{ route('static.add', $i->abonents->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden value="{{$department->id}}" name="dep_id">
                    <div style="margin-bottom: 20px;">
                        <select id="stat" name="static" class="form-control">
                            <option value="">--- Стационарный номер  ---</option>
                            @foreach ($static_tel->where('departments_id', $department->id) as $stat)
                                <option value="{{$stat->id}}"> {{$stat->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <select id="stat" name="description" class="form-control">
                            <option value="1">Публичный</option>
                            <option value="0" selected>Приватный</option>
                        </select>
                    </div>
                    <input type="submit" value="Ok">
                </form>
{{--                @endforeach--}}

            </div>
        </div>
<br>

{{--                @foreach($i->abonents->ids as $dep)--}}
{{--                    {{$dep->where('departments_id',$department->id)->first()->departments->name}}--}}
{{--                @endforeach--}}

{{--        @foreach($i->abonents->staticTel as $t)--}}
{{--{{$t}}--}}
{{--        @endforeach--}}



{{--        {{$i->abonents->staticTel->}}--}}
        @foreach($i->abonents->staticTel->where('departments_id',$department->id) as $t)
        @if($t->departments->id == $department->id)
{{$t->name}}
                    @endif

                    <p class="staticTel-id" hidden >{{$t->id}}</p>

                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd3-{{$t->id}}" aria-expanded="false" aria-controls="collapseAdd3-{{$t->id}}">
                        Edit
                    </button>

                    <div class="collapse" id="collapseAdd3-{{$t->id}}">
                        <div class="card card-body">
                            <form action="{{ route('static.change', $t->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="pos_id" hidden value="{{$i->abonents->id}}">
                                <input type="text" name="dep_id" hidden value="{{$department->id}}">
                                <div style="margin-bottom: 20px;">
                                    <select id="tel" name="tel" class="form-control">
                                        <option value="">Нет</option>
                                        @foreach ($static_tel->where('departments_id', $department->id) as $stat)
                                            <option value="{{ $stat->id }}" {{ ( $stat->id ==$t->id ) ? 'selected' : '' }}> {{ $stat->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" value="ok">
                            </form>
                        </div>
                    </div>
            <br>

        @endforeach
    </td>

            <td>

                @if(empty($i->mobileTel->name))
                    <p class="mobileTel-id" hidden>0</p>
                    -
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd4" aria-expanded="false" aria-controls="collapseAdd4">
                        Редактировать
                    </button>
                    </p>
                    <div class="collapse" id="collapseAdd4">
                        <div class="card card-body">
                            <form action="{{ route('mobile.change', $i->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div style="margin-bottom: 20px;">
                                    <select id="positions" name="mob" class="form-control">
                                        <option value="">--- Выберите ---</option>

                                        @foreach ($mobile_tel as $mob)
                                            <option value="{{ $mob->id }}" {{ ( $mob->id ==0) ? 'selected' : '' }}> {{ $mob->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <input type="submit" value="ok">
                            </form>
                        </div>
                    </div>
                @else
                {{($i->mobileTel->name)}}
                    <p class="mobileTel-id" hidden>{{$i->mobileTel->id}}</p>
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd4-{{$i->mobileTel->id}}" aria-expanded="false" aria-controls="collapseAdd4-{{$i->mobileTel->id}}">
                        Редактировать
                    </button>
                    </p>
                    <div class="collapse" id="collapseAdd4-{{$i->mobileTel->id}}">
                        <div class="card card-body">
                            <form action="{{ route('mobile.change', $i->id) }}" method="post" enctype="multipart/form-data">@csrf
                                <div style="margin-bottom: 20px;">
                                    <select id="positions" name="mob" class="form-control">
                                        <option value="">--- Выберите ---</option>

                                        @foreach ($mobile_tel as $mob)
                                            <option value="{{ $mob->id }}" {{ ( $mob->id ==$i->mobileTel->id ) ? 'selected' : '' }}> {{ $mob->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <input type="submit" value="ok">
                            </form>
                @endif

            </td>
            <td>
                <form action="{{route('record.destroy', $i->id)}}" method="post" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <input type="text" value="{{$i->abonents->id}}" name="pos_id" hidden>
                    <input type="text" value="{{$department->id}}" name="dep_id" hidden>
                    <p></p>
                    <input type="submit" class="btn btn-danger" onclick="myFunction() "value="Удалить">
                </form>
            </td>
        </tr>
        @endforeach

</table>

        <button class="btn btn-success">Сохранить </button>

        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd" aria-expanded="false" aria-controls="collapseAdd">
            Добавить
        </button>

        <tr>

        <div class="collapse" id="collapseAdd">
            <div class="card card-body">
{{--                <form action="{{ route('add-positions', $department->id) }}" method="post" enctype="multipart/form-data">--}}
                <form action="{{ route('create-positions.confirm', $department->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <td>
                        <div style="margin-bottom: 20px;">
                            <select id="positions" name="positions" class="form-control">
                                <option value="">--- Выберите Должность  ---</option>
                                @foreach ($positions as $position)
                              <option value="{{$position->id}}">{{$position->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </td>
                <td>
                    <div style="margin-bottom: 20px;">
                            <select id="abon" name="abonents" class="form-control">
                                <option value="">--- Выберите ФИО  ---</option>
                                @foreach ($abonents as $abonent)
                             <option value="{{$abonent->id}}">{{$abonent->name}}</option>
                                @endforeach
                            </select>
                    </div>
                </td>

                    <td>

                        <div style="margin-bottom: 20px;">
                            <select id="stat" name="static" class="form-control">
                                <option value="">--- Стационарный номер  ---</option>
                                @foreach ($static_tel->where('departments_id', $department->id)  as $stat)
                               <option value="{{$stat->id}}"> {{$stat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 20px;">
                            <select id="mob" name="mobile" class="form-control">
                                <option value="0">---  Мобильный номер  ---</option>
                                @foreach ($mobile_tel as $mob)
                                    <option value="{{$mob->id}}">{{$mob->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div style="margin-bottom: 20px;">
                            <select id="mob" name="description" class="form-control">
                                <option value="1">Публичный </option>
                                <option value="0" selected> Приватный </option>
{{--                                @foreach ($mobile_tel as $mob)--}}
{{--                                    <option value="{{$mob->id}}">{{$mob->name}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                    </td>
                    <input type="submit" value="ok">
                </form>
            </div>
        </div>
            </td>

        </tr>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    // DOM utility functions:

    const ELS = (sel, par) => (par || document).querySelectorAll(sel);

    // TASK:

    const ELS_child = ELS(".float-child");

    let EL_drag; // Used to remember the dragged element

    const addEvents = (EL_ev) => {
        EL_ev.setAttribute("draggable", "true");
        EL_ev.addEventListener("dragstart", onstart);
        EL_ev.addEventListener("dragover", (ev) => ev.preventDefault());
        EL_ev.addEventListener("drop", ondrop);
    };

    const onstart = (ev) => EL_drag = ev.currentTarget;

    const ondrop = (ev) => {
        if (!EL_drag) return;

        ev.preventDefault();

        const EL_targ = ev.currentTarget;
        const EL_targClone = EL_targ.cloneNode(true);
        const EL_dragClone = EL_drag.cloneNode(true);

        EL_targ.replaceWith(EL_dragClone);
        EL_drag.replaceWith(EL_targClone);

        addEvents(EL_targClone); // Reassign events to cloned element
        addEvents(EL_dragClone); // Reassign events to cloned element

        EL_drag = undefined;
    };

    ELS_child.forEach((EL_child) => addEvents(EL_child));

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // $('body').on('click', 'button', function(e) {
    $('body').on('click', '.btn-success', function(e) {
        // var department_id = $(this).parent().attr('id');
        // var department_id = e.target.id;
        var department_id = document.getElementById('department_id').innerHTML;

        let arr_pos_id = []
        let arr_abon_id = []
        let arr_stat_id = []
        let arr_mob_id = []
                let pos_id = document.getElementsByClassName('pos-id');
        let abonent_id = document.getElementsByClassName('abonent-id');
        let staticTel_id = document.getElementsByClassName('staticTel-id');
        let mobileTel_id = document.getElementsByClassName('mobileTel-id');
                for (j = 0; j < pos_id.length; j++) {
                    var updateRecordsposId = pos_id[j].innerHTML;
                    arr_pos_id.push(updateRecordsposId);
                }
        for (a = 0; a < abonent_id.length; a++) {
            var updateRecordsAbId = abonent_id[a].innerHTML;
            arr_abon_id.push(updateRecordsAbId);
        }
        for (s = 0; s < staticTel_id.length; s++) {
            var updateRecordsStatId = staticTel_id[s].innerHTML;
            arr_stat_id.push(updateRecordsStatId);
        }

        for (m = 0; m < mobileTel_id.length; m++) {
            var updateRecordsMobId = mobileTel_id[m].innerHTML;
            arr_mob_id.push(updateRecordsMobId);
        }



        $.ajax({
            type: "post",
            url:"/admin/positions-add/",
            data: { data:arr_pos_id,
                data_abon:arr_abon_id,
                data_stat:arr_stat_id,
                data_mob:arr_mob_id,
                id: department_id,
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success:function(response){
                console.log(response);
                window.location.reload();

                //   $.each(response.data, function(i, data){
                //       //do something
                //       console.log(data);
                //   });
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });

    });

    function myFunction() {
        confirm("Press a button!");
    }
</script>
<style>
    .float-container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        position: relative;
    }

    .float-child {
        margin: 5px;
        flex: 1 0 14%;
        width: 100px;
    }

    .float-child img {
        width: 100%;
        height: 90px;
        object-fit: cover;
    }
</style>


@endsection
