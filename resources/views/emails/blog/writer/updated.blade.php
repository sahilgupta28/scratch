@component('mail::message')
# Hello {{ucwords($blog->owner->name)}}

Your blog with title <b>{{$blog->title}}</b> has just updated.

@component('mail::button', ['url' => route('blogs.show',$blog->id)])
View Your Blog.
@endcomponent

Thanks,<br>
{{ config('app.name') }}<br/>
{{ config('user.email')}}
@endcomponent
