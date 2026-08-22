 <?php $__env->startSection('title',$incident->code); ?> <?php $__env->startSection('page-title','پرونده رویداد'); ?> <?php $__env->startSection('content'); ?>
<div class="grid gap-6 lg:grid-cols-[1fr_340px]"><section class="space-y-5"><div class="rounded-2xl border border-slate-200 bg-white p-6"><div class="flex items-start justify-between"><div><div class="text-xs text-slate-400"><?php echo e($incident->code); ?></div><h2 class="mt-2 text-xl font-black"><?php echo e($incident->title); ?></h2></div><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal51ed764111e345fc11534f121cfeb451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status','data' => ['status' => $incident->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($incident->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $attributes = $__attributesOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__attributesOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $component = $__componentOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__componentOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?></div><p class="mt-5 whitespace-pre-line text-sm leading-7"><?php echo e($incident->description); ?></p><div class="mt-5 rounded-xl bg-amber-50 p-4"><div class="text-xs font-bold text-amber-700">اقدامات فوری</div><p class="mt-2 text-sm"><?php echo e($incident->immediate_actions ?: 'ثبت نشده'); ?></p></div></div>
<?php if(auth()->user()->hasRole(['admin','hse_manager'])): ?><form method="post" action="<?php echo e(route('incidents.investigate',$incident)); ?>" class="rounded-2xl border border-slate-200 bg-white p-6"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><h3 class="font-black">بررسی و تحلیل علت ریشه‌ای</h3><p class="mt-1 text-xs text-slate-400">علل مستقیم، زمینه‌ای و سیستمی را ثبت کنید؛ از سرزنش فردی پرهیز شود.</p><textarea name="root_cause" rows="5" required class="mt-4 w-full rounded-xl border border-slate-200 bg-slate-50 p-4"><?php echo e($incident->root_cause); ?></textarea><div class="mt-4 flex gap-3"><select name="status" class="rounded-xl border border-slate-200 px-4 py-2 text-sm"><option value="investigating">در حال بررسی</option><option value="actions_pending">منتظر اجرای اقدامات</option><option value="closed">بسته شده</option></select><button class="rounded-xl bg-slate-900 px-5 py-2 text-sm font-bold text-white hover:bg-slate-700">ثبت نتیجه بررسی</button></div></form><?php endif; ?>
<div class="rounded-2xl border border-slate-200 bg-white p-6"><div class="flex justify-between"><h3 class="font-black">اقدامات پیشگیرانه و اصلاحی</h3><a href="<?php echo e(route('actions.create',['incident'=>$incident->id])); ?>" class="text-xs font-bold text-emerald-600">+ تعریف اقدام</a></div><div class="mt-4 divide-y"><?php $__empty_1 = true; $__currentLoopData = $incident->actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><a href="<?php echo e(route('actions.show',$a)); ?>" class="flex justify-between py-3"><div><b class="text-sm"><?php echo e($a->title); ?></b><div class="text-xs text-slate-400"><?php echo e($a->assignee->name); ?></div></div><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal51ed764111e345fc11534f121cfeb451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status','data' => ['status' => $a->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($a->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $attributes = $__attributesOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__attributesOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $component = $__componentOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__componentOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="py-6 text-center text-sm text-slate-400">اقدامی تعریف نشده است.</p><?php endif; ?></div></div></section><aside><div class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-6"><h3 class="font-black">مشخصات رویداد</h3><dl class="mt-5 space-y-4 text-sm"><?php $__currentLoopData = [['نوع',['incident'=>'حادثه','near_miss'=>'شبه‌حادثه','occupational_disease'=>'بیماری شغلی','environmental'=>'محیط‌زیستی'][$incident->type]],['واحد',$incident->department->name],['محل',$incident->location],['زمان',\Morilog\Jalali\Jalalian::fromCarbon($incident->occurred_at)->format('Y/m/d H:i')],['گزارش‌دهنده',$incident->reporter->name],['سطح آسیب',$incident->injury_level?:'—'],['روز از دست‌رفته',$incident->lost_days]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$k,$v]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="flex justify-between gap-4"><dt class="text-slate-400"><?php echo e($k); ?></dt><dd class="text-left font-bold"><?php echo e($v); ?></dd></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></dl></div></aside></div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\HSE\hse-manager\resources\views/incidents/show.blade.php ENDPATH**/ ?>