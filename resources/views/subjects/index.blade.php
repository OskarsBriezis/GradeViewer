<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subjects
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between mb-4">
            <form method="GET" action="{{ route('subjects.index') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search subjects..."
                    class="border rounded-l px-4 py-2" />
                <button type="submit" class="bg-blue-600 text-white px-4 rounded-r">Search</button>
            </form>
            <a href="{{ route('subjects.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Add Subject</a>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Subject Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $subject->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $subject->subject_name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center space-x-2">
                        <a href="{{ route('subjects.edit', $subject) }}" class="text-blue-600 hover:underline">Edit</a>

                        <form method="POST" action="{{ route('subjects.destroy', $subject) }}" class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this subject?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="border border-gray-300 px-4 py-2 text-center">No subjects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $subjects->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>