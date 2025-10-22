@extends('layouts.app')

@section('title', 'Control Panel')
@php
    $role = Auth::user()->role;
@endphp

@section('content')
<div class="space-y-10">

    <!-- User Management -->
    @if($role === 'SuperAdmin')
    <section>
    <h2 class="text-2xl font-bold text-gray-800 mb-4">User & Role Management</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold">System Users</h3>
            <button data-modal-target="addUserModal" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded-lg">+ Add User</button>
        </div>

        <!-- Scrollable container -->
        <div class="max-h-96 overflow-y-auto">
            <table class="w-full text-left border">
                <thead class="sticky top-0 bg-gray-100 z-10">
                    <tr>
                        <th class="p-3 border">username</th>
                        <th class="p-3 border">Role</th>
                        <th class="p-3 border">Status</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="p-3 border">{{ $user->username }}</td>
                        <td class="p-3 border">{{ $user->role }}</td>
                        <td class="p-3 border text-green-600">{{ $user->removed ? 'Inactive' : 'Active' }}</td>
                        <td class="p-3 border space-x-2">
                            <button data-modal-target="editUserModal{{ $user->user_id }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('control-panel.deleteUser', $user->user_id) }}" method="POST" class="inline" onsubmit="return confirmDelete();">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit User Modal -->
                    <div id="editUserModal{{ $user->user_id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                      <div class="bg-white p-6 rounded-lg w-1/3">
                        <h3 class="font-bold text-lg mb-4">Edit User</h3>
                        <form action="{{ route('control-panel.updateUser', $user->user_id) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <label>Username</label>
                          <input type="text" name="username" value="{{ $user->username }}" class="w-full mb-2 p-2 border rounded">

                          <label>Role</label>
                          <select name="role" class="w-full mb-2 p-2 border rounded">
                            <option value="SuperAdmin" @if($user->role=='SuperAdmin') selected @endif>SuperAdmin</option>
                            <option value="Coach" @if($user->role=='Coach') selected @endif>Coach</option>
                            <option value="Staff" @if($user->role=='Staff') selected @endif>Staff</option>
                            <option value="Athlete" @if($user->role=='Athlete') selected @endif>Athlete</option>
                          </select>

                          <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('editUserModal{{ $user->user_id }}')">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
 @endif

<!-- Section: Sports Management -->
<section class="mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Sports Management</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold">Sports</h3>
            <button data-modal-target="addSportModal" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded-lg">+ Add Sport</button>
        </div>
        <div class="overflow-y-auto max-h-64 border rounded-lg">
            <table class="w-full text-left">
                <thead class="sticky top-0 bg-gray-100">
                    <tr>
                        <th class="p-3 border">Sport Name</th>
                        <th class="p-3 border">Assigned Coach</th>
                        <th class="p-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sports as $sport)
                    <tr>
                        <td class="p-3 border">{{ $sport->sport_name }}</td>
                        <td class="p-3 border">{{ $sport->coaches?->full_name ?? 'Unassigned' }}</td>
                        <td class="p-3 border text-center space-x-2">
                            <button data-modal-target="editSportModal{{ $sport->sport_id }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('sports.deactivate', $sport->sport_id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Deactivate</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Sport Modal -->
                    <div id="editSportModal{{ $sport->sport_id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg w-1/3">
                            <h3 class="font-bold text-lg mb-4">Edit Sport</h3>
                            <form action="{{ route('sports.update', $sport->sport_id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <label>Sport Name</label>
                                <input type="text" name="sport_name" value="{{ $sport->sport_name }}" class="w-full mb-2 p-2 border rounded" required>

                                <label>Assigned Coach</label>
                                <select name="coach_id" class="w-full mb-2 p-2 border rounded">
                                    <option value="">-- Select Coach --</option>
                                    @foreach($coaches as $coach)
                                        <option value="{{ $coach->user_id }}" {{ $sport->coach_id == $coach->user_id ? 'selected' : '' }}>
                                            {{ $coach->username }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('editSportModal{{ $sport->sport_id }}')">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Sport Modal -->
<div id="addSportModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="font-bold text-lg mb-4">Add Sport</h3>
        <form action="{{ route('sports.store') }}" method="POST">
            @csrf
            <label>Sport Name</label>
            <input type="text" name="sport_name" class="w-full mb-2 p-2 border rounded" required>

            <label>Assigned Coach</label>
            <select name="coach_id" class="w-full mb-2 p-2 border rounded">
                <option value="">-- Select Coach --</option>
                @foreach($coaches as $coach)
                    <option value="{{ $coach->user_id }}">{{ $coach->username }}</option>
                @endforeach
            </select>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('addSportModal')">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

    <!-- Team Management -->
    <section>
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Teams</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold">Teams</h3>
            <button data-modal-target="addTeamModal" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded-lg">+ Add Team</button>
        </div>

        <!-- Scrollable container -->
        <div class="max-h-96 overflow-y-auto">
            <ul class="space-y-2">
                @foreach($teams as $team)
                <li class="flex justify-between bg-gray-50 p-3 rounded-lg">
                    <span>{{ $team->team_name }}</span>
                    <div class="space-x-2">
                        <button data-modal-target="editTeamModal{{ $team->team_id }}" class="text-sm text-blue-600 hover:underline">Edit</button>
                        <form action="{{ route('control-panel.deleteTeam', $team->team_id) }}" method="POST" class="inline-block" onsubmit="return confirmDeleteTeam();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </li>
                <!-- Edit Team Modal -->
                <div id="editTeamModal{{ $team->team_id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                  <div class="bg-white p-6 rounded-lg w-1/3">
                    <h3 class="font-bold text-lg mb-4">Edit Team</h3>
                    <form action="{{ route('control-panel.updateTeam', $team->team_id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <label>Team Name</label>
                      <input type="text" name="team_name" value="{{ $team->team_name }}" class="w-full mb-2 p-2 border rounded">
                      
                      <label>Sport ID</label>
                      <input type="number" name="sport_id" value="{{ $team->sport_id }}" class="w-full mb-2 p-2 border rounded">

                      <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('editTeamModal{{ $team->team_id }}')">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<!-- Section: Departments Management -->
<section>
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Department Management</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold">College Department</h3>
            <button data-modal-target="addDepartmentModal" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded-lg">+ Add Department</button>
        </div>
        <div class="overflow-y-auto max-h-64 border rounded-lg">
            <table class="w-full text-left">
                <thead class="sticky top-0 bg-gray-100">
                    <tr>
                        <th class="p-3 border">Department Name</th>
                        <th class="p-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td class="p-3 border">{{ $department->department_name }}</td>
                        <td class="p-3 border text-center space-x-2">
                            <button data-modal-target="editDepartmentModal{{ $department->department_id }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('departments.deactivate', $department->department_id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Deactivate</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Department Modal -->
                    <div id="editDepartmentModal{{ $department->department_id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg w-1/3">
                            <h3 class="font-bold text-lg mb-4">Edit Department</h3>
                            <form action="{{ route('departments.update', $department->department_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label>Department Name</label>
                                <input type="text" name="name" value="{{ $department->department_name }}" class="w-full mb-2 p-2 border rounded">
                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('editDepartmentModal{{ $department->id }}')">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Department Modal -->
<div id="addDepartmentModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="font-bold text-lg mb-4">Add Department</h3>
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <label>Department Name</label>
            <input type="text" name="name" class="w-full mb-2 p-2 border rounded">
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('addDepartmentModal')">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Section: Course Management -->
<section class="mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Course Management</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold">College Course</h3>
            <button data-modal-target="addCourseModal" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded-lg">+ Add Course</button>
        </div>
        <div class="overflow-y-auto max-h-64 border rounded-lg">
            <table class="w-full text-left">
                <thead class="sticky top-0 bg-gray-100">
                    <tr>
                        <th class="p-3 border">Course Name</th>
                        <th class="p-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td class="p-3 border">{{ $course->course_name }}</td>
                        <td class="p-3 border text-center space-x-2">
                            <button data-modal-target="editCourseModal{{ $course->course_id }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('courses.deactivate', $course->course_id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Deactivate</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Course Modal -->
                    <div id="editCourseModal{{ $course->course_id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg w-1/3">
                            <h3 class="font-bold text-lg mb-4">Edit Course</h3>
                            <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label>Course Name</label>
                                <input type="text" name="name" value="{{ $course->course_name }}" class="w-full mb-2 p-2 border rounded" required>

                                <label>Department</label>
                                <select name="department_id" class="w-full mb-2 p-2 border rounded text-gray-900" required>
                                    <option value="" disabled selected>Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_id }}" {{ $course->department_id == $department->department_id ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('editCourseModal{{ $course->course_id }}')">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Course Modal -->
<div id="addCourseModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="font-bold text-lg mb-4">Add Course</h3>
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <label>Course Name</label>
            <input type="text" name="name" class="w-full mb-2 p-2 border rounded" required>

            <label>Department</label>
            <select name="department_id" class="w-full mb-2 p-2 border rounded text-gray-900" required>
                <option value="" disabled selected>Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->department_id }}" {{ $course->department_id == $department->department_id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('addCourseModal')">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Section: Section Management -->
<section class="mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Section Management</h2>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-semibold">College Sections</h3>
            <button data-modal-target="addSectionModal" class="bg-amber-900 hover:bg-amber-800 text-white px-4 py-2 rounded-lg">+ Add Section</button>
        </div>
        <div class="overflow-y-auto max-h-64 border rounded-lg">
            <table class="w-full text-left">
                <thead class="sticky top-0 bg-gray-100">
                    <tr>
                        <th class="p-3 border">Section Name</th>
                        <th class="p-3 border">Course</th>
                        <th class="p-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $section)
                    <tr>
                        <td class="p-3 border">{{ $section->section_name }}</td>
                        <td class="p-3 border">{{ $section->course?->course_name }}</td>
                        <td class="p-3 border text-center space-x-2">
                            <button data-modal-target="editSectionModal{{ $section->section_id }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('sections.deactivate', $section->section_id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Deactivate</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Section Modal -->
                    <div id="editSectionModal{{ $section->section_id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg w-1/3">
                            <h3 class="font-bold text-lg mb-4">Edit Section</h3>
                            <form action="{{ route('sections.update', $section->section_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label>Section Name</label>
                                <input type="text" name="name" value="{{ $section->section_name }}" class="w-full mb-2 p-2 border rounded">

                                <label>Course</label>
                                <select name="course_id" class="w-full mb-2 p-2 border rounded">
                                    <option value="">-- Select Course --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->course_id }}" {{ $section->course_id == $course->course_id ? 'selected' : '' }}>
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('editSectionModal{{ $section->section_id }}')">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Section Modal -->
<div id="addSectionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="font-bold text-lg mb-4">Add Section</h3>
        <form action="{{ route('sections.store') }}" method="POST">
            @csrf
            <label>Section Name</label>
            <input type="text" name="name" class="w-full mb-2 p-2 border rounded">

            <label>Course</label>
            <select name="course_id" class="w-full mb-2 p-2 border rounded">
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('addSectionModal')">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add</button>
            </div>
        </form>
    </div>
</div>


@if($role === 'SuperAdmin')
<section>
    <h2 class="text-2xl font-bold text-gray-800 mb-4">System Settings</h2>
    <div class="bg-white rounded-lg shadow-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <button data-modal-target="dataBackupModal" class="bg-gray-800 text-white px-4 py-6 rounded-lg shadow">📂 Data Backup</button>

        <!-- Data Backup Modal -->
        <div id="dataBackupModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center p-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h3 class="text-xl font-bold mb-4">Data Backup</h3>
                <button class="absolute top-4 right-4 text-gray-600" onclick="closeModal('dataBackupModal')">✖️</button>

                <p class="mb-4">Click the button below to download a full database backup.</p>

                <a href="{{ route('control-panel.backupDatabase') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Download Backup
                </a>
            </div>
        </div>
        <button data-modal-target="auditLogsModal" class="bg-gray-800 text-white px-4 py-6 rounded-lg shadow">📑 Audit Logs</button>
    </div>
</section>
@endif
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="font-bold text-lg mb-4">Add User</h3>
        <form action="{{ route('control-panel.storeUser') }}" method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="username" class="w-full mb-2 p-2 border rounded">
            <label>Password</label>
            <input type="text" id="generatedPassword" name="password" 
                    class="w-full mb-2 p-2 border rounded"
                    readonly />
            <button type="button" 
                    onclick="generatePassword()" 
                    class="mt-2 bg-amber-900 text-white px-4 py-1 rounded-lg hover:bg-amber-800">
              Generate New Password
            </button>
            <br/>
            <br/>

            <label>Role</label>
            <select name="role" class="w-full mb-2 p-2 border rounded">
                <option value="SuperAdmin">SuperAdmin</option>
                <option value="Coach">Coach</option>
                <option value="Staff">Staff</option>
                <option value="Athlete">Athlete</option>
            </select>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('addUserModal')">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Team Modal -->
<div id="addTeamModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="font-bold text-lg mb-4">Add Team</h3>
        <form action="{{ route('control-panel.storeTeam') }}" method="POST">
            @csrf

            <!-- Team Name -->
            <label>Team Name</label>
            <input type="text" name="team_name" class="w-full mb-2 p-2 border rounded" required>

            <!-- Sport Dropdown -->
            <label>Sport</label>
            <select name="sport_id" class="w-full mb-2 p-2 border rounded" required>
                <option value="">-- Select Sport --</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->sport_id }}">{{ $sport->sport_name }}</option>
                @endforeach
            </select>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeModal('addTeamModal')">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Audit Logs Modal -->
<div id="auditLogsModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center overflow-auto p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-6xl p-6 relative">
        <h3 class="text-xl font-bold mb-4">Audit Logs</h3>
        <button class="absolute top-4 right-4 text-gray-600" onclick="closeModal('auditLogsModal')">✖️</button>

        <div class="overflow-x-auto max-h-[70vh]">
            <table class="w-full text-left border">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th class="p-2 border">User</th>
                        <th class="p-2 border">Action</th>
                        <th class="p-2 border">Module</th>
                        <th class="p-2 border">Description</th>
                        <th class="p-2 border">IP Address</th>
                        <th class="p-2 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border">{{ $log->user->username ?? 'N/A' }}</td>
                            <td class="p-2 border">{{ $log->action }}</td>
                            <td class="p-2 border">{{ $log->module }}</td>
                            <td class="p-2 border">{{ $log->description }}</td>
                            <td class="p-2 border">{{ $log->ip_address }}</td>
                            <td class="p-2 border">{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
  function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
  }

  // Open modals
  document.querySelectorAll('[data-modal-target]').forEach(btn => {
      btn.addEventListener('click', () => {
          document.getElementById(btn.getAttribute('data-modal-target')).classList.remove('hidden');
      });
      generatePassword();
  });

  function generatePassword(length = 10) {
    const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$!";
    let password = "";
    for (let i = 0; i < length; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById("generatedPassword").value = password;
  }

  function confirmDelete() {
      return confirm('Are you sure you want to delete this user? This action cannot be undone.');
  }
  function confirmDeleteTeam() {
      return confirm('Are you sure you want to delete this team? This action cannot be undone.');
  }

  // events
  // function closeModal(id) {
  //     document.getElementById(id).classList.add('hidden');
  // }

  document.querySelectorAll('[data-modal-target]').forEach(btn => {
      btn.addEventListener('click', () => {
          document.getElementById(btn.getAttribute('data-modal-target')).classList.remove('hidden');
      });
  });

  //   function closeModal(id) {
  //     document.getElementById(id).classList.add('hidden');
  // }

  document.querySelectorAll('[data-modal-target]').forEach(btn => {
      btn.addEventListener('click', () => {
          document.getElementById(btn.getAttribute('data-modal-target')).classList.remove('hidden');
      });
  });

  function confirmDeleteEvent() {
      return confirm('Are you sure you want to delete this event? This action cannot be undone.');
  }

// document.querySelectorAll('[data-modal-target]').forEach(btn => {
//     btn.addEventListener('click', () => {
//         document.getElementById(btn.getAttribute('data-modal-target')).classList.remove('hidden');
//     });
// });
</script>
@endsection
