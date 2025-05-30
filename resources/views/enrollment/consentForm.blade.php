@extends('layouts.dashboard')
@section('content')
@section('breadcrumb')
<x-breadcrumb :items="[]" />
@endsection

<div class="p-5 shadow-lg rounded-lg">
    @include('components.alert')
    <h1 class="text-center text-2xl font-bold uppercase mb-2 text-gray-800">
        Pahintulot sa Paggamit ng Larawan at Bidyo ng Mag-aaral
    </h1>
    <p class="text-center text-sm italic mb-6 text-gray-600">
        (Consent to use learner photos and videos)
    </p>

    <form action="{{ route(Auth::user()->getRoleNames()->first() . '.consent.store') }}" method="POST">
        @csrf
        <fieldset class="space-y-4">
            <legend class="font-semibold text-gray-800">I. Impormasyon ng Mag-aaral</legend>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First name</label>
                    <input type="text" name="first_name" placeholder="Name of Learner" value="{{ old('first_name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Middle name</label>
                    <input type="text" name="middle_name" placeholder="Name of Learner" value="{{ old('middle_name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last name</label>
                    <input type="text" name="last_name" placeholder="Name of Learner" value="{{ old('last_name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Petsa ng Kapanganakan</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pangalan ng Magulang/Tagapag-alaga</label>
                    <input type="text"
                        value="{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}"
                        placeholder="Name of Parent/Guardian"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]"
                        readonly />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Relasyon sa Mag-aaral</label>
                    <select name="relation"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]">
                        <option disabled selected>Select Relationship</option>
                        @foreach ($parentType as $types)
                        <option value="{{ $types->id }}" {{ old('relation') == $types->id ? 'selected'  : ''}}>{{ $types->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Numero ng Telepono</label>
                    <input type="tel" value="{{ Auth::user()->contact_number }}" placeholder="Contact Number"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-[#1A4798] focus:border-[#1A4798]"
                        readonly />
                </div>
            </div>
        </fieldset>

        <div class="space-y-4 text-gray-700">
            <p>
                Mahal na Magulang/Tagapag-alaga,
            </p>
            <div class="ml-5">
                <p class="mb-5">
                    Ang Taguig Yakap Center for Children with Disabilities ay nagsusulong ng mas epektibong
                    pagpapalaganap
                    ng
                    impormasyon at dokumentasyon ng mga aktibidad ng aming mga mag-aaral. Kaugnay nito, nais naming
                    humingi
                    ng
                    inyong pahintulot upang gamitin ang larawan at/o bidyo ng inyong anak para sa mga sumusunod na
                    layunin:
                </p>
                <ul class="list-disc list-inside space-y-2 mb-5">
                    <li>Pag-post sa opisyal na social media account ng Taguig Yakap Center for Children with
                        Disabilities
                    </li>
                    <li>Paggamit sa IEC materials (brochures, posters, website, at iba pang promotional materials)</li>
                </ul>
                <p class="mb-5">
                    Ang paggamit ng mga larawan at bidyo ay limitado lamang sa mga layuning pang-edukasyon,
                    pang-impormasyon,
                    at promosyon ng mga gawain ng Taguig Yakap Center for Children with Disabilities.
                </p>
            </div>
        </div>

        <fieldset class="space-y-3">
            <legend class="font-semibold text-gray-800">Pahintulot at Pagtanggap</legend>
            <div class="space-y-2 flex flex-col">
                <label class="items-center">
                    <input type="radio" name="consent_answer" value="Oo" class="form-radio text-[#1A4798]" />
                    <span class="ml-2 text-gray-700">OO, pinapayagan ko ang paggamit ng larawan at bidyo ng aking anak
                        para sa nabanggit na mga layunin</span>
                </label>
                <label class="items-center">
                    <input type="radio" name="consent_answer" value="Hindi" class="form-radio text-[#1A4798]" />
                    <span class="ml-2 text-gray-700">HINDI, hindi ako pumapayag sa paggamit ng larawan at bidyo ng aking
                        anak.</span>
                </label>
            </div>
        </fieldset>

        <div class="text-center">
            <button type="submit"
                class="px-6 py-2 bg-[#1A4798] text-white font-semibold rounded-md hover:bg-[#F4C027] hover:text-black transition-colors">
                Isumite
            </button>
        </div>
    </form>
</div>

@endsection