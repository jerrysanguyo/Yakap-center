@php
$initialFamily = old('family', $existingFamily ?: [[
'name' => '',
'birthday' => '',
'age' => '',
'sex' => '',
'relation' => '',
'civil_status' => '',
'education' => '',
'work' => ''
]]);
@endphp

<div class="section-body">
    <div class="card shadow-lg card-primary">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Family Information</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <button type="button" id="addRowBtn" class="btn btn-success btn-sm mr-2" title="Add another">+
                    Add</button>
                <button type="button" id="removeLastBtn" class="btn btn-danger btn-sm" title="Remove last">− Remove
                    Last</button>
            </div>
            <div id="familyContainer"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let family = @json($initialFamily);
    const container = document.getElementById('familyContainer');
    const addBtn = document.getElementById('addRowBtn');
    const removeBtn = document.getElementById('removeLastBtn');

    function computeAge(dateString) {
        if (!dateString) return '';
        const today = new Date();
        const bd = new Date(dateString);
        let years = today.getFullYear() - bd.getFullYear();
        const m = today.getMonth() - bd.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < bd.getDate())) {
            years--;
        }
        return years >= 0 ? years : '';
    }

    function renderRows() {
        container.innerHTML = '';
        family.forEach((member, idx) => {
            const row = document.createElement('div');
            row.className = 'card mb-3';
            row.innerHTML = `
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-weight-medium">#${idx + 1}</span>
              <button type="button" class="btn btn-sm btn-danger remove-btn">−</button>
            </div>

            <!-- First row: Miyembro, Kaarawan, Edad, Sex -->
            <div class="row mb-3">
              <div class="form-group col-md-3">
                <label class="font-weight-medium">Miyembro</label>
                <input
                  type="text"
                  name="family[${idx}][name]"
                  value="${member.name || ''}"
                  class="form-control"
                >
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-medium">Kaarawan</label>
                <input
                  type="date"
                  name="family[${idx}][birthday]"
                  value="${member.birthday || ''}"
                  class="form-control birthday-input"
                  data-idx="${idx}"
                >
              </div>
              <div class="form-group col-md-2">
                <label class="font-weight-medium">Edad</label>
                <input
                  type="number"
                  name="family[${idx}][age]"
                  value="${computeAge(member.birthday)}"
                  class="form-control age-input"
                  data-idx="${idx}"
                  readonly
                >
              </div>
              <div class="form-group col-md-4">
                <label class="font-weight-medium">Sex</label>
                <select name="family[${idx}][sex]" class="form-control">
                  <option value="">--</option>
                  @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}" ${member.sex == '{{ $gender->id }}' ? 'selected' : ''}>
                      {{ $gender->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <!-- Second row: Relasyon sa Bata, Civil Status, Educational Attainment, Trabaho -->
            <div class="row">
              <div class="form-group col-md-3">
                <label class="font-weight-medium">Relasyon sa Bata</label>
                <select name="family[${idx}][relation]" class="form-control">
                  <option value="">--</option>
                  @foreach ($relations as $relation)
                    <option value="{{ $relation->id }}" ${member.relation == '{{ $relation->id }}' ? 'selected' : ''}>
                      {{ $relation->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-medium">Civil Status</label>
                <select name="family[${idx}][civil_status]" class="form-control">
                  <option value="">--</option>
                  @foreach ($civilStatuses as $civil)
                    <option value="{{ $civil->id }}" ${member.civil_status == '{{ $civil->id }}' ? 'selected' : ''}>
                      {{ $civil->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-medium">Educational Attainment</label>
                <select name="family[${idx}][education]" class="form-control">
                  <option value="">--</option>
                  @foreach ($educations as $education)
                    <option value="{{ $education->id }}" ${member.education == '{{ $education->id }}' ? 'selected' : ''}>
                      {{ $education->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-medium">Trabaho</label>
                <input
                  type="text"
                  name="family[${idx}][work]"
                  value="${member.work || ''}"
                  class="form-control"
                >
              </div>
            </div>
          </div>
        `;
            container.appendChild(row);
        });

        attachListeners();
    }

    function attachListeners() {
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = Array.from(container.children).indexOf(btn.closest('.card'));
                family.splice(index, 1);
                renderRows();
            });
        });

        document.querySelectorAll('.birthday-input').forEach(inp => {
            inp.addEventListener('change', function() {
                const idx = parseInt(this.dataset.idx);
                family[idx].birthday = this.value;
                const ageField = container.querySelector(`.age-input[data-idx="${idx}"]`);
                ageField.value = computeAge(this.value);
            });
            inp.addEventListener('input', function() {
                const idx = parseInt(this.dataset.idx);
                family[idx].birthday = this.value;
                const ageField = container.querySelector(`.age-input[data-idx="${idx}"]`);
                ageField.value = computeAge(this.value);
            });
        });
    }

    addBtn.addEventListener('click', function() {
        family.push({
            name: '',
            birthday: '',
            age: '',
            sex: '',
            relation: '',
            civil_status: '',
            education: '',
            work: ''
        });
        renderRows();
    });

    removeBtn.addEventListener('click', function() {
        if (family.length > 1) {
            family.pop();
            renderRows();
        }
    });

    renderRows();
});
</script>