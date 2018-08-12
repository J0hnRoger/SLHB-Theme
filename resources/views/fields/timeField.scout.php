
{!! Themosis\Facades\Form::text($field['name'], $field['value'], $field['atts']) !!}

@if(isset($field['features']['info']))
    <div class="themosis-field-info">
        <p class="description">{!! $field['features']['info'] !!}</p>
    </div>
@endif

<script>
(function() {
  $('#{!! $field["name"] !!}-id').on("change", () => {
    $(this).siblings().append('<div style="red">Format attendu : 5:00 </div>')
  });
})()
</script>

