<!-- Sidebar -->
<div class="fixed top-4 right-4 bottom-4 w-64 glass-effect shadow-2xl rounded-2xl z-50">
    <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center mb-12">
            <div class="w-10 h-10 bg-gradient-to-br from-primary to-dark-blue-800 rounded-xl flex items-center justify-center ml-3 shadow-md">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-xl font-bold bg-gradient-to-r from-primary to-dark-blue-800 bg-clip-text text-transparent">نظام الإدارة</span>
        </div>
        
        <!-- Menu Label -->
        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">القائمة</div>
        
        <!-- Navigation -->
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('persons.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('persons.index') ? 'bg-gradient-to-r from-primary/10 to-dark-blue-100 text-primary border-r-2 border-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('persons.index') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <span>لوحة التحكم</span>
            </a>
            
            <!-- Pending Requests -->
            <a href="{{ route('pending.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('pending.index') ? 'bg-gradient-to-r from-primary/10 to-dark-blue-100 text-primary border-r-2 border-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('pending.index') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span>الطلبات المعلقة</span>
            </a>

            <!-- Officers -->
            <a href="{{ route('officers.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('officers.*') ? 'bg-gradient-to-r from-primary/10 to-dark-blue-100 text-primary border-r-2 border-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('officers.*') ? 'text-primary' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                </div>
                <span>الضباط</span>
            </a>

            <!-- Non-Commissioned Officers -->
            <a href="{{ route('non-commissioned-officers.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('non-commissioned-officers.*') ? 'bg-gradient-to-r from-yellow-50 to-yellow-100 text-yellow-700 border-r-2 border-yellow-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('non-commissioned-officers.*') ? 'text-yellow-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span>ضباط الصف</span>
            </a>

            <!-- Employees -->
            <a href="{{ route('employees.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('employees.*') ? 'bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 border-r-2 border-purple-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-5 h-5 ml-3 {{ request()->routeIs('employees.*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                </div>
                <span>الموظفين</span>
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
                <a href="{{ route('persons.change-officer-rank') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-gray-900">تغيير رتب الضباط</span>
                </a>
                
                <a href="{{ route('persons.change-nco-rank') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-gray-900">تغيير رتب ضباط الصف</span>
                </a>
                
                <a href="{{ route('persons.change-employee-rank') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-5 h-5 ml-3 text-gray-400 group-hover:text-gray-600">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-gray-900">تغيير رتب الموظفين</span>
                </a>
                
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