<x-layout title="تغيير الرتبة - نظام الإدارة">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'إدارة الأشخاص', 'url' => route('persons.index')],
            ['title' => 'تغيير الرتبة']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">تغيير رتبة {{ $person->name }}</h1>
        <p class="text-gray-600 mt-1">الرقم الوطني: {{ $person->national_id }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('persons.update-rank', $person) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h3 class="font-medium text-blue-900 mb-2">الرتبة الحالية</h3>
                <p class="text-blue-800">{{ $person->rank ? $person->rank->rank_name : 'غير محدد' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الفئة <span class="text-red-500">*</span></label>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة <span class="text-red-500">*</span></label>
                    <select name="military_rank_id" id="military_rank_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required disabled>
                        <option value="">اختر الفئة أولاً</option>
                        @foreach($ranks as $rank)
                            <option value="{{ $rank->id }}" data-category="{{ $rank->category_id }}" style="display:none">
                                {{ $rank->rank_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('military_rank_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div id="military_number_field" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                <input type="text" name="military_number" value="{{ old('military_number', $person->militaryInfo?->military_number) }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                       placeholder="أدخل الرقم العسكري">
                @error('military_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('persons.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    إلغاء
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors">
                    حفظ التغيير
                </button>
            </div>
        </form>
    </div>

    <script>
        // تحديث قائمة الرتب عند تغيير الفئة
        document.getElementById('category_id').addEventListener('change', function() {
            const selectedCategory = this.value;
            const rankSelect = document.getElementById('military_rank_id');
            const rankOptions = document.querySelectorAll('#military_rank_id option[data-category]');
            const firstOption = document.querySelector('#military_rank_id option:first-child');
            
            // إعادة تعيين اختيار الرتبة
            rankSelect.value = '';
            
            if (selectedCategory === '') {
                rankSelect.disabled = true;
                firstOption.textContent = 'اختر الفئة أولاً';
            } else {
                rankSelect.disabled = false;
                firstOption.textContent = 'اختر الرتبة';
            }
            
            rankOptions.forEach(option => {
                if (selectedCategory === '' || option.dataset.category === selectedCategory) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });

        // عرض حقل الرقم العسكري لضباط الصف
        document.getElementById('military_rank_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const categoryId = selectedOption.getAttribute('data-category');
            const militaryNumberField = document.getElementById('military_number_field');
            
            if (categoryId === '2') { // ضابط صف
                militaryNumberField.classList.remove('hidden');
            } else {
                militaryNumberField.classList.add('hidden');
            }
        });
    </script>
</x-layout>