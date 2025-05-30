<form action="{{ route(Auth::user()->getRoleNames()->first() . '.childInfo.store') }}" method="POST">
    @csrf
    <!-- name -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block mb-1 font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
            <input type="text" name="first_name" value="{{ old('first_name', $childInfo->first_name ?? '') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required readonly>
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Middle Name</label>
            <input type="text" name="middle_name" value="{{ old('middle_name', $childInfo->middle_name ?? '') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                readonly>
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
            <input type="text" name="last_name" value="{{ old('last_name', $childInfo->last_name ?? '') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required readonly>
        </div>
    </div>
    <!-- gender, birthdate, and age -->
    <div x-data="{
            birth_date: '{{ old('birth_date', $childInfo->birth_date ?? '') }}',
            get age() {
            if (!this.birth_date) return ''
            const bd = new Date(this.birth_date)
            const today = new Date()
            let years = today.getFullYear() - bd.getFullYear()
            const m = today.getMonth() - bd.getMonth()
            if (m < 0 || (m === 0 && today.getDate() < bd.getDate())) {
                years--
            }
            return years
            }
        }" x-init="$watch('birth_date', value => {/* triggers reactivity */})"
        class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block mb-1 font-medium text-gray-700">Gender</label>
            <div class="relative">
                <select name="gender_id"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500 appearance-none">
                    <option value="">Select</option>
                    @foreach($genders as $gender)
                    <option value="{{ $gender->id }}"
                        {{ old('gender_id', $childInfo->gender_id ?? '') == $gender->id ? 'selected' : '' }}>
                        {{ ucfirst($gender->name) }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586
                   l3.293-3.293a1 1 0 011.414 1.414
                   l-4 4a1 1 0 01-1.414 0
                   l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Birthdate</label>
            <input x-model="birth_date" type="date" name="birth_date"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Age</label>
            <input type="number" name="age" :value="age" readonly
                class="w-full bg-gray-100 border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
    <!-- address -->
    <div x-data='{
            district_id: "{{ old('district_id', $childInfo->district_id ?? '') }}",
            barangay_id: "{{ old('barangay_id', $childInfo->barangay_id ?? '') }}",
            allBarangays: @json($barangays),
            get filteredBarangays() {
            return this.allBarangays.filter(b => b.district_id == this.district_id)
            }
        }' class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
        <div>
            <label class="block mb-1 font-medium text-gray-700">House No.</label>
            <input type="text" name="house_number" value="{{ old('house_number', $childInfo->house_number ?? '') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">District</label>
            <div class="relative">
                <select x-model="district_id" name="district_id"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                    <option value="">Select District</option>
                    @foreach($districts as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586 l3.293-3.293a1 1 0 011.414 1.414 l-4 4a1 1 0 01-1.414 0 l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>
        </div>
        {{-- Barangay --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Barangay</label>
            <div class="relative">
                <select x-model="barangay_id" name="barangay_id" :disabled="!district_id"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                    <option value="">Select Barangay</option>
                    <template x-for="b in filteredBarangays" :key="b.id">
                        <option :value="b.id" x-text="b.name" :selected="b.id == barangay_id"></option>
                    </template>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586 l3.293-3.293a1 1 0 011.414 1.414 l-4 4a1 1 0 01-1.414 0 l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">City</label>
            <input type="text" name="city" value="Taguig City" readonly
                class="w-full border border-gray-300 bg-gray-100 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
    <!-- button for submission -->
    <div class="flex justify-end mt-6">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Next
        </button>
    </div>
</form>