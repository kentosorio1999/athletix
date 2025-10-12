@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-6">Edit Profile</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('athlete.profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <!-- Account Information -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Account Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Username -->
                <div>
                    <label class="block text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                        class="w-full border rounded p-2">
                    @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 mb-2">Password (leave blank if unchanged)</label>
                    <input type="password" name="password" placeholder="New password" class="w-full border rounded p-2">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm new password"
                        class="w-full border rounded p-2">
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Personal Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Full Name -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $athlete?->full_name) }}"
                        class="w-full border rounded p-2">
                    @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Birthdate -->
                <div>
                    <label class="block text-gray-700 mb-2">Birthdate</label>
                    <input type="date" name="birthdate" value="{{ old('birthdate', $athlete?->birthdate) }}"
                        class="w-full border rounded p-2">
                    @error('birthdate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Age -->
                <div>
                    <label class="block text-gray-700 mb-2">Age</label>
                    <input type="number" name="age" value="{{ old('age', $athlete?->age) }}"
                        class="w-full border rounded p-2" min="15" max="40">
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-gray-700 mb-2">Gender</label>
                    <select name="gender" class="w-full border rounded p-2">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $athlete?->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $athlete?->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $athlete?->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- School ID -->
                <div>
                    <label class="block text-gray-700 mb-2">School ID</label>
                    <input type="text" name="school_id" value="{{ old('school_id', $athlete?->school_id) }}"
                        class="w-full border rounded p-2">
                    @error('school_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Academic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Year Level -->
                <div>
                    <label class="block text-gray-700 mb-2">Year Level</label>
                    <select name="year_level" class="w-full border rounded p-2">
                        <option value="">Select Year Level</option>
                        <option value="1st Year" {{ old('year_level', $athlete?->year_level) == '1st Year' ? 'selected' : '' }}>1st Year</option>
                        <option value="2nd Year" {{ old('year_level', $athlete?->year_level) == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3rd Year" {{ old('year_level', $athlete?->year_level) == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4th Year" {{ old('year_level', $athlete?->year_level) == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        <option value="Alumni" {{ old('year_level', $athlete?->year_level) == 'Alumni' ? 'selected' : '' }}>Alumni</option>
                    </select>
                    @error('year_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Academic Course -->
                <div>
                    <label class="block text-gray-700 mb-2">Academic Course</label>
                    <input type="text" name="academic_course" value="{{ old('academic_course', $athlete?->academic_course) }}"
                        class="w-full border rounded p-2" placeholder="e.g., BS Computer Science">
                    @error('academic_course') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Section -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Section</label>
                    <select name="section_id" class="w-full border rounded p-2">
                        <option value="">Select Section</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->section_id }}" 
                                {{ old('section_id', $athlete?->section_id) == $section->section_id ? 'selected' : '' }}>
                                {{ $section->section_name }} - {{ $section->course->course_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Sports & Competition Information -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Sports & Competition Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Sport -->
                <div>
                    <label class="block text-gray-700 mb-2">Sport</label>
                    <select name="sport_id" class="w-full border rounded p-2">
                        <option value="">Select Sport</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->sport_id }}" 
                                {{ old('sport_id', $athlete?->sport_id) == $sport->sport_id ? 'selected' : '' }}>
                                {{ $sport->sport_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('sport_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Highest Competition Level -->
                <div>
                    <label class="block text-gray-700 mb-2">Highest Competition Level</label>
                    <select name="highest_competition_level" class="w-full border rounded p-2">
                        <option value="">Select Level</option>
                        <option value="Intramurals" {{ old('highest_competition_level', $athlete?->highest_competition_level) == 'Intramurals' ? 'selected' : '' }}>Intramurals</option>
                        <option value="University" {{ old('highest_competition_level', $athlete?->highest_competition_level) == 'University' ? 'selected' : '' }}>University</option>
                        <option value="Local" {{ old('highest_competition_level', $athlete?->highest_competition_level) == 'Local' ? 'selected' : '' }}>Local</option>
                        <option value="Regional" {{ old('highest_competition_level', $athlete?->highest_competition_level) == 'Regional' ? 'selected' : '' }}>Regional</option>
                        <option value="National" {{ old('highest_competition_level', $athlete?->highest_competition_level) == 'National' ? 'selected' : '' }}>National</option>
                        <option value="International" {{ old('highest_competition_level', $athlete?->highest_competition_level) == 'International' ? 'selected' : '' }}>International</option>
                    </select>
                    @error('highest_competition_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- International Competition Name -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">International Competition Name (if applicable)</label>
                    <input type="text" name="international_competition_name" 
                        value="{{ old('international_competition_name', $athlete?->international_competition_name) }}"
                        class="w-full border rounded p-2" placeholder="e.g., SEA Games, Asian Games">
                    @error('international_competition_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Highest Accomplishment -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Highest Accomplishment as an Athlete</label>
                    <textarea name="highest_accomplishment" rows="3" 
                        class="w-full border rounded p-2">{{ old('highest_accomplishment', $athlete?->highest_accomplishment) }}</textarea>
                    @error('highest_accomplishment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Training Information -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Training Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Training Frequency -->
                <div>
                    <label class="block text-gray-700 mb-2">Training Frequency (days per week)</label>
                    <input type="number" name="training_frequency_days" 
                        value="{{ old('training_frequency_days', $athlete?->training_frequency_days) }}"
                        class="w-full border rounded p-2" min="1" max="7">
                    @error('training_frequency_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Training Hours Per Day -->
                <div>
                    <label class="block text-gray-700 mb-2">Training Hours Per Day</label>
                    <input type="number" name="training_hours_per_day" step="0.5"
                        value="{{ old('training_hours_per_day', $athlete?->training_hours_per_day) }}"
                        class="w-full border rounded p-2" min="0.5" max="8">
                    @error('training_hours_per_day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Training Seminars Attended -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Special Training & Seminars Attended</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="training_seminars_regional" value="1" 
                                {{ old('training_seminars_regional', $athlete?->training_seminars_regional) ? 'checked' : '' }}
                                class="mr-2">
                            Regional
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="training_seminars_national" value="1"
                                {{ old('training_seminars_national', $athlete?->training_seminars_national) ? 'checked' : '' }}
                                class="mr-2">
                            National
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="training_seminars_international" value="1"
                                {{ old('training_seminars_international', $athlete?->training_seminars_international) ? 'checked' : '' }}
                                class="mr-2">
                            International
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scholarship & Benefits -->
        <!-- <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Scholarship & Benefits</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-gray-700 mb-2">Scholarship Status</label>
                    <select name="scholarship_status" class="w-full border rounded p-2">
                        <option value="">Select Status</option>
                        <option value="Full Scholarship" {{ old('scholarship_status', $athlete?->scholarship_status) == 'Full Scholarship' ? 'selected' : '' }}>Full Scholarship</option>
                        <option value="Partial Scholarship" {{ old('scholarship_status', $athlete?->scholarship_status) == 'Partial Scholarship' ? 'selected' : '' }}>Partial Scholarship</option>
                        <option value="Non-scholar" {{ old('scholarship_status', $athlete?->scholarship_status) == 'Non-scholar' ? 'selected' : '' }}>Non-scholar</option>
                    </select>
                    @error('scholarship_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div>
                    <label class="block text-gray-700 mb-2">Monthly Living Allowance (₱)</label>
                    <input type="number" name="monthly_living_allowance" step="0.01"
                        value="{{ old('monthly_living_allowance', $athlete?->monthly_living_allowance) }}"
                        class="w-full border rounded p-2" min="0">
                    @error('monthly_living_allowance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div>
                    <label class="block text-gray-700 mb-2">Average Tournament Allowance (₱)</label>
                    <input type="number" name="average_tournament_allowance" step="0.01"
                        value="{{ old('average_tournament_allowance', $athlete?->average_tournament_allowance) }}"
                        class="w-full border rounded p-2" min="0">
                    @error('average_tournament_allowance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Support Services Provided</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="board_lodging_support" value="1"
                                {{ old('board_lodging_support', $athlete?->board_lodging_support) ? 'checked' : '' }}
                                class="mr-2">
                            Board & Lodging
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="medical_insurance_support" value="1"
                                {{ old('medical_insurance_support', $athlete?->medical_insurance_support) ? 'checked' : '' }}
                                class="mr-2">
                            Medical Insurance
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="training_uniforms_support" value="1"
                                {{ old('training_uniforms_support', $athlete?->training_uniforms_support) ? 'checked' : '' }}
                                class="mr-2">
                            Training Uniforms
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="playing_uniforms_sponsorship" value="1"
                                {{ old('playing_uniforms_sponsorship', $athlete?->playing_uniforms_sponsorship) ? 'checked' : '' }}
                                class="mr-2">
                            Playing Uniforms
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="playing_gears_sponsorship" value="1"
                                {{ old('playing_gears_sponsorship', $athlete?->playing_gears_sponsorship) ? 'checked' : '' }}
                                class="mr-2">
                            Playing Gears
                        </label>
                    </div>
                </div>


                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Academic Support</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="excused_from_academic_obligations" value="1"
                                {{ old('excused_from_academic_obligations', $athlete?->excused_from_academic_obligations) ? 'checked' : '' }}
                                class="mr-2">
                            Excused from Academic Obligations
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="flexible_academic_schedule" value="1"
                                {{ old('flexible_academic_schedule', $athlete?->flexible_academic_schedule) ? 'checked' : '' }}
                                class="mr-2">
                            Flexible Academic Schedule
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="academic_tutorials_support" value="1"
                                {{ old('academic_tutorials_support', $athlete?->academic_tutorials_support) ? 'checked' : '' }}
                                class="mr-2">
                            Academic Tutorials
                        </label>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection