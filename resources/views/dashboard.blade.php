@extends('layouts.dashboard')
@section('content')
@section('breadcrumb')
<x-breadcrumb :items="[
    ]" />
@endsection

<main class="flex-1 p-8 overflow-y-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <div class="flex items-center space-x-3">
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all group">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-sm text-gray-500 font-medium">No. of Students</h4>
                    <h2 class="text-3xl font-bold text-blue-600 mt-1">1,024</h2>
                    <p class="text-sm text-green-500 mt-1">↑ 4.3% this week</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all group">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-sm text-gray-500 font-medium">No. of Students per Category</h4>
                    <h2 class="text-3xl font-bold text-green-600 mt-1">58</h2>
                    <p class="text-sm text-green-500 mt-1">↑ 1.7% growth</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all group">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-sm text-gray-500 font-medium">No. of Patients per Therapy</h4>
                    <h2 class="text-3xl font-bold text-yellow-500 mt-1">127</h2>
                    <p class="text-sm text-yellow-500 mt-1">↑ 6.2% from yesterday</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all group">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-sm text-gray-500 font-medium">No. of Schedule Today</h4>
                    <h2 class="text-3xl font-bold text-red-500 mt-1">12</h2>
                    <p class="text-sm text-red-500 mt-1">↓ 2.1% this week</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Upcoming Appointments</h2>
        <div class="overflow-hidden rounded-xl shadow bg-white">
            <table class="w-full table-auto text-sm">
                <thead class="bg-gray-100 text-gray-600 text-left">
                    <tr>
                        <th class="py-3 px-5">Patient</th>
                        <th class="py-3 px-5">Doctor</th>
                        <th class="py-3 px-5">Time</th>
                        <th class="py-3 px-5">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <td class="py-3 px-5">John Doe</td>
                    <td class="py-3 px-5">Dr. Smith</td>
                    <td class="py-3 px-5">10:00 AM</td>
                    <td class="py-3 px-5"><span class="text-green-600 font-medium">Confirmed</span></td>
                    </tr>
                    <td class="py-3 px-5">Jane Wilson</td>
                    <td class="py-3 px-5">Dr. Adams</td>
                    <td class="py-3 px-5">11:30 AM</td>
                    <td class="py-3 px-5"><span class="text-yellow-600 font-medium">Pending</span></td>
                    </tr>
                    <td class="py-3 px-5">Carlos Diaz</td>
                    <td class="py-3 px-5">Dr. Lee</td>
                    <td class="py-3 px-5">1:00 PM</td>
                    <td class="py-3 px-5"><span class="text-red-600 font-medium">Cancelled</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection