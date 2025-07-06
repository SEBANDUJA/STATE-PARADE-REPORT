@extends('layouts.admin')

@section('title', 'Basic Firemanship Report')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div x-data="studentForm()" class="container mx-auto px-4 py-8 relative min-h-screen">

    <!-- Add Student Button -->
    <div class="flex justify-end items-center mb-4">
        <button @click="openAddForm()" class="h-10 px-4 bg-orange-500 rounded-md text-white uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition-all duration-500 ease-in cursor-pointer">
            <i class="fas fa-user-plus text-sm"></i>
            Add Student
        </button>
    </div>

    <!-- Add / Edit Form Modal -->
    <div x-show="showForm" x-transition @click.away="closeForm()" class="fixed inset-0 flex items-center justify-center z-50 pointer-events-auto" style="background: transparent;">
        <div class="bg-white border border-gray-300 shadow-lg p-6 rounded-md w-full max-w-2xl" @click.stop>
            <h2 class="text-lg font-semibold mb-4" x-text="formMode === 'add' ? 'Add Student' : 'Edit Student'"></h2>

            <form x-ref="form" method="POST" enctype="multipart/form-data" class="space-y-4" @submit.prevent="submitForm">
                @csrf
                <template x-if="formMode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <!-- Student Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Student Name</label>
                    <input type="text" name="s_name" x-model="student.name" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" x-model="student.gender" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                        <option value="OTHER">Other</option>
                    </select>
                </div>

                <!-- Company -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company</label>
                    <select name="company" x-model="student.company" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled>Select Company</option>
                        <option value="A">A - COY</option>
                        <option value="B">B - COY</option>
                        <option value="C">C - COY</option>
                        <option value="D">D - COY</option>
                    </select>
                </div>

                <!-- Company Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company Number</label>
                    <input type="text" name="s_id" x-model="student.s_id" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Photo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" class="w-full border rounded px-3 py-2">
                </div>

                <!-- Boolean Checkboxes -->
                <div class="relative border-2 border-gray-400 rounded-md px-3 pt-6 mt-9 pb-4">
                    <!-- Title that cuts through the border -->
                    <div class="absolute -top-3 left-4 bg-white px-2 text-sm font-bold text-black">
                        Individual Particulars
                    </div>

                    <!-- Checkbox Grid -->
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ([
                            'sick_in' => 'Sick In',
                            'sick_out' => 'Sick Out',
                            'ed' => 'ED',
                            'ld' => 'LD',
                            'absent' => 'Absent',
                            'permission' => 'Permission',
                            'centry' => 'C Entry',
                            'special_duty' => 'Special Duty',
                            'pass' => 'Pass',
                            'guard' => 'Guard'
                        ] as $field => $label)
                            <label class="inline-flex items-center">
                                <input type="hidden" name="{{ $field }}" value="0">
                                <input type="checkbox" name="{{ $field }}" value="1" :checked="student.{{ $field }} == 1" class="form-checkbox size-4">
                                <span class="ml-2 font-semibold">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>


                <!-- Submit Buttons -->
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" @click="closeForm()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Table -->
    <div class="overflow-x-auto mt-8">
        <table class="min-w-full bg-white rounded shadow overflow-hidden">
            <thead class="bg-gray-100">
                <tr class="uppercase text-xs">
                    <th class="px-4 py-3">SN</th>
                    <th class="px-4 py-3">Photo</th>
                    <th class="px-4 py-3">Company No</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Gender</th>
                    <th class="px-4 py-3">Company</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-center">
                        <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/soldier.png') }}" class="rounded-full h-12 w-12 object-cover">
                    </td>
                    <td class="px-4 py-2 text-center">{{ $student->s_id }}</td>
                    <td class="px-4 py-2">{{ $student->name }}</td>
                    <td class="px-4 py-2 text-center">{{ $student->gender }}</td>
                    <td class="px-4 py-2 text-center">{{ $student->company }}</td>
                    <td class="px-4 py-2 flex gap-2 justify-center">
                        <button @click="openEditForm({{ json_encode($student) }})" class="px-3 py-1 bg-blue-500 text-white rounded text-xs">Edit</button>
                        <button @click="deleteStudent({{ $student->id }})" class="px-3 py-1 bg-red-500 text-white rounded text-xs">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $students->links() }}</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function studentForm() {
    return {
        showForm: false,
        formMode: 'add',
        student: {},

        openAddForm() {
            this.formMode = 'add';
            this.student = {
                name: '', gender: '', company: '', s_id: '',
                sick_in: 0, sick_out: 0, ed: 0, ld: 0,
                absent: 0, permission: 0, centry: 0,
                special_duty: 0, pass: 0, guard: 0
            };
            this.showForm = true;
        },

        openEditForm(stud) {
            this.formMode = 'edit';
            this.student = {...stud};
            this.showForm = true;
        },

        closeForm() {
            this.showForm = false;
        },

        submitForm() {
            const form = this.$refs.form;
            const action = this.formMode === 'add'
                ? '{{ route('students.store') }}'
                : `{{ url('/admin/studentbasicfiremanship') }}/${this.student.id}`;
            form.setAttribute('action', action);
            form.submit();
        },

        deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                fetch(`/admin/studentbasicfiremanship/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(res => {
                    if (res.ok) location.reload();
                    else alert("Failed to delete student.");
                });
            }
        }
    }
}
</script>
@endsection
