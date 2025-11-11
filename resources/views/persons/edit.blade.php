<x-layout title="تعديل بيانات الشخص">
    <!-- Header -->
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
            ['title' => 'تعديل بيانات الشخص']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">تعديل بيانات الشخص</h1>
        <p class="text-gray-600 mt-1">تحديث بيانات {{ $person->name }} في النظام</p>
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
                <form action="{{ route('persons.update', $person->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">نوع الملف</label>
                            <input type="text" name="file_type" value="{{ old('file_type', $person->file_type) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                   placeholder="أدخل نوع الملف" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الملف</label>
                            <input type="text" name="file_number" value="{{ old('file_number', $person->file_number) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                   placeholder="أدخل رقم الملف" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الرقم الوطني</label>
                            <input type="text" name="national_id" value="{{ old('national_id', $person->national_id) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                   placeholder="أدخل الرقم الوطني" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                        <input type="text" name="name" value="{{ old('name', $person->name) }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الاسم الكامل" required>
                    </div>

                    <!-- المعلومات العسكرية -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">المعلومات العسكرية</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة</label>
                                <select name="military_rank_id" 
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                    <option value="">اختر الرتبة</option>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}" {{ old('military_rank_id', $person->militaryInfo->military_rank_id ?? '') == $rank->id ? 'selected' : '' }}>
                                            {{ $rank->category->category_name }} - {{ $rank->rank_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                                <input type="text" name="military_number" value="{{ old('military_number', $person->militaryInfo->military_number ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل الرقم العسكري">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ التعيين</label>
                                <input type="date" name="appointment_date" value="{{ old('appointment_date', $person->militaryInfo && $person->militaryInfo->appointment_date ? $person->militaryInfo->appointment_date->format('Y-m-d') : '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">جهة التعيين</label>
                                <input type="text" name="appointment_authority" value="{{ old('appointment_authority', $person->militaryInfo->appointment_authority ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل جهة التعيين">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">رقم قرار التعيين</label>
                                <input type="text" name="appointment_decision_number" value="{{ old('appointment_decision_number', $person->militaryInfo->appointment_decision_number ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل رقم قرار التعيين">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ آخر ترفيع</label>
                                <input type="date" name="last_promotion_date" value="{{ old('last_promotion_date', $person->militaryInfo && $person->militaryInfo->last_promotion_date ? $person->militaryInfo->last_promotion_date->format('Y-m-d') : '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">قرار آخر ترفيع</label>
                                <input type="text" name="last_promotion_decision" value="{{ old('last_promotion_decision', $person->militaryInfo->last_promotion_decision ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل قرار آخر ترفيع">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">سنة آخر ترفيع</label>
                                <input type="number" name="last_promotion_year" value="{{ old('last_promotion_year', $person->militaryInfo->last_promotion_year ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل سنة آخر ترفيع">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الأقدمية</label>
                                <input type="text" name="seniority" value="{{ old('seniority', $person->militaryInfo->seniority ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل الأقدمية">
                            </div>
                        </div>
                    </div>

                    <!-- معلومات العمل -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات العمل</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">جهة العمل</label>
                                <input type="text" name="work_authority" value="{{ old('work_authority', $person->workInfo->work_authority ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل جهة العمل">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">مكان العمل</label>
                                <input type="text" name="work_location" value="{{ old('work_location', $person->workInfo->work_location ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل مكان العمل">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الحالة الوظيفية</label>
                                <select name="employment_status_id" 
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                    <option value="">اختر الحالة الوظيفية</option>
                                    @foreach($employmentStatuses as $status)
                                        <option value="{{ $status->id }}" {{ old('employment_status_id', $person->workInfo->employment_status_id ?? '') == $status->id ? 'selected' : '' }}>
                                            {{ $status->status_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الرقم المالي</label>
                                <input type="text" name="financial_number" value="{{ old('financial_number', $person->workInfo->financial_number ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                       placeholder="أدخل الرقم المالي">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ الميلاد</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $person->birth_date?->format('Y-m-d')) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">مكان الميلاد</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place', $person->birth_place) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                   placeholder="أدخل مكان الميلاد">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الجنس</label>
                            <select name="gender" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                <option value="">اختر الجنس</option>
                                <option value="ذكر" {{ old('gender', $person->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                <option value="أنثى" {{ old('gender', $person->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">فصيلة الدم</label>
                            <select name="blood_type" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                <option value="">اختر فصيلة الدم</option>
                                <option value="A+" {{ old('blood_type', $person->blood_type) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_type', $person->blood_type) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_type', $person->blood_type) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_type', $person->blood_type) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_type', $person->blood_type) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_type', $person->blood_type) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_type', $person->blood_type) == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_type', $person->blood_type) == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                        </div>
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
                            تحديث البيانات
                        </button>
                    </div>
                </form>
            </div>

</x-layout>