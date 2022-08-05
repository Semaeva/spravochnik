@extends('layout')
{{--    <body>--}}



@section('main')
{{--    <meta http-equiv="refresh" content="10" />--}}
    <table class="table table-bordered" style="margin-bottom: 70px; ">
        <tr style="background-color: #443ea2; color: #fff">
{{--            <th>Министерство</th>--}}
            <th>Должность</th>
            <th>ФИО</th>
            <th>Стац номер</th>
            <th>Мобил номер</th>
        </tr>
                @foreach($departments as $depar)
                    <tr class="text-center" style="background-color: #A09FAB;  ">
                        <th colspan="5">
                        {{$depar->name}}
                        </th>
                    </tr>

                    @foreach($ids->where('departments_id', $depar->id) as $d)
                <tr>
{{--                    <td></td>--}}
                    <td>
                                {{$d->positions->name}}
                    </td>
                    <td>
                        {{$d->abonents->name}}

                    </td>
                    <td>
{{--                        {{$d->staticTel->name}}--}}
                        @foreach($d->positions->staticTel as $t)
                            {{$t->name}}<br>
                        @endforeach
                    </td>
                    <td>
                        @if(empty($d->mobileTel->name))
                            -
                        @else
                            {{($d->mobileTel->name)}}
                        @endif
                    </td>
                </tr>
                @endforeach
        @endforeach
    </table>
@endsection
