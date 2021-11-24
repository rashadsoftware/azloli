<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
            <!-- Title & Favicon-->
            @php $data=DB::table('configs')->where('config_id', 1)->first() @endphp
            <title>{{$data->config_title}} | Səhifə Tapılmadı</title>
            @if($data->config_favicon == '')
                <link rel="icon" href="{{asset('front/')}}/img/favicon.png">
            @else
                <link rel="icon" href="{{asset('front/')}}/img/{{$data->config_favicon}}">
            @endif

            <!-- Main CSS -->
            <link rel="stylesheet" href="{{asset('front/')}}/css/bootstrap.min.css">
    </head>
    <body>
        <section style="padding-top:100px">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <h1 style="font-size:162px">404</h1>
                        <h2>Səhifə Tapılmadı</h2>
                        <p>Üzr istəyirik, axtardığınız səhifə tapılmadı. Zəhmət olmasa ana səhifəyə keçid edin.</p>
                        <a href="{{route('index')}}" class="btn btn-primary">Ana Səhifə</a>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>