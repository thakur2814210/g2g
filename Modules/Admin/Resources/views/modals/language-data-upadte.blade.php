 <!-- Logout Modal-->
<div class="modal fade" id="languageDataUpdate" tabindex="-1" role="dialog" aria-labelledby="languageDataUpdate" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="languageDataUpdate">Language Data Update?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
     <form class="form-horizontal" method="POST" action="{{ route('superadmin.languages.save')}}">
       {{ csrf_field() }}
      <div class="modal-body">
          <input type="hidden" name="lang_key" id="lang_key" value="" >
           <input type="hidden" name="lang_module" id="lang_module" value="" >
          <div class="form-group row">
            <label for="tag_name" class="col-sm-2 col-form-label">English</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="english_lang_content" id="english_lang_content" required="required" />
            </div>
          </div>

          <div class="form-group row">
            <label for="tag_name" class="col-sm-2 col-form-label">Arabic</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="arabic_lang_content" id="arabic_lang_content" required="required" />
            </div>
          </div>      
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success " type="submit" >Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>