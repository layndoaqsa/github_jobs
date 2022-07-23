<div class="navbar navbar-expand-lg navbar-dark">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; {{\Carbon\Carbon::now()->format('Y')}} <b>{{env("APP_NAME_FULL")}}</b>
            <br>Layndo Safara Aqsa
        </span>
    </div>
</div>