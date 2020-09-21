@if (session()->has('message'))
    <div class="notification is-info is-bottom-right">
      {{ session()->get('message') }}
      <i id='hide-notification' class="fas fa-window-close"></i>
    </div>
@endif
