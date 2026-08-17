 <?php $__env->startSection('title','بازرسی‌ها'); ?> <?php $__env->startSection('page-title','مدیریت بازرسی‌ها'); ?> <?php $__env->startSection('content'); ?>
<div class="mb-5 flex items-center justify-between"><div><h2 class="text-xl font-black">برنامه و سوابق بازرسی</h2><p class="mt-1 text-sm text-slate-500">برنامه‌ریزی، اجرا و پایش نتایج بازرسی‌های HSE</p></div><a href="<?php echo e(route('inspections.create')); ?>" class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">+ برنامه‌ریزی بازرسی</a></div>
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white"><div class="overflow-x-auto"><table class="w-full min-w-[850px] text-right text-sm"><thead class="bg-slate-50 text-xs text-slate-500"><tr><th class="p-4">کد / عنوان</th><th>نوع چک‌لیست</th><th>واحد</th><th>بازرس</th><th>زمان برنامه</th><th>امتیاز</th><th>وضعیت</th></tr></thead><tbody class="divide-y divide-slate-100"><?php $__empty_1 = true; $__currentLoopData = $inspections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr class="hover:bg-slate-50"><td class="p-4"><a href="<?php echo e(route('inspections.show',$i)); ?>" class="font-bold hover:text-emerald-600"><?php echo e($i->title); ?></a><div class="text-[11px] text-slate-400"><?php echo e($i->code); ?></div></td><td><?php echo e($i->checklist->category); ?></td><td><?php echo e($i->department->name); ?></td><td><?php echo e($i->inspector->name); ?></td><td><?php echo \Morilog\Jalali\Jalalian::fromCarbon($i->scheduled_at)->format('Y/m/d H:i'); ?></td><td><?php if($i->score!==null): ?><b class="<?php echo e($i->score<70?'text-rose-600':'text-emerald-600'); ?>"><?php echo e($i->score); ?>٪</b><?php else: ?>—<?php endif; ?></td><td><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
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
<?php endif; ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7" class="p-12 text-center text-slate-400">هنوز بازرسی ثبت نشده است.</td></tr><?php endif; ?></tbody></table></div><div class="border-t border-slate-100 p-4"><?php echo e($inspections->links()); ?></div></div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\HSE\hse-manager\resources\views/inspections/index.blade.php ENDPATH**/ ?>