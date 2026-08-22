 <?php $__env->startSection('title',$risk->code); ?> <?php $__env->startSection('page-title','جزئیات ریسک'); ?> <?php $__env->startSection('content'); ?>
<div class="grid gap-6 lg:grid-cols-[1fr_320px]"><section class="space-y-5"><div class="rounded-2xl border border-slate-200 bg-white p-6"><div class="flex items-start justify-between"><div><div class="text-xs text-slate-400"><?php echo e($risk->code); ?> · <?php echo e($risk->category); ?></div><h2 class="mt-2 text-xl font-black"><?php echo e($risk->title); ?></h2></div><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal51ed764111e345fc11534f121cfeb451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status','data' => ['status' => $risk->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($risk->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $attributes = $__attributesOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__attributesOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $component = $__componentOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__componentOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?></div><p class="mt-5 whitespace-pre-line text-sm leading-7 text-slate-600"><?php echo e($risk->description); ?></p><div class="mt-6 grid gap-4 md:grid-cols-2"><div class="rounded-xl bg-slate-50 p-4"><div class="text-xs font-bold text-slate-400">کنترل‌های موجود</div><p class="mt-2 text-sm leading-6"><?php echo e($risk->existing_controls ?: 'ثبت نشده'); ?></p></div><div class="rounded-xl bg-emerald-50 p-4"><div class="text-xs font-bold text-emerald-700">کنترل‌های پیشنهادی</div><p class="mt-2 text-sm leading-6"><?php echo e($risk->proposed_controls ?: 'ثبت نشده'); ?></p></div></div></div><div class="rounded-2xl border border-slate-200 bg-white p-6"><div class="flex items-center justify-between"><h3 class="font-black">اقدامات کنترلی مرتبط</h3><a href="<?php echo e(route('actions.create',['risk'=>$risk->id])); ?>" class="text-xs font-bold text-emerald-600">+ تعریف اقدام</a></div><div class="mt-4 divide-y"><?php $__empty_1 = true; $__currentLoopData = $risk->actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><a class="flex items-center justify-between py-3 text-sm" href="<?php echo e(route('actions.show',$a)); ?>"><div><b><?php echo e($a->title); ?></b><div class="text-xs text-slate-400"><?php echo e($a->assignee->name); ?> · <?php echo \Morilog\Jalali\Jalalian::fromCarbon($a->due_date)->format('Y/m/d'); ?></div></div><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
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
<?php endif; ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="py-6 text-center text-sm text-slate-400">اقدام مرتبطی تعریف نشده است.</p><?php endif; ?></div></div></section><aside><div class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-6"><div class="text-center"><div class="mx-auto grid h-24 w-24 place-items-center rounded-3xl <?php echo e($risk->risk_score>=17?'bg-rose-100 text-rose-700':($risk->risk_score>=10?'bg-orange-100 text-orange-700':'bg-amber-100 text-amber-700')); ?>"><span class="text-4xl font-black"><?php echo e($risk->risk_score); ?></span></div><div class="mt-3 text-lg font-black">ریسک <?php echo e($risk->risk_level); ?></div></div><dl class="mt-6 space-y-3 text-sm"><div class="flex justify-between"><dt class="text-slate-400">احتمال</dt><dd class="font-bold"><?php echo e($risk->likelihood); ?> از ۵</dd></div><div class="flex justify-between"><dt class="text-slate-400">شدت</dt><dd class="font-bold"><?php echo e($risk->severity); ?> از ۵</dd></div><div class="flex justify-between"><dt class="text-slate-400">واحد</dt><dd class="font-bold"><?php echo e($risk->department->name); ?></dd></div><div class="flex justify-between"><dt class="text-slate-400">شناسایی‌کننده</dt><dd class="font-bold"><?php echo e($risk->reporter->name); ?></dd></div></dl></div></aside></div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\HSE\hse-manager\resources\views/risks/show.blade.php ENDPATH**/ ?>