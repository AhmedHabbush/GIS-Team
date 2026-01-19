@props([
    'label' => null,
    'name',
    'options' => [],
])

<div>
    @if($label)
        <label class="block mb-2 text-sm font-medium">
            {{ $label }}
        </label>
    @endif

    <div class="space-y-2">
        @foreach($options as $option)
            <label class="flex items-center gap-2 text-sm">
                <input
                    type="checkbox"
                    name="{{ $name }}"
                    value="{{ $option }}"
                    @checked(in_array($option, old(str_replace('[]', '', $name), [])))
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                >
                <span>{{ $option }}</span>
            </label>
        @endforeach
    </div>

    @error(str_replace('[]', '', $name))
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
