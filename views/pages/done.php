<div class="container-fluid">
    <div class="mt-1">
        <h1><a href="/">To</a><span class="font-weight-lighter">{do}</span><a href="/done">ne</a></h1>
        <?php
        $weeknr = 0;
        $first = true;
        foreach ($weeklogs as $row) {
            if ($weeknr != $row['weeknr']) {
                $weeknr = $row['weeknr'];
                if ($first == false) {
                    echo '</ul></div>';
                }
                echo '<div class="card m-3">';
                $currWeekClass = $currentWeekNr == $weeknr ? ' sameAsCurrent' : ''; ?>
                <h6 class="m-2 ml-3 <?php echo $currWeekClass; ?> ">
                    <a data-toggle="collapse" href="#week<?php echo $row['weeknr'] ?>" role="button" aria-expanded="false" aria-controls="week<?php echo $weeknr ?>">Vecka <?php echo $row['weeknr']; ?></a>
                </h6>
            <?php
                echo '<ul class="collapse show list-group list-group-flush" id="week' . $weeknr . '">';

                $first = false;
            }
            ?>
            <li class="list-group-item<?php echo $row['is_visible'] == 0 ? ' d-none' : '' ?>">
                <div class="dropup">
                    <a class="navbar-brand active" href="#" id="dropdown-<?php echo $row['weekloggr_id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="bi bi-box-arrow-up-right" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3.5 15A1.5 1.5 0 005 16.5h8a1.5 1.5 0 001.5-1.5v-4a.5.5 0 00-1 0v4a.5.5 0 01-.5.5H5a.5.5 0 01-.5-.5V7a.5.5 0 01.5-.5h4a.5.5 0 000-1H5A1.5 1.5 0 003.5 7v8zm7-11a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v5a.5.5 0 01-1 0V4.5H11a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M16.354 3.646a.5.5 0 010 .708l-8 8a.5.5 0 01-.708-.708l8-8a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                        </svg>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-<?php echo $row['weekloggr_id']; ?>">
                        <a class="dropdown-item small warning" href="<?php echo $base_url . '/done/delete/' . $row['weekloggr_id']; ?>">Ta bort</a>
                        <button type="button" class="btn small btn-link copybtn" onclick="copyToInput(this, <?php echo $row['weekloggr_id']; ?>, true)">Redigera</button>
                        <button type="button" class="btn small btn-link copybtn" onclick="copyToInput(this, <?php echo $row['weekloggr_id']; ?>)">Kopiera till inmatningsfält</button>
                    </div>
                </div>
                <span class="text-<?php echo $row['weekloggr_id']; ?>">
                    <?php $row['text'] = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="/done/hashtag/$1">#$1</a>', $row['text']); ?>

                    <?php echo $row['text']; ?>
                </span>
                <small class="date date-<?php echo $row['weekloggr_id']; ?> float-right" data-date="<?php echo date("Y-m-d", strtotime($row['date'])) ?>">
                    <?php echo date("D d M Y", strtotime($row['date'])); ?>
                </small>
            </li>
        <?php
        }
        ?>
        </ul>
    </div>
</div>
</div>
<nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav">
            <li class="nav-item dropup">
                <a class="nav-link navbar-brand active dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekloggr </a>
                <div class="dropdown-menu" aria-labelledby="dropdown10">
                    <a class="dropdown-item toggle-all d-none" href="#"><small>Visa alla gömda</small></a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/settings">Settings</a>
                </div>
            </li>
        </ul>
        <form method="POST" name="addweeklog" action="<?php echo $base_url; ?>/addlog">
            <input class="form-control text" name="weeklog" type="text" placeholder="Log work done">
            <input class="form-control d-none dateupdate" name="date" type="date" value="">
            <button type="submit" class="d-none">Skicka</button>
        </form>
    </div>
</nav>