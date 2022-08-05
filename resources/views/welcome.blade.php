@extends('admin-layout')


@section('admin-main')

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

                </td>
                <td>
                    <h5>   {{$i->abonents->name}}</h5>
                    <p class="abonent-id" hidden >{{$i->abonents->id}}</p>


                </td>




                <td>

                    @if(empty($i->mobileTel->name))
                        <p class="mobileTel-id" hidden>0</p>
                        -
                        <p>
                    @else
                        {{($i->mobileTel->name)}}
                        <p class="mobileTel-id" hidden>{{$i->mobileTel->id}}</p>
                    @endif

                </td>
            </tr>
        @endforeach

    </table>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
