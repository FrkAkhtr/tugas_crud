@extends('master');

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Products</title>
  </head>

@section('konten')
    <h4>
        Selamat Datang
        <b>{{Auth::user()->name}}</b>
    </h4>
      
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Image</th>
        <th>Name</th>
        <th>Details</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td><img src="/image/{{ $product->image }}" width="100px"></td>
        <td>{{ $product->nama }}</td>
        <td>{{ $product->deskripsi }}</td>
        <td>
        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
    
            <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
            <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
    
            @csrf
            @method('DELETE')
    
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </td>
    </tr>
    @endforeach
    </table>
    
    {!! $products->links() !!}
@endsection