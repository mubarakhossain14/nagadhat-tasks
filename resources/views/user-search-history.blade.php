<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="bg-white">
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">User Search History</h1>
                <div>
                    <a class="inline-flex justify-center rounded-lg text-sm font-semibold py-2 px-4 bg-slate-900 text-white hover:bg-slate-700" href="{{ route('home') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Home
                    </a>
                    <a target="_blank" class="inline-flex justify-center rounded-lg text-sm font-semibold py-2 px-4 bg-slate-900 text-white hover:bg-slate-700" href="https://github.com/mubarakhossain14/nagadhat-tasks">
                        View in GitHub
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>
                </div>
            </div>

            <section class="pb-24 pt-6">
                <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4"
                     x-data="{
                        selectedKeywords: [],
                        selectedUsers: [],
                        selectedTimeRange: [],
                        startDate: '',
                        endDate: '',
                        filteredResults: {{ $search_histories }}
                    }">
                    <form  @submit.prevent="filterResults">
                        <div class="border-b border-gray-200 py-6">
                            <h3 class="-my-3 flow-root text-gray-900">Keywords</h3>

                            <div class="pt-6" id="filter-section-1">
                                <div class="space-y-4">
                                    @foreach ($searchKeywords as $keyword)
                                        <div class="flex items-center">
                                            <input id="filter-keyword-{{ $keyword->search_keyword }}" x-model="selectedKeywords" value="{{ $keyword->search_keyword }}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-keyword-{{ $keyword->search_keyword }}" class="ml-3 text-sm text-gray-600">{{ $keyword->search_keyword }} ({{ $keyword->keyword_count }} times found)</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 py-6">
                            <h3 class="-my-3 flow-root text-gray-900">Users </h3>

                            <div class="pt-6" id="filter-section-1">
                                <div class="space-y-4">
                                    @foreach ($users as $user)
                                        <div class="flex items-center">
                                            <input id="filter-user-{{ $user->id }}" x-model="selectedUsers" value="{{ $user->id }}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-user-{{ $user->id }}" class="ml-3 text-sm text-gray-600">{{ $user->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 py-6">
                            <h3 class="-my-3 flow-root text-gray-900">Time Range:</h3>

                            <div class="pt-6" id="filter-section-1">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="filter-yesterday" x-model="selectedTimeRange" value="yesterday" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-yesterday" class="ml-3 text-sm text-gray-600">See data from yesterday</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="filter-last_week" x-model="selectedTimeRange" value="last_week" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-last_week" class="ml-3 text-sm text-gray-600">See data from last week</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="filter-last_month" x-model="selectedTimeRange" value="last_month" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-last_month" class="ml-3 text-sm text-gray-600">See data from last month</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-6">
                            <h3 class="flow-root text-gray-900">Time Range:</h3>

                            <div class="pt-6" id="filter-section-1">
                                <div class="space-y-4">
                                    <div class="">
                                        <label class="text-sm text-gray-600 block mb-2">Start Date:</label>
                                        <input x-model="startDate" type="date" class="rounded border-gray-300 focus:ring-indigo-500 px-1">
                                    </div>
                                    <div class="">
                                        <label class="text-sm text-gray-600 block mb-2">End Date:</label>
                                        <input x-model="endDate" type="date" class="rounded border-gray-300 focus:ring-indigo-500 px-1">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div>
                            <button type="submit" class="bg-indigo-500 text-white rounded-md px-4 py-2 hover:bg-indigo-600">Apply Filters</button>
                        </div>
                    </form>


                    <div class="lg:col-span-3">
                        <template x-for="filteredResult in filteredResults" x-bind:key="filteredResult.id">
                            <div class="relative my-10 flex flex-col overflow-hidden rounded-2xl bg-white text-gray-600 shadow-lg ring-1 ring-gray-200">
                                <div class="border-b p-6 pb-0">
                                    <h6 class="mb-2 text-base font-normal">Keyword: <span class="font-bold" x-text="filteredResult.search_keyword"></span></h6>
                                    <p class="mt-1 text-xs text-black">Searched By <span class="font-bold" x-text="filteredResult.user.name"></span></p>
                                    <p class="mb-4 text-sm font-light" x-text="filteredResult.search_time"></p>
                                    <p class="pb-2 font-bold">Search Results: </p>
                                </div>

                                <div x-data="{ results: JSON.parse(filteredResult.search_results)}" class="flex-auto p-6">
                                    <div class="relative flex flex-col justify-center">
                                        <div class="absolute left-4 h-full border-r-2"></div>

                                        <template x-for="(result, index) in results" x-bind:key="result.id">
                                            <div class="relative mb-4">
                                                <span class="absolute inline-flex h-6 w-6 items-center justify-center rounded-full bg-blue-500 p-4 text-center text-base font-semibold text-white shadow" x-text="index+1"></span>
                                                <div class="ml-12 w-auto pt-1">
                                                    <a :href="result.link" class="text-blue-500" x-text="result.title"></a>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        function filterResults() {
            const url = '{{ route("get-filtered-user-search-history") }}';

            const data = {
                selectedKeywords: this.selectedKeywords,
                selectedUsers: this.selectedUsers,
                selectedTimeRange: this.selectedTimeRange,
                startDate: this.startDate,
                endDate: this.endDate,
            };

            axios.post(url, data)
                .then(response => {
                    this.filteredResults = response.data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

    </script>
</body>
</html>
