@extends('layouts.admin')

@section('title', 'My Profile')
@section('page_title', 'My Profile')

@section('content')
    <section class="w-full">
        <div class="grid grid-cols-4 justify-items-center items-start w-full gap-4">

            <!-- image side (1/4 width) -->
            <div class="bg-gray-50 col-span-1 w-full p-4 shadow-md">
                <span class="block text-lg font-bold text-center mb-4">Profile Management</span>
                <div class="mb-4 flex justify-center items-center">
                    @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" class="rounded-full h-20 w-20 object-cover">
                                    @else
                                    <!-- Default avatar - you can use any placeholder image -->
                                     <img src="{{ asset('images/wildfire.jpg') }}" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                     @endif
                </div>
                <div class="mt-8 mb-4 text-start">
                    <label for="upload_Photo" class="block text-md">Change Photo</label>
                    <input type="file" class="w-full h-10 text-center shadow-md bg-white rounded-md" placeholder="Upload Photo"  />
                </div>

                <!-- form -->
                <form>
                    <div class="mb-2">
                        <label for="old_Password" class="block text-sm">Old Password</label>
                        <input type="password" name="Old_Password" placeholder="......." class="w-full border p-1 rounded" />
                    </div>
                    <div class="mb-2">
                        <label for="new_Password" class="block text-sm">New Password</label>
                        <input type="password" name="new_Password" placeholder="......." class="w-full border p-1 rounded" />
                    </div>
                    <div class="mt-2">
                        <button class="w-full h-8 text-center shadow-md bg-white">Change Password</button>
                    </div>
                </form>
            </div>

            <!-- personal (3/4 width) -->
            <div class="bg-gray-50 col-span-3 w-full p-4 shadow-md">
                <span class="block text-lg font-bold mb-4">Personal Information</span>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="block text-sm font-semibold">Username</span>
                        {{ Auth::user()->username }}

                    </div>
                    <div>
                        <span class="block text-sm font-semibold">Full Name</span>
                        {{ Auth::user()->name }}
                    </div>
                    <div>
                        <span class="block text-sm font-semibold">LastName</span>
                        Cavain
                    </div>
                    <div>
                        <span class="block text-sm font-semibold">Nickname</span>
                        CodeZero
                    </div>
                    <div>
                        <span class="block text-sm font-semibold">Role</span>
                        {{ Auth::user()->role }}
                    </div>
                    <div>
                        <span class="block text-sm font-semibold">Display Name Public as</span>
                        CavainCoder
                    </div>
                </div>

                <!-- contact info -->
                <div>
                    <span class="block text-lg font-bold mb-2">Contact Info</span>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="block text-sm font-semibold">Email</span>
                            {{ Auth::user()->email }}
                        </div>
                        <div>
                            <span class="block text-sm font-semibold">Phone Number</span>
                            +255717416853
                        </div>
                        <div>
                            <span class="block text-sm font-semibold">Telegram</span>
                            Paul-Cavain/telegram.com
                        </div>
                        <div>
                            <span class="block text-sm font-semibold">Website</span>
                            Paul-Cavain/myportfolio.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div>Not</div>
    </section>
@endsection