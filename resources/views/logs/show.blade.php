<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center text-left">
    <div class="fixed inset-0 bg-black opacity-50" @click="showModal = false"></div>
    <div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-white rounded-lg shadow-lg z-10 p-6 w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">{{ $page_title }} details</h2>
            <button @click="showModal = false"
                class="text-gray-600 hover:text-gray-800 text-2xl leading-none">&times;</button>
        </div>
        <div class="mt-5 text-gray-700 text-200 text-md">
            <p class="mt-2">
                <span class="font-semibold">Created at:</span>
                {{ $record->created_at }}
            </p>
        </div>
        <div class="text-gray-700 text-200 text-md">
            <p class="mt-2">
                <span class="font-semibold">Updated at:</span>
                {{ $record->updated_at }}
            </p>
        </div>
        <div class="text-gray-700 text-200 text-md">
            <p class="mt-2">
                <span class="font-semibold">Model:</span>
                {{ class_basename($record->subject_type) }}
            </p>
        </div>
        <div class="text-gray-700 text-200 text-md">
            <p class="mt-2">
                <span class="font-semibold">User:</span>
                {{ $record->causer?->first_name . ' ' . $record->causer?->middle_name . ' ' . $record->causer?->last_name ?? 'System' }}
            </p>
        </div>
        <div class="text-gray-700 text-200 text-md">
            <p class="mt-2">
                <span class="font-semibold">Description:</span>
                {{ $record->description }}
            </p>
        </div>
    </div>
</div>