@extends('layouts.app')

@section('page', 'Dashboard')

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
            <div class="row">
                @if( session('role') == 'admin' )
                    @foreach($polls as $poll)
                    <div class="col-12">
                        <h2>{{ $poll->title }}</h2>
                        <small>Created by : {{ $poll->name }} | deadline : {{ $poll->deadline }}</small>
                        <h5 class="mb-5 mt-3">{{ $poll->description }}</h5>
                        <div class="row">
                            <?php $choice = App\Models\Choice::where('poll_id', $poll->id)->get() ?>
                            <?php $voteCount = App\Models\Vote::join('polls', 'polls.id', '=', 'votes.poll_id')->where('poll_id', $poll->id)->get()->count() ?>
                            @if( $voteCount !== 0 )
                            @foreach( $choice as $item )
                            <?php $vote = App\Models\Vote::where('choice_id', $item->id)->get(); ?>
                            @if( $vote->count() !== 0 )
                            <?php $total = $vote->count() / $voteCount * 100; ?>
                            @else 
                            <?php $total = 0 ?>
                            @endif
                            <div class="col-6 pt-1">
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $total }}%"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="progress-description">
                                    {{ $item->choice }}
                                    <br>
                                    {{ $total }} %
                                </span> 
                            </div>
                            @endforeach
                            @else
                                <h2>Belum Ada Yang Memilih</h2>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else 
                    @foreach($pollUsers as $poll)
                        <div class="col-12">
                            <h2>{{ $poll->title }}</h2>
                            <small>Created by : {{ $poll->name }} | deadline : {{ $poll->deadline }}</small>
                            <h5 class="mb-3 mt-3">{{ $poll->description }}</h5>
                            <div class="row">
                                <?php $checkStatus = App\Models\Vote::where(['poll_id' => $poll->id, 'user_id' => session('id')])->first() ?>
                                @if( $checkStatus )
                                    <h2>Anda Sudah Memilih</h2>
                                @else
                                    <?php $choice = App\Models\Choice::where('poll_id', $poll->id)->get() ?>
                                    @foreach( $choice as $item )
                                        <div class="col-6 py-1">
                                            <h6>{{ $item->choice }}</h6>
                                        </div>
                                        <div class="col-6 py-1">
                                            <form action="{{ route('vote.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="choice_id" value="{{ $item->id }}">
                                                <input type="hidden" name="user_id" value="{{ session('id') }}">
                                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                                <input type="hidden" name="division_id" value="{{ session('division_id') }}">
                                                <button type="button" class="btn btn-success btn-sm" onclick="confirm('Yakin Pilih Ini..??') ? this.parentElement.submit() : ''">Pilih</button>
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            </div>
        </div><!-- /.card -->
    </div>
@endsection

@section('modal')
    
@endsection