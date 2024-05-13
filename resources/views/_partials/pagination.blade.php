<p class="m-0 text-muted">Showing <span>{{ $paginator->firstItem() }}</span> <span>to</span> <span>{{ $paginator->lastItem() }}</span> <span>of</span> <span>{{ $paginator->total() }}</span> entries</p>
<ul class="pagination m-0 ms-auto">
  <li class="page-item {{ $paginator->onFirstPage() ? 'disabled me-2' : '' }}" wire:loading.class="disabled">
    <span class="page-link" wire:click="previousPage" {{ $paginator->onFirstPage() ? 'aria-disabled="true"' : '' }}>
      <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
      prev
    </span>
  </li>
  @foreach ($elements as $element)
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page === $paginator->currentPage())
          <li wire:loading.class="disabled" class="page-item active"><span class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</span></li>
        @else
          <li wire:loading.class="disabled" class="page-item"><span class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</span></li>
        @endif
      @endforeach
    @endif
  @endforeach
  <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled ms-2' }}" wire:loading.class="disabled">
    <span class="page-link" wire:click="nextPage" {{ $paginator->hasMorePages() ? '' : 'aria-disabled="true"' }}>
      next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>
    </span>
  </li>
</ul>
