<div id="menu">
  @if ($page->getFilename() == 'index')
    <img class="sm-hide" onclick="printPage()" id="printer" width="100%" height="auto" src="{{ url('assets/images/icons/printer-light.png') }}" />
  @endif
  <img onclick="toggleTheme()" id="themer" width="100%" height="auto" src="{{ url('assets/images/icons/moon-light.png') }}" />
  <a href="{{ $page->repoUrl }}" target="_blank" style="display:flex;">
    <img id="info" width="100%" height="auto" src="{{ url('assets/images/icons/info-light.png') }}" />
  </a>
</div>

<script>
  function toggleTheme() {
    let body = document.querySelector('body');
    let printer = document.getElementById('printer');
    let themer = document.getElementById('themer');
    let info = document.getElementById('info');

    body.className = body.className == 'classic' ? 'dark' : 'classic';
    let themerIcon = body.className == 'classic' ? 'moon-light' : 'sun-dark';
    let printerIcon = body.className == 'classic' ? 'printer-light' : 'printer-dark';
    let infoIcon = body.className == 'classic' ? 'info-light' : 'info-dark';

    const url = '{{ url('assets/images/icons') }}';
    printer.src = `${url}/${printerIcon}.png`;
    themer.src = `${url}/${themerIcon}.png`;
    info.src = `${url}/${infoIcon}.png`;
  }
</script>