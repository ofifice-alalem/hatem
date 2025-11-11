<x-layout title="لوحة التحكم - إدارة الأشخاص">
    <x-header title="لوحة التحكم" description="إدارة ومتابعة بيانات الأشخاص في النظام">
        <x-slot name="actions">
            <a href="{{ route('persons.create') }}" 
               class="bg-primary hover:bg-dark-blue-800 text-white font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                </svg>
                <span>إضافة شخص</span>
            </a>
        </x-slot>
    </x-header>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">إجمالي الأشخاص</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $persons->total() }}</p>
                            <p class="text-xs text-dark-blue-600 mt-1">↗ نشط</p>
                        </div>
                        <div class="w-12 h-12 bg-dark-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-dark-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">الضباط</p>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Person::whereHas('rank.category', function($q) { $q->where('category_name', 'ضابط'); })->count() }}</p>
                            <p class="text-xs text-dark-blue-600 mt-1">ضابط</p>
                        </div>
                        <div class="w-12 h-12 bg-dark-blue-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-dark-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">ضباط الصف</p>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Person::whereHas('rank.category', function($q) { $q->where('category_name', 'ضابط صف'); })->count() }}</p>
                            <p class="text-xs text-yellow-600 mt-1">ضابط صف</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">الموظفون</p>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Person::whereHas('rank.category', function($q) { $q->where('category_name', 'موظف'); })->count() }}</p>
                            <p class="text-xs text-purple-600 mt-1">موظف</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">فلترة البحث</h3>
                </div>
                <form method="GET" action="{{ route('persons.index') }}" class="p-6">
                    <div class="flex flex-wrap gap-4">
                        <!-- حقل البحث -->
                        <div class="flex-1 min-w-80">
                            <label class="block text-sm font-medium text-gray-700 mb-2">بحث بالاسم أو الرقم</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="الاسم أو الرقم الوطني أو العسكري"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        
                        <!-- فلتر الفئة -->
                        <div class="flex-1 min-w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-2">الفئة</label>
                            <div class="relative">
                                <select name="category_id" id="categoryFilter" 
                                        class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary appearance-none">
                                    <option value="">جميع الفئات</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- فلتر الرتبة -->
                        <div class="flex-1 min-w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-2">الرتبة</label>
                            <div class="relative">
                                <select name="rank_id" id="rankFilter" 
                                        class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary appearance-none disabled:bg-gray-100 disabled:cursor-not-allowed"
                                        {{ !request('category_id') ? 'disabled' : '' }}>
                                    <option value="">{{ !request('category_id') ? 'اختر الفئة أولاً' : 'جميع الرتب' }}</option>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}" 
                                                data-category="{{ $rank->category_id }}"
                                                {{ request('rank_id') == $rank->id ? 'selected' : '' }}
                                                style="{{ request('category_id') && request('category_id') != $rank->category_id ? 'display:none' : '' }}">
                                            {{ $rank->rank_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- الأزرار -->
                        <div class="flex items-end gap-3">
                            <button type="submit" 
                                    class="px-6 py-2 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition duration-300 flex items-center whitespace-nowrap">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                بحث
                            </button>
                            <a href="{{ route('persons.index') }}" 
                               class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300 flex items-center whitespace-nowrap h-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">قائمة الأشخاص</h2>
                            <p class="text-sm text-gray-600 mt-1">إدارة ومتابعة بيانات جميع الأشخاص المسجلين</p>
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium text-gray-900">{{ $persons->total() }}</span> شخص
                        </div>
                    </div>
                </div>
                
                @if($persons->total() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">رقم المعرف</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">رقم الملف</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الرقم الوطني</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الاسم</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الفئة</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الرتبة</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الرقم العسكري</th>
                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($persons as $person)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $person->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $person->file_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{!! request('search') ? preg_replace('/(' . preg_quote(request('search'), '/') . ')/i', '<span class="bg-yellow-200 px-1 rounded">$1</span>', $person->national_id) : $person->national_id !!}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{!! request('search') ? preg_replace('/(' . preg_quote(request('search'), '/') . ')/i', '<span class="bg-yellow-200 px-1 rounded">$1</span>', $person->name) : $person->name !!}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($person->rank && $person->rank->category)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($person->rank->category->category_name == 'ضابط') bg-dark-blue-100 text-dark-blue-800
                                                    @elseif($person->rank->category->category_name == 'ضابط صف') bg-dark-blue-200 text-dark-blue-900
                                                    @else bg-purple-100 text-purple-800 @endif">
                                                    {{ $person->rank->category->category_name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @if($person->rank)
                                                {{ $person->rank->rank_name }}
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @if($person->militaryInfo)
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                    {!! request('search') ? preg_replace('/(' . preg_quote(request('search'), '/') . ')/i', '<span class="bg-yellow-200 px-1 rounded">$1</span>', $person->militaryInfo->military_number) : $person->militaryInfo->military_number !!}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex justify-center space-x-1">
                                                <a href="{{ route('persons.edit', $person->id) }}" 
                                                   class="inline-flex items-center p-2 text-dark-blue-600 hover:text-dark-blue-900 hover:bg-dark-blue-50 rounded-lg transition-all duration-200" 
                                                   title="تعديل البيانات الشخصية">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                
                                                @if($person->militaryInfo)
                                                    <a href="{{ route('military-info.edit', $person->militaryInfo->id) }}" 
                                                       class="inline-flex items-center p-2 text-green-600 hover:text-green-900 hover:bg-green-50 rounded-lg transition-all duration-200" 
                                                       title="تعديل المعلومات العسكرية">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="{{ route('military-info.create', $person->national_id) }}" 
                                                       class="inline-flex items-center p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-all duration-200" 
                                                       title="إضافة معلومات عسكرية">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                                
                                                @if($person->workInfo)
                                                    <a href="{{ route('work-info.edit', $person->workInfo->id) }}" 
                                                       class="inline-flex items-center p-2 text-purple-600 hover:text-purple-900 hover:bg-purple-50 rounded-lg transition-all duration-200" 
                                                       title="تعديل معلومات العمل">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"/>
                                                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="{{ route('work-info.create', $person->national_id) }}" 
                                                       class="inline-flex items-center p-2 text-orange-600 hover:text-orange-900 hover:bg-orange-50 rounded-lg transition-all duration-200" 
                                                       title="إضافة معلومات عمل">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                                
                                                <button onclick="openDeleteModal('{{ $person->id }}', '{{ $person->name }}')" 
                                                        class="inline-flex items-center p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-all duration-200" 
                                                        title="حذف">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($persons->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    عرض {{ $persons->firstItem() }} إلى {{ $persons->lastItem() }} من أصل {{ $persons->total() }} نتيجة
                                </div>
                                <div class="flex items-center space-x-2">
                                    {{-- First Page --}}
                                    @if($persons->currentPage() > 1)
                                        <a href="{{ $persons->url(1) }}" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            الأولى
                                        </a>
                                    @endif
                                    
                                    {{-- Previous Page --}}
                                    @if($persons->onFirstPage())
                                        <span class="px-3 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-md cursor-not-allowed">
                                            السابق
                                        </span>
                                    @else
                                        <a href="{{ $persons->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            السابق
                                        </a>
                                    @endif
                                    
                                    {{-- Page Numbers --}}
                                    @foreach($persons->getUrlRange(max(1, $persons->currentPage() - 2), min($persons->lastPage(), $persons->currentPage() + 2)) as $page => $url)
                                        @if($page == $persons->currentPage())
                                            <span class="px-3 py-2 text-sm font-medium text-white bg-primary border border-primary rounded-md">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                    
                                    {{-- Next Page --}}
                                    @if($persons->hasMorePages())
                                        <a href="{{ $persons->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            التالي
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-md cursor-not-allowed">
                                            التالي
                                        </span>
                                    @endif
                                    
                                    {{-- Last Page --}}
                                    @if($persons->currentPage() < $persons->lastPage())
                                        <a href="{{ $persons->url($persons->lastPage()) }}" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            الأخيرة
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد بيانات</h3>
                        <p class="text-gray-500 mb-6">ابدأ بإضافة أول شخص في النظام</p>
                        <a href="{{ route('persons.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary hover:bg-dark-blue-800 text-white font-medium rounded-lg transition duration-300">
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            إضافة أول شخص
                        </a>
                    </div>
                @endif
            </div>
    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center ml-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">تأكيد الحذف</h3>
                        <p class="text-sm text-gray-500 mt-1">هذه العملية لا يمكن التراجع عنها</p>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6">
                    هل أنت متأكد من حذف بيانات 
                    <span id="personName" class="font-semibold text-gray-900"></span>؟
                </p>
                
                <div class="flex justify-end gap-3">
                    <button onclick="closeDeleteModal()" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        إلغاء
                    </button>
                    <button onclick="confirmDelete()" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors flex items-center">
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        حذف
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // تحديث قائمة الرتب عند تغيير الفئة
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            const rankFilter = document.getElementById('rankFilter');
            const rankOptions = document.querySelectorAll('#rankFilter option[data-category]');
            const firstOption = document.querySelector('#rankFilter option:first-child');
            
            // إعادة تعيين اختيار الرتبة
            rankFilter.value = '';
            
            if (selectedCategory === '') {
                rankFilter.disabled = true;
                firstOption.textContent = 'اختر الفئة أولاً';
            } else {
                rankFilter.disabled = false;
                firstOption.textContent = 'جميع الرتب';
            }
            
            rankOptions.forEach(option => {
                if (selectedCategory === '' || option.dataset.category === selectedCategory) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });
        
        let currentPersonId = null;
        
        function openDeleteModal(personId, personName) {
            currentPersonId = personId;
            document.getElementById('personName').textContent = personName;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
            currentPersonId = null;
        }
        
        function confirmDelete() {
            if (currentPersonId) {
                const form = document.getElementById('deleteForm');
                form.action = `/persons/${currentPersonId}`;
                form.submit();
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</x-layout>