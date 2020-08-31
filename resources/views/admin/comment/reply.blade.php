@foreach($comment as $row)
@if($row->parent_id == "")
	@php $m = 0 @endphp
@else
	@php $m = 20 @endphp
@endif

<div class="mt-4 reply" style="margin-left: {{ $m }}px">
	{!! Str::limit($row->comment, '300') !!}
</div>
@include('admin.comment.reply', ['comment' => $row->replies, 'm' => $m,])
@endforeach
 