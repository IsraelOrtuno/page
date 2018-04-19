@php use Skuad\Seo\Seo @endphp

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="row">
        <div class="col-md-6">
            {{--<metas></metas>--}}
        </div>
        <div class="col-md-6 border-left">
            <div class="seo-preview">
                <div class="seo-preview__title">{{ $__seo->meta->title }}</div>
                <div class="seo-preview__link">{{ request()->url() }}</div>
                <div class="seo-preview__description">{{ $__seo->meta->description }}</div>
            </div>
        </div>
    </div>
</div>