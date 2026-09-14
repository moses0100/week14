@extends('layouts.app')

@section('title', 'blogs')


@section('content')
    @if (count($blogs) > 0)
        <h2 class="text text-center py-2">
            บทความทั้งหมด</h2>
        <table class="table table-bordered text-center ">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    {{-- <th scope="col">Content</th> --}}
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $item)
                    <tr>

                        <td>{{ $item->title }}</td>
                        {{-- <td>{{ Str::limit($item->content, 10) }}</td> --}}
                        <td>
                            @if ($item->status)
                                <a href="{{ route('author.change', $item->id) }}" class="badge bg-success">เผยแพร่</a>
                            @else
                                <a href="{{ route('author.change', $item->id) }}" class="badge bg-danger">ไม่เผยแพร่</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('author.edit', $item->id) }}" class="badge bg-warning">แก้ไข</a>
                        </td>
                        <td><a href="{{ route('author.delete', $item->id) }}" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบบทความนี้ {{ $item->title }}จริงหรือไม่?')">ลบ</a>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    @else
        <h2 class="text-center py-2">ไม่มีบทความ</h2>
    @endif
@endsection
