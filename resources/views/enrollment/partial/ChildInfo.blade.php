<div class="section-body">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="font-weight-bold mb-2">
                Child information
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                    <input type="text" id="first_name" name="first_name"
                        value="{{ old('first_name', $childInfo->first_name ?? '') }}" class="form-control" required
                        readonly />
                </div>
                <div class="form-group col-md-4">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name"
                        value="{{ old('middle_name', $childInfo->middle_name ?? '') }}" class="form-control" readonly />
                </div>
                <div class="form-group col-md-4">
                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                    <input type="text" id="last_name" name="last_name"
                        value="{{ old('last_name', $childInfo->last_name ?? '') }}" class="form-control" required
                        readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="gender_id">Gender</label>
                    <select id="gender_id" name="gender_id" class="form-control">
                        <option value="">Select Gender</option>
                        @foreach($genders as $gender)
                        <option value="{{ $gender->id }}"
                            {{ old('gender_id', $childInfo->gender_id ?? '') == $gender->id ? 'selected' : '' }}>
                            {{ ucfirst($gender->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="birth_date">Birthdate</label>
                    <input type="date" id="birth_date" name="birth_date"
                        value="{{ old('birth_date', $childInfo->birth_date ?? '') }}" class="form-control" />
                </div>
                <div class="form-group col-md-4">
                    <label for="age">Age</label>
                    @php
                    $birth = old('birth_date', $childInfo->birth_date ?? null);
                    $initialAge = '';
                    if ($birth) {
                    try {
                    $initialAge = \Carbon\Carbon::parse($birth)->age;
                    } catch (\Exception $e) {
                    $initialAge = '';
                    }
                    }
                    @endphp
                    <input type="number" id="age" name="age" value="{{ old('age', $initialAge) }}"
                        class="form-control bg-light" readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="house_number">House no. and Street</label>
                    <input type="text" id="house_number" name="house_number"
                        value="{{ old('house_number', $childInfo->house_number ?? '') }}" placeholder="e.g. 123 Main St"
                        class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label for="district_id">District</label>
                    <select id="district_id" name="district_id" class="form-control">
                        <option value="">Select District</option>
                        @foreach($districts as $d)
                        <option value="{{ $d->id }}" {{ $selectedDistrict == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="barangay_id">Barangay</label>
                    <select id="barangay_id" name="barangay_id" class="form-control">
                        <option value="">Select Barangay</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city"
                        value="{{ old('city', $childInfo->city ?? 'Taguig City') }}" class="form-control bg-light"
                        readonly />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const birthInput = document.getElementById('birth_date');
    const ageInput = document.getElementById('age');

    function calculateAge(dateString) {
        if (!dateString) return '';
        const today = new Date();
        const birthDate = new Date(dateString);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age >= 0 ? age : '';
    }

    function updateAge() {
        ageInput.value = calculateAge(birthInput.value);
    }

    updateAge();

    birthInput.addEventListener('input', updateAge);
    birthInput.addEventListener('change', updateAge);
});

document.addEventListener('DOMContentLoaded', function() {
    const allBarangays = @json($barangays);

    const districtSelect = document.getElementById('district_id');
    const barangaySelect = document.getElementById('barangay_id');

    let selectedBarangay = '{{ $selectedBarangay }}';

    function populateBarangays(districtId) {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (!districtId) {
            return;
        }

        const filtered = allBarangays.filter(b => b.district_id == districtId);

        filtered.forEach(b => {
            const opt = document.createElement('option');
            opt.value = b.id;
            opt.textContent = b.name;
            if (String(b.id) === selectedBarangay) {
                opt.selected = true;
            }
            barangaySelect.appendChild(opt);
        });
    }

    populateBarangays(districtSelect.value);

    districtSelect.addEventListener('change', function() {
        selectedBarangay = '';
        populateBarangays(this.value);
    });
});
</script>