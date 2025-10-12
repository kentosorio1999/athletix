@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-6">Edit Coach Profile</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('coach.profile.update') }}" class="space-y-6">
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
                    <input type="text" name="full_name" value="{{ old('full_name', $coach?->full_name) }}"
                        class="w-full border rounded p-2">
                    @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Age -->
                <div>
                    <label class="block text-gray-700 mb-2">Age</label>
                    <input type="number" name="age" value="{{ old('age', $coach?->age) }}"
                        class="w-full border rounded p-2" min="20" max="70">
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-gray-700 mb-2">Gender</label>
                    <select name="gender" class="w-full border rounded p-2">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $coach?->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $coach?->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $coach?->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Sports & Employment Information -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Sports & Employment Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Sport -->
                <div>
                    <label class="block text-gray-700 mb-2">Sports Program</label>
                    <select name="sport_id" class="w-full border rounded p-2">
                        <option value="">Select Sport</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->sport_id }}" 
                                {{ old('sport_id', $coach?->sport_id) == $sport->sport_id ? 'selected' : '' }}>
                                {{ $sport->sport_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('sport_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Specialization -->
                <div>
                    <label class="block text-gray-700 mb-2">Specialization</label>
                    <input type="text" name="specialization" value="{{ old('specialization', $coach?->specialization) }}"
                        class="w-full border rounded p-2" placeholder="e.g., Offensive Strategy, Defense">
                    @error('specialization') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Current Position Title -->
                <div>
                    <label class="block text-gray-700 mb-2">Current Position Title</label>
                    <input type="text" name="current_position_title" value="{{ old('current_position_title', $coach?->current_position_title) }}"
                        class="w-full border rounded p-2" placeholder="e.g., Head Coach, Assistant Coach">
                    @error('current_position_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Sports Program Position -->
                <div>
                    <label class="block text-gray-700 mb-2">Sports Program Position</label>
                    <input type="text" name="sports_program_position" value="{{ old('sports_program_position', $coach?->sports_program_position) }}"
                        class="w-full border rounded p-2" placeholder="e.g., Varsity Coach, Training Director">
                    @error('sports_program_position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Employment Status -->
                <div>
                    <label class="block text-gray-700 mb-2">Employment Status</label>
                    <select name="employment_status" class="w-full border rounded p-2">
                        <option value="">Select Status</option>
                        <option value="Permanent" {{ old('employment_status', $coach?->employment_status) == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                        <option value="Contractual" {{ old('employment_status', $coach?->employment_status) == 'Contractual' ? 'selected' : '' }}>Contractual</option>
                        <option value="Part-time" {{ old('employment_status', $coach?->employment_status) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Volunteer" {{ old('employment_status', $coach?->employment_status) == 'Volunteer' ? 'selected' : '' }}>Volunteer</option>
                    </select>
                    @error('employment_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Monthly Salary -->
                <div>
                    <label class="block text-gray-700 mb-2">Monthly Salary (₱)</label>
                    <input type="number" name="monthly_salary" step="0.01"
                        value="{{ old('monthly_salary', $coach?->monthly_salary) }}"
                        class="w-full border rounded p-2" min="0">
                    @error('monthly_salary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Years of Experience -->
                <div>
                    <label class="block text-gray-700 mb-2">Years of Experience</label>
                    <input type="number" name="years_experience" 
                        value="{{ old('years_experience', $coach?->years_experience) }}"
                        class="w-full border rounded p-2" min="0" max="50">
                    @error('years_experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Athletic Background -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Athletic Background</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Was Previous Athlete -->
                <div class="md:col-span-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="was_previous_athlete" value="1" 
                            {{ old('was_previous_athlete', $coach?->was_previous_athlete) ? 'checked' : '' }}
                            class="mr-2">
                        Was previously an athlete?
                    </label>
                </div>

                <!-- Highest Competition Level -->
                <div>
                    <label class="block text-gray-700 mb-2">Highest Competition Level (as Athlete)</label>
                    <select name="highest_competition_level" class="w-full border rounded p-2">
                        <option value="">Select Level</option>
                        <option value="Intramurals" {{ old('highest_competition_level', $coach?->highest_competition_level) == 'Intramurals' ? 'selected' : '' }}>Intramurals</option>
                        <option value="University" {{ old('highest_competition_level', $coach?->highest_competition_level) == 'University' ? 'selected' : '' }}>University</option>
                        <option value="Local" {{ old('highest_competition_level', $coach?->highest_competition_level) == 'Local' ? 'selected' : '' }}>Local</option>
                        <option value="Regional" {{ old('highest_competition_level', $coach?->highest_competition_level) == 'Regional' ? 'selected' : '' }}>Regional</option>
                        <option value="National" {{ old('highest_competition_level', $coach?->highest_competition_level) == 'National' ? 'selected' : '' }}>National</option>
                        <option value="International" {{ old('highest_competition_level', $coach?->highest_competition_level) == 'International' ? 'selected' : '' }}>International</option>
                    </select>
                    @error('highest_competition_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- International Competition (Athlete) -->
                <div>
                    <label class="block text-gray-700 mb-2">International Competition (as Athlete)</label>
                    <input type="text" name="international_competition_athlete" 
                        value="{{ old('international_competition_athlete', $coach?->international_competition_athlete) }}"
                        class="w-full border rounded p-2" placeholder="e.g., SEA Games, Asian Games">
                    @error('international_competition_athlete') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Highest Accomplishment (Athlete) -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Highest Accomplishment as Athlete</label>
                    <textarea name="highest_accomplishment_athlete" rows="3" 
                        class="w-full border rounded p-2">{{ old('highest_accomplishment_athlete', $coach?->highest_accomplishment_athlete) }}</textarea>
                    @error('highest_accomplishment_athlete') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Coaching Accomplishments -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Coaching Accomplishments</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Highest Accomplishment (Coach) -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">Highest Accomplishment as Coach</label>
                    <textarea name="highest_accomplishment_coach" rows="3" 
                        class="w-full border rounded p-2">{{ old('highest_accomplishment_coach', $coach?->highest_accomplishment_coach) }}</textarea>
                    @error('highest_accomplishment_coach') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- International Competition (Coach) -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2">International Competition (as Coach)</label>
                    <input type="text" name="international_competition_coach" 
                        value="{{ old('international_competition_coach', $coach?->international_competition_coach) }}"
                        class="w-full border rounded p-2" placeholder="e.g., World Championships, Olympic Games">
                    @error('international_competition_coach') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Professional Memberships & Licenses -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Professional Memberships & Licenses</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="flex items-center">
                    <input type="checkbox" name="regional_membership" value="1" 
                        {{ old('regional_membership', $coach?->regional_membership) ? 'checked' : '' }}
                        class="mr-2">
                    Regional Membership/License
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="national_membership" value="1"
                        {{ old('national_membership', $coach?->national_membership) ? 'checked' : '' }}
                        class="mr-2">
                    National Membership/License
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="international_membership" value="1"
                        {{ old('international_membership', $coach?->international_membership) ? 'checked' : '' }}
                        class="mr-2">
                    International Membership/License
                </label>
            </div>

            <!-- International Membership Name -->
            <div class="mt-4">
                <label class="block text-gray-700 mb-2">International Membership/License Name</label>
                <input type="text" name="international_membership_name" 
                    value="{{ old('international_membership_name', $coach?->international_membership_name) }}"
                    class="w-full border rounded p-2" placeholder="e.g., FIBA Certified Coach, FIFA License">
                @error('international_membership_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Educational Background -->
        <div class="border-b pb-4">
            <h3 class="text-lg font-medium mb-4">Educational Background</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Highest Degree -->
                <div>
                    <label class="block text-gray-700 mb-2">Highest Degree Attained</label>
                    <select name="highest_degree" class="w-full border rounded p-2">
                        <option value="">Select Degree</option>
                        <option value="High School" {{ old('highest_degree', $coach?->highest_degree) == 'High School' ? 'selected' : '' }}>High School</option>
                        <option value="Bachelor" {{ old('highest_degree', $coach?->highest_degree) == 'Bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                        <option value="Master" {{ old('highest_degree', $coach?->highest_degree) == 'Master' ? 'selected' : '' }}>Master's Degree</option>
                        <option value="Doctorate" {{ old('highest_degree', $coach?->highest_degree) == 'Doctorate' ? 'selected' : '' }}>Doctorate Degree</option>
                    </select>
                    @error('highest_degree') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Bachelor's Degree -->
                <div>
                    <label class="block text-gray-700 mb-2">Bachelor's Degree Program</label>
                    <input type="text" name="bachelor_degree" 
                        value="{{ old('bachelor_degree', $coach?->bachelor_degree) }}"
                        class="w-full border rounded p-2" placeholder="e.g., BS Physical Education">
                    @error('bachelor_degree') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Master's Degree -->
                <div>
                    <label class="block text-gray-700 mb-2">Master's Degree Program</label>
                    <input type="text" name="master_degree" 
                        value="{{ old('master_degree', $coach?->master_degree) }}"
                        class="w-full border rounded p-2" placeholder="e.g., MA Sports Science">
                    @error('master_degree') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Doctorate Degree -->
                <div>
                    <label class="block text-gray-700 mb-2">Doctorate Degree Program</label>
                    <input type="text" name="doctorate_degree" 
                        value="{{ old('doctorate_degree', $coach?->doctorate_degree) }}"
                        class="w-full border rounded p-2" placeholder="e.g., PhD Sports Management">
                    @error('doctorate_degree') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection