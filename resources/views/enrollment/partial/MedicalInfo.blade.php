@php
$oldCheckUp = old('checkUp', $existingChildMedical->check_up ?? '');
$oldBlood = old('bloodType', $existingChildMedical->blood_type_id ?? '');
$oldMeds = old('medication', $existingMedications ?: ['']);
$oldAllergs = old('allergy', $existingAllergies ?: ['']);
@endphp

<div class="section-body">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Medical Information</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="form-group col-md-6">
                    <label class="font-weight-semibold">Regular ba ang check-up sa Doktor? <span
                            class="text-danger">*</span></label>
                    <div class="form-check form-check-inline ml-2">
                        <input class="form-check-input" type="radio" name="checkUp" id="checkUp_Oo" value="Oo"
                            {{ $oldCheckUp === 'Oo' ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkUp_Oo">Oo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="checkUp" id="checkUp_Hindi" value="Hindi"
                            {{ $oldCheckUp === 'Hindi' ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkUp_Hindi">Hindi</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="bloodType" class="font-weight-semibold">Blood Type <span
                            class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select id="bloodType" name="bloodType" class="form-control">
                            <option value="">Select Blood Type</option>
                            @foreach($bloodTypes as $blood)
                            <option value="{{ $blood->id }}" {{ $oldBlood == $blood->id ? 'selected' : '' }}>
                                {{ $blood->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none position-absolute"
                            style="top:50%; right:1rem; transform:translateY(-50%);">
                            <i class="fas fa-chevron-down text-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="font-weight-semibold d-flex align-items-center">
                    Ilista ang mga gamot na kasalukuyang iniinom ng inyong anak:
                    <button type="button" id="addMedicationBtn" class="btn btn-success btn-sm ml-3"
                        title="Add another">+</button>
                </label>
                <div id="medicationsContainer">
                    @foreach($oldMeds as $med)
                    <div class="input-group mb-2 med-row">
                        <input type="text" name="medication[]" value="{{ $med }}" class="form-control"
                            placeholder="e.g. Paracetamol">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-med">&minus;</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <label class="font-weight-semibold d-flex align-items-center">
                    Ilista ang mga allergies ng bata:
                    <button type="button" id="addAllergyBtn" class="btn btn-info btn-sm ml-3"
                        title="Add another">+</button>
                </label>
                <div id="allergiesContainer">
                    @foreach($oldAllergs as $alg)
                    <div class="input-group mb-2 alg-row">
                        <input type="text" name="allergy[]" value="{{ $alg }}" class="form-control"
                            placeholder="e.g. Peanuts">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-alg">&minus;</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const medsContainer = document.getElementById('medicationsContainer');
    const addMedBtn = document.getElementById('addMedicationBtn');

    addMedBtn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'input-group mb-2 med-row';
        row.innerHTML = `
        <input
          type="text"
          name="medication[]"
          class="form-control"
          placeholder="e.g. Paracetamol"
        >
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-med">&minus;</button>
        </div>
      `;
        medsContainer.appendChild(row);
    });

    medsContainer.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-med')) {
            const row = e.target.closest('.med-row');
            if (row) row.remove();
        }
    });
    const algsContainer = document.getElementById('allergiesContainer');
    const addAlgBtn = document.getElementById('addAllergyBtn');

    addAlgBtn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'input-group mb-2 alg-row';
        row.innerHTML = `
        <input
          type="text"
          name="allergy[]"
          class="form-control"
          placeholder="e.g. Peanuts"
        >
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-alg">&minus;</button>
        </div>
      `;
        algsContainer.appendChild(row);
    });

    algsContainer.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-alg')) {
            const row = e.target.closest('.alg-row');
            if (row) row.remove();
        }
    });
});
</script>