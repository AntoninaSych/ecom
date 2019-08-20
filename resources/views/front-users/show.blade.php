<?php //dd($merchants);?>
@foreach($merchants as $merchant)
    Роль:{{($merchant->role_id)}}
    Имя мерчанта:{{ $merchant->merchantAlias->name }}
@endforeach
