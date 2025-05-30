<form action="{{ route(Auth::user()->getRoleNames()->first() . '.medicalInfo.store') }}" method="POST">
    @csrf
    <div class="bg-white shadow-lg p-6 rounded-lg mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Regular ba ang check-up sa Doktor? <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="checkUp" value="Oo" {{ old('checkUp', $existingChildMedical->check_up) == 'Oo' ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <span class="ml-2 text-gray-700">Oo</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="checkUp" value="Hindi"
                            {{ old('checkUp', $existingChildMedical->check_up) == 'Hindi' ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <span class="ml-2 text-gray-700">Hindi</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="bloodType" class="block font-semibold text-gray-700 mb-2">
                    Blood Type <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select name="bloodType" id="bloodType"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="">Select Blood Type</option>
                        @foreach($bloodTypes as $blood)
                        <option value="{{ $blood->id }}"
                            {{ old('bloodType', $existingChildMedical->blood_type_id ?? '') == $blood->id ? 'selected' : '' }}>
                            {{ $blood->name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586
                   l3.293-3.293a1 1 0 011.414 1.414
                   l-4 4a1 1 0-1.414 0
                   l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div x-data="{
      medications: {{ json_encode(old('medication', $existingMedications ?: [''])) }},
      addMedication() { this.medications.push('') }
    }" class="mb-6">
            <label class="flex items-center font-semibold text-gray-700 mb-2">
                Ilista ang mga gamot na kasalukuyang iniinom ng inyong anak:
                <button type="button" @click="addMedication()"
                    class="ml-2 inline-flex items-center justify-center h-6 w-6 bg-green-100 text-green-600 rounded-full hover:bg-green-200"
                    title="Add another">+</button>
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <template x-for="(med, idx) in medications" :key="idx">
                    <div class="flex items-center space-x-2">
                        <input type="text" name="medication[]" x-model="medications[idx]"
                            class="flex-1 border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500" />
                        <button type="button" @click="medications.splice(idx, 1)"
                            class="inline-flex items-center justify-center h-6 w-6 bg-red-100 text-red-600 rounded-full hover:bg-red-200"
                            title="Remove">–</button>
                    </div>
                </template>
            </div>
        </div>

        <div x-data="{
      allergies: {{ json_encode(old('allergy', $existingAllergies ?: [''])) }},
      addAllergy() { this.allergies.push('') }
    }" class="mb-6">
            <label class="flex items-center font-semibold text-gray-700 mb-2">
                Ilista ang mga allergies ng bata:
                <button type="button" @click="addAllergy()"
                    class="ml-2 inline-flex items-center justify-center h-6 w-6 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200"
                    title="Add another">+</button>
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <template x-for="(alg, idx) in allergies" :key="idx">
                    <div class="flex items-center space-x-2">
                        <input type="text" name="allergy[]" x-model="allergies[idx]"
                            class="flex-1 border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500" />
                        <button type="button" @click="allergies.splice(idx, 1)"
                            class="inline-flex items-center justify-center h-6 w-6 bg-red-100 text-red-600 rounded-full hover:bg-red-200"
                            title="Remove">–</button>
                    </div>
                </template>
            </div>
        </div>
        <div class="flex justify-between">
            <button type="button" @click="currentPage = 5"
                class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                Back
            </button>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Submit
            </button>
        </div>
</form>