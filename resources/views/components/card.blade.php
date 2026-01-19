<div style="background: var(--bg-white); border-radius: 8px; border: 1px solid var(--border); margin-bottom: 24px;">
    @isset($header)
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between;">
            {{ $header }}
        </div>
    @endisset

    <div style="padding: 24px;">
        {{ $slot }}
    </div>
</div>
