namespace {{ $namespace }};

class {{ ucfirst($model["class_name"]) }} implements BaseModelInterface{{ $model["product_interface"] }} {
    use BaseModelTrait;
    @if($model["is_product_class"])use ProductTrait;@endif

    private $table = '{{ $model["name"] }}';

@yield('body')
}