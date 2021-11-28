@if (Session::has('warning'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" style="margin-bottom: 10px;margin-top: 5px;padding-top: 10px;padding-bottom: 10px;">
                <button class="close" data-close="alert" style="margin-top: 5px;"></button>
                <span>{!! Session::get('warning') !!}</span>
            </div>
        </div>
    </div>
@endif