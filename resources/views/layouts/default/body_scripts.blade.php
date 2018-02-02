<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/bootstrap.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
@if(\Auth::user())
<script>
    window.user = {!! \Auth::user() !!};
</script>
@endif
{{ $slot }}
