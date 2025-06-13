<div class="section-body">
    <div class="card shadow-lg card-primary">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Education Information</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="form-group col-md-6">
                    <label for="education" class="font-weight-medium">Educational Attainment</label>
                    <select id="education" name="education" class="form-control">
                        <option value="">Select</option>
                        @foreach($educations as $edu)
                        <option value="{{ $edu->id }}"
                            {{ old('education', Auth::user()->child->first()->education->education_id ?? '') == $edu->id ? 'selected' : '' }}>
                            {{ ucfirst($edu->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="school" class="font-weight-medium">School Attended</label>
                    <input type="text" id="school" name="school"
                        value="{{ old('school', Auth::user()->child->first()->education->school ?? '') }}"
                        class="form-control" />
                </div>
            </div>
        </div>
    </div>
</div>