<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Students
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="mb-4 flex justify-between">
            <form method="GET" action="{{ route('students.index') }}" class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or surname" class="border p-1 rounded" />
                <select name="sort" class="border p-1 rounded">
                    <option value="first_name" {{ request('sort') == 'first_name' ? 'selected' : '' }}>First Name</option>
                    <option value="last_name" {{ request('sort') == 'last_name' ? 'selected' : '' }}>Last Name</option>
                </select>
                <select name="direction" class="border p-1 rounded">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-3 rounded">Filter</button>
            </form>

            <a href="{{ route('students.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add Student</a>
        </div>

        <table class="w-full border border-collapse border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2">First Name</th>
                    <th class="border border-gray-300 p-2">Last Name</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $student->first_name }}</td>
                    <td class="border border-gray-300 p-2">{{ $student->last_name }}</td>
                    <td class="border border-gray-300 p-2">
                        <a href="{{ route('students.edit', $student) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $students->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>