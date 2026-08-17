 <?php $__env->startSection('title','رویدادها'); ?> <?php $__env->startSection('page-title','حوادث و شبه‌حوادث'); ?> <?php $__env->startSection('content'); ?>
<div class="mb-5 flex items-center justify-between"><div><h2 class="text-xl font-black">گزارش رویدادهای HSE</h2><p class="mt-1 text-sm text-slate-500">ثبت سریع، بررسی علت و جلوگیری از تکرار رویدادها</p></div><a href="<?php echo e(route('incidents.create')); ?>" class="rounded-xl bg-rose-600 px-4 py-3 text-sm font-bold text-white hover:bg-rose-700">+ گزارش رویداد</a></div><div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3"><?php $__empty_1 = true; $__currentLoopData = $incidents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><a href="<?php echo e(route('incidents.show',$i)); ?>" class="rounded-2xl border border-slate-200 bg-white p-5 transition hover:-translate-y-0.5 hover:shadow-lg"><div class="flex items-start justify-between"><span class="rounded-lg <?php echo e($i->type==='near_miss'?'bg-amber-100 text-amber-700':'bg-rose-100 text-rose-700'); ?> px-2.5 py-1 text-[11px] font-bold"><?php echo e(['incident'=>'حادثه','near_miss'=>'شبه‌حادثه','occupational_disease'=>'بیماری شغلی','environmental'=>'رویداد محیط‌زیستی'][$i->type]); ?></span><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal51ed764111e345fc11534f121cfeb451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status','data' => ['status' => $i->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($i->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $attributes = $__attributesOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__attributesOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $component = $__componentOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__componentOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?></div><h3 class="mt-4 font-black"><?php echo e($i->title); ?></h3><p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500"><?php echo e($i->description); ?></p><div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-xs text-slate-400"><span><?php echo e($i->department->name); ?></span><span><?php echo \Morilog\Jalali\Jalalian::fromCarbon($i->occurred_at)->format('Y/m/d H:i'); ?></span></div></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="col-span-full rounded-2xl border border-dashed p-12 text-center text-slate-400">هنوز رویدادی گزارش نشده است.</div><?php endif; ?></div><div class="mt-5"><?php echo e($incidents->links()); ?></div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\HSE\hse-manager\resources\views/incidents/index.blade.php ENDPATH**/ ?>