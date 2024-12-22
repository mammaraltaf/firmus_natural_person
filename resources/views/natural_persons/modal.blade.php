<div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="personModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="naturalPersonModalLabel">Add/Edit Natural Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personForm">
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
                                <!-- Dynamic options will be populated here -->
                            </select>
                        </div>

                        <!-- Tax Number -->
                        <div class="col-md-4">
                            <label for="tax_number" class="form-label">Tax Number</label>
                            <input type="text" class="form-control" id="tax_number" name="tax_number">
                        </div>

                        <!-- Verifier Digit -->
                        <div class="col-md-4">
                            <label for="digito_verificador_ruc" class="form-label">Verifier Digit (RUC)</label>
                            <input type="text" class="form-control" id="digito_verificador_ruc" name="digito_verificador_ruc">
                        </div>

                        <!-- Location Code -->
                        <div class="col-md-4">
                            <label for="codigo_ubicacion" class="form-label">Location Code</label>
                            <input type="text" class="form-control" id="codigo_ubicacion" name="codigo_ubicacion">
                        </div>

                        <!-- Civil Status Section -->
                        <div class="col-12">
                            <h5>Civil Status</h5>
                            <table class="table table-bordered" id="civilStatusTable">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="civil_status[]" placeholder="Enter civil status" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="addCivilStatusRow">Add Civil Status</button>
                        </div>

                        <!-- Professions Section -->
                        <div class="col-12">
                            <h5>Professions</h5>
                            <table class="table table-bordered" id="professionsTable">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Activity Name</th>
                                    <th>Risk Value</th>
                                    <th>Risk Level</th>
                                    <th>High Risk Automatic</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="code[]" placeholder="Enter Code" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="activity_name[]" placeholder="Enter Activity Name" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="risk_value[]" placeholder="Enter Risk Value" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="risk_level[]" placeholder="Enter Risk Level" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="high_risk_automatic[]" placeholder="Enter High Risk Automatic" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="addProfessionRow">Add Profession</button>
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
