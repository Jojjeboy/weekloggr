<div class="container-fluid">
        <div class="mt-1">
            <h1><a href="/">Settings</a></h1>
        </div>
        <form method="post" action="<?php echo $base_url; ?>/settings/update">
            <div class="form-group">
                <label>Arkivera gamla loggar</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="archiveOld" id="yes" value="1" <?php echo $archiveOld === true ? 'checked' : '' ?>>
                    <label class="form-check-label" for="exampleRadios1">
                        Ja
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="archiveOld" id="no" value="0" <?php echo $archiveOld === false ? 'checked' : '' ?>>
                    <label class="form-check-label" for="exampleRadios2">
                        Nej
                    </label>
                </div>

            </div>
            <div class="form-group archiveAfter">
                <label for="archiveAfter">Arkivera efter</label>
                <input type="number" min="1" max="60" class="form-control" name="archiveAfter" id="archiveAfter" data-originalvalue="<?php echo $archiveAfter; ?>" value="<?php echo $archiveAfter; ?>" <?php echo $archiveOld === false ? 'disabled' : '' ?>>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>