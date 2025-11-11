<x-layout title="إضافة معلومات العمل">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
            ['title' => 'إضافة معلومات العمل']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">إضافة معلومات العمل</h1>
        <p class="text-gray-600 mt-1">إضافة معلومات العمل للشخص: {{ $person->name }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('work-info.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="national_id" value="{{ $person->national_id }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جهة العمل</label>
                    <input type="text" name="work_authority" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="أدخل جهة العمل">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">مكان العمل</label>
                    <input type="text" name="work_location" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="أدخل مكان العمل">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة الوظيفية</label>
                    <select name="employment_status_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">اختر الحالة الوظيفية</option>
                        @foreach($employmentStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرقم المالي</label>
                    <input type="text" name="financial_number" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="أدخل الرقم المالي">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('persons.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">إلغاء</a>
                <button type="submit" class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors">حفظ معلومات العمل</button>
            </div>
        </form>
    </div>
</x-layout>