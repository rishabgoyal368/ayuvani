
<script>
  @if(Session::has('success'))
  		toastr.success("{{ Session::get('success') }}");
  @endif

  @if(Session::has('error'))
  		toastr.error("{{ Session::get('error') }}");
  @endif
</script>