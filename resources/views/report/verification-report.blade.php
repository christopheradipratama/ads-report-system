@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verification') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/verify-report/' . $report->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="status"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select type="text" name="status" class="form-control" id="status">
                                        <option value="{{ $report->status }}" selected hidden>{{ $report->status }}</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Proses Administratif">Proses Administratif</option>
                                        <option value="Proses Penanganan">Proses Penanganan</option>
                                        <option value="Selesai Ditangani">Selesai Ditangani</option>
                                        <option value="Laporan Ditolak">Laporan Ditolak</option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select type="text" name="category_id" class="form-control" id="category_id">
                                        <option selected hidden></option>
                                        @foreach ($categories as $items)
                                            <option value="{{ $items->id }}">{{ $items->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="note"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Note') }}</label>

                                <div class="col-md-6">
                                    <input id="note" type="text"
                                        class="form-control @error('note') is-invalid @enderror" name="note"
                                        value="{{ old('note') }}" required autocomplete="note" autofocus>

                                    @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
