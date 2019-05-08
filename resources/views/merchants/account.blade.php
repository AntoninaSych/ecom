
<div class="content">
    <div class="row">
    <div class="pull-right btn btn-primary" data-toggle="modal" data-target="#modal-add-account" style="margin-bottom: 15px">
        <i class="fa fa-fw fa-plus"></i> Добавить аккаунт </div>
    </div>



@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div id="accounts"></div>
@include('merchants.add-account-modal')

</div>