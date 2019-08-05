@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1> </h1>
@stop


@section('content')
  <div class="row">
      @if(Auth::user()->can(PermissionHelper::SNIPPETS_MODIFY))
          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                  <div class="inner">
                      <h3>Merchants Route</h3>
                      <p>Snippets merchant payment Route</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-settings"></i>
                  </div>
                  <a href="/snippets" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
      @endif
  </div>
@stop