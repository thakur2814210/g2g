<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <form action="{{ route('website.auth.sign-in-modal') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="slug" id="slug" value="">
        <input type="hidden" name="page" id="page" value="">
        <div class="sign-in-wrapper">
          
            <div class="form-group">
                <label>Email / Phone</label>
                <input type="text" class="form-control" name="email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                    <label class="container_check">Remember me
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
        </div>
    </form>
</div>


