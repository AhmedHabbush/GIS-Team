@props(['active' => false])

<style>
    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 24px;
        margin: 2px 12px;
        border-radius: 10px;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        position: relative;
    }

    .nav-link:hover {
        background: var(--bg-light);
        color: var(--primary-dark);
    }

    .nav-link.active {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(139, 111, 71, 0.25);
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 60%;
        background: var(--primary-dark);
        border-radius: 0 4px 4px 0;
    }

    .nav-link svg {
        flex-shrink: 0;
    }
</style>

<a {{ $attributes->merge(['class' => 'nav-link ' . ($active ? 'active' : '')]) }}>
    {{ $slot }}
</a>
