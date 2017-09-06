<ul>
    @foreach( $users as $k => $v)
        <li>{{ $v->id }}--{{ $v->title }}--{{ $v->content }}</li>
    @endforeach
</ul>
