@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Parade Report Basicfiremanship')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Parade Report</title>
    @vite('resources/css/app.css') {{-- Vite for Tailwind --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="p-10">

<div x-data="paradeApp()" class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow flex gap-6">

    <!-- Left Column: Company Buttons -->
    <div class="w-1/3 space-y-4">
        <template x-for="company in companies" :key="company.name">
            <button
                @click="selectCompany(company.name)"
                class="w-full px-4 py-2 flex justify-between items-center border rounded-lg font-semibold cursor-pointer"
                :class="{
                    'bg-orange-500 text-white cursor-pointer': selected === company.name,
                    'bg-green-100 cursor-pointer border-green-500 text-green-700': company.submitted,
                    'bg-white  cursor-pointertext-gray-800': !selected === company.name && !company.submitted
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

                    <!-- step 2                     -->
                    <div x-show="step === 2" class="space-y-4"
                        x-data="{
                            form: {
                                sick_out: 0,
                                ed: 0,
                                ld: 0,
                                selectedSickOutNames: [],
                                selectedEdNames: [],
                                selectedLdNames: []
                            },
                            allNames: ['John Doe', 'Jane Smith', 'Alice Brown', 'Bob Johnson', 'Michael Lee'],

                            sickOutQuery: '', sickOutResults: [],
                            edQuery: '', edResults: [],
                            ldQuery: '', ldResults: [],

                            updateSearch(field) {
                                let query = this[field + 'Query'].toLowerCase().trim();
                                if (!query) {
                                    this[field + 'Results'] = [];
                                    return;
                                }
                                const selectedList = this.form['selected' + field.charAt(0).toUpperCase() + field.slice(1) + 'Names'];
                                this[field + 'Results'] = this.allNames.filter(name =>
                                    name.toLowerCase().includes(query) && !selectedList.includes(name)
                                );
                            },

                            selectName(field, name) {
                                const key = 'selected' + field.charAt(0).toUpperCase() + field.slice(1) + 'Names';
                                const limit = this.form[field];
                                if (this.form[key].length < limit) {
                                    this.form[key].push(name);
                                    this[field + 'Query'] = '';
                                    this[field + 'Results'] = [];
                                }
                            },

                            removeName(field, index) {
                                const key = 'selected' + field.charAt(0).toUpperCase() + field.slice(1) + 'Names';
                                this.form[key].splice(index, 1);
                            }
                        }">
                        
                        <!-- SICK OUT -->
                        <div>
                            <label class="block font-semibold">Sick Out (number)</label>
                            <input type="number" x-model.number="form.sick_out"
                                @input="form.selectedSickOutNames = []"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"/>
                        </div>
                        <div x-show="form.sick_out > 0">
                            <label class="block font-semibold">Search Sick Out Name</label>
                            <input type="text" x-model="sickOutQuery"
                                @input="updateSearch('sickOut')"
                                placeholder="Search name..."
                                class="w-full border rounded p-2"/>

                            <ul class="border rounded p-2 mt-2 max-h-40 overflow-y-auto">
                                <template x-for="name in sickOutResults" :key="name">
                                    <li @click="selectName('sickOut', name)" x-text="name"
                                        class="cursor-pointer hover:bg-blue-100 p-1"></li>
                                </template>
                                <li x-show="sickOutResults.length === 0" class="text-gray-400">No matches</li>
                            </ul>

                            <template x-for="(name, index) in form.selectedSickOutNames" :key="index">
                                <div class="flex justify-between items-center bg-red-50 border p-2 mt-2 rounded">
                                    <span x-text="name"></span>
                                    <button @click="removeName('sickOut', index)" type="button"
                                            class="text-red-600 text-sm hover:underline">Remove</button>
                                </div>
                            </template>

                            <!-- Hidden inputs -->
                            <template x-for="name in form.selectedSickOutNames">
                                <input type="hidden" name="sick_out_names[]" :value="name">
                            </template>
                        </div>

                        <!-- ED -->
                        <div>
                            <label class="block font-semibold">ED (number)</label>
                            <input type="number" x-model.number="form.ed"
                                @input="form.selectedEdNames = []"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"/>
                        </div>
                        <div x-show="form.ed > 0">
                            <label class="block font-semibold">Search ED Name</label>
                            <input type="text" x-model="edQuery"
                                @input="updateSearch('ed')"
                                placeholder="Search name..."
                                class="w-full border rounded p-2"/>

                            <ul class="border rounded p-2 mt-2 max-h-40 overflow-y-auto">
                                <template x-for="name in edResults" :key="name">
                                    <li @click="selectName('ed', name)" x-text="name"
                                        class="cursor-pointer hover:bg-blue-100 p-1"></li>
                                </template>
                                <li x-show="edResults.length === 0" class="text-gray-400">No matches</li>
                            </ul>

                            <template x-for="(name, index) in form.selectedEdNames" :key="index">
                                <div class="flex justify-between items-center bg-blue-50 border p-2 mt-2 rounded">
                                    <span x-text="name"></span>
                                    <button @click="removeName('ed', index)" type="button"
                                            class="text-red-600 text-sm hover:underline">Remove</button>
                                </div>
                            </template>

                            <!-- Hidden inputs -->
                            <template x-for="name in form.selectedEdNames">
                                <input type="hidden" name="ed_names[]" :value="name">
                            </template>
                        </div>

                        <!-- LD -->
                        <div>
                            <label class="block font-semibold">LD (number)</label>
                            <input type="number" x-model.number="form.ld"
                                @input="form.selectedLdNames = []"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"/>
                        </div>
                        <div x-show="form.ld > 0">
                            <label class="block font-semibold">Search LD Name</label>
                            <input type="text" x-model="ldQuery"
                                @input="updateSearch('ld')"
                                placeholder="Search name..."
                                class="w-full border rounded p-2"/>

                            <ul class="border rounded p-2 mt-2 max-h-40 overflow-y-auto">
                                <template x-for="name in ldResults" :key="name">
                                    <li @click="selectName('ld', name)" x-text="name"
                                        class="cursor-pointer hover:bg-blue-100 p-1"></li>
                                </template>
                                <li x-show="ldResults.length === 0" class="text-gray-400">No matches</li>
                            </ul>

                            <template x-for="(name, index) in form.selectedLdNames" :key="index">
                                <div class="flex justify-between items-center bg-yellow-50 border p-2 mt-2 rounded">
                                    <span x-text="name"></span>
                                    <button @click="removeName('ld', index)" type="button"
                                            class="text-red-600 text-sm hover:underline">Remove</button>
                                </div>
                            </template>

                            <!-- Hidden inputs -->
                            <template x-for="name in form.selectedLdNames">
                                <input type="hidden" name="ld_names[]" :value="name">
                            </template>
                        </div>
                    </div>


                    <!-- Step 3 -->
                    <div x-show="step === 3" class="space-y-4"
                        x-data="{
                            form: {
                                permission: 0,
                                pass: 0,
                                selectedPermissionNames: [],
                                selectedPassNames: []
                            },
                            allNames: ['John Doe', 'Jane Smith', 'Alice Brown', 'Bob Johnson', 'Michael Lee'],

                            permissionQuery: '', permissionResults: [],
                            passQuery: '', passResults: [],

                            updateSearch(field) {
                                let query = this[field + 'Query'].toLowerCase().trim();
                                if (!query) {
                                    this[field + 'Results'] = [];
                                    return;
                                }
                                const selectedList = this.form['selected' + field.charAt(0).toUpperCase() + field.slice(1) + 'Names'];
                                this[field + 'Results'] = this.allNames.filter(name =>
                                    name.toLowerCase().includes(query) && !selectedList.includes(name)
                                );
                            },

                            selectName(field, name) {
                                const key = 'selected' + field.charAt(0).toUpperCase() + field.slice(1) + 'Names';
                                const limit = this.form[field];
                                if (this.form[key].length < limit) {
                                    this.form[key].push(name);
                                    this[field + 'Query'] = '';
                                    this[field + 'Results'] = [];
                                }
                            },

                            removeName(field, index) {
                                const key = 'selected' + field.charAt(0).toUpperCase() + field.slice(1) + 'Names';
                                this.form[key].splice(index, 1);
                            }
                        }">

                        <!-- Permission -->
                        <div>
                            <label class="block font-semibold">Permission (number)</label>
                            <input type="number" x-model.number="form.permission"
                                @input="form.selectedPermissionNames = []"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"/>
                        </div>
                        <div x-show="form.permission > 0">
                            <label class="block font-semibold">Search Permission Name</label>
                            <input type="text" x-model="permissionQuery"
                                @input="updateSearch('permission')"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"
                                placeholder="Search a name..."/>

                            <ul class="border rounded p-2 mt-2 max-h-40 overflow-y-auto">
                                <template x-for="name in permissionResults" :key="name">
                                    <li @click="selectName('permission', name)" x-text="name"
                                        class="cursor-pointer hover:bg-blue-100 p-1"></li>
                                </template>
                                <li x-show="permissionResults.length === 0" class="text-gray-400">No matches</li>
                            </ul>

                            <template x-for="(name, index) in form.selectedPermissionNames" :key="index">
                                <div class="flex justify-between items-center bg-purple-50 border p-2 mt-2 rounded">
                                    <span x-text="name"></span>
                                    <button @click="removeName('permission', index)" type="button"
                                            class="text-red-600 text-sm hover:underline">Remove</button>
                                </div>
                            </template>

                            <!-- Hidden Inputs -->
                            <template x-for="name in form.selectedPermissionNames">
                                <input type="hidden" name="permission_names[]" :value="name">
                            </template>
                        </div>

                        <!-- Pass -->
                        <div>
                            <label class="block font-semibold">Pass (number)</label>
                            <input type="number" x-model.number="form.pass"
                                @input="form.selectedPassNames = []"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"/>
                        </div>
                        <div x-show="form.pass > 0">
                            <label class="block font-semibold">Search Pass Name</label>
                            <input type="text" x-model="passQuery"
                                @input="updateSearch('pass')"
                                class="w-full border rounded p-2 focus:outline-none focus:ring"
                                placeholder="Search a name..."/>

                            <ul class="border rounded p-2 mt-2 max-h-40 overflow-y-auto">
                                <template x-for="name in passResults" :key="name">
                                    <li @click="selectName('pass', name)" x-text="name"
                                        class="cursor-pointer hover:bg-blue-100 p-1"></li>
                                </template>
                                <li x-show="passResults.length === 0" class="text-gray-400">No matches</li>
                            </ul>

                            <template x-for="(name, index) in form.selectedPassNames" :key="index">
                                <div class="flex justify-between items-center bg-indigo-50 border p-2 mt-2 rounded">
                                    <span x-text="name"></span>
                                    <button @click="removeName('pass', index)" type="button"
                                            class="text-red-600 text-sm hover:underline">Remove</button>
                                </div>
                            </template>

                            <!-- Hidden Inputs -->
                            <template x-for="name in form.selectedPassNames">
                                <input type="hidden" name="pass_names[]" :value="name">
                            </template>
                        </div>

                        <!-- Total (manual input, not by name) -->
                        <div>
                            <label class="block font-semibold">Total</label>
                            <input type="text" name="total" x-model="form.total"
                                class="w-full border rounded p-2 focus:outline-none focus:ring" />
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-6 flex justify-between">

                        <!-- Previous Button: Shown only in Step 2 and Step 3 -->
                        <button
                            x-show="step > 1"
                            @click="step--"
                            type="button"
                            class="bg-orange-600 text-white px-4 w-fit h-10 cursor-pointer rounded hover:bg-white hover:border-2 hover:border-orange-500 hover:text-black transition">
                            <i class="fas fa-chevron-left px-2"></i>
                            Previous
                        </button>

                        <div class="flex gap-4 ml-auto">
                            <!-- Next Button: Show on Step 1 and 2 -->
                            <button
                                x-show="step < 3"
                                @click="step++"
                                type="button"
                                class="bg-orange-600 text-white px-4 w-fit h-10 cursor-pointer rounded hover:bg-white hover:border-2 hover:border-orange-500 hover:text-black transition">
                                Next
                                <i class="fas fa-chevron-right px-2"></i>
                            </button>

                            <!-- Save Statement: Only visible on Step 3 -->
                            <button
                                x-show="step === 3"
                                type="submit"
                                class="bg-white text-black px-4 py-2 rounded border-2 border-orange-500 hover:bg-orange-500 transition-all ease-out duration-500 hover:text-white cursor-pointer">
                                <i class="fas fa-save"></i>
                                Save Statement
                            </button>
                        </div>
                    </div>

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
            { name: 'A - COY', submitted: false },
            { name: 'B - COY', submitted: false },
            { name: 'C - COY', submitted: false },
            { name: 'D - COY', submitted: false },
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
