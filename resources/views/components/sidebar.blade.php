<!-- Sidebar -->
<div class="fixed top-4 right-4 bottom-4 w-64 bg-white shadow-md rounded-2xl z-50">
    <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center mb-12">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center ml-3">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-xl font-bold text-gray-900">نظام الإدارة</span>
        </div>
        
        <!-- Menu Label -->
        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">القائمة</div>
        
        <!-- Navigation -->
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('persons.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('persons.index') ? 'relative' : 'hover:bg-gray-50 transition-colors' }}">
                @if(request()->routeIs('persons.index'))
                    <div class="absolute right-0 top-0 bottom-0 w-1 bg-primary rounded-l-lg"></div>
                @endif
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('persons.index') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <span class="{{ request()->routeIs('persons.index') ? 'text-gray-900' : 'text-gray-600 group-hover:text-gray-900' }}">لوحة التحكم</span>
            </a>
            
            <!-- Pending Requests -->
            <a href="{{ route('pending.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('pending.index') ? 'relative' : 'hover:bg-gray-50 transition-colors' }}">
                @if(request()->routeIs('pending.index'))
                    <div class="absolute right-0 top-0 bottom-0 w-1 bg-primary rounded-l-lg"></div>
                @endif
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('pending.index') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="{{ request()->routeIs('pending.index') ? 'text-gray-900' : 'text-gray-600 group-hover:text-gray-900' }}">الطلبات المعلقة</span>
            </a>
            
            <!-- Add Person -->
            <a href="{{ route('persons.create') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('persons.create') ? 'relative' : 'hover:bg-gray-50 transition-colors' }}">
                @if(request()->routeIs('persons.create'))
                    <div class="absolute right-0 top-0 bottom-0 w-1 bg-primary rounded-l-lg"></div>
                @endif
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('persons.create') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <span class="{{ request()->routeIs('persons.create') ? 'text-gray-900' : 'text-gray-600 group-hover:text-gray-900' }}">إضافة شخص</span>

            </a>
            
            <!-- Reports -->
            <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span class="text-gray-600 group-hover:text-gray-900">التقارير</span>
            </a>
            
            <!-- Analytics -->
            <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-gray-600 group-hover:text-gray-900">الإحصائيات</span>
            </a>
            
            <!-- Settings -->
            <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-gray-600 group-hover:text-gray-900">الإعدادات</span>
            </a>
        </nav>
        
        <!-- General Section -->
        <div class="mt-8">
            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">عام</div>
            <nav class="space-y-1">
                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-gray-900">المساعدة</span>
                </a>
                
                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-gray-900">تسجيل الخروج</span>
                </a>
            </nav>
        </div>
    </div>
</div>