<!-- Candidate selector -->
@foreach($indicators as $item)

@if( $item['idCategory'] == 2 )
    <div id="listGroup2">
        <div class="row mb-2 align-items-center element">
    
            <div class="col-5">
                <label for="candidate" class="col-form-label input-label">
                    {{ $item['description'].''.$item['id'] }}:
                </label>
            </div>
            <div class="col-7">
                <input type="text" 
                        id="{{ $item['id'] }}"
                        class="form-control item_selected" 
                        onkeypress="return validateInputNumber( event )"
                        aria-describedby="option" maxlength="1">
            </div>
        </div>
    </div>
@endif
@endforeach