<script src="{{ url('/') . mix('/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/plusis.js') }}" type="text/javascript"></script>



<!--DATAPICKERTIME BOOTSTRAP-->

<script src="{{ asset('/plugins/jquery-2.2.3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/moment-with-locales.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{asset('/js/bootstrap-select.min.js')}}"></script>

<script>
    window.Laravel =
    <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
