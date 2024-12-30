<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <form action="{{ route('candidate.profile.profile-info.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Gender *</label>
                            <select name="gender"
                                class="{{ $errors->has('gender') ? 'is-invalid' : '' }} form-control">
                                <option value="">Select one</option>
                                <option @selected($candidate?->gender === 'male') value="male">Male</option>
                                <option @selected($candidate?->gender === 'female') value="female">Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Marital Status *</label>
                            <select name="marital_status"
                                class="{{ $errors->has('marital_status') ? 'is-invalid' : '' }} form-control">
                                <option value="">Select one</option>
                                <option @selected($candidate?->marital_status === 'single') value="single">Single</option>
                                <option @selected($candidate?->marital_status === 'married') value="married">Married</option>
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Profession *</label>
                            <select name="profession"
                                class="{{ $errors->has('profession') ? 'is-invalid' : '' }} form-control form-icons select-active select2">
                                <option value="">Select Experience</option>
                                @foreach ($professions as $profession)
                                    <option @selected($profession->id === $candidate?->profession_id) value="{{ $profession->id }}">
                                        {{ $profession->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Your Availability *</label>
                            <select name="availability"
                                class="{{ $errors->has('availability') ? 'is-invalid' : '' }} form-control">
                                <option value="">Select one</option>
                                <option @selected($candidate?->status === 'available') value="available">Available</option>
                                <option @selected($candidate?->status === 'not_available') value="not_available">Not Available</option>
                            </select>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Skills you Have *</label>
                            <select name="skill_you_have[]"
                                class="{{ $errors->has('skill_you_have') ? 'is-invalid' : '' }} form-control form-icons select-active"
                                multiple="">
                                <option value="">Select</option>
                                @php

                                @endphp
                                @foreach ($skills as $skill)
                                    @php
                                        $candidateSkills = $candidate->skills->pluck('skill_id')->toArray() ?? [];
                                    @endphp
                                    <option @selected(in_array($skill->id, $candidateSkills)) value="{{ $skill->id }}">
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('skill_you_have')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Languages you know *</label>
                            <select name="language_you_know[]"
                                class="{{ $errors->has('language_you_know') ? 'is-invalid' : '' }} form-control form-icons select-active"
                                multiple="">
                                <option value="">Select</option>
                                @foreach ($languages as $language)
                                    @php
                                        $candidateLanguages =
                                            $candidate->languages->pluck('language_id')->toArray() ?? [];
                                    @endphp
                                    <option @selected(in_array($language->id, $candidateLanguages)) value="{{ $language->id }}">
                                        {{ $language->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('language_you_know')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Biography *</label>
                            <textarea class="form-control {{ $errors->has('biography') ? 'is-invalid' : '' }}" name="biography" id=""
                                cols="30" rows="10">{!! $candidate?->bio !!}</textarea>
                            <x-input-error :messages="$errors->get('biography')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-button mt-15">
            <button type="submit" class="btn btn-apply-big font-md font-bold">Save All Changes
            </button>
        </div>
    </form>
</div>
