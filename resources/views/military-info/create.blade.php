<x-layout title="إضافة معلومات عسكرية">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
            ['title' => 'إضافة معلومات عسكرية']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">إضافة معلومات عسكرية</h1>
        <p class="text-gray-600 mt-1">إضافة المعلومات العسكرية للشخص: {{ $person->name }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('military-info.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="national_id" value="{{ $person->national_id }}">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الفئة</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                        <option value="">اختر الفئة</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة</label>
                    <select name="military_rank_id" id="military_rank_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required disabled>
                        <option value="">اختر الفئة أولاً</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                    <input type="text" name="military_number" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="أدخل الرقم العسكري" disabled>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ التعيين</label>
                    <input type="date" name="appointment_date" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جهة التعيين</label>
                    <input type="text" name="appointment_authority" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="أدخل جهة التعيين">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم قرار التعيين</label>
                    <input type="text" name="appointment_decision_number" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="أدخل رقم قرار التعيين">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ آخر ترقية</label>
                    <input type="date" name="last_promotion_date" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('persons.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">إلغاء</a>
                <button type="submit" class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors">حفظ المعلومات العسكرية</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const rankSelect = document.getElementById('military_rank_id');
            const militaryNumberInput = document.querySelector('input[name="military_number"]');
            
            rankSelect.innerHTML = '<option value="">اختر الرتبة</option>';
            
            // تفعيل/تعطيل حقل الرقم العسكري حسب الفئة
            if (categoryId == '2') { // ضابط صف
                militaryNumberInput.disabled = false;
                militaryNumberInput.required = true;
                militaryNumberInput.parentElement.style.opacity = '1';
            } else {
                militaryNumberInput.disabled = true;
                militaryNumberInput.required = false;
                militaryNumberInput.value = '';
                militaryNumberInput.parentElement.style.opacity = '0.5';
            }
            
            if (categoryId) {
                rankSelect.disabled = false;
                fetch(`/api/ranks/${categoryId}`)
                    .then(response => response.json())
                    .then(ranks => {
                        ranks.forEach(rank => {
                            const option = document.createElement('option');
                            option.value = rank.id;
                            option.textContent = rank.rank_name;
                            rankSelect.appendChild(option);
                        });
                    });
            } else {
                rankSelect.disabled = true;
                rankSelect.innerHTML = '<option value="">اختر الفئة أولاً</option>';
                militaryNumberInput.disabled = true;
                militaryNumberInput.required = false;
                militaryNumberInput.value = '';
                militaryNumberInput.parentElement.style.opacity = '0.5';
            }
        });
        
        // تعطيل حقل الرقم العسكري عند تحميل الصفحة
        document.querySelector('input[name="military_number"]').parentElement.style.opacity = '0.5';
    </script>
</x-layout>