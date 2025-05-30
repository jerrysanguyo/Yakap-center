<form action="{{ route(Auth::user()->getRoleNames()->first() . '.educationInfo.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block mb-1 font-medium text-gray-700">Educational attainment</label>
            <div class="relative">
                <select name="education"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500 appearance-none">
                    <option value="">Select</option>
                    @foreach($educations as $education)
                    <option value="{{ $education->id }}"
                        {{ old('education', Auth::user()->child->first()->education->education_id ?? '') == $education->id ? 'selected' : '' }}>
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
            <label class="block mb-1 font-medium text-gray-700">School attended</label>
            <input type="text" name="school"
                value="{{ old('school', Auth::user()->child->first()->education->school ?? '') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>
    <div class="flex justify-between mt-6">
        <button type="button" @click="currentPage = 3"
            class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
            Back
        </button>
        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            Next
        </button>
    </div>
</form>