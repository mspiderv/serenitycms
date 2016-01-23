<?php

namespace Serenity\Core\Http\Controllers\Front;

use Illuminate\Http\Request;

use GUI;
use Serenity\Http\Requests;
use Serenity\Http\Controllers\FrontController;

class Controller extends FrontController
{
    public function front()
    {
        // TODO
        return '<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div class="jumbotron text-center">
    <h1>SerenityCMS</h1>
    <p class="lead">No content has been added yet.</p>
    <p><a href="' . route('admin.dashboard') . '" class="btn btn-success btn-lg">Open administration</a></p>
</div>

<footer class="text-center">
    <p class="text-muted">2016 - Created by <a href="mailto:mspiderv@gmail.com">Matej Vitaz</a> - <a href="https://github.com/mspiderv/serenitycms">Show on GitHub</a> - <a href="http://opensource.org/licenses/MIT">MIT Licence</a></p>
</footer>';
    }
}
