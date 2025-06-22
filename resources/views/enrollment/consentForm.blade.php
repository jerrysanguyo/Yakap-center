@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Consent form</h3>
                    <div class="section-body-breadcrumb d-flex">
                        <div class="breadcrumb-item active">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">
                                Dashboard
                            </a>
                        </div>
                        <div class="breadcrumb-item">
                            Consent Form
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="card shadow-lg card-primary">
            <div class="card-header mt-3 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <h2 class="font-weight-bold">
                        Pahintulot sa Paggamit ng Larawan at Bidyo ng Mag-aaral
                    </h2>
                    <p class="text-muted">
                        (Consent to use learner photos and videos)
                    </p>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route(Auth::user()->getRoleNames()->first() . '.consent.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <h5 class="font-weight-bold">I. Impormasyon ng Mag-aaral</h5>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                    placeholder="e.g. Juan" class="form-control" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                                    placeholder="e.g. Gomez" class="form-control" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                    placeholder="e.g. Zamora" class="form-control" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="birth_date">Petsa ng Kapanganakan</label>
                                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="parent_name">Pangalan ng Magulang/Tagapag-alaga</label>
                                <input type="text" id="parent_name"
                                    value="{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}"
                                    class="form-control" readonly />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="relation">Relasyon sa Mag-aaral</label>
                                <select name="relation" id="relation" class="form-control">
                                    <option value="" disabled selected>Select Relationship</option>
                                    @foreach($parentType as $types)
                                    <option value="{{ $types->id }}"
                                        {{ old('relation') == $types->id ? 'selected' : '' }}>
                                        {{ $types->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact_number">Numero ng Telepono</label>
                                <input type="tel" id="contact_number" value="{{ Auth::user()->contact_number }}"
                                    class="form-control" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-weight-bold">II. Pahintulot at Pagtanggap</h5>
                        <p class="text-muted mb-3">
                            Mahal na Magulang/Tagapag-alaga,
                        </p>
                        <p class="mb-2 ml-3 text-justify">
                            Ang Taguig Yakap Center for Children with Disabilities ay nagsusulong ng mas epektibong
                            pagpapalaganap ng impormasyon at dokumentasyon ng mga aktibidad ng aming mga mag-aaral.
                            Kaugnay nito, nais naming humingi ng inyong pahintulot upang gamitin ang larawan at/o bidyo
                            ng inyong anak para sa mga sumusunod na layunin:
                        </p>
                        <ul class="list-unstyled ml-5 mb-2">
                            <li class="mb-1">
                                <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                Pag-post sa opisyal na social media account ng Taguig Yakap Center for Children with
                                Disabilities
                            </li>
                            <li>
                                <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                Paggamit sa IEC materials (brochures, posters, website, at iba pang promotional
                                materials)
                            </li>
                        </ul>
                        <p class="mb-3 ml-3 text-justify">
                            Ang paggamit ng mga larawan at bidyo ay limitado lamang sa mga layuning pang-edukasyon,
                            pang-impormasyon,
                            at promosyon ng mga gawain ng Taguig Yakap Center for Children with Disabilities.
                        </p>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="consent_yes" name="consent_answer" value="Oo"
                                    class="custom-control-input" />
                                <label class="custom-control-label" for="consent_yes">
                                    OO, pinapayagan ko ang paggamit ng larawan at bidyo ng aking anak para sa nabanggit
                                    na mga layunin
                                </label>
                            </div>
                            <div class="custom-control custom-radio mt-2">
                                <input type="radio" id="consent_no" name="consent_answer" value="Hindi"
                                    class="custom-control-input" />
                                <label class="custom-control-label" for="consent_no">
                                    HINDI, hindi ako pumapayag sa paggamit ng larawan at bidyo ng aking anak.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection