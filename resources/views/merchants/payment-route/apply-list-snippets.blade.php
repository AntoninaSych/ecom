@if(count($snippets)!=0)

    @foreach($snippets as $snippet)
<div class="row">
        <div class="col-xs-2 pull-left">
            <div class="wrap ">
                <input type="checkbox" id="snippet{{$snippet->id}}" name="snippet{{$snippet->id}}" value="0"/>
                <label class="slider-v2" for="snippet{{$snippet->id}}" id="label-checkbox"></label>
            </div>
        </div>
        <div class="col-xs-10" style=" text-align: left; margin-top: 10px;  font-weight: 700;">
            {{$snippet->name}}
        </div></div>

    @endforeach

@else
    У вас нет созданных шаблонов
@endif