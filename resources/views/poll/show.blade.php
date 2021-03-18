@extends('layouts.app')

@section('page', 'Dashboard')

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>: {{ $poll->title }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Deskripsi</td>
                            <td>: {{ $poll->description }}</td>
                        </tr>
                        <tr>
                            <td>Deadline</td>
                            <td>: {{ $poll->deadline }}</td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#modal-choice">Add Pilihan</button>
                <table class="table table-bordered table-striped table-hover mt-5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pilihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $choices as $choice )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $choice->choice }}</td>
                                <td>
                                    <form action="{{ route('choice.destroy', $poll->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger" onclick="confirm('Yakin Hapus Data..??') ? this.parentElement.submit() : ''">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.card -->
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal-choice">
        <div class="modal-dialog">
            <form action="{{ route('choice.store') }}" method="post">
                @csrf
                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Pilihan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="choice">Nama Pilihan</label>
                            <input type="text" class="form-control" name="choice" id="choice">
                            @error('choice')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection