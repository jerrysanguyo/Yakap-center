@php
$oldEmergencyName = old('emergency_name', $existingEmergency->name ?? '');
$oldEmergencyContact = old('emergency_contact', $existingEmergency->contact_number ?? '');
$oldRelation = old('relation', $existingEmergency->relationship_id ?? '');
$userName = addslashes(Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name);
$userContact = addslashes(Auth::user()->contact_number ?? '');
$userRelation = addslashes(Auth::user()->consent->first()->relation_id ?? '');
@endphp

<div class="section-body">
    <div class="card shadow-lg card-primary">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Emergency Contact Information</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="form-group col-md-4">
                    <label for="emergency_name" class="font-weight-medium">Pangalan <span
                            class="text-danger">*</span></label>
                    <input type="text" id="emergency_name" name="emergency_name" value="{{ $oldEmergencyName }}"
                        class="form-control" placeholder="Juan Dela Cruz">
                </div>
                <div class="form-group col-md-4">
                    <label for="emergency_contact" class="font-weight-medium">Contact No. <span
                            class="text-danger">*</span></label>
                    <input type="tel" id="emergency_contact" name="emergency_contact" value="{{ $oldEmergencyContact }}"
                        class="form-control" placeholder="+63 912 345 6789">
                </div>
                <div class="form-group col-md-4">
                    <label for="emergency_relation" class="font-weight-medium">Relasyon sa Bata <span
                            class="text-danger">*</span></label>
                    <select id="emergency_relation" name="relation" class="form-control">
                        <option value="">Select</option>
                        @foreach($relations as $rel)
                        <option value="{{ $rel->id }}" {{ $oldRelation == $rel->id ? 'selected' : '' }}>
                            {{ ucfirst($rel->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-4">
                <div class="form-check">
                    <input type="checkbox" id="selfContactCheckbox" class="form-check-input">
                    <label class="form-check-label" for="selfContactCheckbox">
                        Gawin mo akong contact person
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const origName = "{{ $oldEmergencyName }}";
    const origContact = "{{ $oldEmergencyContact }}";
    const origRel = "{{ $oldRelation }}";
    const userName = "{{ $userName }}";
    const userContact = "{{ $userContact }}";
    const userRel = "{{ $userRelation }}";

    const nameInput = document.getElementById('emergency_name');
    const contactInput = document.getElementById('emergency_contact');
    const relationSelect = document.getElementById('emergency_relation');
    const checkbox = document.getElementById('selfContactCheckbox');

    function updateFields() {
        if (checkbox.checked) {
            nameInput.value = userName;
            contactInput.value = userContact;
            relationSelect.value = userRel || "";
        } else {
            nameInput.value = origName;
            contactInput.value = origContact;
            relationSelect.value = origRel || "";
        }
    }

    updateFields();

    checkbox.addEventListener('change', updateFields);
});
</script>