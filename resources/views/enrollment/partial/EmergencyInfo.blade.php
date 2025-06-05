<div class="p-6 mb-6">
    <form action="{{ route(Auth::user()->getRoleNames()->first() . '.emergencyInfo.store') }}" method="POST" x-data="{
            emergencyName:   '{{ old('emergency_name', $existingEmergency->name ?? '') }}',
            emergencyContact:'{{ old('emergency_contact', $existingEmergency->contact_number ?? '') }}',
            relation:        '{{ old('relation',     $existingEmergency->relationship_id ?? '') }}',
            
            userName:        '{{ addslashes(Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name) }}',
            userContact:     '{{ addslashes(Auth::user()->contact_number ?? '') }}',
            userRelation:    '{{ addslashes(Auth::user()->consent->first()->relation_id ?? '') }}',
            
            selfContact: false
        }" x-init="$watch('selfContact', value => {
            if (value) {
                emergencyName = userName;
                emergencyContact = userContact;
                relation = userRelation;
            } else {
                emergencyName    = '{{ old('emergency_name',   $existingEmergency->name ?? '') }}';
                emergencyContact = '{{ old('emergency_contact',$existingEmergency->phone ?? '') }}';
                relation         = '{{ old('relation',         $existingEmergency->relation_id ?? '') }}';
            }
        })">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="emergency_name" class="block font-medium text-gray-700 mb-1">
                    Pangalan <span class="text-red-500">*</span>
                </label>
                <input type="text" id="emergency_name" name="emergency_name" x-model="emergencyName"
                    placeholder="Juan Dela Cruz"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required />
            </div>
            <div>
                <label for="emergency_contact" class="block font-medium text-gray-700 mb-1">
                    Contact No. <span class="text-red-500">*</span>
                </label>
                <input type="tel" id="emergency_contact" name="emergency_contact" x-model="emergencyContact"
                    placeholder="+63 912 345 6789"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required />
            </div>
            <div>
                <label for="emergency_relation" class="block font-medium text-gray-700 mb-1">
                    Relasyon sa Bata <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="emergency_relation" name="relation" x-model="relation"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-500 appearance-none"
                        required>
                        <option value="">Select</option>
                        @foreach($relations as $rel)
                        <option value="{{ $rel->id }}">{{ ucfirst($rel->name) }}</option>
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
        </div>
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" x-model="selfContact" class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
                <span class="ml-2 text-gray-700">Gawin mo akong contact person</span>
            </label>
        </div>
        <div class="flex justify-between mt-6">
            <button type="button" @click="currentPage = 7"
                class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                Back
            </button>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Submit
            </button>
        </div>
    </form>
</div>