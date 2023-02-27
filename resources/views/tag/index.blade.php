@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('tag.create') }}" class="btn btn-primary">Create</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">User</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <th scope="row">
                            <img src="{{ asset('storage/'.$tag->image) }}" alt="" style="height: 100px; width: 100px">
                        </th>
                        <td>{{ $tag->title }}</td>
                        <td>{{ $tag->user->name }}</td>
                        <td>
                            <a href="{{ route('tag.edit', ['tag' => $tag]) }}" class="btn btn-success">update</a>

                            <form action="{{ route('tag.destroy', ['tag'=>$tag]) }}" method="POST">
                                @csrf
                                @method('delete')
                                    <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <p>No tags</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
