<script type="text/javascript">
    jQuery(function ($) {

        if ($('body').find('.product-create') == 'true') {
            $('.product-create').parsley().on('field:validated', function () {
                var ok = $('.parsley-error').length == '0';
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
                .on('form:submit');
        }
    });
</script>