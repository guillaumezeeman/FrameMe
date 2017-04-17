<?php $__env->startSection('body'); ?>
    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var  array $columns
    */
    private $columns = [
    <?php $__currentLoopData = $model["columns"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
"<?php echo e($column["column_name"]); ?>" => [
    <?php $__currentLoopData = $column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    "<?php echo e($key); ?>" => "<?php echo e($attribute); ?>",
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ],
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
];

    /**
    * @var  array $keys
    */
    private $keys = [
    <?php $__currentLoopData = $model["keys"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    "<?php echo e($name); ?>",
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
];
    /*** The end of the auto generated logic. ***/

<?php $__env->stopSection(); ?>
<?php echo $__env->make($parent, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>