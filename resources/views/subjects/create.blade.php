<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Subject
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('subjects.store') }}">
            @csrf

            <div class="mb-4">
                <label for="subject_name" class="block mb-1 font-semibold">Subject Name</label>
                <input type="text" name="subject_name" id="subject_name" value="{{ old('subject_name') }}" required
                    class="w-full border p-2 rounded" />
                @error('subject_name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Subject</button>
            <a href="{{ route('subjects.index') }}" class="ml-4 text-blue-600 underline">Back</a>
        </form>
    </div>
</x-app-layout>