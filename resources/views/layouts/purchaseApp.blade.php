<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Demo App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <style>
      .hero {
        margin-bottom: 2em;
      }
      .footer {
        margin-top: 2em;
      }
      .card {
        margin-top: 1em;
        margin-bottom: 1em;
      }
    </style>

  </head>
  <body>

    <section class="hero is-primary is-bold">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            @yield('title')
          </h1>
          <h2 class="subtitle">
            Purchase Demo App
          </h2>
        </div>
      </div>
    </section>

    <section class="container">
      <div class="columns">
        <div class="column is-3">
          @include('components.menu')
        </div>
        <div class="column is-9">
          @yield('content')
        </div>
      </div>
    </section>

    @include('components.footer')

  </body>
</html>
