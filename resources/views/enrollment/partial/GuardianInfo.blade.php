<form action="{{ route(Auth::user()->getRoleNames()->first() . '.guardianInfo.store') }}" method="POST">
    @csrf
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b pb-2">Mother’s Information</h3>
        <div x-data="{
            mother_birthdate: '{{ old('mother_birthdate', $fetchedMother->birth_date ?? '') }}',
            get age() {
            if (!this.mother_birthdate) return ''
            const bd = new Date(this.mother_birthdate)
            const today = new Date()
            let years = today.getFullYear() - bd.getFullYear()
            const m = today.getMonth() - bd.getMonth()
            if (m < 0 || (m === 0 && today.getDate() < bd.getDate())) {
                years--
            }
            return years
            }
        }" x-init="$watch('mother_birthdate', value => {/* triggers reactivity */})"
            class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Full Name <span
                        class="text-red-500">*</span></label>
                <input type="text" name="mother_name" placeholder="e.g. Maria Santos"
                    value="{{ old('mother_name', trim(($motherInfo->user->first_name ?? '') . ' ' . ($motherInfo->user->middle_name ?? '') . ' ' . ($motherInfo->user->last_name ?? '')) ?: ($fetchedMother->name ?? '')) }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Birthdate</label>
                <input x-model="mother_birthdate" type="date" name="mother_birthdate" value="{{ old('mother_birthdate', $fetchedMother->birth_date ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Age</label>
                <input type="number" :value="age" readonly
                    class="w-full bg-gray-100 border border-gray-300 px-4 py-2 rounded-md" />
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Facebook Profile</label>
                <input type="url" name="mother_facebook" placeholder="https://facebook.com/…" value="{{ old('mother_facebook', $fetchedMother->fb_account ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Birth Place</label>
                <input type="text" name="mother_birthplace" placeholder="City / Province" value="{{ old('mother_birthplace', $fetchedMother->birth_place ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email Address</label>
                <input type="email" name="mother_email" placeholder="you@example.com"
                    value="{{ old('mother_email', ($fetchedMother->email ?? '') ?? ($motherInfo->user->email ?? '')) }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Educational Attainment</label>
                <div class="relative">
                    <select name="mother_educational_attainment"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="">Select educational attainment</option>
                        @foreach($educations as $education)
                        <option value="{{ $education->id }}"
                            {{ old('mother_educational_attainment', $fetchedMother->education_id ?? '') == $education->id ? 'selected' : '' }}>
                            {{ ucfirst($education->name) }}
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
                <label class="block mb-1 font-medium text-gray-700">Workplace</label>
                <input type="text" name="mother_workplace" placeholder="Company / Organization" value="{{ old('mother_workplace', $fetchedMother->work_place ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Contact Number</label>
                <input type="tel" name="mother_contact_number" placeholder="+63 912 345 6789"
                    value="{{ old('mother_contact_number', ($motherInfo->user->contact_number ?? '') ?: $fetchedMother->contact_number ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>
    {{-- Father’s Information --}}
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b pb-2">Father’s Information</h3>
        <div x-data="{
        father_birthdate: '{{ old('father_birthdate', $fetchedFather->birth_date ?? '') }}',
        get age() {
            if (!this.father_birthdate) return ''
            const bd = new Date(this.father_birthdate)
            const today = new Date()
            let years = today.getFullYear() - bd.getFullYear()
            const m = today.getMonth() - bd.getMonth()
            if (m < 0 || (m === 0 && today.getDate() < bd.getDate())) {
            years--
            }
            return years
        }
        }" x-init="$watch('father_birthdate', value => {/* triggers reactivity */})"
            class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block mb-1 font-medium text-gray-700">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="father_name" placeholder="e.g. Juan Dela Cruz"
                    value="{{ old('father_name', trim(($fatherInfo->user->first_name ?? '') . ' ' . ($fatherInfo->user->middle_name ?? '') . ' ' . ($fatherInfo->user->last_name ?? '')) ?? ($fetchedFather->name ?? '')) }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Birthdate</label>
                <input x-model="father_birthdate" type="date" name="father_birthdate"
                    value="{{ old('father_birthdate', $fetchedFather->birth_date ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Age</label>
                <input type="number" name="father_age" :value="age" readonly
                    class="w-full bg-gray-100 border border-gray-300 px-4 py-2 rounded-md" />
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Facebook Profile</label>
                <input type="url" name="father_facebook" placeholder="https://facebook.com/…" value="{{ old('father_facebook', $fetchedFather->fb_account ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Birth Place</label>
                <input type="text" name="father_birthplace" placeholder="City / Province" value="{{ old('father_birthplace', $fetchedFather->birth_place ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email Address</label>
                <input type="email" name="father_email" placeholder="you@example.com"
                    value="{{ old('father_email',  ($fetchedFather->email) ?? ($fatherInfo->user->email ?? '')) }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Educational Attainment</label>
                <div class="relative">
                    <select name="father_educational_attainment"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="">Select educational attainment</option>
                        @foreach($educations as $education)
                        <option value="{{ $education->id }}"
                            {{ old('father_educational_attainment', $fetchedFather->education_id ?? '') == $education->id ? 'selected' : '' }}>
                            {{ ucfirst($education->name) }}
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
                <label class="block mb-1 font-medium text-gray-700">Workplace</label>
                <input type="text" name="father_workplace" placeholder="Company / Organization" value="{{ old('father_workplace', $fetchedFather->work_place ?? '') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Contact Number</label>
                <input type="tel" name="father_contact_number" placeholder="+63 912 345 6789"
                    value="{{ old('father_contact_number', ($fatherInfo->user->contact_number ?? '') ?? ($fetchedFather->contact_number)) }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>
    <div class="flex justify-between mt-6">
        <button type="button" @click="currentPage = 1"
            class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
            Back
        </button>
        <button type="submit"
            class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            Next
        </button>
    </div>
</form>