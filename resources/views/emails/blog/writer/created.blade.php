@component('mail::message')
# Hello {{ucwords($blog->owner->name)}}

You have just created a new blog with title <b>{{$blog->title}}</b>.

@component('mail::button', ['url' => route('blogs.show',$blog->id)])
View Your Blog.
@endcomponent

Thanks,<br>
{{ config('app.name') }}<br/>
{{ config('user.email')}}
@endcomponent
