<div class="section-body">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="font-weight-bold">Disability Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="pwd_no" class="font-weight-medium">PWD No.</label>
                    <input type="text" id="pwd_no" name="pwd_no"
                        value="{{ old('pwd_no', Auth::user()->child->first()->disability->pwd_id ?? '') }}"
                        class="form-control" />
                </div>
                <div class="form-group col-md-6">
                    <label for="disability" class="font-weight-medium">Diagnosis</label>
                    <select id="disability" name="disability" class="form-control">
                        <option value="">Select</option>
                        @foreach($disabilities as $dis)
                        <option value="{{ $dis->id }}"
                            {{ old('disability', Auth::user()->child->first()->disability->disability_id ?? '') == $dis->id ? 'selected' : '' }}>
                            {{ ucfirst($dis->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>