<script>
function myFunction1(lang_id) {
 jQuery(function ($) {
  jQuery.ajax({
    beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
     },
    url: '<?php echo e(URL::to("/change_language")); ?>',
    type: "POST",
    data: {"languages_id":lang_id,"_token": "<?php echo e(csrf_token()); ?>"},
    success: function (res) {
      window.location.reload();
    },
  });
});
}
</script>
<?php /**PATH /home/devhs/public_html/g2g-v3/resources/views/web/common/scripts/changeLanguage.blade.php ENDPATH**/ ?>