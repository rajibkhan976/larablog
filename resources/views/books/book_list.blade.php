@extends('main_layout')

@section('content')
<div class="container">
    <div class="span12">
        <div class="row">
            <p><a href="{{url('/books/create')}}" class="btn btn-success">Add New Book</a></p>
            <ul class="thumbnails">
                @foreach($books as $book)
              
                <li class="span4">
                    <div class="thumbnail">
                        <img src="/img/{{$book->image}}" alt="ALT NAME">
                        <div class="caption">
                            <h3>{{$book->title}}</h3>
                            <p>Author :<b>{{$book->relAuthor['name']}} {{$book->relAuthor['surname']}}</b></p>
                            <p>Price : <b>{{$book->price}}</b></p>
                            <p>
                            <span><a href="{{url('books',$book->id)}}" class="btn btn-primary">Details</a></span>
                            <span><a href="{{route('books.edit',$book->id)}}" class="btn btn-warning">Update</a></span>
                            <span>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['books.destroy', $book->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </span>
                            </p>
                            <form action="/cart/add" name="add_to_cart" method="post" accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="book" value="{{$book->id}}">
                                <select name="amount" style="width: 100%">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <p align="center"><button class="btn btn-info btn-block">Add to Cart</button></p>
                            </form>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


@stop

