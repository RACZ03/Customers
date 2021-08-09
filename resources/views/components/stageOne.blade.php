<!-- Candidate selector -->
<div class="row mb-2 align-items-center">
    <div class="col-3">
        <label for="candidate" class="col-form-label input-label">
            Candidato:
        </label>
    </div>
    <div class="col-9">
        <select class="form-control form-select" 
                aria-label="Default select example"
                id="idCandidate" require>
            <option value="0" selected>Seleccione un candidato</option>
            @foreach ($candidates as $item)
            <option value="{{ $item['id'] }}">
                {{ $item['firstName'].' '.$item['secondName'].' '.$item['surname'].' '.$item['secondSurname'] }}
            </option>
            @endforeach
        </select>
    </div>
</div>
<!-- Inputs Date -->
<div class="row mt-3">
    <!-- start date -->
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <label for="from" class="col-form-label input-label">Desde:</label>
            </div>
            <div class="col-8">
                <input type="date" class="form-control" id="startDate" require>
            </div>
        </div>
    </div>
    <!-- end date -->
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                <label for="to" class="col-form-label input-label">Hasta:</label>
            </div>
            <div class="col-8">
                <input type="date" class="form-control" id="endDate" require>
            </div>
        </div>
    </div>
</div>