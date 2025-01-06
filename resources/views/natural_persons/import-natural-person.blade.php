@extends('layouts.app')

@section('content')
    <h1>Import Natural Persons</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('natural-person.import.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="naturalPersons" class="form-label">Select Natural Persons</label>
            <select name="naturalPersons[]" id="naturalPersons" class="form-control select2" multiple="multiple">
                @foreach($ff_apn_es_natural_persons as $naturalPerson)
                    <option value="{{ $naturalPerson->id }}">{{ $naturalPerson->account_number .'-'. ($naturalPerson->E_Name .' '. $naturalPerson->E_surname) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Import Selected Natural Persons</button>
    </form>
@endsection

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#naturalPersons').select2({
                placeholder: "Select natural persons",
                allowClear: true
            });
        });
    </script>
@endpush
