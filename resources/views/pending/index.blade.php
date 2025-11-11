<x-layout title="الطلبات المعلقة - نظام الإدارة">
    <x-header title="الطلبات المعلقة" description="مراجعة والموافقة على طلبات التعديل" />

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">طلبات التعديل</h2>
            <p class="text-sm text-gray-600 mt-1">قائمة بجميع طلبات التعديل التي تحتاج للموافقة</p>
        </div>
        
        @if($requests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نوع الطلب</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الشخص</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التغييرات</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاريخ الطلب</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($requests as $request)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($request->type == 'person') bg-blue-100 text-blue-800
                                        @elseif($request->type == 'military_info') bg-green-100 text-green-800
                                        @else bg-purple-100 text-purple-800 @endif">
                                        @if($request->type == 'person') بيانات شخصية
                                        @elseif($request->type == 'military_info') معلومات عسكرية
                                        @else معلومات عمل @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center ml-3">
                                            <span class="text-sm font-bold text-white">{{ substr($request->person->name ?? 'غ', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $request->person->name ?? 'غير محدد' }}</div>
                                            <div class="text-xs text-gray-500">{{ $request->person->national_id ?? '-' }}</div>
                                            @if($request->person && $request->person->rank)
                                                <div class="text-xs text-blue-600">{{ $request->person->rank->rank_name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-sm">
                                        @php
                                            $changes = [];
                                            $fieldNames = [
                                                'name' => 'الاسم',
                                                'national_id' => 'الرقم الوطني',
                                                'file_number' => 'رقم الملف',
                                                'birth_date' => 'تاريخ الميلاد',
                                                'gender' => 'الجنس',
                                                'military_number' => 'الرقم العسكري',
                                                'military_rank_id' => 'الرتبة',
                                                'work_authority' => 'جهة العمل'
                                            ];
                                            
                                            foreach($request->new_data as $key => $value) {
                                                if(isset($request->original_data[$key]) && $request->original_data[$key] != $value) {
                                                    $fieldName = $fieldNames[$key] ?? $key;
                                                    $oldValue = $request->original_data[$key] ?? 'فارغ';
                                                    $newValue = $value ?? 'فارغ';
                                                    
                                                    // تحويل IDs إلى نصوص
                                                    if($key == 'military_rank_id') {
                                                        $oldValue = $ranks[$oldValue] ?? $oldValue;
                                                        $newValue = $ranks[$newValue] ?? $newValue;
                                                    } elseif($key == 'employment_status_id') {
                                                        $oldValue = $employmentStatuses[$oldValue] ?? $oldValue;
                                                        $newValue = $employmentStatuses[$newValue] ?? $newValue;
                                                    }
                                                    
                                                    $changes[] = [
                                                        'field' => $fieldName,
                                                        'old' => $oldValue,
                                                        'new' => $newValue
                                                    ];
                                                }
                                            }
                                        @endphp
                                        @if(count($changes) > 0)
                                            @foreach(array_slice($changes, 0, 3) as $change)
                                                <div class="mb-1 p-2 bg-yellow-50 rounded border-r-2 border-yellow-400">
                                                    <div class="text-xs font-medium text-gray-700">{{ $change['field'] }}</div>
                                                    <div class="text-xs text-gray-600">
                                                        <span class="line-through text-red-500">{{ $change['old'] }}</span>
                                                        <span class="mx-1">→</span>
                                                        <span class="text-green-600 font-medium">{{ $change['new'] }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if(count($changes) > 3)
                                                <div class="text-xs text-gray-500 mt-1">و {{ count($changes) - 3 }} تغيير آخر...</div>
                                            @endif
                                        @else
                                            <span class="text-xs text-gray-500">لا توجد تغييرات</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-1">
                                        <button onclick="viewDetails({{ $request->id }})" 
                                                class="inline-flex items-center p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors" 
                                                title="عرض التفاصيل">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <form action="{{ route('pending.approve', $request->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center p-2 text-green-600 hover:text-green-900 hover:bg-green-50 rounded-lg transition-colors" 
                                                    title="موافقة">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        <button onclick="openRejectModal({{ $request->id }})" 
                                                class="inline-flex items-center p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors" 
                                                title="رفض">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                                            </svg>
                                        </button>
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

    <!-- Details Modal -->
    <div id="detailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">تفاصيل طلب التعديل</h3>
                    <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="detailsContent">
                    <!-- سيتم ملء المحتوى بواسطة JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <form id="rejectForm" method="POST">
                @csrf
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">رفض الطلب</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">سبب الرفض</label>
                        <textarea name="rejection_reason" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                  placeholder="أدخل سبب رفض الطلب..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeRejectModal()" 
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            إلغاء
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            رفض الطلب
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const requests = @json($requests);
        const ranks = @json($ranks);
        const employmentStatuses = @json($employmentStatuses);
        
        function viewDetails(requestId) {
            const request = requests.find(r => r.id === requestId);
            if (!request) return;
            
            const fieldNames = {
                'name': 'الاسم',
                'national_id': 'الرقم الوطني',
                'file_number': 'رقم الملف',
                'file_type': 'نوع الملف',
                'birth_date': 'تاريخ الميلاد',
                'birth_place': 'مكان الميلاد',
                'gender': 'الجنس',
                'mother_name': 'اسم الأم',
                'mother_nationality': 'جنسية الأم',
                'blood_type': 'فصيلة الدم',
                'personal_card_number': 'رقم البطاقة',
                'passport_number': 'رقم الجواز',
                'military_number': 'الرقم العسكري',
                'military_rank_id': 'الرتبة',
                'work_authority': 'جهة العمل',
                'work_location': 'مكان العمل'
            };
            
            let content = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-3">البيانات الحالية</h4>
                        <div class="space-y-2">`;
            
            Object.entries(request.original_data).forEach(([key, value]) => {
                if (value && fieldNames[key]) {
                    let displayValue = value;
                    if(key === 'military_rank_id' && ranks[value]) {
                        displayValue = ranks[value];
                    } else if(key === 'employment_status_id' && employmentStatuses[value]) {
                        displayValue = employmentStatuses[value];
                    }
                    content += `<div class="text-sm"><span class="font-medium">${fieldNames[key]}:</span> ${displayValue}</div>`;
                }
            });
            
            content += `</div></div><div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-3">البيانات الجديدة</h4>
                        <div class="space-y-2">`;
            
            Object.entries(request.new_data).forEach(([key, value]) => {
                if (fieldNames[key]) {
                    const isChanged = request.original_data[key] !== value;
                    const className = isChanged ? 'text-sm font-medium text-blue-600' : 'text-sm';
                    let displayValue = value || 'فارغ';
                    if(key === 'military_rank_id' && ranks[value]) {
                        displayValue = ranks[value];
                    } else if(key === 'employment_status_id' && employmentStatuses[value]) {
                        displayValue = employmentStatuses[value];
                    }
                    content += `<div class="${className}"><span class="font-medium">${fieldNames[key]}:</span> ${displayValue}</div>`;
                }
            });
            
            content += `</div></div></div>`;
            
            document.getElementById('detailsContent').innerHTML = content;
            document.getElementById('detailsModal').classList.remove('hidden');
            document.getElementById('detailsModal').classList.add('flex');
        }
        
        function closeDetailsModal() {
            document.getElementById('detailsModal').classList.add('hidden');
            document.getElementById('detailsModal').classList.remove('flex');
        }
        
        function openRejectModal(requestId) {
            document.getElementById('rejectForm').action = `/pending/${requestId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }
        
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
        }
        
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
        
        document.getElementById('detailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailsModal();
            }
        });
    </script>
</x-layout>