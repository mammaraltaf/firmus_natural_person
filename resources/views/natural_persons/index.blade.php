@extends('layouts.app')

@section('title', 'Person Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Person List</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personModal" id="addPersonButton">Add Person</button>
        </div>
        <div class="card-body">
            <table id="personTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example Data -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                    <td>+1234567890</td>
                    <td>
                        <button class="btn btn-sm btn-warning editPersonButton" data-id="1" data-name="John Doe" data-email="john.doe@example.com" data-phone="+1234567890" data-bs-toggle="modal" data-bs-target="#personModal">Edit</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @include('natural_persons.modal')
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#personTable').DataTable();

            // Open modal for Add Person
            $('#addPersonButton').on('click', function () {
                $('#personForm')[0].reset();
                $('#personModalLabel').text('Add Person');
                $('#personModal').find('input, select').val('');
            });

            // Open modal for Edit Person
            $('.editPersonButton').on('click', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const phone = $(this).data('phone');

                $('#personModalLabel').text('Edit Person');
                $('#personModal').find('input[name="name"]').val(name);
                $('#personModal').find('input[name="email"]').val(email);
                $('#personModal').find('input[name="phone"]').val(phone);
            });
        });
    </script>
    <script>

        $(document).ready(function() {
            // Initialize SELECT2
            $('#country_of_birth').select2({
                placeholder: "Select Country",
                allowClear: true
            });

            // List of all countries with country codes
            const countries = [
                { id: 'AF', text: 'Afghanistan' },
                { id: 'AL', text: 'Albania' },
                { id: 'DZ', text: 'Algeria' },
                { id: 'AS', text: 'American Samoa' },
                { id: 'AD', text: 'Andorra' },
                { id: 'AO', text: 'Angola' },
                { id: 'AI', text: 'Anguilla' },
                { id: 'AG', text: 'Antigua and Barbuda' },
                { id: 'AR', text: 'Argentina' },
                { id: 'AM', text: 'Armenia' },
                { id: 'AW', text: 'Aruba' },
                { id: 'AU', text: 'Australia' },
                { id: 'AT', text: 'Austria' },
                { id: 'AZ', text: 'Azerbaijan' },
                { id: 'BS', text: 'Bahamas' },
                { id: 'BH', text: 'Bahrain' },
                { id: 'BD', text: 'Bangladesh' },
                { id: 'BB', text: 'Barbados' },
                { id: 'BY', text: 'Belarus' },
                { id: 'BE', text: 'Belgium' },
                { id: 'BZ', text: 'Belize' },
                { id: 'BJ', text: 'Benin' },
                { id: 'BM', text: 'Bermuda' },
                { id: 'BT', text: 'Bhutan' },
                { id: 'BO', text: 'Bolivia' },
                { id: 'BA', text: 'Bosnia and Herzegovina' },
                { id: 'BW', text: 'Botswana' },
                { id: 'BR', text: 'Brazil' },
                { id: 'BN', text: 'Brunei Darussalam' },
                { id: 'BG', text: 'Bulgaria' },
                { id: 'BF', text: 'Burkina Faso' },
                { id: 'BI', text: 'Burundi' },
                { id: 'KH', text: 'Cambodia' },
                { id: 'CM', text: 'Cameroon' },
                { id: 'CA', text: 'Canada' },
                { id: 'CV', text: 'Cape Verde' },
                { id: 'KY', text: 'Cayman Islands' },
                { id: 'CF', text: 'Central African Republic' },
                { id: 'TD', text: 'Chad' },
                { id: 'CL', text: 'Chile' },
                { id: 'CN', text: 'China' },
                { id: 'CO', text: 'Colombia' },
                { id: 'KM', text: 'Comoros' },
                { id: 'CG', text: 'Congo' },
                { id: 'CD', text: 'Congo (Democratic Republic of the)' },
                { id: 'CR', text: 'Costa Rica' },
                { id: 'CI', text: 'Côte d\'Ivoire' },
                { id: 'HR', text: 'Croatia' },
                { id: 'CU', text: 'Cuba' },
                { id: 'CY', text: 'Cyprus' },
                { id: 'CZ', text: 'Czech Republic' },
                { id: 'DK', text: 'Denmark' },
                { id: 'DJ', text: 'Djibouti' },
                { id: 'DM', text: 'Dominica' },
                { id: 'DO', text: 'Dominican Republic' },
                { id: 'EC', text: 'Ecuador' },
                { id: 'EG', text: 'Egypt' },
                { id: 'SV', text: 'El Salvador' },
                { id: 'GQ', text: 'Equatorial Guinea' },
                { id: 'ER', text: 'Eritrea' },
                { id: 'EE', text: 'Estonia' },
                { id: 'ET', text: 'Ethiopia' },
                { id: 'FK', text: 'Falkland Islands (Malvinas)' },
                { id: 'FO', text: 'Faroe Islands' },
                { id: 'FJ', text: 'Fiji' },
                { id: 'FI', text: 'Finland' },
                { id: 'FR', text: 'France' },
                { id: 'GF', text: 'French Guiana' },
                { id: 'PF', text: 'French Polynesia' },
                { id: 'GA', text: 'Gabon' },
                { id: 'GM', text: 'Gambia' },
                { id: 'GE', text: 'Georgia' },
                { id: 'DE', text: 'Germany' },
                { id: 'GH', text: 'Ghana' },
                { id: 'GI', text: 'Gibraltar' },
                { id: 'GR', text: 'Greece' },
                { id: 'GL', text: 'Greenland' },
                { id: 'GD', text: 'Grenada' },
                { id: 'GU', text: 'Guam' },
                { id: 'GT', text: 'Guatemala' },
                { id: 'GN', text: 'Guinea' },
                { id: 'GW', text: 'Guinea-Bissau' },
                { id: 'GY', text: 'Guyana' },
                { id: 'HT', text: 'Haiti' },
                { id: 'HN', text: 'Honduras' },
                { id: 'HK', text: 'Hong Kong' },
                { id: 'HU', text: 'Hungary' },
                { id: 'IS', text: 'Iceland' },
                { id: 'IN', text: 'India' },
                { id: 'ID', text: 'Indonesia' },
                { id: 'IR', text: 'Iran' },
                { id: 'IQ', text: 'Iraq' },
                { id: 'IE', text: 'Ireland' },
                { id: 'IL', text: 'Israel' },
                { id: 'IT', text: 'Italy' },
                { id: 'JM', text: 'Jamaica' },
                { id: 'JP', text: 'Japan' },
                { id: 'JO', text: 'Jordan' },
                { id: 'KZ', text: 'Kazakhstan' },
                { id: 'KE', text: 'Kenya' },
                { id: 'KI', text: 'Kiribati' },
                { id: 'KP', text: 'Korea (North)' },
                { id: 'KR', text: 'Korea (South)' },
                { id: 'KW', text: 'Kuwait' },
                { id: 'KG', text: 'Kyrgyzstan' },
                { id: 'LA', text: 'Laos' },
                { id: 'LV', text: 'Latvia' },
                { id: 'LB', text: 'Lebanon' },
                { id: 'LS', text: 'Lesotho' },
                { id: 'LR', text: 'Liberia' },
                { id: 'LY', text: 'Libya' },
                { id: 'LI', text: 'Liechtenstein' },
                { id: 'LT', text: 'Lithuania' },
                { id: 'LU', text: 'Luxembourg' },
                { id: 'MO', text: 'Macao' },
                { id: 'MK', text: 'Macedonia' },
                { id: 'MG', text: 'Madagascar' },
                { id: 'MW', text: 'Malawi' },
                { id: 'MY', text: 'Malaysia' },
                { id: 'MV', text: 'Maldives' },
                { id: 'ML', text: 'Mali' },
                { id: 'MT', text: 'Malta' },
                { id: 'MH', text: 'Marshall Islands' },
                { id: 'MQ', text: 'Martinique' },
                { id: 'MR', text: 'Mauritania' },
                { id: 'MU', text: 'Mauritius' },
                { id: 'YT', text: 'Mayotte' },
                { id: 'MX', text: 'Mexico' },
                { id: 'FM', text: 'Micronesia' },
                { id: 'MD', text: 'Moldova' },
                { id: 'MC', text: 'Monaco' },
                { id: 'MN', text: 'Mongolia' },
                { id: 'ME', text: 'Montenegro' },
                { id: 'MS', text: 'Montserrat' },
                { id: 'MA', text: 'Morocco' },
                { id: 'MZ', text: 'Mozambique' },
                { id: 'MM', text: 'Myanmar' },
                { id: 'NA', text: 'Namibia' },
                { id: 'NR', text: 'Nauru' },
                { id: 'NP', text: 'Nepal' },
                { id: 'NL', text: 'Netherlands' },
                { id: 'NC', text: 'New Caledonia' },
                { id: 'NZ', text: 'New Zealand' },
                { id: 'NI', text: 'Nicaragua' },
                { id: 'NE', text: 'Niger' },
                { id: 'NG', text: 'Nigeria' },
                { id: 'NU', text: 'Niue' },
                { id: 'NF', text: 'Norfolk Island' },
                { id: 'NO', text: 'Norway' },
                { id: 'OM', text: 'Oman' },
                { id: 'PK', text: 'Pakistan' },
                { id: 'PW', text: 'Palau' },
                { id: 'PS', text: 'Palestinian Territory' },
                { id: 'PA', text: 'Panama' },
                { id: 'PG', text: 'Papua New Guinea' },
                { id: 'PY', text: 'Paraguay' },
                { id: 'PE', text: 'Peru' },
                { id: 'PH', text: 'Philippines' },
                { id: 'PN', text: 'Pitcairn Islands' },
                { id: 'PL', text: 'Poland' },
                { id: 'PT', text: 'Portugal' },
                { id: 'PR', text: 'Puerto Rico' },
                { id: 'QA', text: 'Qatar' },
                { id: 'RO', text: 'Romania' },
                { id: 'RU', text: 'Russia' },
                { id: 'RW', text: 'Rwanda' },
                { id: 'RE', text: 'Réunion' },
                { id: 'BL', text: 'Saint Barthélemy' },
                { id: 'SH', text: 'Saint Helena' },
                { id: 'KN', text: 'Saint Kitts and Nevis' },
                { id: 'LC', text: 'Saint Lucia' },
                { id: 'MF', text: 'Saint Martin' },
                { id: 'PM', text: 'Saint Pierre and Miquelon' },
                { id: 'VC', text: 'Saint Vincent and the Grenadines' },
                { id: 'WS', text: 'Samoa' },
                { id: 'SM', text: 'San Marino' },
                { id: 'ST', text: 'São Tomé and Príncipe' },
                { id: 'SA', text: 'Saudi Arabia' },
                { id: 'SN', text: 'Senegal' },
                { id: 'RS', text: 'Serbia' },
                { id: 'SC', text: 'Seychelles' },
                { id: 'SL', text: 'Sierra Leone' },
                { id: 'SG', text: 'Singapore' },
                { id: 'SX', text: 'Sint Maarten' },
                { id: 'SK', text: 'Slovakia' },
                { id: 'SI', text: 'Slovenia' },
                { id: 'SB', text: 'Solomon Islands' },
                { id: 'SO', text: 'Somalia' },
                { id: 'ZA', text: 'South Africa' },
                { id: 'GS', text: 'South Georgia and the South Sandwich Islands' },
                { id: 'ES', text: 'Spain' },
                { id: 'LK', text: 'Sri Lanka' },
                { id: 'SD', text: 'Sudan' },
                { id: 'SR', text: 'Suriname' },
                { id: 'SJ', text: 'Svalbard and Jan Mayen' },
                { id: 'SZ', text: 'Swaziland' },
                { id: 'SE', text: 'Sweden' },
                { id: 'CH', text: 'Switzerland' },
                { id: 'SY', text: 'Syria' },
                { id: 'TW', text: 'Taiwan' },
                { id: 'TJ', text: 'Tajikistan' },
                { id: 'TZ', text: 'Tanzania' },
                { id: 'TH', text: 'Thailand' },
                { id: 'TL', text: 'Timor-Leste' },
                { id: 'TG', text: 'Togo' },
                { id: 'TK', text: 'Tokelau' },
                { id: 'TO', text: 'Tonga' },
                { id: 'TT', text: 'Trinidad and Tobago' },
                { id: 'TN', text: 'Tunisia' },
                { id: 'TR', text: 'Turkey' },
                { id: 'TM', text: 'Turkmenistan' },
                { id: 'TC', text: 'Turks and Caicos Islands' },
                { id: 'TV', text: 'Tuvalu' },
                { id: 'UG', text: 'Uganda' },
                { id: 'UA', text: 'Ukraine' },
                { id: 'AE', text: 'United Arab Emirates' },
                { id: 'GB', text: 'United Kingdom' },
                { id: 'US', text: 'United States' },
                { id: 'UM', text: 'United States Minor Outlying Islands' },
                { id: 'UY', text: 'Uruguay' },
                { id: 'UZ', text: 'Uzbekistan' },
                { id: 'VU', text: 'Vanuatu' },
                { id: 'VE', text: 'Venezuela' },
                { id: 'VN', text: 'Vietnam' },
                { id: 'VG', text: 'Virgin Islands (UK)' },
                { id: 'VI', text: 'Virgin Islands (US)' },
                { id: 'WF', text: 'Wallis and Futuna' },
                { id: 'EH', text: 'Western Sahara' },
                { id: 'YE', text: 'Yemen' },
                { id: 'ZM', text: 'Zambia' },
                { id: 'ZW', text: 'Zimbabwe' }
            ];

            // Populate the select with countries
            countries.forEach(function(country) {
                const option = new Option(country.text, country.id, false, false);
                $('#country_of_birth').append(option);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Add Profession Row
            document.getElementById('addProfessionRow').addEventListener('click', function () {
                const professionsTable = document.querySelector('#professionsTable tbody');
                const newRow = `
            <tr>
                <td>
                    <input type="text" class="form-control" name="professions[]" placeholder="Enter profession" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            </tr>`;
                professionsTable.insertAdjacentHTML('beforeend', newRow);
            });

            // Add Civil Status Row
            document.getElementById('addCivilStatusRow').addEventListener('click', function () {
                const civilStatusTable = document.querySelector('#civilStatusTable tbody');
                const newRow = `
            <tr>
                <td>
                    <input type="text" class="form-control" name="civil_status[]" placeholder="Enter civil status" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            </tr>`;
                civilStatusTable.insertAdjacentHTML('beforeend', newRow);
            });

            // Remove Row
            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-row')) {
                    event.target.closest('tr').remove();
                }
            });
        });

    </script>
@endpush
