 <?php $__env->startSection('title','ریسک‌ها'); ?> <?php $__env->startSection('page-title','خطرات و ارزیابی ریسک'); ?> <?php $__env->startSection('content'); ?>
<div class="mb-5 flex items-center justify-between"><div><h2 class="text-xl font-black">دفتر ثبت ریسک</h2><p class="mt-1 text-sm text-slate-500">شناسایی، امتیازدهی و پیگیری کنترل خطرات</p></div><a href="<?php echo e(route('risks.create')); ?>" class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">+ ثبت خطر جدید</a></div>
<div class="mb-4 flex flex-wrap gap-2"><?php $__currentLoopData = [''=>'همه','بحرانی'=>'بحرانی','زیاد'=>'زیاد','متوسط'=>'متوسط','کم'=>'کم']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(route('risks.index',['level'=>$v])); ?>" class="rounded-xl border px-4 py-2 text-xs font-bold <?php echo e(request('level','')===$v?'border-emerald-600 bg-emerald-600 text-white':'border-slate-200 bg-white'); ?>"><?php echo e($l); ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white"><div class="overflow-x-auto"><table class="w-full min-w-[800px] text-right text-sm"><thead class="bg-slate-50 text-xs text-slate-500"><tr><th class="p-4">خطر</th><th>دسته‌بندی</th><th>واحد</th><th>احتمال × شدت</th><th>امتیاز / سطح</th><th>وضعیت</th></tr></thead><tbody class="divide-y divide-slate-100"><?php $__empty_1 = true; $__currentLoopData = $risks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><tr><td class="p-4"><a class="font-bold hover:text-emerald-600" href="<?php echo e(route('risks.show',$r)); ?>"><?php echo e($r->title); ?></a><div class="text-[11px] text-slate-400"><?php echo e($r->code); ?></div></td><td><?php echo e($r->category); ?></td><td><?php echo e($r->department->name); ?></td><td><?php echo e($r->likelihood); ?> × <?php echo e($r->severity); ?></td><td><span class="inline-grid h-9 w-9 place-items-center rounded-xl <?php echo e($r->risk_score>=17?'bg-rose-100 text-rose-700':($r->risk_score>=10?'bg-orange-100 text-orange-700':($r->risk_score>=5?'bg-amber-100 text-amber-700':'bg-emerald-100 text-emerald-700'))); ?> font-black"><?php echo e($r->risk_score); ?></span> <b class="mr-2"><?php echo e($r->risk_level); ?></b></td><td><?php if (isset($component)) { $__componentOriginal51ed764111e345fc11534f121cfeb451 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal51ed764111e345fc11534f121cfeb451 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status','data' => ['status' => $r->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($r->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $attributes = $__attributesOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__attributesOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal51ed764111e345fc11534f121cfeb451)): ?>
<?php $component = $__componentOriginal51ed764111e345fc11534f121cfeb451; ?>
<?php unset($__componentOriginal51ed764111e345fc11534f121cfeb451); ?>
<?php endif; ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="p-12 text-center text-slate-400">ریسکی ثبت نشده است.</td></tr><?php endif; ?></tbody></table></div><div class="border-t p-4"><?php echo e($risks->links()); ?></div></div><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\HSE\hse-manager\resources\views/risks/index.blade.php ENDPATH**/ ?>