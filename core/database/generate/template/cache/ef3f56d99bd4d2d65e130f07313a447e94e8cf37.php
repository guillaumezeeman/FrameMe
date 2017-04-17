namespace <?php echo e($namespace); ?>;

class <?php echo e(ucfirst($model["class_name"])); ?> implements BaseModelInterface<?php echo e($model["product_interface"]); ?> {
    use BaseModelTrait;
    <?php if($model["is_product_class"]): ?>use ProductTrait;<?php endif; ?>

    private $table = '<?php echo e($model["name"]); ?>';

<?php echo $__env->yieldContent('body'); ?>
}