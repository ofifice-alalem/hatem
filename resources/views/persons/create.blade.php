<x-layout title="إضافة شخص جديد - نظام الإدارة">
    <!-- Header -->
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
            ['title' => 'إضافة شخص جديد']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">إضافة شخص جديد</h1>
        <p class="text-gray-600 mt-1">أدخل بيانات الشخص الجديد في النظام</p>
    </div>
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-start">
            <svg class="w-5 h-5 mt-0.5 ml-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
            </svg>
            <div>
                <h3 class="font-medium mb-1">يوجد أخطاء في البيانات:</h3>
                <ul class="text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('persons.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الملف</label>
                            <input type="text" name="file_no" value="{{ old('file_no') }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                   placeholder="أدخل رقم الملف" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الرقم الوطني</label>
                            <input type="text" name="national_no" value="{{ old('national_no') }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                   placeholder="أدخل الرقم الوطني" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الاسم الكامل" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الصفة</label>
                            <select name="type_id" id="type_id" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                                <option value="">اختر الصفة</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة</label>
                            <select name="rank_id" id="rank_id" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                                <option value="">اختر الرتبة</option>
                            </select>
                        </div>
                    </div>

                    <div id="military_no_field" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                        <input type="text" name="military_no" value="{{ old('military_no') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الرقم العسكري">
                    </div>

                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('persons.index') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            إلغاء
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors flex items-center">
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                            حفظ البيانات
                        </button>
                    </div>
                </form>
            </div>
    <x-slot name="scripts">
        <script>
        const typeSelect = document.getElementById('type_id');
        const rankSelect = document.getElementById('rank_id');
        const militaryField = document.getElementById('military_no_field');
        const militaryInput = document.querySelector('input[name="military_no"]');

        typeSelect.addEventListener('change', function() {
            const typeId = this.value;
            const selectedText = this.options[this.selectedIndex].text;
            
            // Clear ranks
            rankSelect.innerHTML = '<option value="">اختر الرتبة</option>';
            
            // Show/hide military number field with animation
            if (selectedText === 'ضابط صف') {
                militaryField.classList.remove('hidden');
                militaryInput.required = true;
            } else {
                militaryField.classList.add('hidden');
                militaryInput.required = false;
                militaryInput.value = '';
            }
            
            // Load ranks for selected type
            if (typeId) {
                fetch(`/api/ranks/${typeId}`)
                    .then(response => response.json())
                    .then(ranks => {
                        ranks.forEach(rank => {
                            const option = document.createElement('option');
                            option.value = rank.id;
                            option.textContent = rank.rank_name;
                            rankSelect.appendChild(option);
                        });
                    });
            }
        });

        // Trigger change event on page load if type is already selected
        if (typeSelect.value) {
            typeSelect.dispatchEvent(new Event('change'));
        }
        </script>
    </x-slot>
</x-layout>