<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('notes.create') }}" class="btn btn-primary">Create Notes</a>
            </div>

            {{-- Serch Bar
             <div class="col-md-4">
                <form class="form-inline" action="" method="GET">
                    <input type="search" class="form-control" name="search" placeholder="Search...">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div> --}}
            <div class="col-md-6 text-right">
                Welcome, {{ Auth::user()->name }} 
                <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
            </div>

            {{-- <div class="col-md-4 text-right">
                <a href="{{ route('change-password.form') }}" class="btn btn-primary">Change Password</a>
            </div> --}}
            
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                <tr>
                    <th>{{ $loop->index + 1 }}</th>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->content }}</td>
                    <td>
                        <a href="{{ url('notes/'.$note->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a> 
                        <a onclick="return confirm('Do you want to delete or not?')" href="{{ url('notes/'.$note->id.'/delete') }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
    </div>

    
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>