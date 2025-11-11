<x-layout title="تعديل معلومات العمل">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
            ['title' => 'تعديل معلومات العمل']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">تعديل معلومات العمل</h1>
        <p class="text-gray-600 mt-1">تعديل معلومات العمل للشخص: {{ $workInfo->person->name }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('work-info.update', $workInfo->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جهة العمل</label>
                    <input type="text" name="work_authority" value="{{ $workInfo->work_authority }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل جهة العمل">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">مكان العمل</label>
                    <input type="text" name="work_location" value="{{ $workInfo->work_location }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل مكان العمل">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">المكتب</label>
                    <input type="text" name="office" value="{{ $workInfo->office }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل المكتب">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">العمل المكلف به</label>
                    <input type="text" name="assigned_task" value="{{ $workInfo->assigned_task }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل العمل المكلف به">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة الوظيفية</label>
                    <select name="employment_status_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">اختر الحالة الوظيفية</option>
                        @foreach($employmentStatuses as $status)
                            <option value="{{ $status->id }}" {{ $workInfo->employment_status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->status_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرقم المالي</label>
                    <input type="text" name="financial_number" value="{{ $workInfo->financial_number }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل الرقم المالي">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center">
                    <input type="checkbox" name="reviewed" value="1" {{ $workInfo->reviewed ? 'checked' : '' }} 
                           class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2">
                    <label class="ml-2 text-sm font-medium text-gray-700">تمت المراجعة</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="leadership" value="1" {{ $workInfo->leadership ? 'checked' : '' }} 
                           class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2">
                    <label class="ml-2 text-sm font-medium text-gray-700">قيادي</label>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('persons.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">إلغاء</a>
                <button type="submit" class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors">تحديث معلومات العمل</button>
            </div>
        </form>
    </div>
</x-layout>