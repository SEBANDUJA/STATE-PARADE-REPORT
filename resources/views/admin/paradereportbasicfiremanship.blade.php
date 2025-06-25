@extends('layouts.admin')

@section('title', 'Parade Report Basicfiremanship')

@section('content')
    <!-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Company Step Forms</title>
        @vite('resources/css/app.css') {{-- Laravel Vite --}}
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body class="bg-gray-100 p-10">

        <div x-data="{ step: 1 }" class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">

            
            <div class="flex justify-between mb-6">
                <template x-for="s in 4" :key="s">
                    <button @click="step = s" 
                            class="px-4 py-2 rounded font-semibold"
                            :class="step === s ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'">
                        <span x-text="'Step ' + s"></span>
                    </button>
                </template>
            </div>

            
            <div x-show="step === 1">
                <h2 class="text-xl font-bold mb-4">A Coy Form</h2>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="company" value="A Coy">
                    <input type="text" name="name" placeholder="Name" class="input" required>
                    <input type="number" name="staff" placeholder="Number of Staff" class="input mt-2" required>
                    <button class="btn-primary mt-4">Submit A Coy</button>
                </form>
            </div>

            <div x-show="step === 2">
                <h2 class="text-xl font-bold mb-4">B Coy Form</h2>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="company" value="B Coy">
                    <input type="text" name="name" placeholder="Name" class="input" required>
                    <input type="number" name="staff" placeholder="Number of Staff" class="input mt-2" required>
                    <button class="btn-primary mt-4">Submit B Coy</button>
                </form>
            </div>

            <div x-show="step === 3">
                <h2 class="text-xl font-bold mb-4">C Coy Form</h2>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="company" value="C Coy">
                    <input type="text" name="name" placeholder="Name" class="input" required>
                    <input type="number" name="staff" placeholder="Number of Staff" class="input mt-2" required>
                    <button class="btn-primary mt-4">Submit C Coy</button>
                </form>
            </div>

            <div x-show="step === 4">
                <h2 class="text-xl font-bold mb-4">D Coy Form</h2>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="company" value="D Coy">
                    <input type="text" name="name" placeholder="Name" class="input" required>
                    <input type="number" name="staff" placeholder="Number of Staff" class="input mt-2" required>
                    <button class="btn-primary mt-4">Submit D Coy</button>
                </form>
            </div>

        </div>

    </body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Parade Report</title>
    @vite('resources/css/app.css') {{-- Vite for Tailwind --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 p-10">

<div x-data="paradeApp()" class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow flex gap-6">

    <!-- Left Column: Company Buttons -->
    <div class="w-1/3 space-y-4">
        <template x-for="company in companies" :key="company.name">
            <button
                @click="selectCompany(company.name)"
                class="w-full px-4 py-2 flex justify-between items-center border rounded-lg font-semibold"
                :class="{
                    'bg-blue-600 text-white': selected === company.name,
                    'bg-green-100 border-green-500 text-green-700': company.submitted,
                    'bg-white text-gray-800': !selected === company.name && !company.submitted
                }"
            >
                <span x-text="company.name"></span>
                <span x-show="company.submitted" class="text-green-600 font-bold text-xl">✓</span>
            </button>
        </template>
    </div>

    <!-- Right Column: Parade Form -->
    <div class="w-2/3">
        <template x-if="selected">
            <div>
                <h2 class="text-xl font-bold mb-4" x-text="'Parade Statement - ' + selected"></h2>
                <form @submit.prevent="submitForm" method="POST" action="#" 
                    class="bg-white p-8 rounded shadow-md w-full max-w-3xl mx-auto"
                    x-data="{
                        step: 1,
                        form: {
                            present: '', absent: '', sick_in: '',
                            sick_out: '', ed: '', ld: '',
                            permission: '', pass: '', total: ''
                        }
                    }">
                    @csrf

                    <!-- Step 1 -->
                    <div x-show="step === 1" class="space-y-4"
                       x-data="{
                            form: {
                                present: '',
                                absent: 0,
                                sick_in: 0,
                                selectedAbsentNames: [],
                                selectedSickInNames: []
                            },
                            allNames: ['John Doe', 'Jane Smith', 'Alice Brown', 'Bob Johnson', 'Michael Lee'],
                            searchResults: [],
                            sickSearchResults: [],
                            searchQuery: '',
                            sickSearchQuery: '',

                            updateSearch() {
                                if (this.searchQuery.trim() === '') {
                                    this.searchResults = [];
                                    return;
                                }
                                this.searchResults = this.allNames
                                    .filter(name =>
                                        name.toLowerCase().includes(this.searchQuery.toLowerCase()) &&
                                        !this.form.selectedAbsentNames.includes(name)
                                    );
                            },

                            updateSickSearch() {
                                if (this.sickSearchQuery.trim() === '') {
                                    this.sickSearchResults = [];
                                    return;
                                }
                                this.sickSearchResults = this.allNames
                                    .filter(name =>
                                        name.toLowerCase().includes(this.sickSearchQuery.toLowerCase()) &&
                                        !this.form.selectedSickInNames.includes(name)
                                    );
                            },

                            selectName(name) {
                                if (this.form.selectedAbsentNames.length < this.form.absent) {
                                    this.form.selectedAbsentNames.push(name);
                                    this.searchQuery = '';
                                    this.searchResults = [];
                                }
                            },

                            selectSickName(name) {
                                if (this.form.selectedSickInNames.length < this.form.sick_in) {
                                    this.form.selectedSickInNames.push(name);
                                    this.sickSearchQuery = '';
                                    this.sickSearchResults = [];
                                }
                            },

                            removeName(index) {
                                this.form.selectedAbsentNames.splice(index, 1);
                            },

                            removeSickName(index) {
                                this.form.selectedSickInNames.splice(index, 1);
                            }
                        }">

                        <!-- Present -->
                        <div>
                            <label class="block font-semibold">Present</label>
                            <input type="number" name="present" x-model="form.present"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>

                        <!-- Absent -->
                        <div>
                            <label class="block font-semibold">Absent (number)</label>
                            <input type="number" name="absent" x-model.number="form.absent"
                                @input="searchQuery = ''; form.selectedAbsentNames = []; updateSearch()"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>

                        <!-- Search Absent Name -->
                        <div x-show="form.absent > 0">
                            <label class="block font-semibold">Search Absent Name</label>
                            <input type="text"
                                x-model="searchQuery"
                                @input="updateSearch"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"
                                placeholder="Search a name..." />

                            <ul class="mt-2 border rounded p-2 bg-white shadow max-h-40 overflow-y-auto">
                                <template x-for="(result, index) in searchResults" :key="index">
                                    <li @click="selectName(result)"
                                        class="py-1 px-2 hover:bg-blue-100 cursor-pointer"
                                        x-text="result">
                                    </li>
                                </template>
                                <li x-show="searchResults.length === 0" class="text-gray-500">No match found</li>
                            </ul>

                            <!-- Show selected absent names -->
                            <div x-show="form.selectedAbsentNames.length" class="mt-4 space-y-2">
                                <template x-for="(name, index) in form.selectedAbsentNames" :key="index">
                                    <div class="flex items-center justify-between bg-green-50 border border-green-400 p-2 rounded">
                                        <span x-text="name" class="text-green-700 font-semibold"></span>
                                        <button type="button" @click="removeName(index)"
                                                class="text-red-500 hover:underline text-sm">Remove</button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Send selected absent names as hidden inputs -->
                        <template x-for="(name, index) in form.selectedAbsentNames" :key="index">
                            <input type="hidden" name="absent_names[]" :value="name">
                        </template>

                        <!-- Sick In -->
                          <div>
                            <label class="block font-semibold">Sick In (number)</label>
                            <input type="number" name="absent" x-model.number="form.sick_in"
                                @input="searchQuery = ''; form.selectedSickNames = []; updateSearch()"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                        <!-- Sick In Search and Selection -->
                        <div x-show="form.sick_in > 0">
                            <label class="block font-semibold">Search Sick In Name</label>
                            <input type="text"
                                x-model="sickSearchQuery"
                                @input="updateSickSearch"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"
                                placeholder="Search a name..." />

                            <ul class="mt-2 border rounded p-2 bg-white shadow max-h-40 overflow-y-auto">
                                <template x-for="(result, index) in sickSearchResults" :key="index">
                                    <li @click="selectSickName(result)"
                                        class="py-1 px-2 hover:bg-blue-100 cursor-pointer"
                                        x-text="result">
                                    </li>
                                </template>
                                <li x-show="sickSearchResults.length === 0" class="text-gray-500">No match found</li>
                            </ul>

                            <!-- Show selected sick in names -->
                            <div x-show="form.selectedSickInNames.length" class="mt-4 space-y-2">
                                <template x-for="(name, index) in form.selectedSickInNames" :key="index">
                                    <div class="flex items-center justify-between bg-yellow-50 border border-yellow-400 p-2 rounded">
                                        <span x-text="name" class="text-yellow-700 font-semibold"></span>
                                        <button type="button" @click="removeSickName(index)"
                                                class="text-red-500 hover:underline text-sm">Remove</button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Send selected sick in names as hidden inputs -->
                        <template x-for="(name, index) in form.selectedSickInNames" :key="index">
                            <input type="hidden" name="sick_in_names[]" :value="name">
                        </template>

                    </div>

                    <!-- Step 2 -->
                    <div x-show="step === 2" class="space-y-4">
                        <div>
                            <label class="block font-semibold">Sick Out</label>
                            <input type="text" name="sick_out" x-model="form.sick_out"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                        <div>
                            <label class="block font-semibold">ED</label>
                            <input type="text" name="ed" x-model="form.ed"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                        <div>
                            <label class="block font-semibold">LD</label>
                            <input type="text" name="ld" x-model="form.ld"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div x-show="step === 3" class="space-y-4">
                        <div>
                            <label class="block font-semibold">Permission</label>
                            <input type="text" name="permission" x-model="form.permission"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                        <div>
                            <label class="block font-semibold">Pass</label>
                            <input type="text" name="pass" x-model="form.pass"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                        <div>
                            <label class="block font-semibold">Total</label>
                            <input type="text" name="total" x-model="form.total"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-6 flex justify-between">
                        <button type="button" @click="step = step > 1 ? step - 1 : 1"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Previous
                        </button>

                        <template x-if="step < 3">
                            <button type="button" @click="step++"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Next
                            </button>
                        </template>

                        <template x-if="step === 3">
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Submit
                            </button>
                        </template>
                    </div>

                    <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save Statement
                    </button>
                </form>
            </div>
        </template>
        <template x-if="!selected">
            <div class="text-gray-500">Select a company to start entering parade statement.</div>
        </template>
    </div>

</div>

<script>
function paradeApp() {
    return {
        selected: null,
        statement: '',
        companies: [
            { name: 'A Coy', submitted: false },
            { name: 'B Coy', submitted: false },
            { name: 'C Coy', submitted: false },
            { name: 'D Coy', submitted: false },
        ],
        selectCompany(name) {
            this.selected = name;
            this.statement = '';
        },
        submitForm() {
            // Here you would use fetch/AJAX or Laravel form submission
            const company = this.companies.find(c => c.name === this.selected);
            if (company) {
                company.submitted = true;
                alert(`Parade statement saved for ${this.selected}`);
                this.selected = null;
                this.statement = '';
            }
        }
    }
}
</script>

</body>
</html>


@endsection
