{{--@extends('admin-layout')--}}


{{--@section('admin-main')--}}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@if(isset($msg2))
    <script>
        let check = confirm('{{$msg2}}');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(check){
            $.ajax({
                type: "POST",
                url:"/admin/get/Answer/",
                data: {
                    'id': {{$dep_id}},
                    'answer':true,
                    'abonents_id': {{$abonents_id}},
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
                success:function(response){
                    console.log(response);
                    //  location.reload();

                    // location.reload();
                    //   window.location.href = "{{ route('admin-show', $dep_id)}}";

                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        }else{
            window.location.href = "{{ route('admin-show', $dep_id)}}";
        }

    </script>

@endif

@if(isset($msg))
    <p hidden>{{$var}}</p>
    <p hidden> {{$id}}
    </p>
    <script>
        let check = confirm('{{$msg}}');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(check){
            $.ajax({
                type: "post",
                // url:"/admin/positions-add/",
                url:"/admin/change-abonents/",
                data: { abonents: {{$var}},
                    id:{{$id}},
                    dep_id:{{$dep_id}},
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'json',
                success:function(response){
                    // console.log(response);
                    window.location.href = "{{ route('admin-show', $dep_id)}}";

                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        }else{
            window.location.href = "{{ route('admin-show', $dep_id)}}";
        }

    </script>
@endif
{{--@endsection--}}
