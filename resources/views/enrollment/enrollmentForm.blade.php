@extends('layouts.dashboard')
@section('content')
@section('breadcrumb')
<x-breadcrumb :items="[]" />
@endsection

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Enrollment Forms</h1>
</div>

<div x-data="{ currentPage: 1, pages: [
        'Child\'s Information',
        'Guardian Information',
        'Disability Details',
        'Educational Details',
        'Service Details',
        'Medical Details',
        'Family Composition',
        'Emergency Contact'
    ] }" class="space-y-6">
    <nav>
        <ul class="flex bg-white rounded-lg shadow-sm overflow-hidden">
            <template x-for="(label, idx) in pages" :key="idx">
                <li class="flex-1">
                    <button
                        @click="currentPage = idx + 1"
                        :class="currentPage === idx + 1
                            ? 'bg-[#1A4798] text-white'
                            : 'bg-white text-[#1A4798] hover:bg-[#F4C027]/20 hover:text-white'"
                        class="flex items-center justify-center w-full py-3 transition"
                        x-text="label"
                    ></button>
                </li>
            </template>
        </ul>
    </nav>

    <!-- Content Panels -->
    <template x-for="(label, idx) in pages" :key="idx">
        <div x-show="currentPage === idx + 1" class="bg-white shadow-lg p-6 rounded-lg">
            <h2 class="text-lg font-semibold text-gray-800" x-text="label"></h2>
        </div>
    </template>
</div>


@endsection