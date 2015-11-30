<p>Message by <b>{{ $name }}</b> ({{ $email }})</p>
<hr>
<p>
  @foreach ($messageLines as $messageLine)
    {{ $messageLine }}<br>
  @endforeach
</p>
