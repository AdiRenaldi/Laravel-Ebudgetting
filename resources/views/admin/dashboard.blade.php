@extends('layouts.mainlayout')

@section('title', 'Dasboard')
@section('judul', 'Admin')

@section('content')
<div class="row W-50 mt-2">
    <div class="col-6">
    <h2 class="text-center mb-3">DATA RENMIN</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAMA</th>
            <th scope="col">PANGKAT</th>
            <th scope="col">EMAIL</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($renmin) > 0)
            @foreach ($renmin as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->pangkat }}</td>
                <td>{{ $item->email }}</td>
              </tr>
              @endforeach
          @else
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>
          @endif
        </tbody>    
    </table>

    <h2 class="text-center mb-3 mt-5">DATA SPN</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAMA</th>
            <th scope="col">PANGKAT</th>
            <th scope="col">EMAIL</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($spn) > 0)
            @foreach ($spn as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->pangkat }}</td>
                <td>{{ $item->email }}
              </tr>
              @endforeach
          @else
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>
          @endif
        </tbody>    
    </table>

    <h2 class="text-center mb-3 mt-5">DATA STAF</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAMA</th>
            <th scope="col">PANGKAT</th>
            <th scope="col">EMAIL</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @if (count($staf) > 0)
            @foreach ($staf as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->pangkat }}</td>
                <td>{{ $item->email }}
              </tr>
              @endforeach
          @else
          <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr>
          @endif
        </tbody>    
    </table>
    </div>
</div>
@endsection