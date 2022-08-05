<!Doctype>
<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">--}}

</head>
<body>
<div class="text-center text-white" style="margin-top: 20px">
<h2>Выберете министерство</h2>
</div>
<div class="container">
    <div class="row overflow-auto" style="margin-top: 60px;max-height: 70%; background-color:#4A44A1;" >
        <div class="col text-center border">
                @foreach($departments as $d)
                    <h2 class="text-white display-5">
                    <a href="{{route('admin-show',$d->id)}}" class="text_white hover_black text-decoration-none"> {{$d->name}} </a></h2>
                @endforeach
    </div>
</div>
</div>
{{--<div class="wrapper vcenter-item">--}}
{{--    <div class="box text-center">--}}
{{--        <h3 class="h1" style="margin-bottom: 60px;">Выберите министерство:</h3>--}}

{{--        <ul>--}}
{{--    @foreach($departments as $d)--}}
{{--        <li><h1 class="text-white display-4">--}}
{{--        <a href="{{route('admin-show',$d->id)}}" class="text_white hover_black text-decoration-none"> {{$d->name}} </a></h1>--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--</ul>--}}
{{--    </div>--}}
{{--</div>--}}

</body>
</html>

<style>
    .text_white          { color: white;  }
    a.hover_black:hover  { color: #bacbe6 !important;  }


    /*.vcenter-item{*/
    /*    display: flex;*/
    /*    align-items: center;*/
    /*}*/
    /*!* Some custom styles to beautify this example *!*/
    /*.wrapper{*/
    /*    background: #443ea2;*/
    /*    min-height: 100%;*/
    /*}*/
    /*.box{*/
    /*    padding: 25px;*/
    /*    background: #443ea2;*/
    /*    width: 100%;*/
    /*}*/
    body{
        background-color: #443ea2;
    }
</style>
