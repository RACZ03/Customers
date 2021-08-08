<!-- Candidate selector -->
@foreach($indicators as $item)

@if( $item['idCategory'] == 2 )
    <div class="row mb-2 align-items-center">

        <div class="col-5">
            <label for="candidate" class="col-form-label input-label">
                {{ $item['description'] }}:
            </label>
        </div>
        <div class="col-7">
            <input type="text" id="option" class="form-control"
                    aria-describedby="option" maxlength="1">
        </div>
    </div>
@endif
@endforeach