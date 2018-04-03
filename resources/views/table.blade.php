@extends('layouts.default')

@section('content')
    <div class="row col-md-12 bmargin">
        <h2><strong>Курсы валют в городе {{$currentCity}} на сегодня {{date('d.m.Y', time())}}</strong></h2>
    </div>

    <div class="row col-md-12" style="padding-right: 0; padding-left: 0">
        <div class="col-md-3 panel panel-default" style="padding-left: 0">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td align="left">валюта</td>
                        <td>{{$cbr[0]->name}}</td>
                        <td>{{$cbr[1]->name}}</td>
                    </tr>
                    <tr>
                        <td align="left">курсы ЦБ</td>
                        <td>{{$cbr[0]->value}}</td>
                        <td>{{$cbr[1]->value}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left"><strong>выгодные курсы банков</strong></td>
                    </tr>
                    <tr>
                        <td align="left">покупка</td>
                        <td>{{$bestArray['maxbuyusd']}}</td>
                        <td>{{$bestArray['maxbuyeur']}}</td>
                    </tr>
                    <tr>
                        <td align="left">продажа</td>
                        <td>{{$bestArray['minsellusd']}}</td>
                        <td>{{$bestArray['minselleur']}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-9" style="padding-right: 0">
            @if($table->isEmpty())
                <pre>Для выбранного города нет данных</pre>
            @else
                <table class="table table-responsive table-striped tsort">
                    <thead>
                        <tr>
                            <td style="text-align: left"><small>{{date('время последнего обновления H:i:s', $table[0]->updated_at)}}</small></td>
                            <td colspan="2">Доллар $</td>
                            <td colspan="2">Евро &euro;</td>
                        </tr>
                        <tr>
                            <th style="text-align: left">Банк</th>
                            <th>Продажа</th>
                            <th>Покупка</th>
                            <th>Продажа</th>
                            <th>Покупка</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $item)
                        <tr>
                            <td align="left">{{$item->name}}</td>
                            <td>{{$item->buyusd}}</td>
                            <td>{{$item->sellusd}}</td>
                            <td>{{$item->buyeur}}</td>
                            <td>{{$item->selleur}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div data-remote="{{ asset('js/remote.php') }}" class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        (function($){
            $.fn.tsort=function(){
                var
                    v=function(e,i){return $(e).children('td').eq(i).text()},
                    c=function(i){return function(a,b){var k=v(a,i),m=v(b,i);return $.isNumeric(k)&&$.isNumeric(m)?k-m:k.localeCompare(m)}};
                this.each(function(){
                    var
                        th=$(this).children('thead').first().find('tr > th'),
                        tb=$(this).children('tbody').first();

                    th.click(function(){
                        var r=tb.children('tr').toArray().sort(c($(this).index()));
                        th.removeClass('sel'),$(this).addClass('sel').toggleClass('asc');
                        if($(this).hasClass('asc'))r=r.reverse();
                        for(var i=0;i<r.length;i++)tb.append(r[i])
                    })
                })
            }
        })(jQuery);

        $( document ).ready(function() {
            $('.tsort').tsort();
        });
    </script>
@endsection