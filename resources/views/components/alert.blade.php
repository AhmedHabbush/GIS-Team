@props(['type' => 'success'])

@php
    $styles = [
        'success' => 'background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7;',
        'error' => 'background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;',
        'warning' => 'background: #fef3c7; color: #92400e; border: 1px solid #fcd34d;',
        'info' => 'background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd;',
    ];
@endphp

<div style="padding: 14px 20px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; {{ $styles[$type] }}">
    <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
        @if($type === 'success')
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
        @elseif($type === 'error')
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
        @else
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
        @endif
    </svg>
    <span>{{ $slot }}</span>
</div>
