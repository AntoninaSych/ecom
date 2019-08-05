@if(count($snippets)!=0)
    @foreach($snippets as $snippet)
        <div class="row">
            <div class="col-xs-2 pull-left">

                <input type="radio" name="snippet_id" value="{{$snippet->id}}">
            </div>
            <div class="col-xs-10" style=" text-align: left; margin-top: 10px;  font-weight: 700;">
                {{$snippet->name}}
            </div>
        </div>
        <hr>
    @endforeach
@else
    У вас нет созданных шаблонов
@endif