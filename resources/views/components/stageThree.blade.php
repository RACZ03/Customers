<!-- Last stage of the evaluation (Selection of evaluation criteria according to category 2) -->

<!-- Candidate selector -->
@foreach($indicators as $item)

@if( $item['idCategory'] == 2 )
    <!-- Edit option, it is verified if the controller returns a list of indicator id -->
    <?php 
        if( isset($details) ) { 
            // Find a match between the id of the general list of indicators, 
            // with the array of id stored in the evaluation detail
            $found = array_search($item->id, array_column($details, 'idIndicator'));
        }
    ?>
    <div id="listGroup2">
        <div class="row mb-2 align-items-center element">
            <!-- Label -->
            <div class="col-5">
                <label for="candidate" class="col-form-label input-label">
                    {{ $item['description'] }}:
                </label>
            </div>
            <!-- input -->
            <div class="col-7">
                <!-- If there is a value in the search variable, show in input 1 if not 0 -->
                <input type="text" 
                        id="{{ $item['id'] }}"
                        class="form-control item_selected" 
                        onkeypress="return validateInputNumber( event )"
                        aria-describedby="option" 
                        maxlength="1"
                        value="{{ isset($found) ? ( $found !== false  ? 1 : 0 ) : 0 }}">
            </div>
        </div>
    </div>
@endif
@endforeach