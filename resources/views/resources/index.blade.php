<h1 class="mb-6 text-3xl font-semibold">{{ $title }}</h1>

<table class="w-full bg-white shadow rounded-lg">
    <!-- Table heading -->
    <tr>
        @foreach($columns as $column)
            <th class="py-2 px-6 text-left">{{ $column['label'] }}</th>
        @endforeach
    </tr>

    <!-- Table Body -->
    @foreach($rows as $row)
        @if($loop->odd)
            <tr class="bg-gray-100 border-t border-gray-200 hover:bg-gray-200">
        @else
            <tr class="border-t border-gray-200 hover:bg-gray-200">
        @endif
        
            @foreach($columns as $column)
                <td class="py-2 px-6">{{ $row->{$column['column']} }}</td>
            @endforeach
        </tr>
    @endforeach
</table>