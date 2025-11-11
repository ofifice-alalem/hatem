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
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">المعلومات العسكرية (اختياري)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الفئة</label>
                                <select name="category_id" id="category_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                    <option value="">اختر الفئة</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة</label>
                                <select name="military_rank_id" id="military_rank_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" disabled>
                                    <option value="">اختر الفئة أولاً</option>
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
                        <button type="button" onclick="fillRandomData()" 
                                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors flex items-center">
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                            </svg>
                            تعبئة بيانات تجريبية
                        </button>
                        <div class="flex gap-4">
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
                    </div>
                </form>
            </div>

    <script>
        const categorySelect = document.getElementById('category_id');
        const rankSelect = document.getElementById('military_rank_id');
        const militaryNumberInput = document.querySelector('input[name="military_number"]');
        
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;
                
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
        }
        
        // تعطيل حقل الرقم العسكري عند تحميل الصفحة
        if (militaryNumberInput) {
            militaryNumberInput.disabled = true;
            militaryNumberInput.parentElement.style.opacity = '0.5';
        }

        function fillRandomData() {
            const names = ['أحمد محمد علي', 'فاطمة أحمد حسن', 'محمد عبدالله سالم', 'عائشة محمود طه', 'علي حسن محمد', 'زينب عبدالرحمن أحمد'];
            const cities = ['دمشق', 'حلب', 'حمص', 'حماة', 'اللاذقية', 'طرطوس', 'درعا', 'السويداء', 'القنيطرة', 'دير الزور', 'الرقة', 'الحسكة', 'إدلب'];
            const bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            const genders = ['ذكر', 'أنثى'];
            
            // البيانات الأساسية
            document.querySelector('input[name="file_type"]').value = 'ملف شخصي';
            document.querySelector('input[name="file_number"]').value = Math.floor(Math.random() * 10000) + 1000;
            document.querySelector('input[name="national_id"]').value = Math.floor(Math.random() * 90000000000) + 10000000000;
            document.querySelector('input[name="name"]').value = names[Math.floor(Math.random() * names.length)];
            
            // تاريخ الميلاد (عمر بين 25-55 سنة)
            const birthYear = new Date().getFullYear() - (25 + Math.floor(Math.random() * 30));
            const birthMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const birthDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="birth_date"]').value = `${birthYear}-${birthMonth}-${birthDay}`;
            
            document.querySelector('input[name="birth_place"]').value = cities[Math.floor(Math.random() * cities.length)];
            document.querySelector('select[name="gender"]').value = genders[Math.floor(Math.random() * genders.length)];
            document.querySelector('select[name="blood_type"]').value = bloodTypes[Math.floor(Math.random() * bloodTypes.length)];
            document.querySelector('input[name="mother_name"]').value = names[Math.floor(Math.random() * names.length)];
            document.querySelector('input[name="mother_nationality"]').value = 'سورية';
            document.querySelector('input[name="personal_card_number"]').value = Math.floor(Math.random() * 9000000) + 1000000;
            document.querySelector('input[name="passport_number"]').value = 'N' + Math.floor(Math.random() * 900000) + 100000;
            
            // المعلومات العسكرية
            const categorySelect = document.querySelector('select[name="category_id"]');
            if (categorySelect && categorySelect.options.length > 1) {
                const randomCategory = Math.floor(Math.random() * (categorySelect.options.length - 1)) + 1;
                categorySelect.selectedIndex = randomCategory;
                categorySelect.dispatchEvent(new Event('change'));
                
                setTimeout(() => {
                    const rankSelect = document.querySelector('select[name="military_rank_id"]');
                    if (rankSelect && rankSelect.options.length > 1) {
                        const randomRank = Math.floor(Math.random() * (rankSelect.options.length - 1)) + 1;
                        rankSelect.selectedIndex = randomRank;
                    }
                }, 500);
            }
            
            document.querySelector('input[name="military_number"]').value = Math.floor(Math.random() * 900000) + 100000;
            
            // تاريخ التعيين (بين 5-25 سنة مضت)
            const appointmentYear = new Date().getFullYear() - (5 + Math.floor(Math.random() * 20));
            const appointmentMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const appointmentDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="appointment_date"]').value = `${appointmentYear}-${appointmentMonth}-${appointmentDay}`;
            
            document.querySelector('input[name="appointment_authority"]').value = 'وزارة الدفاع';
            
            // معلومات العمل
            const workAuthorities = ['وزارة الدفاع', 'وزارة الداخلية', 'الأمن العام', 'أمن الدولة'];
            document.querySelector('input[name="work_authority"]').value = workAuthorities[Math.floor(Math.random() * workAuthorities.length)];
            document.querySelector('input[name="work_location"]').value = cities[Math.floor(Math.random() * cities.length)];
            document.querySelector('input[name="office"]').value = 'مكتب رقم ' + (Math.floor(Math.random() * 50) + 1);
            document.querySelector('input[name="assigned_task"]').value = 'مهام إدارية';
            document.querySelector('input[name="financial_number"]').value = Math.floor(Math.random() * 900000) + 100000;
            
            // الحالة الوظيفية
            const employmentStatusSelect = document.querySelector('select[name="employment_status_id"]');
            if (employmentStatusSelect && employmentStatusSelect.options.length > 1) {
                const randomStatus = Math.floor(Math.random() * (employmentStatusSelect.options.length - 1)) + 1;
                employmentStatusSelect.selectedIndex = randomStatus;
            }
            
            // تاريخ المباشرة
            const directYear = new Date().getFullYear() - Math.floor(Math.random() * 5);
            const directMonth = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const directDay = String(Math.floor(Math.random() * 28) + 1).padStart(2, '0');
            document.querySelector('input[name="direct_date"]').value = `${directYear}-${directMonth}-${directDay}`;
            
            // خانات الاختيار
            document.querySelector('input[name="reviewed"]').checked = Math.random() > 0.5;
            document.querySelector('input[name="leadership"]').checked = Math.random() > 0.7;
        }
    </script>

</x-layout>