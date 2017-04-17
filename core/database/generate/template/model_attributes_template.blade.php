@extends($parent)

@section('body')
    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var array $columns
    */
    private $columns = [
    @foreach ($model["columns"] as $column)
"{{ $column["column_name"] }}" => [
    @foreach ($column as $key => $attribute)
    "{{ $key }}" => "{{ $attribute }}",
    @endforeach
    ],
    @endforeach
];

    /**
    * @var array $keys
    */
    private $keys = [
    @foreach ($model["keys"] as $key => $name)
    "{{ $name }}",
    @endforeach
];
    /*** The end of the auto generated logic. ***/

@stop