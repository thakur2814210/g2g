<script>
function deleteAddress(address_id) {
  jQuery(function ($) {
  jQuery.ajax({
    beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
     },
    url: '<?php echo e(URL::to("/delete-address")); ?>',
    type: "POST",
    data: {'address_id': address_id,"_token": "<?php echo e(csrf_token()); ?>"},

    success: function (res) {
      window.location = 'shipping-address?action=detele';
    },
  });
});
}
</script>
<?php /**PATH /home/g2g/public_html/resources/views/autoshop/common/scripts/deleteAddress.blade.php ENDPATH**/ ?>