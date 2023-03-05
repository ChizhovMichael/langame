<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Langame</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <section class="pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">

                    </div>
                    <div class="col-12 col-md-6">
                        <h4>Not asynchronous</h4>
                        <form method="post" action="{{url('store-form')}}" class="mb-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="category">Category</label>
                                <select name="category[]" id="category" class="form-select js-rubrics" multiple>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->has('title'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </body>
    <script src="{{ URL::asset('js/app.js') }}"></script>
</html>
