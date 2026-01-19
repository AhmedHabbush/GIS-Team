<x-layout>
    <x-slot:title>لوحة التحكم</x-slot:title>

    {{-- Hero --}}
    <div
        style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; padding: 32px; border-radius: 12px; margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 700;">
            مرحباً، {{ auth()->user()->name }} 👋
        </h1>
        <p style="opacity: .9;">
            {{ now()->locale('ar')->isoFormat('dddd، D MMMM YYYY') }}
        </p>
    </div>

    {{-- Cards --}}
    @can('viewAny', \App\Models\Document::class)
        <div
            style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:24px; margin-bottom:32px;">

            <x-card
                style="background:var(--bg-white); border:1px solid var(--border); border-radius:12px; padding:24px;">
                <x-slot:header>
                    <h2 style="font-size:18px; font-weight:600;">
                        إجمالي مستنداتك
                    </h2>
                </x-slot:header>
                <div style="font-size:36px; font-weight:800;">
                    {{ $documentsCount }}
                </div>
            </x-card>

            <x-card>
                <x-slot:header>
                    <h2 style="font-size:18px; font-weight:600;">
                        آخر المستندات المرفوعة
                    </h2>
                </x-slot:header>

                <div style="display:flex; flex-direction:column; gap:12px;">
                    @forelse($latestDocuments as $document)
                        @php
                            $file = $document->files->first();
                        @endphp

                        <div
                            style="display:flex; align-items:center; gap:12px; padding:12px; background:var(--bg-light); border-radius:8px;">
                            <div style="flex:1;">
                                <div style="font-weight:500;">
                                    {{ $document->company }}
                                </div>
                                <div style="font-size:12px; color:var(--text-secondary);">
                                    {{ $document->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @if($file)
                                <a href="{{ route('documents.download', $file) }}"
                                   style="padding:6px 12px; background:var(--primary); color:white; border-radius:6px; font-size:12px;">
                                    تحميل
                                </a>
                            @endif
                        </div>
                    @empty
                        <div style="text-align:center; padding:32px; color:var(--text-secondary);">
                            لا يوجد مستندات
                        </div>
                    @endforelse
                </div>
            </x-card>
        </div>
    @endcan
</x-layout>
