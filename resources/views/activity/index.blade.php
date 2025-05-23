{{-- @extends(view: 'layouts.app') --}}

@section('content')
    <h2>Log Aktivitas Gudang</h2>

    {{-- Filter Form --}}
    <form action="{{ route('activity.index') }}" method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <label for="user_filter" class="form-label">Filter User:</label>
            <select name="nama_id" id="user_filter" class="form-select">
                <option value="">-- Semua User --</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->nama_id }}" {{ request('nama_id') == $user->nama_id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->nama_id }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="date_filter" class="form-label">Filter Tanggal:</label>
            <input type="date" name="tanggal" id="date_filter" class="form-control" value="{{ request('tanggal') }}">
        </div>

        <div class="col-md-3">
            <label for="format" class="form-label">Format Export:</label>
            <select name="format" id="format" class="form-select">
                <option value="xlsx" {{ request('format') === 'xlsx' ? 'selected' : '' }}>Excel (.xlsx)</option>
                <option value="csv" {{ request('format') === 'csv' ? 'selected' : '' }}>CSV (.csv)</option>
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('activity.index') }}" class="btn btn-secondary me-2">Reset</a>
            <button formaction="{{ route('activity.export') }}" formmethod="GET" class="btn btn-success">📤 Export</button>
        </div>
    </form>

    {{-- Table Logs --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Keterangan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->user->name ?? '-' }} ({{ $log->nama_id }})</td>
                    <td>{{ $log->aktivitas }}</td>
                    <td>{{ $log->keterangan }}</td>
                    <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
@endsection
