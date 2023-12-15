@if(Session::has('success'))
    <div class="bg-green-500 text-white p-4 rounded-md shadow-md flex items-center">
        <strong class="mr-2">Success!</strong>
        <span>{{ Session::get('success') }}</span>
        <button type="button" class="ml-2" wire:click="$set('success', null)">&times;</button>
    </div>
@endif

<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form wire:submit.prevent="submitForm" enctype="multipart/form-data">
        @csrf

        <textarea
            wire:model="body"
            class="w-full"
            placeholder="What's up doc?"
            oninput="updateCharacterCount(this)"
            maxlength="255"
        ></textarea>

        <p class="text-sm text-gray-500">Remaining characters: {{ 255 - strlen($body) }}</p>

        <input wire:model="image" name="image" type="file">

        <hr class="my-4">

        <footer class="flex justify-between">
            <img
                src="{{ Auth::user()->avatar }}"
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

        document.querySelector('[wire\\:model="body"]').nextElementSibling.innerText = `Remaining characters: ${remainingCharacters}`;
    }
</script>
