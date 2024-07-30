<div id="menu">
  @if ($page->getFilename() == 'index')
    <img class="sm-hide" onclick="printPage()" id="printer" width="100%" height="auto"
    src="/assets/images/icons/printer-light.png" />
  @endif
  <img onclick="toggleTheme()" id="themer" width="100%" height="auto" src="/assets/images/icons/moon-light.png" />
</div>

<script>
  function toggleTheme() {
    let body = document.querySelector('body');
    let printer = document.getElementById('printer');
    let themer = document.getElementById('themer');

    body.className = body.className == 'classic' ? 'dark' : 'classic';
    let themerIcon = body.className == 'classic' ? 'moon-light' : 'sun-dark';
    let printerIcon = body.className == 'classic' ? 'printer-light' : 'printer-dark';

    printer.src = `/assets/images/icons/${printerIcon}.png`;
    themer.src = `/assets/images/icons/${themerIcon}.png`;
  }
</script>