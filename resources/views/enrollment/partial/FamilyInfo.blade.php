<form action="{{ route(Auth::user()->getRoleNames()->first() . '.familyInfo.store') }}" method="POST">
    @csrf
    <div x-data="{
            family: {{ json_encode(old('family', $existingFamily ?: [[
                'name'=>'','birthday'=>'','age'=>'','sex'=>'','relation'=>'',
                'civil_status'=>'','education'=>'','work'=>''
            ]])) }},
            addRow() {
                this.family.push({
                    name: '',
                    birthday: '',
                    age: '',
                    sex: '',
                    relation: '',
                    civil_status: '',
                    education: '',
                    work: ''
                });
            },
            removeLast() {
                if (this.family.length > 1) this.family.pop();
            },
            computeAge(dateString) {
                if (!dateString) return '';
                const bd = new Date(dateString);
                const today = new Date();
                let years = today.getFullYear() - bd.getFullYear();
                const m = today.getMonth() - bd.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < bd.getDate())) {
                    years--;
                }
                return years;
            }
        }" class="mb-6 space-y-2">
        <div class="flex justify-end space-x-2 mb-2">
            <button type="button" @click="addRow()"
                class="px-2 py-1 bg-green-100 text-green-600 rounded hover:bg-green-200">+ Add</button>
            <button type="button" @click="removeLast()"
                class="px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200">− Remove Last</button>
        </div>
        <template x-for="(member, idx) in family" :key="idx">
            <div class="flex flex-wrap md:flex-nowrap items-center bg-white rounded-lg shadow-sm p-4"
                :class="idx % 2 === 1 ? 'bg-gray-50' : ''">
                <div class="flex items-center w-8 justify-center text-gray-600 font-medium">
                    <span x-text="idx + 1"></span>
                    <button type="button" @click="family.splice(idx, 1)"
                        class="ml-1 inline-flex items-center justify-center h-5 w-5 bg-red-100 text-red-600 rounded hover:bg-red-200"
                        title="Remove this row">−
                    </button>
                </div>
                <div class="flex-1 md:w-2/12 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Miyembro</label>
                    <input :name="`family[${idx}][name]`" type="text" x-model="member.name"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="flex-1 md:w-2/12 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Kaarawan</label>
                    <input :name="`family[${idx}][birthday]`" type="date" x-model="member.birthday"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="w-16 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Edad</label>
                    <input :name="`family[${idx}][age]`" type="number" :value="computeAge(member.birthday)" readonly
                        class="w-full p-2 bg-gray-100 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="w-20 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Sex</label>
                    <select :name="`family[${idx}][sex]`" x-model="member.sex"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200">
                        <option value="">--</option>
                        @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 md:w-2/12 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Relasyon sa Bata</label>
                    <select :name="`family[${idx}][relation]`" x-model="member.relation"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200">
                        <option value="">--</option>
                        @foreach ($relations as $relation)
                        <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-24 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Civil Status</label>
                    <select :name="`family[${idx}][civil_status]`" x-model="member.civil_status"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200">
                        <option value="">--</option>
                        @foreach ($civilStatuses as $civil)
                        <option value="{{ $civil->id }}">{{ $civil->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 md:w-2/12 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Educational Attainment</label>
                    <select :name="`family[${idx}][education]`" x-model="member.education"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200">
                        <option value="">--</option>
                        @foreach ($educations as $education)
                        <option value="{{ $education->id }}">{{ $education->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 md:w-2/12 px-2">
                    <label class="block text-xs text-gray-500 mb-1">Trabaho</label>
                    <input :name="`family[${idx}][work]`" type="text" x-model="member.work"
                        class="w-full p-2 border border-gray-200 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
            </div>
        </template>
    </div>
    <div class="flex justify-between mt-6">
        <button type="button" @click="currentPage = 6"
            class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">Back</button>
        <button type="submit"
            class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Next</button>
    </div>
</form>