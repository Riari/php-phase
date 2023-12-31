@include('partials.header', ['pageTitle' => "Greeting"])

<div class="flex items-center justify-center h-screen">
    <div class="bg-indigo-800 text-white font-bold rounded-lg border shadow-lg p-10">
        {{ $greeting }}
    </div>
</div>

@include('partials.footer')