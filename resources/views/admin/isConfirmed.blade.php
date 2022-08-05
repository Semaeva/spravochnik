{{--@extends('admin-layout')--}}


{{--@section('admin-main')--}}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@if($errors->any())
{{--    {!! implode('', $errors->all('<div>:'.$msg_error.'</div>')) !!}--}}
    <script>
        alert({{$msg_error}});
    </script>
@endif

@if(isset($msg2))
    <p id="pos_id" hidden>{{$positions_id}}</p>
    <p id="static" hidden>{{$static}}</p>
    <p id="mobile" hidden>{{$mobile}}</p>
    <p id="dep_id" hidden>{{$dep_id}}</p>
  <p id="description" hidden>{{$description}}</p>

    <script>

            let check = confirm('{{$msg2}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (check) {
                $.ajax({
                    type: "POST",
                    url: "/admin/get/Answer/",
                    data: {
                        'id': {{$dep_id}},
                        'answer': true,
                        'abonents_id': {{$abonents_id}},
                        'positions_id': {{$positions_id}},
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        var text = response.data;
                        if (text.includes('Error')){
                            alert(response.data);
                            window.location.href = "{{ route('admin-show', $dep_id)}}";
                        }
                        else {
                            let abonConfirm = confirm(response.data);
                            if (!abonConfirm) {
                                window.location.href = "{{ route('admin-show', $dep_id)}}";
                            } else {
                                $.ajax({
                                    type: "post",
                                    url: "/get/static/tel-answer/",
                                    data: {
                                        'abonents_id': {{$abonents_id}},
                                        'positions_id': document.getElementById('pos_id').innerText,
                                        'static': document.getElementById('static').innerText,
                                        'mobile': document.getElementById('mobile').innerText,
                                        'dep_id': document.getElementById('dep_id').innerText,
                                        'description': document.getElementById('description').innerText,
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    dataType: 'json',
                                    success: function (responses) {
                                        console.log(responses.data);
                                        alert(responses.data);
                                        window.location.href = "{{ route('admin-show', $dep_id)}}";

                                    },
                                    error: function (request, status, error) {
                                        console.log(request.responseText);
                                        {{--window.location.href = "{{ route('admin-show', $dep_id)}}";--}}

                                    }
                                });
                            }
                        }
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText+'/admin/get/Answer/');
                        {{--window.location.href = "{{ route('admin-show', $dep_id)}}";--}}

                    }
                });
            } else {
                window.location.href = "{{ route('admin-show', $dep_id)}}";
            }

    </script>

@endif

@if(isset($msg))
    <p hidden>{{$var}}</p>
    <p hidden> {{$id}}
    </p>
    <script>
        let check = confirm('{{$msg.'test'}}');
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
