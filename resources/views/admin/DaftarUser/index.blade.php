@extends('site.layouts.app')

@section('title', 'Daftar User)

@section('content')
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Nama Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($User as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection