@extends($parent)

@section('body')
    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var array $columns
    */
    private $columns = [
    @foreach ($model["columns"] as $column)
        "{{ $column["column_name"] }}",
    @endforeach
    ];

    @foreach($model["columns"] as $column)
        /**
        * @var {{ $column["data_type"] }} {{ $column["column_name"] }}
        */
        private ${{ $column["column_name"] }};

    @endforeach
    @foreach($model["columns"] as $column)
        /**
        * @param {{ $column["data_type"] }} {{ $column["column_name"] }}
        *
        * @return {{ $column["data_type"] }}
        */
        public function get_{{ $column["column_name"] }} () {
        return $this->{{ $column["column_name"] }};
        }

        /**
        * @param {{ $column["data_type"] }} {{ $column["column_name"] }}
        */
        public function set_{{ $column["column_name"] }} (${{ $column["column_name"] }}) {
        $this->{{ $column["column_name"] }} = ${{ $column["column_name"] }};
        }

    @endforeach
    /*** The end of the auto generated logic. ***/
@stop