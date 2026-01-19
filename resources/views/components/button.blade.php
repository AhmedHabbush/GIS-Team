@props([
    'href' => null,
    'variant' => 'primary', // تصميم الزر
    'type' => 'button',     // نوع HTML
])

<style>
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
        white-space: nowrap;
    }

    /* Primary - Brown Gradient */
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(139, 111, 71, 0.25);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        box-shadow: 0 4px 12px rgba(139, 111, 71, 0.35);
        transform: translateY(-1px);
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 1px 4px rgba(139, 111, 71, 0.3);
    }

    /* Secondary - Light Brown */
    .btn-secondary {
        background: var(--bg-light);
        color: var(--text-primary);
        border: 1px solid var(--border);
    }

    .btn-secondary:hover {
        background: var(--border-light);
        border-color: var(--primary-light);
        color: var(--primary-dark);
    }

    .btn-secondary:active {
        background: var(--border);
    }

    /* Danger - Sienna Brown */
    .btn-danger {
        background: linear-gradient(135deg, #B8734F 0%, var(--danger) 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(160, 82, 45, 0.25);
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, var(--danger) 0%, #8B4513 100%);
        box-shadow: 0 4px 12px rgba(160, 82, 45, 0.35);
        transform: translateY(-1px);
    }

    .btn-danger:active {
        transform: translateY(0);
        box-shadow: 0 1px 4px rgba(160, 82, 45, 0.3);
    }

    /* Success - Olive Brown */
    .btn-success {
        background: linear-gradient(135deg, #8FA67C 0%, var(--success) 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(125, 143, 105, 0.25);
    }

    .btn-success:hover {
        background: linear-gradient(135deg, var(--success) 0%, #6B7F5A 100%);
        box-shadow: 0 4px 12px rgba(125, 143, 105, 0.35);
        transform: translateY(-1px);
    }

    /* Warning - Chocolate Brown */
    .btn-warning {
        background: linear-gradient(135deg, #E89860 0%, var(--warning) 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(210, 105, 30, 0.25);
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, var(--warning) 0%, #B8651E 100%);
        box-shadow: 0 4px 12px rgba(210, 105, 30, 0.35);
        transform: translateY(-1px);
    }

    /* Outline - Brown Border */
    .btn-outline {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-outline:hover {
        background: var(--primary);
        color: #ffffff;
    }

    /* Small Size */
    .btn-sm {
        padding: 6px 14px;
        font-size: 13px;
    }

    /* Large Size */
    .btn-lg {
        padding: 12px 24px;
        font-size: 15px;
    }

    /* Disabled State */
    .btn:disabled,
    .btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>

@php
    $classes = 'btn btn-' . $variant;
@endphp

@if($href)
    <a href="{{ $href }}"
       class="{{ $classes }}"
        {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        class="{{ $classes }}"
        {{ $attributes }}>
        {{ $slot }}
    </button>
@endif
