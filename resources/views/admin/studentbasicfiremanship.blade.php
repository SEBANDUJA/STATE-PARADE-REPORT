@extends('layouts.admin')

@section('title', 'Basic Firemanship Report')
@section('page_title', 'Basic Firemanship Report')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div x-data="studentForm()" class="container mx-auto px-4 py-8 relative min-h-screen">

    <!-- Add Student Button -->
    <!-- <div class="flex justify-end items-center mb-4">
        <button
            @click="openAddForm()"
            class="h-10 px-4 bg-orange-500 rounded-md text-white uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition-all duration-500 ease-in cursor-pointer"
        >
            <i class="fas fa-user-plus text-sm"></i>
            Add Student
        </button>
    </div> -->

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

            <form
                x-ref="form"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4"
                @submit.prevent="submitForm"
            >
                @csrf
                <template x-if="formMode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <!-- Student Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Student Name</label>
                    <input type="text" id="s_name" name="s_name" x-model="student.name"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" x-model="student.gender"
                        class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                        <option value="OTHER">Other</option>
                    </select>
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                    <select id="company" name="company" x-model="student.company"
                        class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled>Select Company</option>
                        <option value="A">A - COY</option>
                        <option value="B">B - COY</option>
                        <option value="C">C - COY</option>
                        <option value="D">D - COY</option>
                    </select>
                </div>

                <!-- Company Number -->
                <div>
                    <label for="s_id" class="block text-sm font-medium text-gray-700">Company Number</label>
                    <input type="text" id="s_id" name="s_id" x-model="student.s_id"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" id="photo" class="w-full border rounded px-3 py-2">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" @click="closeForm()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

<div 
    x-data="{
        allStudents: {{ $allStudents->toJson() }},
        search: '',
        sortBy: '',
        page: 1,
        perPage: 50,
        get filteredStudents() {
            let result = this.allStudents;
            if (this.search.trim() !== '') {
                result = result.filter(s =>
                    s.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    s.s_id.toLowerCase().includes(this.search.toLowerCase())
                );
            }
            if (this.sortBy !== '') {
                result = result.slice().sort((a, b) => {
                    if (a[this.sortBy] < b[this.sortBy]) return -1;
                    if (a[this.sortBy] > b[this.sortBy]) return 1;
                    return 0;
                });
            }
            return result;
        },
        get paginatedStudents() {
            const start = (this.page - 1) * this.perPage;
            return this.filteredStudents.slice(start, start + this.perPage);
        },
        totalPages() {
            return Math.ceil(this.filteredStudents.length / this.perPage);
        }
    }"
    class="container mx-auto px-4 py-8"
    >
    <!-- Add Student Button -->

    <!-- Filter & Sort Controls -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-x-4 mb-4">
        <div class="flex flex-row gap-x-3 justify-start items-center w-3/4">
            <div class="w-1/2">
                <input
                    type="text"
                    placeholder="Search by name or company number..."
                    x-model="search"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                >
            </div>

            <div class="w-1/2">
                <select
                    x-model="sortBy"
                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                >
                    <option value="">Sort by</option>
                    <option value="name">Name</option>
                    <option value="company">Company</option>
                    <option value="gender">Gender</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end items-center w-1/4">
            <button
                @click="openAddForm()"
                class="h-10 px-4 bg-orange-500 rounded-md text-white uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition-all duration-500 ease-in cursor-pointer"
            >
                <i class="fas fa-user-plus text-sm"></i>
                Add Student
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto border rounded shadow">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 sticky top-0 z-10">
                <tr class="uppercase text-xs flex w-full">
                    <th class="px-4 py-3 w-12 flex-none text-center">SN</th>
                    <th class="px-4 py-3 w-32 flex-none text-center">Company No</th>
                    <th class="px-4 py-3 flex-1 text-center">Name</th>
                    <th class="px-4 py-3 w-24 flex-none text-center">Gender</th>
                    <th class="px-4 py-3 w-32 flex-none text-center">Company</th>
                    <th class="px-4 py-3 w-36 flex-none text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="block max-h-[400px] overflow-y-auto">
                <template x-for="(student, index) in paginatedStudents" :key="student.id">
                    <tr class="border-b hover:bg-gray-50 flex w-full">
                        <td class="px-4 py-3 w-12 flex-none text-center" x-text="index + 1 + ((page - 1) * perPage)"></td>
                        <td class="px-4 py-3 w-32 flex-none text-center" x-text="student.s_id"></td>
                        <td class="px-4 py-3 flex-1 text-center" x-text="student.name"></td>
                        <td class="px-4 py-3 w-24 flex-none text-center" x-text="student.gender"></td>
                        <td class="px-4 py-3 w-32 flex-none text-center" x-text="student.company"></td>
                        <td class="px-4 py-3 w-36 flex-none flex gap-2 justify-center">
                            <button
                                @click="openEditForm(student)"
                                class="px-3 py-1 bg-blue-500 text-white rounded text-xs"
                            >
                                Edit
                            </button>
                            <button
                                @click="deleteStudent(student.id)"
                                class="px-3 py-1 bg-red-500 text-white rounded text-xs"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end gap-2 mt-4">
        <button 
            @click="page = Math.max(page - 1, 1)" 
            :disabled="page === 1"
            class="px-2 py-1 border rounded disabled:opacity-50"
        >Prev</button>

        <template x-for="n in totalPages()" :key="n">
            <button 
                @click="page = n"
                :class="{'bg-orange-500 text-white': page === n, 'border': page !== n}"
                class="px-2 py-1 rounded"
                x-text="n"
            ></button>
        </template>

        <button 
            @click="page = Math.min(page + 1, totalPages())" 
            :disabled="page === totalPages()"
            class="px-2 py-1 border rounded disabled:opacity-50"
        >Next</button>
    </div>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function studentForm() {
    return {
        showForm: false,
        formMode: 'add',
        student: {
            id: null,
            name: '',
            gender: '',
            company: '',
            s_id: '',
        },

        openAddForm() {
            this.formMode = 'add';
            this.student = { id: null, name: '', gender: '', company: '', s_id: '' };
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    if (res.ok) {
                        location.reload();
                    } else {
                        alert("Failed to delete student.");
                    }
                })
                .catch(err => {
                    alert("Error deleting student.");
                    console.error(err);
                });
            }
        }
    }
}
</script>
@endsection
