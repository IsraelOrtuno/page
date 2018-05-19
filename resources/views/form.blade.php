@if (!isset($page))
@php return @endphp
@endif

{{--<script>--}}
    {{--window.__seo = {--}}
        {{--data: @json($pageData),--}}
        {{--store: @json(new \Devio\Page\PageResource($page))--}}
    {{--}--}}
{{--</script>--}}

<div id="seo">
    <seo-app :data="{{ json_encode($pageData) }}" :store="{{ json_encode(new \Devio\Page\PageResource($page)) }}"></seo-app>
</div>