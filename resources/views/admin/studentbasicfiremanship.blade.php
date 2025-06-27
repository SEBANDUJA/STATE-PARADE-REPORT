@extends('layouts.admin')

@section('title', 'Basic Firemanship Report')

@section('content')
<div x-data="studentForm()" class="container mx-auto px-4 py-8 relative min-h-screen">

    <h1 class="text-2xl font-bold mb-6">Basic FireManShip Student List</h1>

    <!-- Add Student Button -->
    <div class="flex justify-end items-center mb-4">
        <button
            @click="openAddForm()"
            class="h-10 px-4 bg-orange-500 rounded-md text-white hover:bg-blue-600 transition uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition-all duration-500 ease-in cursor-pointer"
        >
            <i class="fas fa-user-plus text-sm"></i>
            Add Student
        </button>
    </div>


    <!-- Add / Edit Form Modal -->
    <div
        x-show="showForm"
        x-transition
        @click.away="closeForm()"
        class="fixed inset-0 flex items-center justify-center z-50 pointer-events-auto"
        style="background: transparent;"
    >
        <div
            class="bg-white border border-gray-300 shadow-lg p-6 rounded-md w-full max-w-2xl"
            @click.stop
        >
            <h2 class="text-lg font-semibold mb-4" x-text="formMode === 'add' ? 'Add Student' : 'Edit Student'"></h2>

            <form :action="formMode === 'add' ? '{{ url('/students/store') }}' : `{{ url('/students/update') }}/${student.id}`" method="POST" class="space-y-4">
                @csrf
                <template x-if="formMode === 'edit'">
                    <input type="hidden" name="id" :value="student.id">
                </template>

                <!-- Accordion Section for Student Name -->
                <div x-data="{ open: true }" class="border rounded">
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Student Name
                    </button>
                    <div x-show="open" class="p-4">
                        <input type="text" name="name" x-model="student.name"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                <!-- Accordion Section for Student Photo -->
                <div x-data="{ open: true }" class="border rounded">
                    <!-- Accordion Header -->
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Upload Student Photo
                    </button>

                    <!-- Accordion Content -->
                    <div x-show="open" x-transition class="p-4">
                        <input type="file" name="photo"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>


                <!-- Accordion Section for Student Company -->
                <div x-data="{ open: false }" class="border rounded">
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Company Name
                    </button>
                    <div x-show="open" class="p-4">
                        <select name="gender" x-model="student.gender"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option value="">Select</option>
                            <option>A - COY</option>
                            <option>B - COY</option>
                            <option>C - COY</option>
                            <option>D - COY</option>
                        </select>
                    </div>
                </div>

                <!-- Accordion Section for Company Number -->
                <div x-data="{ open: false }" class="border rounded">
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Company Number
                    </button>
                    <div x-show="open" class="p-4">
                        <input type="text" name="company_number" x-model="student.company_number"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                <!-- Accordion Section for Gender -->
                <div x-data="{ open: false }" class="border rounded">
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Gender
                    </button>
                    <div x-show="open" class="p-4">
                        <select name="gender" x-model="student.gender"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <!-- Accordion Section for Age -->
                <div x-data="{ open: false }" class="border rounded">
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Age
                    </button>
                    <div x-show="open" class="p-4">
                        <input type="number" name="age" x-model="student.age"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                <!-- Accordion Section for Nida -->
                <div x-data="{ open: false }" class="border rounded">
                    <button type="button" @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-100 font-semibold">
                        Nida number
                    </button>
                    <div x-show="open" class="p-4">
                        <input type="number" name="age" x-model="student.age"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" @click="closeForm()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Student Table -->
    <table class="min-w-full bg-white rounded shadow overflow-hidden mt-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">SN</th>
                <th class="px-4 py-2 text-left">Photo</th>
                <th class="px-4 py-2 text-left">Company</th>
                <th class="px-4 py-2 text-start">Company number</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Gender</th>
                <!-- <th class="px-4 py-2 text-left">ED</th>
                <th class="px-4 py-2 text-left">LD</th> -->
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!--<template x-for="(stud, index) in students" :key="stud.id">-->
                @foreach($students as $student)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $student->s_id }}</td>
                    <td class="px-4 py-2">{{ $student->company }}</td>
                    <td class="px-4 py-2">{{ $student->s_id }}</td>
                    <td class="px-4 py-2">{{ $student->name }}</td>
                    <td class="px-4 py-2">{{ $student->gender }}</td>
                    <!-- <td class="px-4 py-2">{{ $student->ed }}</td>
                    <td class="px-4 py-2">{{ $student->ld }}</td> -->
                    <td class="px-4 py-2 flex gap-2">
                        <button
                            @click="openEditForm(stud)"
                            class="w-fit px-3 h-8 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 uppercase flex items-center gap-2.5 cursor-pointer"
                        >
                            <i class="fas fa-edit text-white text-sm"></i>
                            Edit
                        </button>

                        <button
                            @click="deleteStudent(stud.id)"
                            class="w-fit px-3 h-8 bg-red-500 text-white text-xs rounded hover:bg-red-600 uppercase flex items-center gap-2.5 cursor-pointer"
                        >
                            <i class="fas fa-trash text-white text-sm"></i>
                            Delete
                        </button>
                    </td>

                </tr>
                @endforeach
           <!-- </template> -->
        </tbody>
    </table>
</div>

{{-- Pagination Links --}}
<div class="mt-4">
    {{ $students->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
function studentForm() {
    return {
        showForm: false,
        formMode: 'add', // 'add' or 'edit'
        student: {
            id: null,
            name: '',
            gender: '',
            age: '',
        },
        // Mocked students data (replace with actual server data or load via AJAX)
        students: [
            {id: 1, name: 'Alice John', gender: 'Female', age: 25, nida_no: '1234567890', company: 'TechCorp', company_no: '567890'},
            {id: 2, name: 'John Doe', gender: 'Male', age: 30, nida_no: '9876543210', company: 'Innovate Ltd', company_no: '234567'},
        ],

        openAddForm() {
            this.formMode = 'add';
            this.student = {id: null, name: '', gender: '', age: ''};
            this.showForm = true;
        },

        openEditForm(stud) {
            this.formMode = 'edit';
            // Copy selected student data into form model
            this.student = {...stud};
            this.showForm = true;
        },

        closeForm() {
            this.showForm = false;
        },

        deleteStudent(id) {
            if(confirm('Are you sure you want to delete this student?')) {
                this.students = this.students.filter(s => s.id !== id);
            }
        }
    }
}
</script>
@endsection
