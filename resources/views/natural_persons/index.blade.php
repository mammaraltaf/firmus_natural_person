@extends('layouts.app')

@section('title', 'Person Management')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('messages.person_list') }}</h4>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personModal" id="addPersonButton">
                {{ __('messages.add_person') }}
            </button>
        </div>
        <div class="card-body">
            <table id="personTable" class="table table-striped table-bordered display responsive nowrap" >
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Prefix</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Other Last Name</th>
                    <th>Given Name</th>
                    <th>Date of Birth</th>
                    <th>Town of Birth</th>
                    <th>Country of birth</th>
                    <th>Civil status</th>
                    <th>Profession</th>
                    <th>User Name</th>
                    <th>Computer Name</th>
                    <th>Creation Date</th>
                    <th>UserName LM</th>
                    <th>Computer NameLM</th>
                    <th>Date Modified</th>
                    <th>Tax Number</th>
                    <th>digitoVerificadorRUC</th>
                    <th>codigoUbicacion</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($naturalPersons as $person)
                    <tr>
                        <td>{{$person->id_natural_person  ?? ''}}</td>
                        <td>{{$person->prefix ?? ''}}</td>
                        <td>{{$person->first_name ?? ''}}</td>
                        <td>{{$person->middle_name ?? ''}}</td>
                        <td>{{$person->last_name ?? ''}}</td>
                        <td>{{$person->other_last_name ?? ''}}</td>
                        <td>{{$person->given_name ?? ''}}</td>
                        <td>{{$person->date_of_birth ?? ''}}</td>
                        <td>{{$person->town_of_birth ?? ''}}</td>
                        <td>{{$person->country_of_birth ?? ''}}</td>
                        <td>{{$person->civil_status ?? ''}}</td>
                        <td>{{$person->Profession ?? ''}}</td>
                        <td>{{$person->UserName ?? ''}}</td>
                        <td>{{$person->ComputerName ?? ''}}</td>
                        <td>{{$person->CreationDate ?? ''}}</td>
                        <td>{{$person->UserNameLM ?? ''}}</td>
                        <td>{{$person->ComputerNameLM ?? ''}}</td>
                        <td>{{$person->DateModified ?? ''}}</td>
                        <td>{{$person->TaxNumber ?? ''}}</td>
                        <td>{{$person->digitoVerificadorRUC ?? ''}}</td>
                        <td>{{$person->codigoUbicacion ?? ''}}</td>
                        <td>
                            <button
                                class="btn btn-sm btn-warning editPersonButton"
                                data-id_natural_person="{{$person->id_natural_person}}"
                                data-prefix="{{$person->prefix}}"
                                data-first_name="{{$person->first_name}}"
                                data-middle_name="{{$person->middle_name}}"
                                data-last_name="{{$person->last_name}}"
                                data-other_last_name="{{$person->other_last_name}}"
                                data-given_name="{{$person->given_name}}"
                                data-date_of_birth="{{$person->date_of_birth}}"
                                data-town_of_birth="{{$person->town_of_birth}}"
                                data-country_of_birth="{{$person->country_of_birth}}"
                                data-civil_status="{{$person->civil_status}}"
                                data-Profession="{{$person->Profession}}"
                                data-UserName="{{$person->UserName}}"
                                data-ComputerName="{{$person->ComputerName}}"
                                data-CreationDate="{{$person->CreationDate}}"
                                data-UserNameLM="{{$person->UserNameLM}}"
                                data-ComputerNameLM="{{$person->ComputerNameLM}}"
                                data-DateModified="{{$person->DateModified}}"
                                data-TaxNumber="{{$person->TaxNumber}}"
                                data-digitoVerificadorRUC="{{$person->digitoVerificadorRUC}}"
                                data-codigoUbicacion="{{$person->codigoUbicacion}}"
                                data-bs-toggle="modal"
                                data-bs-target="#personModal">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('natural_persons.modal')
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#personTable').DataTable( {
                responsive: true, // Enables the responsive feature
                paging: true,     // Adds pagination
                searching: true,  // Enables the search box
                scrollX: true,    // Adds horizontal scrolling if needed
                lengthMenu: [10, 20, 50], // Options for rows per page
            });
            $('#addPersonButton').on('click', function() {
                $('#prefix').val('');
                $('#first_name').val('');
                $('#middle_name').val('');
                $('#last_name').val('');
                $('#other_last_name').val('');
                $('#given_name').val('');
                $('#date_of_birth').val('');
                $('#town_of_birth').val('');
                $('#country_of_birth').val('');
                $('#civil_status').val('');
                $('#Profession').val('');
                $('#UserName').val('');
                $('#ComputerName').val('');
                $('#CreationDate').val('');
                $('#UserNameLM').val('');
                $('#ComputerNameLM').val('');
                $('#DateModified').val('');
                $('#TaxNumber').val('');
                $('#digitoVerificadorRUC').val('');
                $('#codigoUbicacion').val('');
            });

            $('.editPersonButton').on('click', function() {
                console.log($(this).data());

                // Get data attributes from the clicked button
                var personId = $(this).data('id_natural_person');
                let prefix = $(this).data('prefix');
                let first_name = $(this).data('first_name');
                let middle_name = $(this).data('middle_name');
                let last_name = $(this).data('last_name');
                let other_last_name = $(this).data('other_last_name');
                let given_name = $(this).data('given_name');
                let date_of_birth = $(this).data('date_of_birth');
                let town_of_birth = $(this).data('town_of_birth');
                let country_of_birth = $(this).data('country_of_birth');
                let civil_status = $(this).data('civil_status');
                let Profession = $(this).data('profession');
                let UserName = $(this).data('UserName');
                let ComputerName = $(this).data('ComputerName');
                let CreationDate = $(this).data('CreationDate');
                let UserNameLM = $(this).data('UserNameLM');
                let ComputerNameLM = $(this).data('ComputerNameLM');
                let DateModified = $(this).data('DateModified');
                let TaxNumber = $(this).data('taxnumber');
                let digitoVerificadorRUC = $(this).data('digitoverificadorruc');
                let codigoUbicacion = $(this).data('codigoubicacion');


                // Change the modal title
                $('#naturalPersonModalLabel').text('Edit Person');


                // Populate the modal form fields
                $('#prefix').val(prefix);
                $('#first_name').val(first_name);
                $('#middle_name').val(middle_name);
                $('#last_name').val(last_name);
                $('#other_last_name').val(other_last_name);
                $('#given_name').val(given_name);
                let formattedDateOfBirth = new Date(date_of_birth).toISOString().split('T')[0];
                $('#date_of_birth').val(formattedDateOfBirth);
                $('#town_of_birth').val(town_of_birth);
                $('#country_of_birth').val(country_of_birth);
                $('#civil_status').val(civil_status);
                $('#Profession').val(Profession);
                $('#UserName').val(UserName);
                $('#ComputerName').val(ComputerName);
                $('#CreationDate').val(CreationDate);
                $('#UserNameLM').val(UserNameLM);
                $('#ComputerNameLM').val(ComputerNameLM);
                $('#DateModified').val(DateModified);
                $('#TaxNumber').val(TaxNumber);
                $('#digitoVerificadorRUC').val(digitoVerificadorRUC);
                $('#codigoUbicacion').val(codigoUbicacion);


                // Set the form action to update the person (adjust this to your actual URL structure)
                $('#personForm').attr('action', '{{ route('natural-person.update', ':id') }}'.replace(':id', personId));
                $('input[name="_method"]').val('PUT');

                // Change the form button text to 'Update'
                $('#formButton').text('Update');
            });
        });
    </script>
@endpush
