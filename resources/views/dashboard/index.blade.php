@extends('layouts.app')

@section('page', 'Dashboard')

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-header">
                <h3>Selamat Datang {{ session('name') }}</h3>
            </div>
            @if(session('role') !== 'admin')
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-poll">Add Vote</button>
            </div>
            @endif
        </div><!-- /.card -->
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal-poll">
        <div class="modal-dialog">
            <form action="{{ route('poll.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Polling</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Tanggal Deadline</label>
                            <input type="date" class="form-control" name="date" id="date">
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="time">Jam Deadline</label>
                            <input type="time" class="form-control" name="time" id="time">
                            @error('time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" name="title" id="title">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                            @error('description')
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