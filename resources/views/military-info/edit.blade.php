<x-layout title="تعديل المعلومات العسكرية">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
            ['title' => 'تعديل المعلومات العسكرية']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">تعديل المعلومات العسكرية</h1>
        <p class="text-gray-600 mt-1">تعديل المعلومات العسكرية للشخص: {{ $militaryInfo->person->name }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('military-info.update', $militaryInfo->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة العسكرية</label>
                    <select name="military_rank_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                        <option value="">اختر الرتبة العسكرية</option>
                        @foreach($ranks as $rank)
                            <option value="{{ $rank->id }}" {{ $militaryInfo->military_rank_id == $rank->id ? 'selected' : '' }}>
                                {{ $rank->category->category_name }} - {{ $rank->rank_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if($militaryInfo->person->rank && $militaryInfo->person->rank->category_id == 2)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                    <input type="text" name="military_number" value="{{ $militaryInfo->military_number }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل الرقم العسكري">
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ التعيين</label>
                    <input type="date" name="appointment_date" value="{{ $militaryInfo->appointment_date?->format('Y-m-d') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جهة التعيين</label>
                    <input type="text" name="appointment_authority" value="{{ $militaryInfo->appointment_authority }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل جهة التعيين">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم قرار التعيين</label>
                    <input type="text" name="appointment_decision_number" value="{{ $militaryInfo->appointment_decision_number }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم قرار التعيين">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ آخر ترقية</label>
                    <input type="date" name="last_promotion_date" value="{{ $militaryInfo->last_promotion_date?->format('Y-m-d') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('persons.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">إلغاء</a>
                <button type="submit" class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors">تحديث المعلومات العسكرية</button>
            </div>
        </form>
    </div>
</x-layout>