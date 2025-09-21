@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('coach.profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Username -->
        <div class="mb-3">
            <label class="block text-gray-700">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                class="w-full border rounded p-2">
            @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="block text-gray-700">Password (leave blank if unchanged)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            <input type="password" name="password_confirmation" placeholder="Confirm password"
                class="w-full border rounded p-2 mt-2">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Full Name -->
        <div class="mb-3">
            <label class="block text-gray-700">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name', $coach?->full_name) }}"
                class="w-full border rounded p-2">
            @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Specialization -->
        <div class="mb-3">
            <label class="block text-gray-700">Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization', $coach?->specialization) }}"
                class="w-full border rounded p-2">
            @error('specialization') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Changes
        </button>
    </form>
</div>
@endsection
