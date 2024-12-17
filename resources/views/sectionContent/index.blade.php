<x-app-layout>
    <div class="mx-auto w-[98%] lg:ml-12">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Section Content List</h1>
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                type="button">
                Add Section Content
            </button>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8 w-full overflow-x-auto">
            <!-- DataTable -->
            <table id="example" class="display w-full">
                <thead>
                    <tr>
                        <th>Section Name</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sectionContents as $item)
                    <tr>
                        <form action="{{ route('sectionContents.update', $item->id) }}" method="POST" class="update-form">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="text" name="sectionName" class="w-full border border-gray-300 rounded px-2 py-1" value="{{ $item->sectionName }}" disabled />
                            </td>
                            <td>
                                <input type="text" name="title" class="w-full border border-gray-300 rounded px-2 py-1" value="{{ $item->title }}" disabled />
                            </td>
                            <td>
                                <textarea name="content" class="w-full border border-gray-300 rounded px-2 py-1" disabled>{{ $item->content }}</textarea>
                            </td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="Image" class="w-16 h-16 object-cover rounded-lg" />
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td class="flex space-x-2">
                                <button type="button" onclick="enableEdit(this)" class="bg-blue-900 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 hidden save-button">Save</button>
                            </form>
                            <form action="{{ route('sectionContents.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Section Content Modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add Section Content</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('sectionContents.store') }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <input type="text" name="sectionName" class="p-3 border border-gray-300 rounded-lg shadow-sm w-full" placeholder="Section Name" required />
                        <input type="text" name="title" class="p-3 border border-gray-300 rounded-lg shadow-sm w-full" placeholder="Title" required />
                        <textarea name="content" class="p-3 border border-gray-300 rounded-lg shadow-sm w-full" placeholder="Content" required></textarea>
                        <input type="file" name="image" class="p-3 border border-gray-300 rounded-lg shadow-sm w-full" />
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold shadow-lg hover:from-blue-600 hover:to-teal-600">
                            Add Section Content
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function enableEdit(button) {
        const row = button.closest('tr');
        row.querySelectorAll('input, textarea').forEach(input => input.disabled = false); // Enable all input fields
        button.classList.add('hidden'); // Hide the Edit button
        row.querySelector('.save-button').classList.remove('hidden'); // Show the Save button
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top", // Position: top or bottom
                position: "right", // Position: left, center or right
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();
        @elseif(session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
            }).showToast();
        @endif
    });
</script>
