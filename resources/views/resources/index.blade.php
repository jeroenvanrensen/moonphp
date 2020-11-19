@extends('moon::layouts.app')

@section('title', $title)

@section('content')
    <h1 class="mb-6 text-3xl font-semibold">{{ $title }}</h1>

    <table class="table-auto w-full bg-white shadow rounded-lg">
        <tr>
            <th class="py-2 px-6 text-left">ID</th>
        </tr>
        @foreach($rows as $row)
            @if($loop->odd)
                <tr class="bg-gray-100 border-t border-gray-200 hover:bg-gray-200">
            @else
                <tr class="border-t border-gray-200 hover:bg-gray-200">
            @endif
                    <td class="py-2 px-6">{{ $row->id }}</td>
                </tr>
        @endforeach
    </table>
@endsection