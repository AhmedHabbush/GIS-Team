@props([
    'label' => null,
    'name',
    'type' => 'text',
     'value' => null,
    'required' => false,
    'rows' => 4,
])

<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
    }

    .form-input,
    .form-textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        background: var(--bg-card);
        color: var(--text-primary);
        transition: all 0.2s ease;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(139, 111, 71, 0.1);
        background: #ffffff;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: var(--text-muted);
    }

    .form-error {
        margin-top: 0.5rem;
        font-size: 13px;
        color: var(--danger);
    }
</style>

<div class="form-group">
    @if($label)
        <label class="form-label">
            {{ $label }}
            @if($required)
                <span style="color: var(--danger);">*</span>
            @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            name="{{ $name }}"
            rows="{{ $rows }}"
            {{ $required ? 'required' : '' }}
            class="form-textarea"
            {{ $attributes }}
        >{{ old($name) }}</textarea>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            value="{{ old($name) }}"
            class="form-input"
            {{ $attributes }}
        >
    @endif

    @error($name)
    <p class="form-error">{{ $message }}</p>
    @enderror
</div>
