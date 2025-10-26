# دليل استخدام Components

تم إنشاء مجموعة من الـ Components المنفصلة لتسهيل إعادة الاستخدام وتجنب تكرار الكود.

## الـ Components المتاحة:

### 1. Layout Component (`x-layout`)
الـ Layout الأساسي للصفحات

```blade
<x-layout title="عنوان الصفحة">
    <!-- محتوى الصفحة -->
    
    <x-slot name="head">
        <!-- إضافات إضافية للـ head -->
    </x-slot>
    
    <x-slot name="scripts">
        <!-- سكريبتات إضافية -->
    </x-slot>
</x-layout>
```

### 2. Sidebar Component (`x-sidebar`)
الشريط الجانبي مع القائمة
- يتم تضمينه تلقائياً في الـ Layout
- يعرض الروابط النشطة حسب الصفحة الحالية

### 3. Header Component (`x-header`)
رأس الصفحة مع العنوان والوصف

```blade
<x-header title="عنوان الصفحة" description="وصف الصفحة">
    <x-slot name="actions">
        <!-- أزرار أو إجراءات إضافية -->
    </x-slot>
</x-header>
```

### 4. Alert Component (`x-alert`)
عرض الرسائل والتنبيهات

```blade
<x-alert type="success" message="تم الحفظ بنجاح" />
<x-alert type="error" message="حدث خطأ" />
<x-alert type="warning" message="تحذير" />
<x-alert type="info" message="معلومة" />
```

### 5. Breadcrumb Component (`x-breadcrumb`)
مسار التنقل

```blade
<x-breadcrumb :items="[
    ['title' => 'الرئيسية', 'url' => route('home')],
    ['title' => 'الصفحة الحالية']
]" />
```

## مثال كامل لصفحة جديدة:

```blade
<x-layout title="صفحة جديدة">
    <x-breadcrumb :items="[
        ['title' => 'لوحة التحكم', 'url' => route('persons.index')],
        ['title' => 'صفحة جديدة']
    ]" />
    
    <x-header title="صفحة جديدة" description="وصف الصفحة">
        <x-slot name="actions">
            <a href="#" class="btn btn-primary">إجراء</a>
        </x-slot>
    </x-header>
    
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    
    <!-- محتوى الصفحة -->
    
    <x-slot name="scripts">
        <script>
            // سكريبتات خاصة بالصفحة
        </script>
    </x-slot>
</x-layout>
```

## الفوائد:

1. **تجنب تكرار الكود**: لا حاجة لإعادة كتابة الـ sidebar والـ layout في كل صفحة
2. **سهولة الصيانة**: تعديل واحد في الـ component يؤثر على جميع الصفحات
3. **التناسق**: جميع الصفحات تستخدم نفس التصميم والهيكل
4. **المرونة**: يمكن تخصيص كل component حسب الحاجة
5. **سهولة الإضافة**: إضافة صفحات جديدة أصبح أسرع وأبسط

## ملاحظات:

- جميع الـ Components موجودة في مجلد `resources/views/components/`
- يتم استدعاؤها باستخدام `<x-component-name>`
- يمكن تمرير البيانات إليها كـ attributes أو slots
- الـ sidebar يعرض الصفحة النشطة تلقائياً باستخدام `request()->routeIs()`