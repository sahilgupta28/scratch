@component('mail::message')
# Hello {{ucwords($blog->owner->name)}}

You have just deleted a blog with title <b>{{$blog->title}}</b>.

@component('mail::button', ['url' => route('blogs.index')])
View Your Blog List.
@endcomponent

Thanks,<br>
{{ config('app.name') }}<br/>
{{ config('user.email')}}
@endcomponent
