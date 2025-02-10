<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-user"></i> Blabla
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-shopping-cart"></i> Panier
                </a>
            </li>
            <!-- Ajoutez d'autres éléments de menu ici -->
        </ul>
    </div>
</nav>

@if (backpack_theme_config('breadcrumbs') && isset($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs))
	<nav aria-label="breadcrumb" class="d-none d-lg-block">
	  <ol class="breadcrumb bg-transparent p-0 mx-3 {{ backpack_theme_config('html_direction') == 'rtl' ? 'justify-content-start' : 'justify-content-end' }}">
	  	@foreach ($breadcrumbs as $label => $link)
	  		@if ($link)
			    <li class="breadcrumb-item text-capitalize"><a href="{{ $link }}">{{ $label }}</a></li>
	  		@else
			    <li class="breadcrumb-item text-capitalize active" aria-current="page">{{ $label }}</li>
	  		@endif
	  	@endforeach
	  </ol>
	</nav>

	
@endif
