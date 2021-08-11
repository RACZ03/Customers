<!-- Form for the creation of new candidates -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <h5 class="title_modal" id="nameForm"></h5>
      <div class="modal-body">
        <form action="" method="post" id="form-customer" class="m-2">
          @csrf
          <input type="hidden" name="id">
          <!-- FirstName --> 
          <div class="row mb-2 align-items-center">
            <div class="col-4">
              <label for="firstName" class="col-form-label input-label">Primer Nombre:</label>
            </div>
            <div class="col-8">
              <input type="text" id="firstName" class="form-control"
                     aria-describedby="firstName" >
            </div>
          </div>
          <!-- LastName -->
          <div class="row mb-2 align-items-center">
            <div class="col-4">
              <label for="lastName" class="col-form-label">Segundo Nombre:</label>
            </div>
            <div class="col-8">
              <input type="text" id="secondName" class="form-control"
                     aria-describedby="secondName">
            </div>
          </div>
          <!-- Surname -->
          <div class="row mb-2 align-items-center">
            <div class="col-4">
              <label for="surname" class="col-form-label">Primer Apellido:</label>
            </div>
            <div class="col-8">
              <input type="text" id="surname" class="form-control"
                     aria-describedby="surname" >
            </div>
          </div>
          <!-- SecondSurname -->
          <div class="row mb-2 align-items-center">
            <div class="col-4">
              <label for="secondSurname" class="col-form-label">Segundo Apellido:</label>
            </div>
            <div class="col-8">
              <input type="text" id="secondSurname" class="form-control"
                     aria-describedby="secondSurname" >
            </div>
          </div>

          <!-- IndentityCard  and PhoneNumber -->
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="row mb-2 align-items-center">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4">
                  <label for="dni" class="col-form-label">Cédula:</label>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8">
                  <input type="text" id="dni" class="form-control" maxlength="16" >
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="row mb-2 align-items-center">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4">
                  <label for="phoneNumber" class="col-form-label">Teléfono:</label>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8">
                  <input type="text" id="phoneNumber" class="form-control" value="505"
                        aria-describedby="phoneNumber" maxlength="13"
                        onkeypress="return validateInputPhoneNumber( event )">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetModal()">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

