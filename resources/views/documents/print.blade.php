<x-layout-print>

    <div class="title">
        تفاصيل المستند
    </div>

    {{-- معلومات أساسية --}}
    <div class="section box">
        <div class="row">
            <span class="label">الشركة:</span> {{ $document->company }}
        </div>
        <div class="row">
            <span class="label">المشعر:</span> {{ implode('، ', $document->projects ?? []) }}
        </div>
        <div class="row">
            <span class="label">عدد الحجاج:</span> {{ $document->pilgrims_count }}
        </div>
        <div class="row">
            <span class="label">المربع:</span> {{ $document->square }}
        </div>
        <div class="row">
            <span class="label">المخيم:</span> {{ $document->camp }}
        </div>
        <div class="row">
            <span class="label">النوع:</span>
            {{ implode('، ', $document->types ?? []) ?: '—' }}
        </div>
    </div>

    {{-- الملاحظات --}}
    <div class="section box">
        <h3>ملاحظات</h3>
        <p>
            {{ $document->notes ?: 'لا توجد ملاحظات' }}
        </p>
    </div>

    {{-- الملفات --}}
    @if($document->files->count())
        <div class="section">
            <h3>الملفات المرفقة</h3>

            <table>
                <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>اسم الملف</th>
                </tr>
                </thead>
                <tbody>
                @foreach($document->files as $file)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $file->original_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-layout-print>
