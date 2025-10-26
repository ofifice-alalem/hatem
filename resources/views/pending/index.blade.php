<x-layout title="الطلبات المعلقة - نظام الإدارة">
    <x-header title="الطلبات المعلقة" description="مراجعة والموافقة على طلبات الترقية" />

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

            <!-- Requests Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">طلبات الترقية</h2>
                    <p class="text-sm text-gray-600 mt-1">قائمة بجميع طلبات الترقية التي تحتاج للموافقة</p>
                </div>
                
                @if($requests->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الشخص</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">من</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">إلى</th>
                                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاريخ الطلب</th>
                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($requests as $request)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center ml-3">
                                                    <span class="text-xs font-medium text-gray-600">{{ substr($request->person->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $request->person->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $request->person->national_no }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $request->oldType->type_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $request->oldRank->rank_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-dark-blue-600">{{ $request->newType->type_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $request->newRank->rank_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $request->created_at->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex justify-center gap-2">
                                                <form action="{{ route('pending.approve', $request->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white text-sm rounded-lg transition-colors">
                                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                                        </svg>
                                                        موافقة
                                                    </button>
                                                </form>
                                                <form action="{{ route('pending.reject', $request->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                                                        </svg>
                                                        رفض
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد طلبات معلقة</h3>
                        <p class="text-gray-500">جميع الطلبات تمت معالجتها</p>
                    </div>
                @endif
            </div>
</x-layout>