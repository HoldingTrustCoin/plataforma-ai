@extends('layouts.admin')

@section('contents')
    <div class="w-full p-3">
        <div class="w-full lg:flex lg:gap-3">
            <div class="w-full lg:w-1/3 h-52 ts-gray-2 rounded-lg p-5 mb-3">
                <div class="w-full grid grid-cols-1 gap-3 p-2">
                    <a data-target="profile" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Profile</a>
                    <a data-target="security" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Security</a>

                    <a data-target="photo" role="button"
                        class="border-l-4 border-orange-500 px-3 hover:scale-110 hover:text-purple-700 transition-all cursor-pointer rescron-card-trigger">
                        Photo</a>

                    

                </div>
            </div>
            <div class="w-full lg:w-2/3">
                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card" id="profile">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Update Profile
                            Information</span></h3>
                    <form action="{{ route('admin.profile.edit-validate') }}" class="mt-5 gen-form">
                        @csrf

                        <div class="w-full grid grid-cols-1  gap-5">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        person
                                    </span>
                                    <input type="text" name="name" placeholder="Name" id="name"
                                        class="theme1-text-input" required
                                        value="{{ old('name') ?? admin()->name }}">
                                    <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">Name
                                        <span class="text-red-500">*</span></label>
                                    <span class="text-xs text-red-500">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        mail
                                    </span>
                                    <input type="email" name="email" placeholder="Email" id="email"
                                        class="theme1-text-input" {!! is_required('email', false) !!}
                                        value="{{ old('email') ?? admin()->email }}" required>
                                    <label for="email" class="placeholder-label text-gray-300 ts-gray-2 px-2">Email
                                        <span class="text-red-500">*</span></label>
                                    <span class="text-xs text-red-500">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            
                        </div>
                        

                        <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                            <button type="submit"
                                class="bg-purple-500 px-2 py-1 rounded-full hover:scale-110 transition-all">Save
                                Changes </button>
                        </div>

                    </form>
                </div>

                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card transition-all hidden" id="security">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Update Password</span>
                    </h3>
                    <form action="{{ route('admin.profile.password') }}" class="mt-5 gen-form">
                        @csrf

                        <div class="w-full grid grid-cols-1  gap-5 mb-3">
                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        lock
                                    </span>
                                    <input type="password" name="current_password" placeholder="Current Password"
                                        id="current_password" class="theme1-text-input" required>
                                    <label for="current_password"
                                        class="placeholder-label text-gray-300 ts-gray-2 px-2">Current Password <span
                                            class="text-red-500">*</span></label>
                                    <span class="text-xs text-red-500">
                                        @error('current_password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        lock
                                    </span>
                                    <input type="password" name="password" placeholder="New Password" id="password"
                                        class="theme1-text-input" required>
                                    <label for="password" class="placeholder-label text-gray-300 ts-gray-2 px-2">New
                                        Password <span class="text-red-500">*</span></label>
                                    <span class="text-xs text-red-500">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 mb-2">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        lock
                                    </span>
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                        id="password_confirmation" class="theme1-text-input" required>
                                    <label for="password_confirmation"
                                        class="placeholder-label text-gray-300 ts-gray-2 px-2">Confirm Password <span
                                            class="text-red-500">*</span></label>
                                    <span class="text-xs text-red-500">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                        </div>


                        <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                            <button type="submit"
                                class="bg-purple-500 px-2 py-1 rounded-full hover:scale-110 transition-all">Save
                                Changes </button>
                        </div>

                    </form>
                </div>


                <div class="w-full p-5 mb-5 ts-gray-2 rounded-lg rescron-card  transition-all hidden" id="photo">
                    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Update Profile
                            Photo</span></h3>
                    <form action="{{ route('admin.profile.photo') }}" class="mt-5 gen-form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="w-full grid grid-cols-1  gap-5 mb-3">
                            <label
                                class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                for="photo">
                                <span id="photo-preview"
                                    class="uploadIcon w-32 h-32 rounded-full  flex justify-center items-center"
                                    style="background-image: url({{ asset('storage/profile/' . admin()->photo) }}); background-size: contain; background-repeat: no-repeat;">
                                    <span class="bg-transparent hover:bg-orange-600 border p-2 text-white rounded-full">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                            </path>
                                        </svg>
                                    </span>
                                </span>
                            </label>
                            <input class="hidden" type="file" accept="image/*" name="photo" id="photo"
                                data-preview="photo-preview">


                        </div>


                        <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                            <button type="submit"
                                class="bg-purple-500 px-2 py-1 rounded-full hover:scale-110 transition-all">Save
                                Changes </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection

