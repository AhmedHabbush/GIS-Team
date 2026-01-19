<x-layout>
    <x-slot:title>إدارة المستندات</x-slot:title>

    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data"
          class="space-y-6 max-w-3xl">
        @csrf

        <x-input label="الشركة" name="company"/>

        {{-- النوع --}}
        <div>
            <label class="font-semibold">النوع</label>
            @foreach (['محضر تسليم الوزارة', 'رخصة جاهزية', 'شهادة سلامة'] as $type)
                <label class="block">
                    <input type="checkbox" name="types[]" value="{{ $type }}">
                    {{ $type }}
                </label>
            @endforeach
        </div>

        {{-- المشروع --}}
        <div>
            <label class="font-semibold">المشروع</label>
            @foreach (['منى', 'عرفة', 'مزدلفة'] as $project)
                <label class="block">
                    <input type="checkbox" name="projects[]" value="{{ $project }}">
                    {{ $project }}
                </label>
            @endforeach
        </div>

        <x-input label="الجنسية" name="nationality"/>
        <x-input label="العمر" name="age" type="number"/>
        <x-input label="المخيم" name="camp"/>
        <x-input label="عدد الحجاج" name="pilgrims_count" type="number"/>

        <x-input
            type="textarea"
            label="ملاحظات"
            name="notes"
        />


        {{-- الملفات --}}
        <div>
            <label class="font-semibold">المرفقات</label>
            <input type="file" name="files[]" multiple class="block">
        </div>

        <x-button>حفظ المستند</x-button>
    </form>
</x-layout>
