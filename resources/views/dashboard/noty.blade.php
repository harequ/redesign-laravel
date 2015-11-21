@if(Session::has('update_message'))
	<script>
		$(document).ready(function() {
			noty({type: 'success', theme: 'redesign', layout: 'top', text: '{{ Session::get('update_message') }}', timeout: 3000});	
		});
	</script>
@endif