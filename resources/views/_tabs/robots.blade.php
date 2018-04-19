@php use Skuad\Seo\Seo @endphp

<div class="tab-pane fade" id="robots" role="tabpanel" aria-labelledby="robots-tab">
    <h5 class="text-uppercase text-muted">Robots</h5>

    <div class="form-group">
        <label for="">Meta robots index</label>
        {!! Form::select('seo[meta][robots][]', array_combine(Seo::ROBOTS_INDEX, Seo::ROBOTS_INDEX),
            $__seo->meta->robots ?? null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Meta robots follow</label>
        {!! Form::select('seo[meta][robots][]', array_combine(Seo::ROBOTS_FOLLOW, Seo::ROBOTS_FOLLOW),
            $__seo->meta->robots ?? null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Meta robots advanced</label>
        {!! Form::select('seo[meta][robots][]', array_combine(Seo::ROBOTS_ADVANCED, Seo::ROBOTS_ADVANCED),
            $__seo->meta->robots ?? null, ['multiple', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Canonical</label>
        {!! Form::url('seo[meta][canonical]', $__seo->meta->canonical ?? null, ['class' => 'form-control']) !!}
    </div>
</div>