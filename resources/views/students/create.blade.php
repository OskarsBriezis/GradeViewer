<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Student
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div class="mb-4">
                <label for="first_name" class="block mb-1 font-semibold">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required class="w-full border p-2 rounded" />
                @error('first_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="last_name" class="block mb-1 font-semibold">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="w-full border p-2 rounded" />
                @error('last_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Student</button>
            <a href="{{ route('students.index') }}" class="ml-4 text-blue-600 underline">Back</a>
        </form>
    </div>
</x-app-layout>