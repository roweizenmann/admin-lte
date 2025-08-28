<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6">
                @hasSection('page-title')
                    <h3 class="mb-0">@yield('page-title')</h3>
                @endif
                @isset($breadcrumbs)
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            @foreach($breadcrumbs as $breadcrumb)
                                <a href="#">{{$breadcrumb['label']}}</a>
                            @endforeach
                        </li>
                    </ol>
                @endisset
            </div>

            <div class="col-sm-6">
                Actions
            </div>

        </div>
    </div>
</div>
