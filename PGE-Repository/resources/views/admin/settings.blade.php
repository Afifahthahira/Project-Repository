@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-lg font-semibold mb-4">Admin Settings</h2>

    <ul class="space-y-3">
        <li><a href="{{ route('profile.edit') }}" class="text-blue-600">Edit Profile</a></li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-red-600">Logout</button>
            </form>
        </li>
    </ul>
</div>
@endsection
