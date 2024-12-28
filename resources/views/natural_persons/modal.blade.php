<div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="personModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="naturalPersonModalLabel">Add/Edit Natural Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personForm" method="post" action="{{route('store')}}">
                    @csrf
                    <div class="row g-3">
                        <!-- Prefix -->
                        <div class="col-md-4">
                            <label for="prefix" class="form-label">Prefix</label>
                            <input type="text" class="form-control" id="prefix" name="prefix" maxlength="10">
                        </div>

                        <!-- First Name -->
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>

                        <!-- Middle Name -->
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>

                        <!-- Other Last Name -->
                        <div class="col-md-4">
                            <label for="other_last_name" class="form-label">Other Last Name</label>
                            <input type="text" class="form-control" id="other_last_name" name="other_last_name">
                        </div>

                        <!-- Given Name -->
                        <div class="col-md-4">
                            <label for="given_name" class="form-label">Given Name</label>
                            <input type="text" class="form-control" id="given_name" name="given_name">
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                        </div>

                        <!-- Town of Birth -->
                        <div class="col-md-6">
                            <label for="town_of_birth" class="form-label">Town of Birth</label>
                            <input type="text" class="form-control" id="town_of_birth" name="town_of_birth">
                        </div>

                        <!-- Country of Birth -->
                        <div class="col-md-4">
                            <label for="country_of_birth" class="form-label">Country of Birth</label>
                            <select id="country_of_birth" name="country_of_birth" class="form-select select2">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id_country}}">{{$country->country_name_iso_3166 ?? $country->country_smv}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Civil Status Section -->
                        <div class="col-md-4">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select id="civil_status" name="civil_status" class="form-select select2">
                                <option value="">Select Civil Status</option>
                                @foreach($civilStatuses as $civilStatus)
                                    <option value="{{$civilStatus->id}}">{{$civilStatus->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Professions Section -->
                        <div class="col-md-4">
                            <label for="Profession" class="form-label">Professions</label>
                            <select id="Profession" name="Profession" class="form-select select2">
                                <option value="">Select Professions</option>
                                @foreach($professions as $profession)
                                    <option value="{{$profession->ID}}">{{$profession->ActivityName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tax Number -->
                        <div class="col-md-4">
                            <label for="tax_number" class="form-label">Tax Number</label>
                            <input type="text" class="form-control" id="TaxNumber" name="TaxNumber">
                        </div>

                        <!-- Verifier Digit -->
                        <div class="col-md-4">
                            <label for="digitoVerificadorRUC" class="form-label">digitoVerificadorRUC</label>
                            <input type="text" class="form-control" id="digitoVerificadorRUC" name="digitoVerificadorRUC">
                        </div>

                        <!-- Location Code -->
                        <div class="col-md-4">
                            <label for="codigoUbicacion" class="form-label">codigoUbicacion</label>
                            <input type="text" class="form-control" id="codigoUbicacion" name="codigoUbicacion">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
