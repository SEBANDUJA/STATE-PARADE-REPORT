@extends('layouts.admin')

@section('title', 'Firemanship Report')

@section('content')
<div class="mx-auto px-4 py-8 min-h-screen w-full">
        <form method="POST" action="#" class="bg-white p-8 rounded shadow-md w-full max-w-full"
          x-data="{ step: 1, form: { name: '', email: '', phone: '', age: '', message: '' } }">

        @csrf
        <div class="grid grid-cols-3 gap-x-8">
            <!-- Step 1: Name -->
            <div x-show="step === 1" class="mb-4">
                <label class="block mb-1 font-semibold hidden">Present</label>
                <input type="text" name="number" x-model="form.name" @input="step = form.name ? 2 : 1"
                    class="w-full border rounded p-2 focus:outline-none focus:ring focus:outline-none" placeholder="present">
            </div>

            <!-- Step 2: Email -->
            <div x-show="step >= 2" class="mb-4 transition-all duration-300">
                <label class="block mb-1 font-semibold hidden">Absent</label>
                <input type="email" name="email" x-model="form.email" @input="step = form.email ? 3 : 2"
                    class="w-full border rounded p-2 focus:outline-none focus:ring focus:outline-none" placeholder="">
            </div>
            <!-- Step 3: Phone -->
            <div x-show="step >= 3" class="mb-4">
                <label class="block mb-1 font-semibold hidden">Sick In</label>
                <input type="text" name="phone" x-model="form.phone" @input="step = form.phone ? 4 : 3"
                    class="w-full border rounded p-2 focus:outline-none focus:ring focus:outline-none" placeholder="">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-x-8">
            <!-- Step 1: Name -->
            <div x-show="step === 1" class="mb-4">
                <label class="block mb-1 font-semibold">Sick Out</label>
                <input type="text" name="name" x-model="form.name" @input="step = form.name ? 2 : 1"
                    class="w-full border rounded p-2 focus:outline-none focus:ring">
            </div>

            <!-- Step 2: Email -->
            <div x-show="step >= 2" class="mb-4 transition-all duration-300">
                <label class="block mb-1 font-semibold">ED</label>
                <input type="email" name="email" x-model="form.email" @input="step = form.email ? 3 : 2"
                    class="w-full border rounded p-2 focus:outline-none focus:ring">
            </div>
            <!-- Step 3: Phone -->
            <div x-show="step >= 3" class="mb-4">
                <label class="block mb-1 font-semibold">LD</label>
                <input type="text" name="phone" x-model="form.phone" @input="step = form.phone ? 4 : 3"
                    class="w-full border rounded p-2 focus:outline-none focus:ring">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-x-8">
            <!-- Step 1: Name -->
            <div x-show="step === 1" class="mb-4">
                <label class="block mb-1 font-semibold">PERMISSION</label>
                <input type="text" name="name" x-model="form.name" @input="step = form.name ? 2 : 1"
                    class="w-full border rounded p-2 focus:outline-none focus:ring">
            </div>

            <!-- Step 2: Email -->
            <div x-show="step >= 2" class="mb-4 transition-all duration-300">
                <label class="block mb-1 font-semibold">PASS</label>
                <input type="email" name="email" x-model="form.email" @input="step = form.email ? 3 : 2"
                    class="w-full border rounded p-2 focus:outline-none focus:ring">
            </div>
            <!-- Step 3: Phone -->
            <div x-show="step >= 3" class="mb-4">
                <label class="block mb-1 font-semibold">TOTAL</label>
                <input type="text" name="phone" x-model="form.phone" @input="step = form.phone ? 4 : 3"
                    class="w-full border rounded p-2 focus:outline-none focus:ring">
            </div>
        </div>

        <div x-show="step >= 5" class="mt-4">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Submit
            </button>
        </div>
    </form>
</div>

@endsection
