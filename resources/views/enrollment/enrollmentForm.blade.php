@extends('layouts.dashboard')
@section('content')
@section('breadcrumb')
<x-breadcrumb :items="[]" />
@endsection

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Enrollment Forms</h1>
</div>
@include('components.alert')
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
                    <button @click="currentPage = idx + 1" :class="currentPage === idx + 1
              ? 'bg-[#1A4798] text-white'
              : 'bg-white text-[#1A4798] hover:bg-[#F4C027]/20 hover:text-black'"
                        class="flex items-center justify-center w-full py-3 transition" x-text="label"></button>
                </li>
            </template>
        </ul>
    </nav>
    
    <div x-show="currentPage === 1" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Child’s Information</h2>
        @include('enrollment.partial.ChildInfo')
    </div>

    <div x-show="currentPage === 2" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Guardian Information</h2>
        @include('enrollment.partial.GuardianInfo')
    </div>

    <div x-show="currentPage === 3" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Disability Details</h2>
        @include('enrollment.partial.DisabilityInfo')
    </div>

    <div x-show="currentPage === 4" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Educational Details</h2>
        @include('enrollment.partial.EducationalInfo')
    </div>

    <div x-show="currentPage === 5" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Service Details</h2>
        @include('enrollment.partial.ServiceInfo')
    </div>

    <div x-show="currentPage === 6" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Medical Details</h2>
        @include('enrollment.partial.MedicalInfo')
    </div>

    <div x-show="currentPage === 7" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Family Composition</h2>
        @include('enrollment.partial.FamilyInfo')
    </div>

    <div x-show="currentPage === 8" class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-800">Emergency Contact</h2>
        @include('enrollment.partial.EmergencyInfo')
    </div>
</div>
@endsection