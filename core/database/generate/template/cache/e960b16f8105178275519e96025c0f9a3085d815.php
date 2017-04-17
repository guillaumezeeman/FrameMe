<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(image('favicon.ico')); ?>">

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/bin/generate/base.css')); ?>" type="text/css" rel="stylesheet">

    <title>iValue</title>
</head>
<body>
<div class="main-container container">

    <h1 class="script-name">Model generator</h1>
    <div class="content">

        <div class="row description">
            <table>
                <tbody>
                <tr>
                    <td class="description-title">Database name:</td>
                    <td class="description-value"><?php echo e($schema); ?></td>
                </tr>
                <tr>
                    <td class="description-title">Number of models:</td>
                    <td class="description-value"><?php echo e(count($models)); ?></td>
                </tr>
                <tr>
                    <td class="description-title">Number of new models:</td>
                    <td class="description-value"><?php echo e($new_models); ?></td>
                </tr>
                </tbody>
            </table>
        </div>

        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="table row">
                <div class="table-header">
                    <div class="title"><?php echo e($model["class_name"]); ?> : <?php echo e($model["name"]); ?></div>
                    <div class="button-group">
                        <i class="close-table-btn fa fa-minus"></i>
                        <i class="close-table-btn fa fa-times"></i>
                    </div>
                </div>
                <div class="columns">

                    <table class="column-table">
                        <thead>
                        <th><div>Column</div></th>
                        <th><div>Type</div></th>
                        <th><div>Default</div></th>
                        <th><div>Nullable</div></th>
                        <th><div>Extra</div></th>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $model["columns"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($column["column_name"]); ?></td>
                                <td><?php echo e($column["data_type"]); ?></td>
                                <td><?php echo e($column["default"]); ?></td>
                                <td><?php echo e(ucfirst($column["is_nullable"])); ?></td>
                                <td><?php echo e($column["extra"]); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
</body>
</html>