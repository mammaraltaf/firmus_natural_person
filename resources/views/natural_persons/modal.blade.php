<div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="personModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personModalLabel">Add Natural Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personForm" method="post" action="{{route('natural-person.store')}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card mb-4">
                        <div class="card-header">Personal Information</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label for="prefix" class="form-label">Prefix</label>
                                    <input type="text" class="form-control" id="prefix" name="prefix" maxlength="10">
                                </div>

                                <!-- First Name -->
                                <div class="col-md-2">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-2">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-2">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>

                                <!-- Other Last Name -->
                                <div class="col-md-2">
                                    <label for="other_last_name" class="form-label">Other Last Name</label>
                                    <input type="text" class="form-control" id="other_last_name" name="other_last_name">
                                </div>

                                <!-- Given Name -->
                                <div class="col-md-2">
                                    <label for="given_name" class="form-label">Given Name</label>
                                    <input type="text" class="form-control" id="given_name" name="given_name">
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                                </div>

                                <!-- Town of Birth -->
                                <div class="col-md-4">
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
                                <div class="col-md-6">
                                    <label for="civil_status" class="form-label">Civil Status</label>
                                    <select id="civil_status" name="civil_status" class="form-select select2">
                                        <option value="">Select Civil Status</option>
                                        @foreach($civilStatuses as $civilStatus)
                                            <option value="{{$civilStatus->id}}">{{$civilStatus->type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Professions Section -->
                                <div class="col-md-6">
                                    <label for="Profession" class="form-label">Professions</label>
                                    <select id="Profession" name="Profession" class="form-select select2">
                                        <option value="">Select Professions</option>
                                        @foreach($professions as $profession)
                                            <option value="{{$profession->ID}}">{{$profession->ActivityName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tax and Invoice Data -->
                    <div class="card mb-4">
                        <div class="card-header">Invoice Data</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="taxNumber" class="form-label">Tax Number</label>
                                    <input type="text" class="form-control" id="taxNumber" value="">
                                </div>
                                <div class="col-md-4">
                                    <label for="digitoVerificadorRUC" class="form-label">digitoVerificadorRUC</label>
                                    <input type="text" class="form-control" id="digitoVerificadorRUC" value="digitoVerificadorRUC">
                                </div>
                                <div class="col-md-4">
                                    <label for="codigoUbicacion" class="form-label">codigoUbicacion</label>
                                    <input type="text" class="form-control" id="codigoUbicacion" value="codigoUbicacion">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Data -->
                    <div class="card mb-4">
                        <div class="card-header">Contact Data</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Type of Contact</th>
                                    <th>Value</th>
                                    <th>Description/Notes</th>
                                    <th>Authorized</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="contactTableBody"></tbody>
                            </table>
                            <button class="btn btn-primary" onclick="addContactRow()">Add Contact</button>
                        </div>
                    </div>
                    <!-- Nationality Data -->

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Nationality Data -->
                            <div class="card mb-4">
                                <div class="card-header">Nationality Data</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nationality</th>
                                        </tr>
                                        </thead>
                                        <tbody id="nationalityTableBody"></tbody>
                                    </table>
                                    <button class="btn btn-primary" onclick="addNationalityRow()">Add Nationality</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Nationality Documents Data -->
                            <div class="card mb-4">
                                <div class="card-header">Nationality Document Data</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Reference Number</th>
                                            <th>Expiration Date</th>
                                        </tr>
                                        </thead>
                                        <tbody id="nationalityDocumentsTableBody"></tbody>
                                    </table>
                                    <button class="btn btn-primary" onclick="addNationalityDocumentsRow()">Add Nationality Document</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Address Data -->
                    <div class="card mb-4">
                        <div class="card-header">Address Data</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Type of Address</th>
                                    <th>Street Name</th>
                                    <th>Number</th>
                                    <th>Apartment</th>
                                    <th>District</th>
                                    <th>Postal Code</th>
                                    <th>City</th>
                                    <th>Province</th>
                                    <th>Country</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="addressTableBody"></tbody>
                            </table>
                            <button class="btn btn-primary" onclick="addAddressRow()">Add Address</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function deleteRow(button) {
        const row = button.parentElement.parentElement;
        row.remove();
    }

    function addContactRow() {
        const tableBody = document.getElementById('contactTableBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" placeholder="Type of Contact"></td>
            <td><input type="text" class="form-control" placeholder="Value"></td>
            <td><input type="text" class="form-control" placeholder="Description/Notes"></td>
            <td><input type="checkbox"></td>
            <td><button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
        `;
        tableBody.appendChild(newRow);
    }

    function addAddressRow() {
        const tableBody = document.getElementById('addressTableBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" placeholder="Type of Address"></td>
            <td><input type="text" class="form-control" placeholder="Street Name"></td>
            <td><input type="text" class="form-control" placeholder="Number"></td>
            <td><input type="text" class="form-control" placeholder="Apartment"></td>
            <td><input type="text" class="form-control" placeholder="District"></td>
            <td><input type="text" class="form-control" placeholder="Postal Code"></td>
            <td><input type="text" class="form-control" placeholder="City"></td>
            <td><input type="text" class="form-control" placeholder="Province"></td>
            <td><input type="text" class="form-control" placeholder="Country"></td>
            <td><button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
        `;
        tableBody.appendChild(newRow);
    }

    function addNationalityRow(){
        const tableBody = document.getElementById('nationalityTableBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" placeholder="Nationality"></td>
                        <td><button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
        `;
        tableBody.appendChild(newRow);
    }

    function addNationalityDocumentsRow(){
        const tableBody = document.getElementById('nationalityDocumentsTableBody');
        const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control" placeholder="Type"></td>
                <td><input type="text" class="form-control" placeholder="Reference Number"></td>
                <td><input type="text" class="form-control" placeholder="Expiration Date"></td>
                            <td><button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
            `;
            tableBody.appendChild(newRow);
    }

</script>
