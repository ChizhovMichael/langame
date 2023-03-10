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
                        <h4>Asynchronous</h4>
                        <div class="mb-3">
                            <div class="form-group mb-3">
                                <label for="async-title">Title</label>
                                <input type="text" id="async-title" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="async-category">Category</label>
                                <select id="async-category" class="form-select js-rubrics" multiple>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="async-description">Description</label>
                                <textarea id="async-description" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="async-content">Content</label>
                                <textarea id="async-content" class="form-control"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" id="js-async">Submit</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4>Not asynchronous</h4>
                        <form method="post" action="{{url('store-post')}}" class="mb-3">
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
                        @if(session('posts'))
                            <div class="alert alert-success">
                                {{ session('posts') }}
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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <h5>Create rubric</h5>
                        <form method="post" action="{{url('store-rubric')}}" class="mb-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="rubric">Title</label>
                                <input type="text" id="rubric" name="rubric" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="parent">Parent category</label>
                                <select name="parent" id="parent" class="form-select js-rubrics" data-default>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @if(session('rubrics'))
                            <div class="alert alert-success">
                                {{ session('rubrics') }}
                            </div>
                        @endif
                        @if ($errors->has('rubric'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('rubric') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-6 col-md-8">
                        <div class="form-group mb-3">
                            <label for="search">Search</label>
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                        </div>
                        <div class="row" id="posts-container"></div>
                    </div>
                </div>
            </div>
        </section>

    </body>
    <script src="{{ URL::asset('js/app.js') }}"></script>
</html>
