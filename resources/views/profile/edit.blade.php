<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-4 sm:p-8 bg-black text-white shadow sm:rounded-lg border border-red-500 retro-box">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium">Update Profile Information</h3>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="mt-4">
                            <label for="name" class="block text-sm font-medium text-white">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-white">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mt-4">
                            <label for="profile_picture" class="block text-sm font-medium text-white">Profile Picture</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @if ($user->profile_picture)
                                <div class="mt-2 flex justify-center">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-md" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            @endif
                            @error('profile_picture')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birthday -->
                        <div class="mt-4">
                            <label for="birthday" class="block text-sm font-medium text-white">Birthday</label>
                            <input type="date" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @error('birthday')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Age -->
                        <div class="mt-4">
                            <label for="age" class="block text-sm font-medium text-white">Age</label>
                            <input type="number" id="age" name="age" value="{{ old('age', $user->age) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @error('age')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="mt-4">
                            <label for="gender" class="block text-sm font-medium text-white">Gender</label>
                            <input type="text" id="gender" name="gender" value="{{ old('gender', $user->gender) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @error('gender')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <label for="address" class="block text-sm font-medium text-white">Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Occupation -->
                        <div class="mt-4">
                            <label for="occupation" class="block text-sm font-medium text-white">Occupation</label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $user->occupation) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @error('occupation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nationality -->
                        <div class="mt-4">
                            <label for="nationality" class="block text-sm font-medium text-white">Nationality</label>
                            <input type="text" id="nationality" name="nationality" value="{{ old('nationality', $user->nationality) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-white">
                            @error('nationality')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-black text-white shadow sm:rounded-lg border border-red-500 retro-box">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium"></h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-black text-white shadow sm:rounded-lg border border-red-500 retro-box">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium"></h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        .retro-box {
            border: 1px solid #f00;
            background-color: #111;
            color: #eee;
        }
    </style>
</x-app-layout>
