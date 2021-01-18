<div class="form-group ui-widget">
    <label for="first_name">Client:</label>
    <input id="search" name="search" type="text" class="form-control autocomplete" placeholder="Search" />
    <input name="client_id" id="client_id" type="hidden">
</div>
@section('javascript-bottom')
<script>
$(document).ready(function(){
    const route = "{{ url('transactions/autocomplete') }}";
    $('#search').autocomplete({
        source: function (request, response) {
            jQuery.get(route, {
                query: request.term
            }, function (data) {
                response(data);
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#search').val(ui.item.label); // display the selected text
            $('#client_id').val(ui.item.value); // save selected id to input
            return false;
        },
        minLength: 3
    });
});
</script>
@endsection
