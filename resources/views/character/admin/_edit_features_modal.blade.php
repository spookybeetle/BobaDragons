{!! Form::open(['url' => 'admin/character/image/'.$image->id.'/traits']) !!}
    <div class="form-group">
        {!! Form::label('Species') !!}
        {!! Form::select('species_id', $specieses, $image->species_id, ['class' => 'form-control', 'id' => 'species']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Character Rarity') !!}
        {!! Form::select('rarity_id', $rarities, $image->rarity_id, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Traits') !!}
        <div id="featureList">
            @foreach($image->features as $feature)
                <div class="d-flex mb-2">
                    {!! Form::select('feature_id['.$feature->id.']', $features, $feature->feature_id, ['class' => 'form-control mr-2 feature-select original', 'placeholder' => 'Select Trait']) !!}
                    {!! Form::text('feature_data['.$feature->id.']', $feature->data, ['class' => 'form-control mr-2', 'placeholder' => 'Extra Info (Optional)']) !!}
                    <a href="#" class="remove-feature btn btn-danger mb-2">×</a>
                </div>
            @endforeach
        </div>
        <div><a href="#" class="btn btn-primary" id="add-feature">Add Trait</a></div>
        <div class="feature-row hide mb-2">
            {!! Form::select('feature_id[]', $features, null, ['class' => 'form-control mr-2 feature-select', 'placeholder' => 'Select Trait']) !!}
            {!! Form::text('feature_data[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Extra Info (Optional)']) !!}
            <a href="#" class="remove-feature btn btn-danger mb-2">×</a>
        </div>
    </div>

    <div class="text-right">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

<script>
    $(document).ready(function() {
        $('.original.feature-select').selectize();
        $('#add-feature').on('click', function(e) {
            e.preventDefault();
            addFeatureRow();
        });
        $('.remove-feature').on('click', function(e) {
            e.preventDefault();
            removeFeatureRow($(this));
        })
        function addFeatureRow() {
            var $clone = $('.feature-row').clone();
            $('#featureList').append($clone);
            $clone.removeClass('hide feature-row');
            $clone.addClass('d-flex');
            $clone.find('.remove-feature').on('click', function(e) {
                e.preventDefault();
                removeFeatureRow($(this));
            })
            $clone.find('.feature-select').selectize();
        }
        function removeFeatureRow($trigger) {
            $trigger.parent().remove();
        }
    });

</script>