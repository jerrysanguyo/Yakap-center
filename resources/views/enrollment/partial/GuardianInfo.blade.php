<div class="bg-white shadow-lg rounded-lg p-6 mb-8">
    <h3 class="text-2xl font-semibold mb-6 border-b pb-2">Mother’s Information</h3>
    <div x-data="{
            mother_birthdate: '{{ old('mother_birthdate', $motherInfo->birth_date ?? '') }}',
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
        }" x-init="$watch('mother_birthdate', value => {/* triggers reactivity */})"class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block mb-1 font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
            <input type="text" name="motherName" placeholder="e.g. Maria Santos"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <input type="text" name="type" value="2">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Birthdate</label>
            <input x-model="mother_birthdate" type="date" name="mother_birthdate"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Age</label>
            <input type="number" :value="age" readonly
                class="w-full bg-gray-100 border border-gray-300 px-4 py-2 rounded-md" />
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Facebook Profile</label>
            <input type="url" name="motherFacebook" placeholder="https://facebook.com/…"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Birth Place</label>
            <input type="text" name="motherBirthPlace" placeholder="City / Province"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Email Address</label>
            <input type="email" name="motherEmail" placeholder="you@example.com"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Educational Attainment</label>
            <input type="text" name="motherEducation" placeholder="e.g. College Graduate"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Workplace</label>
            <input type="text" name="motherWorkPlace" placeholder="Company / Organization"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Contact Number</label>
            <input type="tel" name="motherContact" placeholder="+63 912 345 6789"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
</div>
{{-- Father’s Information --}}
<div class="bg-white shadow-lg rounded-lg p-6 mb-8">
    <h3 class="text-2xl font-semibold mb-6 border-b pb-2">Father’s Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block mb-1 font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
            <input type="text" name="fatherName" placeholder="e.g. Juan Dela Cruz"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <input type="text" name="type" value="1">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Age</label>
            <input type="number" name="fatherAge"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Birthdate</label>
            <input type="date" name="fatherBirthdate"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Facebook Profile</label>
            <input type="url" name="fatherFacebook" placeholder="https://facebook.com/…"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Birth Place</label>
            <input type="text" name="fatherBirthPlace" placeholder="City / Province"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Email Address</label>
            <input type="email" name="fatherEmail" placeholder="you@example.com"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Educational Attainment</label>
            <input type="text" name="fatherEducation" placeholder="e.g. Vocational"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Workplace</label>
            <input type="text" name="fatherWorkPlace" placeholder="Company / Organization"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Contact Number</label>
            <input type="tel" name="fatherContact" placeholder="+63 912 345 6789"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
</div>
<div class="flex justify-between mt-6">
    <button type="button" @click="currentPage = 1"
        class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
        Back
    </button>
    <button type="button" @click="currentPage = 3"
        class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
        Next
    </button>
</div>