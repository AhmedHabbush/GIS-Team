<x-layout>
    <x-slot:title>إدارة المستندات</x-slot:title>

    <x-card>
        <x-slot:header>
            <div class="flex justify-between items-center w-full">
                <h2 class="text-lg font-semibold">قائمة المستندات</h2>

                <x-button
                    x-data
                    x-on:click="$dispatch('open-modal', 'create-document')">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                    </svg>
                     إضافة مستند جديد
                </x-button>
            </div>
        </x-slot:header>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 text-sm text-gray-600">
                <tr>
                    <th class="p-3 text-right">#</th>
                    <th class="p-3 text-right">الشركة</th>
                    <th class="p-3 text-right">المشعر</th>
                    <th class="p-3 text-right">الجنسية</th>
                    <th class="p-3 text-right">عدد الحجاج</th>
                    <th class="p-3 text-right">المستخدم</th>
                    <th class="p-3 text-right">الإجراءات</th>
                </tr>
                </thead>

                <tbody x-data="{ openId: null }">
                @forelse($documents as $document)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3 font-medium">{{ $document->company }}</td>
                        <td class="p-3 text-sm">{{ implode('، ', $document->projects ?? []) }}</td>
                        <td class="p-3 text-sm">{{ $document->nationality }}</td>
                        <td class="p-3 text-sm font-semibold">{{ $document->pilgrims_count }}</td>

                        <td class="p-3 text-sm text-gray-500">
                            @if($document->user)
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $document->user->name }}</span>
                                    <span class="text-xs">{{ $document->user->email }}</span>
                                </div>
                            @else
                                <span class="text-gray-400">غير معروف</span>
                            @endif
                        </td>

                        <td class="p-3">
                            <div class="flex gap-2">
                                <button
                                    @click="openId === {{ $document->id }} ? openId = null : openId = {{ $document->id }}"
                                    class="px-3 py-1 text-sm bg-gray-100 rounded hover:bg-gray-200">
                                    التفاصيل
                                </button>

                                <form method="POST"
                                      action="{{ route('admin.documents.destroy', $document) }}"
                                      onsubmit="return confirm('حذف المستند بالكامل؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 text-sm bg-red-600 text-white rounded">
                                        حذف
                                    </button>
                                </form>
                                <a
                                    href="{{ route('admin.documents.print', $document) }}"
                                    target="_blank"
                                    class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                                >
                                    🖨️ طباعة
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- التفاصيل --}}
                    <tr
                        x-show="openId === {{ $document->id }}"
                        x-transition
                        x-cloak
                    >
                        <td colspan="5" class="bg-gray-50 p-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm ">

                                {{-- معلومات أساسية --}}
                                <div class="bg-white rounded-lg border p-4 space-y-3">
                                    <h4 class="font-semibold text-gray-700 mb-2">معلومات المستند</h4>

                                    <div class="flex justify-between">
                                        <span class="text-gray-500">النوع</span>
                                        <span class="text-gray-700 font-medium">
                                            {{ implode('، ', $document->types ?? []) ?: '—' }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-500">المربع</span>
                                        <span class="text-gray-700 font-medium">
                                                {{ $document->square ?? '—' }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-500">المخيم</span>
                                        <span class="text-gray-700 font-medium">
                                        {{ $document->camp ?? '—' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- ملاحظات --}}
                                <div class="bg-white rounded-lg border p-4">
                                    <h4 class="font-semibold text-gray-700 mb-2">ملاحظات</h4>
                                    <p class="text-gray-600 leading-relaxed">
                                        {{ $document->notes ?: 'لا توجد ملاحظات' }}
                                    </p>
                                </div>

                                {{-- الملفات --}}
                                <div class="md:col-span-2 bg-white rounded-lg border p-4">
                                    <h4 class="font-semibold text-gray-700 mb-3">الملفات المرفقة</h4>

                                    @if($document->files->count())
                                        <ul class="space-y-2">
                                            @foreach($document->files as $file)
                                                <li class="flex items-center justify-between rounded-md bg-gray-50 px-4 py-2">
                                                    <div class="flex items-center gap-2 text-gray-700">
                                                        📄
                                                        <span>{{ $file->original_name }}</span>
                                                    </div>

                                                    <div class="flex gap-2">
                                                        <a
                                                            href="{{ route('admin.documents.download', $document) }}"
                                                            class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded hover:bg-green-200"
                                                        >
                                                            تحميل
                                                        </a>

                                                        @if(auth()->user()->hasPermission('documents.files.delete'))
                                                            <form
                                                                method="POST"
                                                                action="{{ route('documents.files.destroy', $file) }}"
                                                                onsubmit="return confirm('حذف الملف؟')"
                                                            >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200"
                                                                >
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-400 text-sm">لا توجد ملفات مرفقة</p>
                                    @endif
                                </div>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">
                            لا توجد مستندات
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $documents->links() }}
    </x-card>

    {{-- مودال إضافة مستند --}}
    <x-modal name="create-document" maxWidth="2xl" focusable>
        <div class="p-6 max-h-[80vh] overflow-y-auto">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">
                    إضافة مستند جديد
                </h2>

                <button
                    x-on:click="$dispatch('close-modal', 'create-document')"
                    class="text-gray-400 hover:text-gray-600 text-xl leading-none">
                    &times;
                </button>
            </div>

            <form method="POST"
                  action="{{ route('admin.documents.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <x-input label="اسم الشركة" name="company" required />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border rounded-lg p-4">
                        <h3 class="text-sm font-semibold mb-3">النوع</h3>
                        <x-checkbox-group
                            name="types[]"
                            :options="[
                                'محضر تسليم الوزارة',
                                'خريطة الوزارة',
                                'محضر تسليم كدانة',
                                'خريطة كدانة',
                                'رخصة إضافات',
                                'شهادة سلامة التمديدات الكهربائية',
                                'شهادة مطابقة الأعمال',
                                'رخصة الجهازية'
                            ]"
                        />
                    </div>

                    <div class="border rounded-lg p-4">
                        <h3 class="text-sm font-semibold mb-3">المشعر</h3>
                        <x-checkbox-group
                            name="projects[]"
                            :options="['منى', 'عرفة', 'مزدلفة']"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="الجنسية" name="nationality" required />
                    <x-input label="المربع" name="square" required />
                    <x-input label="المخيم" name="camp" required />
                    <x-input type="number" label="عدد الحجاج" name="pilgrims_count" required />
                </div>

                <x-input
                    type="textarea"
                    rows="5"
                    label="ملاحظات"
                    name="notes"
                />

                {{-- رفع الملفات --}}
                <div
                    x-data="{
        files: [],
        removeFile(index) {
            this.files.splice(index, 1)

            const dt = new DataTransfer()
            this.files.forEach(file => dt.items.add(file))
            this.$refs.fileInput.files = dt.files
        }
    }"
                    class="border rounded-lg p-4"
                >
                    <label class="block mb-3 text-sm font-semibold text-gray-700">
                        الملفات المرفقة
                    </label>

                    <div class="flex items-center gap-3">
                        <label
                            class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded border cursor-pointer hover:bg-gray-200 transition"
                        >
                            📎 اختر ملفات
                            <input
                                type="file"
                                name="files[]"
                                multiple
                                class="hidden"
                                x-ref="fileInput"
                                @change="files = Array.from($event.target.files)"
                            >
                        </label>

                        <span
                            x-show="files.length"
                            x-text="`${files.length} ملف(ات) مختارة`"
                            class="text-sm text-gray-500"
                        ></span>
                    </div>

                    {{-- قائمة الملفات --}}
                    <template x-if="files.length">
                        <ul class="mt-3 space-y-2 text-sm">
                            <template x-for="(file, index) in files" :key="file.name">
                                <li class="flex items-center justify-between bg-gray-50 px-3 py-2 rounded">
                                    <div class="flex items-center gap-2 text-gray-700">
                                        📄
                                        <span x-text="file.name"></span>
                                    </div>

                                    <button
                                        type="button"
                                        @click="removeFile(index)"
                                        class="text-red-600 hover:text-red-800 text-xs"
                                    >
                                        حذف
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </template>

                    <p class="mt-2 text-xs text-gray-400">
                        يمكنك رفع أكثر من ملف – الحد الأقصى 10MB لكل ملف
                    </p>
                </div>


                <div class="flex justify-end gap-3 pt-4 border-t">
                    <x-button
                        variant="secondary"
                        x-on:click="$dispatch('close-modal', 'create-document')"
                        type="button">
                        إلغاء
                    </x-button>

                    <x-button type="submit">
                        حفظ المستند
                    </x-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-layout>
