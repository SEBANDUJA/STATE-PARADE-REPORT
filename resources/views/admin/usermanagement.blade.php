@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Firemanship Report')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div x-data="userForm()" class="container mx-auto px-4 py-8 relative min-h-screen">
    <h1 class="text-2xl font-bold mb-6">List Of Users</h1>

    <!-- Add User Button -->
    <div class="flex justify-end items-center mb-4">
        <button
            @click="openAddForm()"
            class="h-10 px-4 bg-orange-500 rounded-md text-white uppercase text-xs flex items-center gap-2 hover:border-2 hover:border-orange-600 hover:bg-white hover:text-black transition-all duration-500 ease-in cursor-pointer"
        >
            <i class="fas fa-user-plus text-sm"></i>
            Add user
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
        <div class="bg-white border border-gray-300 shadow-lg p-6 rounded-md w-full max-w-md" @click.stop>
            <h2 class="text-lg font-semibold mb-4" x-text="formMode === 'add' ? 'Add User' : 'Edit User'"></h2>

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

                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" x-model="user.name" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" x-model="user.username" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" x-model="user.gender" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="job_title" x-model="user.job_title" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" x-model="user.role" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled>Select Role</option>
                        <option value="admin">Afande C.O | CI</option>
                        <option value="mto">Afande MTO | CC</option>
                        <option value="hc">Orderly Corporal | Sir Major</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" x-model="user.email" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" x-model="user.password" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" @click="closeForm()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- User Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow overflow-hidden mt-6 whitespace-nowrap">
            <thead class="bg-gray-100">
                <tr class="uppercase text-xs">
                    <th class="px-4 py-3 text-left">SN</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Username</th>
                    <th class="px-4 py-3 text-left">Job Title</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Gender</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user_in as $userItem)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $userItem->name }}</td>
                    <td class="px-4 py-3">{{ $userItem->username }}</td>
                    <td class="px-4 py-3">{{ $userItem->job_title }}</td>
                    <td class="px-4 py-3">{{ $userItem->role }}</td>
                    <td class="px-4 py-3">{{ $userItem->email }}</td>
                    <td class="px-4 py-3">{{ $userItem->gender }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <button @click='openEditForm(@json($userItem))' class="px-3 py-1 bg-blue-500 text-white rounded text-xs">Edit</button>
                        <button @click="deleteUser({{ $userItem->id }})" class="px-3 py-1 bg-red-500 text-white rounded text-xs">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $user_in->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function userForm() {
    return {
        showForm: false,
        formMode: 'add',
        user: {
            id: null,
            name: '',
            username: '',
            gender: '',
            job_title: '',
            role: '',
            email: '',
            password: '',
        },

        openAddForm() {
            this.formMode = 'add';
            this.user = {
                id: null,
                name: '',
                username: '',
                gender: '',
                job_title: '',
                role: '',
                email: '',
                password: '',
            };
            this.showForm = true;
        },

        openEditForm(user) {
            this.formMode = 'edit';
            this.user = { ...user };
            this.showForm = true;
        },

        closeForm() {
            this.showForm = false;
        },
        
        submitForm() {
            const form = this.$refs.form;
            const action = this.formMode === 'add'
            ? '{{ route('user.store') }}'
            : `{{ url('/admin/usermanagement') }}/${this.user.id}`;// ✔️ now matches route
            
            form.setAttribute('action', action);
            form.submit();
        },

        deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch(`/admin/usermanagement/${id}`, {
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
                        alert('Failed to delete user.');
                    }
                })
                .catch(err => {
                    console.error('Error deleting user:', err);
                    alert('Error deleting user.');
                });
            }
        }
    }
}
</script>
@endsection
