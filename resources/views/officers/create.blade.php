<x-layout title="إضافة ضابط جديد - نظام الإدارة">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'إدارة الضباط', 'url' => route('officers.index')],
            ['title' => 'إضافة ضابط جديد']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">إضافة ضابط جديد</h1>
        <p class="text-gray-600 mt-1">أدخل بيانات الضابط الجديد في النظام</p>
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
        <form action="{{ route('officers.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع الملف</label>
                    <input type="text" name="file_type" value="{{ old('file_type') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل نوع الملف" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم الملف</label>
                    <input type="text" name="file_number" value="{{ old('file_number') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم الملف" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الرقم الوطني</label>
                    <input type="text" name="national_id" value="{{ old('national_id') }}" 
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">مكان الميلاد</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل مكان الميلاد">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الجنس</label>
                    <select name="gender" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">اختر الجنس</option>
                        <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                        <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">فصيلة الدم</label>
                    <select name="blood_type" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                        <option value="">اختر فصيلة الدم</option>
                        <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم الأم</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل اسم الأم">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جنسية الأم</label>
                    <input type="text" name="mother_nationality" value="{{ old('mother_nationality') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل جنسية الأم">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم البطاقة</label>
                    <input type="text" name="personal_card_number" value="{{ old('personal_card_number') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم البطاقة">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">رقم الجواز</label>
                    <input type="text" name="passport_number" value="{{ old('passport_number') }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                           placeholder="أدخل رقم الجواز">
                </div>
            </div>

            <!-- المعلومات العسكرية -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">المعلومات العسكرية</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة <span class="text-red-500">*</span></label>
                        <select name="military_rank_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                            <option value="">اختر الرتبة</option>
                            @foreach($ranks as $rank)
                                <option value="{{ $rank->id }}" {{ old('military_rank_id') == $rank->id ? 'selected' : '' }}>
                                    {{ $rank->rank_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                        <input type="text" name="military_number" value="{{ old('military_number') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الرقم العسكري">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ التعيين</label>
                        <input type="date" name="appointment_date" value="{{ old('appointment_date') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">جهة التعيين</label>
                        <input type="text" name="appointment_authority" value="{{ old('appointment_authority') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل جهة التعيين">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">رقم قرار التعيين</label>
                        <input type="text" name="appointment_decision_number" value="{{ old('appointment_decision_number') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل رقم قرار التعيين">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ آخر ترفيع</label>
                        <input type="date" name="last_promotion_date" value="{{ old('last_promotion_date') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">قرار آخر ترفيع</label>
                        <input type="text" name="last_promotion_decision" value="{{ old('last_promotion_decision') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل قرار آخر ترفيع">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">سنة آخر ترفيع</label>
                        <input type="number" name="last_promotion_year" value="{{ old('last_promotion_year') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل سنة آخر ترفيع" min="1950" max="{{ date('Y') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الأقدمية</label>
                        <input type="text" name="seniority" value="{{ old('seniority') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الأقدمية">
                    </div>
                </div>
            </div>

            <!-- معلومات العمل -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات العمل (اختياري)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">جهة العمل</label>
                        <input type="text" name="work_authority" value="{{ old('work_authority') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل جهة العمل">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">مكان العمل</label>
                        <input type="text" name="work_location" value="{{ old('work_location') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل مكان العمل">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">المكتب</label>
                        <input type="text" name="office" value="{{ old('office') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل المكتب">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">العمل المكلف به</label>
                        <input type="text" name="assigned_task" value="{{ old('assigned_task') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل العمل المكلف به">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الحالة الوظيفية</label>
                        <select name="employment_status_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            <option value="">اختر الحالة الوظيفية</option>
                            @foreach($employmentStatuses as $status)
                                <option value="{{ $status->id }}" {{ old('employment_status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->status_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الرقم المالي</label>
                        <input type="text" name="financial_number" value="{{ old('financial_number') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الرقم المالي">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تفاصيل الحالة الوظيفية</label>
                        <textarea name="employment_status_detail" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                  placeholder="أدخل تفاصيل الحالة الوظيفية">{{ old('employment_status_detail') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ملاحظات الوظيفة</label>
                        <textarea name="employment_notes" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                                  placeholder="أدخل ملاحظات الوظيفة">{{ old('employment_notes') }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ المباشرة</label>
                        <input type="date" name="direct_date" value="{{ old('direct_date') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">جنسية الزوجة</label>
                        <input type="text" name="wife_nationality" value="{{ old('wife_nationality') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل جنسية الزوجة">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">رقم قرار النقل</label>
                        <input type="text" name="transfer_decision_number" value="{{ old('transfer_decision_number') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل رقم قرار النقل">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ النقل</label>
                        <input type="date" name="transfer_date" value="{{ old('transfer_date') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">جهة النقل</label>
                        <input type="text" name="transfer_authority" value="{{ old('transfer_authority') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل جهة النقل">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الدرجة العلمية</label>
                        <input type="text" name="academic_degree" value="{{ old('academic_degree') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                               placeholder="أدخل الدرجة العلمية">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ الدرجة العلمية</label>
                        <input type="date" name="academic_degree_date" value="{{ old('academic_degree_date') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="reviewed" value="1" {{ old('reviewed') ? 'checked' : '' }} 
                               class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2">
                        <label class="ml-2 text-sm font-medium text-gray-700">تمت المراجعة</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="leadership" value="1" {{ old('leadership') ? 'checked' : '' }} 
                               class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2">
                        <label class="ml-2 text-sm font-medium text-gray-700">قيادي</label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                <button type="button" onclick="fillRandomOfficerData()" 
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                    تعبئة بيانات تجريبية
                </button>
                <div class="flex gap-4">
                    <a href="{{ route('officers.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition-colors flex items-center">
                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                        </svg>
                        حفظ بيانات الضابط
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function fillRandomOfficerData() {
            const names = ['أحمد محمد علي', 'محمد عبدالله سالم', 'علي حسن محمد', 'خالد أحمد حسن', 'عمر محمود طه', 'يوسف عبدالرحمن أحمد'];
            const cities = ['دمشق', 'حلب', 'حمص', 'حماة', 'اللاذقية', 'طرطوس', 'درعا', 'السويداء', 'القنيطرة', 'دير الزور', 'الرقة', 'الحسكة', 'إدلب'];
            const bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            
            document.querySelector('input[name="file_type"]').value = 'ملف ضابط';
            document.querySelector('input[name="file_number"]').value = Math.floor(Math.random() * 10000) + 1000;
            document.querySelector('input[name="national_id"]').value = Math.floor(Math.random() * 90000000000) + 10000000000;
            document.querySelector('input[name="name"]').value = names[Math.floor(Math.random() * names.length)];
            
            const birthYear = new Date().getFullYear() - (25 + Math.floor(Math.random() * 30));
            const birthMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const birthDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="birth_date"]').value = `${birthYear}-${birthMonth}-${birthDay}`;
            
            document.querySelector('input[name="birth_place"]').value = cities[Math.floor(Math.random() * cities.length)];
            document.querySelector('select[name="gender"]').value = 'ذكر';
            document.querySelector('select[name="blood_type"]').value = bloodTypes[Math.floor(Math.random() * bloodTypes.length)];
            document.querySelector('input[name="mother_name"]').value = names[Math.floor(Math.random() * names.length)];
            document.querySelector('input[name="mother_nationality"]').value = 'سورية';
            document.querySelector('input[name="personal_card_number"]').value = Math.floor(Math.random() * 9000000) + 1000000;
            document.querySelector('input[name="passport_number"]').value = 'N' + Math.floor(Math.random() * 900000) + 100000;
            
            const rankSelect = document.querySelector('select[name="military_rank_id"]');
            if (rankSelect.options.length > 1) {
                const randomRank = Math.floor(Math.random() * (rankSelect.options.length - 1)) + 1;
                rankSelect.selectedIndex = randomRank;
            }
            
            document.querySelector('input[name="military_number"]').value = Math.floor(Math.random() * 900000) + 100000;
            
            const appointmentYear = new Date().getFullYear() - (5 + Math.floor(Math.random() * 20));
            const appointmentMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const appointmentDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="appointment_date"]').value = `${appointmentYear}-${appointmentMonth}-${appointmentDay}`;
            
            document.querySelector('input[name="appointment_authority"]').value = 'وزارة الدفاع';
            document.querySelector('input[name="appointment_decision_number"]').value = 'ق/' + Math.floor(Math.random() * 9000) + 1000;
            
            const promotionYear = new Date().getFullYear() - Math.floor(Math.random() * 5);
            const promotionMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const promotionDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="last_promotion_date"]').value = `${promotionYear}-${promotionMonth}-${promotionDay}`;
            document.querySelector('input[name="last_promotion_decision"]').value = 'ق.ت/' + Math.floor(Math.random() * 9000) + 1000;
            document.querySelector('input[name="last_promotion_year"]').value = promotionYear;
            document.querySelector('input[name="seniority"]').value = Math.floor(Math.random() * 20) + 1;
            
            const workAuthorities = ['وزارة الدفاع', 'الأركان العامة', 'القيادة العامة للجيش'];
            document.querySelector('input[name="work_authority"]').value = workAuthorities[Math.floor(Math.random() * workAuthorities.length)];
            document.querySelector('input[name="work_location"]').value = cities[Math.floor(Math.random() * cities.length)];
            document.querySelector('input[name="office"]').value = 'مكتب رقم ' + (Math.floor(Math.random() * 50) + 1);
            document.querySelector('input[name="assigned_task"]').value = 'مهام قيادية';
            document.querySelector('input[name="financial_number"]').value = Math.floor(Math.random() * 900000) + 100000;
            
            const employmentStatusSelect = document.querySelector('select[name="employment_status_id"]');
            if (employmentStatusSelect.options.length > 1) {
                const randomStatus = Math.floor(Math.random() * (employmentStatusSelect.options.length - 1)) + 1;
                employmentStatusSelect.selectedIndex = randomStatus;
            }
            
            document.querySelector('textarea[name="employment_status_detail"]').value = 'تفاصيل الحالة الوظيفية';
            document.querySelector('textarea[name="employment_notes"]').value = 'ملاحظات عامة';
            
            const directYear = new Date().getFullYear() - Math.floor(Math.random() * 3);
            const directMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const directDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="direct_date"]').value = `${directYear}-${directMonth}-${directDay}`;
            document.querySelector('input[name="wife_nationality"]').value = 'سورية';
            document.querySelector('input[name="transfer_decision_number"]').value = 'ن/' + Math.floor(Math.random() * 9000) + 1000;
            
            const transferYear = new Date().getFullYear() - Math.floor(Math.random() * 2);
            const transferMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const transferDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="transfer_date"]').value = `${transferYear}-${transferMonth}-${transferDay}`;
            document.querySelector('input[name="transfer_authority"]').value = workAuthorities[Math.floor(Math.random() * workAuthorities.length)];
            
            const degrees = ['بكالوريوس', 'ماجستير', 'دكتوراه', 'دبلوم'];
            document.querySelector('input[name="academic_degree"]').value = degrees[Math.floor(Math.random() * degrees.length)];
            
            const degreeYear = new Date().getFullYear() - (5 + Math.floor(Math.random() * 15));
            const degreeMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const degreeDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="academic_degree_date"]').value = `${degreeYear}-${degreeMonth}-${degreeDay}`;
            
            document.querySelector('input[name="reviewed"]').checked = Math.random() > 0.3;
            document.querySelector('input[name="leadership"]').checked = Math.random() > 0.4;
        }
    </script>
</x-layout>