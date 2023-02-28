<div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100">
    <div class="sm:flex sm:justify-end">
        {{ $logo }}
    </div>
    
    <div class="sm:justify-center mx-auto mt-40">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white sm:shadow-form shadow-md  overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>