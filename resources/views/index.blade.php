@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2><strong>Выгодные курсы валют на сегодня {{date('d.m.Y', time())}}</strong></h2><br>
            <h3 style="display: inline">Выбирите город или воспользуйтесь поиском&nbsp;&nbsp;&nbsp;</h3>
            <form style="display: inline" action="{{ secure_asset('js/search.php') }}" method="post" name="form" onsubmit="return false;">
                {{ csrf_field() }}
                <input name="search" type="text" id="search"><br>
            </form>
        </div>
    </div>

    <div id="resSearch" class="row col-md-12 text-justify" style="margin-top: 20px"></div>

    <div id="hidden" class="row col-md-12 text-justify bmargin" style="margin: 0; padding: 0;">
        @for($i=0; $i<count($azbuka); $i++)
            <div>
                <h2 style="color: #000000;">
                    <strong>&nbsp;&nbsp;&nbsp;{{$azbuka[$i]}}</strong>
                </h2>
                @foreach($citiesName[$azbuka[$i]] as $item)
                    <a style="color: #676a6d; font-size: large; text-decoration: none!important;" href = "{{route('index').'/'.$item[1]}}"> {{$item[0]}} </a>
                @endforeach
                @endfor
            </div>
    </div>


    <script type="text/javascript">
        $(function(){
            $("#search").keyup(function(){
                var search = $("#search").val();
                if (search == '')$("#hidden").css( "visibility", "visible");
                else $("#hidden").css( "visibility", "hidden");
                $.ajax({
                    type: "POST",
                    url: "{{ secure_asset('js/search.php') }}",
                    data: {"search": search},
                    cache: false,
                    success: function(response){
                        $("#resSearch").html(response);
                    }
                });
                return false;
            });
        });
    </script>
@endsection