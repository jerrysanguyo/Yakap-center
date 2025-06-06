@php
$oldReceived = old('receivedService');
if (!$oldReceived) {
if (!empty($existingYesIds)) {
$oldReceived = 'Oo';
} elseif (!empty($existingNoIds)) {
$oldReceived = 'Hindi';
}
}
$showYesOthers = old('otherYes') !== null || !empty($existingOtherYes);
$showNoOthers = old('otherNo') !== null || !empty($existingOtherNo);
@endphp

<div class="section-body">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="font-weight-bold mb-0">Service Information</h3>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h5 class="font-weight-medium mb-3">
                    Nakatanggap na ba ng serbisyo upang matulungan ang batang may kapansanan?
                    <span class="text-danger">*</span>
                </h5>

                <div class="row mb-4">
                    @foreach(['Oo', 'Hindi'] as $choice)
                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="receivedService"
                            id="receivedService_{{ $choice }}" value="{{ $choice }}"
                            {{ $oldReceived === $choice ? 'checked' : '' }}>
                        <label class="form-check-label" for="receivedService_{{ $choice }}">
                            {{ $choice }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div id="yesBlock" class="border border-gray-200 rounded p-4 mb-4" style="display: none;">
                    <p class="mb-3 text-gray-600">Kung Oo, saan? Pakilagyan ng tsek.</p>
                    <div class="row">
                        @foreach($yesServices as $yes)
                        @php $isYesOther = strtolower($yes->name) === 'others'; @endphp
                        <div class="form-check col-md-4 mb-2">
                            <input class="form-check-input {{ $isYesOther ? 'yes-other-checkbox' : '' }}"
                                type="checkbox" name="yesService[]" id="yesService_{{ $yes->id }}"
                                value="{{ $yes->id }}" @if(in_array($yes->id, old('yesService', $existingYesIds)))
                            checked @endif
                            >
                            <label class="form-check-label" for="yesService_{{ $yes->id }}">
                                {{ $yes->name }}
                            </label>
                        </div>
                        @endforeach

                        <div id="yes_other_input" class="col-md-12 mt-2" style="display: none;">
                            <input type="text" name="otherYes" value="{{ old('otherYes', $existingOtherYes) }}"
                                placeholder="e.g. Private company" class="form-control">
                        </div>
                    </div>
                </div>

                <div id="noBlock" class="border border-gray-200 rounded p-4 mb-4" style="display: none;">
                    <p class="mb-3 text-gray-600">Kung Hindi, anong dahilan? Pakilagyan ng tsek.</p>
                    <div class="row">
                        @foreach($noServices as $no)
                        @php $isNoOther = strtolower($no->name) === 'other'; @endphp
                        <div class="form-check col-md-4 mb-2">
                            <input class="form-check-input {{ $isNoOther ? 'no-other-checkbox' : '' }}" type="checkbox"
                                name="noService[]" id="noService_{{ $no->id }}" value="{{ $no->id }}"
                                @if(in_array($no->id, old('noService', $existingNoIds)))
                            checked @endif
                            >
                            <label class="form-check-label" for="noService_{{ $no->id }}">
                                {{ $no->name }}
                            </label>
                        </div>
                        @endforeach

                        <div id="no_other_input" class="col-md-12 mt-2" style="display: none;">
                            <input type="text" name="otherNo" value="{{ old('otherNo', $existingOtherNo) }}"
                                placeholder="e.g. Private company" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const oldReceived = "{{ $oldReceived }}";
    const showYesOthers = {{ $showYesOthers ? 'true' : 'false' }};
    const showNoOthers = {{ $showNoOthers ? 'true' : 'false' }};
    const yesBlock = document.getElementById('yesBlock');
    const noBlock = document.getElementById('noBlock');
    const yesOtherChkboxes = document.querySelectorAll('.yes-other-checkbox');
    const yesOtherInput = document.getElementById('yes_other_input');
    const noOtherChkboxes = document.querySelectorAll('.no-other-checkbox');
    const noOtherInput = document.getElementById('no_other_input');
    const radioOo = document.getElementById('receivedService_Oo');
    const radioHindi = document.getElementById('receivedService_Hindi');

    function updateBlocks() {
        if (radioOo.checked) {
            yesBlock.style.display = '';
            noBlock.style.display = 'none';
        } else if (radioHindi.checked) {
            yesBlock.style.display = 'none';
            noBlock.style.display = '';
        } else {
            yesBlock.style.display = 'none';
            noBlock.style.display = 'none';
        }
    }

    function updateYesOther() {
        let anyChecked = false;
        yesOtherChkboxes.forEach(cb => {
            if (cb.checked) anyChecked = true;
        });
        yesOtherInput.style.display = anyChecked ? '' : 'none';
    }

    function updateNoOther() {
        let anyChecked = false;
        noOtherChkboxes.forEach(cb => {
            if (cb.checked) anyChecked = true;
        });
        noOtherInput.style.display = anyChecked ? '' : 'none';
    }

    if (oldReceived === 'Oo') {
        radioOo.checked = true;
    } else if (oldReceived === 'Hindi') {
        radioHindi.checked = true;
    }
    updateBlocks();

    if (showYesOthers) {
        yesOtherInput.style.display = '';
    }
    if (showNoOthers) {
        noOtherInput.style.display = '';
    }

    if (radioOo) {
        radioOo.addEventListener('change', function() {
            updateBlocks();
            noOtherInput.style.display = 'none';
            noOtherChkboxes.forEach(cb => {
                cb.checked = false;
            });
        });
    }
    if (radioHindi) {
        radioHindi.addEventListener('change', function() {
            updateBlocks();
            yesOtherInput.style.display = 'none';
            yesOtherChkboxes.forEach(cb => {
                cb.checked = false;
            });
        });
    }

    yesOtherChkboxes.forEach(cb => {
        cb.addEventListener('change', updateYesOther);
    });

    noOtherChkboxes.forEach(cb => {
        cb.addEventListener('change', updateNoOther);
    });
});
</script>