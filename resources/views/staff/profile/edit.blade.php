@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('staff.profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Username -->
        <div class="mb-3">
            <label class="block text-gray-700">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                class="w-full border rounded p-2">
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="block text-gray-700">Password (leave blank if unchanged)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            <input type="password" name="password_confirmation" placeholder="Confirm password"
                class="w-full border rounded p-2 mt-2">
        </div>

        <!-- Full Name -->
        <div class="mb-3">
            <label class="block text-gray-700">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name', $staff->full_name) }}"
                class="w-full border rounded p-2">
        </div>

        <!-- Position -->
        <div class="mb-3">
            <label class="block text-gray-700">Position</label>
            <input type="text" name="position" value="{{ old('position', $staff->position) }}"
                class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Changes
        </button>
    </form>
</div>
@endsection
