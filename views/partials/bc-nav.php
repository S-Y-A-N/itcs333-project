<nav aria-label="breadcrumb">
  <ul>
    <?php $uri = parse_url($_SERVER['REQUEST_URI'])['path']; ?>

    <?php if ($uri === '/room') : ?>
      <li><a href="/home">Home</a></li>
      <li><a href="/rooms">Rooms</a></li>
      <li><a href="/rooms/<?= $room['dept'] ?>"><?= strtoupper($room['dept']) ?></a></li>
      <li>Room Details</li>

    <?php elseif (strpos($uri, 'rooms/') !== false) : ?>
      <li><a href="/home">Home</a></li>
      <li><a href="/rooms">Rooms</a></li>
      <li><?= strtoupper($dept) ?></li>

    <?php else : ?>
      <li><a href="/home">Home</a></li>
      <li><?= $h1 ?></li>

    <?php endif; ?>
  </ul>
</nav>