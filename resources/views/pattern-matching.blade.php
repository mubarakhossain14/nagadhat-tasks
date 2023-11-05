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
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">Pattern Matching</h1>
            <div>
                <a class="inline-flex justify-center rounded-lg text-sm font-semibold py-2 px-4 bg-slate-900 text-white hover:bg-slate-700" href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Home
                </a>
                <a target="_blank" class="inline-flex justify-center rounded-lg text-sm font-semibold py-2 px-4 bg-slate-900 text-white hover:bg-slate-700" href="https://github.com/mubarakhossain14/nagadhat-tasks/commit/3ead406d92f1002ace4c49c866de6970eadc577d">
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
                        text: '',
                        pattern: '',
                        message: '',
                    }">
                <form  @submit.prevent="matchPatterns">
                    <div class="mb-3">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Text</label>
                        <input type="text" @focus="message = ''" id="text" x-model="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex. tadadattaetadadadafa" required>
                    </div>

                    <div class="mb-6">
                        <label for="pattern" class="block mb-2 text-sm font-medium text-gray-900">Pattern</label>
                        <input type="text" @focus="message = ''" id="pattern" x-model="pattern" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex. dada" required>
                    </div>

                    <button type="submit" class="text-white mb-2 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    <button type="reset" @click="message = ''" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Reset</button>
                </form>

                <template x-if="message && text && pattern">
                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                        <p class="text-2xl" x-text="message"></p>
                    </div>
                </template>
            </div>
        </section>
    </main>
</div>

<script>
    function matchPatterns() {
        const url = '{{ route("get-pattern-matched-info") }}';

        const data = {
            text: this.text,
            pattern: this.pattern,
        };

        axios.post(url, data)
            .then(response => {
                this.message = response.data.message;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

</script>

</body>
</html>
