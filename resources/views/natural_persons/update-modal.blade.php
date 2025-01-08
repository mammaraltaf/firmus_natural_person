<div class="modal fade" id="personUpdateModal" tabindex="-1" aria-labelledby="personUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personUpdateModalLabel">Update Natural Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personUpdateForm" method="post" action="{{route('natural-person.update', $person->id)}}">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="card mb-4">
                        <div class="card-header">Personal Information</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label for="prefix" class="form-label">Prefix</label>
                                    <input type="text" class="form-control" id="prefix" name="prefix" value="{{ $person->prefix }}" maxlength="10">
                                </div>
                                <div class="col-md-2">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $person->first_name }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $person->middle_name }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $person->last_name }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="other_last_name" class="form-label">Other Last Name</label>
                                    <input type="text" class="form-control" id="other_last_name" name="other_last_name" value="{{ $person->other_last_name }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="given_name" class="form-label">Given Name</label>
                                    <input type="text" class="form-control" id="given_name" name="given_name" value="{{ $person->given_name }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $person->date_of_birth }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="town_of_birth" class="form-label">Town of Birth</label>
                                    <input type="text" class="form-control" id="town_of_birth" name="town_of_birth" value="{{ $person->town_of_birth }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="country_of_birth" class="form-label">Country of Birth</label>
                                    <select id="country_of_birth" name="country_of_birth" class="form-select select2">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id_country}}" {{ $country->id_country == $person->country_of_birth ? 'selected' : '' }}>{{$country->country_name_iso_3166 ?? $country->country_smv}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="civil_status" class="form-label">Civil Status</label>
                                    <select id="civil_status" name="civil_status" class="form-select select2">
                                        <option value="">Select Civil Status</option>
                                        @foreach($civilStatuses as $civilStatus)
                                            <option value="{{$civilStatus->id}}" {{ $civilStatus->id == $person->civil_status ? 'selected' : '' }}>{{$civilStatus->type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="Profession" class="form-label">Professions</label>
                                    <select id="Profession" name="Profession" class="form-select select2">
                                        <option value="">Select Professions</option>
                                        @foreach($professions as $profession)
                                            <option value="{{$profession->ID}}" {{ $profession->ID == $person->profession ? 'selected' : '' }}>{{$profession->ActivityName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tax and Invoice Data Section -->
                    <div class="card mb-4">
                        <div class="card-header">Invoice</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="taxNumber" class="form-label">Tax Number</label>
                                    <input type="text" class="form-control" id="taxNumber" name="taxNumber" value="{{ $person->taxNumber }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="digitoVerificadorRUC" class="form-label">digitoVerificadorRUC</label>
                                    <input type="text" class="form-control" id="digitoVerificadorRUC" name="digitoVerificadorRUC" value="{{ $person->digitoVerificadorRUC }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="codigoUbicacion" class="form-label">codigoUbicacion</label>
                                    <input type="text" class="form-control" id="codigoUbicacion" name="codigoUbicacion" value="{{ $person->codigoUbicacion }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Data Section -->
                    <div class="card mb-4">
                        <div class="card-header">Contact</div>
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
                                <tbody id="contactTableBody">
                                @foreach($person->contacts as $contact)
                                    <tr>
                                        <td>
                                            <select name="contacts[{{ $loop->index }}][type]" class="form-select select2">
                                                <option value="">Select Type of Contact</option>
                                                @foreach($contactTypes as $contactType)
                                                    <option value="{{$contactType->ID}}" {{ $contactType->ID == $contact->type ? 'selected' : '' }}>{{$contactType->Type}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="contacts[{{ $loop->index }}][value]" value="{{ $contact->value }}" placeholder="Value"></td>
                                        <td><input type="text" class="form-control" name="contacts[{{ $loop->index }}][description]" value="{{ $contact->description }}" placeholder="Description/Notes"></td>
                                        <td><input type="checkbox" name="contacts[{{ $loop->index }}][authorized]" {{ $contact->authorized ? 'checked' : '' }}></td>
                                        <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" onclick="addContactRow(event)">Add Contact</button>
                        </div>
                    </div>

                    <!-- Nationality Data Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">Nationality Document</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nationality</th>
                                            <th>Type</th>
                                            <th>Reference Number</th>
                                            <th>Expiration Date</th>
                                        </tr>
                                        </thead>
                                        <tbody id="nationalityDocumentsTableBody">
                                        @foreach($person->nationalityDocuments as $document)
                                            <tr>
                                                <td>
                                                    <select name="nationality_documents[{{ $loop->index }}][country]" class="form-select select2">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id_country}}" {{ $country->id_country == $document->country ? 'selected' : '' }}>{{$country->country_name_iso_3166 ?? $country->country_smv}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="nationality_documents[{{ $loop->index }}][type]" class="form-select select2">
                                                        <option value="">Select Type</option>
                                                        @foreach($typeOfIdentityDocuments as $type)
                                                            <option value="{{$type->id}}" {{ $type->id == $document->type ? 'selected' : '' }}>{{$type->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="nationality_documents[{{ $loop->index }}][reference]" value="{{ $document->reference }}"></td>
                                                <td><input type="date" class="form-control" name="nationality_documents[{{ $loop->index }}][expiration]" value="{{ $document->expiration }}"></td>
                                                <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary" onclick="addNationalityDocumentsRow(event)">Add Nationality Document</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
