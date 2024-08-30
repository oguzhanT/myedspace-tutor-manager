<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Bar -->
            <div>
                <label class="block mb-2 font-bold">Name or Email:</label>
                <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search by name or email"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none">
            </div>

            <!-- Subject Selection -->
            <div>
                <label class="block mb-2 font-bold">Subjects:</label>
                <select wire:model="selectedSubjects" multiple class="w-full px-4 py-2 border rounded-lg focus:outline-none">
                    @foreach($subjects as $subject)
                            <option value="{{ $subject }}">{{ $subject }}</option>

                    @endforeach
                </select>
            </div>

            <!-- Price Range Slider -->
            <div>
                <label class="block mb-2 font-bold">Hourly Rate: ${{ $minRate }} - ${{ $maxRate }}</label>
                <input type="range" wire:model="minRate" min="0" max="200" class="w-full accent-primary">
                <input type="range" wire:model="maxRate" min="0" max="200" class="w-full mt-2 accent-primary">

            </div>
        </div>
        <!-- Search button -->
        <button wire:click="search" class="filament-button text-white py-2 px-4 rounded mt-4">
            Search Tutors
        </button>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 rounded-lg gap-2 bg-primary">
        @forelse($tutors as $tutor)

            <div class="p-6 m-3 rounded-lg shadow-md bg-white">
                <img src="{{ asset('storage/' . $tutor->avatar) }}" alt="Avatar" class="w-16 h-16 rounded-full mx-auto">
                <h3 class="text-lg font-bold text-center mt-4">{{ $tutor->name }}</h3>
                <p class="text-center mt-2">{{ $tutor->subjects }}</p>
                <p class="text-center text-gray-700 mt-2">${{ $tutor->hourly_rate }}/hour</p>
            </div>
        @empty
            <p class="text-center text-black-500">No tutors found.</p>
        @endforelse
    </div>
</div>
