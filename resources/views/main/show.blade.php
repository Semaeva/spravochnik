@extends('layout')
{{--    <body>--}}



@section('main')
{{--    <meta http-equiv="refresh" content="3" />--}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{--<form id="prospects_form" onclick="myFunction()">--}}
{{--    <input type="text">--}}
{{--    <input type="submit">--}}
{{--</form>--}}

    <h2>{{$department->name}}</h2>
    <p hidden id="department_id">{{$department->id}}</p>
    <table class="table table-bordered" >
        <tr style="background-color: #443ea2; color: #fff">
            <th>Должность</th>
            <th>ФИО</th>
            <th>Стац номер</th>
            <th>Мобил номер</th>
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
                    @foreach($i->abonents->staticTel->where('departments_id',$department->id) as $t)
                        @if($t->departments->id == $department->id)
                            {{$t->name}}
                        @endif
                    @endforeach
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



{{--                <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>--}}
{{--                --}}{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
{{--                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
{{--                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
{{--<script>--}}

{{--    $('#search').on('keyup', function(){--}}
{{--        search();--}}
{{--    });--}}
{{--    search();--}}
{{--    function search(){--}}
{{--        var keyword = $('#search').val();--}}
{{--        // alert(keyword);--}}
{{--        $.post('{{ route("employee.search") }}',--}}
{{--            {--}}
{{--                _token: $('meta[name="csrf-token"]').attr('content'),--}}
{{--                keyword:keyword--}}
{{--            },--}}
{{--            function(data){--}}
{{--                table_post_row(data);--}}
{{--                console.log(data);--}}
{{--            });--}}
{{--    }--}}
{{--    function table_post_row(res){--}}
{{--        let htmlView = '';--}}
{{--        if(res.employees.length <= 0){--}}
{{--            htmlView+= `--}}
{{--       <tr>--}}
{{--          <td colspan="4">No data.</td>--}}
{{--      </tr>`;--}}
{{--        }--}}
{{--        for(let i = 0; i < res.employees.length; i++){--}}
{{--            htmlView += `--}}
{{--        <tr>--}}
{{--           <td>`+ (i+1) +`</td>--}}
{{--              <td>`+res.employees[i].name+`</td>--}}
{{--               <td>`+res.employees[i].phone+`</td>--}}
{{--        </tr>`;--}}
{{--        }--}}
{{--        $('tbody').html(htmlView);--}}
{{--    }--}}
{{--</script>--}}

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

    <script>
        // var timeout =  setTimeout(function(){
        //             window.location.reload();
        //         }, 5000);
        //
        // var timer = function() {
        //     window.location.reload(true);
        // };
        // var timeout = setTimeout(timer, 5000);

function myFunction(){
    // clearTimeout(timeout);
}

    </script>
@endsection
