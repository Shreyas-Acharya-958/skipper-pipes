@if ($blogs->hasPages())
    <div class="row">
        <div class="col-md-12 pagi-area text-center ml-auto">
            <nav aria-label="navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" data-page="{{ $blogs->currentPage() - 1 }}"><i
                                class="fas fa-angle-double-left"></i></a></li>
                    @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                        <li class="page-item {{ $i == $blogs->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item"><a class="page-link" href="#"
                            data-page="{{ $blogs->currentPage() + 1 }}"><i class="fas fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endif
