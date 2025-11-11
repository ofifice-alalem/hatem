<x-layout title="تعديل بيانات الضابط - نظام الإدارة">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'إدارة الضباط', 'url' => route('officers.index')],
            ['title' => 'تعديل بيانات الضابط']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">تعديل بيانات الضابط</h1>
        <p class="text-gray-600 mt-1">تعديل بيانات {{ $officer->name }}</p>
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

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('officers.update', $officer->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع الملف</label>
                    <input type="text" name="file_type" value="{{ old('file_type', $officer->file_type) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل نوع الملف" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم الملف</label>
                    <input type="text" name="file_number" value="{{ old('file_number', $officer->file_number) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم الملف" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرقم الوطني</label>
                    <input type="text" name="national_id" value="{{ old('national_id', $officer->national_id) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل الرقم الوطني" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name', $officer->name) }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                       placeholder="أدخل الاسم الكامل" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $officer->birth_date?->format('Y-m-d')) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">مكان الميلاد</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place', $officer->birth_place) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل مكان الميلاد">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الجنس</label>
                    <select name="gender" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">اختر الجنس</option>
                        <option value="ذكر" {{ old('gender', $officer->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                        <option value="أنثى" {{ old('gender', $officer->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">فصيلة الدم</label>
                    <select name="blood_type" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">اختر فصيلة الدم</option>
                        <option value="A+" {{ old('blood_type', $officer->blood_type) == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_type', $officer->blood_type) == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_type', $officer->blood_type) == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_type', $officer->blood_type) == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('blood_type', $officer->blood_type) == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_type', $officer->blood_type) == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_type', $officer->blood_type) == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_type', $officer->blood_type) == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم الأم</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name', $officer->mother_name) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل اسم الأم">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جنسية الأم</label>
                    <input type="text" name="mother_nationality" value="{{ old('mother_nationality', $officer->mother_nationality) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل جنسية الأم">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم البطاقة</label>
                    <input type="text" name="personal_card_number" value="{{ old('personal_card_number', $officer->personal_card_number) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم البطاقة">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم الجواز</label>
                    <input type="text" name="passport_number" value="{{ old('passport_number', $officer->passport_number) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم الجواز">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('officers.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    إلغاء
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
</x-layout>