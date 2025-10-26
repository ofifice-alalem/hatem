<!-- Header -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $title }}</h1>
        <p class="text-gray-600 mt-1">{{ $description }}</p>
    </div>
    <div class="flex items-center space-x-4">
        {{ $actions ?? '' }}
    </div>
</div>