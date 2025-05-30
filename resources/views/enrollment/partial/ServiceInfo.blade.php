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

<form action="{{ route(auth()->user()->getRoleNames()->first() . '.serviceInfo.store') }}" method="POST">
    @csrf

    <div x-data="{
        receivedService: '{{ $oldReceived }}',
        showYesOthers : {{ $showYesOthers ? 'true' : 'false' }},
        showNoOthers  : {{ $showNoOthers  ? 'true' : 'false' }}
    }" class="p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">
            Nakatanggap na ba ng serbisyo upang matulungan ang batang may kapansanan?
            <span class="text-red-500">*</span>
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            @foreach(['Oo','Hindi'] as $choice)
            <label class="inline-flex items-center">
                <input type="radio" name="receivedService" value="{{ $choice }}" x-model="receivedService"
                    {{ $oldReceived === $choice ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <span class="ml-2 text-gray-700">{{ $choice }}</span>
            </label>
            @endforeach
        </div>

        <template x-if="receivedService === 'Oo'">
            <div class="border border-gray-200 rounded-md p-4 mb-6">
                <p class="mb-3 text-gray-600">Kung Oo, saan? Pakilagyan ng tsek.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($yesServices as $yes)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="yesService[]" value="{{ $yes->id }}"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            @if(strtolower($yes->name) === 'others') x-model="showYesOthers" @endif
                        {{ in_array($yes->id, old('yesService', $existingYesIds)) ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-gray-700">{{ $yes->name }}</span>
                    </label>
                    @endforeach

                    <div class="col-span-full" x-show="showYesOthers">
                        <input type="text" name="otherYes" value="{{ old('otherYes', $existingOtherYes) }}"
                            placeholder="Iba pa"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </template>

        <template x-if="receivedService === 'Hindi'">
            <div class="border border-gray-200 rounded-md p-4">
                <p class="mb-3 text-gray-600">Kung Hindi, anong dahilan? Pakilagyan ng tsek.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($noServices as $no)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="noService[]" value="{{ $no->id }}"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            @if(strtolower($no->name) === 'other') x-model="showNoOthers" @endif
                        {{ in_array($no->id, old('noService', $existingNoIds)) ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-gray-700">{{ $no->name }}</span>
                    </label>
                    @endforeach

                    <div class="col-span-full" x-show="showNoOthers">
                        <input type="text" name="otherNo" value="{{ old('otherNo', $existingOtherNo) }}"
                            placeholder="Iba pa"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div class="flex justify-between mt-6">
        <button type="button" @click="currentPage = 1"
            class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">Back</button>

        <button type="submit"
            class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Next</button>
    </div>
</form>