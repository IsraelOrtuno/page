@if (!isset($page))
    @php return @endphp
@endif

<div id="seo" class="form-group">
    <label>Page information</label>
    <seo-app :data="{{ json_encode($pageData ?? []) }}" :store="{{ json_encode(new \Devio\Page\PageResource($page)) }}"></seo-app>
</div>