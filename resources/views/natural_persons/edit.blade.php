@extends('layouts.app')

@section('content')
    <h1>Edit Natural Person</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('natural-persons.update', $naturalPerson->id_natural_person) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control"
                   value="{{ $naturalPerson->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control"
                   value="{{ $naturalPerson->middle_name }}">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control"
                   value="{{ $naturalPerson->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="civil_status">Civil Status</label>
            <select name="civil_status" id="civil_status" class="form-control">
                @foreach ($civilStatuses as $status)
                    <option value="{{ $status->id }}"
                        {{ $naturalPerson->civil_status == $status->id ? 'selected' : '' }}>
                        {{ $status->type }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="Profession">Profession</label>
            <select name="Profession" id="Profession" class="form-control">
                @foreach ($professions as $profession)
                    <option value="{{ $profession->ID }}"
                        {{ $naturalPerson->Profession == $profession->ID ? 'selected' : '' }}>
                        {{ $profession->ActivityName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="country_of_birth">Country of Birth</label>
            <select name="country_of_birth" id="country_of_birth" class="form-control">
                @foreach ($countries as $country)
                    <option value="{{ $country->id_country }}"
                        {{ $naturalPerson->country_of_birth == $country->id_country ? 'selected' : '' }}>
                        {{ $country->country_name_iso_3166 }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
