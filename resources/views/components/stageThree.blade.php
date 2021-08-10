<!-- Candidate selector -->
@foreach($indicators as $item)

@if( $item['idCategory'] == 2 )

    <?php 
        if( isset($details) ) { 
            $found = array_search($item->id, array_column($details, 'idIndicator'));
        }
    ?>
    <div id="listGroup2">
        <div class="row mb-2 align-items-center element">
    
            <div class="col-5">
                <label for="candidate" class="col-form-label input-label">
                    {{ $item['description'] }}:
                </label>
            </div>
            <div class="col-7">
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