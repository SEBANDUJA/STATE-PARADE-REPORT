@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Firemanship Report')
@section('page_title', 'Firemanship Report')

@section('content')
<div x-data="studentForm()" class="container mx-auto px-4 py-8 relative min-h-screen">

    <!-- filter -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <!-- First Span -->
        <div>
            <span class="text-xl font-semibold uppercase">In Service student list</span>
        </div>

        <!-- Search Filters -->
        <div class="flex flex-wrap gap-4 items-center">
            <!-- Filter by Name -->
            <input
                type="text"
                placeholder="Search by name"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                x-model="searchName"
            >

            <!-- Filter by Company Number -->
            <input
                type="text"
                placeholder="Search by Company Number"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                x-model="searchCompany"
            >
        </div>
    </div>

    <!-- Add Student Button -->
    <div class="flex justify-end items-center mb-4">
        <button
            @click="openAddForm()"
            class="h-10 px-4 bg-orange-500 rounded-md text-white uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition-all duration-500 ease-in cursor-pointer"
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
            class="bg-white border border-gray-300 shadow-lg p-6 rounded-md w-full max-w-md"
            @click.stop
        >
            <h2 class="text-lg font-semibold mb-4" x-text="formMode === 'add' ? 'Add Student' : 'Edit Student'"></h2>

            <form :action="formMode === 'add' ? '{{ url('/students/store') }}' : `{{ url('/students/update') }}/${student.id}`" method="POST" class="space-y-4">
                @csrf
                <template x-if="formMode === 'edit'">
                    <input type="hidden" name="id" :value="student.id">
                </template>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" x-model="student.name"
                        class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" x-model="student.gender"
                        class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                        <option value="">Select</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" id="age" name="age" x-model="student.age"
                        class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" @click="closeForm()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow overflow-hidden mt-6">
            <thead class="bg-gray-100">
                <tr class="uppercase text-xs">
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">SN</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Company Number</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Sudent Name</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Gender</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Company</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Absent</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Ed</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Ld</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Sick in</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Sick out</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Permission</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Centry</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Special Duty</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Pass</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Guard</th>
                        <th class="px-4 py-5 text-left whitespace-nowrap w-max">Actions</th>
                    </tr>

            </thead>
            
            <tbody>
                <!--<template x-for="(stud, index) in students" :key="stud.id">-->
                @foreach($students as $student)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->s_id }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $student->name }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->gender }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->company }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->absent }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->ed }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->ld }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->sick_in }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->sick_out }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->permission }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->centry }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->special_duty }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->pass }}</td>
                    <td class="px-4 py-2 text-center whitespace-nowrap">{{ $student->guard }}</td>
                    <!-- <td class="px-4 py-2">{{ $student->photo }}</td> -->
                    <td class="px-4 py-2 flex gap-2">
                        <button
                            @click="openEditForm({{ json_encode($student) }})"
                            class="w-fit px-3 h-8 bg-gray-500 text-white text-xs rounded hover:bg-blue-600 uppercase flex items-center gap-2.5 cursor-pointer"
                        >
                            <i class="fas fa-edit text-white text-sm"></i>
                            Edit
                        </button>

                        <button
                            @click="deleteStudent({{ $student->id }})"
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
