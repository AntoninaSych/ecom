
<button class="btn button btn-default" id ="export"  style="margin: 15px" onclick="exportTableToCSV('{{$reportInfo->name}}.csv')">CSV Download</button>

<table class=" table table-striped table-bordered"  id="tableId" style="margin: 15px">
@foreach ($report as $key=>$value)
        @if(is_object($value))
            <tr>
                @foreach ($value as $item=>$itemVal)
                    <td>{{$item}}</td>
                @endforeach
            </tr>
        @endif
@break
@endforeach


@foreach ($report as $key=>$value)
    @if(is_object($value))
        <tr>
             @foreach ($value as $item=>$itemVal)
              <td>{{$itemVal}}</td>
            @endforeach
        </tr>
    @endif
@endforeach
</table>
