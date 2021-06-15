<div class="card">
    @if (isset($header))
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="m-0">{{ $header }}</h4>

            @if (isset($headerActions))
                <div class="card-header-actions btn btn-success">
                    {{ $headerActions }}
                </div><!--card-header-actions-->
            @endif
        </div><!--card-header-->
    @endif

    @if (isset($body))
        <div class="card-body">
            {{ $body }}
        </div><!--card-body-->
    @endif

    @if (isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div><!--card-footer-->
    @endif
</div><!--card-->
