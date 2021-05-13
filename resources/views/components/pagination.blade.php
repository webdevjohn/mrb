@props(['model'])
<section>
    {!! $model->appends(request()->input())->render() !!}	
</section>