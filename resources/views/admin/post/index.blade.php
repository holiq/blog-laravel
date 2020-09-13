@extends('admin.layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1 class="m-0 text-dark">Discussions</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Home</a></div>
            <div class="breadcrumb-item">Post</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Post</h2>
        <p class="section-lead">
            On this page you manage post.
        </p>
        <div class="card">
            <div class="card-header">
                <h4>List Post</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <form action="?" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->search }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                      <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                      <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Total Views</th>
                                <th>Total Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($post as $row)
                            <tr>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                        <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    {{ Str::limit($row->title, 25) }}
                                    <div class="table-links">
                                        <a href="#">View</a>
                                        <div class="bullet"></div>
                                        <a href="#">Edit</a>
                                        <div class="bullet"></div>
                                        <a class="text-danger" onclick="event.preventDefault(); document.getElementById('delete-post').submit();">Delete</a>
                                        <form id="delete-post" action="{{ route('posts.destroy', $row->id) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $row->category->name }}</td>
                                <td>
                                    @foreach($row->tags as $tag)
                                        {{ $tag->name }},
                                    @endforeach
                                </td>
                                <td>{{ $row->user->name }}</td>
                                <td class="text-nowrap">{{ $row->created_at->format('M-d-y H:i') }}</td>
                                <td>
                                    <div class="badge badge-{{ $row->status === 'pending' ? 'warning':'primary' }}">{{ $row->status }}</div>
                                </td>
                                <td>{{ $row->views }}</td>
                                <td>{{ $row->countComment->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Post doesn't exits</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $post->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>    
</section>
@endsection
@push('javascript')
<script>
$("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});
</script>
@endpush