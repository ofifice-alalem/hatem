<x-layout title="تغيير رتب ضباط الصف - نظام الإدارة">
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['title' => 'إدارة الأشخاص', 'url' => route('persons.index')],
            ['title' => 'تغيير رتب ضباط الصف']
        ]" />
        <h1 class="text-3xl font-bold text-gray-900">تغيير رتب ضباط الصف</h1>
        <p class="text-gray-600 mt-1">اختر ضابط صف لتغيير رتبته</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">بحث في ضباط الصف</h3>
        </div>
        <form method="GET" class="p-6">
            <div class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="الاسم أو الرقم الوطني أو الرقم العسكري"
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <button type="submit" 
                        class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors">
                    بحث
                </button>
                <a href="{{ route('persons.change-nco-rank') }}" 
                   class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                    إعادة تعيين
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">قائمة ضباط الصف ({{ $persons->count() }})</h2>
        </div>
        
        @if($persons->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">الاسم</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">الرقم الوطني</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">الرتبة الحالية</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">الرقم العسكري</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($persons as $person)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $person->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $person->national_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ $person->rank ? $person->rank->rank_name : 'غير محدد' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($person->militaryInfo && $person->militaryInfo->military_number)
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $person->militaryInfo->military_number }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('persons.change-rank', $person) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        تغيير الرتبة
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">لا يوجد ضباط صف</h3>
                <p class="text-gray-500">لا توجد أي ضباط صف في النظام حالياً</p>
            </div>
        @endif
    </div>
</x-layout>