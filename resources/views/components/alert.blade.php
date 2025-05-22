@if (session('success'))
<div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" x-show="open"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-6 right-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg z-50"
    role="alert">
    <div class="flex items-center justify-between space-x-4">
        <span class="text-sm font-medium">{{ session('success') }}</span>
        <button @click="open = false" class="text-green-700 hover:text-green-900 text-lg">&times;</button>
    </div>
</div>
@endif

@foreach ($errors->all() as $index => $error)
<div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000 + ({{ $index }} * 200))" x-show="open"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed right-6 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg z-50 w-80"
    style="top: {{ 1.5 + (6 * $index) }}rem;" role="alert">
    <div class="flex items-center justify-between space-x-4">
        <span class="text-sm font-medium">{{ $error }}</span>
        <button @click="open = false" class="text-red-700 hover:text-red-900 text-lg">&times;</button>
    </div>
</div>
@endforeach

@if (session('failed'))
<div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" x-show="open"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-6 right-6 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg z-50"
    role="alert">
    <div class="flex items-center justify-between space-x-4">
        <span class="text-sm font-medium">{{ session('failed') }}</span>
        <button @click="open = false" class="text-red-700 hover:text-red-900 text-lg">&times;</button>
    </div>
</div>
@endif