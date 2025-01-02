@extends('layouts.app')

@section('content')
    <h1>Natural Person Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $naturalPerson->first_name }} {{ $naturalPerson->last_name }}</h5>
            <p class="card-text"><strong>Middle Name:</strong> {{ $naturalPerson->middle_name }}</p>
            <p class="card-text"><strong>Date of Birth:</strong> {{ $naturalPerson->date_of_birth }}</p>
            <p class="card-text"><strong>Civil Status:</strong> {{ $naturalPerson->civilStatus->type }}</p>
            <p class="card-text"><strong>Profession:</strong> {{ $naturalPerson->profession->ActivityName }}</p>
            <p class="card-text"><strong>Country of Birth:</strong> {{ $naturalPerson->country->country_name_iso_3166 }}</p>
            <a href="{{ route('natural-persons.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
