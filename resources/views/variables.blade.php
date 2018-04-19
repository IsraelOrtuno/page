<div class="vars">
    <div class="small text-uppercase text-muted font-weight-bold">Available SEO variables</div>
    <div class="variables d-flex flex-row mb-3">
        @foreach ($seo as $key => $value)
            <div class="variable mr-3">
                <div class="badge badge-danger">
                    ${{ $key }}
                </div>
                @if (is_object($value))
                    <div class="small">{{ get_class($value) }}</div>
                @else
                    <div class="small">{{ gettype($value) }}</div>
                @endif
            </div>
        @endforeach
    </div>
</div>