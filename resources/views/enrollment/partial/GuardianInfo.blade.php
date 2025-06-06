@php
use Carbon\Carbon;
$m_birth = old('mother_birthdate', $fetchedMother->birth_date ?? null);
$m_initialAge = $m_birth ? Carbon::parse($m_birth)->age : '';
$f_birth = old('father_birthdate', $fetchedFather->birth_date ?? null);
$f_initialAge = $f_birth ? Carbon::parse($f_birth)->age : '';
@endphp

<div class="section-body">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Mother’s Information</h3>
        </div>
        <div class="card-body">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="mother_name" class="font-weight-medium">Full Name <span
                            class="text-danger">*</span></label>
                    <input type="text" id="mother_name" name="mother_name"
                        value="{{ old('mother_name', trim(($motherInfo->user->first_name ?? '') . ' ' . ($motherInfo->user->middle_name ?? '') . ' ' . ($motherInfo->user->last_name ?? '')) ?: ($fetchedMother->name ?? '')) }}"
                        class="form-control" placeholder="e.g. Maria Santos" />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_birthdate" class="font-weight-medium">Birthdate</label>
                    <input type="date" id="mother_birthdate" name="mother_birthdate"
                        value="{{ old('mother_birthdate', $fetchedMother->birth_date ?? '') }}" class="form-control" />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_age" class="font-weight-medium">Age</label>
                    <input type="number" id="mother_age" name="mother_age"
                        value="{{ old('mother_age', $m_initialAge) }}" class="form-control bg-light" readonly />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_facebook" class="font-weight-medium">Facebook Profile</label>
                    <input type="url" id="mother_facebook" name="mother_facebook"
                        value="{{ old('mother_facebook', $fetchedMother->fb_account ?? '') }}" class="form-control"
                        placeholder="e.g. https://facebook.com/…" />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_birthplace" class="font-weight-medium">Birth Place</label>
                    <input type="text" id="mother_birthplace" name="mother_birthplace"
                        value="{{ old('mother_birthplace', $fetchedMother->birth_place ?? '') }}" class="form-control"
                        placeholder="e.g. Taguig" />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_email" class="font-weight-medium">Email Address</label>
                    <input type="email" id="mother_email" name="mother_email"
                        value="{{ old('mother_email', $fetchedMother->email ?? $motherInfo->user->email ?? '') }}"
                        class="form-control" placeholder="e.g. you@example.com" />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_educational_attainment" class="font-weight-medium">Educational
                        Attainment</label>
                    <select id="mother_educational_attainment" name="mother_educational_attainment"
                        class="form-control">
                        <option value="">Select educational attainment</option>
                        @foreach($educations as $education)
                        <option value="{{ $education->id }}"
                            {{ old('mother_educational_attainment', $fetchedMother->education_id ?? '') == $education->id ? 'selected' : '' }}>
                            {{ ucfirst($education->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_workplace" class="font-weight-medium">Workplace</label>
                    <input type="text" id="mother_workplace" name="mother_workplace"
                        value="{{ old('mother_workplace', $fetchedMother->work_place ?? '') }}" class="form-control"
                        placeholder="e.g. Taguig" />
                </div>

                <div class="form-group col-md-4">
                    <label for="mother_contact_number" class="font-weight-medium">Contact Number</label>
                    <input type="tel" id="mother_contact_number" name="mother_contact_number"
                        value="{{ old('mother_contact_number', $motherInfo->user->contact_number ?? $fetchedMother->contact_number ?? '') }}"
                        class="form-control" placeholder="e.g. 09876543212" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-body">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Father's Information</h3>
        </div>
        <div class="card-body">
            <h5 class="font-weight-bold mb-3"></h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="father_name" class="font-weight-medium">Full Name <span
                            class="text-danger">*</span></label>
                    <input type="text" id="father_name" name="father_name"
                        value="{{ old('father_name', trim(($fatherInfo->user->first_name ?? '') . ' ' . ($fatherInfo->user->middle_name ?? '') . ' ' . ($fatherInfo->user->last_name ?? '')) ?: ($fetchedFather->name ?? '')) }}"
                        class="form-control" placeholder="e.g. Juan Dela Cruz" />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_birthdate" class="font-weight-medium">Birthdate</label>
                    <input type="date" id="father_birthdate" name="father_birthdate"
                        value="{{ old('father_birthdate', $fetchedFather->birth_date ?? '') }}" class="form-control" />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_age" class="font-weight-medium">Age</label>
                    <input type="number" id="father_age" name="father_age"
                        value="{{ old('father_age', $f_initialAge) }}" class="form-control bg-light" readonly />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_facebook" class="font-weight-medium">Facebook Profile</label>
                    <input type="url" id="father_facebook" name="father_facebook"
                        value="{{ old('father_facebook', $fetchedFather->fb_account ?? '') }}" class="form-control"
                        placeholder="e.g. https://facebook.com/…" />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_birthplace" class="font-weight-medium">Birth Place</label>
                    <input type="text" id="father_birthplace" name="father_birthplace"
                        value="{{ old('father_birthplace', $fetchedFather->birth_place ?? '') }}" class="form-control"
                        placeholder="e.g. Taguig" />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_email" class="font-weight-medium">Email Address</label>
                    <input type="email" id="father_email" name="father_email"
                        value="{{ old('father_email', $fetchedFather->email ?? $fatherInfo->user->email ?? '') }}"
                        class="form-control" placeholder="e.g. you@example.com" />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_educational_attainment" class="font-weight-medium">Educational
                        Attainment</label>
                    <select id="father_educational_attainment" name="father_educational_attainment"
                        class="form-control">
                        <option value="">Select educational attainment</option>
                        @foreach($educations as $education)
                        <option value="{{ $education->id }}"
                            {{ old('father_educational_attainment', $fetchedFather->education_id ?? '') == $education->id ? 'selected' : '' }}>
                            {{ ucfirst($education->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="father_workplace" class="font-weight-medium">Workplace</label>
                    <input type="text" id="father_workplace" name="father_workplace"
                        value="{{ old('father_workplace', $fetchedFather->work_place ?? '') }}" class="form-control"
                        placeholder="e.g. Taguig" />
                </div>

                <div class="form-group col-md-4">
                    <label for="father_contact_number" class="font-weight-medium">Contact Number</label>
                    <input type="tel" id="father_contact_number" name="father_contact_number"
                        value="{{ old('father_contact_number', $fatherInfo->user->contact_number ?? $fetchedFather->contact_number ?? '') }}"
                        class="form-control" placeholder="e.g. 09876543212" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculateAge(dateString) {
        if (!dateString) return '';
        const today = new Date();
        const birthDate = new Date(dateString);
        let years = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            years--;
        }
        return years >= 0 ? years : '';
    }

    const motherBD = document.getElementById('mother_birthdate');
    const motherAge = document.getElementById('mother_age');

    function updateMotherAge() {
        motherAge.value = calculateAge(motherBD.value);
    }

    updateMotherAge();
    motherBD.addEventListener('change', updateMotherAge);
    motherBD.addEventListener('input', updateMotherAge);

    const fatherBD = document.getElementById('father_birthdate');
    const fatherAge = document.getElementById('father_age');

    function updateFatherAge() {
        fatherAge.value = calculateAge(fatherBD.value);
    }

    updateFatherAge();
    fatherBD.addEventListener('change', updateFatherAge);
    fatherBD.addEventListener('input', updateFatherAge);
});
</script>