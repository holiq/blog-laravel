@if ($paginator->hasPages())
	<nav>
		<ul class="pagination justify-content-center flex-wrap">
			{{-- Previous Page Link --}}
			@if ($paginator->onFirstPage())
				<li class="page-item mb-2 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
					<span class="page-link" aria-hidden="true">&lsaquo;</span>
				</li>
			@else
				<li class="page-item mb-2">
					<a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
				</li>
			@endif

			{{-- Pagination Elements --}}
			@foreach ($elements as $element)
				<!-- Array Of Links -->
				@if(is_array($element))
				@foreach ($element as $page => $url)
				<!--  Use three dots when current page is greater than 4.  -->
					@if ($paginator->currentPage() > 4 && $page === 2)
						<li class="page-item mb-2 disabled"><span class="page-link">...</span></li>
					@endif

					<!--  Show active page else show the first and last two pages from current page.  -->
					@if ($page == $paginator->currentPage())
						<li class="page-item mb-2 active"><span class="page-link">{{ $page }}</span></li>
					@elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
							<li class="page-item mb-2"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
					@endif

					<!--  Use three dots when current page is away from end.  -->
					@if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
						<li class="page-item mb-2 disabled"><span class="page-link">...</span></li>
					@endif
				@endforeach
				@endif
			@endforeach

			{{-- Next Page Link --}}
			@if ($paginator->hasMorePages())
				<li class="page-item mb-2">
					<a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
				</li>
			@else
				<li class="page-item mb-2 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
					<span class="page-link" aria-hidden="true">&rsaquo;</span>
				</li>
			@endif
		</ul>
	</nav>
@endif
