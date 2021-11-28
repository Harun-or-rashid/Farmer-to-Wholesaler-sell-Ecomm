@if (count($errors) > 0)
    <div class="row">
        <div class="col-md-12 ">
            <div class="alert alert-danger" style="margin: 5px 0px;padding: 5px 10px;">
                <button class="close" data-close="alert" style="margin-top: 5px;"></button>
                <span> !OPPS, Form validation failed. </span>
            </div>
        </div>
    </div>
@endif