<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets" enctype="multipart/form-data">
        @csrf

        <textarea
            name="body"
            class="w-full"
            placeholder="What's up doc?"
            oninput="updateCharacterCount(this)"
            maxlength="255" {{-- Set the maximum character count --}}
        ></textarea>

        <p id="characterCount" class="text-sm text-gray-500">Remaining characters: 255</p>

        <input name="image" type="file">

        <hr class="my-4">

        <footer class="flex justify-between">
            <img
                src="{{ auth()->user()->avatar }}"
                alt="your avatar"
                class="rounded-full mr-2"
                width="50"
                height="50"
            >

            <button
                type="submit"
                class="bg-blue-500 rounded-lg shadow py-2 px-6 text-white"
            >
                Publish
            </button>
        </footer>
    </form>

    @error('body')
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<script>
    function updateCharacterCount(textarea) {
        const maxLength = textarea.maxLength;
        const currentLength = textarea.value.length;
        const remainingCharacters = maxLength - currentLength;

        // Display the remaining characters count
        document.getElementById('characterCount').innerText = `Remaining characters: ${remainingCharacters}`;
    }
</script>
