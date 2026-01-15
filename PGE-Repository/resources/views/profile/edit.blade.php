@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-6">
    <div class="mb-6">
        <h1 class="text-3xl font-semibold text-slate-900">Edit Profile</h1>
        <p class="mt-1 text-sm text-slate-500">Update your account's profile information</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
            <span>Profile updated successfully!</span>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
            <span>Password updated successfully!</span>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="space-y-6">
        {{-- Profile Information --}}
        <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Profile Information</h2>
                <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email address.</p>
            </div>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $user->nama) }}" 
                           required 
                           autofocus
                           class="w-full rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900 @error('nama') border-red-500 @enderror">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}" 
                           required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Update Password</h2>
                <p class="mt-1 text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" 
                           id="current_password" 
                           name="current_password" 
                           class="w-full rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900 @error('current_password', 'updatePassword') border-red-500 @enderror">
                    @error('current_password', 'updatePassword')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900 @error('password', 'updatePassword') border-red-500 @enderror">
                    @error('password', 'updatePassword')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
