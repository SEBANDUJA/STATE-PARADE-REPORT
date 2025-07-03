@extends('layouts.admin')

@section('title', 'Basic Firemanship Report')

@section('content')
    <div x-data="studentForm()" class="container mx-auto px-4 py-8 relative min-h-screen z-20">

    <!-- Filter -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <span class="text-xl font-semibold uppercase">Basic firemanship student list</span>
            <div class="flex flex-wrap gap-4 items-center">
                <input type="text" placeholder="Search by name"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    x-model="searchName">
                <input type="text" placeholder="Search by Company Number"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    x-model="searchCompany">
            </div>
        </div>

        <!-- Add Student Button -->
        <div class="flex justify-end mb-4">
            <button @click="openAddForm()"
                class="h-10 px-4 bg-orange-500 rounded-md text-white uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition">
                <i class="fas fa-user-plus text-sm"></i>
                Add Student
            </button>
        </div>

        <!-- Modal -->
        <div x-show="showForm" x-transition @click.away="closeForm()" class="fixed inset-0 flex items-center justify-center z-50 bg-black/30">
            <div @click.stop class="bg-white border border-gray-300 shadow-lg p-6 rounded-md w-full max-w-2xl">
                <h2 class="text-lg font-semibold mb-4" x-text="formMode === 'add' ? 'Add Student' : 'Edit Student'"></h2>
                <form :action="formMode === 'add' ? '{{ route('students.store') }}' : '{{ route('students.update', '__ID__') }}'.replace('__ID__', student.id)" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <template x-if="formMode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-sm font-medium">Student Name</label>
                        <input type="text" name="name" x-model="student.name" required class="mt-1 w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Gender</label>
                        <select name="gender" x-model="student.gender" required class="mt-1 w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                            <option value="" disabled>Select Gender</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Company Name</label>
                        <select name="company" x-model="student.company" required class="mt-1 w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                            <option value="" disabled>Select Company</option>
                            <option value="A">A - COY</option>
                            <option value="B">B - COY</option>
                            <option value="C">C - COY</option>
                            <option value="D">D - COY</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Company Number</label>
                        <input type="text" name="company_no" x-model="student.s_id" required class="mt-1 w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Upload Student Photo</label>
                        <input type="file" name="photo" class="mt-1 w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Attendance checkboxes (only edit) -->
                    <fieldset x-show="formMode === 'edit'" class="mt-4 border p-4 rounded space-y-2">
                        <legend class="font-semibold">Attendance Status</legend>
                        <template x-for="(field, label) in attendanceLabels" :key="field">
                            <label class="inline-flex items-center mr-4">
                                <input type="checkbox" :name="field" x-model="student[field]" class="form-checkbox">
                                <span class="ml-2" x-text="label"></span>
                            </label>
                        </template>
                    </fieldset>

                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" @click="closeForm()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white rounded shadow">
                <thead class="bg-gray-100 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">SN</th>
                        <th class="px-4 py-3">Photo</th>
                        <th class="px-4 py-3">Company No</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Company</th>
                        <th class="px-4 py-3">Absent</th>
                        <th class="px-4 py-3">Ed</th>
                        <th class="px-4 py-3">Ld</th>
                        <th class="px-4 py-3">Sick In</th>
                        <th class="px-4 py-3">Sick Out</th>
                        <th class="px-4 py-3">Permission</th>
                        <th class="px-4 py-3">Centry</th>
                        <th class="px-4 py-3">Special Duty</th>
                        <th class="px-4 py-3">Pass</th>
                        <th class="px-4 py-3">Guard</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-center">null</td>
                        <td class="px-4 py-2 text-center">{{ $student->s_id }}</td>
                        <td class="px-4 py-2">{{ $student->name }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->gender }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->company }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->absent }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->ed }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->ld }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->sick_in }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->sick_out }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->permission }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->centry }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->special_duty }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->pass }}</td>
                        <td class="px-4 py-2 text-center">{{ $student->guard }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <button @click.prevent="openEditForm(@json([$student]))"
                                class="px-3 h-8 bg-gray-500 text-white text-xs rounded hover:bg-blue-600 flex items-center gap-2">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 h-8 bg-red-500 text-white text-xs rounded hover:bg-red-600 flex items-center gap-2">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
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
            formMode: 'add',
            searchName: '',
            searchCompany: '',
            student: {
                id: null, name: '', gender: '', s_id: '', company: '',
                absent: false, ed: false, sick_in: false, sick_out: false, ld: false,
                permission: false, centry: false, special_duty: false, pass: false, guard: false
            },
            attendanceLabels: {
                absent: 'Absent', ed: 'ED', ld: 'LD', sick_in: 'Sick In', sick_out: 'Sick Out',
                permission: 'Permission', centry: 'Centry', special_duty: 'Special Duty', pass: 'Pass', guard: 'Guard'
            },
            initForm() {},
            openAddForm() {
                this.formMode = 'add';
                concole.log('inaedit'); 
                this.student = {id: null, name: '', gender: '', s_id: '', company: '', absent: false, ed: false, sick_in: false, sick_out: false, ld: false, permission: false, centry: false, special_duty: false, pass: false, guard: false};
                this.showForm = true;t
            },
            openEditForm(data) {
                this.formMode = 'edit';
                concole.log('inaedit');
                this.student = {...data};
                this.showForm = true;
            },
            closeForm() { this.showForm = false; }
        }
    }
    </script>
@endsection
