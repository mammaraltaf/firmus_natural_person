@extends('layouts.app')

@section('title', 'Person Management')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"/>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ __('messages.natural_person') }}</h4>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personModal" id="addPersonButton">
                {{ __('messages.add_natural_person') }}
            </button>
        </div>
        <div class="card-body">
            <table id="personTable" class="table table-striped table-bordered display responsive nowrap">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.birth') }}</th>
                    <th>{{ __('messages.civil_status') }}</th>
                    <th>{{ __('messages.profession') }}</th>
                    <th>{{ __('messages.invoice') }}</th>
                    <th>{{ __('messages.contact') }}</th>
                    <th>{{ __('messages.nationality') }}</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($naturalPersons as $person)
                    <tr>
                        <td>{{$person->id_natural_person  ?? ''}}</td>
                        <td>
                            {{$person->prefix .' '. $person->first_name.' '.$person->middle_name.' '.$person->last_name}}
                        </td>
                        <td>
                            <b>DOB:</b> {{Carbon\Carbon::parse($person->date_of_birth)->format('m/d/Y')}}<br>
                            <b>Town:</b> {{$person->town_of_birth ?? ''}} <br>
                            <b>Country:</b> {{\App\Models\CountryList::where('id_country',$person->country_of_birth)->first()->country_smv}}
                            <br>
                        </td>
                        <td>{{\App\Models\CivilStatus::where('id',$person->civil_status)->first()?->type ?? ''}}</td>
                        <td>{{\App\Models\Profession::where('id',$person->Profession)->first()?->ActivityName ?? ''}}</td>
                        <td>
                            <b>Tax:</b> {{$person->TaxNumber ?? ''}} <br>
                            <b>digitoVerificadorRUC:</b> {{$person->digitoVerificadorRUC ?? ''}} <br>
                            <b>codigoUbicacion:</b> {{$person->codigoUbicacion ?? ''}}
                        </td>
                        <td>
                            @foreach($person->naturalPersonContacts as $contact)
                                <b>Type</b> {{\App\Models\ContactType::where('ID',$contact->IDContactType)->first()?->Type}}
                                <br>
                                <b>Value</b> {{$contact->Data}}
                            @endforeach
                        </td>
                        <td>
                            @foreach($person->nationalities as $nationality)
                                <b>Nationality</b> {{\App\Models\CountryList::where('id_country',$nationality->id_country)->first()?->country_smv}}
                                <br>
                                @if($nationality->identifyDocumentNaturalPerson != null)
                                    <b>Documents:</b><br>
                                    @foreach($nationality->identifyDocumentNaturalPerson as $document)
                                        <b>Type</b> {{\App\Models\TypeOfIdentityDocument::where('id',$document->type_of_identity_document)->first()?->type }}
                                        <br>
                                        <b>Reference</b> {{ $document->reference_number}} <br>
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('natural-person.edit',$person->id_natural_person)}}" class="btn btn-primary">Edit</a>
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
            $('#personTable').DataTable({
                responsive: true, // Enables the responsive feature
                paging: true,     // Adds pagination
                searching: true,  // Enables the search box
                scrollX: true,    // Adds horizontal scrolling if needed
                lengthMenu: [10, 20, 50], // Options for rows per page
            });
            $('#addPersonButton').on('click', function () {
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

            {{--$('.editPersonButton').on('click', function () {--}}
            {{--    console.log($(this).data());--}}

            {{--    // Get data attributes from the clicked button--}}
            {{--    var personId = $(this).data('id_natural_person');--}}
            {{--    let prefix = $(this).data('prefix');--}}
            {{--    let first_name = $(this).data('first_name');--}}
            {{--    let middle_name = $(this).data('middle_name');--}}
            {{--    let last_name = $(this).data('last_name');--}}
            {{--    let other_last_name = $(this).data('other_last_name');--}}
            {{--    let given_name = $(this).data('given_name');--}}
            {{--    let date_of_birth = $(this).data('date_of_birth');--}}
            {{--    let town_of_birth = $(this).data('town_of_birth');--}}
            {{--    let country_of_birth = $(this).data('country_of_birth');--}}
            {{--    let civil_status = $(this).data('civil_status');--}}
            {{--    let Profession = $(this).data('profession');--}}
            {{--    let UserName = $(this).data('UserName');--}}
            {{--    let ComputerName = $(this).data('ComputerName');--}}
            {{--    let CreationDate = $(this).data('CreationDate');--}}
            {{--    let UserNameLM = $(this).data('UserNameLM');--}}
            {{--    let ComputerNameLM = $(this).data('ComputerNameLM');--}}
            {{--    let DateModified = $(this).data('DateModified');--}}
            {{--    let TaxNumber = $(this).data('taxnumber');--}}
            {{--    let digitoVerificadorRUC = $(this).data('digitoverificadorruc');--}}
            {{--    let codigoUbicacion = $(this).data('codigoubicacion');--}}


            {{--    // Change the modal title--}}
            {{--    $('#naturalPersonModalLabel').text('Edit Person');--}}


            {{--    // Populate the modal form fields--}}
            {{--    $('#prefix').val(prefix);--}}
            {{--    $('#first_name').val(first_name);--}}
            {{--    $('#middle_name').val(middle_name);--}}
            {{--    $('#last_name').val(last_name);--}}
            {{--    $('#other_last_name').val(other_last_name);--}}
            {{--    $('#given_name').val(given_name);--}}
            {{--    let formattedDateOfBirth = new Date(date_of_birth).toISOString().split('T')[0];--}}
            {{--    $('#date_of_birth').val(formattedDateOfBirth);--}}
            {{--    $('#town_of_birth').val(town_of_birth);--}}
            {{--    $('#country_of_birth').val(country_of_birth);--}}
            {{--    $('#civil_status').val(civil_status);--}}
            {{--    $('#Profession').val(Profession);--}}
            {{--    $('#UserName').val(UserName);--}}
            {{--    $('#ComputerName').val(ComputerName);--}}
            {{--    $('#CreationDate').val(CreationDate);--}}
            {{--    $('#UserNameLM').val(UserNameLM);--}}
            {{--    $('#ComputerNameLM').val(ComputerNameLM);--}}
            {{--    $('#DateModified').val(DateModified);--}}
            {{--    $('#TaxNumber').val(TaxNumber);--}}
            {{--    $('#digitoVerificadorRUC').val(digitoVerificadorRUC);--}}
            {{--    $('#codigoUbicacion').val(codigoUbicacion);--}}


            {{--    // Set the form action to update the person (adjust this to your actual URL structure)--}}
            {{--    $('#personForm').attr('action', '{{ route('natural-person.update', ':id') }}'.replace(':id', personId));--}}
            {{--    $('input[name="_method"]').val('PUT');--}}

            {{--    // Change the form button text to 'Update'--}}
            {{--    $('#formButton').text('Update');--}}
            {{--});--}}
        });
    </script>
@endpush
